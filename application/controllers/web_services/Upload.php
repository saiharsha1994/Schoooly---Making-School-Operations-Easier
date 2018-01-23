<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Upload extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
	}

	/*$config['upload_path']='uploads/Image/';
		//$Type=$this->post('Type');
		 
		$config['allowed_types'] = '*'; 
		
		$field_name = "image";
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload($field_name)){
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}*/
	function uploads_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/Image/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsAudio_post()
	{
		/*$config['upload_path']='uploads/Audio/';
		
		$config['allowed_types'] = '*'; // add the asterisk instead of extensions
		
		$field_name = "image";
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload($field_name)){
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}*/
		
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/Audio/';
        $config['allowed_types'] =  '*';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
	}
	
	function uploadsVideo_post()
	{
		/*$config['upload_path']='uploads/Video/';
		
		$config['allowed_types'] = '*'; // add the asterisk instead of extensions
		
		$field_name = "image";
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload($field_name)){
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}*/
		
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/Video/';
        $config['allowed_types'] =  '*';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
	}
	
	function uploadsDriverImage_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/driver_image/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsDriverDocument_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/driver_document/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsBusDocument_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/bus_document/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsContractDocument_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/contract_document/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsAccidentReport_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/accidents/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsPettyCash_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/petty_cash/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsExitReEntryDocument_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/exit_reentry/';
        $config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
	function uploadsBankReceiptFee_post()
	{
		$this->load->library('upload');
        $config['upload_path']   =  'uploads/student_document/';
	$config['allowed_types'] =  'jpg|jpeg|PNG|png|pdf|doc|docx|xlsx|csv';
        
        $this->upload->initialize($config);
        if ( $this->upload->do_upload('image')){
			$data = array('upload_data' => $this->upload->data());
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr']=$data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = $this->upload->display_errors();
			$this->response($ret_val, 400);
		}
			
		//$upload_data = $this->upload->data();

        //$data['image'] = $_FILES['image']['name'];
	}
	
}
?>