<?php
$student_info	=	$this->db->get_where('enroll' , array(
    'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
    ))->result_array();
foreach($student_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_stu_image_url($row['student_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
		</div>
		
		<!-- <div class="col-sm-9">
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3>
                                <?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->name;?>                     
                            </h3>
					</div>
				</li>
			</ul>
		</div>-->
		
	</header>
	
    <section class="profile-info-tabs">
    
    <div class="row">
      <div class="">
            <br>
        <table class="table ">
                    <tr style="background: white;"><td><b>Personal Details</b></td><td></td></tr>

                    <tr>
                        <td><?php echo get_phrase('Student_Number');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->student_code; ?></b></td>
                    </tr>
                   
         
                    <tr>
                        <td><?php echo get_phrase('Academic_Year');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->academic_year; ?></b></td>
                    </tr>
               

                    <tr>
                        <td><?php echo get_phrase('Date_of_Admission');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Date_of_Registeration; ?></b></td>
                    </tr>
                
                
                    
          <tr>
                        <td><?php echo get_phrase('name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('birthday');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->DOB;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('place_of_birth');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->place_of_birth;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('gender');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('blood_group');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->blood_group;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('religion');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->religion;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('mother_tongue');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mother_tongue;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('phone');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('email');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('last_school_attended');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->last_school_attended;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('last_school_address');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->last_school_address;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('allergies');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->allergies;?></b></td>
                    </tr>
                    
                    <tr style="background: white;"><td><b>Parent's Details</b></td><td></td></tr>

                    <tr>
                        <td><?php echo get_phrase('parent');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name;
                                ?>
                            </b>
                        </td>
                    </tr>
          
                    <tr>
                        <td><?php echo get_phrase('parent_email');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <!-- <tr>
                        <td><?php echo get_phrase('password');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->password;
                                ?>
                            </b>
                        </td>
                    </tr> -->

                    <tr>
                        <td><?php echo get_phrase('father_name');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_nationality');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_nationality;
                                ?>
                            </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><?php echo get_phrase('father_occupation');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->profession;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_employer');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_empr_sponsor_name;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_work_address');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_work_address;
                                ?>
                            </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><?php echo get_phrase('mother_name');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_name;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_nationality');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_nationality;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_occupation');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_occupation;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_employer');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_empr_sponsor_name;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_work_address');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_work_address;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr style="background: white;"><td><b>Admission Details</b></td><td></td></tr>
                    
                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->class_name;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->section_name;
                                ?>
                            </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><?php echo get_phrase('Admission_Type');?></td>
                        <?php 
                            $Admission_Type = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Admission_Type;
                        ?>
                        <td>
                            <b>
                              <? if($Admission_Type == 1){echo "Normal";} else{echo "Special";} ?>
                            </b>
                        </td>
                    </tr>

                    <tr style="background: white;"><td><b>Contact Details</b></td><td></td></tr>

                    <tr>
                        <td><?php echo get_phrase('Father_Primary_Mobile');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Father_Primary_Mobile;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Father_Secondary_Mobile');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Father_Secondary_Mobile;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Mother_Primary_Mobile');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Mother_Primary_Mobile;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Mother_Secondary_Mobile');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Mother_Secondary_Mobile;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Emergency_Contact_Person_Name_Primary');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Name_Primary;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Emergency_Contact_Person_Name_Secondary');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Name_Secondary;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Emergency_Contact_Person_Number_Primary');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Number_Primary;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('Emergency_Contact_Person_Number_Secondary');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Number_Secondary;
                                ?>
                            </b>
                        </td>
                    </tr>
          
                    <tr>
                        <td><?php echo get_phrase('Home_Landline');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Home_Landline;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr style="background: white;"><td><b>Address Details</b></td><td></td></tr>
                    <tr>
                        <td><?php echo get_phrase('Street_Name');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Street_Name;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Area');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Area;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('pincode');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->pincode;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Landmark');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Landmark;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Latitude');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Latitude;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Longitude');?></td>
                        <td>
                            <b>
                              <?php 
                                    echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Longitude;
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr style="background: white;"><td><b>Transport Details</b></td><td></td></tr>
                   
          
          <tr>
                        <td><?php echo get_phrase('Transport_Facility');?></td>
            <?php $trans=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Transport_Facility;?>
            
                        <td><b><?php if($trans == '1'){
                  echo get_phrase('yes');
                  }else if($trans == '2'){
                    echo get_phrase('no');
                  }
                ?></b></td>
                    </tr>
          <tr>
                        <td><?php echo get_phrase('Assigned_Bus');?></td>
                        <td>
                            <b>
                                <?php 
                                    $assigned_bus = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->assigned_bus;
                                    if ($assigned_bus == 0) {
                                        echo "--";
                                    }else{
                                        echo $this->db->get_where('bus_details' , array('bus_Id' => $assigned_bus))->row()->name;
                                    }
                                ?>
                            </b>
                        </td>
                    </tr>
          <tr>
                        <td><?php echo get_phrase('Admission_Type');?></td>
            <?php $trans=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Admission_Type;?>
            
                        <td><b><?php if($trans == '1'){
                  echo get_phrase('normal');
                  }else if($trans == '2'){
                    echo get_phrase('special');
                  }
                ?></b></td>
                    </tr>
          <tr>
                        <td><?php echo get_phrase('Latest_Feedback');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Latest_Feedback;?></b></td>
                    </tr>
          
          <tr>
                        <td><?php echo get_phrase('Admission_Status');?></td>
            <?php $trans=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Admission_Status;?>
            
                        <td>
              <b>
              <?php 
              if($trans == '1'){
                echo get_phrase('Confirmed');
              }else if($trans == '2'){
                echo get_phrase('pending');
              }?>
              </b>
            </td>
                    </tr>
          
          <tr>
                        <td><?php echo get_phrase('Student_Status');?></td>
            <?php $trans=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Student_Status;?>
            
                        <td>
              <b>
              <?php 
              if($trans == '1'){
                echo get_phrase('Active');
              }else if($trans == '2'){
                echo get_phrase('Suspended');
              }else if($trans == '3'){
                echo get_phrase('On_Leave');
              }?>
              </b>
            </td>
                    </tr>
          <tr>
                        <td><?php echo get_phrase('Eligible_For_Fees_Concession');?></td>
                        <td><b><?php $cons=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Fees_Concession;
              if($cons == '1'){
                echo get_phrase('No');
              }else if($cons == '2'){
                echo get_phrase('Yes');
              }
            ?></b></td>
                    </tr>
          
          <tr>
                        <td><?php echo get_phrase('Concession_Percent');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Concession_Percent."%";?></b></td>
                    </tr>
          <!-- <table class="table table-bordered datatable">
                    <thead><tr><td><h4>Joining Records</h4></td></tr></thead>
          <thead>
                        <tr>
                            <th><?php echo get_phrase('roll');?></th>
                            <th><?php echo get_phrase('class');?></th>
                            <th><?php echo get_phrase('section');?></th>
                            <th><?php echo get_phrase('year');?></th>
                        </tr>
                    </thead>
                    <tbody>
          <?php 
            $enrolls   =   $this->db->get_where('enroll', array('student_id' => $row['student_id']))->result_array();
            foreach($enrolls as $row1):?>
                        <tr>
                            <td><?php echo $row1['roll'];?></td>
                            <td>
                                <?php 
                                    echo $this->db->get_where('class' , array('class_id' => $row1['class_id']))->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $this->db->get_where('section' , array('section_id' => $row1['section_id']))->row()->name;
                                ?>
                            </td>
              <td><?php echo $row1['year'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table> -->
        
          <?php 
            $this->db->where('student_id',$row['student_id']);
            $q = $this->db->get('student_documents');
            if ($q->num_rows() > 0) 
            {?>
            
              <tr style="background: white;"><td><b>Student Documents</b></td><td></td></tr>
              <tr>
                <td>
                  <?php echo get_phrase('child_iqama_copy');?>
                </td>
                <td>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>" alt="..."></a>
                  </div> -->

                  <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('Child_Iqama_Issue_Date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_issue_date;
                    } ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('child_iqama_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_iqama_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_iqama_expiry;
                    } ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Child_Iqama_Issue_Place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_place_of_issue == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_place_of_issue;
                    } ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('child_passport_copy');?>
                </td>
                <td>
                <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->child_passport_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('child_passport_issue_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_date;
                    } ?>
                
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('child_passport_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_expiry;
                    } ?>
                
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('child_passport_issue_place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_place == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_place;
                    } ?>
                
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Student_Medical_Insurance_Id');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance;
                    } ?>
                
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Student_Medical_Insurance_Expiry_Date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance_exp_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance_exp_date;
                    } ?>
                
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Copy_of_Vaccination_Card_for_the_student');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->vaccination_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Report_Card_Grade');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_grade == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_grade;
                    } ?>
                
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Report_Card_Copy');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->previous_progress_report;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>


              <tr>
                <td>
                  <?php echo get_phrase('First_Semester_Report_Card');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->first_sem_report_card == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->first_sem_report_card;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->first_sem_report_card;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->birth_certificate;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->birth_certificate;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->birth_certificate;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Fee_Clearance_Letter_From_Previous_School');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->fee_clearence_previous_school == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->fee_clearence_previous_school;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->fee_clearence_previous_school;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('Letter_Guardian_Company');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->letter_from_guardian_company == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->letter_from_guardian_company;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->letter_from_guardian_company;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->signed_admission_form;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('transfer_/_school_leaving_certificate');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->transfer_certificate;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('father_iqama_copy');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_iqama_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('father_iqama_issue_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_date;
                    } ?>
                  
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('father_iqama_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_expiry;
                    } ?>
                  
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('father_iqama_issue_place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_place == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_place;
                    } ?>
                  
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('father_passport_copy');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->father_passport_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('father_passport_issue_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_date;
                    } ?>
                 
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('father_passport_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_expiry;
                    } ?>
                 
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('father_passport_issue_place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_place == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_place;
                    } ?>
                 
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('mother_iqama_copy');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_iqama_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('mother_iqama_issue_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_date;
                    } ?>

                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('mother_iqama_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_expiry;
                    } ?>

                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('mother_iqama_issue_place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_place == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_place;
                    } ?>

                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('mother_passport_copy');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/student_document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <!-- <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->mother_passport_copy;?>" alt="..."></a>
                  </div> -->
                </td>
              </tr>
              
              <tr>
                <td>
                  <?php echo get_phrase('mother_passport_issue_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_date == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_date;
                    } ?>
                 
                </td>
              </tr> 

              <tr>
                <td>
                  <?php echo get_phrase('mother_passport_expiry_date');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_expiry == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_expiry;
                    } ?>
                 
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('mother_passport_issue_place');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_place == null) {
                      echo "--";
                  }else{
                    echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_place;
                    } ?>
                 
                </td>
              </tr>

              <!--<tr>
                <td>
                  <?php echo get_phrase('Introduction_(Wargah)_letter_from_the_guardians_Sponsor.');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->intro_letter == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->intro_letter;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->intro_letter;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->intro_letter;?>" alt="..."></a>
                  </div> 
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo get_phrase('student_photo');?>
                </td>
                <td>
                  <?php if ($this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->student_photo == null) {
                      echo "--";
                  } else{ ?>
                      <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->iqama_copy;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                      <?php
                    } ;?>
                  <div class="thumbnail" style="width: 100px; height: 100px;">
                    <a href="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->student_photo;?>" download="<?php echo $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->student_photo;?>"><img src="<?php echo base_url()."uploads/document/" . $this->db->get_where('student_documents' , array('student_id'=>$row['student_id']))->row()->student_photo;?>" alt="..."></a>
                  </div> 
                </td>
              </tr>-->

              <?php 
            }else{
              echo "<tr><td><h3>No Documents Available</h3></td></tr>";
            }
            ?>
        </table>
      </div>
    </div>    
  </section>  
  
  
</div>


<?php endforeach;?>
	