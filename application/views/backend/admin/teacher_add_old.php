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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="password"  value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="qualification"  value="">
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
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('experience_or_fresher');?></label>
                        
						<div class="col-sm-5">
							<select name="experience_or_fresher" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('experience');?></option>
                              <option value="2"><?php echo get_phrase('fresher');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('years_of_experience');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_experience"  value="">
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="age"  value="">
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
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_name"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_occupation"  value="">
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('certificate_enclosed');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from1"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from2"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from3"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="from4"  value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('refernce_name');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('refernce_name');?></label>
                        
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('evaluvator_name');?></label>
                        
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
							<select name="preferable_subject_id" class="form-control" data-validate="required" id="preferable_subject_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
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
							<select name="preferable_class_id" class="form-control" data-validate="required" id="preferable_class_id" 
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
							<select name="skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('attitude');?></label>
                        
						<div class="col-sm-5">
							<select name="attitude" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('academic_skills');?></label>
                        
						<div class="col-sm-5">
							<select name="academic_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('leadership_skills');?></label>
                        
						<div class="col-sm-5">
							<select name="leadership_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('islamic_knowledge');?></label>
                        
						<div class="col-sm-5">
							<select name="islamic_knowledge" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('writing_skills');?></label>
                        
						<div class="col-sm-5">
							<select name="writing_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('greeting');?></label>
                        
						<div class="col-sm-5">
							<select name="greeting" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('introduction');?></label>
                        
						<div class="col-sm-5">
							<select name="introduction" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject_knowledge');?></label>
                        
						<div class="col-sm-5">
							<select name="subject_knowledge" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('use_of_board');?></label>
                        
						<div class="col-sm-5">
							<select name="use_of_board" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('communication_skills');?></label>
                        
						<div class="col-sm-5">
							<select name="communication_skills" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teaching_methodlogy');?></label>
                        
						<div class="col-sm-5">
							<select name="teaching_methodlogy" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class_control');?></label>
                        
						<div class="col-sm-5">
							<select name="class_control" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('level_of_confidence');?></label>
                        
						<div class="col-sm-5">
							<select name="level_of_confidence" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('body_language');?></label>
                        
						<div class="col-sm-5">
							<select name="body_language" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('evaluation_of_student_understanding');?></label>
                        
						<div class="col-sm-5">
							<select name="evaluation_of_student_understanding" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('recapitulation_/_summary');?></label>
                        
						<div class="col-sm-5">
							<select name="summary" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('1');?></option>
                              <option value="2"><?php echo get_phrase('2');?></option>
							  <option value="3"><?php echo get_phrase('3');?></option>
                              <option value="4"><?php echo get_phrase('4');?></option>
							  <option value="5"><?php echo get_phrase('5');?></option>
                              
                          </select>
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
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer1" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question2);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer2" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question3);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer3" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question4);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer4" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question5);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer5" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question6);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer6" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question7);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer7" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question8);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer8" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question9);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer9" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question10);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer10" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question11);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer11" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question12);?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="answer12" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase($this->db->get('question_answer')->row()->question13);?></label>
                        
						<div class="col-sm-5">
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

</script>