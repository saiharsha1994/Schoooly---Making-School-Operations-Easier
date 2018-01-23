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
       <a href="#employee" data-toggle="tab">
         <i class="entypo-plus-circled"></i> 
         <?php echo get_phrase('add_employee_details');?>
       </a>
     </li>
     <li>
      <a href="#document" data-toggle="tab">
       <i class="entypo-plus-circled"></i>
       <?php echo get_phrase('add_employee_documents');?>
     </a>
   </li>
 </ul>
 <!------CONTROL TABS END------>
 <div class="tab-content">
  <div class="tab-pane box active" id="employee">
   <div class="col-md-8">

    <?php echo form_open(base_url() . 'index.php?admin/insert_employees', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'form'));?>
    <div class="form-group" style="margin-top: 15px;">
      <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('contract_type');?></label>
      <div class="col-sm-5">
        <select name="contract_type" id="contract_type" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
          <option value=""><?php echo get_phrase('select_type');?></option>
          <option value="1"><?php echo get_phrase('on_school_iqama');?></option>
          <option value="2"><?php echo get_phrase('on_spouse_iqama');?></option>

        </select>
      </div>
    </div>

    <div class="form-group" >
      <label for="field-1" class="col-sm-3 control-label">Select Roles</label>
      <?php $roles=$this->db->get("hr_roles")->result_array(); ?>
      <div class="col-sm-5">
        <?php foreach ($roles as $row) { 
          $name = $row['role'];?>
          <input type="checkbox" style="margin-top: 5px;" class='roles' name="roles[]" value='<?php echo get_phrase($row['id'])?>' />
          <label style="margin-left: 8px;"><?php echo get_phrase(strtolower($name))?></label><br/>
          <?php } ?>
        </div>
        <!-- <?php $roles = 'tesing'; ?> --> 

      </div>

      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: white;">
                <span class="glyphicon glyphicon-minus"></span>
                Personal Details
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_ID_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="iqama_ID_number" id="iqama_ID_number">
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('employee_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="employee_name" id="employee_name">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('employee_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="employee_number" id="employee_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="date_of_birth" id="date_of_birth" data-format="dd-mm-yyyy" value="" data-format="dd-mm-yyyy" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('place_of_birth')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="place_of_birth" id="place_of_birth">
                </div>
              </div>

              <div class="form-group"> 
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender')?></label>
                <div class="col-sm-5">
                  <select name="gender" id="gender" class="form-control" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Select Gender";?></option>
                    <option value="M"><?php echo "Male";?></option>
                    <option value="F"><?php echo "Female";?></option>
                  </select>
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('nationality')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nationality" id="nationality">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_tongue')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_tongue" id="mother_tongue">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('language_known')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="language_known" id="language_known">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('marital_status')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="marital_status" id="marital_status">
                </div>
              </div>


              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('family_status')?></label>
                <div class="col-sm-5">
                  <select name="family_status" id="family_status" class="form-control" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Select Family Status";?></option>
                    <option value="1"><?php echo "Yes";?></option>
                    <option value="2"><?php echo "No";?></option>
                  </select>
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('blood_group')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="blood_group" id="blood_group">
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
                Contact Details
              </a>
            </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email_ID')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="email_ID" id="email_ID">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mobile_number" id="mobile_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landline_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landline_number" id="landline_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_mobile_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="alternate_mobile_number" id="alternate_mobile_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('emergency_contact_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Spouse's Mobile Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="spouse_mobile_number" id="spouse_mobile_number">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('local_address')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="local_address" id="local_address">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('street_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="street_name" id="street_name">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('area_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="area_name" id="area_name">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('pin_code')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="pin_code" id="pin_code">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landmark_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landmark_name" id="landmark_name">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('latitude')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="latitude" id="latitude">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('longitude')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="longitude" id="longitude">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('home_country_address')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="home_country_address" id="home_country_address">
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
                Qualification
              </a>
            </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">

             <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('education')?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="education" id="education">
              </div>
            </div>

            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('work_experience')?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="work_experience" id="work_experience">
              </div>
            </div>

            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('previous_salary')?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="previous_salary" id="previous_salary">
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
              Bank Account Details
            </a>
          </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
          <div class="panel-body">

           <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_bank')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="name_of_bank" id="name_of_bank">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('account_holder_name')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="account_holder_name" id="account_holder_name">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('account_number')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="account_number" id="account_number">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('IFSC_code')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="IFSC_code" id="IFSC_code">
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
            Transport Facilities
          </a>
        </h4>
      </div>
      <div id="collapseSeven" class="panel-collapse collapse">
        <div class="panel-body">

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Require Transport</label>
            <div class="col-sm-5">
              <select name="require_transport" id="require_transport" class="form-control" data-validate="required" data-message-required="<?php echo "value_required";?>">
                <option value=""><?php echo "Select";?></option>
                <option value="1"><?php echo "Yes";?></option>
                <option value="2"><?php echo "No";?></option>
              </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Journey Type</label>
            <div class="col-sm-5">
              <select name="journey_type" id="journey_type" class="form-control" >
                <option value="0"><?php echo "Select";?></option>
                <option value="1"><?php echo "One Way";?></option>
                <option value="2"><?php echo "Two Way";?></option>
              </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Trip</label>
            <div class="col-sm-5">
              <select name="trip" id="trip" class="form-control" >
                <option value="0"><?php echo "Select";?></option>
                <option value="1"><?php echo "Pickup";?></option>
                <option value="2"><?php echo "Drop";?></option>
                <option value="3"><?php echo "Both";?></option>
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
            Login Account Details
          </a>
        </h4>
      </div>
      <div id="collapseEight" class="panel-collapse collapse">
        <div class="panel-body">

         <div class="form-group">
          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email_ID_/_iqama_ID')?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="login" id="login">
          </div>
        </div>

        <div class="form-group">
          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password')?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="password" id="password">
          </div>
		  
        </div>
	
      </div>
    </div>
  </div>

  <div class="panel-body">
    <div class="form-group">
      <div class="col-sm-offset-5 col-sm-3">
        <div type="submit" class="btn btn-info" onclick="CheckForm()"><?php echo get_phrase('submit');?></div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>   

</div>
<div class="col-md-4">
  <blockquote class="blockquote-blue">
   <p>
    <strong>Notes</strong>
  </p>
  <p>
    Please check the information thoroughly before submitting the form. Some fields are mandatory without which form submission will not be allowed.
  </p>
</blockquote>
</div>
</div>

<!--Document Form-->
<div class="tab-pane box" id="document" style="padding: 5px">
  <div class="box-content">
    <?php echo form_open(base_url() . 'index.php?admin/insert_employees_documents' , array(
      'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
      ));
      ?>   
      <div class="padded">

        <div class="form-group" style="margin-top: 20px;">
          <label class="col-sm-3 control-label"><?php echo get_phrase('select_employee');?></label>
          <div class="col-sm-5">
            <select name="employee_id" class="form-control select2" style="width:100%;">
              <option value=""><?php echo get_phrase('select_employee');?></option>
              <?php 
              $employees = $this->db->get('employee_details')->result_array();
              foreach($employees as $row):
                ?>
              <option value="<?php echo $row['emp_id'];?>"><?php echo $row['name'];?></option>
              <?php
              endforeach;
              ?>
            </select>
          </div>
        </div>


        <!-- Iqama Upload -->
        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('iqama_ID');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="iqama_ID" value="" data-start-view="2">
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_iqama_copy');?></label>

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
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('iqama_issue_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="iqama_issue" value="" data-format="dd-mm-yyyy" data-start-view="2">
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('iqama_expiry_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="iqama_expiry" value=""  data-format="dd-mm-yyyy" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('iqama_place_of_issue');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="iqama_issue_place" value="" data-start-view="2">
          </div> 
        </div>



        <!-- Passport Upload -->
        <hr/>
        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('passport_number');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="passport_number" value="" data-start-view="2">
          </div>
        </div>


        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_passport_copy');?></label>

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
                  <input type="file" name="passport_copy" accept="*/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('passport_issue_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="passport_issue" value="" data-format="dd-mm-yyyy" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('passport_expiry_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="passport_expiry" value="" data-format="dd-mm-yyyy" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('passport_place_of_issue');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="passport_issue_place" value="" data-start-view="2">
          </div> 
        </div>


		<!-- Driving License Upload -->
		<hr/>
        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_number');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="dl_number" value="" data-start-view="2">
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_driving_license');?></label>

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
                  <input type="file" name="dl_copy" accept="*/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_issue_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="dl_issue" value="" data-format="dd-mm-yyyy" data-start-view="2">
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_expiry_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="dl_expiry" value=""  data-format="dd-mm-yyyy" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_place_of_issue');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="dl_issue_place" value="" data-start-view="2">
          </div> 
        </div>



        <!-- Medical Insurance Upload -->
        <hr/>
        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('medical_insurance_id');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="medical_insurance_id" value="" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_insurance_copy');?></label>

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
                  <input type="file" name="insurance_copy" accept="*/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('medical_insurance_expiry_date');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control datepicker" name="medical_insurance_expiry_date" value="" data-format="dd-mm-yyyy" data-start-view="2">
          </div> 
        </div>





        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_medical_report');?></label>

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
                  <input type="file" name="medical_report" accept="*/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>


        <!-- NOC Letter -->
        <hr/>
        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('NOC_letter_number');?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="noc_letter_number" value="" data-start-view="2">
          </div> 
        </div>

        <div class="form-group">
          <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_NOC_letter');?></label>

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
                  <input type="file" name="noc_letter" accept="*/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>



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

  window.onload=function(){
   ins=document.getElementsByName('roles[]');
 }

 function CheckForm(){




  var checked=0;
  var elements = document.getElementsByName("roles[]");
  var c='';
  var arr = new Array();
  var i;
  for(i=0; i < elements.length; i++){
    if(elements[i].checked) {
      checked = checked+1;
      arr.push(elements[i].value);
      
    }
  }
  c= arr.join();

  var iqama_ID_number= document.getElementById('iqama_ID_number').value;
  var contract_type= document.getElementById('contract_type').value;
  var employee_name= document.getElementById('employee_name').value;
  var employee_number= document.getElementById('employee_number').value;
  var date_of_birth= document.getElementById('date_of_birth').value;
  var place_of_birth= document.getElementById('place_of_birth').value;
  var gender= document.getElementById('gender').value;
  var nationality= document.getElementById('nationality').value;
  var mother_tongue= document.getElementById('mother_tongue').value;
  var language_known= document.getElementById('language_known').value;
  var marital_status= document.getElementById('marital_status').value;
  var family_status= document.getElementById('family_status').value;
  var blood_group= document.getElementById('blood_group').value;
  var email_ID= document.getElementById('email_ID').value;
  var mobile_number= document.getElementById('mobile_number').value;
  var login= document.getElementById('login').value;
  var password= document.getElementById('password').value;
  var landline_number= document.getElementById('landline_number').value;
  var alternate_mobile_number= document.getElementById('alternate_mobile_number').value;
  var emergency_contact_number= document.getElementById('emergency_contact_number').value;
  var spouse_mobile_number= document.getElementById('spouse_mobile_number').value;
  var local_address= document.getElementById('local_address').value;
  var street_name= document.getElementById('street_name').value;
  var area_name= document.getElementById('area_name').value;
  var pin_code= document.getElementById('pin_code').value;
  var landmark_name= document.getElementById('landmark_name').value;
  var latitude= document.getElementById('latitude').value;
  var longitude= document.getElementById('longitude').value;
  var home_country_address= document.getElementById('home_country_address').value;
  var education= document.getElementById('education').value;
  var work_experience= document.getElementById('work_experience').value;
  var previous_salary= document.getElementById('previous_salary').value;
  var name_of_bank= document.getElementById('name_of_bank').value;
  var account_holder_name= document.getElementById('account_holder_name').value;
  var account_number= document.getElementById('account_number').value;
  var IFSC_code= document.getElementById('IFSC_code').value;
  var require_transport= document.getElementById('require_transport').value;
  var journey_type= document.getElementById('journey_type').value;
  var trip= document.getElementById('trip').value;

  if (checked<1) {
    alert('Please select atleast one role');
    return;
  }
   else if(contract_type=='')
  {
    alert("Please Select Contract Type");
    return;
  }
  else if(iqama_ID_number=='')
  {
    alert("Please Enter Iqama ID Number");
    return;
  }
  else if(employee_name=='')
  {
    alert("Please Enter Employee Name");
    return;
  }
  else if(employee_number=='')
  {
    alert("Please Enter Employee Number");
    return;
  }
  else if(date_of_birth=='')
  {
    alert("Please Enter Date of Birth");
    return;
  }
  else if(place_of_birth=='')
  {
    alert("Please Enter Place of Birth");
    return;
  }
  else if(gender=='')
  {
    alert("Please Select Gender");
    return;
  }
  else if(nationality=='')
  {
    alert("Please Enter Nationality");
    return;
  }
  else if(family_status=='')
  {
    alert("Please Select Family Status");
    return;
  }
  else if(email_ID=='')
  {
    alert("Please Enter Email ID");
    return;
  }
  else if(mobile_number==''){
    alert("Please Enter Mobile Number");
    return;
  }else if(login==''){
	  alert('Please Enter Login Username');
	  return;
  }else if(password==''){
	  alert('Please Enter password');
	  return;
  } else if(!password.match(/[A-Z]/) || !password.match(/[a-z]/) || !password.match(/[0-9]/) || password.length < 8) {
	//alert("Password should have the following,\nMust be minimum  length of 8\nMust contain at least 1 number\nMust contain at least one uppercase character\nMust contain at least one lowercase character\n");
	
	if(!password.match(/[A-Z]/)){
		alert("Must contain at least one uppercase");
		return;
	}else if(!password.match(/[a-z]/)){
		alert("Must contain at least one lowercase");	
		return;
	}else if(!password.match(/[0-9]/)){
		alert("Must contain at least one number");	
		return;
	}else if(!password.length<8){
		alert("Must be minimum length of 8");	
		return;
	}
	
  }
  else{
    $.ajax({
      url: '<?php echo base_url();?>index.php?admin/insert_employees',
      type:"POST",
      data:{
        par0:'Employee Added',
        iqama_number:iqama_ID_number,
        contract_type:contract_type,
        name:employee_name,
        emp_number:employee_number,
        dob:date_of_birth,
        place_of_birth:place_of_birth,
        gender:gender,
        nationality:nationality,
        emp_type:c,
        mother_tongue:mother_tongue,
        language_known:language_known,
        marital_status:marital_status,
        family_status:family_status,
        blood_group:blood_group,
        email:email_ID,
        mobile:mobile_number,
        login:login,
        password:password,
        landline:landline_number,
        alternate_mobile:alternate_mobile_number,
        emergency_contact:emergency_contact_number,
        spouse_mobile:spouse_mobile_number,
        local_address:local_address,
        street:street_name,
        area:area_name,
        pincode:pin_code,
        landmark:landmark_name,
        latitude:latitude,
        longitude:longitude,
        home_country_address:home_country_address,
        education:education,
        work_experience:work_experience,
        previous_salary:previous_salary,
        bank_name:name_of_bank,
        account_holder_name:account_holder_name,
        account_number:account_number,
        ifsc_code:IFSC_code,
        transport_facility:require_transport,
        journey_type:journey_type,
        trip_type:trip
      },

      success: function(response)
      {
       window.location.href="<?php echo base_url() . 'index.php?admin/add_employees';?>";
     }
   });
  }

}





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





