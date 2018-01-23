<?php print "<link rel='stylesheet' href='assets/css/star.css'>"; ?>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('teacher_form');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/teacher/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<h2>General Details</h2>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?>*</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name"  value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="religion"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?>*<br><small>[mandatory for app login]</small></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email"  value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password');?>*<br><small>[mandatory for app login]</small></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="password"  value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mobile"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landline');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="landline"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="qualification"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('experience_or_fresher');?></label>
                        
						<div class="col-sm-5">
							<select name="experience_or_fresher" id="experience_or_fresher" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('experience');?></option>
                              <option value="2"><?php echo get_phrase('fresher');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('years_of_experience');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_experience"  id="year_of_experience"  value="">
						</div>
					</div>
					
					<div class="form-group">
                        
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('temperory_address');?></label>
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="temp_address"  value=""></textarea>
						</div>
					</div>
					
					<div class="form-group">
                        
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('permanent_address');?></label>
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="permanent_address"  value=""></textarea>
						</div>
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('assign_bus');?></label>
                        <div class="col-sm-6">
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
                    </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="age"  id="age_val"  value="">
						</div>
					</div>					

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Date_Of_Birth');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="DOB" value="" data-start-view="2">
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('place_of_birth');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="place_of_birth"  value="">
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_tongue');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_tongue"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('languages_known');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="languages_known"  value="">
						</div>
					</div>	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_name"  value="">
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_occupation"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_name"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_occupation"  value="">
						</div>
					</div>
<!--
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('marital_status');?></label>
                        
						<div class="col-sm-5">
							<select name="marital_status" id="marital_status" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('single');?></option>
                              <option value="2"><?php echo get_phrase('married');?></option>
                              <option value="3"><?php echo get_phrase('divorced');?></option>
                              <option value="4"><?php echo get_phrase('widow');?></option>
                          </select>
						</div> 
					</div>
