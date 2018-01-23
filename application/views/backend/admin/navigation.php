<div class="sidebar-menu" style="overflow:auto;">
    <header class="logo-env" >
		<!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
				<img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">
				<i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
	
	<?php 
		// get role id from session
		$role_id=$this->session->userdata('role_id');
		$roles_ids=explode(",",$role_id);
		
		//get modules from role
		$module_arr=array();
		//$modules_list = $this->db->get_where('hr_roles' , array('id' => '2','alert_to' => $emp_id, 'status' => '1' ))->result_array();
        $this->db->select('modules');
		$this-> db -> from('hr_roles');
		$this-> db ->where_in('id', $roles_ids);
		$query = $this->db->get()->result_array();
		foreach ($query as $row) {
			if($row['modules']!=null){
				$module_arr[]= $row['modules'];
			}
		}
		
		
		
		$module_arr=explode(",",implode(",",$module_arr));
		//echo json_encode($module_arr); 
		
	?>
	<div style=""></div>    
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
		
		
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard');?></span>
            </a>
        </li>
		

		<?php if (in_array(2, $module_arr)){?>
        <!-- Admission Management -->
        <li class="<?php if ($page_name == 'pending_admission' ||
                                $page_name == 'approved_admission' || 
								$page_name == 'admit_student' ||
                                $page_name == 'student_csv_upload' ||								
                                    $page_name == 'rejected_admission')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('Admission_Management'); ?></span>
            </a>
            <ul>
			<!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'admit_student') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_csv_upload') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_csv_upload">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_student'); ?></span>
                    </a>
                </li>
             
                <li class="<?php if ($page_name == 'pending_admission') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/pending_admission">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pending'); ?></span>
                    </a>
                </li>

               
                <li class="<?php if ($page_name == 'approved_admission') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/approved_admission">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('approved'); ?></span>
                    </a>
                </li>
                
            
                <li class="<?php if ($page_name == 'rejected_admission') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/rejected_admission">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('rejected'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
		<?php }?>

		
        <!-- STUDENT -->
		<?php if (in_array(3, $module_arr)){?>
        <li class="<?php if ($page_name == 'student_information' ||
                                        $page_name == 'student_marksheet')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>
				<!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </li>
		<?php }?>

		
		<!-- Manage Modules -->
        <?php if (in_array(4, $module_arr)){?>
		<!-- STUDENT PROMOTION -->
                <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_promotion">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_promotion'); ?></span>
                    </a>
                </li>
		<?php }?>
		
		<?php if (in_array(5, $module_arr)){?>
        <!-- HR MANAGEMENT -->
        <li class="<?php
            if ($page_name == 'add_roles' ||
                $page_name == 'add_employees' ||
                $page_name == 'employee_csv_upload' ||
                
                $page_name == 'view_employees')
                        echo 'opened active';
            ?>">
            <a href="#">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('HR Management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_roles') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/add_roles">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_roles'); ?></span>
                    </a>
                </li>   
                <li class="<?php if ($page_name == 'add_employees') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/add_employees">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_employees'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'employee_csv_upload') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/employee_csv_upload">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_bulk_employees'); ?></span>
                    </a>
                </li>  
                <li class="<?php if ($page_name == 'view_employees_test') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/view_employees_test">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('view_employees'); ?></span>
                    </a>
                </li>     
            </ul>
        </li>
		<?php }?>
		
		
		<!-- HR Exit Re entries -->
		<?php if (in_array(6, $module_arr)){?>
		<li class="<?php
            if ($page_name == 'view_pending_from_hr' ||
                $page_name == 'view_pending_from_ministry' ||
                $page_name == 'vew_approved_exitreentries' ||
                $page_name == 'view_reject_details')
                        echo 'opened active';
            ?>">
            <a href="#">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('exit_re-Entries'); ?></span>
            </a>
		
			<ul class="nav nav-list">
				<li class="<?php if ($page_name == 'view_pending_from_hr')  echo 'active'; ?>">
					<a href="<?php echo base_url(); ?>index.php?admin/pending_from_hr" >
						<span><i class="entypo-dot"></i> <?php echo get_phrase('pending_from_hr'); ?></span>
					</a>
				</li>

                <li class="<?php if ($page_name == 'view_pending_from_ministry') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/pending_from_ministry">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('pending_from_ministry'); ?></span>
					</a>
				</li>

                <li class="<?php if ($page_name == 'view_reject_details') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/reject_details">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('reject_details'); ?></span>
					</a>
				</li>
				<li class="<?php if ($page_name == 'vew_approved_exitreentries') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/approved_details">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('approved_details'); ?></span>
					</a>
				</li>
			</ul>
		</li>
		<?php }?>
		
		
        <!-- Manage Modules -->
        <?php if (in_array(7, $module_arr)){?>
		<li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_modules">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('manage_modules'); ?></span>
            </a>
        </li>
		<?php }?>

        <!-- PARENTS -->
		<?php if (in_array(8, $module_arr)){?>
        <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/parent">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('parents'); ?></span>
            </a>
        </li>
		<?php }?>
		
        <!-- Manage ACADEMIC -->
        <?php if (in_array(9, $module_arr)){?>        
        <li class="<?php
            if ($page_name == 'academic_year' ||$page_name == 'semester'||
                $page_name == 'vacation'||
             $page_name == 'additional_breaks')
                        echo 'opened active';
            ?>">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('manage_academic'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'academic_year') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/academic_year">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('academic_year'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'semester') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/semester">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('semester'); ?></span>
                    </a>
                </li> 
                <li class="<?php if ($page_name == 'vacation') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/vacation">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('vacations'); ?></span>
                    </a>
                </li>
               <li class="<?php if ($page_name == 'additional_breaks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/additional_breaks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('non_working_days'); ?></span>
                    </a>
                </li>           
            </ul>
        </li>
		<?php }?>
		
		
        <!-- Notice -->
        <?php if (in_array(10, $module_arr)){?>
		<li class="<?php if ($page_name == 'notice') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/notice">
                <i class="entypo-list"></i>
                <span><?php echo get_phrase('notice'); ?></span>
            </a>
        </li>
		<?php }?>
	
        <!-- CLASS -->
		<?php if (in_array(11, $module_arr)){?>
		<li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section')
            echo 'opened active';  ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/classes">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/section">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li>
		<?php }?>

		 <!-- academic_syllabus -->
		 <?php if (in_array(12, $module_arr)){?>
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus">
                <i class="entypo-list"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
        </li>
		 <?php }?>
		 
        <!-- SUBJECT -->
		<?php if (in_array(13, $module_arr)){?>
		<li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
		<?php }?>
        <!-- CLASS ROUTINE -->
		<?php if (in_array(14, $module_arr)){?>
		<li class="<?php if ($page_name == 'class_routine_view' ||
                                $page_name == 'class_routine_add') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine_view' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
		<?php }?>
        
		<!-- Manage ATTENDANCE view -->
		<?php if (in_array(15, $module_arr)){?>
		<li class="<?php if ($page_name == 'class_attendance_manage_view' ||
                                $page_name == 'class_attendance_manage_view_with_table'||$page_name == 'bus_attndnc_view_with_table'||$page_name == 'bus_attndnc_view' ) 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('manage_attendance_view'); ?></span>
            </a>
            <ul>
                
                   <li class="<?php if ($page_name == 'class_attendance_manage') echo 'active'; ?> ">
                   <a href="<?php echo base_url(); ?>index.php?admin/class_attendance_manage">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('class_attendance'); ?></span>
                    </a>
                </li>
                 <li class="<?php if ($page_name == 'bus_attendance_manage') echo 'active'; ?> ">
                   <a href="<?php echo base_url(); ?>index.php?admin/bus_attendance_manage">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('bus_attendance'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
		<?php } ?>
        
		<!-- DAILY ATTENDANCE -->
		<?php if (in_array(16, $module_arr)){?>
		<li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view') && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_attendance/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
		<?php }?>
		
		<!-- TEACHER ACADEMIC SYLLABUS -->
		<?php if (in_array(17, $module_arr)){?>
        <li class="<?php if ($page_name == 'teacher_academics' ||
                                $page_name == 'teacher_academics_view_records') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/teacher_academics">
                <i class="entypo-doc"></i>
                <span><?php echo get_phrase('daily_syllabus'); ?></span>
            </a>
        </li>
		<?php }?>
		
        <!-- Leave Management -->
        <?php if (in_array(18, $module_arr)){?>
		<li class="<?php if ($page_name == 'pending_leaves' ||
                                $page_name == 'pending_leaves_view' ||    
                                    $page_name == 'approved_leaves' ||
                                    $page_name == 'approved_leaves_view')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('leave_management'); ?></span>
            </a>
            <ul>
             
                <li class="<?php if ($page_name == 'pending_leaves') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/pending_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pending_leaves'); ?></span>
                    </a>
                </li>

               
                <li class="<?php if ($page_name == 'approved_leaves') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/approved_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('processed_leaves'); ?></span>
                    </a>
                </li>
                
            </ul>
        </li>
		<?php }?>

		<!-- INVENTORY -->
		<?php if (in_array(19, $module_arr)){?>
        <li class="<?php if ($page_name == 'create_inventory' ||
                                $page_name == 'request_inventory' ||    
                                    $page_name == 'reorder_inventory' ||
                                    $page_name == 'ordered_inventory' ||
                                    $page_name == 'received_inventory' ||
                                    $page_name == 'inventory_type')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('inventory_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'inventory_type') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/inventory_type">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('inventory_type'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'create_inventory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/create_inventory">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_inventory'); ?></span>
                    </a>
                </li>

               
                <li class="<?php if ($page_name == 'request_inventory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/request_inventory">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('request_inventory'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'reorder_inventory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/reorder_inventory">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('reorder_inventory'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'ordered_inventory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/ordered_inventory">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('ordered_inventory'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'received_inventory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/received_inventory">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('received_inventory'); ?></span>
                    </a>
                </li>
                
            </ul>
        </li>
		<?php }?>

	<!-- ACCOUNTING -->
	
	<?php if (in_array(20, $module_arr)){?>
    <li class="<?php
        if ($page_name == 'student_invoice' ||
                $page_name == 'expense' ||
                    $page_name == 'expense_category' ||
                        $page_name == 'student_payment' ||
                            $page_name == 'fees_details' ||
                            $page_name == 'fees_pending' ||
                            $page_name == 'balance_sheet')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> ">
                   <a href="<?php echo base_url(); ?>index.php?admin/student_invoice">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_payments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'fees_details') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/fees_details">
                       <span><i class="entypo-dot"></i> <?php echo get_phrase('fees_details'); ?></span> <!-- Need to change based on value of language table --> 
                    </a>
                </li>
                <li class="<?php if ($page_name == 'fees_pending') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/fees_pending">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('fees_pending'); ?></span> 
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
                
                <!-- Balance Sheet -->
                <li class="<?php if ($page_name == 'balance_sheet') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/balance_sheet">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('balance_sheet'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
	<?php }?>

        <!-- TRANSPORT -->
		<?php if (in_array(21, $module_arr)){?>
        <li class="<?php if ($page_name == 'manage_bus_view' || $page_name == 'inform_to_all')
                            echo 'opened active has-sub';?> ">
            <a href="#">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
            <ul>
                <!-- MANAGE BUS -->
                <li class="<?php if ($page_name == 'manage_bus_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_bus">
                        <span><i class="entypo-dot"></i>
                        <?php echo get_phrase('manage_bus'); ?></span>
                    </a>
                </li>
                <!-- Inform to all -->
                <li class="<?php if ($page_name == 'inform_to_all') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/inform_to_all">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('inform_to_all'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
		<?php }?>
        
	
        <!-- MESSAGE -->
         <?php if (in_array(22, $module_arr)){?>
        <li class="<?php
        if ($page_name == 'message' || $page_name == 'broadcasts' ||
                $page_name == 'all_message')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/message">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('my_message'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'all_message') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/all_message">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('all_message'); ?></span>
                    </a>
                </li>  
				<!-- broadcasts -->
				<li class="<?php if ($page_name == 'broadcasts') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/broadcasts">
						<i class="entypo-lock"></i>
						<span><?php echo get_phrase('broadcasts'); ?></span>
					</a>
				</li>				
            </ul>
        </li>
		 <?php }?>
		 
        <!-- Exam -->
		<?php if (in_array(23, $module_arr)){?>
        <li class="<?php
			if ($page_name == 'exam_schedule' ||
                $page_name == 'exam_class_arrangement' ||
				$page_name == 'exam_rooms' ||
				$page_name == 'class_arrangement' ||
				$page_name == 'modal_arrangement_add'||
				$page_name == 'modal_room_add'||
				$page_name == 'exam_time_table_add'||
				$page_name == 'grade'||
				$page_name == 'marks_manage'||
                $page_name == 'exam_time_table'||
                $page_name == 'approve_marks')
				
				echo 'opened active';?> ">
			<a href="#">
				<i class="entypo-graduation-cap"></i>
				<span><?php echo get_phrase('exam_management'); ?></span>
			</a>
			<ul>
				<li class="<?php if ($page_name == 'exam_list') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/exam_schedule">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list'); ?></span>
					</a>
				</li>
				<li class="<?php if ($page_name == 'exam_class_arrangement'||$page_name == 'exam_rooms') echo 'active'; ?> ">
					<a href="">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_class_arrangement'); ?></span>
					</a>
					<ul class="nav nav-list">
						<li class="<?php if ($page_name == 'exam_rooms')  echo 'active'; ?>">
							<a href="<?php echo base_url(); ?>index.php?admin/exam_rooms" >
								<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_rooms'); ?></span>
							</a>
						</li>
						<li class="<?php if ($page_name == 'class_arrangement') echo 'active'; ?> ">
							<a href="<?php echo base_url(); ?>index.php?admin/class_arrangement">
								<span><i class="entypo-dot"></i> <?php echo get_phrase('class_arrangement'); ?></span>
							</a>
						</li>
					</ul>
				</li>
				<li class="<?php if ($page_name == 'exam_time_table') echo 'active'; ?> ">
					<a href="">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_time_table'); ?></span>
					</a>

					<ul>
						<?php $classes = $this->db->get('class')->result_array();
						foreach ($classes as $row):?>
							<li class="<?php if ($page_name == 'exam_time_table' && $class_id == $row['class_id'] || $page_name == 'exam_time_table_add' && $class_id == $row['class_id']) echo 'active'; ?>">
								<a href="<?php echo base_url(); ?>index.php?admin/exam_time_table/<?php echo $row['class_id']; ?>">
									<span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
					
				<li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/grade">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades'); ?></span>
					</a>
				</li>
				<li class="<?php if ($page_name == 'marks_manage' || $page_name == 'manage_marks') echo 'active'; ?> ">
					<a href="<?php echo base_url(); ?>index.php?admin/marks_manage">
						<span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
					</a>
				</li>
				<li class="<?php if ($page_name == 'approve_marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/approve_marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('approve_marks'); ?></span>
                    </a>
                </li>
			</ul>
		</li>
        <?php }?>
		
			<!-- NOTICEBOARD -->
		<?php if (in_array(24, $module_arr)){?>
       <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>
		<?php }?>
		
        <!-- TEACHER PORTAL LINKS -->
		
		<!-- TEACHER LIST -->
		
		<?php if (in_array(24, $module_arr)){?>
		
		<li class="<?php if ($page_name == 'teacher_view') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher_list'); ?></span>
				
            </a>
        </li>
		<?php }?>
		
		 <!-- SUBJECT LIST -->
		 <?php if (in_array(25, $module_arr)){?>
        <li class="<?php if ($page_name == 'subject_view') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject_list'); ?></span>
            </a>
            <ul>
			<?php $classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
				?>
                    <li class="<?php if ($page_name == 'subject_view' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/subject_view/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
			<?php endforeach; ?>
            </ul>
        </li>
		 <?php }?>
		 
		<!-- CLASS ROUTINE -->
        <?php if (in_array(26, $module_arr)){?>
		<li class="<?php if ($page_name == 'class_routine_view_teacher' ||
                                $page_name == 'class_routine_print_view') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine_view'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine_view_teacher' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view_teacher/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
		<?php }?>
		
		<!-- Homework -->
        <?php if (in_array(27, $module_arr)){?>
		<li class="<?php if ($page_name == 'homework') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/homework">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('homework'); ?></span>
            </a>
        </li>
		<?php }?>
		
		<!-- STUDY MATERIAL -->
		<?php if (in_array(28, $module_arr)){?>
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/study_material">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>
		<?php } ?>
		
		
		<!-- Assignments -->        
		<?php if (in_array(29, $module_arr)){?>
		<li class="<?php
        if ($page_name == 'add_assignments' ||
			$page_name == 'manage_assignments_view' ||
                $page_name == 'manage_assignments' )
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('assignments'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_assignments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/add_assignments">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_assignments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_assignments' || $page_name == 'manage_assignments_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_assignments">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_assignments'); ?></span>
                    </a>
                </li>                
            </ul>
        </li>
		<?php }?>
		
        <!-- NOTICEBOARD -->
		<?php if (in_array(30, $module_arr)){?>
        <li class="<?php if ($page_name == 'noticeboard_view') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard_view">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard_view'); ?></span>
            </a>
        </li>
		<?php } ?>
		
		 <!--STUDENT LEAVES-->
		 <?php if (in_array(31, $module_arr)){?>
        <li class="<?php
        if ($page_name == 'student_pending_leaves_view' ||
				$page_name == 'student_pending_leaves' ||
                $page_name == 'student_confirm_leaves_view' )
                        echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('student_leaves'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_pending_leaves_view' || $page_name == 'student_pending_leaves') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_pending_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pending_leaves'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'student_confirm_leaves_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_confirm_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('confirm_leaves'); ?></span>
                    </a>
                </li>                
            </ul>
        </li>
		 <?php }?>
		 
		<!-- Staff LEAVE  -->
        <?php if (in_array(32, $module_arr)){?>
		<li class="<?php if ($page_name == 'staff_leave_apply') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/staff_leave_apply">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('staff_leave'); ?></span>
            </a>
        </li>
		<?php }?>
		
		<!-- Exit Re-Entries Staff -->
        <?php if (in_array(33, $module_arr)){?>
		<li class="<?php if ($page_name == 'exit_reentries') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/exit_reentry_management">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('staff_exit_reentries'); ?></span>
            </a>
        </li>
		<?php }?>
		 
		 <!-- Staff_MESSAGE -->
        <?php if (in_array(34, $module_arr)){?>
		<li class="<?php if ($page_name == 'private_message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/private_message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('staff_message'); ?></span>
            </a>
        </li>
		<?php }?>
		
      		
		
		<!-- SETTINGS -->
		<?php if (in_array(35, $module_arr)){?>
       <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
               <!-- <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li> -->
                <!--<li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>-->
            </ul>
        </li>
		<?php }?>
        <!-- ACCOUNT -->
		<?php if (in_array(36, $module_arr)){?>
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>
		<?php }?>
		
		
		
    </ul>

</div>