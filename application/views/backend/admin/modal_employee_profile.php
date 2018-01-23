<?php
$employee_info	=	$this->db->get_where('employee_details' , array('emp_id' => $param2))->result_array();
foreach($employee_info as $row):?>

<div class="profile-env" style="margin-left: 15px; margin-right: 15px;">
	
	<header class="row">
		
		<!-- <div class="col-sm-3">
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_stu_image_url($row['student_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
		</div> -->
		
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
            <table class="table">
                <tr style="background: white;"><td><b>Personal Details</b></td><td></td></tr>

                <tr>
                    <td><?php echo get_phrase('iqama_ID_number');?></td>
                    <td><b><?php echo $row['iqama_number']; ?></b></td>
                </tr>


                <tr>
                    <td><?php echo get_phrase('employee_name');?></td>
                    <td><b><?php echo $row['name']; ?></b></td>
                </tr>


                <tr>
                    <td><?php echo get_phrase('employee_number');?></td>
                    <td><b><?php echo $row['emp_number']; ?></b></td>
                </tr>
                
                <tr>
                    <td><?php echo get_phrase('contract_type');?></td>
                    <td><b><?php
                        if($row['contract_type']=='1') 
                            echo get_phrase('on_school_iqama');
                        if($row['contract_type']=='2') 
                            echo get_phrase('on_spouse_iqama');
                        ?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('roles');?></td>
                        <td><b><?php 
                            $x = explode(',', $row['emp_type']);
                            foreach ($x as $r) {
                                if($r!=''){
                                    echo $this->db->get_where('hr_roles' , array('id' => $r))->row()->role;
                                    echo nl2br("\n");
                                }
                            }?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('date_of_birth');?></td>
                            <td><b><?php echo $row['dob'];?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('place_of_birth');?></td>
                            <td><b><?php echo $row['place_of_birth'];?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('gender');?></td>
                            <td><b><?php if($row['gender']=='M') 
                                echo get_phrase('Male');
                                if($row['gender']=='F') 
                                    echo get_phrase('Female');?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('nationlity');?></td>
                                <td><b><?php echo $row['nationality'];?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('mother_tongue');?></td>
                                <td><b><?php echo $row['mother_tongue'];?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('language_known');?></td>
                                <td><b><?php echo $row['language_known'];?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('marital_status');?></td>
                                <td><b><?php echo $row['marital_status'];?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('family_status');?></td>
                                <td><b><?php if($row['family_status']=='1') 
                                    echo get_phrase('yes');
                                    if($row['family_status']=='2') 
                                        echo get_phrase('no');?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo get_phrase('blood_group');?></td>
                                    <td><b><?php echo $row['blood_group'];?></b></td>
                                </tr>

                                <tr style="background: white;"><td><b>Contact Details</b></td><td></td></tr>

                                <tr>
                                    <td><?php echo get_phrase('email_ID');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['email'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('mobile_number');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['mobile'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                <td><?php echo get_phrase('landline_number');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['landline'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('alternate_mobile_number');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['alternate_mobile'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('emergency_contact_number');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['emergency_contact'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('spouse_mobile_number');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['spouse_mobile'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('local_address');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['local_address'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('street_name');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['street'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('area_name');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['area'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('pin_code');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['pincode'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('landmark_name');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['landmark'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo get_phrase('latitude');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['latitude'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo get_phrase('longitude');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['longitude'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo get_phrase('home_country_address');?></td>
                                    <td>
                                        <b>
                                            <?php 
                                            echo $row['home_country_address'];
                                            ?>
                                        </b>
                                    </td>
                                </tr>

                                <tr style="background: white;"><td><b>Qualification</b></td><td></td></tr>

                                <tr>
                                    <td><?php echo get_phrase('education');?></td>
                                    <td>
                                        <b>
                                          <?php 
                                          echo $row['education'];
                                          ?>
                                      </b>
                                  </td>
                              </tr>

                              <tr>
                                <td><?php echo get_phrase('work_experience');?></td>
                                <td>
                                    <b>
                                      <?php 
                                      echo $row['work_experience'];
                                      ?>
                                  </b>
                              </td>
                          </tr>
                          <tr>
                                    <td><?php echo get_phrase('previous_salary');?></td>
                                    <td>
                                        <b>
                                          <?php 
                                          echo $row['previous_salary'];
                                          ?>
                                      </b>
                                  </td>
                              </tr>
                              <tr style="background: white;"><td><b>Login Details</b></td><td></td></tr>

                                <tr>
                                    <td><?php echo get_phrase('Login_ID');?></td>
                                    <td>
                                        <b>
                                          <?php 
                                          echo $row['login'];
                                          ?>
                                      </b>
                                  </td>
                              </tr>

                              <tr>
                                <td><?php echo get_phrase('password');?></td>
                                <td>
                                    <b>
                                      <label id='password' name='password'><?php 
                                          echo $row['password'];
                                          ?></label>
                                          
                                  </b>
                              </td>
                          </tr>
                          

                      <tr style="background: white;"><td><b>Bank Account Details</b></td><td></td></tr>

                      <tr>
                        <td><?php echo get_phrase('name_of_bank');?></td>
                        <td>
                            <b>
                                <?php 
                               echo $row['bank_name'];
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('account_holder_name');?></td>
                        <td>
                            <b>
                                <?php 
                                echo $row['account_holder_name'];
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('account_number');?></td>
                        <td>
                            <b>
                                <?php 
                                echo $row['account_number'];
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('IFSC_code');?></td>
                        <td>
                            <b>
                                <?php 
                                echo $row['ifsc_code'];
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr style="background: white;"><td><b>Transport Facilities</b></td><td></td></tr>

                      <tr>
                        <td><?php echo get_phrase('require_transport');?></td>
                        <td>
                            <b>
                                <?php 
                                if($row['transport_facility']=='1') 
                                    echo get_phrase('yes');
                                if($row['transport_facility']=='2') 
                                        echo get_phrase('no');
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('journey_type');?></td>
                        <td>
                            <b>
                                <?php 
                                if($row['journey_type']=='0') 
                                    echo get_phrase('none');
                                if($row['journey_type']=='1') 
                                        echo get_phrase('one_way');
                                if($row['journey_type']=='2') 
                                        echo get_phrase('two_way');
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('trip');?></td>
                        <td>
                            <b>
                                <?php 
                                if($row['trip_type']=='0') 
                                    echo get_phrase('none');
                                if($row['trip_type']=='1') 
                                        echo get_phrase('pickup');
                                if($row['journey_type']=='2') 
                                        echo get_phrase('drop');
                                    if($row['journey_type']=='3') 
                                        echo get_phrase('pickup_and_drop');
                                ?>
                            </b>
                        </td>
                    </tr>

                    <?php 
            $this->db->where('emp_id',$row['emp_id']);
            $q = $this->db->get('employee_documents');
            if ($q->num_rows() > 0) 
            {?>

                    
                <tr style="background: white;"><td><b>Employee Documents</b></td><td></td></tr>

                <tr>
            <td>
              <?php echo get_phrase('iqama_ID');?>
          </td>
          <td>
              <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_number == null) {
                  echo "--";
              }else{
                echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_number;
            } ?>
        </td>
    </tr>

                <tr>
                    <td>
                      <?php echo get_phrase('iqama_copy');?>
                  </td>
                  <td>
                  
                <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_url; 
                $file= explode('/', $f)?>
                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->iqama_url;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
            </td>
        </tr>

        <tr>
            <td>
              <?php echo get_phrase('Iqama_Issue_Date');?>
          </td>
          <td>
              <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_date == null) {
                  echo "--";
              }else{
                echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_date;
            } ?>
        </td>
    </tr>

    <tr>
        <td>
          <?php echo get_phrase('iqama_expiry_date');?>
      </td>
      <td>
          <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_expiry_date == null) {
              echo "--";
          }else{
            echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_expiry_date;
        } ?>
    </td>
</tr>

<tr>
    <td>
      <?php echo get_phrase('iqama_place_of_issue');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_place == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->iqama_issue_place;
    } ?>
</td>
</tr>

<tr>
    <td>
      <?php echo get_phrase('passport_number');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_number == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_number;
    } ?>
</td>
</tr>

<tr>
    <td>
      <?php echo get_phrase('passport_copy');?>
  </td>
  <td>
    <?php if ($this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->passport_url == null) {
      echo "--";
  } else{ ?>
  <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_url; 
                $file= explode('/', $f)?>
                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->passport_url;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
  <?php
} ;?>
                  
            </td>
        </tr>

        <tr>
    <td>
      <?php echo get_phrase('passport_issue_date');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_date == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_date;
    } ?>
</td>
</tr>

    <tr>
    <td>
      <?php echo get_phrase('passport_expiry');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_expiry_date == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_expiry_date;
    } ?>
</td>
</tr>

<tr>
    <td>
      <?php echo get_phrase('passport_place_of_issue');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_place== null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->passport_issue_place;
    } ?>
</td>
</tr


<!--Driving License-->
<tr>
	<td>
		<?php echo get_phrase('driving_license_number');?>
	</td>
	<td>
		<?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_number == null) {
			echo "--";
		}else{
			echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_number;
		} ?>
	</td>
</tr>

<tr>
    <td>
		<?php echo get_phrase('driving_license_copy');?>
	</td>
	<td>
		<?php if ($this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->driving_license_url == null) {
			echo "--";
		} else{ ?>
		<?php
            $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_url; 
			$file= explode('/', $f)?>
			<button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->driving_license_url;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
			<?php
		} ;?>
                  
            </td>
        </tr>

        <tr>
    <td>
      <?php echo get_phrase('driving_license_issue_date');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_date == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_date;
    } ?>
</td>
</tr>

    <tr>
    <td>
      <?php echo get_phrase('driving_license_expiry_date');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_expiry_date == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_expiry_date;
    } ?>
</td>
</tr>

<tr>
    <td>
      <?php echo get_phrase('driving_license_place_of_issue');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_place== null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->driving_license_issue_place;
    } ?>
</td>
</tr>


<tr>
    <td>
      <?php echo get_phrase('medical_insurance_ID');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_id == null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_id;
    } ?>
</td>
</tr>

 <tr>
                    <td>
                      <?php echo get_phrase('medical_insurance_copy');?>
                  </td>
                  <td>
                  
                <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_url; 
                $file= explode('/', $f)?>
                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->medical_insurance_url;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
            </td>
        </tr>


<tr>
    <td>
      <?php echo get_phrase('medical_insurance_expiry_date');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_expiry_date== null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_insurance_expiry_date;
    } ?>
</td>
</tr>

<tr>
                    <td>
                      <?php echo get_phrase('medical_report_document');?>
                  </td>
                  <td>
                  
                <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->medical_report; 
                $file= explode('/', $f)?>
                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->medical_report;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
            </td>
        </tr>

        <tr>
    <td>
      <?php echo get_phrase('NOC_letter_number');?>
  </td>
  <td>
      <?php if ($this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->noc_letter_number== null) {
          echo "--";
      }else{
        echo $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->noc_letter_number;
    } ?>
</td>
</tr>

    <tr>
                    <td>
                      <?php echo get_phrase('NOC_letter_copy');?>
                  </td>
                  <td>
                  
                <?php
                $f= $this->db->get_where('employee_documents' , array('emp_id' => $row['emp_id']))->row()->noc_letter_url; 
                $file= explode('/', $f)?>
                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url().$this->db->get_where('employee_documents' , array('emp_id'=>$row['emp_id']))->row()->noc_letter_url;?>" download="<?php echo $file[2];?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
            </td>
        </tr>


    

            <?php 
        }else{
          echo "<tr><td><h3>No Documents Available</h3></td></tr>";
      }
      ?>
  </table>
</div>
</div>    
<input type="text" hidden name="employee_number" id="employee_number"
                value="<?php echo $row['emp_number']; ?>">
</section>  


</div>


<?php endforeach;?>


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
        //alert(response);
        $("#password").html(response);
      }
    });
    
  });

</script>
