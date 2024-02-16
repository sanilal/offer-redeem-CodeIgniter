<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct() {
        parent::__construct();
        $this->load->model('Store_model');
        $this->load->Model('Offer_model');
    }
	
	public function index()
	{
		/*$this->Store_model->isLoggedIn();
		$id = $this->session->userdata('store_id');
        $data['data'] = $this->Store_model->getStore($id);
		$data['menu_active']="account";
		$data['active']="offers";
		$this->load->view('store/home',$data);*/
		redirect('store/home');
	}
	public function home()
	{
		$this->Store_model->isLoggedIn();
		$id = $this->session->userdata('store_id');
        $data['data'] = $this->Store_model->getStore($id);
		$data['offers']=$this->Offer_model->storeOfferList($id);
		$data['active']="offers";
		$data['menu_active']="account";
		$this->load->view('store/home',$data);
	}
	
	public function profile()
	{
		$this->Store_model->isLoggedIn();
		$id = $this->session->userdata('store_id');
        $data['data'] = $this->Store_model->getStore($id);
		$data['active']="profile";
		$data['menu_active']="account";
		$this->load->view('store/profile',$data);
	}
	 public function login()
	{
            $this->load->view('store/login');
	}
	
	public function login_check() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('username', 'Username/Email ', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('store/login');
            } else {
                $log=$this->Store_model->login($this->input->post('username'),$this->input->post('password'));
				if($log){
					redirect('store/home');
				}
				else{
					$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
				redirect('store/login');
				}
            }

            exit;
        
    }
	public function register()
	{
            $this->load->view('store/register');
	}
    public function addstore() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('name', 'Store Name ', 'required');
			$this->form_validation->set_rules('contactperson', 'Contact Person Name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[store.store_email]');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('password-repeat', 'Confirm password', 'required|matches[password]');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('store/register');
            } else {
				
                $family['name'] = $this->input->post('name');
				$family['contactperson'] = $this->input->post('contactperson');
				$family['phone1'] = $this->input->post('phone1');
				$family['city'] = $this->input->post('city');
				$family['cord'] = $this->input->post('cord');
				$family['email'] = $this->input->post('email');
				$family['password'] = md5($this->input->post('password'));
				$family['partner'] = 0;
				$family['status'] = 1;
                if($this->Store_model->storeCreate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">Thank you for registering with us. Please <a htef="store/login">Login</a> to submit offers.</div>');
					redirect('store/register');
				}
            }

            exit;
        
    }
	
	//
	public function points()
	{	
		$this->Store_model->isLoggedIn();
		$data['active']="points";
		$data['menu_active']="account";
		$id = $this->session->userdata('store_id');
		$data['points']=$this->Store_model->getPointsStore($id);
		$data['data'] = $this->Store_model->getStore($id);
        $this->load->view('store/points',$data);
	}
	public function add_point()
	{	
		$this->Store_model->isLoggedIn();
		 $this->form_validation->set_rules('points', 'Points ', 'required');
		$this->form_validation->set_rules('confirm', 'Confirmation ', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('store/points');
            } else {
				//
				$family['store_id'] =  $this->session->userdata('store_id');
				$family['points'] = $this->input->post('points');
				$family['amount'] = $this->input->post('points')*(10/100);
				$family['status']=0;
				if($this->Store_model->addPoint($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">Points submited Successfully. Please wait for the approval</div>');
					redirect('store/points');
				}
				else{
					$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">Error occured.</div>');
					redirect('store/points');
				}
				
            }

            exit;
	}
	//
	public function logout(){
            $this->session->sess_destroy();
            header("cache-Control: no-store, no-cache, must-revalidate");
            header("cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            redirect('store/' ,'refresh');
            exit;
        }
		
	////////
	///apis
	public function get_stores()
	{
		$store=$this->input->get_post('store_id');
		if($store!=NULL && $store!=""){
			$stores=$this->Store_model->getStore($store);
		}
		else{
			$this->load->model('Admin_model');
			$stores = $this->Admin_model->storeList();
		}
		$store_data=array();
		$status="Failed";
		$message="No Store found";
		foreach($stores->result() as $row){
			$store_data[]=array(
					'store_id' => $row->store_id,
					'name' => $row->store_name,
					'store_city' => $row->store_city,
					'contact_person' => $row->contact_person,
					'store_email' => $row->store_email,
					'phone' => $row->phone1,
					'redeem_partner' => $row->redeem_partner
					
			);
			$status="Success";
			$message="Store Data Available";
		}
		$data_res = array(
			  'message' => $message,
			  'status'  => $status,
			  'store_data' => $store_data
			);
		echo json_encode($data_res);
	}
	
	
	/////apis
	/////
	
}