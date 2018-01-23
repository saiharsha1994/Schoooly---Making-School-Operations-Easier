<div class="sidebar-menu">
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

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_information')
            echo 'opened active has-sub';?> ">
            <!-- STUDENT INFORMATION -->
			<li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
				<a href="#">
					<span><i class="fa fa-group"></i> <?php echo get_phrase('student_information'); ?></span>
				</a>
				<ul>
					<?php $classes = $this->db->get('class')->result_array();
						foreach ($classes as $row):
					?>
						<li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
							<a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_information/<?php echo $row['class_id']; ?>">
								<span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>



        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
<?php $classes = $this->db->get('class')->result_array();
foreach ($classes as $row):
    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
<?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine' ||
                                $page_name == 'class_routine_print_view') 
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
                    <li class="<?php if ($page_name == 'class_routine' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?teacher/class_routine/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        
		<!-- Homework -->
        <li class="<?php if ($page_name == 'homework') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/homework">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('homework'); ?></span>
            </a>
        </li>
		
		<!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>


	
	<!-- Assignments -->        
		<li class="<?php
        if ($page_name == 'add_assignments' ||
                $page_name == 'manage_assignments' )
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('assignments'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_assignments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/add_assignments">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_assignments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_assignments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/manage_assignments">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_assignments'); ?></span>
                    </a>
                </li>                
            </ul>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>


        <!--STUDENT LEAVES-->
        <li class="<?php
        if ($page_name == 'pending_leaves' ||
                $page_name == 'confirm_leaves' )
                        echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('student_leaves'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'pending_leaves') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/pending_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pending_leaves'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'confirm_leaves') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/confirm_leaves">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('confirm_leaves'); ?></span>
                    </a>
                </li>                
            </ul>
        </li>
      

        <!-- LEAVE -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/leave_managment">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('apply_leave'); ?></span>
            </a>
        </li>

        <!-- Exit Re-Entries -->
        <li class="<?php if ($page_name == 'exit_reentries') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/exit_reentry_management">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('exit_re-_entries'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>