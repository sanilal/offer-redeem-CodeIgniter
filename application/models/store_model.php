<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Store_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Mailer');
    }
	
    public function login($name, $password) {
        $this->db->where('store_email', $name);
        $this->db->where('store_pass',md5($password));
        $this->db->where('store_status', 1);
        $query = $this->db->get('store');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $data = array(
                    'storename' => $row->store_name,
                    'store_logged_in' => TRUE,
					'store_id'=>$row->store_id
                );
            }
            $this->session->set_userdata($data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function sendForgetPass($param) {
        $email = $param;
        $this->db->where('store_email', $email);
        $query = $this->db->get('store');

        if ($query->num_rows() > 0) {
            return true;
        }
        else{
            return false;
        }
    }
    
    public function resetPassword($param, $pass) {
        $sql = "Update auth SET password ='$pass' WHERE email ='$param'";
        $this->db->query($sql);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return FALSE;
        }
        
    }

    public function isLoggedIn() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('store_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== TRUE) {
            redirect('/store/login');
            exit;
        }
    }
	public function storeCreate($param) {
        $store = array('store_name' => $param['name'],
            'contact_person' => $param['contactperson'],
            'store_cord' => $param['cord'],
            'store_city' => $param['city'],
            'store_email' => $param['email'],
            'store_pass' => $param['password'],
            'phone1' => $param['phone1'],
			'redeem_partner' => $param['partner'],
			'store_status' => $param['status'],
            'created' => date('y-m-d'));
			//var_dump($store); exit;
        if($this->db->insert('store', $store)){
			return true;
        }else{
            return false;
        }
        
    }
	public function storeUpdate($param) {
		$id=$param['id'];
        $store = array('store_name' => $param['name'],
            'contact_person' => $param['contactperson'],
            'store_cord' => $param['cord'],
            'store_city' => $param['city'],
            'store_email' => $param['email'],
            'phone1' => $param['phone1'],
			'redeem_partner' => $param['partner'],
			'store_status' => $param['status']);
			
        $this->db->where('store_id', $id);
        $this->db->update('store', $store);
        if ($this->db->affected_rows() > 0) {
			return true;
        }else{
            return false;
        }
        
    }
	
	public function getStore($param) {
        $id = $param;
        $query = $this->db->get_where('store', array('store_id' => $id));
        return $query;
    }
	//
	public function getPointsStore($param) {
        $id = $param;
		$this->db->order_by("point_id","desc");
        $query = $this->db->get_where('store_points', array('store_id' => $id));
        return $query;
    }
	public function addPoint($param) {
        $point = array('store_id' => $param['store_id'],
			'amount' => $param['amount'],
			'points' => $param['points'],
			'status' => $param['status'],
            'created' => date('Y-m-d H:i:s'));
        $this->db->insert('store_points', $point);
        $id = $this->db->insert_id();
        if ($id) { 
			return true;
        } 
		else {
			return false;
		}
    }


//    public function sendMail() {
//        $mail = new PHPMailer();
//        $body = '<div style="width: 400px; border: 2px solid #ddd; padding: 10px;">
//                <a href="http://webrocom.net/" style="text-align: center; display: block; text-transform: uppercase; font-size: 25px; background: #33ccff; color: #fff">webrocom</a>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Name:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Email:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Message:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//            </div>';
//        $mail->IsSMTP(); // we are going to use SMTP
//        $mail->SMTPAuth = true; // enabled SMTP authentication
//        $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
//        $mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
//        $mail->Port = 587;                   // SMTP port to connect to GMail
//        $mail->Username = "erentservices";  // user email address
//        $mail->Password = "erentservices";            // password in GMail
//        $mail->SetFrom('webrocom@gmail.com', 'Vikram Parihar');  //Who is sending the email
//        $mail->AddReplyTo("pariharvikram1989@gmail.com", "Vikram Parihar");  //email address that receives the response
//        $mail->Subject = "PHPMailer Test by Gmail tuts on webrocom";
//        $mail->msgHTML($body);
//        $mail->AltBody = "Plain text message";
//        $mailto = "vikram.parihar@mediatech.co.in";
//        $mail->AddAddress($mailto, "John Doe");
//        if (!$mail->Send()) {
//            echo $mail->ErrorInfo;
//            return FALSE;
//        } else {
//            return true;
//        }
//    }

}
