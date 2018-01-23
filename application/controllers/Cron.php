<?php
class Cron extends CI_Controller {	
    function index() {
		/* CI mailer Configuration */
		$this->load->database();
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://md-in-13.webhostbox.net';
		$config['smtp_user'] = 'noreply@al-amaanah.com';
		$config['smtp_pass'] = 'open@123';
		$config['smtp_port'] = 465;  
		
		/*$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtps.gdom.net';
		$config['smtp_user'] = 'salim@valuetechsa.com';
		$config['smtp_pass'] = 'Vt123456';
		$config['smtp_port'] = 465;*/
		$this->email->initialize($config);
		
		$year  =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$from_month = date('m');
		$term1 = array('01','02','03');
		$term2 = array('04','05','06');
		$term3 = array('07','08','09');
		$term4 = array('10','11','12');
		$total_val =0;
		if(in_array($from_month,$term1)){
			$term_val = 1;
			$st_month = 01;
			$end_month = 03;
		}else if(in_array($from_month,$term2)){
			$term_val = 2;
			$st_month = 04;
			$end_month = 06;
		}else if(in_array($from_month,$term3)){
			$term_val = 3;
			$st_month = 07;
			$end_month = 09;
		}else if(in_array($from_month,$term4)){
			$term_val = 4;
			$st_month = 10;
			$end_month = 12;
		}	
		$stu_query = $this->db->get('student');
        $stu_result = $stu_query->result_array(); 
		foreach($stu_result as $row) {
			static $i = 0;            
            $row['class_id'] = $this->db->get_where('enroll' , array('student_id' => $row['student_id']), array('year' => $year))->row()->class_id;
			$fees_invoice_qry = $this->db->get_where('fees_invoice' ,array( 'class_id'=>$row['class_id'], 'student_id'=>$row['student_id'], 'student_roll'=>$row['student_code'],'fees_term'=>$term_val, 'year'=>$year)); /* add term in table and query */
			if($fees_invoice_qry->num_rows() < 1) {
				$fees_arr = $this->db->get_where('fees_details' , array('class_id' => $row['class_id'], 'fees_term' => $term_val))->result_array();
					foreach ($fees_arr as $row2) {
						$total_val = $total_val + $row2['fees_amount'];            
					}
				$stu_arr[$i]['total_val'] = $total_val;
				$stu_arr[$i]['class_id'] = $row['class_id'];
				$stu_arr[$i]['student_id'] = $row['student_id'];
				$stu_arr[$i]['student_code'] = $row['student_code'];
				
				/* Pending Data */
				$pending_data ['student_id'] = $row['student_id'];
				$pending_data ['student_roll'] = $row['student_code'];
				$pending_data ['class_id'] = $row['class_id'];
				$pending_data ['fees_term'] = $term_val;
				$pending_data ['start_month'] = $st_month;
				$pending_data ['end_month'] = $end_month;
				$pending_data ['fees_amount'] = $total_val;
				$pending_data ['year'] = $year;
				$pending_data ['inserted_on'] = date('Y-m-d');
				$pending_data ['action_status'] = 1; // new or open
				$this->db->insert('fees_pending' , $pending_data); 	
				$i++;
			}			
        }           
		// echo "<pre>";
		// print_r($stu_arr);
		// echo "</pre>";
		$count = count($stu_arr);
		$this->email->from('noreply@al-amaanah.com');
		$this->email->to('thouseef@valuetechsa.com');
		$this->email->subject('UIISR Cron Mail');
		$this->email->message('Total Count of Student Pending :'.$count);

		if($this->email->send()) {
			echo 'Mail Sent';
		} else {
			echo 'NOT Sent';
			print_r($this->email->print_debugger());
		}	
    }
}
?>