-->					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_name" id="spouse_name"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_occupation" id="spouse_occupation"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('family_members_living_with_you');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="family_members_living_with"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('extra_curriculur_activities');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="extra_curriculur"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('proefficient_in_sports');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="proefficient_sports"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('social_activities');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="social_activities"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('computer_knowledge_you_have');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="computer_knowledge_details"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('certificate_enclosed');?><br><small>[Eg:SSC, 12th]</small></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="certificate_enclosed"  value="">
						</div>
					</div>	
					
					<h3>Experience Details</h3>
					
					<h4>First Institute</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institution1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('desgination');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="desgination1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="to1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="salary1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reason_for_leaving');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="reason_for_leaving1"  value="">
						</div>
					</div>	
					
					<h4>Second Institute</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institution2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('desgination');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="desgination2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="to2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="salary2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reason_for_leaving');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="reason_for_leaving2"  value="">
						</div>
					</div>
					<h4>Third Institute</h4>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institution3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('desgination');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="desgination3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="to3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="salary3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reason_for_leaving');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="reason_for_leaving3"  value="">
						</div>
					</div>
					
					<h4>Fourth Institute</h4>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institution4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('desgination');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="desgination4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_year');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="to4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="salary4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reason_for_leaving');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="reason_for_leaving4"  value="">
						</div>
					</div>
					
					<h3>Education Details</h3>
					
					<h4>SSC</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_the_institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institute_name_SSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medium_of_instruction');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="medium_SSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="type_SSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_of_passing');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_passing_SSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('%_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="percentage_SSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class_obtained_SSC"  value="">
						</div>
					</div>
					
					<h4>12th</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_the_institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institute_name_HSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medium_of_instruction');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="medium_HSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="type_HSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_of_passing');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_passing_HSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('%_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="percentage_HSC"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class_obtained_HSC"  value="">
						</div>
					</div>
					
					<h4>UG</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_the_institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institute_name_UG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medium_of_instruction');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="medium_UG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="type_UG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_of_passing');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_passing_UG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('%_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="percentage_UG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class_obtained_UG"  value="">
						</div>
					</div>
					
					<h4>PG</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_the_institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institute_name_PG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medium_of_instruction');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="medium_PG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="type_PG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_of_passing');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_passing_PG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('%_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="percentage_PG"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class_obtained_PG"  value="">
						</div>
					</div>
					
					<h4>Professional Diploma / Degree</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_of_the_institution');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="institute_name_Prof"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('medium_of_instruction');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="medium_Prof"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="type_Prof"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_of_passing');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_passing_Prof"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('%_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="percentage_Prof"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_obtained');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class_obtained_Prof"  value="">
						</div>
					</div>
					
					
					<h3>Refernce</h3>
					
					<h4> First Refernce</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reference_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_name_1"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('contact_number');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_contact_1"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_profession_1"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="address_1"  value=""></textarea>
						</div>
					</div>
					
					<h4> Second Refernce</h4>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('reference_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_name_2"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('contact_number');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_contact_2"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="ref_profession_2"  value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="address_2"  value=""></textarea>
						</div>
					</div>
					
					<h3>Evaluation</h3>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('evaluator_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="evaluvator_name"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('subject_or_topic');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="subject_topic"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('salary_expectation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="salary_expectation"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class_applied for');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" id="class_id" onchange="return get_class_sections(this.value)">
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
					</div>

					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('distance_from_school');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="distance_from_school"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('post_applied_for');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="post_applied_for"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('preferable_subject');?></label>
                        
						<div class="col-sm-5">
							<select name="preferable_subject_id" class="form-control" id="preferable_subject_id"  onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('subject')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['subject_id'];?>">
											<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('preferable_class');?></label>
                        
						<div class="col-sm-5">
							<select name="preferable_class_id" class="form-control" id="preferable_class_id" onchange="return get_class_sections(this.value)">
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
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('current_salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="current_salary"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('expected_salary');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="expected_salary"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('current_school');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="current_school"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('notice_period');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="notice_period"  value="">
						</div>
					</div>
					
					<h4>Ratings of the Teacher</h4>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('skills');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select> -->
						  <span class="star-rating">
							  <input type="radio" name="skills_radio" class="skills" value="1"><i></i>
							  <input type="radio" name="skills_radio" class="skills" value="2"><i></i>
							  <input type="radio" name="skills_radio" class="skills" value="3"><i></i>
							  <input type="radio" name="skills_radio" class="skills" value="4"><i></i>
							  <input type="radio" name="skills_radio" class="skills" value="5"><i></i>
						  </span>
						  <input type="hidden" name="skills" id="skills" value="0">  
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('attitude');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="attitude" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select> -->
						  <span class="star-rating">
							  <input type="radio" name="attitude_radio" class="attitude" value="1"><i></i>
							  <input type="radio" name="attitude_radio" class="attitude" value="2"><i></i>
							  <input type="radio" name="attitude_radio" class="attitude" value="3"><i></i>
							  <input type="radio" name="attitude_radio" class="attitude" value="4"><i></i>
							  <input type="radio" name="attitude_radio" class="attitude" value="5"><i></i>
						  </span>
						  <input type="hidden" name="attitude" id="attitude" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('academic_skills');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="academic_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="academic_skills_radio" class="academic_skills" value="1"><i></i>
							  <input type="radio" name="academic_skills_radio" class="academic_skills" value="2"><i></i>
							  <input type="radio" name="academic_skills_radio" class="academic_skills" value="3"><i></i>
							  <input type="radio" name="academic_skills_radio" class="academic_skills" value="4"><i></i>
							  <input type="radio" name="academic_skills_radio" class="academic_skills" value="5"><i></i>
						  </span>
						  <input type="hidden" name="academic_skills" id="academic_skills" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('leadership_skills');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="leadership_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="leadership_skills_radio" class="leadership_skills" value="1"><i></i>
							  <input type="radio" name="leadership_skills_radio" class="leadership_skills" value="2"><i></i>
							  <input type="radio" name="leadership_skills_radio" class="leadership_skills" value="3"><i></i>
							  <input type="radio" name="leadership_skills_radio" class="leadership_skills" value="4"><i></i>
							  <input type="radio" name="leadership_skills_radio" class="leadership_skills" value="5"><i></i>
						  </span>
						  <input type="hidden" name="leadership_skills" id="leadership_skills" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('islamic_knowledge');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="islamic_knowledge" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select> -->
						  <span class="star-rating">
							  <input type="radio" name="islamic_knowledge_radio" class="islamic_knowledge" value="1"><i></i>
							  <input type="radio" name="islamic_knowledge_radio" class="islamic_knowledge" value="2"><i></i>
							  <input type="radio" name="islamic_knowledge_radio" class="islamic_knowledge" value="3"><i></i>
							  <input type="radio" name="islamic_knowledge_radio" class="islamic_knowledge" value="4"><i></i>
							  <input type="radio" name="islamic_knowledge_radio" class="islamic_knowledge" value="5"><i></i>
						  </span>
						  <input type="hidden" name="islamic_knowledge" id="islamic_knowledge" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('writing_skills');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="writing_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="writing_skills_radio" class="writing_skills" value="1"><i></i>
							  <input type="radio" name="writing_skills_radio" class="writing_skills" value="2"><i></i>
							  <input type="radio" name="writing_skills_radio" class="writing_skills" value="3"><i></i>
							  <input type="radio" name="writing_skills_radio" class="writing_skills" value="4"><i></i>
							  <input type="radio" name="writing_skills_radio" class="writing_skills" value="5"><i></i>
						  </span>
						  <input type="hidden" name="writing_skills" id="writing_skills" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('greeting');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="greeting" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>  -->
						  <span class="star-rating">
							  <input type="radio" name="greeting_radio" class="greeting" value="1"><i></i>
							  <input type="radio" name="greeting_radio" class="greeting" value="2"><i></i>
							  <input type="radio" name="greeting_radio" class="greeting" value="3"><i></i>
							  <input type="radio" name="greeting_radio" class="greeting" value="4"><i></i>
							  <input type="radio" name="greeting_radio" class="greeting" value="5"><i></i>
						  </span>
						  <input type="hidden" name="greeting" id="greeting" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('introduction');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="introduction" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="introduction_radio" class="introduction" value="1"><i></i>
							  <input type="radio" name="introduction_radio" class="introduction" value="2"><i></i>
							  <input type="radio" name="introduction_radio" class="introduction" value="3"><i></i>
							  <input type="radio" name="introduction_radio" class="introduction" value="4"><i></i>
							  <input type="radio" name="introduction_radio" class="introduction" value="5"><i></i>
						  </span>
						  <input type="hidden" name="introduction" id="introduction" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject_knowledge');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="subject_knowledge" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="subject_knowledge_radio" class="subject_knowledge" value="1"><i></i>
							  <input type="radio" name="subject_knowledge_radio" class="subject_knowledge" value="2"><i></i>
							  <input type="radio" name="subject_knowledge_radio" class="subject_knowledge" value="3"><i></i>
							  <input type="radio" name="subject_knowledge_radio" class="subject_knowledge" value="4"><i></i>
							  <input type="radio" name="subject_knowledge_radio" class="subject_knowledge" value="5"><i></i>
						  </span>
						  <input type="hidden" name="subject_knowledge" id="subject_knowledge" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('use_of_board');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="use_of_board" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="use_of_board_radio" class="use_of_board" value="1"><i></i>
							  <input type="radio" name="use_of_board_radio" class="use_of_board" value="2"><i></i>
							  <input type="radio" name="use_of_board_radio" class="use_of_board" value="3"><i></i>
							  <input type="radio" name="use_of_board_radio" class="use_of_board" value="4"><i></i>
							  <input type="radio" name="use_of_board_radio" class="use_of_board" value="5"><i></i>
						  </span>
						  <input type="hidden" name="use_of_board" id="use_of_board" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('communication_skills');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="communication_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="communication_skills_radio" class="communication_skills" value="1"><i></i>
							  <input type="radio" name="communication_skills_radio" class="communication_skills" value="2"><i></i>
							  <input type="radio" name="communication_skills_radio" class="communication_skills" value="3"><i></i>
							  <input type="radio" name="communication_skills_radio" class="communication_skills" value="4"><i></i>
							  <input type="radio" name="communication_skills_radio" class="communication_skills" value="5"><i></i>
						  </span>
						  <input type="hidden" name="communication_skills" id="communication_skills" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teaching_methodlogy');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="teaching_methodlogy" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="teaching_methodlogy_radio" class="teaching_methodlogy" value="1"><i></i>
							  <input type="radio" name="teaching_methodlogy_radio" class="teaching_methodlogy" value="2"><i></i>
							  <input type="radio" name="teaching_methodlogy_radio" class="teaching_methodlogy" value="3"><i></i>
							  <input type="radio" name="teaching_methodlogy_radio" class="teaching_methodlogy" value="4"><i></i>
							  <input type="radio" name="teaching_methodlogy_radio" class="teaching_methodlogy" value="5"><i></i>
						  </span>
						  <input type="hidden" name="teaching_methodlogy" id="teaching_methodlogy" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class_control');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="class_control" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>		-->
						  <span class="star-rating">
							  <input type="radio" name="class_control_radio" class="class_control" value="1"><i></i>
							  <input type="radio" name="class_control_radio" class="class_control" value="2"><i></i>
							  <input type="radio" name="class_control_radio" class="class_control" value="3"><i></i>
							  <input type="radio" name="class_control_radio" class="class_control" value="4"><i></i>
							  <input type="radio" name="class_control_radio" class="class_control" value="5"><i></i>
						  </span>
						  <input type="hidden" name="class_control" id="class_control" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('level_of_confidence');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="level_of_confidence" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="level_of_confidence_radio" class="level_of_confidence" value="1"><i></i>
							  <input type="radio" name="level_of_confidence_radio" class="level_of_confidence" value="2"><i></i>
							  <input type="radio" name="level_of_confidence_radio" class="level_of_confidence" value="3"><i></i>
							  <input type="radio" name="level_of_confidence_radio" class="level_of_confidence" value="4"><i></i>
							  <input type="radio" name="level_of_confidence_radio" class="level_of_confidence" value="5"><i></i>
						  </span>
						  <input type="hidden" name="level_of_confidence" id="level_of_confidence" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('body_language');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="body_language" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="body_language_radio" class="body_language" value="1"><i></i>
							  <input type="radio" name="body_language_radio" class="body_language" value="2"><i></i>
							  <input type="radio" name="body_language_radio" class="body_language" value="3"><i></i>
							  <input type="radio" name="body_language_radio" class="body_language" value="4"><i></i>
							  <input type="radio" name="body_language_radio" class="body_language" value="5"><i></i>
						  </span>
						  <input type="hidden" name="body_language" id="body_language" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('evaluation_of_student_understanding');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="evaluation_of_student_understanding" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="evaluation_of_student_understanding_radio" class="evaluation_of_student_understanding" value="1"><i></i>
							  <input type="radio" name="evaluation_of_student_understanding_radio" class="evaluation_of_student_understanding" value="2"><i></i>
							  <input type="radio" name="evaluation_of_student_understanding_radio" class="evaluation_of_student_understanding" value="3"><i></i>
							  <input type="radio" name="evaluation_of_student_understanding_radio" class="evaluation_of_student_understanding" value="4"><i></i>
							  <input type="radio" name="evaluation_of_student_understanding_radio" class="evaluation_of_student_understanding" value="5"><i></i>
						  </span>
						  <input type="hidden" name="evaluation_of_student_understanding" id="evaluation_of_student_understanding" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('recapitulation_/_summary');?></label>
                        
						<div class="col-sm-5">
						<!--	<select name="summary" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>	-->
						  <span class="star-rating">
							  <input type="radio" name="summary_radio" class="summary" value="1"><i></i>
							  <input type="radio" name="summary_radio" class="summary" value="2"><i></i>
							  <input type="radio" name="summary_radio" class="summary" value="3"><i></i>
							  <input type="radio" name="summary_radio" class="summary" value="4"><i></i>
							  <input type="radio" name="summary_radio" class="summary" value="5"><i></i>
						  </span>
						  <input type="hidden" name="summary" id="summary" value="0">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('on_the_basis_of_this_evaluation_i_recommend_him_/_her_to_be');?></label>
                        
						<div class="col-sm-5">
							<select name="evaluvator_status" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('selected');?></option>
                              <option value="2"><?php echo get_phrase('rejected');?></option>
							  <option value="3"><?php echo get_phrase('shortlisted');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<h3>Question & Answer</h3>
					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question1);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer1" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question2);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer2" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question3);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer3" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question4);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer4" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question5);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer5" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question6);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer6" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question7);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer7" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question8);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer8" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question9);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer9" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question10);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer10" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question11);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer11" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question12);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer12" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question13);?></label>
                        
						<div class="col-sm-8">
							<textarea type="text" class="form-control" name="answer13" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }
	jQuery(document).ready(function($)
	{
		$('#experience_or_fresher').change(function () {
			var exp_fresh = this.value;
			if(exp_fresh == '2')
				$('#year_of_experience').val('0');
			else
				$('#year_of_experience').val('');
		});	
		
		$('#marital_status').change(function () {
			var marital_status = this.value;
			if(marital_status != '2'){
				$('#spouse_name').prop('disabled', true);
				$('#spouse_occupation').prop('disabled', true);
			}else{
				$('#spouse_name').prop('disabled', false);
				$('#spouse_occupation').prop('disabled', false);
			}	
		});	
		$("#age_val").keydown(function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A, Command+A
				(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		/* star rating value populate to hidden field */
		$(':radio').change(function(){
			var class_val = $(this).attr("class") ;
			console.log(class_val);
			$('#'+class_val).val(this.value);
			console.log($('#'+class_val).val());
			// $('.choice').text( this.value + ' stars' );
		}); 
		
	});
</script>
