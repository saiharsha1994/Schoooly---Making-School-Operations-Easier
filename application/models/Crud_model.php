<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    ////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }
function get_student_det($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        $res = $query->result_array();
		foreach ($res as $row)
            return $row['name'];
    }

    /////////TEACHER/////////////
    function get_teachers() {
        $query = $this->db->get('employee_details');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('employee_details', array('emp_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('employee_details', array('emp_id' => $teacher_id));
        return $query->result_array();
    }

    //////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    ////////////CLASS///////////
    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    //////////EXAMS/////////////
    function get_exams() {
        $query = $this->db->get_where('exam' , array(
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ));
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    //////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks( $exam_id , $class_id , $subject_id , $student_id) {
        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $subject_id,
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                                        
        foreach ($marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_highest_marks( $exam_id , $class_id , $subject_id ) {
        $this->db->where('exam_id' , $exam_id);
        $this->db->where('class_id' , $class_id);
        $this->db->where('subject_id' , $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }
	
	 ////////STUDENT IMAGE URL//////////
    function get_stu_image_url($id = '') {
		$photo= $this->db->get_where('student' , array('student_id' => $id))->row()->photo;
        if (file_exists('uploads/student_image/'.$photo))
            $image_url = base_url() . 'uploads/student_image/'.$photo;
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function get_att_image_url($name='') {
        if (file_exists('assets/images/'.$name))
            $image_url = base_url() . 'assets/images/'.$name;
        // else
        //     $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    ////////HR IMAGE URL//////////
    function get_hr_image_url($photo = '') {
        if (file_exists('uploads/hr_image/'.$photo))
            $image_url = base_url() . 'uploads/hr_image/'.$photo;
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    ////////STUDY MATERIAL//////////
    function save_study_material_info()
    {
        $data['timestamp']         = strtotime($this->input->post('timestamp'));
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['file_type']         = $this->input->post('file_type');
        $data['class_id']          = $this->input->post('class_id');
        $data['subject_id']        = $this->input->post('subject_id');
        /*$data['subject_id']='1';*/
        
        $this->db->insert('document',$data);
        
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }
    
    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array(); 
    }
    
    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }
    
    function update_study_material_info($par0,$par1,$par2,$par3,$par4,$par5)
    {
        $data['timestamp']      = strtotime($par1);
        $data['title']      = $par2;
        $data['description']    = $par5;
        $data['class_id']   = $par3;
        $data['subject_id']        = $par4;
        
        $this->db->where('document_id',$par0);
        $this->db->update('document',$data);
    }
    
    function delete_study_material_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }
    

    ////////Leave Management//////
    function leave_data($param1,$param2){
       return $this->db->get_where('leave_records', array('user_type' => $param2,'student_id' => $param1))->result_array();
        /*$this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array();*/ 
    }

    function save_leave_apply(){
        $teacher_id1    = $this->session->userdata('login_user_id');
        $date1  =date("Y-m-d");
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;

        $now = strtotime($this->input->post('timestamp1'));
        $your_date = strtotime($this->input->post('timestamp2'));
        $datediff =$your_date  - $now;
        $diff= floor($datediff / (60 * 60 * 24));

        if($this->input->post('description')==''){
            $reason='--';
        }
        else{
            $reason=$this->input->post('description');
        }

		$type= $this->session->userdata('role_id');
        $type_arr=explode(",",$type);
        $data['student_id']      = $teacher_id1;
        $data['user_type']       = $type_arr[0];
        $data['from_date']         = date("Y-m-d",strtotime($this->input->post('timestamp1')));
        $data['to_date']             = date("Y-m-d",strtotime($this->input->post('timestamp2')));
        $data['reason']       = $reason;
        $data['status']       = '1';
        $data['no_of_days']       = $diff+1;
        $data['applied_on']      = $date1;
        $data['year']      = $running_year;
        $this->db->insert('leave_records',$data);
    }

    function resave_leave_apply(){
        $rowid=$this->input->post('leave_id');
        $date1  =date("Y-m-d");
        $now = strtotime($this->input->post('timestamp1'));
        $your_date = strtotime($this->input->post('timestamp2'));
        $datediff =$your_date  - $now;
        $diff= floor($datediff / (60 * 60 * 24));

        if($this->input->post('description')==''){
            $reason='--';
        }
        else{
            $reason=$this->input->post('description');
        }

        $data['from_date']         = strtotime($this->input->post('timestamp1'));
        $data['to_date']             = strtotime($this->input->post('timestamp2'));
        $data['reason']       = $reason;
        $data['status']       = '1';
        $data['no_of_days']       = $diff+1;
        $data['applied_on']      = $date1;

        $this->db->where('id',$rowid);
        $this->db->update('leave_records',$data);

    }

    //HR Management
    function save_hr_details(){
        $doc_iqama=$_FILES["iqama_doc"]["name"];
        $doc_passport=$_FILES["passport_doc"]["name"];
        $doc_photo=$_FILES["photo"]["name"];
        $data['name']=$this->input->post('name');
        if($this->input->post('qualification')==""){
            $data['qualification']="null";
        }
        else{
            $data['qualification']=$this->input->post('qualification');
        }
        if($this->input->post('age')==""){
            $data['age']="null";
        }
        else{
            $data['age']=$this->input->post('age');
        }
        if($this->input->post('gender')==""){
            $data['sex']="null";
        }
        else{
            $data['sex']=$this->input->post('gender');
        }
        if($this->input->post('address')==""){
            $data['address']="null";
        }
        else{
            $data['address']=$this->input->post('address');
        }
        $data['mobile']=$this->input->post('mobile');
        $data['email']=$this->input->post('email');
        if($this->input->post('alternate_contact')==""){
            $data['alternate_contact']="null";
        }
        else{
            $data['alternate_contact']=$this->input->post('alternate_contact');
        }
        $data['password']=$this->input->post('password');
        if($doc_iqama==""){
            $data['iqama_doc']="null";
        }
        else{
            $data['iqama_doc']=$_FILES["iqama_doc"]["name"];
        }
        if($this->input->post('iqama_no')==""){
            $data['iqama_no']="null";
        }
        else{
            $data['iqama_no']=$this->input->post('iqama_no');
        }
        if($this->input->post('iqama_applied_on')==""){
            $data['iqama_applied_on']="null";
        }
        else{
            $data['iqama_applied_on']=$this->input->post('iqama_applied_on');
        }
        if($this->input->post('iqama_expire_on')==""){
            $data['iqama_expire_on']="null";
        }
        else{
            $data['iqama_expire_on']=$this->input->post('iqama_expire_on');
        }
        if($doc_passport==""){
            $data['passport_doc']="null";
        }
        else{
            $data['passport_doc']=$_FILES["passport_doc"]["name"];
        }
        if($this->input->post('passport_no')==""){
            $data['passport_no']="null";
        }
        else{
            $data['passport_no']=$this->input->post('passport_no');
        }
        if($this->input->post('passport_applied_on')==""){
            $data['passport_applied_on']="null";
        }
        else{
            $data['passport_applied_on']=$this->input->post('passport_applied_on');
        }
        if($this->input->post('passport_expire_on')==""){
            $data['passport_expire_on']="null";
        }
        else{
            $data['passport_expire_on']=$this->input->post('passport_expire_on');
        }
        if($doc_photo==""){
            $data['photo']="null";
        }
        else{
            $data['photo']=$_FILES["photo"]["name"];
        }
        $this->db->insert('hr_details',$data);
        move_uploaded_file($_FILES["iqama_doc"]["tmp_name"], "uploads/document/" . $_FILES["iqama_doc"]["name"]);
        move_uploaded_file($_FILES["passport_doc"]["tmp_name"], "uploads/document/" . $_FILES["passport_doc"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/hr_image/" . $_FILES["photo"]["name"]);
    }

    function update_hr_details(){
        $rowhrid=$this->input->post('hiddenid');
        $hiddeniqamadoc=$this->input->post('iqamahidden');
        $hiddenpassportdoc=$this->input->post('passporthidden');
        $hiddenphotodoc=$this->input->post('photohidden');
        $doc_iqama=$_FILES["iqama_doc"]["name"];
        $doc_passport=$_FILES["passport_doc"]["name"];
        $doc_photo=$_FILES["photo"]["name"];
        $data['name']=$this->input->post('name');
        if($this->input->post('qualification')==""){
            $data['qualification']="null";
        }
        else{
            $data['qualification']=$this->input->post('qualification');
        }
        if($this->input->post('age')==""){
            $data['age']="null";
        }
        else{
            $data['age']=$this->input->post('age');
        }
        if($this->input->post('gender')==""){
            $data['sex']="null";
        }
        else{
            $data['sex']=$this->input->post('gender');
        }
        if($this->input->post('address')==""){
            $data['address']="null";
        }
        else{
            $data['address']=$this->input->post('address');
        }
        $data['mobile']=$this->input->post('mobile');
        $data['email']=$this->input->post('email');
        if($this->input->post('alternate_contact')==""){
            $data['alternate_contact']="null";
        }
        else{
            $data['alternate_contact']=$this->input->post('alternate_contact');
        }
        $data['password']=$this->input->post('password');
        if($doc_iqama==""){
            $data['iqama_doc']=$hiddeniqamadoc;
        }
        else{
            $data['iqama_doc']=$_FILES["iqama_doc"]["name"];
        }
        if($this->input->post('iqama_no')==""){
            $data['iqama_no']="null";
        }
        else{
            $data['iqama_no']=$this->input->post('iqama_no');
        }
        if($this->input->post('iqama_applied_on')==""){
            $data['iqama_applied_on']="null";
        }
        else{
            $data['iqama_applied_on']=$this->input->post('iqama_applied_on');
        }
        if($this->input->post('iqama_expire_on')==""){
            $data['iqama_expire_on']="null";
        }
        else{
            $data['iqama_expire_on']=$this->input->post('iqama_expire_on');
        }
        if($doc_passport==""){
            $data['passport_doc']=$hiddenpassportdoc;
        }
        else{
            $data['passport_doc']=$_FILES["passport_doc"]["name"];
        }
        if($this->input->post('passport_no')==""){
            $data['passport_no']="null";
        }
        else{
            $data['passport_no']=$this->input->post('passport_no');
        }
        if($this->input->post('passport_applied_on')==""){
            $data['passport_applied_on']="null";
        }
        else{
            $data['passport_applied_on']=$this->input->post('passport_applied_on');
        }
        if($this->input->post('passport_expire_on')==""){
            $data['passport_expire_on']="null";
        }
        else{
            $data['passport_expire_on']=$this->input->post('passport_expire_on');
        }
        if($doc_photo==""){
            $data['photo']=$hiddenphotodoc;
        }
        else{
            $data['photo']=$_FILES["photo"]["name"];
        }
        $this->db->where('hr_id',$rowhrid);
        $this->db->update('hr_details',$data);
        move_uploaded_file($_FILES["iqama_doc"]["tmp_name"], "uploads/document/" . $_FILES["iqama_doc"]["name"]);
        move_uploaded_file($_FILES["passport_doc"]["tmp_name"], "uploads/document/" . $_FILES["passport_doc"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/hr_image/" . $_FILES["photo"]["name"]);
    }

    //////EXIT REENTRIES///////
    function exit_reentry_data($param1,$param2){
        return $this->db->get_where('exit_re_entries', array('emp_id' => $param1,'emp_type' => $param2))->result_array();
    }

    function save_exit_re_entry(){
        $teacher_id= $this->session->userdata('login_user_id');
        //$type1= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TEACHER'))->row()->id;
        /* $type=$this->session->userdata('login_type');
        if(strtolower($type)=="teacher"){
          $type=1;
         }
         if(strtolower($type)=="driver"){
          $type=2;
         }
         if(strtolower($type)=="transport admin"){
          $type=3;
         }
         if(strtolower($type)=="non teaching staff"){
          $type=4;
         }
         if(strtolower($type)=="supervisor"){
          $type=5;
         }
         if(strtolower($type)=="hr"){
          $type=6;
         }
         if(strtolower($type)=="admin"){
          $type=7;
         } */
		 $type= $this->session->userdata('role_id');
        $type_arr=explode(",",$type);
		
        $status= 1;
        $filename=$_FILES["file_name"]["name"]; 
        $data['emp_id']            = $teacher_id;
        $data['emp_type']          = $type_arr[0];
        $data['no_of_months']       = $this->input->post('no_of_months');
        if(($this->input->post('from_date'))==""){
            $data['from_date']       = "null";
        }
        else{
            $fromdate=date('Y-m-d', strtotime($this->input->post('from_date')));
        $data['from_date']       = $fromdate;
        }
        if(($this->input->post('to_date'))==""){
            $data['to_date']       = "null";
        }
        else{
            $todate=date('Y-m-d', strtotime($this->input->post('to_date')));
            $data['to_date']       = $todate;
        }
        if($filename==""){
            $data['document']         = "null";
        }
        else{
            $data['document']         = $_FILES["file_name"]["name"];
        }
        $data['executed_doc']         = "null";
        $data['status']= $status;
         $this->db->insert('exit_re_entries',$data);
         move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }

    function resave_reentries_apply(){
        $rowid=$this->input->post('reapply_id');
        $status= 1;
        $filename=$_FILES["file_name"]["name"]; 
        $data['no_of_months']       = $this->input->post('no_of_months');
        if($filename==""){
            $data['document']         = "null";
        }
        else{
            $data['document']         = $_FILES["file_name"]["name"];
        }
        if(($this->input->post('from_date'))==""){
            $data['from_date']       = "null";
        }
        else{
            $fromdate=date('Y-m-d', strtotime($this->input->post('from_date')));
        $data['from_date']       = $fromdate;
        }
        if(($this->input->post('to_date'))==""){
            $data['to_date']       = "null";
        }
        else{
            $todate=date('Y-m-d', strtotime($this->input->post('to_date')));
            $data['to_date']       = $todate;
        }
        $data['status']= $status;
        $data['reject_reason_hr']= "";
        $data['reject_reason_ministry']= "";
        $this->db->where('id',$rowid);
        $this->db->update('exit_re_entries',$data);
         move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);

    }

    ////////private message//////
    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $data_message['post_type']              = 1; // 1=> Text message
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }
	
	/* Group Private Message */
	function send_group_private_message($class_id, $section_id) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
		$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id , 'section_id' => $section_id , 'year' => $running_year))->result_array();
        foreach($students as $row) {
			$Parent_Id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
			$reciever = 'parent-'.$Parent_Id;			
			$sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

			//check if the thread between those 2 users exists, if not create new thread
			$num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
			$num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

			if ($num1 == 0 && $num2 == 0) {
				$message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
				$data_message_thread['message_thread_code'] = $message_thread_code;
				$data_message_thread['sender']              = $sender;
				$data_message_thread['reciever']            = $reciever;
				$this->db->insert('message_thread', $data_message_thread);
			}
			if ($num1 > 0)
				$message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
			if ($num2 > 0)
				$message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
			
			$data_message['message_thread_code']    = $message_thread_code;
			$data_message['message']                = $message;
			$data_message['sender']                 = $sender;
			$data_message['timestamp']              = $timestamp;
			$data_message['post_type']              = 1; // 1=> Text message
			$this->db->insert('message', $data_message);
		}
        return $message_thread_code;
    }
	/* GCM PUSH NOTIFICATION */
	function send_gcm_message(){
		$sender_type  = $this->session->userdata('login_type');
		$reciever   = $this->input->post('reciever');
		$reciever_arr = explode('-',$reciever);
		$reciever_id = $reciever_arr[1];
		$reciever_type = $reciever_arr[0];
		if($reciever_type == 'parent' || $reciever_type == 'teacher'){
			$GCM_RegId = $this->db->get_where('app_gcm_parents' , array('User_Id' => $reciever_id, 'User_Type' => $reciever_type))->row()->GCM_RegId;
			if(trim($GCM_RegId)!=''){
				$this->load->library('GCM');
				$this->gcm->addRecepient($GCM_RegId);
				$message = array("Notification" => "Chat".$reciever_id."|".urldecode($sender_type).":\nAssalamu alaikum! You have a new message" ,"image_url" => "");
				
				$this->gcm->setData($message);
				$Type=$reciever_type;
				$this->gcm->send($Type);
			}	
		}	
	}	

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
		$data_message['post_type']              = 1; // 1=> Text message
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }
	/* Student CSV Upload */
	public function insertCSV($data, $admissionID=0){
        $this->db->where('student_code',$admissionID);
		$q = $this->db->get('student');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('student_code',$admissionID);
			$this->db->update('student',$data);
			return $this->db->get('student')->row()->student_id;
		} else {
			$this->db->set('student_code', $admissionID);
			$this->db->insert('student', $data);
			return $this->db->insert_id();
		}	
        // $this->db->insert('student', $data);
        // return $this->db->insert_id();
    }
	/* Parent CSV Upload */
	public function insertParentCSV($dataParent,$email){
		
		/*$insertUpdateQuery="INSERT INTO parent (name, email, password,phone, address,profession) VALUES ('"
			.$dataParent['name']."', '"$dataParent['email']."', '"$dataParent['password']."','"$dataParent['phone']."', '"$dataParent['address']."','"$dataParent['profession']."') "
			."ON DUPLICATE KEY UPDATE email='"$dataParent['email']."'";
			if($this->db->query($insertUpdateQuery)){
				return $this->db->insert_id();	
			}*/
			
		$this->db->where('email',$email);
		$q = $this->db->get('parent');
		if ( $q->num_rows() > 0 ) 
		{
			$this->db->where('email',$email);
			$this->db->update('parent',$dataParent);
			return $this->db->get('parent')->row()->parent_id;
			
		} else {
			$this->db->set('email', $email);
			$this->db->insert('parent',$dataParent);
			return $this->db->insert_id();
		}
			
		/*$dataParent = array(   
					'name' => $parent_name,
					'phone' => $phone,
					'profession' => $profession,
					'address' => $emapData[36],
					'email' => $emapData[23],
					'password' => $this->apicrypter->encrypt($emapData[24]));	
        $this->db->insert('parent', $dataParent);
        return */
    }
	
	/* teacher CSV Upload */
	public function insertTeacherCSV($TeacherData,$email){
		$this->db->where('email',$email);
		$q = $this->db->get('teacher');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('email',$email);
			$this->db->update('teacher',$TeacherData);
			return $this->db->get('teacher')->row()->teacher_id;
		} else {
			$this->db->set('email', $email);
			$this->db->insert('teacher',$TeacherData);
			return $this->db->insert_id();
		}
    }

    public function insertEmployeeCSV($EmployeeData,$iqama_id){
        $this->db->where('iqama_number',$iqama_id);
        $q = $this->db->get('employee_details');
        if ($q->num_rows() > 0) 
        {
            $this->db->where('iqama_number',$iqama_id);
            $this->db->update('employee_details',$EmployeeData);
            return $this->db->get('employee_details')->row()->emp_id;
        } else {
            // $this->db->set('email', $email);
            $this->db->insert('employee_details',$EmployeeData);
            return $this->db->insert_id();
        }
    }
	
}
