<?php
class Forgot_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}

	function checkEmailAndSendMail($email)
	{
		$this -> db -> select('parent_id, name, email');
		$this -> db -> from(TABLE_PARENTS);
		$this -> db -> where('email', $email);
		$query = $this -> db -> get();
	
		if($query->num_rows() > 0) {
			$parent_id="";
			foreach ($query->result_array() as $row) {
				$parent_id= $row['parent_id'];
			}
			//Generate Auth Code
			$AuthCode_Gen = md5($parent_id.date("Y-m-d H:i:s"));
			$Forgot_Auth_Code = substr($AuthCode_Gen,0,5);
			//Update Forgot_Auth_Code in table
			$this->db->where('parent_id', $parent_id);
			$this->db->where('email', $email);
			$this->db->set('Forgot_Auth_Code', $Forgot_Auth_Code, TRUE);
			if($this->db->update(TABLE_PARENTS))
			{
				$this->load->library('email');
				
				$this->email->initialize(array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://md-in-13.webhostbox.net',
				  'smtp_user' => 'noreply@al-amaanah.com',
				  'smtp_pass' => 'open@123',
				  'smtp_port' => '465',
				  'crlf' => "\r\n",
				  'newline' => "\r\n",
				  'mailtype' => 'html'
				));
				
				$this->email->from('noreply@al-amaanah.com', 'Tifly Pro');
				$this->email->to($email);
				$this->email->subject('Password Reset | Tifly');
				$email_body = "<p>Dear User,</p>"." <p>&nbsp;You have enabled <b>Forgot Password</b> option in your App.</p><p>&nbsp;Kindly enter the following <b>Auth Code : ".$Forgot_Auth_Code."</b> in your App to reset your password.</p>";				
				$this->email->message($email_body);
				$this->email->send();
				return 1;
				//$this->email->print_debugger();
			}
		}
		else{
			return 0;
		}
	}
	
	function UpdatePassword($email,$Forgot_Auth_Code,$New_Password)
	{
		$this -> db -> select('parent_id, email');
		$this -> db -> from(TABLE_PARENTS);
		$this -> db -> where('email', $email);
		$this -> db -> where('Forgot_Auth_Code', $Forgot_Auth_Code);
		$query = $this -> db -> get();
		$parent_id=$query->row('parent_id');
		if($query->num_rows() > 0) {
			$this->db->where('parent_id', $parent_id);
			$this->db->where('email', $email);
			$this->db->set('password', $this->apicrypter->encrypt($New_Password), TRUE);
			$this->db->update(TABLE_PARENTS);
			return 1;
		}else{
			return 0;
		}
	}
	
	function checkEmailAndSendMail_Teacher($Teacher_Email)
	{
		$this -> db -> select('emp_id AS teacher_id, email,login');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Teacher_Email);
		$query = $this -> db -> get();
	
		if($query->num_rows() > 0) {
			$teacher_id="";
			foreach ($query->result_array() as $row) {
				$teacher_id= $row['teacher_id'];
			}
			//Generate Auth Code
			$AuthCode_Gen = md5($teacher_id.date("Y-m-d H:i:s"));
			$Forgot_Auth_Code = substr($AuthCode_Gen,0,5);
			//Update Forgot_Auth_Code in table
			$this->db->where('emp_id', $teacher_id);
			$this->db->where('login', $Teacher_Email);
			$this->db->set('Forgot_Auth_Code', $Forgot_Auth_Code, TRUE);
			if($this->db->update('employee_details'))
			{
				$this->load->library('email');
				
				$this->email->initialize(array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://md-in-13.webhostbox.net',
				  'smtp_user' => 'noreply@al-amaanah.com',
				  'smtp_pass' => 'open@123',
				  'smtp_port' => '465',
				  'crlf' => "\r\n",
				  'newline' => "\r\n",
				  'mailtype' => 'html'
				));
				
				$this->email->from('noreply@al-amaanah.com', 'Schoooly');
				$this->email->to($Teacher_Email);
				$this->email->subject('Password Reset | Schoooly');
				$email_body = "<p>Dear Teacher,</p>"." <p>&nbsp;You have enabled <b>Forgot Password</b> option in your App.</p><p>&nbsp;Kindly enter the following <b>Auth Code : ".$Forgot_Auth_Code."</b> in your App to reset your password.</p>";				
				$this->email->message($email_body);
				$this->email->send();
				return 1;
				//$this->email->print_debugger();
			}
		}
		else{
			return 0;
		}
	}
	
	function UpdatePassword_Teacher($Teacher_Email,$Forgot_Auth_Code,$New_Password)
	{
		$this -> db -> select('emp_id AS teacher_id, email, login');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Teacher_Email);
		$this -> db -> where('Forgot_Auth_Code', $Forgot_Auth_Code);
		$query = $this -> db -> get();
		$teacher_id=$query->row('teacher_id');
		if($query->num_rows() > 0) {
			$this->db->where('emp_id', $teacher_id);
			$this->db->where('login', $Teacher_Email);
			$this->db->set('password', $this->apicrypter->encrypt($New_Password), TRUE);
			$this->db->update('employee_details');
			return 1;
		}else{
			return 0;
		}
	}
	
	
	function checkEmailAndSendMail_Transport($Email)
	{
		$this -> db -> select('emp_id AS trans_admin_id, email, login');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Email);
		$query = $this -> db -> get();
	
		if($query->num_rows() > 0) {
			$Admin_Id="";
			foreach ($query->result_array() as $row) {
				$Admin_Id= $row['trans_admin_id'];
			}
			//Generate Auth Code
			$AuthCode_Gen = md5($Admin_Id.date("Y-m-d H:i:s"));
			$Forgot_Auth_Code = substr($AuthCode_Gen,0,5);
			//Update Forgot_Auth_Code in table
			$this->db->where('emp_id', $Admin_Id);
			$this->db->where('login', $Email);
			$this->db->set('Forgot_Auth_Code', $Forgot_Auth_Code, TRUE);
			if($this->db->update('employee_details'))
			{
				$this->load->library('email');
				
				$this->email->initialize(array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://md-in-13.webhostbox.net',
				  'smtp_user' => 'noreply@al-amaanah.com',
				  'smtp_pass' => 'open@123',
				  'smtp_port' => '465',
				  'crlf' => "\r\n",
				  'newline' => "\r\n",
				  'mailtype' => 'html'
				));
				
				$this->email->from('noreply@al-amaanah.com', 'Schoooly');
				$this->email->to($Email);
				$this->email->subject('Password Reset | Schoooly');
				$email_body = "<p>Dear Admin,</p>"." <p>&nbsp;You have enabled <b>Forgot Password</b> option in your App.</p><p>&nbsp;Kindly enter the following <b>Auth Code : ".$Forgot_Auth_Code."</b> in your App to reset your password.</p>";				
				$this->email->message($email_body);
				$this->email->send();
				return 1;
				//$this->email->print_debugger();
			}
		}
		else{
			return 0;
		}
	}
	
	function UpdatePassword_Transport($Email,$Forgot_Auth_Code,$New_Password)
	{
		$this -> db -> select('emp_id AS trans_admin_id, email, login');
		$this -> db -> from('employee_details');
		$this -> db -> where('email', $Email);
		$this -> db -> where('Forgot_Auth_Code', $Forgot_Auth_Code);
		$query = $this -> db -> get();
		$Admin_Id=$query->row('trans_admin_id');
		if($query->num_rows() > 0) {
			$this->db->where('emp_id', $Admin_Id);
			$this->db->where('login', $Email);
			$this->db->set('password', $this->apicrypter->encrypt($New_Password), TRUE);
			$this->db->update('employee_details');
			return 1;
		}else{
			return 0;
		}
	}
	
}
?>