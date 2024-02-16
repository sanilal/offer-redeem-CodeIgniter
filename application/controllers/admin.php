<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public $delete_id = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->Model('Auth_model');
		$this->load->model('Store_model');
		$this->load->model('Offer_model');
    }

    public function index() {
		$this->Auth_model->isLoggedIn();
		$data["active"]="dash";
		$data['menu_active']="account";
		$data["store_points"] = $this->Admin_model->getPointsStore(10);
        $this->load->view('admin/alert',$data);
        
    }

    public function family() {
		$this->Auth_model->isLoggedIn();
        $this->load->view('admin/family');
        
    }

    public function memberCreate() {
        $this->Auth_model->isLoggedIn();
        
        if ($this->input->is_ajax_request()) {
            
            if($this->session->userdata('role') == 'admin'){
			$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');
            $this->form_validation->set_rules('firstname', 'First name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[member.user_email]');
			//
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');
			//
            //$this->form_validation->set_rules('lastname', 'Last name', 'required');
            //$this->form_validation->set_rules('area', 'Area/Town/City', 'required');
            $this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[10]|numeric');

           // $this->form_validation->set_rules('plan', 'Package type', 'required');
            //$this->form_validation->set_rules('tariff', 'Selected period', 'required');
            //$this->form_validation->set_rules('start_date', 'start date', 'required');
            //$this->form_validation->set_rules('end_date', 'end date', 'required');
            //$this->form_validation->set_rules('paid', 'end date', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                echo'<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>';
            } else {
//                        general information
                $family['firstname'] = $this->input->post('firstname');
                $family['user_email'] = $this->input->post('email');
                $family['lastname'] = $this->input->post('lastname');
				//
				  $family['password'] = md5($this->input->post('password'));
				//
                $family['gender'] = $this->input->post('gender');
                $family['address'] = $this->input->post('address');
                $family['area'] = $this->input->post('area');
                $family['telephone'] = $this->input->post('telephone');
                $family['telephone2'] = $this->input->post('telephone2');
//                        plan information
                $family['plan'] = $this->input->post('plan');
                $family['tariff'] = $this->input->post('tariff');
                $family['start_date'] = $this->input->post('start_date');
                $family['end_date'] = $this->input->post('end_date');
                $family['paid'] = $this->input->post('paid');
                $family['unpaid'] = $this->input->post('unpaid');
                $family['instalmentdate'] = $this->input->post('instalmentdate');
                $family['desc'] = $this->input->post('desc');
                $this->Admin_model->memberCreate($family);
            }

            exit;
        }
        else{
            echo'<div class="alert alert-dismissable alert-danger"><small>Sorry ! you are not valid user</small></div>';
            exit;
        }
        }
		$data["active"]="member";
        $this->load->view('admin/create_member',$data);
    }

    public function schema() {
        $this->Auth_model->isLoggedIn();
		$data["active"]="settings";
        $this->load->view('admin/schema',$data);
    }

    public function plan() {
        $this->Auth_model->isLoggedIn();
        $this->load->view('admin/plan');
    }

    public function tariff() {
        $this->Auth_model->isLoggedIn();
        $this->load->view('admin/tariff');
    }

    public function planCreate() {
        $this->form_validation->set_rules('name', 'Plan name', 'required');
        $this->form_validation->set_rules('code', 'Plan code', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo'<p class="alert alert-dismissable alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Add Proper plan data</p>';
        } else {
            $name = $this->input->post('name');
            $code = $this->input->post('code');
            $this->Admin_model->planCreate($name, $code);
        }
    }

    public function planList() {
        $data = $this->Admin_model->planList();
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deletePlan/';
            $urledit = base_url() . 'admin/editPlan/';
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
                echo"<tr><td>" . $sr . "</td><td>" . $row->code . "</td><td>" . $row->name . "</td>"
                . "<td><a data-url='$urledit' class='btn btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class='btn btn-sm btn-info btndelete' data-id='$row->id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Plan added.</td></tr>';
        }
        exit;
    }

    public function editPlan() {
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->editPlan($id);
        $data['id'] = $id;
        $this->load->view('admin/plan_edit', $data);
    }

    public function editTariff() {
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->editTariff($id);
        $data['id'] = $id;
        $this->load->view('admin/tariff_edit', $data);
    }

    public function planUpdate() {
        $id = $this->input->get_post('id');
        $name = $this->input->get_post('name');
        $code = $this->input->get_post('code');
        $this->Admin_model->planUpdate($id, $name, $code);
    }
    
    public function userUpdate() {
        $user['email'] = $this->input->get_post('email');
        $user['id'] = $this->input->get_post('id');
        $user['name'] = $this->input->get_post('name');
        $user['password'] = $this->input->get_post('password');
        $user['role'] = $this->input->get_post('role');
        $user['status'] = $this->input->get_post('status');
        $this->Admin_model->userUpdate($user);
    }

    public function tariffUpdate() {
        $id = $this->input->get_post('id');
        $this->form_validation->set_rules('plan', 'Plan name', 'required');
        $this->form_validation->set_rules('duration', 'Plan Duration', 'required');
        $this->form_validation->set_rules('price', 'Plan price', 'required|numeric');
        $this->form_validation->set_rules('note', 'Plan note', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo'<div class="alert alert-dismissable alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . validation_errors() . '</div>';
        } else {
            $param['id'] = $id;
            $param['plan'] = $this->input->post('plan');
            $param['duration'] = $this->input->post('duration');
            $param['price'] = $this->input->post('price');
            $param['offer'] = $this->input->post('offer');
            $param['note'] = $this->input->post('note');
            $this->Admin_model->tariffUpdate($param);
        }
    }

    public function deletePlan() {
        $id = $this->input->get_post('id');
        $this->Admin_model->deletePlan($id);
    }
    
    public function deleteUser() {
        $id = $this->input->get_post('id');
        $this->Admin_model->deleteUser($id);
    }

    public function tariffCreate() {
        $this->form_validation->set_rules('plan', 'Plan name', 'required');
        $this->form_validation->set_rules('duration', 'Plan Duration', 'required');
        $this->form_validation->set_rules('price', 'Plan price', 'required|numeric');
        $this->form_validation->set_rules('note', 'Plan note', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo'<div class="alert alert-dismissable alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . validation_errors() . '</div>';
        } else {
            $param['plan'] = $this->input->post('plan');
            $param['duration'] = $this->input->post('duration');
            $param['price'] = $this->input->post('price');
            $param['offer'] = $this->input->post('offer');
            $param['note'] = $this->input->post('note');
            $this->Admin_model->tariffCreate($param);
        }
    }

    public function selectPlan() {
        $query = $this->db->get('plan');
        echo'<option value="0">Select</option>';
        foreach ($query->result() as $row) {
            echo'<option value=' . $row->id . '>' . $row->name . '</option>';
        }
        exit;
    }

    public function tariffList() {
        $data = $this->Admin_model->tariffList();
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteTariff/';
            $urledit = base_url() . 'admin/editTariff/';
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
                echo"<tr><td>" . $sr . "</td><td>" . $row->plan_name . "</td><td>" . $row->duration . "</td><td>" . $row->price . "/Rs.</td><td>" . $row->offer . "</td><td>" . $row->notes . "</td>"
                . "<td><a data-url='$urledit' class='btn btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->tariff_id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class='btn btn-sm btn-info btndelete' data-id='$row->tariff_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Tariff added.</td></tr>';
        }
        exit;
    }

    public function deleteTariff() {
        $id = $this->input->get_post('id');
        $this->Admin_model->deleteTariff($id);
    }

    public function memberList() {
		$this->Auth_model->isLoggedIn();
		$data["active"]="member";
		$data['menu_active']="account";
        $this->load->view('admin/default_list',$data);
    }
	public function memberListData() {
        $data=$this->Admin_model->memberList();
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/memberDelete/';
            $urledit = base_url() . 'admin/memberEdit/';
			//var_dump($data);
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
                echo"<tr><td>" . $row->fname." ".$row->lname. "</td><td>" . $row->user_email . "</td><td>" . $row->telephone . "</td><td>" . $row->created . "</td>"
                . "<td><a data-url='$urledit' class='btn-sm btn-info btnedit'  data-toggle='modal' data-target='#updateUser' data-id='$row->id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a> &nbsp;&nbsp;&nbsp;&nbsp;<br/> <a data-url='$urldelete' class='btn-sm btn-info btndelete' data-id='$row->id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Users added.</td></tr>';
        }
        exit;
    }
    public function memberListLoad() {
		$this->Auth_model->isLoggedIn();
        $sql = "select CONCAT('A', m.id)as member_id, m.fname, m.user_email, m.lname, m.area, m.telephone, m.telephone2, m.id as m_id, m.created from off_member m  order by m.id desc";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
            
            
        
//        collect expire members
        $param = array();
        foreach ($family as $row){
            //$exp_date = $row->expire_date;
            //$exp_date_temp =  date_create($exp_date);
            //date_add($exp_date_temp, date_interval_create_from_date_string('90 days'));

            //$exp_member =  date_format($exp_date_temp, 'Y-m-d');

            $date1=date_create(date('Y-m-d'));
            //$date2=date_create($exp_member);
            //$diff=date_diff($date1,$date2);
            //$days =  $diff->format("%R%a");
            /*if($days <= 0){
                $param[] = trim($row->member_id,'A');
            }*/
        }
        $this->setExpireMember($param);
        
        
            
            
            
        echo json_encode($family);
//            exit;
    }
    
    public function memberEdit(){
        $this->Auth_model->isLoggedIn();
		$id = $this->input->get_post('id');
        $sql = "select * from off_member m  where m.id =". $id." limit 1";
        $query = $this->db->query($sql);
        $data['row'] = $query->row();
		$data["active"]="member";
		$data['id'] = $id;
        //var_dump($data['row']); exit;
        $this->load->view('admin/edit_member', $data);
    }
    
    public function memberUpdate() {
		$this->Auth_model->isLoggedIn();
//        var_dump($_POST); exit;    
			
            $this->form_validation->set_rules('firstname', 'First name ', 'required');
            //$this->form_validation->set_rules('middlename', 'Middle name', 'required');
            $this->form_validation->set_rules('lastname', 'Last name', 'required');
            //$this->form_validation->set_rules('area', 'Area/Town/City', 'required');
			$this->form_validation->set_rules('email', 'Email ', 'required|valid_email');
            $this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[10]|numeric');

            //$this->form_validation->set_rules('plan', 'Package type', 'required');
            //$this->form_validation->set_rules('tariff', 'Selected period', 'required');
            //$this->form_validation->set_rules('start_date', 'start date', 'required');
            //$this->form_validation->set_rules('end_date', 'end date', 'required');
            //$this->form_validation->set_rules('paid', 'Amount paid', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                echo'<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>';
            } else {
//                        general information
                $family['id'] = $this->input->post('id');
                $family['firstname'] = $this->input->post('firstname');
                $family['user_email'] = $this->input->post('email');
                $family['lastname'] = $this->input->post('lastname');
                $family['gender'] = $this->input->post('gender');
                $family['address'] = $this->input->post('address');
                $family['area'] = $this->input->post('area');
                $family['telephone'] = $this->input->post('telephone');
                $family['telephone2'] = $this->input->post('telephone2');
                $family['expired'] = $this->input->post('expired');
//                        plan information
                /*$family['plan'] = $this->input->post('plan');
                $family['tariff'] = $this->input->post('tariff');
                $family['start_date'] = $this->input->post('start_date');
                $family['end_date'] = $this->input->post('end_date');
                $family['paid'] = $this->input->post('paid');
                $family['unpaid'] = $this->input->post('unpaid');
                $family['instalmentdate'] = $this->input->post('instalmentdate');
                $family['desc'] = $this->input->post('desc');*/
                $this->Admin_model->memberUpdate($family);
            }

            exit;
        
    }
    
    public function memberView() {
        $this->Auth_model->isLoggedIn();
        $data['id'] = $this->uri->segment(2);
		$this->db->select('*');
		$this->db->from('member');
		//$this->db->join('member_plan', 'member.id = member_plan.member_id');
		$this->db->where('member.id', $data['id']);
		$this->db->limit('1');
		$query = $this->db->get();
        //$sql = "select m.id as member_id,  m.*, p.* from member m INNER join member_plan p on m.id = p.member_id where m.id =". $data['id']." limit 1";
        //$query = $this->db->query($sql);
        $data['row'] = $query->row();
		$data["active"]="member";
        $this->load->view('admin/view_member', $data);
    }
    
    public function viewPlan() {
        $id = $this->input->get_post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('plan');
        $row = $query->row();
        echo $row->name;
        exit;
        
    }
    public function viewPeriod() {
        $id = $this->input->get_post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('teriff');
        $row = $query->row();
        echo $row->duration;
        exit;
    }
    
    public function memberDelete() {
        $this->Auth_model->isLoggedIn();
		$id = $this->input->get_post('id');
        if($this->Admin_model->memberDelete($id)){
            $delete = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            This User deleted successfully!
            </div>';
			echo $delete;
            //$this->session->set_flashdata('delete', $delete);
            //redirect('memberList');
        }
        else{
            $data['success'] = false;
            $delete = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Sorry Internal error!
            </div>';
			echo $delete;
            //$this->session->set_flashdata('delete', $delete);
           //redirect('memberList');
        }
}

    public function alert() {
        $this->Auth_model->isLoggedIn();
		$data['menu_active']="account";
		$data["active"]="dash";
		$data["store_points"] = $this->Admin_model->getPointsStore(10);
		$this->load->view('admin/alert',$data);
	}
    public function alertExpire() {
        
        
    
    $query = $this->Admin_model->alertExpire();
    
    $now = strtotime(date('Y-m-d'));
    $data = array();
    foreach ($query->result() as $row){
        $days = $this->dateDiffter($now, strtotime($row->expire_date));
        if($days >= -5){
            $days = ($days <=-5)? $days : 'Expired';
            $data[] = array('name'=>$row->name,
                'rm'=> $days,
                'ed'=>$row->expire_date,
                'id'=>$row->mid);
        }
    
    }
    foreach ($data as $val){
        echo '<tr class=""><td>'.$val['name'].'</td><td>'.$val['rm'].'</td><td>'.date('F jS Y', strtotime($val['ed'])).'</td><td><a href='.base_url().'memberedit/'.$val['id'].'>Edit</a>&nbsp;&nbsp; <a href='.base_url().'view/'.$val['id'].'>View</a></td></tr>';
    }
    exit;
    
}

