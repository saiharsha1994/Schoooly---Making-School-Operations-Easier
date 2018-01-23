<head>
<script> 
$(document).ready(function(){
     $('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
});
    
</script>

<style type="text/css">
   a {
    text-decoration: none !important;
}
</style>
</head>
<hr />
<div class="row">
	<div class="col-md-12">
<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#student" data-toggle="tab">
					<i class="entypo-menu"></i> 
					<?php echo get_phrase('add_student');?>
				</a>
			</li>
			<li>
				<a href="#document" data-toggle="tab">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_student_document');?>
				</a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
		<div class="tab-pane box active" id="student">
			<div class="col-md-8">
			
          <?php echo form_open(base_url() . 'index.php?admin/student1/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'form'));?>

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
          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="applicationNumber">
                </div>
          </div>
          <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Admission ID</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="admissionId">
                </div>
          </div> -->

          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Academic Year</label>
                  <div class="col-sm-5">
                  <select name="academicYear" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                    <option value=""><?php echo get_phrase('select_year');?></option>
                    <?php 
                    $years = $this->db->get('academic_year')->result_array();
                    foreach ($years as $row):
                    ?>
                      <option><?php echo $row['academic_year'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
          </div>

          <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Date of Admission</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="DOA" value="" data-start-view="2">
                </div> 
          </div>

          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="name"  value="" autofocus>
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Student Photo</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>

                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="userfile" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="DOB" value="" data-start-view="2">
                </div> 
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Place of Birth</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="birthPlace">
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Student Gender</label>
                <div class="col-sm-5">
                  <select name="sex" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="male"><?php echo "Male";?></option>
                    <option value="female"><?php echo "Female";?></option>
                  </select>
                </div> 
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Blood Group</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="bloodGroup">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Religion</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="religion">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Mother Tongue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherTongue">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Student Mobile Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentMobileNumber">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Student Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentEmail">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Last School Attended</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="LastSchoolAttended">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Last School Address</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="lastSchoolAddress">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Special Care if any</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="specialCare">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Allergies</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="allergies">
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
                <label for="field-2" class="col-sm-3 control-label">Select Parent</label>
                <div class="col-sm-5">
                  <select class="btn dropdown-toggle form-control select2" ONCHANGE="change_parent(this)" name="parent_id"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                    <option value=""><?php echo get_phrase('add new parent');?></option>
                    <?php 
                    $parents = $this->db->get('parent')->result_array();
                    foreach($parents as $row):
                      ?>
                      <option value="<?php echo $row['parent_id'];?>">
                        <?php echo $row['name'];?>
                      </option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div> 
              </div>
              <input type="hidden" class="form-control" name="childCount">
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Parent Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="parentEmail">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="password">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Nationality</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherNationality">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Occupation</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="profession"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Employer</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherEmployer"  value="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Iqama ID</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="fatherIqamaID"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="fatherIqamaCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div> -->
              <!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Father's Iqama ID</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="fatherIqamaCopy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div> -->
<!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Father's Iqama Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="fatherIqamaIssueDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Father's Iqama Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="fatherIqamaExpiryDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Iqama Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherIqamaPlaceofIssue"  value="">
                </div>
              </div> -->
              <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Passport ID</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="fatherPassportID"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="fatherPassportCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div> -->

<!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Father's Passport Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="fatherPassportIssueDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Father's Passport Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="fatherPassportExpiryDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Passport Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherPassportPlaceofIssue">
                </div>
              </div> -->
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Work Address</label>
                <div class="col-sm-5">
                  <textarea class="form-control" rows="5" name="fatherWorkAddress" id="fatherWorkAddress"></textarea>
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Nationality</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherNationality">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Occupation</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherOccupation"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Employer</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherEmployer"  value="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mothers's Iqama ID</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="motherIqamaID"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="motherIqamaCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div> -->
              
<!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Mother's Iqama Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="motherIqamaIssueDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Mother's Iqama Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="motherIqamaExpiryDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Iqama Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherIqamaPlaceofIssue"  value="">
                </div>
              </div> -->
              <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Passport ID</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="motherPassportID"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="motherPassportCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div> -->
<!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Mother's Passport Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="motherPassportIssueDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Mother's Passport Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="motherPassportExpiryDate" value="" data-start-view="2">
                </div> 
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Passport Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherPassportPlaceofIssue">
                </div>
              </div> -->
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Work Address</label>
                <div class="col-sm-5">
                  <textarea class="form-control" rows="5" name="motherWorkAddress" id="motherWorkAddress"></textarea>
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
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                
                <div class="col-sm-5">
                  <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                    data-message-required="<?php echo get_phrase('value_required');?>"
                      onchange="return get_class_sections(this.value)">
                    <option value=""><?php echo get_phrase('select');?></option>
                    <?php 
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                      ?>
                      <option value="<?php echo $row['class_id'];?>">
                          <?php echo $row['name'];?>
                      </option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div> 
                <div class="col-sm-3">
                    <button type="button" id="fee_amount" class="btn btn-default" style="display: none;">Info</button>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                  <div class="col-sm-5">
                    <select name="section_id" class="form-control select2" id="section_selector_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                      <option value=""><?php echo get_phrase('select_class_first');?></option>
                      
                    </select>
                  </div>
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Select Admission Type</label>
                <div class="col-sm-5">
                  <select name="selectAdmissionType" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="Normal"><?php echo "Normal";?></option>
                    <option value="Special"><?php echo "Special";?></option>
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
                <label for="field-1" class="col-sm-3 control-label">Father's Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherEmail">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherEmail">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Primary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherPrimaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Seconary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherSeconaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Primary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherPrimaryMobile"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Secondary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherSecondaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Home Landline</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="homeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Office Landline</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherOfficeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Office Landlin</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherOfficeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Name Primary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonNamePrimary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Mobile Primary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonMobilePrimary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Name Secondary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonNameSecondary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Mobile Secondary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonMobileSecondary">
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
                <label for="field-1" class="col-sm-3 control-label">Street Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="streetName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Area Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="areaName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Pin Code</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="pinCode">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Landmark Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landmarkName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Latitude</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="latitude"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Longitude</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="longitude">
                </div>
              </div>
      </div>
    </div>
  </div>
  <!-- <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Documents Section
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Iqama ID</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="studentIqamaID"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="studentIqamaCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
            </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Student Iqama Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_iqama_issue" value="" data-start-view="2">
                </div> 
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Student Iqama Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Iqama Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentIqamaPlaceofIssue">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Passport Number</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="studentPassportNumber"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="studentPassportCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div>
        
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Student Passport Issue Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_passport_issue" value="" data-start-view="2">
                </div> 
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Student Passport Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Passport Place of Issue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentPassportPlaceofIssue">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Medical Insurance ID</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentMedicalInsuranceID">
                </div>
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Student Medical Insurance Expiry Date</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="studentMedicalInsuranceExpiry" value="" data-start-view="2">
                </div> 
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Vaccination Certificate</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="studentVaccinationCertificate" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Report Card Grade</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="ReportCardGrade"  value="">
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div>
                      <span class="btn btn-white btn-file">
                        <input type="file" name="ReportCardCopy" accept="*/*">
                      </span>
                    </div>
                  </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">First Semester Report Card</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="firstSemesterReportCard" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Fee Clearance Letter From Previous School</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="feeClearanceLetterPreviousSchool" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Letter from Guardian's Company</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="letterGuardianCompany" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Transfer Certificate from previous School</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="transferCertificatePreviousSchool" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
      </div>
    </div>
  </div> -->
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
                <label for="field-2" class="col-sm-3 control-label">Transport Facility</label>
                <div class="col-sm-5">
                  <select name="transportFacility" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="yes"><?php echo "Yes";?></option>
                    <option value="no"><?php echo "No";?></option>
                  </select>
                </div> 
              </div>
<!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Assign Bus</label>
                <div class="col-sm-5">
                  <select name="assigned_bus" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                    <option value=""><?php echo get_phrase('select_bus');?></option>
                    <?php 
                    $buses = $this->db->get('bus_details')->result_array();
                    foreach ($buses as $row):
                    ?>
                      <option value="<?php echo $row['bus_Id'];?>"><?php echo $row['name'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div> -->
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Journey Type</label>
                <div class="col-sm-5">
                  <select name="journeyType" ONCHANGE="change_journey(this)" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="oneWay"><?php echo "One Way";?></option>
                    <option value="twoWay"><?php echo "Two Way";?></option>
                  </select>
                </div> 
              </div>
              
                <div class="form-group" id="israil" style="display: none;">
                <label for="field-2" class="col-sm-3 control-label">Trip Type</label>
                <div class="col-sm-5">
                  <select name="tripType" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="pickup"><?php echo "Pickup";?></option>
                    <option value="drop"><?php echo "Drop";?></option>
                  </select>
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Fees Type</label>
                <div class="col-sm-5">
                  <select name="feeType" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="monthly"><?php echo "Monthly";?></option>
                    <option value="term"><?php echo "Term";?></option>
                  </select>
                </div> 
              </div>
      </div>
    </div>
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
			<div class="col-md-4">
				<blockquote class="blockquote-blue">
					<p>
						<strong>Student Admission Notes</strong>
					</p>
					<p>
						Admitting new students will automatically create an enrollment to the selected class in the running session.
						Please check and recheck the informations you have inserted because once you admit new student, you won't be able
						to edit his/her class,roll,section without promoting to the next session.
					</p>
				</blockquote>
			</div>
		</div>
		
		<!--Document Form-->
    <div class="tab-pane box" id="document" style="padding: 5px">
                <div class="box-content">
          <?php echo form_open(base_url() . 'index.php?admin/student/add_document' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
              ));
          ?>   
            <div class="padded">
            
              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                                <div class="col-sm-5">
                                    <select name="student_id" class="form-control selectboxit" style="width:100%;">
                                        <option value=""><?php echo get_phrase('select_student');?></option>
                                      <?php 
                    $students = $this->db->get('student')->result_array();
                    foreach($students as $row):
                    ?>
                                        <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                    endforeach;
                    ?>
                                    </select>
                                </div>
                            </div>
                            
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_iqama_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="iqama_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_iqama_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_iqama_issue" value="" data-start-view="2">
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_iqama_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_iqama_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="child_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="child_passport_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_passport_issue" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="child_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_medical_insurance_id');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="student_medical_insurance_id" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_medical_insurance_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_medical_insurance_expiry_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Vaccination_Card_for_the_student');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="vaccination_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
			  
			  <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('vaccination_next_remainder');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="vaccination_next_remainder" value="" data-start-view="2">
                </div> 
              </div>
               
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Report_Card_Grade');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="report_card_grade" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Report_Card_Copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="previous_progress_report" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('First_Semester_Report_Card');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="first_semester_report_card" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Fee_Clearance_Letter_From_Previous_School');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="fee_clearence_previous_school" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
               
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Letter_Guardian_Company');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="letter_from_guardian_company" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>  
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transfer_/_school_leaving_certificate');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="transfer_certificate" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
               <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="father_iqama_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_iqama_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="father_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="father_passport_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_passport_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="father_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="mother_iqama_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_iqama_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_copy');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="mother_passport_copy" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_issue_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_passport_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_expiry_date');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_issue_place');?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <!-- <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birth_certificate');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="birth_certificate" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('last_3_years_original_progress_report_cards(if_applicable)');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="previous_progress_report" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Signed_&_Stamped_Admission_Form_From_Previous_School_Student_Who_studied_in_KSA(if_applicable)');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="signed_admission_form" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Introduction_(Wargah)_letter_from_the_guardians_Sponsor.');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="intro_letter" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_photo');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="student_photo" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Medical_Insurance');?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                      <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="medical_insurance" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>  -->                           
                        </div>
            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_documents');?></button>
                              </div>
               </div>
                    <?php echo form_close();?>              
                </div>                
      </div>
    </div>
  </div>
</div>



    <?php
        //print_r($parents);
        $parents = $this->db->get('parent')->result_array();
        $query = $this->db->get_where('parent', array('parent_id' => 10));
        $parent = $query->result_array();
    
        //print_r($parents);
    ?>
		

<script type="text/javascript">

var child_count;

$('#fee_amount').prop('disabled', true);

  function change_journey(that){
      //alert(that.value)
      if (that.value == "oneWay") {
        document.getElementById('israil').style.display = "block";
      }else{
        document.getElementById('israil').style.display = "none";
      }
      
  }

  function change_class(that) {
       child_count = $("input[name=childCount]").val();
       //alert(child_count)
       if (that.value != '') {
       	   class_data(that.value);
       }else{
           document.getElementById('fee_amount').style.display = "none";
       }
                
  }

  function class_data(id){ 
     var discounted_fee;
            child_count = $("input[name=childCount]").val();
            if (id.value != '') {
              $.ajax({
                url : '<?php echo base_url();?>index.php?admin/get_class_wise_fee/' + id ,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    if (child_count == 0) {
                      $('[id="fee_amount"]').text("Fee  "+data.fee_amount);   
                    document.getElementById('fee_amount').style.display = "block"; 
                    }
                    else{
                      if (child_count == 1) {
                      var discounted_fee = (90 / 100) * data.fee_amount;
                    }
                    else if (child_count == 2) {
                      discounted_fee = (80 / 100) * data.fee_amount;
                    }
                    else if (child_count >= 3) {
                      discounted_fee = (70 / 100) * data.fee_amount;
                    }
                    $('[id="fee_amount"]').text("Fee  "+data.fee_amount+"  discounted fee  "+discounted_fee);   
                    document.getElementById('fee_amount').style.display = "block"; 
                    }          
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
              });
            }else{
        document.getElementById('israil').style.display = "none";
      }

  }

  function change_parent(that) {
    child_count = 0;
            if (that.value == '') {
              
              $('#form')[0].reset();
              
            }else{
               parent_data(that.value);
            }
            
  }

  function parent_data(id){ 
     
            $.ajax({
                url : '<?php echo base_url();?>index.php?admin/get_parent/' + id ,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    //alert(data[0].parent_id);
                    //drawTable(data);
                    $('[name="parentEmail"]').val(data[0].email);
                    $('[name="password"]').val(data[0].password);
                    $('[name="fatherName"]').val(data[0].name);
                    $('[name="fatherNationality"]').val(data[0].father_nationality);
                    $('[name="profession"]').val(data[0].profession);
                    $('[name="fatherEmployer"]').val(data[0].father_empr_sponsor_name);
                    $('[name="fatherWorkAddress"]').val(data[0].father_work_address);
                    $('[name="motherName"]').val(data[0].mother_name);
                    $('[name="motherNationality"]').val(data[0].mother_nationality);
                    $('[name="motherOccupation"]').val(data[0].mother_occupation);
                    $('[name="motherEmployer"]').val(data[0].mother_empr_sponsor_name);
                    $('[name="motherWorkAddress"]').val(data[0].mother_work_address);
                    $('[name="childCount"]').val(data[0].child_count);
                    /*$('[name="childCount"]').val(data[0].father_iqama_id);
                    $('[name="fatherIqamaIssueDate"]').val(data[0].father_iqama_issue_date);
                    $('[name="fatherIqamaExpiryDate"]').val(data[0].father_iqama_expiry_date);
                    $('[name="fatherIqamaPlaceofIssue"]').val(data[0].father_iqama_issue_place);
                    $('[name="fatherPassportID"]').val(data[0].father_passport_number);
                    $('[name="fatherPassportIssueDate"]').val(data[0].father_passport_issue_date);
                    $('[name="fatherPassportExpiryDate"]').val(data[0].father_passport_expiry_date);
                    $('[name="fatherPassportPlaceofIssue"]').val(data[0].father_passport_issue_place);
                    $('[name="motherIqamaID"]').val(data[0].mother_iqama_id);
                    $('[name="motherIqamaIssueDate"]').val(data[0].mother_iqama_issue_date);
                    $('[name="motherIqamaExpiryDate"]').val(data[0].mother_iqama_expiry_date);
                    $('[name="motherIqamaPlaceofIssue"]').val(data[0].mother_iqama_issue_place);
                    $('[name="motherPassportID"]').val(data[0].mother_passport_number);
                    $('[name="motherPassportIssueDate"]').val(data[0].mother_passport_issue_date);
                    $('[name="motherPassportExpiryDate"]').val(data[0].mother_passport_expiry_date);
                    $('[name="motherPassportPlaceofIssue"]').val(data[0].mother_passport_issue_place);*/
                    
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

  }

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            async:false, 
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

      class_data(class_id);

  }


    document.getElementById('test').addEventListener('change', function () {
    var style = this.value == "oneWay" ? 'block' : 'none';
    document.getElementById('hidden_div').style.display = style;
});
</script>





