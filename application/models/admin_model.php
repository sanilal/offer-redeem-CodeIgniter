<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function memberCreate($param) {
        $member = array('fname' => $param['firstname'],
            'user_email' => $param['user_email'],
			'user_password' => $param['password'],
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
            /*$member_plan = array('member_id' => $creted_member_id,
                'package_type' => $param['plan'],
                'package_period' => $param['tariff'],
                'start_date' => $param['start_date'],
                'expire_date' => $param['end_date'],
                'paid' => $param['paid'],
                'unpaid' => $param['unpaid'],
                'next_installment' => $param['instalmentdate'],
                'desc' => $param['desc'],
                'created' => date('y-m-d'),
                'modified' => date('y-m-d'),
            );*/

            //$this->db->insert('member_plan', $member_plan);
            if ($this->db->insert_id()) {
                if ($this->db->affected_rows() > 0) {
                    echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>New member added successfully.</p>';
                } else {
                    echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
                }
                exit;
            } else {
                $this->db->where('id', $creted_member_id);
                $this->db->delete('member');
            }
        }
        exit;
    }
    
    public function memberUpdate($param) {
        
        $id = $param['id'];
        
        $member = array('fname' => $param['firstname'],
            'user_email' => $param['user_email'],
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
                    echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>member Updated successfully.</p>';
                } else {
                    echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Nothing to Update.</p>';
                    }
                exit;
        
    }

    public function planCreate($param, $param2) {
        $name = $param;
        $code = $param2;
        $data = array('name' => $name, 'code' => $code);
        $this->db->insert('plan', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>New plan added successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }

    public function planList() {
        $result = $this->db->get('plan');
        return $result;
    }
	//
    public function categoryList() {
		$this->db->order_by("category_id","desc");
        $result = $this->db->get('categories');
        return $result;
    }
	public function parentcategoryList() {
		$this->db->order_by("category_id","desc");
        $result = $this->db->get_where('categories', array('parent_cat' => 0));
        return $result;
    }
	public function getCategory($param) {
        $id = $param;
        $query = $this->db->get_where('categories', array('category_id' => $id));
        return $query;
    }
	public function addCategory($param) {
		$cat = array('cat_name' => $param['cat_name'],
            'parent_cat' => $param['cat_parent'],
            'cat_desc' => $param['cat_desc'],
            'featured' => $param['featured']);
        $this->db->insert('categories', $cat);
		if ($this->db->affected_rows() > 0) {
        	return true;
		}
		else { return false;}
    }
	public function updateCategory($param) {
		$cat = array('cat_name' => $param['cat_name'],
            'parent_cat' => $param['cat_parent'],
            'cat_desc' => $param['cat_desc'],
            'featured' => $param['featured']);
        $this->db->where('category_id', $param['id']);
        $this->db->update('categories', $cat);
		if ($this->db->affected_rows() > 0) {
        	return true;
		}
		else { return false;}
    }
	public function deleteCategory($param) {
		$id = $param;
		$this->db->where('parent_cat', $id);
		$this->db->delete('categories');
		$this->db->where('category_id', $id);
		$this->db->delete('categories');               
		if($this->db->affected_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	////
	public function locationList() {
		$this->db->order_by("location_id","desc");
        $result = $this->db->get('locations');
        return $result;
    }
	public function getLocation($param) {
        $id = $param;
        $query = $this->db->get_where('locations', array('location_id' => $id));
        return $query;
    }
	public function addLocation($param) {
		$loc = array('location_name' => $param['loc_name'],
            'location_cord' => $param['cord']);
        $this->db->insert('locations', $loc);
		if ($this->db->affected_rows() > 0) {
        	return true;
		}
		else { return false;}
    }
	public function updateLocation($param) {
		$loc = array('location_name' => $param['loc_name'],
            'location_cord' => $param['cord']);
		$this->db->where('location_id', $param['id']);
        $this->db->update('locations', $loc);
		if ($this->db->affected_rows() > 0) {
        	return true;
		}
		else { return false;}
    }
	public function deleteLocation($param) {
		$id = $param;
		$this->db->where('location_id', $id);
		$this->db->delete('locations');               
		if($this->db->affected_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	///
    public function userList() {
        $result = $this->db->get('adm_login');
        return $result;
    }
	public function memberList($limit=NULL) {
		$this->db->order_by("id","desc");
        $result = $this->db->get('member');
        return $result;
    }

    public function tariffList() {
        $sql = "select p.id as plan_id, p.name as plan_name, t.id as tariff_id, t.duration, t.price, t.offer, t.notes from plan p inner join teriff t on p.id = t.plan_id";
        return $this->db->query($sql);
    }

    public function editPlan($param) {
        $id = $param;
        $query = $this->db->get_where('plan', array('id' => $id));
        return $query;
    }
    public function editUser($param) {
        $id = $param;
        $query = $this->db->get_where('adm_login', array('id' => $id));
        return $query;
    }
//
    public function editTariff($param) {
        $id = $param;
        $query = $this->db->get_where('teriff', array('id' => $id));
        return $query;
    }

    public function planUpdate($param1, $param2, $param3) {
        $id = $param1;
        $name = $param2;
        $code = $param3;
        $data = array('name' => $name, 'code' => $code);
        $this->db->where('id', $id);
        $this->db->update('plan', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>plan updated successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Nothing to update.</p>';
        }
        exit;
    }
    
    public function userUpdate($param) {
        $password= $param['password'];
        $data = array('uname' => $param['name'], 'email' => $param['email'], 'password'=> $password, 'role'=>$param['role'], 'status'=>$param['status']);
        $this->db->where('id', $param['id']);
        $this->db->update('adm_login', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>User updated successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Nothing to update.</p>';
        }
        exit;
    }

    public function tariffUpdate($param) {
        $id = $param['id'];
        $plan = $param['plan'];
        $duration = $param['duration'];
        $price = $param['price'];
        $offer = $param['offer'];
        $note = $param['note'];
        $data = array('plan_id' => $plan, 'duration' => $duration, 'price' => $price, 'offer' => $offer, 'notes' => $note);
        $this->db->where('id', $id);
        $this->db->update('teriff', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>tariff updated successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>nothing to Update.</p>';
        }
        exit;
    }

    public function deletePlan($param) {
        $id = $param;
        $this->db->delete('plan', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>One record has been deleted successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }
    
    public function deleteUser($param) {
        $id = $param;
        $this->db->delete('adm_login', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>One record has been deleted successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }

    public function deleteTariff($param) {
        $id = $param;
        $this->db->delete('teriff', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>One record has been deleted successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }

    public function tariffCreate($param) {
        $plan = $param['plan'];
        $duration = $param['duration'];
        $price = $param['price'];
        $offer = $param['offer'];
        $note = $param['note'];

        $data = array('plan_id' => $plan, 'duration' => $duration, 'price' => $price, 'offer' => $offer, 'notes' => $note);
        $this->db->insert('teriff', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>New plan added successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }

    public function autoloadPeriod($param) {
        $id = $param;
        $this->db->where('plan_id', $id);
        return $this->db->get('teriff');
    }

    public function loadnotes($param) {
        $id = $param;
        $this->db->where('id', $id);
        return $this->db->get('teriff');
    }
    
    public function memberDelete($param) {
        $id = $param;
        $this->db->where('id', $id);
        $this->db->delete('member');
        
               
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
        
    }
    
public function alertExpire() {
    $sql = "SELECT m.id as mid, CONCAT(m.fname ,'- ', m.lname)as name, p.expire_date from member m left join member_plan p  on m.id = p.member_id WHERE m.expired = 0";
    $query = $this->db->query($sql);
    
    return $query;
}

public function alertCompleteExpire() {
    $sql = "SELECT m.id as mid, CONCAT(m.fname ,'- ', m.lname)as name, p.expire_date from member m left join member_plan p  on m.id = p.member_id WHERE m.expired = 1";
    $query = $this->db->query($sql);
    return $query;
}
public function alertInstallment() {
    $sql = "SELECT m.id as mid, CONCAT(m.fname ,'- ', m.lname)as name, p.next_installment from member m left join member_plan p  on m.id = p.member_id WHERE m.expired = 0";
    $query = $this->db->query($sql);
    
    return $query;
    
}



public function adminCreate($param) {
    $password= $param['password'];
        $data = array('uname' => $param['name'], 'email' => $param['email'], 'password'=> $password, 'role'=>$param['role'], 'status'=>$param['status']);
        $this->db->insert('adm_login', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>New User added successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
    }
    
    public function setExpireMember($param){
        foreach ($param as $id){
            $this->db->query("update member set expired = 1 where id = $id");
        }
    }
	
	//
	public function storeList() {
		$this->db->order_by("store_id","desc");
        $result = $this->db->get('store');
        return $result;
    }
	//
public function getStore($param) {
        $id = $param;
        $query = $this->db->get_where('store', array('store_id' => $id));
        return $query;
    }
 public function storeDelete($param) {
	$id = $param;
	$this->db->where('store_id', $id);
	$this->db->delete('store');               
	if($this->db->affected_rows() > 0){
		return true;
	} else {
		return false;
	}
	
}
public function storeUpdateStatus($id, $status) {
        $data = array( 'store_status' => $status);
        $this->db->where('store_id', $id);
        $this->db->update('store', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>plan updated successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Nothing to update.</p>';
        }
        exit;
    }
	 public function deleteOffer($param) {
	$id = $param;
	$this->db->where('offer_id', $id);
	$this->db->delete('offers');               
	if($this->db->affected_rows() > 0){
		return true;
	} else {
		return false;
	}
	
	}
	//
	public function getPointsStore($limit=NULL) {
		$this->db->select('point_id, store_points.store_id, store_name, points, amount, store_points.created, store_points.status');
		$this->db->from('store_points');
		$this->db->join('store', 'store_points.store_id = store.store_id');
		$this->db->order_by("status","asc");
		if($limit!=NULL){
			 $this->db->limit($limit);
		}
        $result = $this->db->get();
        return $result;

    }
	
	public function approveStorPoint($id, $status){
		$data = array( 'status' => $status);
        $this->db->where('point_id', $id);
        $this->db->update('store_points', $data);           
		if($this->db->affected_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	///
	//
	public function getUserOrders($limit=NULL) {
		$this->db->select('order_id, user_orders.order_store, user_orders.user_id, store_name, fname, lname, order_points, bill_img, order_date, order_amount, store_cnf,  user_orders.created, user_orders.status');
		$this->db->from('user_orders');
		$this->db->join('store', 'user_orders.order_store = store.store_id');
		$this->db->join('member', 'user_orders.user_id = member.id');
		$this->db->order_by("status","asc");
		if($limit!=NULL){
			 $this->db->limit($limit);
		}
        $result = $this->db->get();
        return $result;

    }
	/////
	//
	public function createSubscribe($param) {
		$sub = array('sub_mail' => $param['email'],
            'date' => date('y-m-d'));
        $this->db->insert('subscribers', $sub);
		if ($this->db->affected_rows() > 0) {
        	return true;
		}
		else { return false;}
    }
	//

}