public function alertCompleteExpire() {
    
    $query = $this->Admin_model->alertCompleteExpire();
    foreach ($query->result() as $row){
        echo '<tr class=""><td>A'.$row->mid.'</td><td>'.$row->name.'</td><td>'.$row->expire_date.'</td></tr>';
    }
    exit;
    
}

    public function alertInstallment() {
    
    $query = $this->Admin_model->alertInstallment();
    $now = strtotime(date('Y-m-d'));
    $data = array();
    foreach ($query->result() as $row){
        $days = $this->dateDiffter($now, strtotime($row->next_installment));
        if($days >= -5){
            $days = ($days <= -5)? $days : 'Overdue';
            $data[] = array('name'=>$row->name,
                'rm'=> $days,
                'Installment_date'=>$row->next_installment,
                'id'=>$row->mid);
        }
    }
    foreach ($data as $val){
        $idt = ($val['Installment_date']== '0000-00-00')?'none':date('F jS Y', strtotime($val['Installment_date']));
        if($idt =='none')
        continue;
        echo '<tr class=""><td>'.$val['name'].'</td><td>'.$val['rm'].'</td><td>'.$idt.'</td><td><a href='.base_url().'memberedit/'.$val['id'].'>Edit</a>&nbsp;&nbsp; <a href='.base_url().'view/'.$val['id'].'>View</a></td></tr>';
    }
    exit;
}


