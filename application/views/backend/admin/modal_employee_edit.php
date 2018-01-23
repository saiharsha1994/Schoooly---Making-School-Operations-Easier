<?php 
$employee_data    = $this->db->get_where('employee_details' , array('emp_id' => $param2))->result_array();
foreach ($employee_data as $row):
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
        
                <?php echo form_open(base_url() . 'index.php?admin/update_employees/'.$row['emp_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group" style="margin-top: 15px;">
      <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('contract_type');?></label>
      <div class="col-sm-5">
        <select name="contract_type" id="contract_type" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
          <option value=""><?php echo get_phrase('select_type');?></option>
          <option value="1" <?php if($row['contract_type']=='1') echo 'selected';?> ><?php echo get_phrase('on_school_iqama');?></option>
          <option value="2" <?php if($row['contract_type']=='2') echo 'selected';?> ><?php echo get_phrase('on_spouse_iqama');?></option>

        </select>
      </div>
    </div>

    <div class="form-group" >
      <label for="field-1" class="col-sm-3 control-label">Select Roles</label>
      <?php 
      $roles=$this->db->get("hr_roles")->result_array();
      $x = explode(',', $row['emp_type']);
      ?>
      <div class="col-sm-5">
        <?php foreach ($roles as $row2) {
          $c=0;
          $name = $row2['role'];
          foreach ($x as $ro) {
            if($ro==$row2['id']){
              ?>
              <input type="checkbox" checked="true" style="margin-top: 5px;" name="roles[]" value='<?php echo get_phrase($row2['id'])?>' /> <?php $c+=1; break;}}?>
              <?php if($c==0){ ?>
              <input type="checkbox" style="margin-top: 5px;"  name="roles[]" value='<?php echo get_phrase($row2['id'])?>' /> <?php } ?>
              <label style="margin-left: 8px;"><?php echo get_phrase($name)?></label><br/>
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
                  <input type="text" class="form-control" name="iqama_ID_number" id="iqama_ID_number" value="<?php echo $row['iqama_number']; ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('employee_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo $row['name']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('employee_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="employee_number" id="employee_number" value="<?php echo $row['emp_number']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="date_of_birth" id="date_of_birth" data-format="dd-mm-yyyy" value="<?php echo $row['dob']; ?>" data-format="dd-mm-yyyy" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('place_of_birth')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" value="<?php echo $row['place_of_birth']; ?>">
                </div>
              </div>

              <div class="form-group"> 
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender')?></label>
                <div class="col-sm-5">
                  <select name="gender" id="gender" class="form-control" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Select Gender";?></option>
                    <option value="M" <?php if($row['gender']=='M') echo 'selected'; ?>><?php echo "Male";?></option>
                    <option value="F" <?php if($row['gender']=='F') echo 'selected'; ?>><?php echo "Female";?></option>
                  </select>
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('nationality')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nationality" id="nationality" value="<?php echo $row['nationality']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_tongue')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_tongue" id="mother_tongue" value="<?php echo $row['mother_tongue']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('language_known')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="language_known" id="language_known" value="<?php echo $row['language_known']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('marital_status')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="marital_status" id="marital_status" value="<?php echo $row['marital_status']; ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('family_status')?></label>
                <div class="col-sm-5">
                  <select name="family_status" id="family_status" class="form-control" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Select Family Status";?></option>
                    <option value="1" <?php if($row['family_status']=='1') echo 'selected'; ?>><?php echo "Yes";?></option>
                    <option value="2" <?php if($row['family_status']=='2') echo 'selected'; ?>><?php echo "No";?></option>
                  </select>
                </div> 
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('blood_group')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="blood_group" id="blood_group" value="<?php echo $row['blood_group']; ?>">
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
                  <input type="text" class="form-control" name="email_ID" id="email_ID" value="<?php echo $row['email']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="<?php echo $row['mobile']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landline_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landline_number" id="landline_number" value="<?php echo $row['landline']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_mobile_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="alternate_mobile_number" id="alternate_mobile_number" value="<?php echo $row['alternate_mobile']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('emergency_contact_number')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number" value="<?php echo $row['emergency_contact']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Spouse's Mobile Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="spouse_mobile_number" id="spouse_mobile_number" value="<?php echo $row['spouse_mobile']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('local_address')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="local_address" id="local_address" value="<?php echo $row['local_address']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('street_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="street_name" id="street_name" value="<?php echo $row['street']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('area_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="area_name" id="area_name" value="<?php echo $row['area']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('pin_code')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="pin_code" id="pin_code" value="<?php echo $row['pincode']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landmark_name')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landmark_name" id="landmark_name" value="<?php echo $row['landmark']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('latitude')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo $row['latitude']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('longitude')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo $row['longitude']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('home_country_address')?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="home_country_address" id="home_country_address" value="<?php echo $row['home_country_address']; ?>">
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
                <input type="text" class="form-control" name="education" id="education" value="<?php echo $row['education']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('work_experience')?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="work_experience" id="work_experience" value="<?php echo $row['work_experience']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('previous_salary')?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="previous_salary" id="previous_salary" value="<?php echo $row['previous_salary']; ?>">
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
              <input type="text" class="form-control" name="name_of_bank" id="name_of_bank" value="<?php echo $row['bank_name']; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('account_holder_name')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="<?php echo $row['account_holder_name']; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('account_number')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo $row['account_number']; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('IFSC_code')?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="IFSC_code" id="IFSC_code" value="<?php echo $row['ifsc_code']; ?>">
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
                <option value="1" <?php if($row['transport_facility']=='1') echo 'selected'; ?> ><?php echo "Yes";?></option>
                <option value="2" <?php if($row['transport_facility']=='2') echo 'selected'; ?> ><?php echo "No";?></option>
              </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Journey Type</label>
            <div class="col-sm-5">
              <select name="journey_type" id="journey_type" class="form-control" >
                <option value="0" <?php if($row['journey_type']=='0') echo 'selected'; ?>><?php echo "Select";?></option>
                <option value="1" <?php if($row['journey_type']=='1') echo 'selected'; ?>><?php echo "One Way";?></option>
                <option value="2" <?php if($row['journey_type']=='2') echo 'selected'; ?>><?php echo "Two Way";?></option>
              </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Trip</label>
            <div class="col-sm-5">
              <select name="trip" id="trip" class="form-control" >
                <option value="0" <?php if($row['trip_type']=='0') echo 'selected'; ?>><?php echo "Select";?></option>
                <option value="1" <?php if($row['trip_type']=='1') echo 'selected'; ?>><?php echo "Pickup";?></option>
                <option value="2" <?php if($row['trip_type']=='2') echo 'selected'; ?>><?php echo "Drop";?></option>
                <option value="3" <?php if($row['trip_type']=='3') echo 'selected'; ?>><?php echo "Both";?></option>
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
            <input type="text" class="form-control" name="login" id="login" value="<?php echo $row['login']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password')?></label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="password" id="password" value="">
          </div>
        </div>

        
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Documents Section
        </a>
      </h4>
    </div>
    <div id="collapseNine" class="panel-collapse collapse">
    <?php 
            $this->db->where('emp_id',$row['emp_id']);
            $q = $this->db->get('employee_documents');
            if ($q->num_rows() > 0) 
            {?>
      <div class="panel-body">

      <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_ID_number');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="iqama_id_number" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_number; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="iqama_copy">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_url; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="iqama_copy1" 
                value="<?php echo $file[2]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_issue_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="iqama_issue_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_expiry_date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="iqama_expiry_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_expiry_date; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_place_of_issue');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="iqama_place_of_issue" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_place; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_number');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="passport_number" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_number; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="passport_copy">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_url; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="passport_copy1" 
                value="<?php echo $file[2]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_Issue_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="passport_issue_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="passport_expiry_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_expiry_date; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_place_of_issue');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="passport_issue_place" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_place; ?>">
            </div>
          </div>
		  
		  
		  
		  <!-- Driving License-->
		  <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_number');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="dl_number" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_number; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="dl_copy">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_url; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="dl_copy1" 
                value="<?php echo $file[2]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_Issue_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="dl_issue_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="dl_expiry_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_expiry_date; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('driving_license_place_of_issue');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="dl_issue_place" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_place; ?>">
            </div>
          </div>
		  
		  
		  

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Medical_Insurance_ID');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="medical_insurance_id" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_id; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medical_insurance_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="medical_insurance_copy">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_url; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="medical_insurance_copy1" 
                value="<?php echo $file[2]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Medical_Insurance_Expiry_Date');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="medical_insurance_expiry_date" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_expiry_date; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medical_report');?></label>
            <div class="col-sm-5">
              <input type="file" name="medical_report">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_report; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="medical_report1" 
                value="<?php echo $file[2]; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('NOC_letter_number');?></label>
            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="noc_letter_number" 
                value="<?php echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->noc_letter_number; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('NOC_letter_copy');?></label>
            <div class="col-sm-5">
              <input type="file" name="noc_letter_copy">
              <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->noc_letter_url; 
                $file= explode('/', $f)?>
              <input type="text" class="form-control" name="medical_report1" 
                value="<?php echo $file[2]; ?>">
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


  jQuery(document).ready(function($)
  {
    var iqama= document.getElementById('employee_number').value;
    //alert(iqama);
    $.ajax({
      url: '<?php echo base_url();?>index.php?admin/get_password' ,
      type:"POST",
      data:{ par0:iqama},
      success: function(response)
      {       
        var z = response;
        
        $("#password").val(response);
      }
    });
    
  });

</script>

