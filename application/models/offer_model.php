<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Mailer');
    }

    public function offerCreate($param) {
        $offer = array('store_id' => $param['store_id'],
            'location' => $param['location'],
			'location_id' => $param['location_id'],
            'title' => $param['title'],
            'offer_desc' => $param['description'],
            'off_category' => $param['category'],
            'tags' => $param['tags'],
			'offer_points' => $param['off_points'],
            'price' => $param['price'],
			'off_price' => $param['off_price'],
			'call_price' => $param['call_price'],
			'offer_phone' => $param['phone'],
			'main_img' => $param['main_img'],
			'off_imgs' => $param['off_imgs'],
			'off_videos' => $param['off_videos'],
			'featured' => $param['featured'],
			'status' => $param['status'],
            'created' => date('y-m-d'));
        if($this->db->insert('offers', $offer)){
			return true;
        }else{
            return false;
        }
        
    }
	 public function offerUpdate($param) {
		 $id= $param['offer_id'];
        $offer = array('store_id' => $param['store_id'],
            'location' => $param['location'],
			'location_id' => $param['location_id'],
            'title' => $param['title'],
            'offer_desc' => $param['description'],
            'off_category' => $param['category'],
            'tags' => $param['tags'],
			'offer_points' => $param['off_points'],
            'price' => $param['price'],
			'off_price' => $param['off_price'],
			'call_price' => $param['call_price'],
			'offer_phone' => $param['phone'],
			'main_img' => $param['main_img'],
			'off_imgs' => $param['off_imgs'],
			'off_videos' => $param['off_videos'],
			'featured' => $param['featured'],
			'status' => $param['status']);
			$this->db->where('offer_id', $id);
        if($this->db->update('offers', $offer)){
			return true;
        }else{
            return false;
        }
        
    }
	 public function offerList() {
		$this->db->where('status', 1);
		$this->db->order_by("offer_id","desc");
        $result = $this->db->get('offers');
        return $result;
    }
	public function offerSearch($cat="",$key="",$loc="") {
		if($cat!="" && $cat!=0){
			$this->db->where('off_category', $cat);
		}
		if($key!="" && $key!=NULL){
			$this->db->like('LOWER(title)', strtolower($key));
		}
		if($loc!="" && $loc!=NULL){
			$this->db->like('location_id', $loc);
		}
		$this->db->where('status', 1);
		$this->db->order_by("offer_id","desc");
        $result = $this->db->get('offers');
		//echo $this->db->last_query(); exit;
        return $result;
    }
	public function storeOfferList($store) {
        $query = $this->db->get_where('offers', array('store_id' => $store, 'status'=>1));
        return $query;
    }
	public function getoffer($param) {
        $id = $param;
        $query = $this->db->get_where('offers', array('offer_id' => $id, 'status'=>1));
        return $query;
    }
	public function catList($param,$limit=NULL) {
		$this->db->where(array('off_category' => $param, 'status'=>1));
		$this->db->order_by("offer_id","desc");
		if($limit!=NULL){
			 $this->db->limit($limit);
		}
        $result = $this->db->get('offers');
        return $result;
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