public function subAdmin() {
    $this->Auth_model->isLoggedIn();
    $this->load->view('admin/subadmin');
}

public function adminCreate() {
    $this->Auth_model->isLoggedIn();
    $this->form_validation->set_rules('name', 'User name', 'required');
    $this->form_validation->set_rules('email', 'Email id', 'required | valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[cpassword]');
    $this->form_validation->set_rules('role', 'Admin role', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            echo'<div class="alert alert-dismissable alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.  validation_errors().'</div>';
        } else {
            $user['name'] = $this->input->post('name');
            $user['email'] = $this->input->post('email');
            $user['password']= $this->input->post('cpassword');
            $user['role']= $this->input->post('role');
            $user['status']= $this->input->post('status');
            $this->Admin_model->adminCreate($user);
        }
}


public function userList() {
        $data = $this->Admin_model->userList();
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteUser/';
            $urledit = base_url() . 'admin/editUser/';
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
                echo"<tr><td>" . $sr . "</td><td>" . $row->uname . "</td><td>" . $row->email . "</td><td>" . $row->role . "</td><td>" . $row->status . "</td>"
                . "<td><a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Plan added.</td></tr>';
        }
        exit;
    }
    
    public function editUser() {
        $id = $this->input->get_post('id');
		$data['menu_active']="account";
        $data['data'] = $this->Admin_model->editUser($id);
        $data['id'] = $id;
        $this->load->view('admin/user_edit', $data);
    }
    
    
    public function dateDiffter($d1, $d2){
    $datediff = $d1 - $d2;
    return floor($datediff/(60*60*24));
}

