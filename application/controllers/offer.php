<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller {

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
		$this->load->model('Admin_model');
    }
	
	public function index()
	{
		redirect('offers');
	}
	public function search()
	{
		$data['cat_id']=$this->input->post('category');
		$data['key']=$this->input->post('keyword');
		$data['loc_id']=$this->input->post('location');
		$data['offers'] = $this->Offer_model->offerSearch($data['cat_id'],$data['key'],$data['loc_id']);
		$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
		$data['menu_active']="offers";
		$this->load->view('public/search', $data);
	}
	public function offerdata()
	{
		//echo $this->uri->segment(2); 
		if($this->uri->segment(2)){
			$id = $this->uri->segment(2);
			$data['offer'] = $this->Offer_model->getoffer($id);
			$store_id=$data['offer']->result()[0]->store_id;
			$cat_id=$data['offer']->result()[0]->off_category;
			$data['rel_offers']=$this->Offer_model->catList($cat_id,3);
			$data['store'] = $this->Store_model->getStore($store_id);
			$data['categories']=$this->Admin_model->categoryList();
			$data['locations']=$this->Admin_model->locationList();
			$data['menu_active']="offers";
			$this->load->view('public/offer-details',$data);
		}
		else redirect('offers');
	}
	public function offers()
	{
		$data['offers'] = $this->Offer_model->offerList();
		$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
		$data['menu_active']="offers";
		$this->load->view('public/offers',$data);
	}
	
	public function add()
	{
		$this->Store_model->isLoggedIn();
		$id = $this->session->userdata('store_id');
        $data['data'] = $this->Store_model->getStore($id);
		$data['active']="add_offer";
		$data['menu_active']="account";
		$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
		$this->load->view('store/add-offer',$data);
	}
	public function edit()
	{
		if($this->uri->segment(3)){
			$this->Store_model->isLoggedIn();
			$id = $this->session->userdata('store_id');
			$data['data'] = $this->Store_model->getStore($id);
			$offer_id = $this->uri->segment(3);
			$data['offer_data'] = $this->Offer_model->getoffer($offer_id);
			$data['active']="offers";
			$data['menu_active']="account";
			$data['categories']=$this->Admin_model->categoryList();
		$data['locations']=$this->Admin_model->locationList();
			$this->load->view('store/edit-offer',$data);
		}
		else redirect('store');
	}
	public function submit() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('ad_title', 'Offer Title ', 'required');
			$this->form_validation->set_rules('ad_description', 'Description ', 'required');
            $this->form_validation->set_rules('ad_gmap_longitude', 'Location ', 'required');
			$this->form_validation->set_rules('ad_gmap_latitude', 'Location ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('ad_category', 'Category', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('offer/create');
            } else {
				//
				$main_img="";
				if($_FILES['main_image']['error'] == 0){
					//upload and update the file
					/*$config['upload_path'] = './image_upload/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['file_name'] = $this->input->post('ad_title')."main_img".time();*/
					
					//$config['max_size']	= '100';// in KB
				
					$this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."main_img_".time()));
				
					if ( ! $this->upload->do_upload('main_image'))
					{
						$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						redirect('/offer/create');
					}
					else{
						/*$source=$this->upload->upload_path.$this->upload->file_name;
						$size = getimagesize($source);
        				$resize_height=($size[1]*700)/$size[0];
						//Image Resizing
						$config['image_library'] = 'gd2';
						$config['source_image'] = $source;
						$config['maintain_ratio'] = TRUE;
						$config['quality']   = 98;
						$config['width'] = 700;
						$config['height']   = $resize_height;*/

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
					  //
					 /* $config['upload_path'] = './image_upload/';
					  $config['allowed_types'] = 'gif|jpg|png|jpeg';
					  $config['overwrite'] = false;
					  $config['remove_spaces'] = true;
					  $config['file_name'] = $this->input->post('ad_title')."media_imgs_".$i.time();*/
					  
					  //$config['max_size']	= '100';// in KB
				  
					  $this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."media_imgs_".$i.time()));
				  
					  if ( ! $this->upload->do_upload('media_imgs'))
					  {
						 echo $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						  //redirect('/offer/create');
					  }
					  else{
						  /*$source=$this->upload->upload_path.$this->upload->file_name;
						  $size = getimagesize($source);
						  $resize_height=($size[1]*700)/$size[0];
						  //Image Resizing
						  $config['image_library'] = 'gd2';
						  $config['source_image'] = $source;
						  $config['maintain_ratio'] = TRUE;
						  $config['quality']   = 98;
						  $config['width'] = 700;
						  $config['height']   = $resize_height;*/
  
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
				
				$family['store_id'] = $this->session->userdata('store_id');
				$family['status'] = 1;
                if($this->Offer_model->offerCreate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">The offer added Successfully.</div>');
					redirect('offer/create');
				}
            }

            exit;
        
    }
	public function update() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('ad_title', 'Offer Title ', 'required');
			$this->form_validation->set_rules('ad_description', 'Description ', 'required');
            $this->form_validation->set_rules('ad_gmap_longitude', 'Location ', 'required');
			$this->form_validation->set_rules('ad_gmap_latitude', 'Location ', 'required');
			//$this->form_validation->set_rules('email', 'Email','val_exists[store.store_email]');
			$this->form_validation->set_rules('ad_category', 'Category', 'required');
            

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error','<div class="alert alert-dismissable alert-danger">' . validation_errors() . '</div>');
				redirect('offer/edit/'.$this->input->post('offer_id'));
            } else {
				//
				$main_img=$this->input->post('old_img');
				if($_FILES['main_image']['error'] == 0){
					
				
					$this->load->library('upload', $this->set_upload_options($this->str_clean($this->input->post('ad_title'))."main_img_".time()));
				
					if ( ! $this->upload->do_upload('main_image'))
					{
						$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						redirect('offer/edit/'.$this->input->post('offer_id'));
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
				
				$family['store_id'] = $this->session->userdata('store_id');
				$family['status'] = 1;
                if($this->Offer_model->offerUpdate($family)){
					$this->session->set_flashdata('success','<div class="alert alert-dismissable alert-success">The offer updated Successfully.</div>');
					redirect('offer/edit/'.$this->input->post('offer_id'));
				}
            }

            exit;
        
    }
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
	
	////////
	///apis
	public function get_all_offers()
	{
		$store=$this->input->get('store_id');
		$cat=$this->input->get('cat_id');
		if($store!=NULL && $store!=""){
			$data['offers']=$this->Offer_model->storeOfferList($store);
		}
		else if($cat!=NULL && $cat!=""){
			$data['offers']=$this->Offer_model->offerSearch($cat);
		}
		else{
			$data['offers'] = $this->Offer_model->offerList();
		}
		//$data['categories']=$this->Admin_model->categoryList();
		//$data['locations']=$this->Admin_model->locationList();
		//$data['menu_active']="offers";
		$this->load->view('public/get_all_offers',$data);
	}
	public function get_all_categories()
	{
		$data['categories']=$this->Admin_model->categoryList();
		$this->load->view('public/get_all_categories',$data);
	}
	
	
	/////apis
	/////
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */