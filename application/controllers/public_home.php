<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_home extends CI_Controller {

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
        $this->load->model('User_model');
        $this->load->Model('Offer_model');
		$this->load->model('Admin_model');
		$this->load->Model('Auth_model');
    }
	public function index()
	{
		$data['offers'] = $this->Offer_model->offerList();
		$data['menu_active']="home";
		$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
		$this->load->view('public/index',$data);
	}
	public function how_to()
	{
		$data['menu_active']="how_to";
		$this->load->view('public/how_to',$data);
	}
	public function subscribe()
	{
		$message="";
		$this->form_validation->set_message('is_unique', '<span style="color:green">You are already subscribed</span>');
        $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[subscribers.sub_mail]');
		if ($this->form_validation->run() == FALSE) {
			$message='<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>';
		} else {
			$family['email'] = $this->input->post('email');
			if($this->Admin_model->createSubscribe($family)){
				$message='<span style="color:green">Thank you for subscribing to us</span>';
			}
			else{
				$message='Error Occured';
			}
		}
		$response = array('message'=>$message);
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function dash()
	{
		$this->User_model->isLoggedIn();
		$data['active']="dash";
		$data['menu_active']="account";
		$user=$this->session->userdata('user_id');
		$data['points']=$this->User_model->getPointsUser($user);
		$data['redeem']=$this->User_model->getRedeemUser($user);
		$this->load->view('public/home', $data);
	}
	 public function lost_pass()
	{
            
            if ($this->input->is_ajax_request()) {
                
                $email = $this->input->get_post('email');
             if($this->Auth_model->sendForgetPass($email,'member')){
                 echo'true';
             }else{
                 echo'false';
             }
            exit;
            }
            $this->load->view('public/forgetpass');
            
	}
	public function add_point()
	{
		$this->User_model->isLoggedIn();
		$data['active']="add-point";
		$data['menu_active']="add-point";
		$data['stores']=$this->Admin_model->storeList();
		$this->load->view('public/add-point', $data);
	}
	public function submit_point() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('store', 'Store ', 'required');
			$this->form_validation->set_rules('amount', 'Bill Amount ', 'required');
            $this->form_validation->set_rules('store_conf', 'Store Confirmation', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('user/add-point');
            } else {
				//
				$bill_img="";
				if($_FILES['bill_image']['error'] == 0){
					
					$this->load->library('upload', $this->set_upload_options("bill_image_".time()));
				
					if ( ! $this->upload->do_upload('bill_image'))
					{
						$this->session->set_flashdata('error', '<div class="alert alert-dismissable alert-danger">'.$this->upload->display_errors('', '').'</div>');
						redirect('user/add-point');
					}
					else{

						$this->load->library('image_lib', $this->set_resize_options($this->upload->upload_path.$this->upload->file_name));
						
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
						}
						else{
							$bill_img=$this->upload->file_name;
						}					
					}
					$family['store'] = $this->input->post('store');
					$family['user_id'] = $this->session->userdata('user_id');
					$family['amount'] = $this->input->post('amount');
					$family['points'] = $this->input->post('amount')*(10/100);
					$family['bill_img'] = $bill_img;
					$family['store_cnf'] = $this->input->post('store_conf');
					
					if($this->User_model->addPoint($family)){
						$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">Thank you for submiting the Order. You request will be processed soon.</div>');
						redirect('user/add-point');
					}
				}
				else{
					$this->session->set_flashdata('error', '<div class="alert alert-dismissable alert-danger">Bill image cannot be uploaded</div>');
						redirect('user/add-point');
				}
                
            }

            exit;
        
    }
	public function redeem_point()
	{
		$this->User_model->isLoggedIn();
		$data['active']="redeem-point";
		$data['menu_active']="redeem-point";
		$user=$this->session->userdata('user_id');
		$data['points']=$this->User_model->getPointsUser($user);
		$data['redeem']=$this->User_model->getRedeemUser($user);
		$data['stores']=$this->Admin_model->storeList();
		$this->load->view('public/redeem-point', $data);
	}
	public function order_history()
	{
		$this->User_model->isLoggedIn();
		$data['active']="order-history";
		$data['menu_active']="account";
		$data['stores']=$this->Admin_model->storeList();
		$user=$this->session->userdata('user_id');
		$data['points']=$this->User_model->getPointsUser($user);
		$data['redeem']=$this->User_model->getRedeemUser($user);
		$this->load->view('public/history', $data);
	}
	
	
	
	public function profile()
	{
		$this->User_model->isLoggedIn();
		$data['active']="profile";
		$data['menu_active']="account";
		$id=$this->session->userdata('user_id'); 
		$data['data'] = $this->User_model->getUser($id);
		$this->load->view('public/profile', $data);
	}
	public function login()
	{
		session_start();
		$this->load->view('public/login');
	}
	public function login_check() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('username', 'Username/Email ', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('user/login');
            } else {
                $log=$this->User_model->login($this->input->post('username'),$this->input->post('password'));
				if($log){
					redirect('user/dash');
				}
				else{
					$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
				redirect('user/login');
				}
            }

            exit;
        
    }
	public function fb_login() {
		session_start();
		
//        
			require_once  APPPATH.'../asset/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
			$fb = new Facebook\Facebook([
			  'app_id' => '1364443700312845', // Replace {app-id} with your app id
			  'app_secret' => '2bbd79281252def07e0f877340112c77',
			  'default_graph_version' => 'v2.2',
			  ]);
			
			$helper = $fb->getRedirectLoginHelper();
			
			try {
			  $accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			
			if (! isset($accessToken)) {
			  if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			  } else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			  }
			  exit;
			}
			
			// Logged in
			//echo '<h3>Access Token</h3>';
			//var_dump($accessToken->getValue());
			
			// The OAuth 2.0 client handler helps us manage access tokens
			$oAuth2Client = $fb->getOAuth2Client();
			
			// Get the access token metadata from /debug_token
			$tokenMetadata = $oAuth2Client->debugToken($accessToken);
			//echo '<h3>Metadata</h3>';
			//var_dump($tokenMetadata);
			
			// Validation (these will throw FacebookSDKException's when they fail)
			$tokenMetadata->validateAppId('1364443700312845'); // Replace {app-id} with your app id
			// If you know the user ID this access token belongs to, you can validate it here
			//$tokenMetadata->validateUserId('123');
			$tokenMetadata->validateExpiration();
			
			if (! $accessToken->isLongLived()) {
			  // Exchanges a short-lived access token for a long-lived one
			  try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			  } catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			  }
			
			  echo '<h3>Long-lived</h3>';
			  var_dump($accessToken->getValue());
			}
			
			$_SESSION['fb_access_token'] = (string) $accessToken;
			
			
			
			try {
			  // Returns a `Facebook\FacebookResponse` object
			  $response = $fb->get('/me?fields=id,name,email,gender', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			
			$user = $response->getGraphUser();
			if($user['email']!=NULL){
				if($this->User_model->fbUserUniq($user['id'])){
					$log=$this->User_model->login($user['email'],'0');
					if($log){
						redirect('user/dash');
					}
					else{
						$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
						redirect('user/login');
					}
				}
				else{
					if ( preg_match('/\s/',$user['name']) ) {
						list($firstname, $lastname) = explode(' ', $user['name'], 2);
					}
					else{
						$firstname=$user['name']; $lastname="";
					}
					if($lastname==NULL){$lastname="";}
					$family['firstname'] = $firstname;
					$family['user_email'] = $user['email'];
					$family['lastname'] = $lastname;
					//
					  $family['password'] = md5('0');
					//
					$family['fb_id'] = $user['id'];
					$family['gender'] = $user['gender'];
					$family['address'] = "";
					$family['area'] = "";
					$family['telephone'] = "";
					$family['telephone2'] = "";
	//             
					if($this->User_model->userCreate($family)){
						$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success"><small>Thank you for registering with us. Welcome to Offerredeem</small></div>');
						$log=$this->User_model->login($user['email'],'0');
						if($log){
							redirect('user/dash');
						}
						else{
							$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
							redirect('user/login');
						}
	
					}
				}
			}
			else{
				$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">No valid email found on your facebook/div>');
				redirect('user/login');
			}
///
            exit;
        
    }
	public function register(){
		$this->form_validation->set_rules('name', 'Full name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[member.user_email]');
			//
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');
			

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>');
				redirect('user/login');
            } else {
//                        general information
				if ( preg_match('/\s/',$this->input->post('name')) ) {
					list($firstname, $lastname) = explode(' ', $this->input->post('name'), 2);
				}
				else{
					$firstname=$this->input->post('name'); $lastname="";
				}
				if($lastname==NULL){$lastname="";}
                $family['firstname'] = $firstname;
                $family['user_email'] = $this->input->post('email');
                $family['lastname'] = $lastname;
				//
				  $family['password'] = md5($this->input->post('password'));
				//
				$family['fb_id'] = "";
                $family['gender'] = $this->input->post('gender');
                $family['address'] = $this->input->post('address');
                $family['area'] = $this->input->post('area');
                $family['telephone'] = $this->input->post('telephone');
                $family['telephone2'] = $this->input->post('telephone2');
//             
                if($this->User_model->userCreate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success"><small>Thank you for registering with us. Welcome to Offerredeem</small></div>');
					$log=$this->User_model->login($this->input->post('email'),$this->input->post('password'));
					if($log){
						redirect('user/dash');
					}
					else{
						$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
						redirect('user/login');
					}

				}
				else{
					 $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Failed. Error occured</small></div>');
					 redirect('user/login');
				}
            }

	}
	//
	public function logout(){
            $this->session->sess_destroy();
            header("cache-Control: no-store, no-cache, must-revalidate");
            header("cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            redirect('user/' ,'refresh');
            exit;
      }
	  //////
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
	private function str_clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	////
	///
	//api
	public function mobile_register(){
		$_POST['name'] = $this->input->get_post('name');
		$_POST['email'] = $this->input->get_post('email');
		$_POST['password'] = $this->input->get_post('password');
		$_POST['conf_password'] = $this->input->get_post('conf_password');
		$this->form_validation->set_rules('name', 'Full name ', 'required');
            $this->form_validation->set_rules('email', 'Email ', 'required|valid_email|is_unique[member.user_email]');
			//
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');
			
	//echo $this->input->get_post('name');
            if ($this->form_validation->run() == FALSE) {
                //$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>');
				//redirect('user/login');
				$status="Failed";
				$message="Error Occured: ".validation_errors();
            } else {
//                        general information
				if ( preg_match('/\s/',$this->input->get_post('name')) ) {
					list($firstname, $lastname) = explode(' ', $this->input->get_post('name'), 2);
				}
				else{
					$firstname=$this->input->get_post('name'); $lastname="";
				}
				if($lastname==NULL){$lastname="";}
                $family['firstname'] = $firstname;
                $family['user_email'] = $this->input->get_post('email');
                $family['lastname'] = $lastname;
				//
				  $family['password'] = md5($this->input->get_post('password'));
				//
				$family['fb_id'] = "";
                $family['gender'] = $this->input->get_post('gender');
                $family['address'] = $this->input->get_post('address');
                $family['area'] = $this->input->get_post('area');
                $family['telephone'] = $this->input->get_post('telephone');
                $family['telephone2'] = $this->input->get_post('telephone2');
//             
                if($this->User_model->userCreate($family)){
					//$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success"><small>Thank you for registering with us. Welcome to Offerredeem</small></div>');
					/*$log=$this->User_model->login($this->input->get_post('email'),$this->input->get_post('password'));
					if($log){
						redirect('user/dash');
					}
					else{
						$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
						//redirect('user/login');
					}*/
					$status="Success";
					$message="Registration done Successfully";

				}
				else{
					// $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Failed. Error occured</small></div>');
					 //redirect('user/login');
					 $status="Failed";
					$message="Error Occured";
					 
				}
				
            }
			$data_res = array(
				  'message' => $message,
				  'status'  => $status
				);
				echo json_encode($data_res);

	
	}
	
	public function mobile_login() {
//        var_dump($_POST); exit;  
			$_POST['email'] = $this->input->get_post('email');
			$_POST['password'] = $this->input->get_post('password');  
            $this->form_validation->set_rules('email', 'Username/Email ', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
			$user_data=array();
            if ($this->form_validation->run() == FALSE) {
                //$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				//redirect('user/login');
				$status="Failed";
				$message="Error Occured: ".validation_errors();
            } else {
                $log=$this->User_model->login($this->input->post('username'),$this->input->post('password'));
				if($log){
					//redirect('user/dash');
					$status="Success";
					$message="Login successfully";
					$user_data=array(
						'user_id' => $this->session->userdata('user_id'),
						'name' => $this->session->userdata('user_name')
					);
					
				}
				else{
					//$this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger"><small>Invalid Username/Password</small></div>');
					//redirect('user/login');
					$status="Failed";
					$message="Error Occured ";
					
				}
				
            }

            $data_res = array(
			  'message' => $message,
			  'status'  => $status,
			  'user_data' => $user_data
			);
			echo json_encode($data_res);
        
    }
	public function mobile_user_data()
	{
		//$this->User_model->isLoggedIn();
		if($this->input->get_post('user_id')!=""){
			$id=$this->input->get_post('user_id');
		}
		else{
			$id=$this->session->userdata('user_id');
		}
		$points=$this->User_model->getPointsUser($id);
		$redeem=$this->User_model->getRedeemUser($id);
		$points_res=0; $redeem_res=0;
		foreach($points->result() as $point){ 
			if($point->status=="1"){
				$points_res=$points_res+$point->order_points;
			}
		}
		foreach($redeem->result() as $red){ 
			if($red->status=="1"){
				$redeem_res=$redeem_res+$red->points;
			}
		}
		$points_res=$points_res-$redeem_res;
		$data = $this->User_model->getUser($id);
		$message="No data available";
		$status="Failed";
		$user_data=array();
		foreach($data->result() as $row){
			$user_data[]=array(
					'user_id' => $row->id,
					'name' => $row->fname." ".$row->lname,
					'email' => $row->user_email,
					'gender' => $row->gender,
					'address' => $row->area,
					'redeemed' => $redeem_res,
					'avail_points' => $points_res,
					'aed_value' => $points_res*(10/100)
					
			);
			$status="Success";
			$message="User Data Available";
		}
		$data_res = array(
			  'message' => $message,
			  'status'  => $status,
			  'user_data' => $user_data
			);
		echo json_encode($data_res);
	}
	public function purchase_history()
	{
		if($this->input->get_post('user_id')!=""){
			$user=$this->input->get_post('user_id');
		}
		else{
			$user=$this->session->userdata('user_id');
		}
		$points=$this->User_model->getPointsUser($user);
		$redeem=$this->User_model->getRedeemUser($user);
		$message="No History available";
		$status="Failed";
		$order_data=array();
		foreach($points->result() as $row){
			$order_data[]=array(
				'order_id' => $row->order_id,
				'store_id' => $row->order_store,
				'amount' => $row->order_amount,
				'order_points' => $row->order_points,
				'date' => $row->created,
				'status' => $row->status
			);
			$status="Success";
			$message="Purchase Data Available";
		}
		$data_res = array(
			  'message' => $message,
			  'status'  => $status,
			  'order_data' => $order_data
			);
		echo json_encode($data_res);
	}
	
	//api
	///
	////
	
	
	  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */