<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Mailer');
    }
	
    public function login($name, $password) {
        $this->db->where('user_email', $name);
        $this->db->where('user_password',md5($password));
        $this->db->where('status', 1);
        $query = $this->db->get('member');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $data = array(
                    'user_name' => $row->fname." ".$row->lname,
                    'user_logged_in' => TRUE,
					'user_id'=>$row->id,
					'user_fb_id'=>$row->fb_id
                );
            }
            $this->session->set_userdata($data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*public function sendForgetPass($param) {
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
        
    }*/

    public function isLoggedIn() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('user_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== TRUE) {
            redirect('/user/login');
            exit;
        }
    }
	public function fbUserUniq($param) {
        $id = $param;
        $this->db->where('fb_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get('member');
        if ($query->num_rows() > 0) {
			return true;
		} 
		else {
			return false;
		}
    }
	 public function userCreate($param) {
        $member = array('fname' => $param['firstname'],
            'user_email' => $param['user_email'],
			'user_password' => $param['password'],
			'fb_id' => $param['fb_id'],
            'lname' => $param['lastname'],
            'gender' => $param['gender'],
            'address' => $param['address'],
            'area' => $param['area'],
            'telephone' => $param['telephone'],
            'telephone2' => $param['telephone2'],
            'created' => date('y-m-d'));
        $this->db->insert('member', $member);
        $creted_member_id = $this->db->insert_id();
        if ($creted_member_id) { 
			return true;
        } 
		else {
			return false;
		}
    }
    
    public function userUpdate($param) {
        
        $id = $param['id'];
        
        $member = array('fname' => $param['firstname'],
            'mname' => $param['middlename'],
            'lname' => $param['lastname'],
            'gender' => $param['gender'],
            'address' => $param['address'],
            'area' => $param['area'],
            'telephone' => $param['telephone'],
            'telephone2' => $param['telephone2'],
            'expired'=>$param['expired']);
        $this->db->where('id', $id);
        $this->db->update('member', $member);
           
            
                if ($this->db->affected_rows() > 0) {
                    return true;
                } 
				else {
                    return false;
                }
        
    }
	//
	public function getUser($param) {
        $query = $this->db->get_where('member', array('id' => $param));
        return $query;
    }
	
	/////
	//
	public function addPoint($param) {
        $order = array('user_id' => $param['user_id'],
			'order_store' => $param['store'],
			'order_amount' => $param['amount'],
			'order_points' => $param['points'],
            'bill_img' => $param['bill_img'],
			'store_cnf' => $param['store_cnf'],
			'status' => 0,
            'created' => date('Y-m-d H:i:s'));
        $this->db->insert('user_orders', $order);
        $id = $this->db->insert_id();
        if ($id) { 
			return true;
        } 
		else {
			return false;
		}
    }
	public function getPointsUser($param) {
        $id = $param;
		$this->db->order_by("order_id","desc");
        $query = $this->db->get_where('user_orders', array('user_id' => $id));
        return $query;
    }
	public function getRedeemUser($param) {
        $id = $param;
		$this->db->order_by("redeem_id","desc");
        $query = $this->db->get_where('redeem_points', array('point_user' => $id));
        return $query;
    }
	

}