public function memberdelcf(){
    $this->load->view('admin/delcf');
}

public function backup() {
    $this->load->dbutil();
    $backup =& $this->dbutil->backup(); 
    $this->load->helper('download');
    force_download('mybackup.zip', $backup);
    redirect('admin/schema');
}

public function setExpireMember($param){
    
     $this->Admin_model->setExpireMember($param);
}
//
public function storeList() {
       $this->Auth_model->isLoggedIn();
		$data["active"]="store";
		$data['menu_active']="account";
        $this->load->view('admin/store_list',$data);
    }
      public function addstore() {
//        var_dump($_POST); exit;  
			$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Store Name ', 'required');
			$this->form_validation->set_rules('contactperson', 'Contact Person Name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[store.store_email]');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('password-repeat', 'Confirm password', 'required|matches[password]');
            

            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				//redirect('store/register');
            } else {
				
                $family['name'] = $this->input->post('name');
				$family['contactperson'] = $this->input->post('contactperson');
				$family['phone1'] = $this->input->post('phone1');
				$family['city'] = $this->input->post('city');
				$family['cord'] = $this->input->post('cord');
				$family['partner'] = $this->input->post('partner');
				$family['email'] = $this->input->post('email');
				$family['password'] = md5($this->input->post('password'));
				$family['status'] = 1;
                if($this->Store_model->storeCreate($family)){
					echo ('<div class="alert alert-dismissable alert-success">Store aded successfully</div>');
					//redirect('store/register');
				}
            }

            exit;
        
    }
    public function editStore() {
		$this->Auth_model->isLoggedIn();
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->getStore($id);
        $data['id'] = $id;
        $this->load->view('admin/store_edit', $data);
    }
	public function deleteStore() {
		$this->Auth_model->isLoggedIn();
        $id = $this->input->get_post('id');
        if($this->Admin_model->storeDelete($id)){
			 $delete = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            This Store deleted successfully!
            </div>';
			echo $delete;
		}
		else{
			echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Internal error!
            </div>';
		}
        
    }
	  public function storeUpdate() {
		  $this->Auth_model->isLoggedIn();
        //$name = $this->input->get_post('name');
		$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Store Name ', 'required');
			$this->form_validation->set_rules('contactperson', 'Contact Person Name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			
            

            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				//redirect('store/register');
            } else {
				$family['id'] = $this->input->get_post('id');
                $family['name'] = $this->input->post('name');
				$family['contactperson'] = $this->input->post('contactperson');
				$family['phone1'] = $this->input->post('phone1');
				$family['city'] = $this->input->post('city');
				$family['partner'] = $this->input->post('partner');
				$family['cord'] = $this->input->post('cord');
				$family['email'] = $this->input->post('email');
				$family['status'] = $this->input->get_post('status');
                if($this->Store_model->storeUpdate($family)){
					echo ('<div class="alert alert-dismissable alert-success">Store Updated successfully</div>');
					//redirect('store/register');
				}
				else{
					echo ('<div class="alert alert-dismissable alert-danger">Nothing to update</div>');
				}
            }

        //$status = 
        //$this->Admin_model->storeUpdateStatus($id, $status);
    }
	public function storeListData() {
		$this->Auth_model->isLoggedIn();
        $data = $this->Admin_model->storeList();
		//$data["active"]="store";
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteStore/';
            $urledit = base_url() . 'admin/editStore/';
			
            foreach ($data->result() as $row) {
				$status="Unpublished";
				if($row->store_status==1){$status="Published";}
				$partner="";
				if($row->redeem_partner==1){$partner="(Partner)";}
                $sr = $sr + 1;
                echo"<tr><td>STR100" . $row->store_id . "</td><td>" . $row->store_name . " <br>".$partner."</td><td>" . $row->store_email . "</td><td>" . $row->phone1 . "</td><td>" . $status . "</td>"
                . "<td><a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->store_id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->store_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Store added.</td></tr>';
        }
        exit;
		
    }
