<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 4 August, 2014
 *	Ekattor School  Management System
 *	http://codecanyon.net/user/Creativeitem
 */

class Teacher extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->library('ApiCrypter');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
    }
    
    /***TEACHER DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	function student_csv_upload(){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'student_csv_upload';
		$page_data['page_title'] = get_phrase('add_bulk_student');
		$this->load->view('backend/index', $page_data);
	}
	function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
			$data['student_code']           = $this->input->post('student_code');
            $data['DOB']       = $this->input->post('DOB');
           
            $data['religion']        = $this->input->post('religion');
            $data['blood_group']          = $this->input->post('blood_group');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            // $data['password']       = sha1($this->input->post('password'));
            $data['parent_id']      = $this->input->post('parent_id');
            $data['Student_Iqama_ID']  = $this->input->post('Student_Iqama_ID');
			$data['Father_Name']           = $this->input->post('Father_Name');
			$data['Father_Occupation']           = $this->input->post('Father_Occupation');
			$data['Mother_Occupation']           = $this->input->post('Mother_Occupation');
            $data['Mother_Name']       = $this->input->post('Mother_Name');
            $data['Medical_Insurance_Name']            = $this->input->post('Medical_Insurance_Name');
            $data['Medical_Insurance_Number']        = $this->input->post('Medical_Insurance_Number');
            $data['Special_Notes']          = $this->input->post('Special_Notes');
            $data['Nationality']          = $this->input->post('Nationality');
			$data['class_id']          = $this->input->post('class_id');
			$data['class_name']          = $this->db->get_where('class' , array('class_id' => $data['class_id']))->row()->name;
			
			$data['section_id']          = $this->input->post('section_id');
			$data['section_name']          = $this->db->get_where('section' , array('section_id' => $data['section_id']))->row()->name;
           
			$data['Father_Primary_Mobile']       = $this->input->post('Father_Primary_Mobile');
            $data['Father_Secondary_Mobile']      = $this->input->post('Father_Secondary_Mobile');
            $data['Mother_Primary_Mobile']  = $this->input->post('Mother_Primary_Mobile');
            $data['Mother_Secondary_Mobile']  = $this->input->post('Mother_Secondary_Mobile');
			$data['Emer_Contact_Person_Name_Primary']      = $this->input->post('Emer_Contact_Person_Name_Primary');
            $data['Emer_Contact_Person_Name_Secondary']  = $this->input->post('Emer_Contact_Person_Name_Secondary');
            $data['Emer_Contact_Person_Number_Primary']  = $this->input->post('Emer_Contact_Person_Number_Primary');
			$data['Emer_Contact_Person_Number_Secondary']           = $this->input->post('Emer_Contact_Person_Number_Secondary');
            $data['Home_Landline']       = $this->input->post('Home_Landline');
            $data['Office_Landline']            = $this->input->post('Office_Landline');
            $data['Street_Name']        = $this->input->post('Street_Name');
            $data['Area']          = $this->input->post('Area');
            $data['Landmark']          = $this->input->post('Landmark');
            $data['Latitude']       = $this->input->post('Latitude');
            $data['Longitude']      = $this->input->post('Longitude');
			$data['Latest_Feedback']      = $this->input->post('Latest_Feedback');
           
			$data['Date_of_Registeration']  = date("Y-m-d");

			
			$VarTransport_Facility=$this->input->post('Transport_Facility');
			$VarAdmission_Type=$this->input->post('Admission_Type');
			$VarSex=$this->input->post('sex');
			
			if($VarTransport_Facility == 'male'){
				$data['sex']  = 'M';
			}else{
				$data['sex']  = 'F';
			}
			if($VarTransport_Facility == 'yes'){
				$data['Transport_Facility']  = '1';
			}else{
				$data['Transport_Facility']  = '2';
			}
			if($VarAdmission_Type == 'normal'){
				$data['Admission_Type']  = '1';
			}else{
				$data['Admission_Type']  = '2';
			}
			
			//uploading file using codeigniter upload library
			$files = $_FILES['userfile'];
			$this->load->library('upload');
			$config['upload_path']   =  'uploads/student_image/';
			$config['allowed_types'] =  '*';
			$_FILES['userfile']['name']     = $files['name'];
			$_FILES['userfile']['type']     = $files['type'];
			$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
			$_FILES['userfile']['size']     = $files['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('userfile');
			$upload_data = $this->upload->data();
			$data['photo']  = $upload_data['file_name'];
			// $_FILES['userfile']['name'];
			
			$this->db->insert('student', $data);
            $student_id = $this->db->insert_id();

            $data2['student_id']     = $student_id;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data2['section_id'] = $this->input->post('section_id');
            }
            
            $data2['roll']           = $this->input->post('student_code');
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            
			$this->db->insert('enroll', $data2);
			
			/*if(file_exists($student_id . '.jpg')) {
				chmod($student_id . '.jpg',0755); //Change the file permissions if allowed
				unlink($student_id . '.jpg'); //remove the file
			}			
            if(move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg')){
				$data_img['photo']  = $student_id.'jpg';
				$this->db->where('student_id', $student_id);
				$this->db->update('student', $data_img);
			}	*/
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
			//$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            
			redirect(base_url() . 'index.php?teacher/student_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
			$data['name']           = $this->input->post('name');
			$data['student_code']           = $this->input->post('student_code');
            $data['DOB']       = $this->input->post('DOB');
            
            $data['religion']        = $this->input->post('religion');
            $data['blood_group']          = $this->input->post('blood_group');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            $data['parent_id']      = $this->input->post('parent_id');
            $data['Student_Iqama_ID']  = $this->input->post('Student_Iqama_ID');
			$data['Father_Name']           = $this->input->post('Father_Name');
			$data['Father_Occupation']           = $this->input->post('Father_Occupation');
			$data['Mother_Occupation']           = $this->input->post('Mother_Occupation');
            $data['Mother_Name']       = $this->input->post('Mother_Name');
            $data['Medical_Insurance_Name']            = $this->input->post('Medical_Insurance_Name');
            $data['Medical_Insurance_Number']        = $this->input->post('Medical_Insurance_Number');
            $data['Special_Notes']          = $this->input->post('Special_Notes');
            $data['Nationality']          = $this->input->post('Nationality');
			$data['class_id']          = $this->input->post('class_id');
			//$data['class_name']          = $this->db->get_where('class' , array('class_id' => $data['class_id']))->row()->name;
			
			$data['section_id']          = $this->input->post('section_id');
			//$data['section_name']          = $this->db->get_where('section' , array('section_id' => $data['section_id']))->row()->name;
           
			$data['Father_Primary_Mobile']       = $this->input->post('Father_Primary_Mobile');
            $data['Father_Secondary_Mobile']      = $this->input->post('Father_Secondary_Mobile');
            $data['Mother_Primary_Mobile']  = $this->input->post('Mother_Primary_Mobile');
            $data['Mother_Secondary_Mobile']  = $this->input->post('Mother_Secondary_Mobile');
			$data['Emer_Contact_Person_Name_Primary']      = $this->input->post('Emer_Contact_Person_Name_Primary');
            $data['Emer_Contact_Person_Name_Secondary']  = $this->input->post('Emer_Contact_Person_Name_Secondary');
            $data['Emer_Contact_Person_Number_Primary']  = $this->input->post('Emer_Contact_Person_Number_Primary');
			$data['Emer_Contact_Person_Number_Secondary']           = $this->input->post('Emer_Contact_Person_Number_Secondary');
            $data['Home_Landline']       = $this->input->post('Home_Landline');
            $data['Office_Landline']            = $this->input->post('Office_Landline');
            $data['Street_Name']        = $this->input->post('Street_Name');
            $data['Area']          = $this->input->post('Area');
            $data['Landmark']          = $this->input->post('Landmark');
            $data['Latitude']       = $this->input->post('Latitude');
            $data['Longitude']      = $this->input->post('Longitude');
			$data['Latest_Feedback']      = $this->input->post('Latest_Feedback');
           
			$VarTransport_Facility=$this->input->post('Transport_Facility');
			$VarAdmission_Type=$this->input->post('Admission_Type');
			$VarSex=$this->input->post('sex');
			
			if($VarTransport_Facility == 'male'){
				$data['sex']  = 'M';
			}else{
				$data['sex']  = 'F';
			}
			if($VarTransport_Facility == 'yes'){
				$data['Transport_Facility']  = '1';
			}else{
				$data['Transport_Facility']  = '2';
			}
			if($VarAdmission_Type == 'normal'){
				$data['Admission_Type']  = '1';
			}else{
				$data['Admission_Type']  = '2';
			}
			
			
            $this->db->where('student_id', $param2);
            $this->db->update('student', $data);

            $data2['section_id']    =   $this->input->post('section_id');
            $data2['roll']          =   $this->input->post('student_code');
            $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
            $this->db->where('student_id' , $param2);
            $this->db->where('year' , $running_year);
            $this->db->update('enroll' , array(
                'section_id' => $data2['section_id'] , 'roll' => $data2['roll']
            ));

            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
			
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?teacher/student_information/' . $param3, 'refresh');
        } 
		
        if ($param1 == 'delete') {
            $this->db->where('student_id', $param2);
            $this->db->delete('student');
			 $this->db->where('student_id', $param2);
            $this->db->delete('enroll');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/student_information/' . $param3, 'refresh');
        }
    }
	

	

	
	function student_information($class_id = '')
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
	
	function student_marksheet($student_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

	function upload_csv_file(){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		/* Encrypt Decrypt Library */
		$this->load->library('ApiCrypter');
		if(isset($_POST["Import"])){
            $filename=$_FILES["file_name"]["tmp_name"];
            if($_FILES["file_name"]["size"] > 0){
                $file = fopen($filename, "r");
				// if the csv file contain the table header leave this line
				$header_row = fgetcsv($file, 10000, ','); // here you got the header
				$header_row = fgetcsv($file, 10000, ','); // here you got the description
				$header_row = fgetcsv($file, 10000, ','); // here you got the empty line
                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){ 
					$emapData = array_map('trim',$emapData);
					/* Blank rows skip */
					if($emapData[10] =='' || $emapData[19] =='' || $emapData[21] =='')
						continue;
					/* parent name for parent table */
					if($emapData[11] !='')
						$parent_name = $emapData[11];
					else if($emapData[12] !='')
						$parent_name = $emapData[12];
					else
						$parent_name = '';
					/* parent profession for parent table */
					if($emapData[13] !='')
						$profession = $emapData[13];
					else if($emapData[14] !='')
						$profession = $emapData[14];
					else
						$profession = '';
					/* parent phone for parent table */
					if($emapData[25] !='')
						$phone = $emapData[25];
					else if($emapData[27] !='')
						$phone = $emapData[27];
					else
						$phone = '';
					
					
					
					$dataParent = array(   
					'name' => $parent_name,
					'phone' => $phone,
					'profession' => $profession,
					'address' => $emapData[36],
					'email' => $emapData[23],
					'password' => $this->apicrypter->encrypt($emapData[24]));	
                    $ParentId = $this->crud_model->insertParentCSV($dataParent,$emapData[23]); 
					
					$data = array('student_code' => $emapData[0],
							  'Student_Iqama_ID' => $emapData[1],
							  'Date_of_Registeration' => $emapData[2],
							  'name' => $emapData[3],
							  'DOB' => $emapData[4],
							  'sex' => $emapData[5],
							  'religion' => $emapData[6],
							  'blood_group' => $emapData[7],
							  'phone' => $emapData[8],
							  'email' => $emapData[9],
							  'parent_id' => $ParentId ,
							  'Father_Name' => $emapData[11],
							  'Mother_Name' => $emapData[12],
							  'parent_name' => $parent_name,
							  'Father_Occupation' => $emapData[13],
							  'Mother_Occupation' => $emapData[14],
							  'Medical_Insurance_Name' => $emapData[15],
							  'Medical_Insurance_Number' => $emapData[16],
							  'Special_Notes' => $emapData[17],
							  'Nationality' => $emapData[18],
							  'class_id' => $emapData[19],
							  'class_name' => $emapData[20],
							  'section_id' => $emapData[21],
							  'section_name' => $emapData[22],
							  'Father_Primary_Mobile' => $emapData[25],
							  'Father_Secondary_Mobile' => $emapData[26],
							  'Mother_Primary_Mobile' => $emapData[27],
							  'Mother_Secondary_Mobile' => $emapData[28],
							  'Emer_Contact_Person_Name_Primary' => $emapData[29],
							  'Emer_Contact_Person_Number_Primary' => $emapData[30],
							  'Emer_Contact_Person_Name_Secondary' => $emapData[31],
							  'Emer_Contact_Person_Number_Secondary' => $emapData[32],
							  'Home_Landline' => $emapData[33],
							  'Office_Landline' => $emapData[34],
							  'Street_Name' => $emapData[35],
							  'Area' => $emapData[36],
							  'Landmark' => $emapData[37],
							  'Latitude' => $emapData[38],
							  'Longitude' => $emapData[39],
							  'Transport_Facility' => $emapData[40],
							  'Latest_Feedback' => $emapData[41],
							  'Document_Status' => $emapData[42],
							  'Admission_Status' => $emapData[43],
							  'Student_Status' => $emapData[44],
							  'Admission_Type' => $emapData[45],
							);
							
					$sutdentId = $this->crud_model->insertCSV($data); 
					$running_year = $this->db->get_where('settings' , array(
						'type' => 'running_year'))->row()->description;
		
					if($emapData[46]!=''){
						$dataEnroll1 = array(
						'student_id' =>$sutdentId,
						'date_added' => strtotime($emapData[2]),
						'class_id' => $emapData[47],
						'section_id' => $emapData[49],
						'year' => $emapData[46]);	
						$this->db->insert('enroll', $dataEnroll1);				
					}
					if($emapData[51]!=''){
						$dataEnroll2 = array(
						'student_id' =>$sutdentId,
						'date_added' => strtotime($emapData[2]),
						'class_id' => $emapData[52],
						'section_id' => $emapData[54],
						'year' => $emapData[51]);	
						$this->db->insert('enroll', $dataEnroll2);				
					}
					/*if($emapData[56]!=''){
						$dataEnroll3 = array(
						'student_id' =>$sutdentId,
						'date_added' => strtotime($emapData[2]),
						'class_id' => $emapData[57],
						'section_id' => $emapData[59],
						'year' => $emapData[56]);	
						$this->db->insert('enroll', $dataEnroll3);				
					}*/
					
					
					$dataEnroll = array(
					'student_id' =>$sutdentId,
					'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
					'class_id' => $emapData[19],
					'section_id' => $emapData[21],
					'roll' => $emapData[0],
					'date_added' => strtotime(date("Y-m-d H:i:s")),
					'year' => $running_year);	
                
					$this->db->insert('enroll', $dataEnroll);
                }
                fclose($file);
                // redirect('welcome/index');
				$this->session->set_flashdata('flash_message' , get_phrase('csv_uploaded'));
				redirect(base_url() . 'index.php?teacher/student_csv_upload', 'refresh');	
            }
        }		
	}	

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/student_marksheet_print_view', $page_data);
    }
	
	function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
	/* Homework */
	function homework($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['subject_id']   =   $this->input->post('subject_id');
            $data['class_id']   =   $this->input->post('class_id');
            $data['section_id']   =   $this->input->post('section_id');
			$data['Title']   =   $this->input->post('Title');
            $data['Description']   =   $this->input->post('Description');
            $data['Due_Date']   =   $this->input->post('Due_Date');
			$data['Date']   =   date('Y-m-d');
			
			$data['teacher_id']   =   $this->session->userdata('login_user_id');
            $this->db->insert('homework' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/homework');
        }
        if ($param1 == 'edit') {
            $data['subject_id']   =   $this->input->post('subject_id');
            $data['class_id']   =   $this->input->post('class_id');
            $data['section_id']   =   $this->input->post('section_id');
            $data['teacher_id']   =   $this->session->userdata('login_user_id');
            $data['Title']   =   $this->input->post('Title');
            $data['Description']   =   $this->input->post('Description');
            $data['Due_Date']   =   $this->input->post('Due_Date');
			
			$this->db->where('Homework_Id' , $param2);
            $this->db->update('homework' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?teacher/homework');
        }
        if ($param1 == 'delete') {
            $this->db->where('Homework_Id' , $param2);
            $this->db->delete('homework');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/homework');
        }

        $page_data['page_name']  = 'homework';
        $page_data['page_title'] = get_phrase('homework');
		$query = $this->db->get_where('homework' , array('teacher_id' => $this->session->userdata('login_user_id')));
		if ($query->num_rows() > 0)
			$page_data['homework']    = $query->result_array();
		else
			$page_data['homework'] = array();
        $this->load->view('backend/index', $page_data);
    }

	// Assignments
	function add_assignments($param1=''){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		if ($param1 == 'create') {
            $data['title'] =   $this->input->post('assign_title');
			$data['description']  = $this->input->post('assign_desc');
			$data['class_id']  = $this->input->post('class_id');
			$data['section_id']  = $this->input->post('section_id');
			$data['subject_id']  = $this->input->post('subject_id');
			$data['teacher_id']  = $this->session->userdata('login_user_id');
            $data['due_date'] =   date('Y-m-d',strtotime($this->input->post('due_date')));
            $data['added_on']  =   date('Y-m-d');
			$data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
			
			//uploading file using codeigniter upload library
			$files = $_FILES['file_name'];
			$this->load->library('upload');
			$config['upload_path']   =  'uploads/assignments_teacher/';
			$config['allowed_types'] =  '*';
			$_FILES['file_name']['name']     = $files['name'];
			$_FILES['file_name']['type']     = $files['type'];
			$_FILES['file_name']['tmp_name'] = $files['tmp_name'];
			$_FILES['file_name']['size']     = $files['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('file_name');
			
			$upload_data = $this->upload->data();
			$data['assignment_doc_url']  = $upload_data['file_name'];
            
            $this->db->insert('assignment_teacher' , $data);
			// $assignment_id = $this->db->insert_id();
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/add_assignments', 'refresh');
        }		
		$page_data['page_name']  = 'add_assignments';
        $page_data['page_title'] = get_phrase('add_assignments');
        $this->load->view('backend/index', $page_data); 
	}
	
	function manage_assignments($param1=''){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		if ($param1 == 'edit') {            
			$page_data['class_id']  = $this->input->post('class_id');
			$page_data['section_id']  = $this->input->post('section_id');
			$page_data['subject_id']  = $this->input->post('subject_id');
			$page_data['teacher_id']  = $this->session->userdata('login_user_id');
			$page_data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            // $page_data['due_date'] =   date('Y-m-d',strtotime($this->input->post('due_date')));
            
			$page_data['page_name']  = 'manage_assignments_view';
			$page_data['page_title'] = get_phrase('manage_assignments_view');
			$this->load->view('backend/index', $page_data); 
        }else{
			$page_data['page_name']  = 'manage_assignments';
			$page_data['page_title'] = get_phrase('manage_assignments');
			$this->load->view('backend/index', $page_data); 
		}		
	}
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        //$page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/subject/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?teacher/subject/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?teacher/subject/'.$param3, 'refresh');
        }
		 $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array(
            'class_id' => $param1,
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks_manage()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']
                ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(base_url() . 'index.php?teacher/marks_manage_view/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');
        
    }

    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark' , array(
            'exam_id' => $exam_id,
                'class_id' => $class_id,
                    'section_id' => $section_id,
                        'year' => $running_year,
                            'subject_id' => $subject_id
        ))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment));
        }
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(base_url().'index.php?teacher/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }

    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/teacher/marks_get_subject' , $page_data);
    }


    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['class_id']   = $class_id;		
        $this->load->view('backend/index', $page_data);
    }
	
	function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
	
    function upload_academic_syllabus()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']               =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        //uploading file using codeigniter upload library
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/syllabus/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');
		$upload_data = $this->upload->data();
		// Array ( [file_name] => Offers_App.pdf [file_type] => application/pdf [file_path] => C:/xampp/htdocs/UIISR/uploads/syllabus/ [full_path] => C:/xampp/htdocs/UIISR/uploads/syllabus/Offers_App.pdf [raw_name] => Offers_App [orig_name] => Offers_App.pdf [client_name] => Offers App.pdf [file_ext] => .pdf [file_size] => 1099.78 [is_image] => [image_width] => [image_height] => [image_type] => [image_size_str] => )
        // $data['file_name'] = $_FILES['file_name']['name'];
		$data['file_name'] = $upload_data['file_name'];
        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));	
        redirect(base_url() . 'index.php?teacher/academic_syllabus/' . $data['class_id'] , 'refresh');

    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['login']       = $this->input->post('email');
            
			//uploading file using codeigniter upload library
            $files = $_FILES['userfile'];
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/employee_document/';
            $config['allowed_types'] =  '*';
            $_FILES['userfile']['name']     = $files['name'];
            $_FILES['userfile']['type']     = $files['type'];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'];
            $_FILES['userfile']['size']     = $files['size'];
            $this->upload->initialize($config);
            if($this->upload->do_upload('userfile')){
                $upload_data = $this->upload->data();
                $data['photo']  = $upload_data['file_name'];	
            }
			
            $this->db->where('emp_id', $this->session->userdata('login_user_id'));
            $this->db->update('employee_details', $data);
			
           // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->apicrypter->encrypt($this->input->post('password'));
            $data['new_password']         = $this->apicrypter->encrypt($this->input->post('new_password'));
            $data['confirm_new_password'] = $this->apicrypter->encrypt($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('employee_details', array(
                'emp_id' => $this->session->userdata('login_user_id')
            ))->row()->password;
			
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('emp_id', $this->session->userdata('login_user_id'));
                $this->db->update('employee_details', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
			redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('employee_details', array(
            'emp_id' => $this->session->userdata('login_user_id')
        ))->result_array();
       $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/teacher/class_routine_print_view' , $page_data);
    }
	
	/****** DAILY ATTENDANCE *****************/
    function manage_attendance($class_id)
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['page_name']  =  'manage_attendance';
        $page_data['class_id']   =  $class_id;
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class') . ' ' . $class_name;
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('manage_attendance_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
    }

    function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
		$month_name = date('M', $data['timestamp']);
		$date_formate = date('Y-m-d', $data['timestamp']);
        $data['section_id'] = $this->input->post('section_id');
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$data['class_id'],
                'section_id'=>$data['section_id'],
                    'year'=>$data['year'],
                        'timestamp'=>$data['timestamp']
        ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
				$attn_data['att_month']  = $month_name;
				$attn_data['att_date']  = $date_formate;
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
            
        }
        redirect(base_url().'index.php?teacher/manage_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    $this->sms_model->send_sms($message,$receiver_phone);
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(base_url().'index.php?teacher/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }
    
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?teacher/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        // $page_data['notices']    = $this->db->get('noticeboard')->result_array();
		$page_data['notices'] = $this->db->get_where('noticeboard', array('reciever' => 'teacher'))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*********MANAGE STUDY MATERIAL************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_saved_successfuly'));
            redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        
        if ($task == "update")
        {
        	$par0=$this->input->post('par0');
        	$par1=$this->input->post('par1');
        	$par2=$this->input->post('par2');
        	$par3=$this->input->post('par3');
        	$par4=$this->input->post('par4');
        	$par5=$this->input->post('par5');
        	//echo $par0.$par1.$par2.$par3.$par4.$par5;

             $this->crud_model->update_study_material_info($par0,$par1,$par2,$par3,$par4,$par5);
             $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_updated_successfuly'));
             redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php?teacher/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }

    function subject_data($classid)
    {
   	 	//echo "123";
   	 	$running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
   	 	$arr['subject']=array();
   	 	 $arr['id']=array();
   	 	$subject_data=$this->db->get_where('subject' , array('class_id'=> $classid))->result_array();
   	 	foreach ($subject_data as $row) {
   	 		array_push($arr['subject'], $row['name']);
   	 		array_push($arr['id'], $row['subject_id']);
   	 	}
   	 	echo json_encode($arr);
		
        
    }



    /*Student Leave Managmennt*/
    /*Pending Leaves*/
     function pending_leaves($param1=""){
     	if ($this->session->userdata('admin_login') != 1)
        {

            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name']              = 'pending_leaves';
        $data['page_title']             = get_phrase('pending_leaves');
        $this->load->view('backend/index', $data);
     }

     function pending_leaves_selector(){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $par1=$this->input->post('par1');
        $par2=$this->input->post('par2');

        echo $par1.$par2;
        // redirect(base_url().'index.php?teacher/study_material/','refresh');
     }

     function pending_leaves_view(){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id']       = $this->input->post('section_id');
        $data['page_name']              = 'pending_leaves_view';
        $data['page_title']             = get_phrase('pending_leaves');
        $this->load->view('backend/index', $data);

     }

     function pending_leaves_view_approve_reject($param1='',$param2=''){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $param1;
        $data['section_id']       = $param2;
        $data['page_name']              = 'pending_leaves_view';
        $data['page_title']             = get_phrase('pending_leaves');
        $this->load->view('backend/index', $data);

     }

     function accept_leave($param1='',$param2='',$param3=''){
     	$data['status']      = '2';
        $this->db->where('id',$param1);
        $this->db->update('leave_records',$data);
		
		// change leave status in attendance table
		$this->db->select('student_id,from_date,to_date');
		$this-> db -> from('leave_records');
		$this-> db ->where('id', $param1);
		$query = $this -> db -> get();
		
		$student_id=$query->row()->student_id;
		$from_date=$query->row()->from_date;
		$to_date=$query->row()->to_date;
			
		while (strtotime($from_date) <= strtotime($end_date)) {
			$WhereArr=array(
			'att_date' => $from_date,
			'student_id' => $student_id);
				
			$this->db->where($WhereArr);
			$this->db->update('attendance',array('status' => 6));
			
			$from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
		}
		
		//send alert / notification / email to parent
		$this->load->library('GCM');
		$this->load->library('SendEmail');
		
		$user_id=$this->db->get_where('leave_records', array('id' => $param1))->row()->student_id;	
		$Attquery=$this->db->query("SELECT G.GCM_RegId,S.name,G.Email FROM app_gcm_parents G INNER JOIN student S ON
			G.User_Id=S.parent_id WHERE G.User_Id IN 
			(SELECT S.parent_id FROM student WHERE S.student_id =".$user_id.") 
			AND G.User_Type='parent'");
				
		if($Attquery->num_rows() > 0) {
			foreach ($Attquery->result_array() as $row) {
				$message = array("Notification" => "Hi, Your child ".$row['name'].", leave is approved." ,"image_url" => "");	
				$this->gcm->addRecepient($row['GCM_RegId']);
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
					
				//Send Email for the same
				$Subject = 'Leave Response';
				$MailMessage = "<p>Dear Parent,</p>"." <p>&nbsp;Your child ".$row['name'].", leave is approved.</p>";
										
				//$data = array('Emp_Contact_Mail'=>$this->input->post('ToEmail'));
				$this->sendemail->mailTo($Subject,$MailMessage,$row['Email']);
					
				//send alert to portal
				$parent_id=$this->db->get_where('student', array('student_id' => $user_id))->row()->parent_id;				
				$alertData=array('user_type'=>1,
					'alert_to'=>$parent_id,
					'alert_about'=>7,
					'alert_msg'=>$MailMessage,
					'alert_sent'=>4);
				$this->db->insert("notify_alert", $alertData);
			}	
		}
			
        $this->session->set_flashdata('flash_message' , get_phrase('leave_approved'));
        redirect(base_url() . 'index.php?teacher/pending_leaves_view_approve_reject/'.$param2.'/'.$param3 , 'refresh');
     }

     function reject_leave($param1='',$param2='',$param3='',$param4=''){
     	
     	$data['status']      = '3';
     	$data['reject_reason'] = urldecode($param4);
        $this->db->where('id',$param1);
        $this->db->update('leave_records',$data);
		
		//send alert / notification / email to parent
		$this->load->library('GCM');
		$this->load->library('SendEmail');
		
		$user_id=$this->db->get_where('leave_records', array('id' => $param1))->row()->student_id;	
		$Attquery=$this->db->query("SELECT G.GCM_RegId,S.name,G.Email FROM app_gcm_parents G INNER JOIN student S ON
			G.User_Id=S.parent_id WHERE G.User_Id IN 
			(SELECT S.parent_id FROM student WHERE S.student_id =".$user_id.") 
			AND G.User_Type='parent'");
				
		if($Attquery->num_rows() > 0) {
			foreach ($Attquery->result_array() as $row) {
				$message = array("Notification" => "Hi, Your child ".$row['name'].", leave is rejected. And the reason is ".urldecode($param4) ,"image_url" => "");	
				$this->gcm->addRecepient($row['GCM_RegId']);
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
					
				//Send Email for the same
				$Subject = 'Leave Response';
				$MailMessage = "<p>Dear Parent,</p>"." <p>&nbsp;Your child ".$row['name'].", leave is rejected. And the reason is ".urldecode($param4)."</p>";
										
				//$data = array('Emp_Contact_Mail'=>$this->input->post('ToEmail'));
				$this->sendemail->mailTo($Subject,$MailMessage,$row['Email']);
					
				//send alert to portal
				$parent_id=$this->db->get_where('student', array('student_id' => $user_id))->row()->parent_id;				
				$alertData=array('user_type'=>1,
					'alert_to'=>$parent_id,
					'alert_about'=>7,
					'alert_msg'=>$MailMessage,
					'alert_sent'=>4);
				$this->db->insert("notify_alert", $alertData);
			}	
		}

		
        $this->session->set_flashdata('flash_message' , get_phrase('leave_rejected'));
        redirect(base_url() . 'index.php?teacher/pending_leaves_view_approve_reject/'.$param2.'/'.$param3 , 'refresh');
     }

     /*Confirm Leaves*/

     function confirm_leaves($param1=""){
     	if ($this->session->userdata('admin_login') != 1)
        {

            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name']              = 'confirm_leaves';
        $data['page_title']             = get_phrase('confirmed_leaves');
        $this->load->view('backend/index', $data);
     }


     function confirm_leaves_view(){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id']       = $this->input->post('section_id');
        $data['page_name']              = 'confirm_leaves_view';
        $data['page_title']             = get_phrase('confirmed_leaves');
        $this->load->view('backend/index', $data);

     }


     function section_data($classid)
    {
   	 	$running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
   	 	$arr['section']=array();
   	 	 $arr['id']=array();
   	 	$section_data=$this->db->get_where('section' , array('class_id'=> $classid))->result_array();
   	 	foreach ($section_data as $row) {
   	 		array_push($arr['section'], $row['name']);
   	 		array_push($arr['id'], $row['section_id']);
   	 	}
   	 	echo json_encode($arr);  
    }
    


    /*Leave Managmennt*/

    function leave_managment($param1="",$param2=""){
    	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if($param1 == 'create'){
        	$this->crud_model->save_leave_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('leave_applied_successfuly'));
            redirect(base_url() . 'index.php?teacher/leave_managment' , 'refresh');	
        }
        if($param1 == 'update'){
        	$this->crud_model->resave_leave_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('leave_reapplied_successfuly'));
            redirect(base_url() . 'index.php?teacher/leave_managment' , 'refresh');
        }
        if($param1 == 'delete'){
        	$row_id=$param2;

        	$this->db->where('id', $row_id);
            $this->db->delete('leave_records');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
        		redirect(base_url() . 'index.php?teacher/leave_managment/', 'refresh');
        }
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        $teacher_id= $this->session->userdata('login_user_id');
        
		$type= $this->session->userdata('role_id');
        $type_arr=explode(",",$type);
		
        $data['leave_info']    = $this->crud_model->leave_data($teacher_id,$type_arr[0]);
        $data['teacher_id']= $this->session->userdata('login_user_id');
        $data['type']= $type_arr[0];
        $data['year']= $running_year;
        $data['page_name']              = 'leave_management';
        $data['page_title']             = get_phrase('leave');
        $this->load->view('backend/index', $data);

    }
    /****EXIT REENTRIES****/
    function exit_reentry_management($param1="",$param2=""){
    	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if($param1=='create'){
        	$this->crud_model->save_exit_re_entry();
            $this->session->set_flashdata('flash_message' , get_phrase('applied_successfuly'));
            redirect(base_url() . 'index.php?teacher/exit_reentry_management' , 'refresh');
        }
        if($param1 == 'update'){
        	$this->crud_model->resave_reentries_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('reapplied_successfuly'));
            redirect(base_url() . 'index.php?teacher/exit_reentry_management' , 'refresh');
        }
        if($param1=='delete'){
        	$row_id=$param2;
        	$this->db->where('id', $row_id);
            $this->db->delete('exit_re_entries');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
        		redirect(base_url() . 'index.php?teacher/exit_reentry_management/', 'refresh');
        }
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        $teacher_id1= $this->session->userdata('login_user_id');
        //$type= '1';
        
		$type= $this->session->userdata('role_id');
        $type_arr=explode(",",$type);
		
		//$type= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TEACHER'))->row()->id;
        $teacher_name= $this->db->get_where('employee_details' , array('emp_id' => $teacher_id1))->row()->name;
        $data['teacher_id']= $this->session->userdata('login_user_id');
        $data['teacher_name']=$teacher_name;
        $data['type']= $type_arr[0];
        $data['exit_reentry_info']    = $this->crud_model->exit_reentry_data($teacher_id1,$type_arr[0]);
        $data['year']= $running_year;
        $data['page_name']              = 'exit_reentries_managements';
        $data['page_title']             = get_phrase('exit_re-_entries');
        $this->load->view('backend/index', $data);
    }
    
    /**** get notifications sorted on date and time *********/

    function get_notifications_order_by_time($teacher_id){

      $this->db->select("*");
      $this->db->from("notify_alert");
      $this->db->where('alert_to', $teacher_id);
      //$this->db->where('status', 1);
      $this->db->order_by("alert_on", "desc");
      $query = $this->db->get();
    
      echo json_encode($query->result());

    }

    /*** get notifications ***/

    function get_notifications($teacher_id){

        /*if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');*/
        
        $notifications = $this->db->get_where('notify_alert' , array('alert_to' => $teacher_id, 'status' => '1' ))->result_array();
        $arr['notifications'] = array();
        foreach ($notifications as $row) {

            array_push($arr['notifications'], $row);

        }


        echo json_encode($arr['notifications']); 

    }

    /**** changes notifications status *********/

    public function change_notifications_status($teacher_id){

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['status'] = 2;
        $this->db->where('alert_to', $teacher_id);
        $this->db->update('notify_alert', $data);

    }
    

    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {			
			$msg_type = $this->input->post('msg_type');
			if($msg_type==1){
				$message_thread_code = $this->crud_model->send_new_private_message();
				$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
				redirect(base_url() . 'index.php?teacher/message/message_read/' . $message_thread_code, 'refresh');
			}else if($msg_type==2){
				$class_id = $this->input->post('class_id');
				$section_id = $this->input->post('section_id');
				$this->crud_model->send_group_private_message($class_id, $section_id);
				$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
				redirect(base_url() . 'index.php?teacher/message/message_home', 'refresh');
			}	
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?teacher/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $current_time = date("h:i A");
		$chat_time=$this->db->get_where('settings', array('type' => 'chat_time'))->row()->description;
		if($chat_time!=''){
			$chat_time_arr=explode(",",$chat_time);
		}
		$start_time=$chat_time_arr[0];
		$end_time=$chat_time_arr[1];
		
		$date1 = DateTime::createFromFormat('H:i a', $current_time);
		$date2 = DateTime::createFromFormat('H:i a', $start_time);
		$date3 = DateTime::createFromFormat('H:i a', $end_time);
		
		if ($date1 > $date2 && $date1 < $date3){
			$page_data['message_inner_page_name']   = $param1;
			$page_data['page_name']                 = 'message';
			$page_data['page_title']                = get_phrase('private_messaging');
			$this->load->view('backend/index', $page_data);

		}else{
			$this->session->set_flashdata('flash_message' , get_phrase('chatting_time_is_between_'.$start_time.'_to_'.$end_time)); 
			redirect(base_url() . 'index.php?teacher/dashboard/', 'refresh'); 
		}
    }
}