<?php
if (! defined('BASEPATH')) 
	exit('No direct script access allowed');
class SendEmail
{
	private $CI;
	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->library('email');
	}
	
	public function mailTo($Subject,$Message,$ToEmail) { 
		
		$this->CI->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtps.gdom.net',
			'smtp_user' => 'expense@valuetech.info',
			'smtp_pass' => 'Vt123456',
			'smtp_port' => '465',
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype' => 'html'
			));
		
			$this->CI->email->clear(TRUE);
			$this->CI->email->from('expense@valuetech.info', 'Schoooly');
			$this->CI->email->to($ToEmail);
			$this->CI->email->subject($Subject);
			$this->CI->email->set_mailtype('html');
			//$email_body = "<p>Dear User,</p>"." <p>&nbsp;You have enabled <b>Forgot Password</b> option in your App.</p><p>&nbsp;Kindly enter the following <b>Auth Code : ".$Auth_Code."</b> in your App to reset your password.</p>";				
			$this->CI->email->message($Message);
			$this->CI->email->send();
		
		return true;
    } 
}
?>