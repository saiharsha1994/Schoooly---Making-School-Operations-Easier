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
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title" >
							<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('addmission_form');?>
						</div>
					</div>
					<div class="panel-body">
						
						<?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="name"  value="" autofocus>
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
								
								<div class="col-sm-5">
									<select name="parent_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
									  <option value=""><?php echo get_phrase('select');?></option>
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
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('admission_id');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="student_code" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								</div> 
							</div>
							
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Date_Of_Birth');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="DOB" value="" data-start-view="2">
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
								
								<div class="col-sm-5">
									<select name="sex" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value="male"><?php echo get_phrase('male');?></option>
									  <option value="female"><?php echo get_phrase('female');?></option>
								  </select>
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="religion" value="" >
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="blood_group" value="" >
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Street_Name');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Street_Name" value="" >
								</div> 
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Area');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Area" value="" >
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Landmark');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Landmark" value="" >
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Latitude_Of_Area');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Latitude"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Longitude_Of_Area');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Longitude"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="phone" value="" >
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="email"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Student_Iqama_ID');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Student_Iqama_ID"  value="">
								</div>
							</div>

							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Father_Name');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Father_Name"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Father_Occupation');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Father_Occupation"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Name');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Mother_Name"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Occupation');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Mother_Occupation"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Medical_Insurance_Name');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Medical_Insurance_Name"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Medical_Insurance_Number');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Medical_Insurance_Number"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Special_Notes');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Special_Notes"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Nationality');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Nationality"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Father_Primary_Mobile');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Father_Primary_Mobile"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Father_Secondary_Mobile');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Father_Secondary_Mobile"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Primary_Mobile');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Mother_Primary_Mobile"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Mother_Secondary_Mobile');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Mother_Secondary_Mobile"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Emergency_Contact_Person_Name_Primary');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Emer_Contact_Person_Name_Primary"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Emergency_Contact_Person_Number_Primary');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Emer_Contact_Person_Number_Primary"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Emergency_Contact_Person_Name_Secondary');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Emer_Contact_Person_Name_Secondary"  value="">
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Emergency_Contact_Person_Number_Secondary');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Emer_Contact_Person_Number_Secondary"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Home_Landline');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Home_Landline"  value="">
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Office_Landline');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Office_Landline"  value="">
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Latest_Feedback');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="Latest_Feedback"  value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Transport_Facility');?></label>
								
								<div class="col-sm-5">
									<select name="Transport_Facility" class="form-control selectboxit">
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value="yes"><?php echo get_phrase('yes');?></option>
									  <option value="no"><?php echo get_phrase('no');?></option>
									</select>
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Admission_Type');?></label>
								
								<div class="col-sm-5">
									<select name="Admission_Type" class="form-control selectboxit">
									  <option value=""><?php echo get_phrase('select');?></option>
									  <option value="normal"><?php echo get_phrase('normal');?></option>
									  <option value="special"><?php echo get_phrase('special');?></option>
									</select>
								</div> 
							</div>
							
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
								
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
												<input type="file" name="userfile" accept="image/*">
											</span>
											<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
										</div>
									</div>
								</div>
							</div>  
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
								</div>
							</div>
						<?php echo form_close();?>
					</div>
				</div>
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_iqama_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="child_iqama_expiry" value="" data-start-view="2">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_iqama_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="father_iqama_expiry" value="" data-start-view="2">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_iqama_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="mother_iqama_expiry" value="" data-start-view="2">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('child_passport_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="child_passport_expiry" value="" data-start-view="2">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('father_passport_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="father_passport_expiry" value="" data-start-view="2">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('mother_passport_expiry_date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="mother_passport_expiry" value="" data-start-view="2">
								</div> 
							</div>
							
							<div class="form-group">
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
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Copy_of_Vaccination_Card_for_the_student');?></label>
								
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