<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Parents extends CI_Controller
{
    function __construct(){
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->library('GCM');
		$this->load->library('ApiCrypter');
		
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index(){
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard(){
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('parent_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /***admission child***/
    function admit_child($parent_id){

        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $decide = 1;
        if ($decide == 1) {
            $page_data['page_name']  = 'admit_child';
        }else{
            $page_data['page_name']  = 'admit_child_disabled';
        }

        //$page_data['page_name']  = 'admit_child';
        $page_data['page_title'] = get_phrase('admit_child');
        $this->load->view('backend/index', $page_data);
    }

    /*********** Admit child add and upload code ************/

    function student($param1 = '', $param2 = ''){


        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;


        if ($param1 == 'create') {
            
            $this->load->library('ApiCrypter');
            $parent_id = $this->input->post('parent_id');
            //$data1['parent_id'] = $this->input->post('parent_id');
            $data1['email'] = $this->input->post('parentEmail');
            $data1['password'] = $this->input->post('password');
            $data1['name'] = $this->input->post('fatherName');
            $data1['father_nationality'] = $this->input->post('fatherNationality');
            $data1['profession'] = $this->input->post('profession');
            $data1['father_empr_sponsor_name'] = $this->input->post('fatherEmployer');
            $data1['father_work_address'] = $this->input->post('fatherWorkAddress');
            $data1['mother_name'] = $this->input->post('motherName');
            $data1['mother_nationality'] = $this->input->post('motherNationality');
            $data1['mother_occupation'] = $this->input->post('motherOccupation');
            $data1['mother_empr_sponsor_name'] = $this->input->post('motherEmployer');
            $data1['mother_work_address'] = $this->input->post('motherWorkAddress');

            $data1['mother_email'] = $this->input->post('motherEmail');
            $data1['Father_Primary_Mobile'] = $this->input->post('fatherPrimaryMobile');
            $data1['Father_Secondary_Mobile'] = $this->input->post('fatherSeconaryMobile');
            $data1['Mother_Primary_Mobile'] = $this->input->post('motherPrimaryMobile');
            $data1['Mother_Secondary_Mobile'] = $this->input->post('motherSecondaryMobile');
            $data1['Home_Landline'] = $this->input->post('homeLandline');
            $data1['father_office_landline'] = $this->input->post('fatherOfficeLandline');
            $data1['mother_office_landline'] = $this->input->post('motherOfficeLandline');
            $data1['Emer_Contact_Person_Name_Primary'] = $this->input->post('emergencyContactPersonNamePrimary');
            $data1['Emer_Contact_Person_Name_Secondary'] = $this->input->post('emergencyContactPersonNameSecondary');
            $data1['Emer_Contact_Person_Number_Primary'] = $this->input->post('emergencyContactPersonMobilePrimary');
            $data1['Emer_Contact_Person_Number_Secondary'] = $this->input->post('emergencyContactPersonMobileSecondary');
            
            if ($parent_id == null) {
                $data1['child_count'] = 1; 
                $this->db->insert('parent', $data1);
                $parent_id = $this->db->insert_id();
            }else{
                $child_count = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->child_count;
                $data1['child_count'] = $child_count + 1; 
                $this->db->where('parent_id', $parent_id);
                $this->db->update('parent', $data1);
            }
             
            $data['Fees_Concession'] = 1;
            if ($data1['child_count'] == 2) {
                $data['Concession_Percent'] = 10;
                $data['Fees_Concession'] = 2;
            }
            else if ($data1['child_count'] == 3) {
                $data['Concession_Percent'] = 20;
                $data['Fees_Concession'] = 2;
            }
            else if ($data1['child_count'] > 3) {
                $data['Concession_Percent'] = 30;
                $data['Fees_Concession'] = 2;
            }
            

            $data['parent_id'] = $parent_id;
            $data['student_code'] = $this->input->post('applicationNumber');
            $data['academic_year'] = $this->input->post('academicYear');
            $data['Date_of_Registeration'] = $this->input->post('DOA');
            $data['name'] = $this->input->post('name');
            $data['photo'] = $this->input->post('studentPhoto');
            $data['DOB'] = $this->input->post('DOB');
            $data['place_of_birth'] = $this->input->post('birthPlace');
            //$data['sex'] = $this->input->post('sex');
            $data['blood_group'] = $this->input->post('bloodGroup');
            $data['religion'] = $this->input->post('religion');
            $data['mother_tongue'] = $this->input->post('motherTongue');
            $data['phone'] = $this->input->post('studentMobileNumber');
            $data['email'] = $this->input->post('studentEmail');
            $data['last_school_attended'] = $this->input->post('LastSchoolAttended');
            $data['last_school_address'] = $this->input->post('lastSchoolAddress');
            $data['allergies'] = $this->input->post('allergies');


           
            $data['class_id'] = $this->input->post('class_id');
            $data['class_name'] = $this->db->get_where('class' , array('class_id' => $data['class_id']))->row()->name;
            $data['section_id'] = $this->input->post('section_id');
            $data['section_name'] = $this->db->get_where('section' , array('section_id' => $data['section_id']))->row()->name;
            //$data['Admission_Type'] = $this->input->post('selectAdmissionType');
            $data['Date_of_Registeration']  = date("Y-m-d");

            //$data['Transport_Facility'] = $this->input->post('transportFacility');
            $data['assigned_bus'] = $this->input->post('assigned_bus');
            //$data['journey_type'] = $this->input->post('journeyType');
            //$data['fee_type???'] = $this->input->post('feeType');

            $VarTransport_Facility=$this->input->post('transportFacility');
            if($VarTransport_Facility == 'yes'){
                $data['Transport_Facility']  = '1';
            }else{
                $data['Transport_Facility']  = '2';
            }

            $journeyType = $this->input->post('journeyType');
            if($journeyType == 'oneWay'){
                $data['journey_type']  = '1';
            }else{
                $data['journey_type']  = '2';
            }

            $tripType = $this->input->post('tripType');
            if($tripType == 'pickup'){
                $data['journey_trip']  = '1';
            }else{
                $data['journey_trip']  = '2';
            }

            $VarAdmission_Type=$this->input->post('selectAdmissionType');
            if($VarAdmission_Type == 'normal'){
                $data['Admission_Type']  = '1';
            }else{
                $data['Admission_Type']  = '2';
            }

            $VarSex=$this->input->post('sex');
            
            if($VarSex == 'male'){
                $data['sex']  = 'M';
            }else{
                $data['sex']  = 'F';
            }
            
            
            $data['Student_Status']  = '1';
            //$data['assigned_bus']      = $this->input->post('assigned_bus');
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
            //$_FILES['userfile']['name'];

            $data['Street_Name'] = $this->input->post('streetName');
            $data['Area'] = $this->input->post('areaName');
            $data['pincode'] = $this->input->post('pinCode');
            $data['Landmark'] = $this->input->post('landmarkName');
            $data['Latitude'] = $this->input->post('latitude');
            $data['Longitude'] = $this->input->post('longitude');
            $data['assigned_bus'] = 0;
            
            /*$data['Transport_Facility'] = $this->input->post('transportFacility');
           
            $data['journey_type'] = $this->input->post('journeyType');
            $data['fee_type???'] = $this->input->post('feeType');*/

            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();


            $data2['student_id']     = $student_id;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data2['section_id'] = $this->input->post('section_id');
            }
            
            $data2['roll']           = $this->input->post('applicationNumber');
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            
            $this->db->insert('enroll', $data2);
        
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'index.php?parents/admit_child/'.$parent_id, 'refresh');

        }
       

        if ($param1 == 'add_document') {
            $updata['student_id'] = $this->input->post('student_id');
            $parent_id = $this->db->get_where('student' , array('student_id' => $updata['student_id']))->row()->parent_id;
            
        //uploading file using codeigniter upload library  
           $this->load->library('upload');
           $config['upload_path']   =  'uploads/student_document/';
           $config['allowed_types'] =  '*';  
           $this->upload->initialize($config);
           
           if($this->upload->do_upload('iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['iqama_copy'] = $upload_data['file_name'];
            $updata['iqama_issue_date']           = $this->input->post('child_iqama_issue');
            $updata['child_iqama_expiry']           = $this->input->post('child_iqama_expiry');
            $updata['iqama_place_of_issue']           = $this->input->post('child_iqama_issue_place');
           }
           if($this->upload->do_upload('child_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['child_passport_copy'] = $upload_data['file_name'];
            $updata['child_passport_issue_date']           = $this->input->post('child_passport_issue');
            $updata['child_passport_expiry']           = $this->input->post('child_passport_expiry');
            $updata['child_passport_issue_place']           = $this->input->post('child_passport_issue_place');
           }
           if($this->upload->do_upload('father_iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['father_iqama_copy'] = $upload_data['file_name'];
            $updata['father_iqama_issue_date']   = $this->input->post('father_iqama_issue_date');
            $updata['father_iqama_expiry']   = $this->input->post('father_iqama_expiry');
            $updata['father_iqama_issue_place']   = $this->input->post('father_iqama_issue_place');
            
           }
           if($this->upload->do_upload('mother_iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['mother_iqama_copy'] = $upload_data['file_name'];
            $updata['mother_iqama_issue_date']           = $this->input->post('mother_iqama_issue_date');
            $updata['mother_iqama_expiry']           = $this->input->post('mother_iqama_expiry');
            $updata['mother_iqama_issue_place']           = $this->input->post('mother_iqama_issue_place');
           }
           
           if($this->upload->do_upload('father_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['father_passport_copy'] = $upload_data['file_name'];
            $updata['father_passport_issue_date']           = $this->input->post('father_passport_issue_date');
            $updata['father_passport_expiry']           = $this->input->post('father_passport_expiry');
            $updata['father_passport_issue_place']           = $this->input->post('father_passport_issue_place');
           }
           if($this->upload->do_upload('mother_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['mother_passport_copy'] = $upload_data['file_name'];
            $updata['mother_passport_issue_date']           = $this->input->post('mother_passport_issue_date');
            $updata['mother_passport_expiry']           = $this->input->post('mother_passport_expiry');
            $updata['mother_passport_issue_place']           = $this->input->post('mother_passport_issue_place');
           }
           if($this->upload->do_upload('birth_certificate')){
            $upload_data = $this->upload->data();
            $updata['birth_certificate'] = $upload_data['file_name'];
            }
           if($this->upload->do_upload('previous_progress_report')){
            $upload_data = $this->upload->data();
            $updata['previous_progress_report'] = $upload_data['file_name'];
            $updata['child_grade'] = $this->input->post('report_card_grade');
            
           }
           if($this->upload->do_upload('first_semester_report_card')){
            $upload_data = $this->upload->data();
            $updata['first_sem_report_card'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('fee_clearence_previous_school')){
            $upload_data = $this->upload->data();
            $updata['fee_clearence_previous_school'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('transfer_certificate')){
            $upload_data = $this->upload->data();
            $updata['transfer_certificate'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('signed_admission_form')){
            $upload_data = $this->upload->data();
            $updata['signed_admission_form'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('vaccination_copy')){
            $upload_data = $this->upload->data();
            $updata['vaccination_copy'] = $upload_data['file_name'];
           }
           
           if($this->upload->do_upload('letter_from_guardian_company')){
            $upload_data = $this->upload->data();
            $updata['letter_from_guardian_company'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('student_photo')){
            $upload_data = $this->upload->data();
            $updata['student_photo'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('medical_insurance')){
            $upload_data = $this->upload->data();
            $updata['medical_insurance'] = $upload_data['file_name'];
           }
          
          $this->db->insert('student_documents', $updata);
          $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
          redirect(base_url() . 'index.php?parents/admit_child/'.$parent_id, 'refresh');

        }

        if ($param1 == 'do_update') {
            
      $data['Admission_Status'] = $this->input->post('Admission_Status');
      if ($data['Admission_Status'] != 1) {
          $data['Admission_Status'] = 2;
           $data['reject_reason'] = null;
      $data['student_code'] = $this->input->post('student_code');
      $data['academic_year'] = $this->input->post('academic_year');
      $data['Date_of_Registeration'] = $this->input->post('Date_of_Registeration');
      $data['name'] = $this->input->post('name');
      $data['DOB'] = $this->input->post('DOB');
      $data['place_of_birth'] = $this->input->post('place_of_birth');
      $data['blood_group'] = $this->input->post('blood_group');
      $data['religion'] = $this->input->post('religion');
      $data['mother_tongue'] = $this->input->post('mother_tongue');
      $data['phone'] = $this->input->post('phone');
      $data['email'] = $this->input->post('email');
      $data['last_school_attended'] = $this->input->post('last_school_attended');
      $data['last_school_address'] = $this->input->post('last_school_address');
      $data['allergies'] = $this->input->post('allergies');
      //$data['class_id'] = $this->input->post('class_id');
      //$data['class_name'] = $this->db->get_where('class' , array('class_id' => $data['class_id']))->row()->name;
      //$data['section_id'] = $this->input->post('section_id');
      //$data['section_name'] = $this->db->get_where('section' , array('section_id' => $data['section_id']))->row()->name;
      $data['Date_of_Registeration']  = date("Y-m-d");

      $data['assigned_bus'] = $this->input->post('assigned_bus');

      $VarTransport_Facility=$this->input->post('Transport_Facility');
      if($VarTransport_Facility == 'yes'){
        $data['Transport_Facility']  = '1';
      }else{
        $data['Transport_Facility']  = '2';
      }

      $journeyType = $this->input->post('Journey_Type');
      if($journeyType == 'oneWay'){
        $data['journey_type']  = '1';
      }else{
        $data['journey_type']  = '2';
      }

      $tripType = $this->input->post('tripType');
      if($tripType == 'pickup'){
        $data['journey_trip']  = '1';
      }else{
        $data['journey_trip']  = '2';
      }

      $VarAdmission_Type=$this->input->post('Admission_Type');
      if($VarAdmission_Type == 'normal'){
        $data['Admission_Type']  = '1';
      }else{
        $data['Admission_Type']  = '2';
      }

      $VarSex=$this->input->post('sex');
      
      if($VarSex == 'male'){
        $data['sex']  = 'M';
      }else{
        $data['sex']  = 'F';
      }
      
      $data['Student_Status']  = '1';
      //$data['assigned_bus']      = $this->input->post('assigned_bus');
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
      if($this->upload->do_upload('userfile')){
            $upload_data = $this->upload->data();
            $data['photo']  = $upload_data['file_name'];
      }
      //$_FILES['userfile']['name'];
      $data['Street_Name'] = $this->input->post('streetName');
      $data['Area'] = $this->input->post('Area');
      $data['pincode'] = $this->input->post('pincode');
      $data['Landmark'] = $this->input->post('Landmark');
      $data['Latitude'] = $this->input->post('Latitude');
      $data['Longitude'] = $this->input->post('Longitude');
      $data['assigned_bus'] = 0;
        
      $this->db->where('student_id', $param2);
      $this->db->update('student', $data);  
      
      //unlink the student from route / transport if changed
      if($data['Transport_Facility']== '2'){
          $StuData=array('pickup_route_id'=>0,'drop_route_id'=>0,'assigned_bus'=>0);
          $this->db->where('student_id', $param2);
          $this->db->update('student',$StuData);
          
          //delete from route stops
          $this->db->where('assigned_to', $param2."-student");
          $this->db->delete('route_stops'); 
      }
      
      if($data['journey_trip']  == '1'){
            $StuData=array('drop_route_id'=>0);
            $this->db->where('student_id', $param2);
            $this->db->update('student',$StuData);
            //delete from route stops
            $this->db->where('assigned_to', $param2."-student");
            $this->db->where('trip_type',2);
            $this->db->delete('route_stops'); 
      }
       if($data['journey_trip']  == '2'){
            $StuData=array('pickup_route_id'=>0);
            $this->db->where('student_id', $param2);
            $this->db->update('student',$StuData);
            //delete from route stops
            $this->db->where('assigned_to', $param2."-student");
            $this->db->where('trip_type',1);
            $this->db->delete('route_stops'); 
      }
      
      
      
      //$student_id = $this->db->insert_id();
      $parent_id = $this->db->get_where('student' , array('student_id' => $param2))->row()->parent_id;
      //$data1['parent_id'] = $parent_id;

      $this->load->library('ApiCrypter');
            //$parent_id = $this->input->post('parent_id');
            $data1['email'] = $this->input->post('father_email');
           //$data1['password'] = $this->apicrypter->encrypt($this->input->post('password'));
            $data1['password'] = $this->input->post('password');
            $data1['name'] = $this->input->post('Father_Name');
            $data1['father_nationality'] = $this->input->post('father_nationality');
            $data1['profession'] = $this->input->post('profession');
            $data1['father_empr_sponsor_name'] = $this->input->post('father_empr_sponsor_name');
            $data1['father_work_address'] = $this->input->post('father_work_address');
            $data1['mother_name'] = $this->input->post('mother_name');
            $data1['mother_nationality'] = $this->input->post('mother_nationality');
            $data1['mother_occupation'] = $this->input->post('mother_occupation');
            $data1['mother_empr_sponsor_name'] = $this->input->post('mother_empr_sponsor_name');
            $data1['mother_work_address'] = $this->input->post('mother_work_address');

            $data1['mother_email'] = $this->input->post('mother_email');
            $data1['Father_Primary_Mobile'] = $this->input->post('Father_Primary_Mobile');
            $data1['Father_Secondary_Mobile'] = $this->input->post('Father_Secondary_Mobile');
            $data1['Mother_Primary_Mobile'] = $this->input->post('Mother_Primary_Mobile');
            $data1['Mother_Secondary_Mobile'] = $this->input->post('Mother_Secondary_Mobile');
            $data1['Home_Landline'] = $this->input->post('Home_Landline');
            $data1['father_office_landline'] = $this->input->post('father_office_landline');
            $data1['mother_office_landline'] = $this->input->post('mother_office_landline');
            $data1['Emer_Contact_Person_Name_Primary'] = $this->input->post('Emer_Contact_Person_Name_Primary');
            $data1['Emer_Contact_Person_Name_Secondary'] = $this->input->post('Emer_Contact_Person_Name_Secondary');
            $data1['Emer_Contact_Person_Number_Primary'] = $this->input->post('Emer_Contact_Person_Number_Primary');
            $data1['Emer_Contact_Person_Number_Secondary'] = $this->input->post('Emer_Contact_Person_Number_Secondary');

            $this->db->where('parent_id', $parent_id);
            $this->db->update('parent', $data1); 

            $data2['student_id']     = $param2;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']       = $this->input->post('class_id');
            $data2['section_id'] = $this->input->post('section_id');
            $data2['roll']           = $this->input->post('student_code');
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
 
      //$this->db->insert('enroll', $data2);
      $this->db->where('student_id', $param2);
      $this->db->update('enroll', $data2);
      }
            
            //uploading file using codeigniter upload library  
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/student_document/';
            $config['allowed_types'] =  '*';  
            $this->upload->initialize($config);
            $updata = array();
            
            if($this->upload->do_upload('iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['iqama_copy'] = $upload_data['file_name'];
           }
           $updata['iqama_issue_date']           = $this->input->post('iqama_issue_date');
            $updata['child_iqama_expiry']           = $this->input->post('child_iqama_expiry');
            $updata['iqama_place_of_issue']           = $this->input->post('iqama_place_of_issue');

           if($this->upload->do_upload('child_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['child_passport_copy'] = $upload_data['file_name'];
           }
           $updata['child_passport_issue_date']           = $this->input->post('child_passport_issue_date');
            $updata['child_passport_expiry']           = $this->input->post('child_passport_expiry');
            $updata['child_passport_issue_place']           = $this->input->post('child_passport_issue_place');

           if($this->upload->do_upload('father_iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['father_iqama_copy'] = $upload_data['file_name'];
           }
           $updata['father_iqama_issue_date']   = $this->input->post('father_iqama_issue_date');
            $updata['father_iqama_expiry']   = $this->input->post('father_iqama_expiry');
            $updata['father_iqama_issue_place']   = $this->input->post('father_iqama_issue_place');

           if($this->upload->do_upload('mother_iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['mother_iqama_copy'] = $upload_data['file_name'];
           }
           $updata['mother_iqama_issue_date']           = $this->input->post('mother_iqama_issue_date');
            $updata['mother_iqama_expiry']           = $this->input->post('mother_iqama_expiry');
            $updata['mother_iqama_issue_place']           = $this->input->post('mother_iqama_issue_place');
           
           if($this->upload->do_upload('father_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['father_passport_copy'] = $upload_data['file_name'];
           }
           $updata['father_passport_issue_date']           = $this->input->post('father_passport_issue_date');
            $updata['father_passport_expiry']           = $this->input->post('father_passport_expiry');
            $updata['father_passport_issue_place']           = $this->input->post('father_passport_issue_place');

           if($this->upload->do_upload('mother_passport_copy')){
            $upload_data = $this->upload->data();
            $updata['mother_passport_copy'] = $upload_data['file_name'];
           }
           $updata['mother_passport_issue_date']           = $this->input->post('mother_passport_issue_date');
            $updata['mother_passport_expiry']           = $this->input->post('mother_passport_expiry');
            $updata['mother_passport_issue_place']           = $this->input->post('mother_passport_issue_place');


           if($this->upload->do_upload('birth_certificate')){
            $upload_data = $this->upload->data();
            $updata['birth_certificate'] = $upload_data['file_name'];
            }
           if($this->upload->do_upload('previous_progress_report')){
            $upload_data = $this->upload->data();
            $updata['previous_progress_report'] = $upload_data['file_name'];
           }
           $updata['child_grade'] = $this->input->post('report_card_grade');
           
           if($this->upload->do_upload('first_semester_report_card')){
            $upload_data = $this->upload->data();
            $updata['first_sem_report_card'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('fee_clearence_previous_school')){
            $upload_data = $this->upload->data();
            $updata['fee_clearence_previous_school'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('transfer_certificate')){
            $upload_data = $this->upload->data();
            $updata['transfer_certificate'] = $upload_data['file_name'];
            
           }
           if($this->upload->do_upload('signed_admission_form')){
            $upload_data = $this->upload->data();
            $updata['signed_admission_form'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('vaccination_copy')){
            $upload_data = $this->upload->data();
            $updata['vaccination_copy'] = $upload_data['file_name'];
           }
           
           if($this->upload->do_upload('letter_from_guardian_company')){
            $upload_data = $this->upload->data();
            $updata['letter_from_guardian_company'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('student_photo')){
            $upload_data = $this->upload->data();
            $updata['student_photo'] = $upload_data['file_name'];
           }
           if($this->upload->do_upload('medical_insurance')){
            $upload_data = $this->upload->data();
            $updata['medical_insurance'] = $upload_data['file_name'];
           }
          
            $this->db->where('student_id', $param2);
            $this->db->update('student_documents', $updata);

            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('admission_updated'));
    
            redirect(base_url() . 'index.php?parents/child_information/'.$param2, 'refresh');
        } 
        
    }


/**** get notifications sorted on date and time *********/

    function get_notifications_order_by_time($parent_id){

      $this->db->select("*");
      $this->db->from("notify_alert");
      $this->db->where('alert_to', $parent_id);
      $this->db->where('user_type', '1');
      //$this->db->where('status', 1);
      $this->db->order_by("alert_on", "desc");
      $query = $this->db->get();
    
      echo json_encode($query->result());

    }

    /*** get notifications ***/

    function get_notifications($parent_id){

        /*if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');*/
        
        $notifications = $this->db->get_where('notify_alert' , array('user_type' => '1','alert_to' => $parent_id, 'status' => '1' ))->result_array();
        $arr['notifications'] = array();
        foreach ($notifications as $row) {

            array_push($arr['notifications'], $row);

        }


        echo json_encode($arr['notifications']); 

    }

    /**** changes notifications status *********/

    public function change_notifications_status($parent_id){

        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $data['status'] = 2;
        $this->db->where('user_type', '1');
        $this->db->where('alert_to', $parent_id);
        $this->db->update('notify_alert', $data);

    }

    
    //********* cron job for documents exipy notifications *********//
    function cron_job(){

        $students_id = $this->db->get('student_documents')->result_array();
        foreach ($students_id as $row) {
            $this->check_child_iqama($row['student_id'], $row['child_iqama_expiry']);
            $this->check_child_passport($row['student_id'], $row['child_passport_expiry']);
            $this->check_father_iqama($row['student_id'], $row['father_iqama_expiry']);
            $this->check_father_passport($row['student_id'], $row['father_passport_expiry']);
            $this->check_mother_iqama($row['student_id'], $row['mother_iqama_expiry']);
            $this->check_mother_passport($row['student_id'], $row['mother_passport_expiry']);
            $this->check_vaccination_date($row['student_id'], $row['vaccination_next_remainder']);
        }
		
		//assignment alert
		$sql = "SELECT A.due_date, E.student_id  FROM assignment_teacher A INNER JOIN enroll E 
			ON A.class_id=E.class_id AND A.section_id=E.section_id WHERE A.assignment_id NOT IN 
			(SELECT assignment_id FROM assignment_parent WHERE student_id=E.student_id AND subject_id=A.subject_id)";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->check_assignment_due_date($row['student_id'], $row['due_date']);
			}
		}
    }
	
	//check assignment due date and send alert to parent
    function check_assignment_due_date($student_id, $due_date){
        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($due_date);
        $diff = date_diff($to,$from);

		if (0 < $diff->format('%a') && $diff->format('%a') <= 2) {
			$data['alert_on'] = date('Y-m-d H:i:s');
			$data['alert_to'] = $parent_id;
			$data['alert_about'] = 7;
			$data['status'] = 1;
			$student_name=$this->crud_model->get_student_det($student_id);
			$data['alert_msg'] = "Hi!, Your child ".$student_name." assignment due date will be end in ".$diff->format('%a')." days, Kindly upload the assignment before due date";
			$this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
		}
    }


    function check_child_iqama($student_id, $child_iqama_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($child_iqama_expiry);
        $diff = date_diff($to,$from);
        
        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 1;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your child iqama is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
						//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your child iqama is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your child iqama is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
        
    }

    function check_child_passport($student_id, $child_passport_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($child_passport_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 2;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your child passport is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
						//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your child passport is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
						//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your child passport is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

    }

    function check_father_iqama($student_id, $father_iqama_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($father_iqama_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 3;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your iqama is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your iqama is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your iqama is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
    }

    function check_father_passport($student_id, $father_passport_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($father_passport_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 4;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your passport is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your passport is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your passport is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
    }

    function check_mother_iqama($student_id, $mother_iqama_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($mother_iqama_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 5;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your child's mother iqama is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your child's mother iqama is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);			
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your child's mother iqama is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
    }

    function check_mother_passport($student_id, $mother_passport_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
        date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($mother_passport_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 6;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your child's mother passport is going to expire in 30 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your child's mother passport is going to expire in 15 days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your child's mother passport is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
    }

    function check_vaccination_date($student_id, $vaccination_expiry){

        $parent_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;
       // date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($vaccination_expiry);
        $diff = date_diff($to,$from);

        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $parent_id;
        $data['alert_about'] = 6;
        $data['status'] = 1;

        if ($diff->format('%a') == 30) {
            $data['alert_msg'] = "Your child's next vaccination will be in 30 days";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your child's next vaccination will be in 15 days";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your child's mother passport is going to expire in ".$diff->format('%a')." days, please renew it and update in student documents";
			$data['alert_msg'] = "Your child's next vaccination will be in ".$diff->format('%a').", Please update in Student document";
            $this->db->insert('notify_alert', $data);
			
			//send push notification
			$this->send_push_notification_parent($parent_id,$data['alert_msg']);
        }
    }

	

	function send_push_notification_parent($parent_id,$msg)
	{
		//send push notification
		$gcm_id = $this->db->get_where('app_gcm_parents', array('User_Id' => $parent_id, 'User_Type'=>'parent'))->row()->GCM_RegId;
		$message = array("Notification" => $msg,"image_url" => "");	
		$this->gcm->clearRecepients();
		$this->gcm->addRecepient($gcm_id);
		$this->gcm->setData($message);
		$Type='parent';
		$this->gcm->send($Type);
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
     
    //*****  child_information ***//

    function child_information($student_id)
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'child_information';
        $page_data['page_title'] = get_phrase('child_information');
        $page_data['student_id']    = $student_id;
        $this->load->view('backend/index', $page_data);
    }
    

    
    
	//Notice will send only to the parents (in portal and in app)
	function notice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $page_data['page_name']  = 'notice';
        $page_data['page_title'] = get_phrase('notice');
        $page_data['notices']    = $this->db->get('app_notice_tbl')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	/* Homework */
    function homework($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'homework';
        $page_data['page_title'] = get_phrase('homework');
		
		 $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
        ))->row()->class_id;
		
		 $section_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
        ))->row()->section_id;
		
		
        $query = $this->db->get_where('homework' , array('class_id' =>$class_id,'section_id' =>$section_id ));
		if ($query->num_rows() > 0){
			$page_data['homework']    = $query->result_array();
		}else{
			$page_data['homework']    = array();
		}
        $this->load->view('backend/index', $page_data);
		
    }
	//Assignments
	function assignments($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
		
			$page_data['page_name']  = 'assignments';
			$page_data['page_title'] = get_phrase('assignments');
			
			 $class_id     = $this->db->get_where('enroll' , array(
				'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
			))->row()->class_id;
			
			 $section_id     = $this->db->get_where('enroll' , array(
				'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
			))->row()->section_id;
			
			
			$query = $this->db->get_where('assignment_teacher' , array('class_id' =>$class_id,'section_id' =>$section_id ));
			
			
			$page_data['assignment_teacher']    = $query->result_array();
			$page_data['student_id']    = $student_id;
			$this->load->view('backend/index', $page_data);	

    }
	
	function download_assignment($assignment_id)
    {
        $file_name = $this->db->get_where('assignment_teacher', array(
            'assignment_id' => $assignment_id
        ))->row()->assignment_doc_url;
        $this->load->helper('download');
        $data = file_get_contents("uploads/assignments_teacher/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }
	
	function assignment_upload($param2='',$param3='',$param4='')
    {
		//uploading file using codeigniter upload library
		$files = $_FILES['file_name'];
		$this->load->library('upload');
		$config['upload_path']   =  'uploads/assignments_parent/';
		$config['allowed_types'] =  '*';
		$_FILES['file_name']['name']     = $files['name'];
		$_FILES['file_name']['type']     = $files['type'];
		$_FILES['file_name']['tmp_name'] = $files['tmp_name'];
		$_FILES['file_name']['size']     = $files['size'];
		$this->upload->initialize($config);
		$this->upload->do_upload('file_name');

		$data['student_id'] =   $param3;
		$data['assignment_id']  = $param2;
		$data['subject_id']  = $param4;
		$upload_data = $this->upload->data();
		$data['doc_url']  = $upload_data['file_name'];
			
		//$_FILES['file_name']['name'];
		$data['added_on']  =   date('Y-m-d');
		$data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$this->db->insert('assignment_parent' , $data);
		// $assignment_id = $this->db->insert_id();
		$this->session->set_flashdata('flash_message' , get_phrase('uploaded_successfully'));
		
		$page_data['page_name']  = 'assignments';
		$page_data['page_title'] = get_phrase('assignments');
		
		 $class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $param3 , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
		))->row()->class_id;
		
		 $section_id     = $this->db->get_where('enroll' , array(
			'student_id' => $param3 , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
		))->row()->section_id;
		
		
		$query = $this->db->get_where('assignment_teacher' , array('class_id' =>$class_id,'section_id' =>$section_id ));
		
		$page_data['assignment_teacher']    = $query->result_array();
		$page_data['student_id']    = $param3;
		$this->load->view('backend/index', $page_data);	
            
    }
	//Events
	function events($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        

        $page_data['page_name']  = 'events';
        $page_data['page_title'] = get_phrase('events');
        $this->load->view('backend/index', $page_data); 
    }
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        //$page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }
    
    
    // ACADEMIC SYLLABUS
    function academic_syllabus($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
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
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->row();
        $parent_class_id        = $parent_profile->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $parent_class_id
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks($param1 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_marks');
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/parent/student_marksheet_print_view', $page_data);
    }
    
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/teacher/class_routine_print_view' , $page_data);
    }
    
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($student_id = '' , $param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('parent_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();
            
            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?parents/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?parents/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?parents/invoice/paypal_success');
            
            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);

                $data2['method']       =   'paypal';
                $data2['invoice_id']   =   $_POST['custom'];
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                $this->db->insert('payment' , $data2);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
        }
        $parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->row();
        $page_data['student_id'] = $student_id;
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        // $page_data['notices']    = $this->db->get('noticeboard')->result_array();
		/* only parents notice */
		$page_data['notices'] = $this->db->get_where('noticeboard', array('reciever' => 'parent'))->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?parents/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?parents/message/message_read/' . $param2, 'refresh');
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
			redirect(base_url() . 'index.php?parents/dashboard/', 'refresh'); 
		}
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['login']       = $this->input->post('email');
            
            $this->db->where('parent_id', $this->session->userdata('parent_id'));
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->apicrypter->encrypt($this->input->post('password'));
            $data['new_password']         = $this->apicrypter->encrypt($this->input->post('new_password'));
            $data['confirm_new_password'] = $this->apicrypter->encrypt($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('parent', array(
                'parent_id' => $this->session->userdata('parent_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
            
				$this->db->where('parent_id', $this->session->userdata('parent_id'));
                $this->db->update('parent', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
}
