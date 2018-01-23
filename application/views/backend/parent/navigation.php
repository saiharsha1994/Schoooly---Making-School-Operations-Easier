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

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- admit_child -->
        <li class="<?php if ($page_name == 'admit_child') echo 'active'; ?> ">
        <?php 
                $parent_id = $this->session->userdata('parent_id');

            ?>
            <a href="<?php echo base_url(); ?>index.php?parents/admit_child/<?php echo $parent_id; ?>">
              
                <span><?php echo get_phrase('admit_child'); ?></span>
            </a>
        </li>

        <!-- child_information -->

        <li class="<?php if ($page_name == 'child_information') echo 'opened active';?> ">
            <a href="#">
        
                <span><?php echo get_phrase('child_information'); ?></span>
            </a>
            <ul>
            <?php 
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'child_information') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/child_information/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>


        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>

		
		<!-- Notice -->
        <li class="<?php if ($page_name == 'notice') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/notice">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('notice'); ?></span>
            </a>
        </li>
		
		<!-- Events -->
        <li class="<?php if ($page_name == 'events') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/events">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('events'); ?></span>
            </a>
        </li>
        <!-- ACADEMIC SYLLABUS -->
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-doc"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
            <ul>
            <?php 
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/academic_syllabus/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
		
		<!-- homework -->
        <li class="<?php if ($page_name == 'homework') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('homework'); ?></span>
            </a>
            <ul>
            <?php 
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'homework') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/homework/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
		
		
		<!-- assignments -->
        <li class="<?php if ($page_name == 'assignments') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('assignments'); ?></span>
            </a>
            <ul>
            <?php 
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'assignments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/assignments/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
		

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
            <?php 
                $children_of_parent = $this->db->get_where('student' , array(
                    'parent_id' => $this->session->userdata('parent_id')
                ))->result_array();
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/class_routine/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>

        <!-- EXAMS -->
 <!--       <li class="<?php
        if ($page_name == 'marks') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam_marks'); ?></span>
            </a>
            <ul>
            <?php 
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/marks/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
-->
        <!-- PAYMENT -->
 <!--       <li class="<?php if ($page_name == 'invoice') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('payment'); ?></span>
            </a>
            <ul>
            <?php 
                foreach ($children_of_parent as $row):
            ?>
                <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?parents/invoice/<?php echo $row['student_id'];?>">
                        <span><i class="entypo-dot"></i> <?php echo $row['name'];?></span>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
-->

        <!-- LIBRARY -->
<!--        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/book">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
        </li>
-->
        <!-- TRANSPORT -->
<!--        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/transport">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
        </li>
-->
        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?parents/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>