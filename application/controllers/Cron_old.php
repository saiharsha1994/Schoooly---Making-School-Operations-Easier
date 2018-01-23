<?php
class Cron extends CI_Controller {	
    function index() {
		// $this->load->library('SendEmail');
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://md-in-13.webhostbox.net';
		$config['smtp_user'] = 'noreply@al-amaanah.com';
		$config['smtp_pass'] = 'open@123';
		$config['smtp_port'] = 465;

		$this->email->initialize($config);

		$this->email->from('noreply@al-amaanah.com');
		$this->email->to('mdsalim14@gmail.com');
		$this->email->subject('Test');
		$this->email->message('Message');

		if($this->email->send()) {
			echo 'Mail Sent';
		} else {
			echo 'NOT Sent';
			print_r($this->email->print_debugger());
		}	
    }
}
?>