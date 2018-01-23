<?php 
$edit_data    = $this->db->get_where('enroll' , array(
  'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
))->result_array();
foreach ($edit_data as $row):
?>
<script type="text/javascript">
  $(document).ready(function(){
      $('.collapse').on('shown.bs.collapse', function(){
        $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hidden.bs.collapse', function(){
        $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
      });
</script>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-heading">
              <div class="panel-title" >
                <i class="entypo-plus-circled"></i>
          <?php echo get_phrase('edit_student');?>
              </div>
            </div>
      <div class="panel-body">
        
                <?php echo form_open(base_url() . 'index.php?parents/student/do_update/'.$row['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
          <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: white;">
          <span class="glyphicon glyphicon-minus"></span>
          Personal Section
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
          <input type="hidden" name="Admission_Status" value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Admission_Status; ?>">
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Student_Number');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="student_code" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->student_code; ?>" 
                  data-start-view="2">
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Academic_Year');?></label>
                        
            <div class="col-sm-5">
              <select name="academic_year" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select_year');?></option>
                              <?php 
                  $academic_years = $this->db->get('academic_year')->result_array();
                  $academic_year = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->academic_year;
                  foreach($academic_years as $row3):
                    ?>
                                    <option value="<?php echo $row3['academic_year'];?>"
                                          <?php if($row3['academic_year'] == $academic_year)echo 'selected';?>>
                          <?php echo $row3['academic_year'];?>
                                                </option>
                                  <?php
                  endforeach;
                  ?>
                          </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Date_of_Admission');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="Date_of_Registeration" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Date_of_Registeration; ?>" 
                  data-start-view="2">
            </div> 
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
            <div class="col-sm-5">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                  <img src="<?php echo $this->crud_model->get_stu_image_url($row['student_id']);?>" 
                  class="img-responsive" />
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-white btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="userfile" accept="Image/*">
                  </span>
                  <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('DOB');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="DOB" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->DOB; ?>" 
                  data-start-view="2">
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Place_of_Birth');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="place_of_birth" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->place_of_birth; ?>" 
                  data-start-view="2">
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
            <div class="col-sm-5">
              <select name="sex" class="form-control selectboxit">
              <?php
                $gender = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;
              ?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($gender == 'M')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($gender == 'F')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="blood_group" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->blood_group; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="religion" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->religion; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Tongue');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="mother_tongue" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mother_tongue; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="phone" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone; ?>" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="email" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last_School_Attended');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="last_school_attended" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->last_school_attended; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_school_address');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="  last_school_address" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->last_school_address; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Allergies');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="allergies" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->allergies; ?>">
            </div>
          </div>

      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Parent's Section
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
                        
            <div class="col-sm-5">
              <select name="parent_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                  $parents = $this->db->get('parent')->result_array();
                  $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                  foreach($parents as $row3):
                    ?>
                                    <option value="<?php echo $row3['parent_id'];?>"
                                          <?php if($row3['parent_id'] == $parent_id)echo 'selected';?>>
                          <?php echo $row3['name'];?>
                                                </option>
                                  <?php
                  endforeach;
                  ?>
                          </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Parent_Email');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="father_email" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Password');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="password" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->password; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Name');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Father_Name" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Nationality');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="father_nationality" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_nationality; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Occupation');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="profession" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->profession; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Employer');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="father_empr_sponsor_name" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_empr_sponsor_name; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Work_Address');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="father_work_address" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_work_address; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Name');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_name" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_name; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Nationality');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_nationality" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_nationality; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Occupation');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_occupation" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_occupation; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Employer');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_empr_sponsor_name" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_empr_sponsor_name; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Work_Address');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_work_address" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_work_address; ?>">
            </div>
          </div>
              
      </div>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Admission Section
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
      
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
            <div class="col-sm-5">
              <select name="class_id" class="form-control select2" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select_class');?></option>
                              <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row2):
                              ?>
                              <option value="<?php echo $row2['class_id'];?>"
                                <?php if($row['class_id'] == $row2['class_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
            </div> 
          </div>

          <div class="form-group" id="section_selector_holder1">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                  <div class="col-sm-5">
                    <select name="section_id" class="form-control " id="section_selector_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                      <option value="0"><?php echo get_phrase('select_section');?></option>
                      <?php
                                $sections = $this->db->get_where('section' , array('class_id' => $row['class_id']))->result_array();
                                foreach($sections as $row2):
                              ?>
                              <option value="<?php echo $row2['section_id'];?>"
                                <?php if($row['section_id'] == $row2['section_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                    </select>
                  </div>
              </div>

            <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Select_Admission_Type');?></label>
                        
            <div class="col-sm-5">
              <select name="Admission_Type" class="form-control selectboxit">
              <?php
                $Admission_Type = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Admission_Type;
              ?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="normal" <?php if($Admission_Type == '1')echo 'selected';?>><?php echo get_phrase('Normal');?></option>
                              <option value="special"<?php if($Admission_Type == '2')echo 'selected';?>><?php echo get_phrase('Special');?></option>
                          </select>
            </div> 
          </div>
      </div>
    </div>
  </div>

    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Contact Section
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_email');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="email" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_email');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_email" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_email; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Primary_Mobile');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Father_Primary_Mobile" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Father_Primary_Mobile; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Father_Secondary_Mobile');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Father_Secondary_Mobile" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Father_Secondary_Mobile; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Primary_Mobile');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Mother_Primary_Mobile" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Mother_Primary_Mobile; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Secondary_Mobile');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Mother_Secondary_Mobile" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Mother_Secondary_Mobile; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Home_Landline');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Home_Landline" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Home_Landline; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_office_landline');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="father_office_landline" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->father_office_landline; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_office_landline');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="mother_office_landline" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->mother_office_landline; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Emer_Contact_Person_Name_Primary');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Emer_Contact_Person_Name_Primary" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Name_Primary; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Emer_Contact_Person_Name_Secondary');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Emer_Contact_Person_Name_Secondary" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Name_Secondary; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Emer_Contact_Person_Number_Primary');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Emer_Contact_Person_Number_Primary" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Number_Primary; ?>">
            </div>
          </div>
          
           <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Emer_Contact_Person_Number_Secondary');?></label>
            <div class="col-sm-5">
              <?php $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id; ?>
              <input type="text" class="form-control" name="Emer_Contact_Person_Number_Secondary" 
                value="<?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->Emer_Contact_Person_Number_Secondary; ?>">
            </div>
          </div> 

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
           Address Section
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Street_Name');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="Street_Name" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Street_Name; ?>" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Area');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="Area" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Area; ?>" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('pincode');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="pincode" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->pincode; ?>" >
            </div> 
          </div>
          
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Landmark');?></label>
                        
            <div class="col-sm-5">
              <input type="text" class="form-control" name="Landmark" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Landmark; ?>" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Latitude');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="Latitude" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Latitude; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Longitude');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="Longitude" 
                value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Longitude; ?>">
            </div>
          </div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Transport Section
        </a>
      </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Transport_Facility');?></label>
                        
            <div class="col-sm-5">
              <select name="Transport_Facility" class="form-control ">
              <?php
                $trans = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->Transport_Facility;
              ?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="yes" <?php if($trans == '1')echo 'selected';?>><?php echo get_phrase('yes');?></option>
                              <option value="no"<?php if($trans == '2')echo 'selected';?>><?php echo get_phrase('no');?></option>
                          </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Journey_Type');?></label>
                        
            <div class="col-sm-5">
              <select name="Journey_Type" class="form-control ">
              <?php
                $trans = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->journey_type;
              ?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="yes" <?php if($trans == '1')echo 'selected';?>><?php echo get_phrase('One Way');?></option>
                              <option value="no"<?php if($trans == '2')echo 'selected';?>><?php echo get_phrase('Two Way');?></option>
                          </select>
            </div> 
          </div>
              
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Fees Type</label>
                <div class="col-sm-5">
                  <select name="feeType" class="form-control " data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="monthly"><?php echo "Monthly";?></option>
                    <option value="term"><?php echo "Term";?></option>
                  </select>
                </div> 
              </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Documents Section
        </a>
      </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse">
    <?php 
            $this->db->where('student_id',$row['student_id']);
            $q = $this->db->get('student_documents');
            if ($q->num_rows() > 0) 
            {?>
      <div class="panel-body">

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_Iqama_Copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="iqama_copy">
              <input type="text" class="form-control" name="iqama_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_Iqama_Issue_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="iqama_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_Iqama_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="child_iqama_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_iqama_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_Iqama_Issue_Place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="iqama_place_of_issue" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->iqama_place_of_issue; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="child_passport_copy">
              <input type="text" class="form-control" name="child_passport_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_passport_Issue_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="child_passport_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_passport_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="child_passport_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Child_passport_Issue_Place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="child_passport_issue_place" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_passport_issue_place; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Student_Medical_Insurance_Id');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="medical_insurance" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Student_Medical_Insurance_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="medical_insurance_exp_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->medical_insurance_exp_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Copy_of_Vaccination_Card_for_the_student');?></label>
            <div class="col-sm-5">
              <input type="file" name="vaccination_copy">
              <input type="text" class="form-control" name="vaccination_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->vaccination_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Report_Card_Grade');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="child_grade" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->child_grade; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Report_Card_Copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="previous_progress_report">
              <input type="text" class="form-control" name="previous_progress_report1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->previous_progress_report; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('First_Semester_Report_Card');?></label>
            <div class="col-sm-5">
              <input type="file" name="first_sem_report_card">
              <input type="text" class="form-control" name="first_sem_report_card1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->first_sem_report_card; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Fee_Clearance_Letter_From_Previous_School');?></label>
            <div class="col-sm-5">
              <input type="file" name="fee_clearence_previous_school">
              <input type="text" class="form-control" name="fee_clearence_previous_school1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->fee_clearence_previous_school; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Letter_Guardian_Company');?></label>
            <div class="col-sm-5">
              <input type="file" name="letter_from_guardian_company">
              <input type="text" class="form-control" name="letter_from_guardian_company1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->letter_from_guardian_company; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('transfer_/_school_leaving_certificate');?></label>
            <div class="col-sm-5">
              <input type="file" name="transfer_certificate">
              <input type="text" class="form-control" name="transfer_certificate1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->transfer_certificate; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="father_iqama_copy">
              <input type="text" class="form-control" name="father_iqama_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_issue_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="father_iqama_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_expiry_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="father_iqama_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_issue_place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="father_iqama_issue_place" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_iqama_issue_place; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="father_passport_copy">
              <input type="text" class="form-control" name="father_passport_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_issue_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="father_passport_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_expiry_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="father_passport_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_issue_place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="father_passport_issue_place" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_issue_place; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="mother_iqama_copy">
              <input type="text" class="form-control" name="mother_iqama_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_issue_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="mother_iqama_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_expiry_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="mother_iqama_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_issue_place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="mother_iqama_issue_place" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_iqama_issue_place; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="father_passport_copy">
              <input type="text" class="form-control" name="father_passport_copy1" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->father_passport_copy; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_issue_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="mother_passport_issue_date" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_expiry_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="mother_passport_expiry" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_expiry; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_issue_place');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="mother_passport_issue_place" 
                value="<?php echo $this->db->get_where('student_documents' , array('student_id' => $row['student_id']))->row()->mother_passport_issue_place; ?>">
            </div>
          </div>

    
    </div>
     <?php 
            }else{
              echo "<tr><td><h3>No Documents Available</h3></td></tr>";
            }
            ?>
  </div>
  
  <div class="panel-body">
          <div class="form-group">
                <div class="col-sm-offset-5 col-sm-3">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
          </div>
      </div>
</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

<script type="text/javascript">
  function get_class_sections(class_id) {
       
      //alert(class_id)

      $.ajax({
            url: '<?php echo base_url();?>index.php?parents/get_class_section/' + class_id ,
            async:false, 
            success: function(response)
            {
                //alert(response)
                //var index = $('#section_selector_holder').get(0).selectedIndex;
                //alert(index)
                //$('#section_selector_holder option:eq(' + index + ')').remove();
               //$('#section_selector_holder option:selected').remove();
                
                jQuery('#section_selector_holder').html('<option>Select Section<option>' + response);
            }
        });

  }
</script>

