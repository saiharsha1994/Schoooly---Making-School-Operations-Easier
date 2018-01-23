    <?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /*	
     *	@author 	: Joyonto Roy
     *	date		: 27 september, 2014
     *	Ekattor School Management System Pro
     *	http://codecanyon.net/user/Creativeitem
     *	support@creativeitem.com
     */

    class Admin extends CI_Controller
    {
        function __construct()
        {
          parent::__construct();
          $this->load->database();
          $this->load->library('session');
          
          /*cache control*/
          $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
          $this->output->set_header('Pragma: no-cache');
          
      }
      
      /***default functin, redirects to login page if no admin logged in yet***/
      public function index()
      {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /***Admission Management***/

    public function get_pending_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $base_url = base_url();
    		//echo $base_url;
        $students = $this->db->get_where('student' , array('Admission_Status' => '2' ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModal('.$row['student_id'].')"><i class="entypo-user"></i></i>Profile</li></a></li><li><a href="#" onclick="approve('.$row['student_id'].')"><i class="glyphicon glyphicon-ok"></i>Approve</li></a></li><li><a href="#" onclick="reject('.$row['student_id'].')"><i class="glyphicon glyphicon-remove"></i>Reject</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);

    }


    public function get_pending_filter_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $students = $this->db->get_where('student' , array('Admission_Status' => '2', 'class_id' => $class_id, 'section_id' => $section_id ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModal('.$row['student_id'].')"><i class="entypo-user"></i></i>Profile</li></a></li><li><a href="#" onclick="approve('.$row['student_id'].')"><i class="glyphicon glyphicon-ok"></i>Approve</li></a></li><li><a href="#" onclick="reject('.$row['student_id'].')"><i class="glyphicon glyphicon-remove"></i>Reject</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);
    }

    /***************filtered approved data *******************/

    public function get_approved_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $base_url = base_url();
    		//echo $base_url;
        $students = $this->db->get_where('student' , array('Admission_Status' => '1' ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModal('.$row['student_id'].')"><i class="entypo-user"></i>Profile</a></li><li><a href="#" onclick="showModalEdit('.$row['student_id'].')"><i class="entypo-pencil"></i>Edit</a></li><li><a href="#" onclick="showModalDelete('.$row['student_id'].')"><i class="entypo-trash"></i>Delete</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);

    }


    public function get_approved_filter_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $students = $this->db->get_where('student' , array('Admission_Status' => '1', 'class_id' => $class_id, 'section_id' => $section_id ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModal('.$row['student_id'].')"><i class="entypo-user"></i>Profile</a></li><li><a href="#" onclick="showModalEdit('.$row['student_id'].')"><i class="entypo-pencil"></i>Edit</a></li><li><a href="#" onclick="showModalDelete('.$row['student_id'].')"><i class="entypo-trash"></i>Delete</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);
    }

    /***************filtered approved data *******************/
    public function get_rejected_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $base_url = base_url();
    		//echo $base_url;
        $students = $this->db->get_where('student' , array('Admission_Status' => '3' ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModalDelete('.$row['student_id'].')"><i class="entypo-trash"></i>Delete</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);

    }


    public function get_rejected_filter_data(){
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $students = $this->db->get_where('student' , array('Admission_Status' => '3', 'class_id' => $class_id, 'section_id' => $section_id ))->result_array(); 
            //echo json_encode($students);
            //echo "<br>";
        $arr['students'] = array();
        foreach ($students as $row) {
         
            $parent_name = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;
            $parent_email = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;

            $button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="showModalDelete('.$row['student_id'].')"><i class="entypo-trash"></i>Delete</a></li></ul></div>';

            array_push($arr['students'], $row + array('parent_name' => $parent_name, 'parent_email' => $parent_email, 'btn' => $button));

        }


        echo json_encode($arr['students']);
    }

    function inventory_type(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'inventory_type';
    $page_data['page_title'] = get_phrase('create_inventory_type');
    $this->load->view('backend/index', $page_data);
    }

    function add_inventory_type(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['type_code']      = $this->input->post('type_code');
    $data['name']       = $this->input->post('name');
    $data['description']         = $this->input->post('description');

    $this->db->insert('inventory_type',$data);

    $this->session->set_flashdata('flash_message' , get_phrase('new_type_created'));
    redirect(base_url() . 'index.php?admin/inventory_type' , 'refresh'); 
    }

    function edit_inventory_type($param1=''){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['type_code']      = $this->input->post('type_code');
    $data['name']       = $this->input->post('name');
    $data['description']         = $this->input->post('description');

    $this->db->where('id', $param1);
    $this->db->update('inventory_type', $data);

    $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    redirect(base_url() . 'index.php?admin/inventory_type' , 'refresh'); 
    }

    function delete_inventory_type($param1='')
    {
        $this->db->where('id', $param1);
        $this->db->delete('inventory_type');

        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/inventory_type', 'refresh');

    }

    function create_inventory(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'create_inventory';
    $page_data['page_title'] = get_phrase('create_inventory_categories');
    $this->load->view('backend/index', $page_data);
    }

    function add_inventory_category(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['item_code']      = $this->input->post('item_code');
    $data['type_id']      = $this->input->post('inventory_type');
    $data['name']       = $this->input->post('name');
    $data['description']         = $this->input->post('description');
    $data['suggested_quantity']             = $this->input->post('suggested_quantity');
    $data['reorder_trigger']       = $this->input->post('reorder_trigger');
    $data['reorder_quantity']       = $this->input->post('reorder_quantity');
    $data['stock']       = $this->input->post('stock');

    $this->db->insert('inventory_categories',$data);

    $this->session->set_flashdata('flash_message' , get_phrase('category_added'));
    redirect(base_url() . 'index.php?admin/create_inventory' , 'refresh'); 
    }

    function edit_inventory_category($param1=''){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['item_code']      = $this->input->post('item_code');
    $data['type_id']      = $this->input->post('inventory_type');
    $data['name']       = $this->input->post('name');
    $data['description']         = $this->input->post('description');
    $data['suggested_quantity']             = $this->input->post('suggested_quantity');
    $data['reorder_trigger']       = $this->input->post('reorder_trigger');
    $data['reorder_quantity']       = $this->input->post('reorder_quantity');
    $data['stock']       = $this->input->post('stock');

    $this->db->where('id', $param1);
    $this->db->update('inventory_categories', $data);

    $this->session->set_flashdata('flash_message' , get_phrase('category_added'));
    redirect(base_url() . 'index.php?admin/create_inventory' , 'refresh'); 
    }

    function delete_inventory_category($param1='')
    {
        $this->db->where('id', $param1);
        $this->db->delete('inventory_categories');

        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/inventory_type', 'refresh');

    }




    function request_inventory(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'request_inventory';
    $page_data['page_title'] = get_phrase('request_inventory');
    $this->load->view('backend/index', $page_data);
    }

    function get_employees_roles($role_id)
    {
        $employees   =   $this->db->get('employee_details')->result_array();

            foreach($employees as $row){
                $exists=0;

                $x = explode(',', $row['emp_type']);
                foreach ($x as $r) {
                    if($r!=''&&$r==$role_id){
                        $exists=1;
                    }
                }  
                if($exists==1){
            echo '<option value="' . $row['emp_id'] . '">' . $row['name'] . '</option>';
        }
    }
    }

    function request_inventory_add(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['inventory_id']      = $this->input->post('inventory_id');
    $data['requested_by_role']      = $this->input->post('role');
    $data['requested_quantity']       = $this->input->post('requested_quantity');
    $data['requested_by']         = $this->input->post('emp_name');
    $data['requested_for']             = $this->input->post('requested_for');
    $data['date']       =  date("Y-m-d");

    $original_quantity = $this->db->get_where('inventory_categories' , array('id' => $this->input->post('inventory_id')))->row()->stock;
    $updated_quantity = $original_quantity - $this->input->post('requested_quantity');
    $data2['stock'] = $updated_quantity;

    $this->db->where('id', $this->input->post('inventory_id'));
    $this->db->update('inventory_categories', $data2);

    $this->db->insert('request_inventory',$data);

    $this->session->set_flashdata('flash_message' , get_phrase('inventory_request_submitted'));
    redirect(base_url() . 'index.php?admin/request_inventory' , 'refresh'); 
    }

    function request_inventory_delete($param1='',$param2='',$param3='')
    {

        $original_quantity = $this->db->get_where('inventory_categories' , array('id' => $param2))->row()->stock;
        $updated_quantity = $original_quantity + $param3;
        $data2['stock'] = $updated_quantity;

        $this->db->where('id', $param2);
        $this->db->update('inventory_categories', $data2);

        $this->db->where('id', $param1);
        $this->db->delete('request_inventory');

        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/request_inventory', 'refresh');

    }



    function reorder_inventory(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'reorder_inventory';
    $page_data['page_title'] = get_phrase('reorder_inventory');
    $this->load->view('backend/index', $page_data);
    }

    function reorder_inventory_add(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');


    $data['inventory_id']      = $this->input->post('inventory_id');
    $data['item_code']      = $this->input->post('item_code');
    $data['type_id']      = $this->input->post('type_id');

    $data['name']       = $this->input->post('name');
    $data['description']         = $this->input->post('description');
    $data['reorder_quantity']       = $this->input->post('reorder_quantity');
    $data['status']       = '1';

    $data2['ordered_stock'] = $this->input->post('reorder_quantity');

    $this->db->where('id', $this->input->post('inventory_id'));
    $this->db->update('inventory_categories', $data2);

    $this->db->insert('ordered_inventory',$data);

    $this->session->set_flashdata('flash_message' , get_phrase('ordered_inventory'));
    redirect(base_url() . 'index.php?admin/reorder_inventory' , 'refresh'); 
    }

    function ordered_inventory(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'ordered_inventory';
    $page_data['page_title'] = get_phrase('ordered_inventory');
    $this->load->view('backend/index', $page_data);
    }

    function ordered_inventory_receive(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $data['received_date']      = $this->input->post('received_date');
    $data['status']       = '2';

    $this->db->where('id', $this->input->post('id'));
    $this->db->update('ordered_inventory', $data);

    $original_quantity = $this->db->get_where('inventory_categories' , array('id' => $this->input->post('inventory_id')))->row()->stock;
    $ordered_quantity = $this->db->get_where('ordered_inventory' , array('id' => $this->input->post('id')))->row()->reorder_quantity;
    $updated_quantity = $original_quantity + $ordered_quantity;
    $data2['stock'] = $updated_quantity;
    $data2['ordered_stock'] = '0';

    $this->db->where('id', $this->input->post('inventory_id'));
    $this->db->update('inventory_categories', $data2);

    $this->session->set_flashdata('flash_message' , get_phrase('order_received'));
    redirect(base_url() . 'index.php?admin/ordered_inventory' , 'refresh'); 
    }

    function received_inventory(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'received_inventory';
    $page_data['page_title'] = get_phrase('received_inventory');
    $this->load->view('backend/index', $page_data);
    }

    function exit_reentry_management_hr_upload(){
    	if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

         $emp_id_details=$this->input->post('emp_id_details');
          $x=move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
          if($x==1){
                $arr=array('document'=>$_FILES["file_name"]["name"]);
        	 	$this->db->where('emp_id', $emp_id_details);
                 $this->db->update('exit_re_entries', $arr);
                $this->session->set_flashdata('flash_message' , get_phrase('successfuly_added'));
                redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
             }else{
               
                $this->session->set_flashdata('flash_message' , get_phrase('select_file_to_upload'));
                redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
             }
    }


        function exit_reentry_management_hr($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1=="create"){
            $name_id=$this->input->post('name_id');

            $no_of_months=$this->input->post('no_of_months');
            $from_date=$this->input->post('from_date');
            $to_date=$this->input->post('to_date');
            $type_1=$this->input->post('type_admn');

            $type_emp       =   $this->db->get_where('employee_details' , array('emp_id'=>$name_id))->row()->emp_type;
                $pieces = explode(",", $type_emp);
           $type       =   $this->db->get_where('hr_roles' , array('id'=>$pieces[0]))->row()->id;
            

             $x=move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
             if($x==1){
                $data['emp_id']=$name_id;
                $data['no_of_months']=$no_of_months;
                $data['emp_type']=$type;
                $data['from_date']=date("Y-m-d", strtotime($from_date));
                $data['to_date']=date("Y-m-d", strtotime($to_date));
                $data['document']=$_FILES["file_name"]["name"];
                $data['status']=1;
                $data['added_on']=date("Y-m-d H:i:s");
                $this->db->insert('exit_re_entries', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('successfuly_added'));
                redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
             }else{
                $data['emp_id']=$name_id;
                $data['no_of_months']=$no_of_months;
                $data['emp_type']=$type;
                $data['from_date']=date("Y-m-d", strtotime($from_date));
                $data['to_date']=date("Y-m-d", strtotime($to_date));
                $data['document']="null";
                $data['status']=1;
                $data['added_on']=date("Y-m-d H:i:s");
                $this->db->insert('exit_re_entries', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('successfuly_added'));
                redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
             }
            
            
            
        }
    }


        //pending_from_hr
    function pending_from_hr($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1=="modal"){
            $page_data['page_name']  = 'modal_exit_re_entry_add_hr';
        $page_data['page_title'] = get_phrase('exit_re-Entries');
        $this->load->view('backend/index', $page_data);
        }else{
                $page_data['page_name']  = 'view_pending_from_hr';
        $page_data['page_title'] = get_phrase('exit_re-Entries');
        $this->load->view('backend/index', $page_data);
        }

        
    }






    function pending_leaves(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'pending_leaves';
    $page_data['page_title'] = get_phrase('manage_pending_leaves');
    $this->load->view('backend/index', $page_data);
    }

    function pending_leaves_view(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $role = $this->input->post('role');

    $page_data['page_name']  = 'pending_leaves_view';
    $page_data['page_title'] = get_phrase('manage_pending_leaves');
    $page_data['role'] = $role;
    $this->load->view('backend/index', $page_data);
    }

    function update_leaves($param1='',$param2='',$param3=''){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $role = $param3;

    if($param2=='approve'){
     $data['status'] = "2";

     $this->db->where('id', $param1);
     $this->db->update('leave_records', $data);
    }
    $page_data['page_name']  = 'pending_leaves_view';
    $page_data['page_title'] = get_phrase('manage_pending_leaves');
    $page_data['role'] = $role;
    $this->session->set_flashdata('flash_message' , get_phrase('leave_accepted'));
    $this->load->view('backend/index', $page_data);
    }


    function reject_leaves($param1='',$param2=''){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $role = $param2;

    $data['status'] = "3";
    $data['reject_reason'] = $this->input->post('reason');
    $this->db->where('id', $param1);
    $this->db->update('leave_records', $data);


    $page_data['page_name']  = 'pending_leaves_view';
    $page_data['page_title'] = get_phrase('manage_pending_leaves');
    $page_data['role'] = $role;
    $this->session->set_flashdata('flash_message' , get_phrase('leave_rejected'));
    $this->load->view('backend/index', $page_data);
    }

    function approved_leaves(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'approved_leaves';
    $page_data['page_title'] = get_phrase('view_processed_leaves');
    $this->load->view('backend/index', $page_data);
    }

    function approved_leaves_view(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $role = $this->input->post('role');

    $page_data['page_name']  = 'approved_leaves_view';
    $page_data['page_title'] = get_phrase('view_processed_leaves');
    $page_data['role'] = $role;
    $this->load->view('backend/index', $page_data);
    }


    function pending_admission(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'pending_admission';
    $page_data['page_title'] = get_phrase('pending_admission');
    $this->load->view('backend/index', $page_data);
    }

    function approved_admission(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'approved_admission';
    $page_data['page_title'] = get_phrase('approved_admission');
    $this->load->view('backend/index', $page_data);
    }

    function approved_admission_delete($param1, $param2){
      if ($param1 == 'delete') {
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
        $this->db->where('student_id', $param2);
        $this->db->delete('enroll');
        
        $this->db->where('student_id', $param2);
        $this->db->delete('student_documents');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/approved_admission/', 'refresh');
    }
    }

    function rejected_admission(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'rejected_admission';
    $page_data['page_title'] = get_phrase('rejected_admission');
    $this->load->view('backend/index', $page_data);
    }

    function rejected_admission_delete($param1, $param2){
      if ($param1 == 'delete') {
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
        $this->db->where('student_id', $param2);
        $this->db->delete('enroll');
        
        $this->db->where('student_id', $param2);
        $this->db->delete('student_documents');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/rejected_admission/', 'refresh');
    }
    }


    public function pending_to_approve(){
		$student_id = $this->input->post('student_id');
		$data['Admission_Status'] = $this->input->post('status_id');
		$this->db->where('student_id', $student_id);
		$this->db->update('student', $data);

		//create attendance for this academicYear
		$running_year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		
		$this -> db -> select('start_date,end_date');
		$this -> db -> from('academic_year');
		$this -> db -> where('academic_year', $running_year);
		$query = $this->db->get();
		$from_date= $query->row('start_date');
		$end_date= $query->row('end_date');		
		
		$this->insertInAttendance($from_date,$end_date,$student_id,$running_year);
		
		$this->session->set_flashdata('flash_message' , get_phrase('Admission_Approved_successfully'));
		redirect(base_url() . 'index.php?admin/pending_admission/', 'refresh');
	}

    public function pending_to_reject(){

      $student_id = $this->input->post('student_id');
      $data['Admission_Status'] = $this->input->post('status_id');
      $data['reject_reason'] = $this->input->post('reason');

      $this->db->where('student_id', $student_id);
      $this->db->update('student', $data);

      $this->session->set_flashdata('flash_message' , get_phrase('Admission_rejected_successfully'));
      redirect(base_url() . 'index.php?admin/pending_admission/', 'refresh');

    }

    public function students_by_class($class_id){
        $students = $this->db->get_where('student' , array('class_id' => $class_id ))->result_array();
            //print_r($students);
        echo json_encode($students);  
    }


        ////Parents by ID////
    function get_parent($parent_id){
        $query = $this->db->get_where('parent', array('parent_id' => $parent_id))->result_array();
            //echo json_encode($ar, JSON_FORCE_OBJECT);
        echo json_encode($query, JSON_FORCE_OBJECT);

    }

    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
    {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'student_add1';
    $page_data['page_title'] = get_phrase('add_student');
    $this->load->view('backend/index', $page_data);
    }

    function add_employees()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'add_employees';
        $page_data['page_title'] = get_phrase('add_employees');
        $this->load->view('backend/index', $page_data);
    }


    function insert_employees(){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
            ))->row()->description;

        $this->load->library('ApiCrypter');

        $data['iqama_number'] = $this->input->post('iqama_number');
        $data['contract_type'] = $this->input->post('contract_type');
        $data['name'] = $this->input->post('name');
        $data['emp_number'] = $this->input->post('emp_number');
        $data['dob'] = $this->input->post('dob');
        $data['place_of_birth'] = $this->input->post('place_of_birth');
        $data['gender'] = $this->input->post('gender');
        $data['nationality'] = $this->input->post('nationality');
        $data['emp_type'] = $this->input->post('emp_type');
        $data['mother_tongue'] = $this->input->post('mother_tongue');
        $data['language_known'] = $this->input->post('language_known');
        $data['marital_status'] = $this->input->post('marital_status');
        $data['family_status'] = $this->input->post('family_status');
        $data['blood_group'] = $this->input->post('blood_group');
        $data['email'] = $this->input->post('email');
        $data['login'] = $this->input->post('login');
        $data['mobile'] = $this->input->post('mobile');
        
		$data['password'] = $this->apicrypter->encrypt($this->input->post('password'));
		/* $password=$this->input->post('password');
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
			echo '<script language="javascript">';
			echo 'alert("Password should have the following,\n
			Must be a minimum of 8 characters\n
			Must contain at least 1 number\n
			Must contain at least one uppercase character\n
			Must contain at least one lowercase character\n")';
			echo '</script>';
			return false;
		}else{
			$data['password'] = $this->apicrypter->encrypt($password);
		}
		 */
        $data['landline'] = $this->input->post('landline');
        $data['alternate_mobile'] = $this->input->post('alternate_mobile');
        $data['emergency_contact'] = $this->input->post('emergency_contact');
        $data['spouse_mobile'] = $this->input->post('spouse_mobile');
        $data['local_address'] = $this->input->post('local_address');
        $data['street'] = $this->input->post('street');
        $data['area'] = $this->input->post('area');
        $data['pincode'] = $this->input->post('pincode');
        $data['landmark'] = $this->input->post('landmark');
        $data['latitude'] = $this->input->post('latitude');
        $data['longitude'] = $this->input->post('longitude');
        $data['home_country_address'] = $this->input->post('home_country_address');
        $data['education'] = $this->input->post('education');
        $data['work_experience'] = $this->input->post('work_experience');
        $data['previous_salary'] = $this->input->post('previous_salary');
        $data['bank_name'] = $this->input->post('bank_name');
        $data['account_holder_name'] = $this->input->post('account_holder_name');
        $data['account_number'] = $this->input->post('account_number');
        $data['ifsc_code'] = $this->input->post('ifsc_code');
        $data['transport_facility'] = $this->input->post('transport_facility');
        $data['journey_type'] = $this->input->post('journey_type');
        $data['trip_type'] = $this->input->post('trip_type');


        $this->db->insert('employee_details', $data);
        $x=$this->input->post('par0');

        $this->session->set_flashdata('flash_message' , get_phrase($x));

        redirect(base_url() . 'index.php?admin/add_employees', 'refresh');

    }


    function insert_employees_documents(){
        $updata['emp_id'] = $this->input->post('employee_id');


            //uploading file using codeigniter upload library  
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/employee_document/';
        $config['allowed_types'] =  '*';  
        $this->upload->initialize($config);

        if($this->upload->do_upload('iqama_copy')){
            $upload_data = $this->upload->data();
            $updata['iqama_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
            $updata['iqama_number']           = $this->input->post('iqama_ID');
            $updata['iqama_issue_date']           = $this->input->post('iqama_issue');
            $updata['iqama_expiry_date']           = $this->input->post('iqama_expiry');
            $updata['iqama_issue_place']           = $this->input->post('iqama_issue_place');
        }
		if($this->upload->do_upload('dl_copy')){
            $upload_data = $this->upload->data();
            $updata['driving_license_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
            $updata['driving_license_number']           = $this->input->post('dl_number');
            $updata['driving_license_issue_date']           = $this->input->post('dl_issue');
            $updata['driving_license_expiry_date']           = $this->input->post('dl_expiry');
            $updata['driving_license_issue_place']           = $this->input->post('dl_issue_place');
        }
        if($this->upload->do_upload('passport_copy')){
            $upload_data = $this->upload->data();
            $updata['passport_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
            $updata['passport_number']           = $this->input->post('passport_number');
            $updata['passport_issue_date']           = $this->input->post('passport_issue');
            $updata['passport_expiry_date']           = $this->input->post('passport_expiry');
            $updata['passport_issue_place']           = $this->input->post('passport_issue_place');
        }

        if($this->upload->do_upload('insurance_copy')){
            $upload_data = $this->upload->data();
            $updata['medical_insurance_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
            $updata['medical_insurance_id']   = $this->input->post('medical_insurance_id');
            $updata['medical_insurance_expiry_date']   = $this->input->post('medical_insurance_expiry_date');

        }
        if($this->upload->do_upload('medical_report')){
            $upload_data = $this->upload->data();
            $updata['medical_report'] = 'uploads/employee_document/'.$upload_data['file_name'];
        }

        if($this->upload->do_upload('noc_letter')){
            $upload_data = $this->upload->data();
            $updata['noc_letter_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
            $updata['noc_letter_number']   = $this->input->post('noc_letter_number');

        }

        $this->db->insert('employee_documents', $updata);
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/add_employees/', 'refresh');
    }

    function employee_csv_upload(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['page_name']  = 'employee_csv_upload';
        $page_data['page_title'] = get_phrase('add_bulk_employee');
        $this->load->view('backend/index', $page_data);
    }

    function upload_employee_csv_file(){
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
                    $header_row = fgetcsv($file, 10000, ','); // here you got the mandatory
                    $header_row = fgetcsv($file, 10000, ','); // here you got the empty line
                    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){ 
                        $emapData = array_map('trim',$emapData);
                        
                        /* Blank rows skip */
                        if($emapData[0] =='' || $emapData[1] =='' || $emapData[2]=='' || $emapData[3] =='' || $emapData[4] =='' || $emapData[5] =='' || $emapData[6] =='' || $emapData[7] =='' || $emapData[8] =='' || $emapData[12] =='' || $emapData[14] =='' || $emapData[15] =='')
                            continue;
                        
                        $EmployeeData = array('emp_type' => $emapData[0].',',
                            'contract_type' => $emapData[1],
                            'iqama_number' => $emapData[2],
                            'name' => $emapData[3],
                            'emp_number' => $emapData[4],
                            'dob' => $emapData[5],
                            'place_of_birth' => $emapData[6],
                            'gender' => $emapData[7],
                            'nationality' => $emapData[8],
                            'mother_tongue' => $emapData[9],
                            'language_known' => $emapData[10],
                            'marital_status' => $emapData[11],
                            'family_status' => $emapData[12],
                            'blood_group' => $emapData[13],
                            'email' => $emapData[14],
                            'mobile' => $emapData[15],
                            'landline' => $emapData[16],
                            'alternate_mobile' => $emapData[17],
                            'emergency_contact' => $emapData[18],
                            'spouse_mobile' => $emapData[19],
                            'local_address' => $emapData[20],
                            'street' => $emapData[21],
                            'area' => $emapData[22],
                            'pincode' => $emapData[23],
                            'landmark' => $emapData[24],
                            'latitude' => $emapData[25],
                            'longitude' => $emapData[26],
                            'home_country_address' => $emapData[27],
                            'education' => $emapData[28],
                            'work_experience' => $emapData[29],
                            'previous_salary' => $emapData[30],
                            'bank_name' => $emapData[31],
                            'account_holder_name' => $emapData[32],
                            'account_number' => $emapData[33],
                            'ifsc_code' => $emapData[34],
                            'transport_facility' => $emapData[35],
                            'journey_type' => $emapData[36],
                            'trip_type' => $emapData[37],
                            'login' => $emapData[38],
                            'password' => $this->apicrypter->encrypt($emapData[39])
                            );
                        
                        $x= $this->crud_model->insertEmployeeCSV($EmployeeData,$emapData[2]); 
                        
                    }
                    fclose($file);
                    // redirect('welcome/index');
                    $this->session->set_flashdata('flash_message' , get_phrase('CSV_uploaded'));
                    redirect(base_url() . 'index.php?admin/employee_csv_upload', 'refresh'); 
                }
            }       
        }   

        function view_employees(){
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');


            $page_data['page_name']  = 'view_employees';
            $page_data['page_title'] = get_phrase('view_employees');
            $this->load->view('backend/index', $page_data);
        }

        function view_employees_test(){
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');


            $page_data['page_name']  = 'view_employees_test';
            $page_data['page_title'] = get_phrase('view_employees');
            $this->load->view('backend/index', $page_data);
        }

        function update_employees($param1='')
        {
            $this->load->library('ApiCrypter');
            $id= $param1;
            $data['contract_type'] = $this->input->post('contract_type');
            $x='';
            $role= $this->input->post('roles');
            foreach ($role as $key) {
                $x=$x.$key.',';
            }
            $data['emp_type'] = $x;
            $data['iqama_number'] = $this->input->post('iqama_ID_number');
            $data['name'] = $this->input->post('employee_name');
            $data['emp_number'] = $this->input->post('employee_number');
            $data['dob'] = $this->input->post('date_of_birth');
            $data['place_of_birth'] = $this->input->post('place_of_birth');
            $data['gender'] = $this->input->post('gender');
            $data['nationality'] = $this->input->post('nationality');
            $data['mother_tongue'] = $this->input->post('mother_tongue');
            $data['language_known'] = $this->input->post('language_known');
            $data['marital_status'] = $this->input->post('marital_status');
            $data['family_status'] = $this->input->post('family_status');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['email'] = $this->input->post('email_ID');
            $data['mobile'] = $this->input->post('mobile_number');
            $data['landline'] = $this->input->post('landline_number');
            $data['place_of_birth'] = $this->input->post('place_of_birth');
            $data['alternate_mobile'] = $this->input->post('alternate_mobile_number');
            $data['emergency_contact'] = $this->input->post('emergency_contact_number');
            $data['spouse_mobile'] = $this->input->post('spouse_mobile_number');
            $data['local_address'] = $this->input->post('local_address');
            $data['street'] = $this->input->post('street_name');
            $data['area'] = $this->input->post('area_name');
            $data['pincode'] = $this->input->post('pin_code');
            $data['landmark'] = $this->input->post('landmark_name');
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
            $data['home_country_address'] = $this->input->post('home_country_address');
            $data['education'] = $this->input->post('education');
            $data['work_experience'] = $this->input->post('work_experience');
            $data['previous_salary'] = $this->input->post('previous_salary');
            $data['bank_name'] = $this->input->post('name_of_bank');
            $data['account_holder_name'] = $this->input->post('account_holder_name');
            $data['account_number'] = $this->input->post('account_number');
            $data['ifsc_code'] = $this->input->post('IFSC_code');
            $data['place_of_birth'] = $this->input->post('place_of_birth');
            $data['transport_facility'] = $this->input->post('require_transport');
            $data['journey_type'] = $this->input->post('journey_type');
            $data['trip_type'] = $this->input->post('trip');
            $data['login'] = $this->input->post('login');
            $data['password'] = $this->apicrypter->encrypt($this->input->post('password'));


            

              //$this->db->insert('enroll', $data2);
            $this->db->where('emp_id', $param1);
            $this->db->update('employee_details', $data); 

                    //uploading file using codeigniter upload library  
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/employee_document/';
            $config['allowed_types'] =  '*';  
            $this->upload->initialize($config);
            $updata = array();

            if($this->upload->do_upload('iqama_copy')){
             $upload_data = $this->upload->data();
             $updata['iqama_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }
         $updata['iqama_number']           = $this->input->post('iqama_id_number');
         $updata['iqama_issue_date']           = $this->input->post('iqama_issue_date');
         $updata['iqama_expiry_date']           = $this->input->post('iqama_expiry_date');
         $updata['iqama_issue_place']           = $this->input->post('iqama_place_of_issue');

         if($this->upload->do_upload('passport_copy')){
             $upload_data = $this->upload->data();
             $updata['passport_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }
         $updata['passport_number']           = $this->input->post('passport_number');
         $updata['passport_issue_date']           = $this->input->post('passport_issue_date');
         $updata['passport_expiry_date']           = $this->input->post('passport_expiry_date');
         $updata['passport_issue_place']           = $this->input->post('passport_issue_place');

		 
		 if($this->upload->do_upload('dl_copy')){
             $upload_data = $this->upload->data();
             $updata['driving_license_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }
         $updata['driving_license_number']           = $this->input->post('dl_number');
         $updata['driving_license_issue_date']           = $this->input->post('dl_issue_date');
         $updata['driving_license_expiry_date']           = $this->input->post('dl_expiry_date');
         $updata['driving_license_issue_place']           = $this->input->post('dl_issue_place');

		 
         if($this->upload->do_upload('medical_insurance_copy')){
             $upload_data = $this->upload->data();
             $updata['medical_insurance_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }
         $updata['medical_insurance_id']   = $this->input->post('medical_insurance_id');
         $updata['medical_insurance_expiry_date']   = $this->input->post('medical_insurance_expiry_date');

         if($this->upload->do_upload('medical_report')){
             $upload_data = $this->upload->data();
             $updata['medical_report'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }


         if($this->upload->do_upload('noc_letter_copy')){
             $upload_data = $this->upload->data();
             $updata['noc_letter_url'] = 'uploads/employee_document/'.$upload_data['file_name'];
         }
         $updata['noc_letter_number']           = $this->input->post('noc_letter_number');
         

         $this->db->where('emp_id', $param1);
         $this->db->update('employee_documents', $updata);

                    // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');

         $this->crud_model->clear_cache();
         $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
         redirect(base_url() . 'index.php?admin/view_employees', 'refresh');
     } 

     function delete_employees($param1=''){
        $this->db->where('emp_id', $param1);
        $this->db->delete('employee_details');
        $this->db->where('emp_id', $param1);
        $this->db->delete('employee_documents');

        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/view_employees', 'refresh');
    }

    function get_roles()
    {
        $sections = $this->db->get('hr_roles');
        echo $sections->num_rows();
    }

    function get_password()
    {
        $this->load->library('ApiCrypter');
        $x = $this->input->post('par0');
        $pass = $this->db->get_where('employee_details' , array(
            'emp_number' => $x
            ))->row()->password;
        $d=$this->apicrypter->decrypt($pass);
        echo $d;
        //echo json_encode(array('password'=>$password));
    }



    function teacher_csv_upload(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');


    $page_data['page_name']  = 'teacher_csv_upload';
    $page_data['page_title'] = get_phrase('add_bulk_teacher');
    $this->load->view('backend/index', $page_data);
    }

    /* function teacher_view($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher_view/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher_view';
        $page_data['page_title'] = get_phrase('teacher_view');
        $this->load->view('backend/index', $page_data);
    } */

    function upload_teacher_csv_file(){
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
                       if($emapData[0] =='' || $emapData[5] =='' || $emapData[40]=='')
                          continue;
                      
                      $TeacherData = array('name' => $emapData[0],
                          'qualification' => $emapData[1],
                          'experience_or_fresher' => $emapData[2],
                          'year_of_experience' => $emapData[3],
                          'mobile' => $emapData[38],
                          'landline' => $emapData[39],
                          'email' => $emapData[40],
                          'password' => $this->apicrypter->encrypt($emapData[41]),
                          'temp_address' => $emapData[42],
                          'permanent_address' => $emapData[43],
                          'age' => $emapData[44],
                          'DOB' => $emapData[45],
                          'place_of_birth' => $emapData[46],
                          'religion' => $emapData[47],
                          'mother_tongue' => $emapData[48],
                          'languages_known' => $emapData[49],
                          'father_name' => $emapData[50],
                          'father_occupation' => $emapData[51],
                          'mother_name' => $emapData[52],
                          'mother_occupation' => $emapData[53],
                          'spouse_name' => $emapData[54],
                          'spouse_occupation' => $emapData[55],
                          'family_members_living_with' => $emapData[56],
                          'extra_curriculur' => $emapData[57],
                          'proefficient_sports' => $emapData[58],
                          'social_activities' => $emapData[59],
                          'computer_knowledge_details' => $emapData[60],
                          'certificate_enclosed' => $emapData[61],
                          'assigned_bus' => $emapData[150]
                          );
                      
                      $teacher_id = $this->crud_model->insertTeacherCSV($TeacherData,$emapData[40]); 
                      
                      $this->db->where('teacher_id',$teacher_id);
                      $q = $this->db->get('emp_evalution');
                      if ($q->num_rows() <= 0) 
                      {
                          $EvaluateData = array('teacher_id'=>$teacher_id,
                             'subject_topic' => $emapData[4],
                             'class_id' => $emapData[5],
                             'evaluvator_name' => $emapData[7],
                             'salary_expectation' => $emapData[8],
                             'distance_from_school' => $emapData[9],
                             'skills' => $emapData[10],
                             'attitude' => $emapData[11],
                             'academic_skills' => $emapData[12],
                             'leadership_skills' => $emapData[13],
                             'islamic_knowledge' => $emapData[14],
                             'writing_skills' => $emapData[15],
                             'greeting' => $emapData[16],
                             'introduction' => $emapData[17],
                             'subject_knowledge' => $emapData[18],
                             'use_of_board' => $emapData[19],
                             'communication_skills' => $emapData[20],
                             'teaching_methodlogy' => $emapData[21],
                             'class_control' => $emapData[22],
                             'level_of_confidence' => $emapData[23],
                             'body_language' => $emapData[24],
                             'evaluation_of_student_understanding' => $emapData[25],
                             'summary' => $emapData[26],
                             'evaluvator_status' => $emapData[27],
                             'evaluvator_reason' => $emapData[28],
                             'post_applied_for' => $emapData[29],
                             'preferable_subject_id' => $emapData[30],
                             'preferable_subject_name' => $emapData[31],
                             'preferable_class_id' => $emapData[32],
                             'preferable_class_name' => $emapData[33],
                             'current_salary' => $emapData[34],
                             'expected_salary' => $emapData[35],
                             'current_school' => $emapData[36],
                             'notice_period' => $emapData[37]);
                          $this->db->insert('emp_evalution', $EvaluateData);
                          
                          $ReferenceData = array('teacher_id'=>$teacher_id,
                             'ref_name_1' => $emapData[62],
                             'ref_contact_1' => $emapData[63],
                             'ref_profession_1' => $emapData[64],
                             'address_1' => $emapData[65],
                             'ref_name_2' => $emapData[66],
                             'ref_contact_2' => $emapData[67],
                             'ref_profession_2' => $emapData[68],
                             'address_2' => $emapData[69]);
                          $this->db->insert('employee_reference', $ReferenceData);
                          
                          if($emapData[70]!=''){
                             $ExperienceData1 = array('teacher_id'=>$teacher_id,
                                 'institution' => $emapData[70],
                                 'desgination' => $emapData[71],
                                 'from' => $emapData[72],
                                 'to' => $emapData[73],
                                 'salary' => $emapData[74],
                                 'reason_for_leaving	' => $emapData[75]);
                             $this->db->insert('emp_experience', $ExperienceData1);
                         }
                         
                         if($emapData[76]!=''){
                             $ExperienceData2 = array('teacher_id'=>$teacher_id,
                              'institution' => $emapData[76],
                              'desgination' => $emapData[77],
                              'from' => $emapData[78],
                              'to' => $emapData[79],
                              'salary' => $emapData[80],
                              'reason_for_leaving	' => $emapData[81]);
                             $this->db->insert('emp_experience', $ExperienceData2);
                         }
                         
                         if($emapData[82]!=''){
                             $ExperienceData3 = array('teacher_id'=>$teacher_id,
                              'institution' => $emapData[82],
                              'desgination' => $emapData[83],
                              'from' => $emapData[84],
                              'to' => $emapData[85],
                              'salary' => $emapData[86],
                              'reason_for_leaving	' => $emapData[87]);
                             $this->db->insert('emp_experience', $ExperienceData3);
                         }
                         if($emapData[88]!=''){
                             $ExperienceData4 = array('teacher_id'=>$teacher_id,
                              'institution' => $emapData[88],
                              'desgination' => $emapData[89],
                              'from' => $emapData[90],
                              'to' => $emapData[91],
                              'salary' => $emapData[92],
                              'reason_for_leaving	' => $emapData[93]);
                             $this->db->insert('emp_experience', $ExperienceData4);
                         }
                         
                         if($emapData[94]!=''){
                             $EducationData1 = array('teacher_id'=>$teacher_id,
                                'course_name' => 'SSC',
                                'institute_name' => $emapData[94],
                                'medium' => $emapData[95],
                                'type' => $emapData[96],
                                'year_of_passing' => $emapData[97],
                                'percentage	' => $emapData[98],
                                'class' => $emapData[99]);
                             $this->db->insert('emp_education_details', $EducationData1);
                         }
                         
                         if($emapData[100]!=''){
                             $EducationData2 = array('teacher_id'=>$teacher_id,
                                 'course_name' => 'HSC',
                                 'institute_name' => $emapData[100],
                                 'medium' => $emapData[101],
                                 'type' => $emapData[102],
                                 'year_of_passing' => $emapData[103],
                                 'percentage	' => $emapData[104],
                                 'class' => $emapData[105]);
                             $this->db->insert('emp_education_details', $EducationData2);
                         }
                         
                         if($emapData[106]!=''){
                             $EducationData3 = array('teacher_id'=>$teacher_id,
                                 'course_name' => 'UG',
                                 'institute_name' => $emapData[106],
                                 'medium' => $emapData[107],
                                 'type' => $emapData[108],
                                 'year_of_passing' => $emapData[109],
                                 'percentage	' => $emapData[110],
                                 'class' => $emapData[111]);
                             $this->db->insert('emp_education_details', $EducationData3);
                         }
                         
                         if($emapData[112]!=''){
                             $EducationData4 = array('teacher_id'=>$teacher_id,
                                 'course_name' => 'PG',
                                 'institute_name' => $emapData[112],
                                 'medium' => $emapData[113],
                                 'type' => $emapData[114],
                                 'year_of_passing' => $emapData[115],
                                 'percentage	' => $emapData[116],
                                 'class' => $emapData[117]);
                             $this->db->insert('emp_education_details', $EducationData4);
                         }
                         if($emapData[118]!=''){
                             $EducationData5 = array('teacher_id'=>$teacher_id,
                                'course_name' => 'Professional Degree',
                                'institute_name' => $emapData[118],
                                'medium' => $emapData[119],
                                'type' => $emapData[120],
                                'year_of_passing' => $emapData[121],
                                'percentage	' => $emapData[122],
                                'class' => $emapData[123]);
                             $this->db->insert('emp_education_details', $EducationData5);
                         }
                         
                         $QuestionsData = array('question1'=>$emapData[124],
                            'answer1' => $emapData[125],
                            'question2' => $emapData[126],
                            'answer2' => $emapData[127],
                            'question3' => $emapData[128],
                            'answer3' => $emapData[129],
                            'question4	' => $emapData[130],
                            'answer4' => $emapData[131],
                            'question5' => $emapData[132],
                            'answer5' => $emapData[133],
                            'question6' => $emapData[134],
                            'answer6' => $emapData[135],
                            'question7	' => $emapData[136],
                            'answer7' => $emapData[137],
                            'question8' => $emapData[138],
                            'answer8' => $emapData[139],
                            'question9' => $emapData[140],
                            'answer9' => $emapData[141],
                            'question10	' => $emapData[142],
                            'answer10' => $emapData[143],
                            'question11' => $emapData[144],
                            'answer11' => $emapData[145],
                            'question12' => $emapData[146],
                            'answer12' => $emapData[147],
                            'question13' => $emapData[148],
                            'answer13' => $emapData[149]);
                         $this->db->insert('question_answer', $QuestionsData);
                     }
                     
                 }
                 fclose($file);
                    // redirect('welcome/index');
                 $this->session->set_flashdata('flash_message' , get_phrase('csv_uploaded'));
                 redirect(base_url() . 'index.php?admin/teacher_csv_upload', 'refresh');	
             }
         }		
     }	
     
     function student_bulk_add($param1 = '')
     {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if($param1 == 'add_bulk_student') {

        $names     = $this->input->post('name');
        $rolls     = $this->input->post('roll');
        $emails    = $this->input->post('email');
        $passwords = $this->input->post('password');
        $phones    = $this->input->post('phone');
        $addresses = $this->input->post('address');
        $genders   = $this->input->post('sex');

        $student_entries = sizeof($names);
        for($i = 0; $i < $student_entries; $i++) {
            $data['name']     =   $names[$i];
            $data['email']    =   $emails[$i];
            $data['password'] =   sha1($passwords[$i]);
            $data['phone']    =   $phones[$i];
            $data['address']  =   $addresses[$i];
            $data['sex']      =   $genders[$i];

                    //validate here, if the row(name, email, password) is empty or not
            if($data['name'] == '' || $data['email'] == '' || $data['password'] == '')
                continue;

            $this->db->insert('student' , $data);
            $student_id = $this->db->insert_id();

            $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
            $data2['student_id']    =   $student_id;
            $data2['class_id']      =   $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data2['section_id']    =   $this->input->post('section_id');
            }
            $data2['roll']          =   $rolls[$i];
            $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
            $data2['year']          =   $this->db->get_where('settings' , array(
                'type' => 'running_year'
                ))->row()->description;

            $this->db->insert('enroll' , $data2);

        }
        $this->session->set_flashdata('flash_message' , get_phrase('students_added'));
        redirect(base_url() . 'index.php?admin/student_information/' . $this->input->post('class_id') , 'refresh');
    }			

    $page_data['page_name']  = 'student_bulk_add';
    $page_data['page_title'] = get_phrase('add_bulk_student');
    $this->load->view('backend/index', $page_data);
    }

    function student_csv_upload(){
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    $page_data['page_name']  = 'student_csv_upload';
    $page_data['page_title'] = get_phrase('add_bulk_student');
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
                       if($emapData[0] =='' || $emapData[10] =='' || $emapData[19] =='' || $emapData[21] =='')
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
                       'Emer_Contact_Person_Name_Primary' => $emapData[31],
                       'Emer_Contact_Person_Number_Primary' => $emapData[32],
                       'Emer_Contact_Person_Name_Secondary' => $emapData[33],
                       'Emer_Contact_Person_Number_Secondary' => $emapData[34],
                       'Home_Landline' => $emapData[29],
                       'Office_Landline' => $emapData[30],
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
                       
                       'Fees_Concession' => $emapData[56],
                       'Concession_Percent' => $emapData[57],
                       'assigned_bus' => $emapData[58]
                       );
                      
                      $sutdentId = $this->crud_model->insertCSV($data, $emapData[0]); 
                      $running_year = $this->db->get_where('settings' , array(
                          'type' => 'running_year'))->row()->description;
                      
                      /* Avoid multiple entry for students in Enroll Table */	
                      $this->db->where('roll',$emapData[0]);
                      $q = $this->db->get('enroll');
                      if ($q->num_rows() <= 0){

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
                    }
                    fclose($file);
                    // redirect('welcome/index');
                    $this->session->set_flashdata('flash_message' , get_phrase('csv_uploaded'));
                    redirect(base_url() . 'index.php?admin/student_csv_upload', 'refresh');	
                }
            }		
        }	

        function get_sections($class_id)
        {
            $page_data['class_id'] = $class_id;
            $this->load->view('backend/admin/student_bulk_add_sections' , $page_data);
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
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }

    function student1($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
            ))->row()->description;
        if ($param1 == 'create') {
          $this->load->library('ApiCrypter');
          $parent_id = $this->input->post('parent_id');
            	//$data1['parent_id'] = $this->input->post('parent_id');
          $data1['email'] = $this->input->post('parentEmail');
          $data1['password'] = $this->apicrypter->encrypt($this->input->post('password'));
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
            
            $data2['roll']           = $this->input->post('applicationNumber').$i;
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            
            $this->db->insert('enroll', $data2);
	
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'index.php?admin/student_add/', 'refresh');
        }	
        
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
            
            if($VarSex == 'male'){
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
            $data['Student_Status']  = '1';
            $data['assigned_bus']      = $this->input->post('assigned_bus');
    			//uploading file using codeigniter upload library
            $files = $_FILES['userfile'];
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/student_document/';
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
                
                redirect(base_url() . 'index.php?admin/student_add/', 'refresh');
            }
            if ($param1 == 'do_update') {
             
             
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
     $data1['password'] = $this->apicrypter->encrypt($this->input->post('password'));
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
     $data2['class_id']       = $param3;
     $data2['section_id'] = $this->input->post('section_id');
     $data2['roll']           = $this->input->post('student_code');
     $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
     $data2['year']           = $running_year;
     
          //$this->db->insert('enroll', $data2);
     $this->db->where('student_id', $param2);
     $this->db->update('enroll', $data2); 
     
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
     $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
     redirect(base_url() . 'index.php?admin/student_information/' . $param3, 'refresh');
    } 

    if ($param1 == 'delete') {
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
        $this->db->where('student_id', $param2);
        $this->db->delete('enroll');
        
        $this->db->where('student_id', $param2);
        $this->db->delete('student_documents');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/student_information/' . $param3, 'refresh');
    }
    		//add_student_documents

    if ($param1 == 'add_document') {
        $updata['student_id'] = $this->input->post('student_id');
        
        
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
		 $updata['vaccination_next_remainder'] = $this->input->post('vaccination_next_remainder');
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
     redirect(base_url() . 'index.php?admin/student_add/', 'refresh');
    }

    }

        // STUDENT PROMOTION
    function student_promotion($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');  
            $from_class_id =   $this->input->post('promotion_from_class_id'); 
            $students_of_promotion_class =   $this->db->get_where('enroll' , array(
                'class_id' => $from_class_id , 'year' => $running_year
                ))->result_array();
            foreach($students_of_promotion_class as $row) {
                $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                $enroll_data['student_id']      =   $row['student_id'];
                $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
                $enroll_data['year']            =   $this->input->post('promotion_year');
                $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                $this->db->insert('enroll' , $enroll_data);
                
                $new_class_id=$this->input->post('promotion_status_'.$row['student_id']);
                $new_class_name=$this->crud_model->get_class_name($new_class_id);
    				//update in student table
                $this->db->where('student_id', $row['student_id']);
                $setDataArr=array('class_id' => $new_class_id,
                 'class_name'=> $new_class_name);
                $this->db->update('student', $setDataArr);
				
				//create / update student data in attendance
				$this -> db -> select('start_date,end_date');
				$this -> db -> from('academic_year');
				$this -> db -> where('academic_year', $enroll_data['year']);
				$query = $this->db->get();
				$from_date= $query->row('start_date');
				$end_date= $query->row('end_date');	
				
				$this->insertInAttendance($from_date,$end_date,$row['student_id'],$enroll_data['year']);
					
            } 
			
			
			
			
            $this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
            redirect(base_url() . 'index.php?admin/student_promotion' , 'refresh');
        }

        $page_data['page_title']    = get_phrase('student_promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector' , $page_data);
    }


    /****HR Management*****/
    function add_roles($param1="",$param2="",$param3=""){
       if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
     $data['role']			= strtoupper($this->input->post('role'));
     
     $this->db->insert('hr_roles', $data);
     $ac_id = $this->db->insert_id();
     
     $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
     redirect(base_url() . 'index.php?admin/add_roles/', 'refresh');
    }
    if($param1== 'delete'){
       $row_id=$param2;

       $this->db->where('id', $row_id);
       $this->db->delete('hr_roles');
       $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
       redirect(base_url() . 'index.php?admin/add_roles/', 'refresh');
    }
    $page_data['page_name']  = 'add_roles';
    $page_data['page_title'] = get_phrase('add_roles');
    /*$page_data['vacation_additional_break']=   $this->db->get_where('vacation_additional_break' , array('status'=>1))->result_array();*/
    $page_data['hr_roles']    = $this->db->get('hr_roles')->result_array();
    $this->load->view('backend/index', $page_data);
    }

    function role_name_data($role)
    {

    		//$room_data 		=   $this->db->get_where('exam_rooms' , array('room_name'=>$room))->row()->room_name;
     $role_data=$this->db->get('hr_roles')->result_array();
     foreach ($role_data as $row) {
        if($role === $row['role']){
           break;
       }
    }

    echo $row['role'];

    }

    /****MANAGE MODULES*****/
     function manage_modules(){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_title']    = get_phrase('manage_modules');
        $page_data['page_name']  = 'manage_modules';
        $this->load->view('backend/index', $page_data);
     }

     function selected_modules(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $x=$this->input->post('par0');
        $y=$this->input->post('par1');
        $data['modules']=$x;

        $this->db->where('id', $y);
        $this->db->update('hr_roles', $data);

        redirect(base_url() . 'index.php?admin/manage_modules' , 'refresh');
    }

    /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $this->load->library('ApiCrypter');
        if ($param1 == 'create') {
            $data['name']        			= $this->input->post('name');
            $data['email']       			= $this->input->post('email');
                // $data['password']    			= sha1($this->input->post('password'));
            $data['password']    			= $this->apicrypter->encrypt($this->input->post('password'));
            $data['phone']       			= $this->input->post('phone');
            $data['address']     			= $this->input->post('address');
            $data['profession']  			= $this->input->post('profession');
            $this->db->insert('parent', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                //$this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['password']                  = $this->apicrypter->encrypt($this->input->post('password'));
            $data['phone']                  = $this->input->post('phone');
            $data['address']                = $this->input->post('address');
            $data['profession']             = $this->input->post('profession');
            $this->db->where('parent_id' , $param2);
            $this->db->update('parent' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }


    /****TEACHER Edit*****/
    /* function teacher_edit($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');	
        if ($param1 == 'do_update') {
         $TeacherData = array('name' => $this->input->post('name'),
            'qualification' => $this->input->post('qualification'),
            'experience_or_fresher' => $this->input->post('experience_or_fresher'),
            'year_of_experience' => $this->input->post('year_of_experience'),
            'mobile' => $this->input->post('mobile'),
            'landline' => $this->input->post('landline'),
            'temp_address' => $this->input->post('temp_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'age' => $this->input->post('age'),
            'DOB' => $this->input->post('DOB'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'religion' => $this->input->post('religion'),
            'mother_tongue' => $this->input->post('mother_tongue'),
            'languages_known' => $this->input->post('languages_known'),
            'father_name' => $this->input->post('father_name'),
            'father_occupation' => $this->input->post('father_occupation'),
            'mother_name' => $this->input->post('mother_name'),
            'mother_occupation' => $this->input->post('mother_occupation'),
            'spouse_name' => $this->input->post('spouse_name'),
            'spouse_occupation' => $this->input->post('spouse_occupation'),
            'family_members_living_with' => $this->input->post('family_members_living_with'),
            'extra_curriculur' => $this->input->post('extra_curriculur'),
            'proefficient_sports' => $this->input->post('proefficient_sports'),
            'social_activities' => $this->input->post('social_activities'),
            'computer_knowledge_details' => $this->input->post('computer_knowledge_details'),
            'assigned_bus'=>$this->input->post('assigned_bus'),
            'certificate_enclosed' => $this->input->post('certificate_enclosed'));
         
         $this->db->where('teacher_id', $param2);
         $this->db->update('teacher', $TeacherData);

         $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
         redirect(base_url() . 'index.php?admin/teacher_edit/', 'refresh');
     }
     $page_data['page_name']  = 'teacher_view';
     $page_data['page_title'] = get_phrase('teacher_view');
     $this->load->view('backend/index', $page_data);
    } */    
    /****MANAGE TEACHERS*****/
    /* function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
                
                $this->load->library('ApiCrypter');
    			// insert general Details
                $TeacherData = array('name' => $this->input->post('name'),
                  'qualification' => $this->input->post('qualification'),
                  'experience_or_fresher' => $this->input->post('experience_or_fresher'),
                  'year_of_experience' => $this->input->post('year_of_experience'),
                  'mobile' => $this->input->post('mobile'),
                  'landline' => $this->input->post('landline'),
                  'email' => $this->input->post('email'),
                  'password' => $this->apicrypter->encrypt($this->input->post('password')),
                  'temp_address' => $this->input->post('temp_address'),
                  'permanent_address' => $this->input->post('permanent_address'),
                  'age' => $this->input->post('age'),
                  'DOB' => $this->input->post('DOB'),
                  'place_of_birth' => $this->input->post('place_of_birth'),
                  'religion' => $this->input->post('religion'),
                  'mother_tongue' => $this->input->post('mother_tongue'),
                  'languages_known' => $this->input->post('languages_known'),
                  'father_name' => $this->input->post('father_name'),
                  'father_occupation' => $this->input->post('father_occupation'),
                  'mother_name' => $this->input->post('mother_name'),
                  'mother_occupation' => $this->input->post('mother_occupation'),
                  'spouse_name' => $this->input->post('spouse_name'),
                  'spouse_occupation' => $this->input->post('spouse_occupation'),
                  'family_members_living_with' => $this->input->post('family_members_living_with'),
                  'extra_curriculur' => $this->input->post('extra_curriculur'),
                  'proefficient_sports' => $this->input->post('proefficient_sports'),
                  'social_activities' => $this->input->post('social_activities'),
                  'computer_knowledge_details' => $this->input->post('computer_knowledge_details'),
                  'assigned_bus'=>$this->input->post('assigned_bus'),
                  'certificate_enclosed' => $this->input->post('certificate_enclosed'));
                
                $teacher_id = $this->crud_model->insertTeacherCSV($TeacherData,$this->input->post('email')); 
                
    					// insert Experience Details
                if($this->input->post('institution1')!=''){
                  $ExperienceData1 = array('teacher_id'=>$teacher_id,
                     'institution' => $this->input->post('institution1'),
                     'desgination' => $this->input->post('desgination1'),
                     'from' => $this->input->post('from1'),
                     'to' => $this->input->post('to1'),
                     'salary' => $this->input->post('salary1'),
                     'reason_for_leaving	' => $this->input->post('reason_for_leaving1'));
                  $this->db->insert('emp_experience', $ExperienceData1);
              }
              
              if($this->input->post('institution2')!=''){
                  $ExperienceData2 = array('teacher_id'=>$teacher_id,
                     'institution' => $this->input->post('institution2'),
                     'desgination' => $this->input->post('desgination2'),
                     'from' => $this->input->post('from2'),
                     'to' => $this->input->post('to2'),
                     'salary' => $this->input->post('salary2'),
                     'reason_for_leaving	' => $this->input->post('reason_for_leaving2'));
                  $this->db->insert('emp_experience', $ExperienceData2);
              }
              
              if($this->input->post('institution3')!=''){
                  $ExperienceData3 = array('teacher_id'=>$teacher_id,
                     'institution' => $this->input->post('institution3'),
                     'desgination' => $this->input->post('desgination3'),
                     'from' => $this->input->post('from3'),
                     'to' => $this->input->post('to3'),
                     'salary' => $this->input->post('salary3'),
                     'reason_for_leaving	' => $this->input->post('reason_for_leaving3'));
                  $this->db->insert('emp_experience', $ExperienceData3);
              }
              if($this->input->post('institution4')!=''){
                  $ExperienceData4 = array('teacher_id'=>$teacher_id,
                     'institution' => $this->input->post('institution4'),
                     'desgination' => $this->input->post('desgination4'),
                     'from' => $this->input->post('from4'),
                     'to' => $this->input->post('to4'),
                     'salary' => $this->input->post('salary4'),
                     'reason_for_leaving	' => $this->input->post('reason_for_leaving4'));
                  $this->db->insert('emp_experience', $ExperienceData4);
              }
    					// insert Education Details
              if($this->input->post('institute_name_SSC')!=''){
                  $EducationData1 = array('teacher_id'=>$teacher_id,
                     'course_name' => 'SSC',
                     'institute_name' => $this->input->post('institute_name_SSC'),
                     'medium' => $this->input->post('medium_SSC'),
                     'type' => $this->input->post('type_SSC'),
                     'year_of_passing' => $this->input->post('year_of_passing_SSC'),
                     'percentage	' => $this->input->post('percentage_SSC'),
                     'class' => $this->input->post('class_obtained_SSC'));
                  
                  $this->db->insert('emp_education_details', $EducationData1);
              }
              
              if($this->input->post('institute_name_HSC')!=''){
                  $EducationData2 = array('teacher_id'=>$teacher_id,
                      'course_name' => '12th',
                      'institute_name' => $this->input->post('institute_name_HSC'),
                      'medium' => $this->input->post('medium_SSC'),
                      'type' => $this->input->post('type_HSC'),
                      'year_of_passing' => $this->input->post('year_of_passing_HSC'),
                      'percentage	' => $this->input->post('percentage_HSC'),
                      'class' => $this->input->post('class_obtained_HSC'));
                  $this->db->insert('emp_education_details', $EducationData2);
              }
              
              if($this->input->post('institute_name_UG')!=''){
                  $EducationData3 = array('teacher_id'=>$teacher_id,
                      'course_name' => 'UG',
                      'institute_name' => $this->input->post('institute_name_UG'),
                      'medium' => $this->input->post('medium_UG'),
                      'type' => $this->input->post('type_UG'),
                      'year_of_passing' => $this->input->post('year_of_passing_UG'),
                      'percentage	' => $this->input->post('percentage_UG'),
                      'class' => $this->input->post('class_obtained_UG'));
                  $this->db->insert('emp_education_details', $EducationData3);
              }
              
              if($this->input->post('institute_name_PG')!=''){
                  $EducationData4 = array('teacher_id'=>$teacher_id,
                      'course_name' => 'PG',
                      'institute_name' => $this->input->post('institute_name_PG'),
                      'medium' => $this->input->post('medium_PG'),
                      'type' => $this->input->post('type_PG'),
                      'year_of_passing' => $this->input->post('year_of_passing_PG'),
                      'percentage	' => $this->input->post('percentage_PG'),
                      'class' => $this->input->post('class_obtained_PG'));
                  $this->db->insert('emp_education_details', $EducationData4);
              }
              if($this->input->post('institute_name_Prof')!=''){
                  $EducationData5 = array('teacher_id'=>$teacher_id,
                     'course_name' => 'Professional Degree',
                     'institute_name' => $this->input->post('institute_name_Prof'),
                     'medium' => $this->input->post('medium_Prof'),
                     'type' => $this->input->post('type_Prof'),
                     'year_of_passing' => $this->input->post('year_of_passing_Prof'),
                     'percentage	' => $this->input->post('percentage_Prof'),
                     'class' => $this->input->post('class_obtained_Prof'));
                  $this->db->insert('emp_education_details', $EducationData5);
              }
              
    					//insert Reference Details
              $ReferenceData = array('teacher_id'=>$teacher_id,
                  'ref_name_1' => $this->input->post('ref_name_1'),
                  'ref_contact_1' => $this->input->post('ref_contact_1'),
                  'ref_profession_1' => $this->input->post('ref_profession_1'),
                  'address_1' => $this->input->post('address_1'),
                  'ref_name_2' =>$this->input->post('ref_name_2'),
                  'ref_contact_2' => $this->input->post('ref_contact_2'),
                  'ref_profession_2' => $this->input->post('ref_profession_2'),
                  'address_2' => $this->input->post('address_2'));
              $this->db->insert('employee_reference', $ReferenceData);
              
    					//insert Evaluation Details
              $preferable_subject_name ="";
              $preferable_class_name ="";
              if($this->input->post('preferable_subject_id')!=null){
                  $preferable_subject_name = $this->db->get_where('subject' , array('subject_id' => $this->input->post('preferable_subject_id')))->row()->name;						
              }
              
              if($this->input->post('preferable_class_id')!=null){
                  $preferable_class_name = $this->db->get_where('class' , array('class_id' => $this->input->post('preferable_class_id')))->row()->name;					
              }
              
              $EvaluateData = array('teacher_id'=>$teacher_id,
                  'subject_topic' => $this->input->post('subject_topic'),
                  'class_id' => $this->input->post('class_id'),
                  'evaluvator_name' => $this->input->post('evaluvator_name'),
                  'salary_expectation' => $this->input->post('salary_expectation'),
                  'distance_from_school' => $this->input->post('distance_from_school'),
                  'skills' => $this->input->post('skills'),
                  'attitude' => $this->input->post('attitude'),
                  'academic_skills' =>$this->input->post('academic_skills'),
                  'leadership_skills' => $this->input->post('leadership_skills'),
                  'islamic_knowledge' => $this->input->post('islamic_knowledge'),
                  'writing_skills' => $this->input->post('writing_skills'),
                  'greeting' => $this->input->post('greeting'),
                  'introduction' => $this->input->post('introduction'),		
                  'subject_knowledge' => $this->input->post('subject_knowledge'),
                  'use_of_board' => $this->input->post('use_of_board'),
                  'communication_skills' => $this->input->post('communication_skills'),
                  'teaching_methodlogy' => $this->input->post('teaching_methodlogy'),
                  'class_control' => $this->input->post('class_control'),
                  'level_of_confidence' => $this->input->post('level_of_confidence'),
                  'body_language' => $this->input->post('body_language'),
                  'evaluation_of_student_understanding' => $this->input->post('evaluation_of_student_understanding'),
                  'summary' => $this->input->post('summary'),
                  'evaluvator_status' => $this->input->post('evaluvator_status'),
                  'evaluvator_reason' => $this->input->post('evaluvator_reason'),
                  'post_applied_for' => $this->input->post('post_applied_for'),
                  'preferable_subject_id' => $this->input->post('preferable_subject_id'),
                  'preferable_subject_name' => $preferable_subject_name,
                  'preferable_class_id' => $this->input->post('preferable_class_id'),
                  'preferable_class_name' => $preferable_class_name,
                  'current_salary' => $this->input->post('current_salary'),
                  'expected_salary' => $this->input->post('expected_salary'),
                  'current_school' =>$this->input->post('current_school'),
                  'notice_period' => $this->input->post('notice_period'));
              
              $this->db->insert('emp_evalution', $EvaluateData);
              
              $QuestionsData = array('teacher_id'=>$teacher_id,
                  'answer1' => $this->input->post('answer1'),
                  'answer2' => $this->input->post('answer2'),
                  'answer3' =>$this->input->post('answer3'),
                  'answer4' =>$this->input->post('answer4'),
                  'answer5' => $this->input->post('answer5'),
                  'answer6' => $this->input->post('answer6'),
                  'answer7' => $this->input->post('answer7'),
                  'answer8' => $this->input->post('answer8'),
                  'answer9' => $this->input->post('answer9'),
                  'answer10' => $this->input->post('answer10'),
                  'answer11' => $this->input->post('answer11'),
                  'answer12' => $this->input->post('answer12'),
                  'answer13' => $this->input->post('answer13'));
              $this->db->insert('emp_question_answer', $QuestionsData);	
              $this->session->set_flashdata('flash_message' , get_phrase('data_inserted'));
              redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
          }
          if ($param1 == 'do_update') {

          } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher_add';
        $page_data['page_title'] = get_phrase('add_teacher');
        $this->load->view('backend/index', $page_data);
    } */

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
            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');
        }
        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
                //create a section by default
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $this->db->insert('section' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
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
        $data['file_name'] = $upload_data['file_name'];
    		//$_FILES['file_name']['name'];

        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
        redirect(base_url() . 'index.php?admin/academic_syllabus/' . $data['class_id'] , 'refresh');

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

    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);    
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->insert('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->where('section_id' , $param2);
            $this->db->update('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/section' , 'refresh');
        }
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

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array(
            'class_id' => $class_id
            ))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_students($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
        echo "<option value=''>Select Student</option>";
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }
    function get_studentsByCode($std_code)
    {
        $students = $this->db->get_where('enroll' , array(
            'roll' => $std_code , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            $result_arr = array('class_id'=>$row['class_id'], 'student_id'=>$row['student_id'], 'student_name'=>$name);
            echo json_encode($result_arr);
        }
    }
    function check_SpecialStud($student_id)
    {
        $Admission_Type = $this->db->get_where('student' , array('student_id' => $student_id))->row()->Admission_Type;
        echo json_encode(array('Admission_Type'=>$Admission_Type));
    }
    function get_class_sec_students($class_id, $section_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'section_id' => $section_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }

    function get_class_students_mass($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
        echo '<div class="form-group">
        <label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
        <div class="col-sm-9">';
            foreach ($students as $row) {
               $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
               echo '<div class="checkbox">
               <label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $name .'</label>
           </div>';
       }
       echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
       echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
       echo '</div></div>';
    }

        //ajax fee
    function get_class_wise_fee($class_id)
    {

        $fee_amount = $this->db->get_where('fees_details' , array('class_id' => $class_id, 'type' => 1))->row()->fees_amount;
        
        echo json_encode(array('fee_amount'=>$fee_amount));
    }

    /****MANAGE FEES*****/
    function get_class_fees($fees_id,$student_id)
    {
      $total_val =0;
      //$from_month = date('m');
      $fees_arr = $this->db->get_where('fees_details' , array('fees_id' => $fees_id))->row()->fees_amount;
            // $fees_arr = $this->db->get_where('fees_details' , array('class_id' => $class_id, 'start_month <=' => $from_month, 'end_month >=' => $from_month))->result_array();       
     //  foreach ($fees_arr as $row) {
     //     $total_val = $total_val + $row['fees_amount'];            
     // }
      $total_val= $fees_arr;
     /* Fees Concession */
     $student_arr = $this->db->get_where('student' , array( 'student_id' => $student_id ))->result_array();
     foreach ($student_arr as $row) {
        if($row['Fees_Concession']==2 && $row['Concession_Percent'] > 0){
            $concess_amount = ($total_val * $row['Concession_Percent'])/100 ;
            $total_val = $total_val - $concess_amount ;
        }           
    }
    echo json_encode(array('total_val'=>$total_val, 'Fees_Concession'=>$row['Fees_Concession'], 'Concession_Percent'=>$row['Concession_Percent']));
    }

    function get_class_fine($fees_id)
    {

        $now = time(); 
        $fine_amount=1;
        
        
      
      $fees_arr = $this->db->get_where('fees_details' , array('fees_id' => $fees_id))->row()->end_date;
      $your_date = strtotime($fees_arr);
      $datediff = $now - $your_date;

      $days=floor($datediff / (60 * 60 * 24));
      if($days>0){
        $total_val=$fine_amount*$days;
      }
      else
      {
        $total_val=0;
      }
      
    echo $total_val;
    }

     function get_fees_details($class_id, $semester, $fee_type)
    {
         $fees_arr = $this->db->get_where('fees_details' , array(
        'class_id' => $class_id, 'fees_term' => $semester,  'type' => $fee_type,
        ))->result_array();
        echo "<option value=''>Select Fees</option>";
        foreach ($fees_arr as $row) {
            //$name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['fees_id'] . '">' . $row['fees_name'] . '</option>';
        }
    }


    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');

                // get all the students of the selected class
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
                ))->result_array();
                // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                    $receiver_phone = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
                if ($receiver == 'parent') {
                    $parent_id =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    if($parent_id != '') {
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
                    }
                }
                

                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $marks = $this->db->get_where('mark' , array('year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];  
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
                    
                }
                    // send sms
                $this->sms_model->send_sms( $message , $receiver_phone );
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
            redirect(base_url() . 'index.php?admin/exam_marks_sms' , 'refresh');
        }
        
        $page_data['page_name']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE EXAM MARKS*****/
    function marks2($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks2/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks2/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
            foreach($students as $row) {
                $data['mark_obtained'] = $this->input->post('mark_obtained_' . $row['student_id']);
                $data['comment']       = $this->input->post('comment_' . $row['student_id']);
                
                $this->db->where('mark_id', $this->input->post('mark_id_' . $row['student_id']));
                $this->db->update('mark', array('mark_obtained' => $data['mark_obtained'] , 'comment' => $data['comment']));
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/marks2/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks2';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

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
        redirect(base_url() . 'index.php?admin/marks_manage_view/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');
        
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
        redirect(base_url().'index.php?admin/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }

    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/marks_get_subject' , $page_data);
    }

        // TABULATION SHEET
    function tabulation_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(base_url() . 'index.php?admin/tabulation_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'tabulation_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
        
    }

    function approve_marks($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/approve_marks/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(base_url() . 'index.php?admin/approve_marks/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'approve_marks';
        $page_data['page_title'] = get_phrase('approve_marks');
        $this->load->view('backend/index', $page_data);
        
    }

    function approve_marks_status($class_id = '' , $exam_id = '',$student_id='') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        $query =  $this->db->get_where('mark' , array(
                                                    'class_id' => $class_id , 
                                                        'exam_id' => $exam_id , 
                                                                'student_id' => $student_id,
                                                                    'year' => $year
                                                ));
        if ( $query->num_rows() > 0) {
            foreach ($query as $row) {
                $this->db->where('class_id' , $class_id);
                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $student_id);
                $this->db->where('year' , $year);
                
                $this->db->update('mark' , array('status' => '2'));
            }
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('marks_approved'));
        redirect(base_url().'index.php?admin/approve_marks/'.$class_id.'/'.$exam_id , 'refresh');
        
        
        
    }


    function approve_marks_update($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $year))->result_array();
        foreach($students as $row){
            $student_id=$row['student_id'];
            $subjects =  $this->db->get_where('mark' , array('class_id' => $class_id , 'exam_id' => $exam_id , 'student_id' => $row['student_id'],'year' => $year))->result_array();
            foreach ($subjects as $row2) {
                $subject_id=$row2['subject_id'];
                $marks=$this->input->post('marks_obtained_'.$student_id.'_'.$subject_id);
                $this->db->where('class_id' , $class_id);
                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('subject_id' , $row2['subject_id']);
                $this->db->where('year' , $year);
                
                $this->db->update('mark' , array('mark_obtained' => $marks));
            }

        }
        
        

        
        
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(base_url().'index.php?admin/approve_marks/'.$class_id.'/'.$exam_id , 'refresh');
        
        
        
    }




    function tabulation_sheet_print_view($class_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/admin/tabulation_sheet_print_view' , $page_data);
    }

    	//Employee Contracts
    function emp_contract($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['emp_id']     = $this->input->post('emp_id');
            $data['emp_type']           =1;
            $data['contract_type']           = $this->input->post('contract_type');
            
            $this->db->insert('emp_contracts', $data);
            $notice_id = $this->db->insert_id();
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/emp_contract/', 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('emp_contracts');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/emp_contract/', 'refresh');
        }
        $page_data['page_name']  = 'employee_contract';
        $page_data['page_title'] = get_phrase('employee_contract');
        $page_data['emp_contracts']    = $this->db->get('emp_contracts')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            $this->db->insert('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                'grade_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/class_routine_add/' . $data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $class_id, 'refresh');
        }
        
    }

    function class_routine_add($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_add';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('add_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_view';
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
        $this->load->view('backend/admin/class_routine_print_view' , $page_data);
    }

    function get_class_section_subject($class_id)
    {
      if($class_id!=0){
         $page_data['class_id'] = $class_id;
         $this->load->view('backend/admin/class_routine_section_subject_selector' , $page_data);
     }
     
    }

    function section_subject_edit($class_id , $class_routine_id)
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit' , $page_data);
    }


        function class_attendance_manage(){
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $page_data['page_name'] = 'class_attendance_manage_view';
        $page_data['page_title'] = get_phrase('manage_attendance_view');
        $this->load->view('backend/index', $page_data);
    }


     function bus_attendance_manage(){
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $page_data['page_name'] = 'bus_attndnc_view';
        $page_data['page_title'] = get_phrase('bus_attendance_view');
        $this->load->view('backend/index', $page_data);
    }

    function submit_view_attendance_bus(){

        $bus_Id=$this->input->post('bus_Id');
        $month_new=$this->input->post('month');
        $year=$this->input->post('year');
        if($month_new=="0"){
            $month_new=date("F");
        }
        if($year=="0"){
            $running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
            $year=$this->db->get_where('academic_year' , array('academic_year'=>$running_year))->row()->ac_id;
        }
        $year_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->academic_year;
        $start_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->start_date;
        $end_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->end_date;

        
        $arr['month_details']=array();

        $from_date = $start_date;
 // End date
 $end_date = $end_date;
 $month_test=1;
 $arr['dates']=array();
 $arr['month_dayss']=array();
 while (strtotime($from_date) <= strtotime($end_date)) {
    $time=strtotime($from_date);
                $month=date("F",$time);
                $year=date("Y",$time);
                
    if($month==$month_new){
        $day = date('l', strtotime($from_date));
         $string = substr($day,0,3);
        array_push($arr['month_dayss'], $string);
        array_push($arr['dates'], $from_date);
        $month_test++;
    }
    
                

 
  
  $from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
 }

         $page_data['month_days']=$arr['month_dayss'];
          $page_data['dates']=$arr['dates'];
          $page_data['bus']=$bus_Id;
          $page_data['year_date']=$year_date;
         $page_data['month_counter']=($month_test-1);
        $page_data['page_name'] = 'bus_attndnc_view_with_table';
        $page_data['page_title'] = get_phrase('bus_attndnc_view');
        $this->load->view('backend/index', $page_data);
    }


        function submit_view_attendance(){
        $class_id=$this->input->post('class_id');
        $section_id=$this->input->post('section_id');
        $month_new=$this->input->post('month');
        if($month_new=="0"){
            $month_new=date("F");
        }
        $year=$this->input->post('year');
        if($year=="0"){
            $running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
            $year=$this->db->get_where('academic_year' , array('academic_year'=>$running_year))->row()->ac_id;
        }
        $arr['month_details']=array();
        $year_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->academic_year;
        $start_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->start_date;
        $end_date       =   $this->db->get_where('academic_year' , array('ac_id'=>$year))->row()->end_date;
            
 $from_date = $start_date;
 // End date
 $end_date = $end_date;
 $month_test=1;
 $arr['dates']=array();
 $arr['month_dayss']=array();
 while (strtotime($from_date) <= strtotime($end_date)) {
    $time=strtotime($from_date);
                $month=date("F",$time);
                $year=date("Y",$time);
                
    if($month==$month_new){
        $day = date('l', strtotime($from_date));
         $string = substr($day,0,3);
        array_push($arr['month_dayss'], $string);
        array_push($arr['dates'], $from_date);
        $month_test++;
    }
    
                

 
  
  $from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
 }

         $page_data['month_days']=$arr['month_dayss'];
          $page_data['dates']=$arr['dates'];
          $page_data['section']=$section_id;
          $page_data['class']=$class_id;
          $page_data['year_date']=$year_date;
         $page_data['month_counter']=($month_test-1);
        $page_data['page_name']  =  'class_attendance_manage_view_with_table';
        $page_data['page_title'] =  get_phrase('manage_attendance_view');
        $this->load->view('backend/index', $page_data);

    }

        function section_ajax($classid){
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

    	//balance_sheet Selector
    function balance_sheet_selector()
    {
        $data['month']   = $this->input->post('month');
        $data['year']       = $this->input->post('year');
        
        redirect(base_url().'index.php?admin/balance_sheet_view/'.$data['month'].'/'.$data['year'],'refresh');
    }

    	//balance_sheet_view
    function balance_sheet_view($month = '' , $year = '' )
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['page_name'] = 'balance_sheet_view';
        
        $page_data['page_title'] = get_phrase('balance_sheet');
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
                /*Avoid Suspended Students*/
                $Student_Status = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Student_Status;
                if($Student_Status == 1){
                   $attn_data['class_id']   = $data['class_id'];
                   $attn_data['year']       = $data['year'];
                   $attn_data['timestamp']  = $data['timestamp'];
                   $attn_data['att_month']  = $month_name;
                   $attn_data['att_date']  = $date_formate;
                   $attn_data['section_id'] = $data['section_id'];
                   $attn_data['student_id'] = $row['student_id'];
                   $attn_data['student_name'] = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;				
                   $this->db->insert('attendance' , $attn_data);  
               }
           }
           
       }
       redirect(base_url().'index.php?admin/manage_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
            ))->result_array();
        foreach($attendance_of_students as $row) {
                // $attendance_status = $this->input->post('status_'.$row['attendance_id']);                        
         $in_status = $this->input->post('in_status_'.$row['attendance_id']);
         if($in_status == false)
            $attendance_in_status = 2;
        else
            $attendance_in_status = 1;
        $out_status = $this->input->post('out_status_'.$row['attendance_id']);
        if($out_status == false)
            $attendance_out_status = 2;
        else
            $attendance_out_status = 1;
        $this->db->where('attendance_id' , $row['attendance_id']);
        $this->db->update('attendance' , array('In_Status' => $attendance_in_status, 'Out_Status' => $attendance_out_status, 'att_date' => date("Y-m-d" , $timestamp), 'att_month' => date("F" , $timestamp)));
    }
        
                //send push notification to app
        
        $this->load->library('GCM');
        $cur_Date = date("Y-m-d");

   //send attendance notification to parents
   $Attquery=$this->db->query("SELECT G.GCM_RegId,A.In_Status,A.Out_Status,A.student_name FROM ".TABLE_GCM." G INNER JOIN ".TABLE_STUDENTS." S ON
   G.User_Id=S.parent_id INNER JOIN ".TABLE_ATTENDANCE." A ON
   S.student_id=A.student_id WHERE G.User_Id IN (SELECT S.parent_id FROM ".TABLE_STUDENTS." WHERE S.student_id 
   IN (SELECT A.student_id FROM ".TABLE_ATTENDANCE." WHERE A.att_date= '".$cur_Date."')) AND G.User_Type='parent'");
   
   if($Attquery->num_rows() > 0) {
    foreach ($Attquery->result_array() as $row) {
     $InStatus=$row['In_Status'];
     $OutStatus=$row['Out_Status'];
     $Stu_Name=$row['student_name'];
     if($InStatus==1 && $OutStatus==2)
     {
      $message = array("Notification" => "Alhumdulillah! ".$Stu_Name." has entered the class." ,"image_url" => ""); 
     }else if($InStatus==1 && $OutStatus==1){
      $message = array("Notification" => "Such a lovely child! ".$Stu_Name." has left the class." ,"image_url" => ""); 
     }
     else if($InStatus==2){
      $message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => ""); 
     }
     $this->gcm->clearRecepients();
     $this->gcm->addRecepient($row['GCM_RegId']);
     $this->gcm->setData($message);
     $Type='parent';
     $this->gcm->send($Type);
    }
   }
   
   // Send alert if bus attendance is present and class attendance absent
   // only pick up trip is enough
   // msg to parent
   $Attquery1=$this->db->query("SELECT G.GCM_RegId,A.in_status,A.out_status,A.student_name,A.student_id,S.pickup_route_id FROM app_gcm_parents G 
    INNER JOIN student S ON G.User_Id=S.parent_id 
    INNER JOIN attendance_driver A ON S.student_id=A.student_id AND A.user_type='student' 
    WHERE G.User_Id IN (SELECT S.parent_id FROM student WHERE S.student_id 
    IN (SELECT A.student_id FROM attendance_driver WHERE A.att_date= '".$cur_Date."')) 
    AND G.User_Type='parent' AND A.trip_type=1");
   
   if($Attquery1->num_rows() > 0) {
    foreach ($Attquery1->result_array() as $row1) {
        
     $BusInStatus=$row1['in_status'];
     $BusOutStatus=$row1['out_status'];
     $Stu_Name=$row1['student_name'];
     
     $this->db->select('driver_id,bus_id');
     $this-> db -> from('routes');
     $this-> db ->where('route_id', $row1['pickup_route_id']); 
     $RouteData=$this -> db -> get();
     
     $driver_id=$RouteData->row('driver_id'); 
     $bus_id=$RouteData->row('bus_id');
     
     $driver_mobile=$this->db->get_where('driver_details', array('driver_id' => $driver_id))->row()->mobile;
     $bus_number=$this->db->get_where('bus_details', array('bus_Id' => $bus_id))->row()->plate_number;
        
     $this->db->select('In_Status,Out_Status');
     $this-> db -> from('attendance');
     $this-> db ->where('student_id', $row1['student_id']); 
     $this-> db ->where('att_date', $cur_Date); 
     
     $attData=$this -> db -> get();
     
     $InStatus=$attData->row('In_Status'); 
     $OutStatus=$attData->row('Out_Status');
     if($BusInStatus==1 && $InStatus==2){
      $message = array("Notification" => "Emergency Alert!\n".$Stu_Name." has not entered the class yet. Please contact driver immediately\nDriver Mobile : ".$driver_mobile."\nBus Number : ".$bus_number ,"image_url" => ""); 
      
      $this->gcm->clearRecepients();
      $this->gcm->addRecepient($row1['GCM_RegId']);
      $this->gcm->setData($message);
      $Type='parent';
      $this->gcm->send($Type);
     }
     
     
    }
   }
   // msg to Transport
   $Attquery2=$this->db->query("SELECT A.In_Status,A.Out_Status,A.student_name,A.student_id,S.pickup_route_id,S.class_name,S.section_name FROM attendance_driver A 
    INNER JOIN student S ON A.student_id=S.student_id AND A.user_type='student' 
    AND A.att_date='".$cur_Date."'");
   
   if($Attquery2->num_rows() > 0) {
    foreach ($Attquery2->result_array() as $row2) {
     $BusInStatus=$row2['In_Status'];
     $BusOutStatus=$row2['Out_Status'];
     $Stu_Name=$row2['student_name'];
     $class=$row2['class_name'];
     $section=$row2['section_name'];
     
     $this->db->select('driver_id,bus_id');
     $this-> db -> from('routes');
     $this-> db ->where('route_id', $row2['pickup_route_id']); 
     $RouteData=$this -> db -> get();
     
     $driver_id=$RouteData->row('driver_id'); 
     $bus_id=$RouteData->row('bus_id');
     
     $driver_mobile=$this->db->get_where('driver_details', array('driver_id' => $driver_id))->row()->mobile;
     $driver_name=$this->db->get_where('driver_details', array('driver_id' => $driver_id))->row()->name;
     $bus_number=$this->db->get_where('bus_details', array('bus_Id' => $bus_id))->row()->plate_number;
        
     
     $this->db->select('in_status,out_status');
     $this-> db -> from('attendance');
     $this-> db ->where('student_id', $row2['student_id']); 
     $this-> db ->where('att_date', $cur_Date); 
     
     $attData=$this -> db -> get();
     
     $InStatus=$attData->row('in_status'); 
     $OutStatus=$attData->row('out_status');
     
     $this -> db -> select('GCM_RegId');
     $this -> db -> from('app_gcm_parents');
     $this -> db -> where('User_Type', 'transport');
     $query = $this->db->get();
     if($query->num_rows() > 0) {
      foreach ($query->result_array() as $row3) {
       $res = array();
     
       if($BusInStatus==1 && $InStatus==2){
        $res['data']['title'] = "Emergency Alert!";
        $res['data']['message'] = "Student ".$Stu_Name." of has not entered class ".$class." ".$section." \nPlease contact Driver : ".$driver_name." \nMobile : ".$driver_mobile."\nBus number : ".$bus_number."\n".date('Y-m-d G  ');
        $res['data']['notification_message'] ="";
        $res['data']['image'] = "";
        $res['data']['type'] = "normal";
        $this->gcm->clearRecepients();
        $this->gcm->addRecepient($row3['GCM_RegId']);
        $this->gcm->setData($res);
        $Type='transport';
        $this->gcm->send($Type);
       }
       
      }
     }
    }
   }
        
        // $Attquery=$this->db->query("SELECT G.GCM_RegId,A.In_Status,A.Out_Status,A.student_name FROM ".TABLE_GCM." G INNER JOIN student S ON
        //  G.User_Id=S.parent_id INNER JOIN attendance A ON
        //  S.student_id=A.student_id WHERE G.User_Id IN (SELECT S.parent_id FROM student WHERE S.student_id 
        //  IN (SELECT A.student_id FROM attendance WHERE A.att_date= '".$cur_Date."')) AND G.User_Type='parent'");
        
        // if($Attquery->num_rows() > 0) {
        //     foreach ($Attquery->result_array() as $row) {
        //        $InStatus=$row['In_Status'];
        //        $OutStatus=$row['Out_Status'];
        //        $Stu_Name=$row['student_name'];
        //        $message='';
        //        if($InStatus==1 && $OutStatus==2)
        //        {
        //           $message = array("Notification" => "Alhumdulillah! ".$Stu_Name." has entered the class." ,"image_url" => "");  
        //       }else if($InStatus==1 && $OutStatus==1){
        //           $message = array("Notification" => "Such a lovely child! ".$Stu_Name." has left the class." ,"image_url" => "");   
        //       }
        //       else if($InStatus==2){
        //           $message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => ""); 
        //       }
        //       $this->gcm->addRecepient($row['GCM_RegId']);
        //       $this->gcm->setData($message);
        //       $Type='parent';
        //       $this->gcm->send($Type);
        //   }
      
             /*   if ($attendance_status == 2) {

                    if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        $this->sms_model->send_sms($message,$receiver_phone);
                    }
                }  */
            
            $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
            redirect(base_url().'index.php?admin/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
        }
        
        /****** DAILY ATTENDANCE *****************/
        function manage_attendance2($date='',$month='',$year='',$class_id='' , $section_id = '' , $session = '')
        {
          if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        
        if($_POST)
        {
    			// Loop all the students of $class_id
            $this->db->where('class_id' , $class_id);
            if($section_id != '') {
                $this->db->where('section_id' , $section_id);
            }
                //$session = base64_decode( urldecode( $session ) );
            $this->db->where('year' , $session);
            $students = $this->db->get('enroll')->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $date);
                $this->db->where('year' , $year);
                $this->db->where('class_id' , $row['class_id']);
                if($row['section_id'] != '' && $row['section_id'] != 0) {
                    $this->db->where('section_id' , $row['section_id']);
                }
                $this->db->where('session' , $session);

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

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id.'/'.$section_id.'/'.$session , 'refresh');
        }
        $page_data['date']       =	$date;
        $page_data['month']      =	$month;
        $page_data['year']       =	$year;
        $page_data['class_id']   =  $class_id;
        $page_data['section_id'] =  $section_id;
        $page_data['session']    =  $session;
        
        $page_data['page_name']  =	'manage_attendance';
        $page_data['page_title'] =	get_phrase('manage_daily_attendance');
        $this->load->view('backend/index', $page_data);
    }
    function attendance_selector2()
    {
            //$session = $this->input->post('session');
            //$encoded_session = urlencode( base64_encode( $session ) );
      redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.
       $this->input->post('month').'/'.
       $this->input->post('year').'/'.
       $this->input->post('class_id').'/'.
       $this->input->post('section_id').'/'.
       $this->input->post('session') , 'refresh');
    }

    function minimum_attendance_percentage(){
         $data['description'] =   $this->input->post('percentage');
         $class_id =   $this->input->post('class_id');
         
         $this->db->where('type' , 'attendance_percentage');
         $this->db->update('settings' , $data);
         $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
         redirect(base_url() . 'index.php?admin/manage_attendance/'.$class_id, 'refresh');
    }

    	// TEACHERS ACADEMIC SYLLABUS
    function teacher_academics($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            // detect the first class
        if ($class_id == '')
            $class_id = $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'teacher_academics';
        $page_data['page_title'] = get_phrase('daily_syllabus');
        $page_data['class_id']   = $class_id;		
        $this->load->view('backend/index', $page_data);
    }

    function view_teacher_academics_records($academic_id='')
    {
       if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

        $month_new=$this->input->post('month');
        $year=$this->input->post('year');
         $arr['month_details']=array();
          $month_test=1;
         $arr['dates']=array();
         $arr['month_dayss']=array();
            
        if(empty($year)){
            $year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
            $start_date       =   $this->db->get_where('academic_year' , array('academic_year'=>$year))->row()->start_date;
            $end_date       =   $this->db->get_where('academic_year' , array('academic_year'=>$year))->row()->end_date;

       

        $from_date = $start_date;
        $end_date = $end_date;

                     while (strtotime($from_date) <= strtotime($end_date)) {
                        $time=strtotime($from_date);
                                    $month=date("F",$time);
                                    $year=date("Y",$time);
                                    
                        if($month==$month_new){
                            $day = date('l', strtotime($from_date));
                             $string = substr($day,0,3);
                            array_push($arr['month_dayss'], $string);
                            array_push($arr['dates'], $from_date);
                            $month_test++;
                        }
                      $from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
                     }
                           $size_arr=sizeof($arr['dates']);

        $from_date = strtotime($arr['dates'][0]);
        $to_date = strtotime($arr['dates'][$size_arr-1]);
      
        }else{
                $start_date       =   $this->db->get_where('academic_year' , array('academic_year'=>$year))->row()->start_date;
                $end_date       =   $this->db->get_where('academic_year' , array('academic_year'=>$year))->row()->end_date;

                 $from_date = strtotime($start_date);
                $to_date = strtotime($end_date);
        }


        

   

    $page_data['page_name']  = 'teacher_academics_view_records2';
    $page_data['page_title'] = get_phrase('view_progress');
    $page_data['academic_id']   = $academic_id; 
    $page_data['from_date']   = $from_date;
    $page_data['to_date']   = $to_date; 
    $this->load->view('backend/index', $page_data);

            // $query = $this->db->get_where('attendance' ,array(
            //     'class_id'=>$data['class_id'],
            //         'section_id'=>$data['section_id'],
            //             'year'=>$data['year'],
            //                 'timestamp'=>$data['timestamp']
            // ));
    }

    function view_teacher_academics($academic_id='')
    {
       if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'teacher_academics_view_records';
    $page_data['page_title'] = get_phrase('view_progress');
    $page_data['academic_id']   = $academic_id;  
    $this->load->view('backend/index', $page_data);

            // $query = $this->db->get_where('attendance' ,array(
            //     'class_id'=>$data['class_id'],
            //         'section_id'=>$data['section_id'],
            //             'year'=>$data['year'],
            //                 'timestamp'=>$data['timestamp']
            // ));
    }

    function upload_teacher_academics()
    {
            // $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['book_name']            =   $this->input->post('book_name');
        $data['class_id']               =   $this->input->post('class_id');
        $data['section_id']               =   $this->input->post('section_id');
        $data['subject_id']               =   $this->input->post('subject_id'); 
        $data['teacher_id']				= 	$this->input->post('teacher_id');
        $data['semester_id']				= 	$this->input->post('semester_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s")); 
        $query = $this->db->query("SELECT COALESCE(MAX(academic_id),0) as academic_id FROM teacher_academics");
        if($query->result() == TRUE){
         foreach($query->result_array() as $row):
            $data['academic_id'] = $row['academic_id'] + 1;
        endforeach;
    }else{
     $data['academic_id'] = substr(md5(rand(0, 1000000)), 0, 7);
    }		
    $max_count = $this->input->post('max_count');
      
	for($i=1;$i<=$max_count;$i++){
		
			$data['from_page']    =   $this->input->post('start_page'.$i);
			$data['to_page']    =   $this->input->post('end_page'.$i);
			$data['day']    = $i;
			$this->db->insert('teacher_academics', $data);
		
    }   	
    $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
    redirect(base_url() . 'index.php?admin/teacher_academics/' . $data['class_id'] , 'refresh'); 

    }

    function update_teacher_academics($academic_id='')
    {
            // $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['book_name']            =   $this->input->post('book_name');
        $data['class_id']               =   $this->input->post('class_id');
        $data['section_id']               =   $this->input->post('section_id');
        $data['subject_id']               =   $this->input->post('subject_id'); 
        $data['teacher_id']				= 	$this->input->post('teacher_id');
        $data['semester_id']				= 	$this->input->post('semester_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s")); 
        
        $max_count = $this->input->post('max_count');
        for($i=1;$i<=$max_count;$i++){
         $data['from_page']    =   $this->input->post('start_page'.$i);
         $data['to_page']    =   $this->input->post('end_page'.$i);
    			//$data['day']    = $i;
         $where="academic_id=$academic_id AND day=$i";
         $this->db->where($where);
         $this->db->update('teacher_academics' , $data);
     }        
     $this->session->set_flashdata('flash_message' , get_phrase('syllabus_updated'));
     redirect(base_url() . 'index.php?admin/teacher_academics/' . $data['class_id'] , 'refresh'); 

    }


    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            $data2['description']       =   $this->input->post('description');
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
        }

        if ($param1 == 'create_mass_invoice') {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id']         = $id;
                $data['title']              = $this->input->post('title');
                $data['description']        = $this->input->post('description');
                $data['amount']             = $this->input->post('amount');
                $data['amount_paid']        = $this->input->post('amount_paid');
                $data['due']                = $data['amount'] - $data['amount_paid'];
                $data['status']             = $this->input->post('status');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));
                $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                
                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id']        =   $invoice_id;
                $data2['student_id']        =   $id;
                $data2['title']             =   $this->input->post('title');
                $data2['description']       =   $this->input->post('description');
                $data2['payment_type']      =  'income';
                $data2['method']            =   $this->input->post('method');
                $data2['amount']            =   $this->input->post('amount_paid');
                $data2['timestamp']         =   strtotime($this->input->post('date'));
                $data2['year']               =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('payment' , $data2);
            }
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
            $data['description']  =   $this->input->post('description');
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $data['year']         =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   $this->input->post('amount');
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?admin/income/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/income', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**********ACCOUNTING********************/
    function income($param1 = '' , $param2 = '')
    {
     if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    $page_data['page_name']  = 'income';
    $page_data['page_title'] = get_phrase('student_payments');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('backend/index', $page_data); 
    }

    function student_invoice($param1 = '' , $param2 = '' , $param3 = '') {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['invoice_code']     = substr(md5(rand(0, 1000000)), 0, 7);
        $data['student_id'] = $this->input->post('stu_name');
        
        $data['student_roll']     = $this->db->get_where('student' , array('student_id' =>$this->input->post('stu_name')))->row()->student_code;
        $data['class_id']        = $this->input->post('class_id');
        $data['description']     = $this->input->post('description');
        $data['paid_on']     = date("Y-m-d");
        $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        $semester= $this->input->post('fees_semester');
        $fees_type= $this->input->post('fees_type');
        $fees_id= $this->input->post('fees_id');
        $fees_amount= $this->input->post('fees_amount');
        $fine_amount= $this->input->post('fine_amount');
        $method= $this->input->post('method');

        if(is_array($semester)){
            for($i=0; $i<sizeof($semester); $i++){
                $data['fees_term']= $semester[$i];
                $data['fees_type']= $fees_type[$i];
                $data['fees_id']= $fees_id[$i];
                $data['fees_title']= $this->db->get_where('fees_details' , array('fees_id' =>$fees_id[$i]))->row()->fees_name;
                $data['total_fees_amount']= $fees_amount[$i];
                $data['fine_amount']= $fine_amount[$i];
                $data['paid_method']= $method[$i];
                $this->db->insert('fees_invoice', $data);
            }
        }
        else{
            $data['fees_term']= $semester;
            $data['fees_type']= $fees_type;
            $data['fees_id']= $fees_id;
            $data['fees_title']= $this->db->get_where('fees_details' , array('fees_id' =>$fees_id))->row()->fees_name;
            $data['total_fees_amount']= $fees_amount;
            $data['fine_amount']= $fine_amount;
            $data['paid_method']= $method;
            $this->db->insert('fees_invoice', $data);
        }


        // $data['total_fees_amount']   = $this->input->post('fees_amount');
        // $data['fine_amount']     = $this->input->post('fine_amount');
        
        // $data['fees_term']     = $this->input->post('fees_term');
        // $data['paid_method']=$this->input->post('method');
        
        
        
        
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admin/student_invoice/', 'refresh');
    }

    $page_data['page_name']  = 'student_invoice';
    $page_data['page_title'] = get_phrase('create_student_payment');
    $this->load->view('backend/index', $page_data); 
}

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'student_payment';
        $page_data['page_title'] = get_phrase('create_student_payment');
        $this->load->view('backend/index', $page_data); 
    }

    	//Events
    function events($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['Event_Title'] =   $this->input->post('Event_Title');
            $data['Event_Date'] =   Date('Y-m-d',strtotime($this->input->post('Event_Date')));
            $data['Event_AddedOn']         =   date('Y-m-d');
            
            $this->db->insert('app_event' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/events', 'refresh');
        }
        if ($param1 == 'edit') {
         $data['Event_Title'] =   $this->input->post('Event_Title');
         $data['Event_Date'] =   Date('Y-m-d',strtotime($this->input->post('Event_Date')));
         
         $this->db->where('Event_Id' , $param2);
         $this->db->update('app_event' , $data);
         $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
         redirect(base_url() . 'index.php?admin/events', 'refresh');
     }

     if ($param1 == 'delete') {
        $this->db->where('Event_Id' , $param2);
        $this->db->delete('app_event');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/events', 'refresh');
    }

    $page_data['page_name']  = 'events';
    $page_data['page_title'] = get_phrase('events');
    $this->load->view('backend/index', $page_data); 
    }

    	//BroadCasts
    function broadcasts($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
                /*$data['class_id'] =   $this->input->post('class_id');
                $data['section_id'] =   $this->input->post('section_id');
                $data['message'] =   $this->input->post('message');
                $data['Event_AddedOn']         =   date('Y-m-d');*/
                
                $this->load->model('Chatting_model');
                $this->load->library('GCM');
                
                $sender=$this->session->userdata('login_type')."-".$this->session->userdata('login_user_id');
                $data = $this->Chatting_model->send_new_broadcast_message($sender,$this->input->post('message'),$this->input->post('class_id'),$this->input->post('section_id'));
                
                if($data){
                    $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                    $query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent' AND User_Id IN 
                       (SELECT parent_id FROM student WHERE student_id IN 
                       (SELECT student_id FROM enroll WHERE class_id=".$this->input->post('class_id')." AND section_id=".$this->input->post('section_id')." AND year='".$running_year."'))");
                    if($query->num_rows() > 0) {
                       $this->gcm->clearRecepients();
                       foreach ($query->result_array() as $row) {
                          $this->gcm->addRecepient($row['GCM_RegId']);
                      }
                      $message = array("Notification" => "Chat".$data."|".urldecode($sender).":\n".urldecode($this->input->post('message')) ,"image_url" => "");	
                      $this->gcm->setData($message);
                      $this->gcm->send('parent');
                  }
              }
              $this->session->set_flashdata('flash_message' , get_phrase('message_sent_successfully'));
              redirect(base_url() . 'index.php?admin/broadcasts', 'refresh');
          }
          $page_data['page_name']  = 'broadcasts';
          $page_data['page_title'] = get_phrase('broadcasts');
          $this->load->view('backend/index', $page_data); 
      }
      
    	//Expense
      function expense($param1 = '' , $param2 = '')
      {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['exp_name']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['total_amount']              =   $this->input->post('amount');
            $data['exp_date']           =   $this->input->post('exp_date');
            $data['invoice_number']           =   $this->input->post('invoice_number');
            $data['vendor_name']           =   $this->input->post('vendor_name');
            $data['inserted_on']		= Date("Y-m-d");
            
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
    			//print_r($files);
            
            $config = array();
            $config['upload_path'] = './uploads/expense_invoice/';	
            $config['allowed_types'] = '*';
            $invoiceUrl="";
            for($i=0; $i<$cpt; $i++)
            {   
                $_FILES['images']['name']= $files['images']['name'][$i];
                $_FILES['images']['type']= $files['images']['type'][$i];
                $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['images']['error']= $files['images']['error'][$i];
                $_FILES['images']['size']= $files['images']['size'][$i];    

                $this->upload->initialize($config);
                
                if ( ! $this->upload->do_upload('images')){
                   $error = $this->upload->display_errors();
                   echo ($error); 
               }else{
                   $uploadData = $this->upload->data();
                   $uploadData['file_name'] = str_replace(" ","_",$uploadData['file_name']);
                   $uploadData['file_name'] = str_replace("&","_",$uploadData['file_name']);
                   $invoiceUrl=$invoiceUrl.$uploadData['file_name'].'~';
               }
           }
           $data['invoice_url']  = substr($invoiceUrl, 0, -1);
           
           $this->db->insert('expense' , $data);
           $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
           redirect(base_url() . 'index.php?admin/expense', 'refresh');
       }

       if ($param1 == 'edit') {
        $data['exp_name']               =   $this->input->post('title');
        $data['expense_category_id'] =   $this->input->post('expense_category_id');
        $data['description']         =   $this->input->post('description');
        $data['total_amount']              =   $this->input->post('amount');
        $data['exp_date']           =   $this->input->post('exp_date');
        $data['invoice_number']           =   $this->input->post('invoice_number');
        $data['vendor_name']           =   $this->input->post('vendor_name');
        $data['inserted_on']		= Date("Y-m-d");
        $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['images']['name']);
    			//print_r($files);
        
        $config = array();
        $config['upload_path'] = './uploads/expense_invoice/';	
        $config['allowed_types'] = '*';
        
        $doc   = $this->db->get_where('expense' , array('exp_id' => $param2))->row()->invoice_url;
        if($doc=='' || $doc==null || $doc=='0'){
            $invoiceUrl="";	
        }else{
            $invoiceUrl=$doc.'~';
        }
        
        $invoiceUrl="";
        for($i=0; $i<$cpt; $i++)
        {   
            $_FILES['images']['name']= $files['images']['name'][$i];
            $_FILES['images']['type']= $files['images']['type'][$i];
            $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
            $_FILES['images']['error']= $files['images']['error'][$i];
            $_FILES['images']['size']= $files['images']['size'][$i];    

            $this->upload->initialize($config);
            
            if ( ! $this->upload->do_upload('images')){
               $error = $this->upload->display_errors();
               echo ($error); 
           }else{
               $uploadData = $this->upload->data();
               $uploadData['file_name'] = str_replace(" ","_",$uploadData['file_name']);
               $uploadData['file_name'] = str_replace("&","_",$uploadData['file_name']);
               $invoiceUrl=$invoiceUrl.$uploadData['file_name'].'~';
           }
       }
       
       if($invoiceUrl!=''){
        if (strpos($invoiceUrl, '~') !== false) {
           $data['invoice_url']  = substr($invoiceUrl, 0, -1);
       }else{
           $data['invoice_url']  = $invoiceUrl;
       }
    }


    $this->db->where('exp_id' , $param2);
    $this->db->update('expense' , $data);
    $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    redirect(base_url() . 'index.php?admin/expense', 'refresh');
    }

    if ($param1 == 'delete') {
        $this->db->where('exp_id' , $param2);
        $this->db->delete('expense');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/expense', 'refresh');
    }

    $page_data['page_name']  = 'expense';
    $page_data['page_title'] = get_phrase('expenses');
    $this->load->view('backend/index', $page_data); 
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }

        $page_data['page_name']  = 'expense_category';
        $page_data['page_title'] = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);
    }
    /* Fees Type */
    function fees_type($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $data['amount']   =   $this->input->post('amount');
            $this->db->insert('fees_type' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/fees_type');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $data['amount']   =   $this->input->post('amount');
            $this->db->where('fees_id' , $param2);
            $this->db->update('fees_type' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/fees_type');
        }
        if ($param1 == 'delete') {
            $this->db->where('fees_id' , $param2);
            $this->db->delete('fees_type');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/fees_type');
        }

        $page_data['page_name']  = 'fees_type';
        $page_data['page_title'] = get_phrase('fees_type');
        $this->load->view('backend/index', $page_data);
    }


    /* Fees Pending */
    /*	function fees_pending($param1 = '' , $param2 = '')
        {
            if ($this->session->userdata('admin_login') != 1)
                redirect('login', 'refresh');
            if ($param1 == 'update') {
                $data['action_status']   =   '2';
    			$this->db->where('pending_id' , $param2);
                $this->db->update('fees_pending' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
                redirect(base_url() . 'index.php?admin/fees_pending');
            }
            $page_data['page_name']  = 'fees_pending';
            $page_data['page_title'] = get_phrase('fees_pending');
            $this->load->view('backend/index', $page_data);
        }
        */
        
        /* Fees Pending */
        function fees_pending_actions($param1 = '' , $param2 = '')
        {
            if ($this->session->userdata('admin_login') != 1)
                redirect('login', 'refresh');  
            if ($param1 == 'multi_susp') {
                $data['action_status']   =   '3';
                $multi_ids = rtrim($param2 ,',');
                $multi_ids_arr = explode(',',$multi_ids);
                foreach ($multi_ids_arr as $pending_id){
                    $this->db->where('pending_id' , $pending_id);
                    $this->db->update('fees_pending' , $data);
                    /* Suspend the Student*/
                    $student_id   = $this->db->get_where('fees_pending' , array('pending_id' => $pending_id))->row()->student_id;
                    if(is_numeric($student_id)){
                       $st_data['Student_Status']   =   '2';
                       $this->db->where('student_id' , $student_id);
                       $this->db->update('student' , $st_data);
                   }	
               }			 
                // $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
               echo get_phrase('data_updated') ;
                // redirect(base_url() . 'index.php?admin/fees_pending');
           } else if ($param1 == 'multi_admit') {
            $data['action_status']   =   '2';
            $multi_ids = rtrim($param2 ,',');
            $multi_ids_arr = explode(',',$multi_ids);
            foreach ($multi_ids_arr as $pending_id){
                $this->db->where('pending_id' , $pending_id);
                $this->db->update('fees_pending' , $data);
            }            
            echo get_phrase('data_updated') ;            
        }        
    }
    function fees_pending($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');        
        $page_data['page_name']  = 'fees_pending';
        $page_data['page_title'] = get_phrase('fees_pending');
        $this->load->view('backend/index', $page_data);
    }
    	//Balance Sheet
    function balance_sheet($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');        
        $page_data['page_name']  = 'balance_sheet';
        $page_data['page_title'] = get_phrase('balance_sheet');
        $this->load->view('backend/index', $page_data);
    }

    /* Fees Details */
    function fees_details($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['fees_name']   =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['fees_amount']   =   $this->input->post('fees_amount');
            $data['fees_term']   =   $this->input->post('semester_id');
            $data['start_date']   =   $this->input->post('from_date');
            $data['end_date']   =   $this->input->post('to_date');
            $data['type']   =   $this->input->post('fees_type');
            $data['inserted_on']   =   date('Y-m-d');
            $this->db->insert('fees_details' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/fees_details');
        }
        if ($param1 == 'edit') {
            $data['fees_name']   =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['fees_amount']   =   $this->input->post('fees_amount');
            $data['fees_term']   =   $this->input->post('semester_id');
            $data['start_date']   =   $this->input->post('from_date');
            $data['end_date']   =   $this->input->post('to_date');
            $data['type']   =   $this->input->post('fees_type');
            $this->db->where('fees_id' , $param2);
            $this->db->update('fees_details' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/fees_details');
        }
        if ($param1 == 'delete') {
            $this->db->where('fees_id' , $param2);
            $this->db->delete('fees_details');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/fees_details');
        }

        $page_data['page_name']  = 'fees_details';
        $page_data['page_title'] = get_phrase('fees_details');
        $this->load->view('backend/index', $page_data);
    }


    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
            $this->db->insert('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
            
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
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
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
                ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);
        
    }

    /*** Bird Eye View ***/
    function bird_eye() {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $this->load->library('googlemaps');

    $config['center'] = '24.791492, 46.748172';
    $config['zoom'] = 'auto';
    $this->googlemaps->initialize($config);

    $marker = array();
    $query=$this->db->query("SELECT MAX(id) AS id,bus_id,driver_id,latitude,langitude FROM bus_coordinates GROUP BY bus_id");
    if($query->num_rows() > 0) {
     foreach (($query->result_array()) as $row) {
    		//		$data[] = $row;	
        $marker['position']=$row['latitude'].",".$row['langitude'];
        $marker['icon'] = 'http://al-amaanah.com/Tifly_Pro/uploads/icons/green%20bus.png';
        $this->googlemaps->add_marker($marker);
    }
    			//return $data;
    }


    		/*$marker = array();
    		$marker['position'] = '37.409, -122.1319';
    		$marker['draggable'] = TRUE;
    		$marker['animation'] = 'DROP';
    		$this->googlemaps->add_marker($marker);

    		$marker = array();
    		$marker['position'] = '37.449, -122.1419';
    		$marker['onclick'] = 'alert("You just clicked me!!")';
    		$this->googlemaps->add_marker($marker);
    		*/
    		
    		$data['map'] = $this->googlemaps->create_map();

    		$data['page_name']  = 'bird_eye_view';
            $data['page_title'] = get_phrase('bird_eye');
            //$page_data['bus_details']    = $this->db->get('bus_details')->result_array();
            $this->load->view('backend/index', $data);
        }
    	//manage bus
        function manage_bus($param1 = '', $param2 = '', $param3 = '')
        {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
            
            if ($param1 == 'create') {
                $data['name']     = $this->input->post('name');
                $data['chassis_number']           = $this->input->post('chassis_number');
                $data['plate_number']           = $this->input->post('plate_number');
                $data['fahas']           = $this->input->post('fahas');
                $data['bus_from']           = $this->input->post('bus_from');
                $data['bus_to']           = $this->input->post('bus_to');
                
                $this->db->insert('bus_details', $data);
                $bus_Id = $this->db->insert_id();
                
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?admin/manage_bus/', 'refresh');
            }
            if ($param1 == 'edit') {
             $data['name']     = $this->input->post('name');
             $data['chassis_number']           = $this->input->post('chassis_number');
             $data['plate_number']           = $this->input->post('plate_number');
             $data['fahas']           = $this->input->post('fahas');
             $data['bus_from']           = $this->input->post('bus_from');
             $data['bus_to']           = $this->input->post('bus_to');
             
             
             $this->db->where('bus_Id' , $param2);
             $this->db->update('bus_details' , $data);
             $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
             redirect(base_url() . 'index.php?admin/manage_bus', 'refresh');
         }
         if ($param1 == 'delete') {
            $this->db->where('bus_Id', $param2);
            $this->db->delete('bus_details');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/manage_bus/', 'refresh');
        }
        $page_data['page_name']  = 'manage_bus_view';
        $page_data['page_title'] = get_phrase('manage_bus');
        $page_data['bus_details']    = $this->db->get('bus_details')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    	//manage Drivers
    function manage_drivers($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['name']     = $this->input->post('name');
            $data['nationality']           = $this->input->post('nationality');
            $data['iqama_number']           = $this->input->post('iqama_number');
            $data['iqama_expiry_date']           = $this->input->post('iqama_expiry_date');
            $data['passport_number']           = $this->input->post('passport_number');
            $data['passport_expiry_date']           = $this->input->post('passport_expiry_date');
            $data['mobile']           = $this->input->post('mobile');
            $data['assigned_bus']           = $this->input->post('assigned_bus');
            
    		   //uploading file using codeigniter upload library
            $files = $_FILES['userfile'];
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/driver_image/';
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

            $this->db->insert('driver_details', $data);
            $driver_id = $this->db->insert_id();
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/manage_drivers/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']     = $this->input->post('name');
            $data['nationality']           = $this->input->post('nationality');
            $data['iqama_number']           = $this->input->post('iqama_number');
            $data['iqama_expiry_date']           = $this->input->post('iqama_expiry_date');
            $data['passport_number']           = $this->input->post('passport_number');
            $data['passport_expiry_date']           = $this->input->post('passport_expiry_date');
            $data['mobile']           = $this->input->post('mobile');
            $data['assigned_bus']           = $this->input->post('assigned_bus');
            
    		  //uploading file using codeigniter upload library
            $files = $_FILES['userfile'];
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/driver_image/';
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
            $this->db->where('driver_id' , $param2);
            $this->db->update('driver_details' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/manage_drivers', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('driver_id', $param2);
            $this->db->delete('driver_details');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/manage_drivers/', 'refresh');
        }
        $page_data['page_name']  = 'manage_drivers_view';
        $page_data['page_title'] = get_phrase('manage_drivers');
        $page_data['bus_details']    = $this->db->get('bus_details')->result_array();
        $page_data['driver_details']    = $this->db->get('driver_details')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    	//non_teaching staff
    function non_teaching_staff($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['name']     = $this->input->post('name');
            $data['mobile']           = $this->input->post('mobile');
            $data['email']           = $this->input->post('email');
            $data['iqama_number']           = $this->input->post('iqama_number');
            $data['qualification']           = $this->input->post('qualification');
            $data['experience']           = $this->input->post('experience');
            $data['basic_salary']           = $this->input->post('basic_salary');
            $data['total_salary']           = $this->input->post('total_salary');
            $data['assigned_bus']      = $this->input->post('assigned_bus');
    		  //Multiple uploads
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
    			//print_r($files);
            
            $config = array();
            $config['upload_path'] = './uploads/non_teaching_staff_doc/';	
            $config['allowed_types'] = '*';
            $Url="";
            for($i=0; $i<$cpt; $i++)
            {   
                $_FILES['images']['name']= $files['images']['name'][$i];
                $_FILES['images']['type']= $files['images']['type'][$i];
                $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['images']['error']= $files['images']['error'][$i];
                $_FILES['images']['size']= $files['images']['size'][$i];    

                $this->upload->initialize($config);
                
                if ( ! $this->upload->do_upload('images')){
                   $error = $this->upload->display_errors();
                   echo ($error); 
               }else{
                   $uploadData = $this->upload->data();
                   $uploadData['file_name'] = str_replace(" ","_",$uploadData['file_name']);
                   $uploadData['file_name'] = str_replace("&","_",$uploadData['file_name']);
                   $Url=$Url.$uploadData['file_name'].'~';
               }
           }
           $data['staff_documents']  = substr($Url, 0, -1);
           
           $this->db->insert('non_teaching_staff', $data);
           $staff_id = $this->db->insert_id();
           
           $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
           redirect(base_url() . 'index.php?admin/non_teaching_staff/', 'refresh');
       }
       if ($param1 == 'edit') {
        $data['name']     = $this->input->post('name');
        $data['mobile']           = $this->input->post('mobile');
        $data['email']           = $this->input->post('email');
        $data['iqama_number']           = $this->input->post('iqama_number');
        $data['qualification']           = $this->input->post('qualification');
        $data['experience']           = $this->input->post('experience');
        $data['basic_salary']           = $this->input->post('basic_salary');
        $data['total_salary']           = $this->input->post('total_salary');
        $data['assigned_bus']      = $this->input->post('assigned_bus');
    		  //Multiple uploads
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['images']['name']);
    			//print_r($files);
        
        $config = array();
        $config['upload_path'] = './uploads/non_teaching_staff_doc/';	
        $config['allowed_types'] = '*';
        
        $doc   = $this->db->get_where('non_teaching_staff' , array('staff_id' => $param2))->row()->staff_documents;
        if($doc=='' || $doc==null || $doc=='0'){
            $Url="";	
        }else{
            $Url=$doc.'~';
        }
        
        for($i=0; $i<$cpt; $i++)
        {   
            $_FILES['images']['name']= $files['images']['name'][$i];
            $_FILES['images']['type']= $files['images']['type'][$i];
            $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
            $_FILES['images']['error']= $files['images']['error'][$i];
            $_FILES['images']['size']= $files['images']['size'][$i];    

            $this->upload->initialize($config);
            
            if ( ! $this->upload->do_upload('images')){
               $error = $this->upload->display_errors();
               echo ($error); 
           }else{
               $uploadData = $this->upload->data();
               $uploadData['file_name'] = str_replace(" ","_",$uploadData['file_name']);
               $uploadData['file_name'] = str_replace("&","_",$uploadData['file_name']);
               $Url=$Url.$uploadData['file_name'].'~';
           }
       }
       
       if($Url!=''){
        if (strpos($Url, '~') !== false) {
           $data['staff_documents']  = substr($Url, 0, -1);
       }else{
           $data['staff_documents']  = $Url;
       }
    }

    $this->db->where('staff_id' , $param2);
    $this->db->update('non_teaching_staff' , $data);
    $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    redirect(base_url() . 'index.php?admin/non_teaching_staff', 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('staff_id', $param2);
        $this->db->delete('non_teaching_staff');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/non_teaching_staff/', 'refresh');
    }
    $page_data['page_name']  = 'non_teaching_staff';
    $page_data['page_title'] = get_phrase('non_teaching_staff');
    $page_data['non_teaching_staffs']    = $this->db->get('non_teaching_staff')->result_array();
    $this->load->view('backend/index', $page_data);
    }

        //HR Management
    function hr_management($param1='',$param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $this->crud_model->save_hr_details();
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/hr_management', 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud_model->update_hr_details();
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/hr_management', 'refresh');
        }
        if ($param1 == 'delete'){
            $this->db->where('hr_id', $param2);
            $this->db->delete('hr_details');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/hr_management/', 'refresh');
        }
        $page_data['page_name']  = 'hr_management';
        $page_data['page_title'] = get_phrase('HR_details');
        $this->load->view('backend/index', $page_data);
    }

    	//Inform to all
    function inform_to_all($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'send') {
         $this->load->library('GCM');
         $selectedBus=$this->input->post('assigned_bus');
         $message=$this->input->post('message');
         
         $ParentGCM=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Id 
            IN(SELECT parent_id FROM student WHERE assigned_bus=".$selectedBus.") AND User_Type='parent'");
         if($ParentGCM->num_rows() > 0) {
            foreach ($ParentGCM->result_array() as $row) {
               $NotifyMessage = array("Notification" => $message ,"image_url" => "");	
               $this->gcm->addRecepient($row['GCM_RegId']);
               $this->gcm->setData($NotifyMessage);
               $Type='parent';
               $this->gcm->send($Type);
           }
       }	
       
       $TeacherGCM=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Id 
        IN(SELECT teacher_id FROM teacher WHERE assigned_bus=".$selectedBus.") AND User_Type='teacher'");
       if($TeacherGCM->num_rows() > 0) {
        foreach ($TeacherGCM->result_array() as $row1) {
           $NotifyMessage = array("Notification" => $message ,"image_url" => "");	
           $this->gcm->addRecepient($row1['GCM_RegId']);
           $this->gcm->setData($NotifyMessage);
           $Type='teacher';
           $this->gcm->send($Type);
       }
    }

    $this->session->set_flashdata('flash_message' , get_phrase('message_sent_successfully'));
    redirect(base_url() . 'index.php?admin/inform_to_all/', 'refresh');
    }


    $page_data['page_name']  = 'inform_to_all';
    $page_data['page_title'] = get_phrase('inform_to_all');
    $this->load->view('backend/index', $page_data);
    }


    	//Manage ACADEMIC Year
    function academic_year($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
         
         $data['academic_year']     = $this->input->post('academic_year');
         $data['start_date']           = date("Y-m-d", strtotime($this->input->post('start_date')));
         $data['end_date']           = date("Y-m-d", strtotime($this->input->post('end_date')));
         
         
         $this->db->insert('academic_year', $data);
         $ac_id = $this->db->insert_id();
		 
		 //create / update student data in attendance
		$this -> db -> select('student_id');	 
		$this -> db -> from('student');
		$this -> db -> where('Admission_Status', 1);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
			$this->insertInAttendance($data['start_date'],$data['end_date'],$row['student_id'],$data['academic_year']);
			}
		}
		 
		 
         
         $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
         redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');
     }
     
     if ($param1 == 'delete') {
		
		$deletingYear=$this->db->get_where('academic_year', array('ac_id' => $param2))->row()->academic_year;
        $this->db->where('ac_id', $param2);
        $this->db->delete('academic_year');
		
		//delete attendance data of this year
		$this->db->where('year',$deletingYear);
		$this->db->delete('attendance');
		
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');
    }
    $page_data['page_name']  = 'academic_year';
    $page_data['page_title'] = get_phrase('manage_academic_year');
    $page_data['academic_year']    = $this->db->get('academic_year')->result_array();
    $this->load->view('backend/index', $page_data);
    }

    	//Manage Semester
    function semester($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
         
         $data['academic_year_id']   = $this->input->post('academic_year_id');
         $data['semester']			= $this->input->post('semester');
         $data['start_date']         = date("Y-m-d", strtotime($this->input->post('start_date')));
         $data['end_date']           = date("Y-m-d", strtotime($this->input->post('end_date')));
         
         
         $this->db->insert('semester', $data);
         $ac_id = $this->db->insert_id();
		 
		 $ac_year=$this->db->get_where('academic_year', array('ac_id' => $data['academic_year_id']))->row()->academic_year;
		 //create / update student data in attendance
		$this -> db -> select('student_id');	 
		$this -> db -> from('student');
		$this -> db -> where('Admission_Status', 1);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
			$this->insertInAttendance($data['start_date'],$data['end_date'],$row['student_id'],$ac_year);
			}
		}
         
         $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
         redirect(base_url() . 'index.php?admin/semester/', 'refresh');
     }
     
     if ($param1 == 'delete') {
        $this->db->where('_id', $param2);
        $this->db->delete('semester');
		
		
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'index.php?admin/semester/', 'refresh');
    }
    $page_data['page_name']  = 'semester';
    $page_data['page_title'] = get_phrase('manage_semester');
    $page_data['semester']    = $this->db->get('semester')->result_array();
    $this->load->view('backend/index', $page_data);
    }


    function vacation($param1="",$param2="",$param3=""){
     if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
     $data['title']			= $this->input->post('title');
     $data['from_date']         = date("Y-m-d", strtotime($this->input->post('from_date')));
     $data['to_date']           = date("Y-m-d", strtotime($this->input->post('to_date')));
     $data['status'] = "1";
     $data['year']   = $this->input->post('academic_year_id');
     
     $this->db->insert('vacation_additional_break', $data);
     $ac_id = $this->db->insert_id();
	 
	 //update vactions in attendance
		$att_arr = array(
			'timestamp' => strtotime(date("d-m-Y")),
			'status' => 4);
		$this->db->where('att_date>=',$data['from_date']);
		$this->db->where('att_date<=',$data['to_date']);
        $this->db->update('attendance',$att_arr);
		
     
     $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
     redirect(base_url() . 'index.php?admin/vacation/', 'refresh');
    }

    if($param1=='delete'){
      $row_id=$param2;

      $this->db->where('_id', $row_id);
      $this->db->delete('vacation_additional_break');
      $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
      redirect(base_url() . 'index.php?admin/vacation/', 'refresh');
    }

    $page_data['page_name']  = 'vacation';
    $page_data['page_title'] = get_phrase('manage_vacation');
    $page_data['vacation_additional_break']=   $this->db->get_where('vacation_additional_break' , array('status'=>1))->result_array();
             //$page_data['vacation_additional_break']    = $this->db->get('vacation_additional_break')->result_array();
    $this->load->view('backend/index', $page_data);
    }

    function additional_breaks($param1="",$param2=""){
     if ($this->session->userdata('admin_login') != 1)
       redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
     $data['title']			= $this->input->post('title');
     $data['from_date']         = date("Y-m-d", strtotime($this->input->post('from_date')));
     $data['to_date']           = date("Y-m-d", strtotime($this->input->post('to_date')));
     $data['status'] = "2";
     $data['year']   = $this->input->post('academic_year_id');
     
     $this->db->insert('vacation_additional_break', $data);
     $ac_id = $this->db->insert_id();
	 
	 //update breaks in attendance
		$att_arr = array(
			'timestamp' => strtotime(date("d-m-Y")),
			'status' => 5);
		$this->db->where('att_date>=',$data['from_date']);
		$this->db->where('att_date<=',$data['to_date']);
        $this->db->update('attendance',$att_arr);
     
     $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
     redirect(base_url() . 'index.php?admin/additional_breaks/', 'refresh');
    }
    if($param1=='delete'){
      $row_id=$param2;
      $this->db->where('_id', $row_id);
      $this->db->delete('vacation_additional_break');
      $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
      redirect(base_url() . 'index.php?admin/additional_breaks/', 'refresh');
    }
    $page_data['page_name']  = 'additional_breaks';
    $page_data['page_title'] = get_phrase('manage_additional_breaks');
    $page_data['vacation_additional_break']=   $this->db->get_where('vacation_additional_break' , array('status'=>2))->result_array();
             	//$page_data['vacation_additional_break']    = $this->db->get('vacation_additional_break')->result_array();
    $this->load->view('backend/index', $page_data);
    }

	//set time to chat
	function set_time_to_chat(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

		if($this->input->post('starting_ampm')==1)
		{
			$S_ampm="AM";
		}else{
			$S_ampm="PM";
		}
		if($this->input->post('ending_ampm')==1)
		{
			$E_ampm="AM";
		}else{
			$E_ampm="PM";
		}
        $startTime=sprintf("%02d", $this->input->post('time_start')).":".sprintf("%02d", $this->input->post('time_start_min'))." ".$S_ampm;
        $endTime=sprintf("%02d", $this->input->post('time_end')).":".sprintf("%02d", $this->input->post('time_end_min'))." ".$E_ampm;
        
		$data['description']=$startTime.",".$endTime;

        $this->db->where('type', 'chat_time');
        $this->db->update('settings', $data);
		
		$this->session->set_flashdata('flash_message' , get_phrase('chat_time_updated_successfully'));
        redirect(base_url() . 'index.php?admin/broadcasts' , 'refresh');
    }
	//select weekends
    function select_weekends(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $x=$this->input->post('par0');
        $data['description']=$x;

        $this->db->where('type', 'weekends');
        $this->db->update('settings', $data);

        redirect(base_url() . 'index.php?admin/additional_breaks' , 'refresh');
    }

    	//Notice will send only to the parents (in portal and in app)
    function notice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['Notice_Title']     = $this->input->post('Notice_Title');
            $data['Notice_Info']           = $this->input->post('Notice_Info');
            $data['Notice_Date']           = $this->input->post('Notice_Date');
            $data['Notice_AddedOn']           =  date("Y-m-d");
            
            
    			//uploading file using codeigniter upload library
            $files = $_FILES['userfile'];
            
            
            $this->load->library('upload');
            $config['upload_path']   =  'uploads/Image/';
            $config['allowed_types'] =  '*';
            $_FILES['userfile']['name']     = $files['name'];
            $_FILES['userfile']['type']     = $files['type'];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'];
            $_FILES['userfile']['size']     = $files['size'];
            $this->upload->initialize($config);
            $this->upload->do_upload('userfile');
            $upload_data = $this->upload->data();
            if ( $upload_data['file_name']!= '') {
               $data['Notice_Img']  = base_url().'uploads/Image/'.$upload_data['file_name'];
           }
           
    			//$_FILES['userfile']['name'];
           
           $this->db->insert('app_notice_tbl', $data);
           $notice_id = $this->db->insert_id();
           
    			/*if(file_exists($notice_id . '.jpg')) {
    				chmod($notice_id . '.jpg',0755); //Change the file permissions if allowed
    				unlink($notice_id . '.jpg'); //remove the file
    			}			
                if(move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/Image/' . $notice_id . '.jpg')){
    				$data_img['Notice_Img']  = base_url().'uploads/Image/'.$notice_id.'.jpg';
    				$this->db->where('Notice_Id', $notice_id);
    				$this->db->update('app_notice_tbl', $data_img);
    			}*/	
    			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?admin/notice/', 'refresh');
            }
            
            if ($param1 == 'delete') {
                $this->db->where('Notice_Id', $param2);
                $this->db->delete('app_notice_tbl');
                $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
                redirect(base_url() . 'index.php?admin/notice/', 'refresh');
            }
            $page_data['page_name']  = 'notice';
            $page_data['page_title'] = get_phrase('manage_notice');
            $page_data['notices']    = $this->db->get('app_notice_tbl')->result_array();
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
                $data['reciever']           = $this->input->post('reciever');
                $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
                $this->db->insert('noticeboard', $data);

                $check_sms_send = $this->input->post('check_sms');

                if ($check_sms_send == 1) {
                    // sms sending configurations

                    $parents  = $this->db->get('parent')->result_array();
                    $students = $this->db->get('student')->result_array();
                    $teachers = $this->db->get('teacher')->result_array();
                    $date     = $this->input->post('create_timestamp');
                    $message  = $data['notice_title'] . ' ';
                    $message .= get_phrase('on') . ' ' . $date;
                    foreach($parents as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                    foreach($students as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                    foreach($teachers as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                }

                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['notice_title']     = $this->input->post('notice_title');
                $data['notice']           = $this->input->post('notice');
                $data['reciever']           = $this->input->post('reciever');
                $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
                $this->db->where('notice_id', $param2);
                $this->db->update('noticeboard', $data);

                $check_sms_send = $this->input->post('check_sms');

                if ($check_sms_send == 1) {
                    // sms sending configurations

                    $parents  = $this->db->get('parent')->result_array();
                    $students = $this->db->get('student')->result_array();
                    $teachers = $this->db->get('teacher')->result_array();
                    $date     = $this->input->post('create_timestamp');
                    $message  = $data['notice_title'] . ' ';
                    $message .= get_phrase('on') . ' ' . $date;
                    foreach($parents as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                    foreach($students as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                    foreach($teachers as $row) {
                        $reciever_phone = $row['phone'];
                        $this->sms_model->send_sms($message , $reciever_phone);
                    }
                }

                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
                redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
            } else if ($param1 == 'edit') {
                $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                    'notice_id' => $param2
                    ))->result_array();
            }
            if ($param1 == 'delete') {
                $this->db->where('notice_id', $param2);
                $this->db->delete('noticeboard');
                $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
                redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
            }
            $page_data['page_name']  = 'noticeboard';
            $page_data['page_title'] = get_phrase('manage_noticeboard');
            $page_data['notices']    = $this->db->get('noticeboard')->result_array();
            $this->load->view('backend/index', $page_data);
        }
        
        /* private messaging */

        function message($param1 = 'message_home', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');

            if ($param1 == 'send_new') {
                $message_thread_code = $this->crud_model->send_new_private_message();
                $gcm_code = $this->crud_model->send_gcm_message();
                $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
                redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
            }

            if ($param1 == 'send_reply') {
                $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
                $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
                redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
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
				redirect(base_url() . 'index.php?admin/dashboard/', 'refresh'); 
			}
        }

        /* All Messages --- Only for Admin */
        function all_message($param1 = 'message_home', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');

         /*   if ($param1 == 'send_new') {
                $message_thread_code = $this->crud_model->send_new_private_message();
                $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
                redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
            }

            if ($param1 == 'send_reply') {
                $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
                $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
                redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
            }  */

            if ($param1 == 'message_read_all') {
                $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
                /* Should be commented to stop changing unread message count */
    			// $this->crud_model->mark_thread_messages_read($param2); 
            }

            $page_data['message_inner_page_name']   = $param1;
            $page_data['page_name']                 = 'all_message';
            $page_data['page_title']                = get_phrase('private_messaging');
            $this->load->view('backend/index', $page_data);
        }
        
        /*****SITE/SYSTEM SETTINGS*********/
        function system_settings($param1 = '', $param2 = '', $param3 = '')
        {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url() . 'index.php?login', 'refresh');
            
            if ($param1 == 'do_update') {
                
                $data['description'] = $this->input->post('system_name');
                $this->db->where('type' , 'system_name');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('system_title');
                $this->db->where('type' , 'system_title');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('address');
                $this->db->where('type' , 'address');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('phone');
                $this->db->where('type' , 'phone');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('paypal_email');
                $this->db->where('type' , 'paypal_email');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('currency');
                $this->db->where('type' , 'currency');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('system_email');
                $this->db->where('type' , 'system_email');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('system_name');
                $this->db->where('type' , 'system_name');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('language');
                $this->db->where('type' , 'language');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('text_align');
                $this->db->where('type' , 'text_align');
                $this->db->update('settings' , $data);

                $data['description'] = $this->input->post('running_year');
                $this->db->where('type' , 'running_year');
                $this->db->update('settings' , $data);
                
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
                redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
            }
            if ($param1 == 'upload_logo') {
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
                $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
                redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
            }
            if ($param1 == 'change_skin') {
                $data['description'] = $param2;
                $this->db->where('type' , 'skin_colour');
                $this->db->update('settings' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
                redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
            }
            $page_data['page_name']  = 'system_settings';
            $page_data['page_title'] = get_phrase('system_settings');
            $page_data['settings']   = $this->db->get('settings')->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function get_session_changer()
        {
            $this->load->view('backend/admin/change_session');
        }

        function change_session()
        {
            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('session_changed')); 
            redirect(base_url() . 'index.php?admin/dashboard/', 'refresh'); 
        }
        

        /****exam_schedule***/


        public function exam_schedule($param1='',$param2 = '', $param3 = '')
        {
        	if ($this->session->userdata('admin_login') != 1)
                redirect(base_url() . 'index.php?login', 'refresh');


            if ($param1 == 'delete') {
                $this->db->where('_id', $param2);
                $this->db->delete('exam_schedule');
                $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
                redirect(base_url() . 'index.php?admin/exam_schedule/', 'refresh');
            }

            if($param1 == 'insert'){
            	$semester_id=$this->input->post('semester_id');
            	$title=$this->input->post('Title');
            	$from_date=$this->input->post('From_Date');
            	$from_date = date("Y-m-d", strtotime($from_date));
            	$to_date=$this->input->post('To_Date');
            	$runningear=$this->input->post('runningear');
            	$to_date = date("Y-m-d", strtotime($to_date));
            	$added_by_id=$this->input->post('admin_id');
            	
             $InsertData = array('title'=>$title,
                 'semester_id' => $semester_id,
                 'from_date' => $from_date,
                 'to_date' => $to_date,
                 'year' => $runningear,
                 'added_by_id' => $added_by_id);
             $this->db->insert('exam_schedule', $InsertData);
             $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
             redirect(base_url() . 'index.php?admin/exam_schedule/', 'refresh');
         }


         $page_data['page_name']  = 'exam_schedule';
         $page_data['page_title'] = get_phrase('exam_schedule');
         $page_data['exam_schedule']   = $this->db->get('exam_schedule')->result_array();
         $this->load->view('backend/index', $page_data);

     }


     function exam_rooms($param1="",$param2=""){
         if ($this->session->userdata('admin_login') != 1)
          redirect(base_url() . 'index.php?login', 'refresh');

      if($param1=='delete'){
          $this->db->where('room_id', $param2);
          $this->db->delete('exam_rooms');
          $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
          redirect(base_url() . 'index.php?admin/exam_rooms/', 'refresh');
      }

      $page_data['page_name']  = 'exam_rooms';
      $page_data['page_title'] = get_phrase('exam_rooms');
    		        //$page_data['exam_rooms']   = $this->db->get('exam_rooms')->result_array();
      $this->load->view('backend/index', $page_data);
      
    }

    function  modal_room_add($param1=""){

     $page_data['page_name']  = 'modal_room_add';
     $page_data['page_title'] = get_phrase('create_room');
              			//$page_data['exam_rooms_add']   = $this->db->get('exam_rooms')->result_array();
     $this->load->view('backend/index', $page_data);
     
    }

    function  add_room_to_db(){

       $xyz=$this->input->post('hide_track');
       
       if($xyz==="2"|| $xyz===2){
        $data['room_name']=strtoupper($this->input->post('room_id'));
        $data['seat_capacity']=$this->input->post('seat_capacity');
        $data['remaining_seats']=$this->input->post('seat_capacity');
        $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $data['addded_on']=date("Y-m-d h:i:s");
        $this->db->insert('exam_rooms', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    }else{
        $this->session->set_flashdata('flash_message' , get_phrase('unable_to _add.provide_unique_room_id'));
        
    }

    redirect(base_url() . 'index.php?admin/exam_rooms/', 'refresh');

    }

    function room_name_data($room){
      $room_data=$this->db->get('exam_rooms')->result_array();
      foreach ($room_data as $row) {
         if($room === $row['room_name']){
            break;
        }
    }

    echo $row['room_name']; 
    }


    /***Exam Time Table **/

    public function exam_time_table($class_id)
    {
     if ($this->session->userdata('admin_login') != 1)
      redirect(base_url() . 'index.php?login', 'refresh');
    $page_data['page_name']  = 'exam_time_table';
    $page_data['page_title'] = get_phrase('exam_time_table');
    $page_data['class_id']  =   $class_id;
    $page_data['exam_time_table']   = $this->db->get('exam_time_table')->result_array();
    $this->load->view('backend/index', $page_data);

    }

    function exam_time_table_add($class_id){
      if ($this->session->userdata('admin_login') != 1)
          redirect(base_url(), 'refresh');
      $page_data['page_name']  = 'exam_time_table_add';
      $page_data['class_id']  =   $class_id;
      $page_data['page_title'] = get_phrase('add_exam_time_table');
      $this->load->view('backend/index', $page_data);
    }


    function exam_table_add_to_db(){

       if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $exam=$this->input->post('exam_title');
    $pieces = explode(",", $exam);
    $data['exam_title']=$pieces[0];
    $data['exam_id']=$pieces[1];
    $data['class_id']       = $this->input->post('class_id');
    if($this->input->post('section_id') != '') {
        $data['section_id'] = $this->input->post('section_id');
    }
    $data['subject_id']     = $this->input->post('subject_id');
    if($data['subject_id']==null || $data['subject_id']==""){
      $data['subject_id']="";
    }



    $x    = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
    $y   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
    $x1= $this->input->post('time_start_min');
    if($x1==null || $x1==""){
      $x1="00";
    }
    $y1= $this->input->post('time_end_min');
    if($y1==null || $y1==""){
      $y1="00";
    }

    $data['start_time']=$x.":".$x1;
    $data['end_time']=$y.":".$y1;


    $data['exam_date']       	= date("Y-m-d", strtotime($this->input->post('contract_date')));
    $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    $data['added_on']=date("Y-m-d h:i:s");
                //print_r($data);

    $this->db->insert('exam_time_table', $data);
    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    redirect(base_url() . 'index.php?admin/exam_time_table/' . $data['class_id'], 'refresh');


    }

    public function exam_time_table_delete($delete_id){
     $pieces = explode(",", $delete_id);
     $this->db->where('tt_id', $pieces[0]);
     $this->db->delete('exam_time_table');
     $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
     redirect(base_url() . 'index.php?admin/exam_time_table/'.$pieces[1], 'refresh');

    }

    function class_arrangement($param1="",$param2=""){
     if ($this->session->userdata('admin_login') != 1)
      redirect(base_url() . 'index.php?login', 'refresh');

    if($param1=='delete'){
     $pieces = explode(",", $param2);
    		        	//echo $pieces[0];
     $this->db->where('id', $pieces[0]);
     $this->db->delete('exam_class_arrangements');
     $remain_seats_count          = $this->db->get_where('exam_rooms' , array('room_id' => $pieces[1]))->row()->remaining_seats;
     $remain_seats_count=($remain_seats_count+1);
                		//echo $remain_seats_count;
     $updateData = array(
         'remaining_seats'=>$remain_seats_count
         );
     $this->db->where('room_id' , $pieces[1]);
     $this->db->update('exam_rooms' , $updateData);
     $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
     redirect(base_url() . 'index.php?admin/class_arrangement/', 'refresh');
    }


    $page_data['page_name']  = 'class_arrangement';
    $page_data['page_title'] = get_phrase('class_arrangement');
    		        //$page_data['exam_rooms']   = $this->db->get('exam_rooms')->result_array();
    $this->load->view('backend/index', $page_data);

    }

    function class_arrangement_add($param1=""){
     if ($this->session->userdata('admin_login') != 1)
      redirect(base_url() . 'index.php?login', 'refresh');
    $page_data['page_name']  = 'modal_arrangement_add';
    $page_data['page_title'] = get_phrase('exam_class_arrangement');
            			//$page_data['exam_rooms']   = $this->db->get('exam_rooms')->result_array();
    $this->load->view('backend/index', $page_data);

    }

    function get_employee_name_details($data){
        $data_new=$this->db->get('employee_details')->result_array();
        $sent_data="<option>"."select"."</option>";

        foreach ($data_new as $row) {
                $type=$row['emp_type'];
                if (strpos($type, $data) !== false) {
                        //$sent_data=$sent_data+"<option>".$row['name']."</option>";
                     echo "<option value=".$row['emp_id'].">".$row['name']."</option>";
                }
                //  if($pos===true){
                //     $sent_data=$sent_data+"<option>".$row['name']."</option>";
                // }
        }
        

    }

    function pending_from_ministry(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'view_pending_from_ministry';
        $page_data['page_title'] = get_phrase('exit_re-Entries');
        $this->load->view('backend/index', $page_data);
    }

    function approve_reject($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1=='approve'){
            
            $arr=array('status'=>2);
             $this->db->where('id', $param2);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('approved_successfully'));
                
        }else{
            $pieces = explode(",",$param2);
                $date=date("Y-m-d H:i:s");
            $arr=array('added_on'=>$date,'status'=>3,'reject_reason_hr'=>urldecode($pieces[1]));
             $this->db->where('id', $pieces[0]);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('rejected'));

            
        }
            redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
    }

    function approve_reject_by_ministry($param1="",$param2="",$param3=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1=='approve'){
            $arr=array('status'=>4);
             $this->db->where('id', $param2);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('approved_successfully'));
                
        }else{

            $pieces = explode(",",$param2);
       
            $arr=array('status'=>5,'reject_reason_ministry'=>urldecode($pieces[1]));
             $this->db->where('id', $pieces[0]);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('rejected'));
        }
            redirect(base_url() . 'index.php?admin/pending_from_ministry/' , 'refresh');
    }

    function reject_details(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'view_reject_details';
        $page_data['page_title'] = get_phrase('exit_re-Entries');
        $this->load->view('backend/index', $page_data);
    }

	function approved_details(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'vew_approved_exitreentries';
        $page_data['page_title'] = get_phrase('exit_re-Entries');
        $this->load->view('backend/index', $page_data);
    }
    function approve_reject_upload_ministry(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $files = $_FILES['userfile'];
            $approve_id=$this->input->post('approve_id3');
            
                $this->load->library('upload');
                $config['upload_path']   =  'uploads/document/';
                $config['allowed_types'] =  '*';
                $_FILES['userfile']['name']     = $files['name'];
                $_FILES['userfile']['type']     = $files['type'];
                $_FILES['userfile']['tmp_name'] = $files['tmp_name'];
                $_FILES['userfile']['size']     = $files['size'];
                $this->upload->initialize($config);
                $this->upload->do_upload('userfile');
                $upload_data = $this->upload->data();
                if ( $upload_data['file_name']!= '') {
                    $data['Notice_Img']  = base_url().'uploads/document/'.$upload_data['file_name'];
                }
                $date=date("Y-m-d H:i:s");
                
                $arr=array('status'=>4,'executed_doc'=>$upload_data['file_name'],'added_on'=>$date);
                $this->db->where('id', $approve_id);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('approved_successfully'));
            redirect(base_url() . 'index.php?admin/pending_from_ministry/' , 'refresh');
    }

    function approve_reject_upload(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $files = $_FILES['userfile'];
            $approve_id=$this->input->post('approve_id');
            
                $this->load->library('upload');
                $config['upload_path']   =  'uploads/document/';
                $config['allowed_types'] =  '*';
                $_FILES['userfile']['name']     = $files['name'];
                $_FILES['userfile']['type']     = $files['type'];
                $_FILES['userfile']['tmp_name'] = $files['tmp_name'];
                $_FILES['userfile']['size']     = $files['size'];
                $this->upload->initialize($config);
                $this->upload->do_upload('userfile');
                $upload_data = $this->upload->data();
                if ( $upload_data['file_name']!= '') {
                    $data['Notice_Img']  = base_url().'uploads/document/'.$upload_data['file_name'];
                }
                $date=date("Y-m-d H:i:s");
                $arr=array('status'=>2,'executed_doc'=>$upload_data['file_name'],'added_on'=>$date);
                $this->db->where('id', $approve_id);
                 $this->db->update('exit_re_entries', $arr);
            $this->session->set_flashdata('flash_message' , get_phrase('approved_successfully'));
            redirect(base_url() . 'index.php?admin/pending_from_hr/' , 'refresh');
    }


    function get_room_seat_capacity($name){
       if($name!=null || $name!=""){

           $seat_capacity 		=   $this->db->get_where('exam_rooms' , array('room_name'=>$name))->row()->remaining_seats;
           echo $seat_capacity;
       }
       
    }

    function get_section_class($data){
        if ($this->session->userdata('admin_login') != 1)
         redirect(base_url() . 'index.php?login', 'refresh');

     $running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
     $arr['d1']=array();
     $arr['d2']=array();
     $data_new1=$this->db->get('class')->result_array();
     foreach ($data_new1 as $row) {
        if($row['class_id']!=$data){
           $d_id=(int)$row['class_id'];
           $sql1 = "SELECT student_id,student_code,name,class_id,section_id FROM student WHERE class_id='$d_id' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE class_id='$d_id' AND year='$running_year')";
           $query1 = $this->db->query($sql1)->result_array();
           if(sizeof($query1)>0){
              array_push($arr['d1'], $row['name']);
              array_push($arr['d2'], $row['class_id']);
          }
      }
    }
    echo json_encode($arr);

    }

    function getStudents_by_Class($stu){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

          $pieces = explode(",", $stu);
          $room=$pieces[0];
          // $room=1;
          $room =  $this->db->get_where('exam_rooms' , array('room_name'=>strtolower($room)))->row()->room_id;
            
          $year=$pieces[1];
          $admin=$pieces[2];
          $exam=$pieces[3];
          $seat=$pieces[4];
          $v1=(integer)$pieces[5];
          $v2=(integer)$pieces[6];
          $v3=(integer)$pieces[7];
          $v4=(integer)$pieces[8];
          $v5=(integer)$pieces[9];
          $v6=(integer)$pieces[10];
          $v7=(integer)$pieces[11];
          $v8=(integer)$pieces[12];
          $arr_data_track;
          $arr1_counter=0; $arr2_counter=0; $arr3_counter=0; $arr4_counter=0; $arr5_counter=0; $arr6_counter=0; $arr7_counter=0; $arr8_counter=0;
          $arr1['class_id']=array();$arr1['student_id']=array();$arr1['section_id']=array();$arr1['exam_id']=array();$arr1['room_id']=array();$arr1['year']=array();$arr1['added_on']=array();
          $arr2['class_id']=array();$arr2['student_id']=array();$arr2['section_id']=array();$arr2['exam_id']=array();$arr2['room_id']=array();$arr2['year']=array();$arr2['added_on']=array();
          $counter_length=0;
          if($v1==0){}else{$counter_length++;}
          if($v2==0){}else{$counter_length++;}
          if($v3==0){}else{$counter_length++;}
          if($v4==0){}else{$counter_length++;}
          if($v5==0){}else{$counter_length++;}
          if($v6==0){}else{$counter_length++;}
          if($v7==0){}else{$counter_length++;}
          if($v8==0){}else{$counter_length++;}
          if($counter_length==1){
            $counter_length==2;
          }
          $max=($seat/$counter_length);
          $room_id_counter=0;
          $global_counter=1;


          if($v1==0){}else{
          $max_check=1;
             $sql1 = "SELECT student_id,student_code,name,class_id,section_id FROM student WHERE class_id='$v1' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query1 = $this->db->query($sql1)->result_array();
             $data=array();

             if(sizeof($query1)>0){
                        foreach ($query1 as $row) {
                        if($max_check<=$max){
                        $data['student_id']=$row['student_id'];
                         $data['class_id']=$row['class_id'];
                         $data['section_id']=$row['section_id'];
                         $data['year']=$year;
                         $data['exam_id']=$exam;
                         $data['room_id']=$room;
                         $data['added_on']=date("Y-m-d h:i:s");
                         $data['seat_number']=$global_counter;
                         $this->db->insert('exam_class_arrangements', $data);
                        $global_counter=($global_counter+$counter_length);
                        $max_check++;
                        $room_id_counter++;
                        }
                     }
             }
             
             
             

          }
          $max_check=1;
            $global_counter=2;
          if($v2==0){}else{
            
                $sql2 = "SELECT student_id,student_code,name,section_id,class_id FROM student WHERE class_id='$v2' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query2 = $this->db->query($sql2)->result_array();
             if(sizeof($query2)>0){
                            foreach ($query2 as $row) {
                        if($max_check<=$max){
                        $data2['student_id']=$row['student_id'];
                         $data2['class_id']=$row['class_id'];
                         $data2['section_id']=$row['section_id'];
                         $data2['year']=$year;
                         $data2['exam_id']=$exam;
                         $data2['room_id']=$room;
                         $data2['added_on']=date("Y-m-d h:i:s");
                         $data2['seat_number']=$global_counter;
                         $this->db->insert('exam_class_arrangements', $data2);
                        $global_counter=($global_counter+$counter_length);
                        $max_check++;
                        $room_id_counter++;
                        }
                     }
             
             }
             

              
          }
          $max_check=1;
            $global_counter=3;
          if($v3==0){}else{
                $sql3 = "SELECT student_id,student_code,name,section_id,class_id FROM student WHERE class_id='$v3' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query3 = $this->db->query($sql3)->result_array();
             if(sizeof($query3)>0){
                        foreach ($query3 as $row) {
                if($max_check<=$max){
                $data3['student_id']=$row['student_id'];
                 $data3['class_id']=$row['class_id'];
                 $data3['section_id']=$row['section_id'];
                 $data3['year']=$year;
                 $data3['exam_id']=$exam;
                 $data3['room_id']=$room;
                 $data3['added_on']=date("Y-m-d h:i:s");
                 $data3['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data3);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }

             }
          }
          $max_check=1;
            $global_counter=4;
          if($v4==0){}else{
                $sql4 = "SELECT student_id,student_code,name,section_id,class_id FROM student WHERE class_id='$v4' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query4 = $this->db->query($sql4)->result_array();
             if(sizeof($query4)>0){
                foreach ($query4 as $row) {
                if($max_check<=$max){
                $data4['student_id']=$row['student_id'];
                 $data4['class_id']=$row['class_id'];
                 $data4['section_id']=$row['section_id'];
                 $data4['year']=$year;
                 $data4['exam_id']=$exam;
                 $data4['room_id']=$room;
                 $data4['added_on']=date("Y-m-d h:i:s");
                 $data4['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data4);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }
             }
          }

          $max_check=1;
            $global_counter=5;
          if($v5==0){}else{
                $sql5 = "SELECT student_id,student_code,name,section_id,class_id FROM student WHERE class_id='$v5' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query5 = $this->db->query($sql5)->result_array();
             if(sizeof($query5)>0){
                foreach ($query5 as $row) {
                if($max_check<=$max){
                $data5['student_id']=$row['student_id'];
                 $data5['class_id']=$row['class_id'];
                 $data5['section_id']=$row['section_id'];
                 $data5['year']=$year;
                 $data5['exam_id']=$exam;
                 $data5['room_id']=$room;
                 $data5['added_on']=date("Y-m-d h:i:s");
                 $data5['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data5);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }
             }
          }

          $max_check=1;
            $global_counter=6;
          if($v6==0){}else{
                $sql6 = "SELECT student_id,student_code,name FROM student WHERE class_id='$v6' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query6 = $this->db->query($sql6)->result_array();
             if(sizeof($query6)>0){
                foreach ($query6 as $row) {
                if($max_check<=$max){
                $data6['student_id']=$row['student_id'];
                 $data6['class_id']=$row['class_id'];
                 $data6['section_id']=$row['section_id'];
                 $data6['year']=$year;
                 $data6['exam_id']=$exam;
                 $data6['room_id']=$room;
                 $data6['added_on']=date("Y-m-d h:i:s");
                 $data6['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data6);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }
             }
          }
          $max_check=1;
            $global_counter=7;
          if($v7==0){}else{
                $sql7 = "SELECT student_id,student_code,name FROM student WHERE class_id='$v7' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query7 = $this->db->query($sql7)->result_array();
             if(sizeof($query7)>0){
                 foreach ($query7 as $row) {
                if($max_check<=$max){
                $data7['student_id']=$row['student_id'];
                 $data7['class_id']=$row['class_id'];
                 $data7['section_id']=$row['section_id'];
                 $data7['year']=$year;
                 $data7['exam_id']=$exam;
                 $data7['room_id']=$room;
                 $data7['added_on']=date("Y-m-d h:i:s");
                 $data7['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data7);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }
             }
          }
          $max_check=1;
            $global_counter=8;
          if($v8==0){}else{
                $sql8 = "SELECT student_id,student_code,name FROM student WHERE class_id='$v8' AND student_id NOT IN (SELECT student_id FROM exam_class_arrangements WHERE exam_id='$exam' AND year='$year')";
             $query8 = $this->db->query($sql8)->result_array();
              if(sizeof($query8)>0){
                foreach ($query8 as $row) {
                if($max_check<=$max){
                $data8['student_id']=$row['student_id'];
                 $data8['class_id']=$row['class_id'];
                 $data8['section_id']=$row['section_id'];
                 $data8['year']=$year;
                 $data8['exam_id']=$exam;
                 $data8['room_id']=$room;
                 $data8['added_on']=date("Y-m-d h:i:s");
                 $data8['seat_number']=$global_counter;
                 $this->db->insert('exam_class_arrangements', $data8);
                $global_counter=($global_counter+$counter_length);
                $max_check++;
                $room_id_counter++;
                }
             }
              }
          }
            

          
            $remain_seats_count=($seat-$room_id_counter);
            $updateData = array(
   'remaining_seats'=>$remain_seats_count
);
            $this->db->where('room_id' , $room);
            $this->db->update('exam_rooms' , $updateData);
            
          
        echo json_encode($data);

    }



    /***** UPDATE PRODUCT *****/

    function update( $task = '', $purchase_code = '' ) {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
            // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);
        
        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
        
            // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }
        
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);
        

        
    		// Run php modifications
        require './update/' . $unzipped_file_name . '/update_script.php';
        
            // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }
        
            // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
         redirect(base_url() . 'index.php?login', 'refresh');
     
     if ($param1 == 'edit_phrase') {
         $page_data['edit_profile'] 	= $param2;	
     }
     if ($param1 == 'update_phrase') {
         $language	=	$param2;
         $total_phrase	=	$this->input->post('total_phrase');
         for($i = 1 ; $i < $total_phrase ; $i++)
         {
    				//$data[$language]	=	$this->input->post('phrase').$i;
            $this->db->where('phrase_id' , $i);
            $this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
        }
        redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
    }
    if ($param1 == 'do_update') {
     $language        = $this->input->post('language');
     $data[$language] = $this->input->post('phrase');
     $this->db->where('phrase_id', $param2);
     $this->db->update('language', $data);
     $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
     redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_phrase') {
     $data['phrase'] = $this->input->post('phrase');
     $this->db->insert('language', $data);
     $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
     redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_language') {
     $language = $this->input->post('language');
     $this->load->dbforge();
     $fields = array(
        $language => array(
           'type' => 'LONGTEXT'
           )
        );
     $this->dbforge->add_column('language', $fields);
     
     $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
     redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'delete_language') {
     $language = $param2;
     $this->load->dbforge();
     $this->dbforge->drop_column('language', $language);
     $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
     
     redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    $page_data['page_name']        = 'manage_language';
    $page_data['page_title']       = get_phrase('manage_language');
    		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
    $this->load->view('backend/index', $page_data);	
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
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
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
            $data['name']  = $this->input->post('name');
            $data['login'] = $this->input->post('email');
            
            //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_document/' . $this->session->userdata('login_user_id') . '.jpg');
			
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
			
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('employee_details', array(
                'emp_id' => $this->session->userdata('login_user_id')
                ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('emp_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                    ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        /* $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
            ))->result_array(); */
			
			$page_data['edit_data']  = $this->db->get_where('employee_details', array(
            'emp_id' => $this->session->userdata('admin_id')
            ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	//insert student data attendance table 
	public function insertInAttendance($from_date,$end_date,$student_id,$running_year){
		$counts=1;
		$data_att_arr =array();
		
		$this->db->where('year',$running_year);
		$q = $this->db->get('enroll');
		
		if ($q->num_rows() > 0){
			$class_id=$this->db->get_where('enroll' , array('student_id' => $student_id,'year'=>$running_year))->row()->class_id;
			$section_id=$this->db->get_where('enroll' , array('student_id' => $student_id,'year'=>$running_year))->row()->section_id;
			$student_name=$this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
			 
			$weekends=$this->db->get_where('settings' , array('type' => 'weekends'))->row()->description;
				 
			while (strtotime($from_date) <= strtotime($end_date))
			{
				$month = date('F', strtotime($from_date));
				$day = date('l', strtotime($from_date));
				
				$this->db->where('att_date',$from_date);
				$this->db->where('student_id',$student_id);
				$q = $this->db->get('attendance');
				if ($q->num_rows() == 0){
					
					//update vacations
					$this->db->where('from_date >=', $from_date);
					$this->db->where('to_date <=', $from_date);
					$this->db->where('status', 1);
					$vacationQuery= $this->db->get('vacation_additional_break');
					//update Breaks
					$this->db->where('from_date >=', $from_date);
					$this->db->where('to_date <=', $from_date);
					$this->db->where('status', 2);
					$breaksQuery= $this->db->get('vacation_additional_break');
					
					if($vacationQuery->num_rows() >0){
						$weekendsArr=explode(',',$weekends);
						$curDayArr=array(strtolower($day));
						if(0 < count(array_intersect($curDayArr, $weekendsArr)))
						{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_date' => $from_date,
							'att_day' => $day,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 2,
							'student_name' => $student_name);
							$counts=$counts+1;						
						}else{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_date' => $from_date,
							'att_day' => $day,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 4,
							'student_name' => $student_name);
							$counts=$counts+1;	
						}
						
					}else if($breaksQuery->num_rows() >0){
						$weekendsArr=explode(',',$weekends);
						$curDayArr=array(strtolower($day));
						if(0 < count(array_intersect($curDayArr, $weekendsArr)))
						{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_date' => $from_date,
							'att_day' => $day,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 2,
							'student_name' => $student_name);
							$counts=$counts+1;						
						}else{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_date' => $from_date,
							'att_day' => $day,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 5,
							'student_name' => $student_name);
							$counts=$counts+1;	
						}
					}else{
						$weekendsArr=explode(',',$weekends);
						$curDayArr=array(strtolower($day));
						if(0 < count(array_intersect($curDayArr, $weekendsArr)))
						{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_date' => $from_date,
							'att_day' => $day,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 2,
							'student_name' => $student_name);
							$counts=$counts+1;						
						}else{
							$data_att_arr[$counts] = array(
							'timestamp' => strtotime(date("d-m-Y")),
							'att_day' => $day,
							'att_date' => $from_date,
							'att_month' => $month,
							'year' => $running_year,
							'class_id' => $class_id,
							'section_id' => $section_id,
							'student_id' => $student_id,
							'status' => 1,
							'student_name' => $student_name);
							$counts=$counts+1;	
						}
						
					}
				}
				$from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
				
			}
			if(!empty($data_att_arr)){
				$this->db->insert_batch('attendance', $data_att_arr);
			}
		}
	}
	
	//********* cron job for Employees documents expiry notifications *********//
    function cron_job(){
		$this->check_pending_fees();
        $emp_ids = $this->db->get('employee_documents')->result_array();
        foreach ($emp_ids as $row) {
			if($row['iqama_expiry_date']!=NULL && $row['iqama_expiry_date']!=''){
				$this->check_document($row['emp_id'], $row['iqama_expiry_date'],'iqama');
			}if($row['passport_expiry_date']!=NULL && $row['passport_expiry_date']!=''){
				$this->check_document($row['emp_id'], $row['passport_expiry_date'],'passport');
			}if($row['driving_license_expiry_date']!=NULL && $row['driving_license_expiry_date']!=''){
				$this->check_document($row['emp_id'], $row['driving_license_expiry_date'],'dl');
			}
        }
    }
	
	function check_document($emp_id, $expiry, $type){
        //date_default_timezone_set('Asia/Kolkata');
        $from = date_create(date('Y-m-d'));
        $to = date_create($expiry);
        $diff = date_diff($to,$from);
        
        $data['alert_on'] = date('Y-m-d H:i:s');
        $data['alert_to'] = $emp_id;
		if($type=='iqama'){
			$data['alert_about'] = 7;
		}
		if($type=='passport'){
			$data['alert_about'] = 8;
		}
		if($type=='dl'){
			$data['alert_about'] = 9;
		}
        $data['status'] = 1;
        $data['user_type'] = 2;

        if ($diff->format('%a') == 30) {
			$data['alert_msg'] = "Your ".$type." is going to expire in 30 days, please renew it and update in employee documents";
            $this->db->insert('notify_alert', $data);
			//send push notification
			$this->send_push_notification_teacher($emp_id,$data['alert_msg']);
        }

        else if ($diff->format('%a') == 15) {
            $data['alert_msg'] = "Your ".$type." is going to expire in 15 days, please renew it and update in employee documents";
            $this->db->insert('notify_alert', $data);
			//send push notification
			$this->send_push_notification_teacher($emp_id,$data['alert_msg']);
        }

        else if (0 < $diff->format('%a') && $diff->format('%a') <= 7) {
            $data['alert_msg'] = "Your ".$type." is going to expire in ".$diff->format('%a')." days, please renew it and update in employee documents";
            $this->db->insert('notify_alert', $data);
			//send push notification
			$this->send_push_notification_teacher($emp_id,$data['alert_msg']);
        }
    }
	
	
	
	function send_push_notification_teacher($emp_id,$msg)
	{
		$this->load->library('GCM');
		$this->db->where('User_Id',$emp_id);
		$this->db->where('User_Type!=','parent');
		$query = $this->db->get('app_gcm_parents');
		if ($query->num_rows() > 0){
			
			$gcm_id=$query->row('GCM_RegId');
			if($query->row('User_Type')=='transport'){
				$res = array();
				$res['data']['title'] = "Notification";
				$res['data']['message'] = date('Y-m-d G:i:s');
				$res['data']['notification_message'] = $msg;
				$res['data']['image'] = "";
				$res['data']['type'] = "normal";
				
				$this->gcm->addRecepient($gcm_id);
				$this->gcm->setData($res);
				$Type='transport';
				$this->gcm->send($Type);
			}else{
				$message = array("Notification" => $msg,"image_url" => "");	
				$this->gcm->clearRecepients();
				$this->gcm->addRecepient($gcm_id);
				$this->gcm->setData($message);
				$Type='teacher';
				$this->gcm->send($Type);
			}
			
		}
	}
	
function check_pending_fees(){
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://md-in-13.webhostbox.net';
		$config['smtp_user'] = 'noreply@al-amaanah.com';
		$config['smtp_pass'] = 'open@123';
		$config['smtp_port'] = 465;  
		
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
					
					
				$this->db->where('student_id',$row['student_id']);
				$this->db->where('fees_term',$term_val);
				$this->db->where('year',$year);
				$q = $this->db->get('fees_pending');
				if ($q->num_rows() > 0){
					$this->db->where('student_id',$row['student_id']);
					$this->db->where('fees_term',$term_val);
					$this->db->where('year',$year);
					$this->db->update('fees_pending',$pending_data);
				}else{
					$this->db->insert('fees_pending',$pending_data);
				}
				
				
				//insert to show alert on pening fees
				$data['alert_on'] = date('Y-m-d H:i:s');
				$data['alert_to'] = $row['parent_id'];
				$data['alert_about'] = 10; // Fees pending
				$data['status'] = 1;
				$data['user_type'] = 1;
				$data['alert_msg'] = "Your child ".$row['name'].", fees is pending, please pay immediately.";
				$this->db->insert('notify_alert', $data);
				$this->send_push_notification_parent($row['parent_id'],$data['alert_msg']);
				$i++;
			}			
        }           
		// echo "<pre>";
		// print_r($stu_arr);
		// echo "</pre>";
		$count = count($stu_arr);
		$this->email->from('noreply@al-amaanah.com');
		$this->email->to('thouseef@valuetechsa.com');
		$this->email->subject('Fees Cron Mail');
		$this->email->message('Hi Thouseef, Total Count of Student Pending :'.$count);

		$this->email->send();
		/* if($this->email->send()) {
			echo 'Mail Sent';
		} else {
			echo 'NOT Sent';
			print_r($this->email->print_debugger());
		} */
	}
	
	function send_push_notification_parent($parent_id,$msg)
	{
		$this->load->library('GCM');
		//send push notification
		$this->db->where('User_Id',$parent_id);
		$this->db->where('User_Type','parent');
		$query = $this->db->get('app_gcm_parents');
		if ($query->num_rows() > 0){
			$gcm_id=$query->row('GCM_RegId');
			//$this->db->get_where('app_gcm_parents', array('User_Id' => $parent_id, 'User_Type'=>'parent'))->row()->GCM_RegId;
			$message = array("Notification" => $msg,"image_url" => "");	
			$this->gcm->clearRecepients();
			$this->gcm->addRecepient($gcm_id);
			$this->gcm->setData($message);
			$Type='parent';
			$this->gcm->send($Type);
		}
		
	}
	
	/**** get notifications sorted on date and time *********/

    function get_notifications_order_by_time($emp_id){

      $this->db->select("*");
      $this->db->from("notify_alert");
      $this->db->where('alert_to', $emp_id);
      $this->db->where('user_type', '2');
      //$this->db->where('status', 1);
      $this->db->order_by("alert_on", "desc");
      $query = $this->db->get();
    
      echo json_encode($query->result());

    }
	
	/*** get alert notifications ***/

    function get_notifications($emp_id){

        /*if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');*/
        
        $notifications = $this->db->get_where('notify_alert' , array('user_type' => '2','alert_to' => $emp_id, 'status' => '1' ))->result_array();
        $arr['notifications'] = array();
        foreach ($notifications as $row) {

            array_push($arr['notifications'], $row);

        }


        echo json_encode($arr['notifications']); 

    }

    /**** changes notifications status *********/

    public function change_notifications_status($emp_id){

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['status'] = 2;
        $this->db->where('alert_to', $emp_id);
        $this->db->where('user_type', '2');
        $this->db->update('notify_alert', $data);
    }
	
     /**** TEACHERS CONTROLLER FUNCTIONS ****/
	 
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
        $page_data['page_name']  = 'teacher_view';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }
	
	
	/****MANAGE SUBJECTS*****/
    function subject_view($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array(
            'class_id' => $param1,
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        $page_data['page_name']  = 'subject_view';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

	
	function class_routine_view_teacher($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_view_teacher';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
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
            redirect(base_url() . 'index.php?admin/homework');
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
            redirect(base_url() . 'index.php?admin/homework');
        }
        if ($param1 == 'delete') {
            $this->db->where('Homework_Id' , $param2);
            $this->db->delete('homework');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/homework');
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
            redirect(base_url() . 'index.php?admin/study_material' , 'refresh');
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
             redirect(base_url() . 'index.php?admin/study_material' , 'refresh');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php?admin/study_material');
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
            redirect(base_url() . 'index.php?admin/add_assignments', 'refresh');
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
	
	/***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard_view($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?admin/noticeboard_view/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard_view/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?admin/noticeboard_view/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard_view';
        $page_data['page_title'] = get_phrase('noticeboard');
        // $page_data['notices']    = $this->db->get('noticeboard')->result_array();
		$page_data['notices'] = $this->db->get_where('noticeboard', array('reciever' => 'teacher'))->result_array();
        $this->load->view('backend/index', $page_data);
    }

	
	
	
	/*Student Leave Managmennt*/
    /*Pending Leaves*/
     function student_pending_leaves($param1=""){
     	if ($this->session->userdata('admin_login') != 1)
        {

            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name']              = 'student_pending_leaves';
        $data['page_title']             = get_phrase('student_pending_leaves');
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

     function student_pending_leaves_view(){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id']       = $this->input->post('section_id');
        $data['page_name']              = 'student_pending_leaves_view';
        $data['page_title']             = get_phrase('pending_leaves');
        $this->load->view('backend/index', $data);

     }

     function student_pending_leaves_view_approve_reject($param1='',$param2=''){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $param1;
        $data['section_id']       = $param2;
        $data['page_name']              = 'student_pending_leaves_view';
        $data['page_title']             = get_phrase('pending_leaves');
        $this->load->view('backend/index', $data);

     }

     function student_accept_leave($param1='',$param2='',$param3=''){
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
        redirect(base_url() . 'index.php?admin/student_pending_leaves_view_approve_reject/'.$param2.'/'.$param3 , 'refresh');
     }

     function student_reject_leave($param1='',$param2='',$param3='',$param4=''){
     	
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
        redirect(base_url() . 'index.php?teacher/student_pending_leaves_view_approve_reject/'.$param2.'/'.$param3 , 'refresh');
     }

     /*Confirm Leaves*/

     function student_confirm_leaves($param1=""){
     	if ($this->session->userdata('admin_login') != 1)
        {

            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name']              = 'student_confirm_leaves';
        $data['page_title']             = get_phrase('confirmed_leaves');
        $this->load->view('backend/index', $data);
     }


     function student_confirm_leaves_view(){
     	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id']       = $this->input->post('section_id');
        $data['page_name']              = 'student_confirm_leaves_view';
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
	
	
	/*Staff Leave Apply*/

    function staff_leave_apply($param1="",$param2=""){
    	if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if($param1 == 'create'){
        	$this->crud_model->save_leave_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('leave_applied_successfuly'));
            redirect(base_url() . 'index.php?admin/staff_leave_apply' , 'refresh');	
        }
        if($param1 == 'update'){
        	$this->crud_model->resave_leave_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('leave_reapplied_successfuly'));
            redirect(base_url() . 'index.php?admin/staff_leave_apply' , 'refresh');
        }
        if($param1 == 'delete'){
        	$row_id=$param2;

        	$this->db->where('id', $row_id);
            $this->db->delete('leave_records');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
        		redirect(base_url() . 'index.php?admin/staff_leave_apply/', 'refresh');
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
        $data['page_name']              = 'staff_leave_apply';
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
            redirect(base_url() . 'index.php?admin/exit_reentry_management' , 'refresh');
        }
        if($param1 == 'update'){
        	$this->crud_model->resave_reentries_apply();
            $this->session->set_flashdata('flash_message' , get_phrase('reapplied_successfuly'));
            redirect(base_url() . 'index.php?admin/exit_reentry_management' , 'refresh');
        }
        if($param1=='delete'){
        	$row_id=$param2;
        	$this->db->where('id', $row_id);
            $this->db->delete('exit_re_entries');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
        		redirect(base_url() . 'index.php?admin/exit_reentry_management/', 'refresh');
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
	
	/* private messaging */

    function private_message($param1 = 'message_home', $param2 = '', $param3 = '') {
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
				redirect(base_url() . 'index.php?admin/private_message/message_read/' . $message_thread_code, 'refresh');
			}else if($msg_type==2){
				$class_id = $this->input->post('class_id');
				$section_id = $this->input->post('section_id');
				$this->crud_model->send_group_private_message($class_id, $section_id);
				$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
				redirect(base_url() . 'index.php?admin/private_message/private_message_home', 'refresh');
			}	
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/private_message/message_read/' . $param2, 'refresh');
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
			$page_data['page_name']                 = 'private_message';
			$page_data['page_title']                = get_phrase('private_messaging');
			$this->load->view('backend/index', $page_data);

		}else{
			$this->session->set_flashdata('flash_message' , get_phrase('chatting_time_is_between_'.$start_time.'_to_'.$end_time)); 
			redirect(base_url() . 'index.php?admin/dashboard/', 'refresh'); 
		}
    }
    
}