//
private function set_upload_options($file_name)
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = './image_upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = false;
		$config['remove_spaces'] = true;
		$config['file_name'] = $file_name;
	
		return $config;
	}
	private function set_resize_options($file_name)
	{   
		//upload an image options
		$config = array();
		$size = getimagesize($file_name);
		$resize_height=($size[1]*700)/$size[0];
		//Image Resizing
		$config['image_library'] = 'gd2';
		$config['source_image'] = $file_name;
		$config['maintain_ratio'] = TRUE;
		$config['quality']   = 98;
		$config['width'] = 700;
		$config['height']   = $resize_height;
	
		return $config;
	}
public function offerList() {
       $this->Auth_model->isLoggedIn();
		$data["active"]="offer";
		$data['menu_active']="account";
		$data['stores']=$this->Admin_model->storeList();
		$data['categories']=$this->Admin_model->categoryList();
		$data['offers']=$this->Offer_model->offerList();
        $this->load->view('admin/offers',$data);
}
public function deleteOffer() {
       $this->Auth_model->isLoggedIn();
		 $id = $this->input->get_post('id');
		if($this->Admin_model->deleteOffer($id)){
			$this->session->set_flashdata('delete','<div class="alert alert-dismissable alert-success">Offer deleted successfully.</div>');
		}
		else{
			$this->session->set_flashdata('delete','<div class="alert alert-dismissable alert-danger">Error Occured.</div>');
		}
        //redirect('/admin/offerList');
}
public function addoffer() {
       $this->Auth_model->isLoggedIn();
		$data["active"]="offer";
		$data['menu_active']="account";
		$data['stores']=$this->Admin_model->storeList();
		$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
        $this->load->view('admin/add_offer',$data);
}
	public function submitOffer() {
		//        var_dump($_POST); exit;   
			$this->Auth_model->isLoggedIn(); 
            $this->form_validation->set_rules('ad_title', 'Offer Title ', 'required');
			$this->form_validation->set_rules('ad_description', 'Description ', 'required');
            $this->form_validation->set_rules('ad_gmap_longitude', 'Location ', 'required');
			$this->form_validation->set_rules('ad_gmap_latitude', 'Location ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('ad_category', 'Category', 'required');
			$this->form_validation->set_rules('store', 'Store', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('/admin/addoffer');
            } else {
				//
				$main_img="";
				if($_FILES['main_image']['error'] == 0){
				
					$this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."main_img_".time()));
				
					if ( ! $this->upload->do_upload('main_image'))
					{
						$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						redirect('/admin/addoffer');
					}
					else{
						

						$this->load->library('image_lib', $this->set_resize_options($this->upload->upload_path.$this->upload->file_name));
						
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
						}
						else{
							$main_img=$this->upload->file_name;
						}					
					}
				}
				//
				$off_imgs="";
				if(!empty($_FILES['media_imgs']['name'])){
					//upload and update the file
					$files = $_FILES;
					 $cpt = count($_FILES['media_imgs']['name']);
					 if($cpt > 13) $cpt=13;
					for($i = 0; $i < $cpt; $i++){
					  $_FILES['media_imgs']['name']= $files['media_imgs']['name'][$i];
					  $_FILES['media_imgs']['type']= $files['media_imgs']['type'][$i];
					  $_FILES['media_imgs']['tmp_name']= $files['media_imgs']['tmp_name'][$i];
					  $_FILES['media_imgs']['error']= $files['media_imgs']['error'][$i];
					  $_FILES['media_imgs']['size']= $files['media_imgs']['size'][$i];    
					  
				  
					  $this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."media_imgs_".$i.time()));
				  
					  if ( ! $this->upload->do_upload('media_imgs'))
					  {
						 echo $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						  //redirect('/offer/create');
					  }
					  else{
						 
  
						  $this->load->library('image_lib', $this->set_resize_options($this->upload->upload_path.$this->upload->file_name));
						  
						  if ( ! $this->image_lib->resize()){
							  $this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
						  }
						  else{
							  $off_imgs.=$this->upload->file_name.",";
						  }					
					  }
					}
				}
                $family['title'] = $this->input->post('ad_title');
				$family['description'] = $this->input->post('ad_description');
				$family['location'] = $this->input->post('ad_gmap_longitude').",".$this->input->post('ad_gmap_latitude');
				$family['location_id'] = $this->input->post('set_location');
				$family['category'] = $this->input->post('ad_category');
				$family['tags'] = $this->input->post('ad_tags');
				$family['off_points'] = $this->input->post('ad_points');
				$family['price'] = $this->input->post('ad_price');
				$family['off_price'] = $this->input->post('ad_off_price');
				$family['call_price'] = $this->input->post('ad_call_for_price');
				$family['phone'] = $this->input->post('ad_phone');
				$family['featured'] = $this->input->post('ad_featured');
				$family['main_img'] = $main_img;
				$family['off_imgs'] = rtrim($off_imgs,",");
				$family['off_videos'] = ltrim(implode(",",$this->input->post('ad_videos')),",");
				
				$family['store_id'] = $this->input->post('store');
				$family['status'] = 1;
                if($this->Offer_model->offerCreate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">The offer added Successfully.</div>');
					redirect('/admin/addoffer');
				}
            }

            exit;
        
    }
	public function editoffer() {
		if($this->uri->segment(3)){
		   $this->Auth_model->isLoggedIn();
			$data["active"]="offer";
			$data['menu_active']="account";
			$offer_id = $this->uri->segment(3);
			$data['offer_data'] = $this->Offer_model->getoffer($offer_id);
			$data['categories']=$this->Admin_model->categoryList();
			$data['locations']=$this->Admin_model->locationList();
			$data['stores']=$this->Admin_model->storeList();
			$this->load->view('admin/edit_offer',$data);
		}
	}
	public function updateOffer() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('ad_title', 'Offer Title ', 'required');
			$this->form_validation->set_rules('ad_description', 'Description ', 'required');
            $this->form_validation->set_rules('ad_gmap_longitude', 'Location ', 'required');
			$this->form_validation->set_rules('ad_gmap_latitude', 'Location ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('ad_category', 'Category', 'required');
			$this->form_validation->set_rules('store', 'Store', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('admin/editOffer/'.$this->input->post('offer_id'));
            } else {
				//
				$main_img=$this->input->post('old_img');
				if($_FILES['main_image']['error'] == 0){
					
				
					$this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."main_img_".time()));
				
					if ( ! $this->upload->do_upload('main_image'))
					{
						$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						redirect('admin/editOffer/'.$this->input->post('offer_id'));
					}
					else{
						

						$this->load->library('image_lib', $this->set_resize_options($this->upload->upload_path.$this->upload->file_name));
						
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
						}
						else{
							$main_img=$this->upload->file_name;
						}					
					}
				}
				//
				$off_imgs="";$old_cnt=0;
				if($this->input->post('old_off_imgs')){
					$old_cnt=count($this->input->post('old_off_imgs'));
					//var_dump($this->input->post('old_off_imgs'));
					if($old_cnt>0)
						$off_imgs=implode(",",$this->input->post('old_off_imgs'));
					else $off_imgs="";
				}
				//var_dump($off_imgs);
				$off_imgs.=",";
				$req_cnt=13-$old_cnt;
				if(!empty($_FILES['media_imgs']['name'])){
					//upload and update the file
					$files = $_FILES;
					 $cpt = count($_FILES['media_imgs']['name']);
					 if($cpt > $req_cnt) $cpt=$req_cnt;
					for($i = 0; $i < $cpt; $i++){
					  $_FILES['media_imgs']['name']= $files['media_imgs']['name'][$i];
					  $_FILES['media_imgs']['type']= $files['media_imgs']['type'][$i];
					  $_FILES['media_imgs']['tmp_name']= $files['media_imgs']['tmp_name'][$i];
					  $_FILES['media_imgs']['error']= $files['media_imgs']['error'][$i];
					  $_FILES['media_imgs']['size']= $files['media_imgs']['size'][$i];    
					
					  $this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."media_imgs_".$i.time()));
				  
					  if ( ! $this->upload->do_upload('media_imgs'))
					  {
						 echo $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						  //redirect('offer/edit/'.$this->input->post('offer_id'));
						  break;
					  }
					  else{
						 
  
						  $this->load->library('image_lib', $this->set_resize_options($this->upload->upload_path.$this->upload->file_name));
						  
						  if ( ! $this->image_lib->resize()){
							  $this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
						  }
						  else{
							  $off_imgs.=$this->upload->file_name.",";
						  }					
					  }
					}
				}
				$family['offer_id'] = $this->input->post('offer_id');
				//var_dump($off_imgs); exit;
				//var_dump($this->upload->file_name);
                $family['title'] = $this->input->post('ad_title');
				$family['description'] = $this->input->post('ad_description');
				$family['location'] = $this->input->post('ad_gmap_longitude').",".$this->input->post('ad_gmap_latitude');
				$family['location_id'] = $this->input->post('set_location');
				$family['category'] = $this->input->post('ad_category');
				$family['tags'] = $this->input->post('ad_tags');
				$family['off_points'] = $this->input->post('ad_points');
				$family['price'] = $this->input->post('ad_price');
				$family['off_price'] = $this->input->post('ad_off_price');
				$family['call_price'] = $this->input->post('ad_call_for_price');
				$family['phone'] = $this->input->post('ad_phone');
				$family['featured'] = $this->input->post('ad_featured');
				$family['main_img'] = $main_img;
				$family['off_imgs'] = rtrim($off_imgs,",");
				$family['off_videos'] = ltrim(implode(",",$this->input->post('ad_videos')),",");
				
				$family['store_id'] = $this->input->post('store');
				$family['status'] = 1;
                if($this->Offer_model->offerUpdate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">The offer updated Successfully.</div>');
					redirect('admin/editOffer/'.$this->input->post('offer_id'));
				}
            }

            exit;
        
    }
	
	///
	//
	public function categoryList(){
		$this->Auth_model->isLoggedIn();
		$data["active"]="category";
		$data['menu_active']="account";
		$data['categories']=$this->Admin_model->parentcategoryList();
        $this->load->view('admin/categories',$data);
	}
	public function ajaxcategoryList(){
		$this->Auth_model->isLoggedIn();
		$data['categories']=$this->Admin_model->parentcategoryList();
        $this->load->view('admin/parent_categories',$data);
	}
	public function catListData(){
		$this->Auth_model->isLoggedIn();
        $data = $this->Admin_model->categoryList();
		//$data["active"]="store";
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteCategory/';
            $urledit = base_url() . 'admin/editCategory/';
			
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
				$parent="Default Parent";
				if($row->parent_cat!=0){
					$cat=$this->Admin_model->getCategory($row->parent_cat); $cat_data=$cat->result(); 
					$cat_res=$cat_data[0];
					$parent=$cat_res->cat_name;
				}
                echo"<tr><td>" . $row->cat_name . "</td><td>" . $parent . "</td>". "<td>
				<a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->category_id' title='edit'>
				<i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->category_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Category added.</td></tr>';
        }
        exit;
	}
	public function addCategory(){
		 $this->Auth_model->isLoggedIn();
        //$name = $this->input->get_post('name');
			$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Category Name ', 'required|is_unique[categories.cat_name]');
			$this->form_validation->set_rules('cat_parent', 'Parent Category ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');

            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				//redirect('store/register');
            } else {
                $family['cat_name'] = $this->input->post('name');
				$family['cat_parent'] = $this->input->post('cat_parent');
				$family['cat_desc'] = $this->input->post('cat_desc');
				$family['featured'] = $this->input->post('featured');
				
                if($this->Admin_model->addCategory($family)){
					echo ('<div class="alert alert-dismissable alert-success">Category Added successfully</div>');
					//redirect('store/register');
				}
				else{
					echo ('<div class="alert alert-dismissable alert-danger">Error Occured</div>');
				}
            }

	}
	public function editCategory() {
		$this->Auth_model->isLoggedIn();
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->getCategory($id);
		$data['categories']=$this->Admin_model->parentcategoryList();
        $data['id'] = $id;
        $this->load->view('admin/edit_category', $data);
    }
	public function updateCategory(){
		 $this->Auth_model->isLoggedIn();
        //$name = $this->input->get_post('name');
			$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Category Name ', 'required');
			$this->form_validation->set_rules('cat_parent', 'Parent Category ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');

            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				//redirect('store/register');
            } else {
                $family['cat_name'] = $this->input->post('name');
				$family['cat_parent'] = $this->input->post('cat_parent');
				$family['cat_desc'] = $this->input->post('cat_desc');
				$family['featured'] = $this->input->post('featured');
				$family['id'] = $this->input->post('id');
				
                if($this->Admin_model->updateCategory($family)){
					echo ('<div class="alert alert-dismissable alert-success">Category updateded successfully</div>');
					//redirect('store/register');
				}
				else{
					echo ('<div class="alert alert-dismissable alert-danger">Nothing to update</div>');
				}
            }

	}
	public function deleteCategory() {
       $this->Auth_model->isLoggedIn();
		 $id = $this->input->get_post('id');
		if($this->Admin_model->deleteCategory($id)){
			echo('<div class="alert alert-dismissable alert-success">Catrgory deleted successfully.</div>');
		}
		else{
			echo ('<div class="alert alert-dismissable alert-danger">Error Occured.</div>');
		}
        //redirect('/admin/offerList');
	}
	///
	//
	public function locationList(){
		$this->Auth_model->isLoggedIn();
		$data["active"]="location";
		$data['menu_active']="account";
        $this->load->view('admin/locations',$data);
	}
	
	public function locationData(){
		$this->Auth_model->isLoggedIn();
        $data = $this->Admin_model->locationList();
		//$data["active"]="store";
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteLocation/';
            $urledit = base_url() . 'admin/editLocation/';
			
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
				
                echo"<tr><td>" . $row->location_name . "</td><td>
				<a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->location_id' title='edit'>
				<i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->location_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Location added.</td></tr>';
        }
        exit;
	}
	public function addLocation(){
		 $this->Auth_model->isLoggedIn();
			$this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Location Name ', 'required|is_unique[locations.location_name]');
            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
            } else {
                $family['loc_name'] = $this->input->post('name');
				$family['cord'] = $this->input->post('cord');
				
                if($this->Admin_model->addLocation($family)){
					echo ('<div class="alert alert-dismissable alert-success">Location Added successfully</div>');
					//redirect('store/register');
				}
				else{
					echo ('<div class="alert alert-dismissable alert-danger">Error Occured</div>');
				}
            }

	}
	public function editLocation() {
		$this->Auth_model->isLoggedIn();
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->getLocation($id);
        $data['id'] = $id;
        $this->load->view('admin/edit_location', $data);
    }
	public function updateLocation(){
		 $this->Auth_model->isLoggedIn();
        $this->form_validation->set_message('is_unique', 'The %s is already added. Please chose another one');  
            $this->form_validation->set_rules('name', 'Location Name ', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo ('<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
            } else {
                $family['loc_name'] = $this->input->post('name');
				$family['cord'] = $this->input->post('cord');
				$family['id'] = $this->input->post('id');
				
                if($this->Admin_model->updateLocation($family)){
					echo ('<div class="alert alert-dismissable alert-success">Location updateded successfully</div>');
				}
				else{
					echo ('<div class="alert alert-dismissable alert-danger">Nothing to update</div>');
				}
            }

	}
	public function deleteLocation() {
       $this->Auth_model->isLoggedIn();
		 $id = $this->input->get_post('id');
		if($this->Admin_model->deleteLocation($id)){
			echo('<div class="alert alert-dismissable alert-success">Location deleted successfully.</div>');
		}
		else{
			echo ('<div class="alert alert-dismissable alert-danger">Error Occured.</div>');
		}
	}
	/////
	private function str_clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	/////
	public function resetpass() {
		$this->Auth_model->isLoggedIn();
		$data["active"]="edit-pass";
		$data['menu_active']="account";
        $this->load->view('admin/resetpass',$data);
        
    }
	///
	public function storePointList(){
		$this->Auth_model->isLoggedIn();
		$data["active"]="store_points";
		$data['menu_active']="account";
        $this->load->view('admin/store_points',$data);
	}
	
	public function storePointData(){
		$this->Auth_model->isLoggedIn();
        $data = $this->Admin_model->getPointsStore();
		//var_dump($data); exit;
		//$data["active"]="store";
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteStorPoint/';
            $urledit = base_url() . 'admin/approveStorPoint/';
			
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
				$status="New"; $status_edit=1; $approve_text="Approve";
				if($row->status==1){$status="Approved"; $status_edit=0; $approve_text="Cancel Approve";}
                echo"<tr><td>" . $row->store_name . "</td><td>" . $row->points . "</td><td>AED " . $row->amount . "</td><td>" . $status . "</td><td>
				<a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-id='$row->point_id' data-status='$status_edit' title='edit'>
				<i class='glyphicon glyphicon-pencil' title='edit'></i>$approve_text</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->point_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Request.</td></tr>';
        }
        exit;
	}
	public function approveStorPoint() {
       $this->Auth_model->isLoggedIn();
		 $id = $this->input->get_post('id');
		 $status= $this->input->get_post('status');
		if($this->Admin_model->approveStorPoint($id,$status)){
			echo('<div class="alert alert-dismissable alert-success">Store points updated successfully.</div>');
		}
		else{
			echo ('<div class="alert alert-dismissable alert-danger">Error Occured.</div>');
		}
        //redirect('/admin/offerList');
	}
	
	public function userPointData(){
		$this->Auth_model->isLoggedIn();
        $data = $this->Admin_model->getUserOrders(10);
		//var_dump($data); exit;
		//$data["active"]="store";
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteUserPoint/';
            $urledit = base_url() . 'admin/approveUserPoint/';
			
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
				$status="New"; $status_edit=1; $approve_text="Approve";
				if($row->status==1){$status="Approved"; $status_edit=0; $approve_text="Cancel Approve";}
                echo"<tr><td>" . $row->fname." ".$row->lname." </td><td>" . $row->store_name . "</td><td><a data-url='".base_url()."image_upload/".$row->bill_img."' class=' btn-sm pop_bill' data-toggle='modal' data-target='#imgModal' >View Bill</td><td>AED " . $row->order_amount . "</td><td>" . $status . "</td><td>
				<a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-id='$row->order_id' data-status='$status_edit' title='edit'>
				$approve_text</a><br><br><a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->order_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Location added.</td></tr>';
        }
        exit;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */