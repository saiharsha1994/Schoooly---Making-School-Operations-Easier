<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/teacher_edit/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?>*</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name"  value="<?php echo $row['name'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="religion"  value="<?php echo $row['religion'];?>">
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mobile"  value="<?php echo $row['mobile'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('landline');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="landline"  value="<?php echo $row['landline'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="qualification"  value="<?php echo $row['qualification'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('experience_or_fresher');?></label>
                        
						<div class="col-sm-5">
							<select name="experience_or_fresher" id="experience_or_fresher" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                              <option value="1" <?php if($row['experience_or_fresher'] == '1')echo 'selected';?>><?php echo get_phrase('experience');?></option>
                              <option value="2"<?php if($row['experience_or_fresher']== '2')echo 'selected';?>><?php echo get_phrase('fresher');?></option>
                          </select>
						</div> 
					</div>
					
					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('years_of_experience');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="year_of_experience"  id="year_of_experience"  value="<?php echo $row['year_of_experience'];?>">
						</div>
					</div>
					
					<div class="form-group">
                        
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('temperory_address');?></label>
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="temp_address" ><?php echo $row['temp_address'];?></textarea>
						</div>
					</div>
					
					<div class="form-group">
                        
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('permanent_address');?></label>
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="permanent_address" ><?php echo $row['permanent_address'];?></textarea>
						</div>
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('assign_bus');?></label>
                        <div class="col-sm-5">
                            <select name="assigned_bus" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                               $bus_details = $this->db->get('bus_details')->result_array();
                                foreach($bus_details as $row2):
                                ?>
                                    <option value="<?php echo $row2['bus_Id'];?>"
                                        <?php $assigned_bus=$this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->assigned_bus; ?>
										<?php 
										if($assigned_bus == $row2['bus_Id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                     </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="age"  id="age_val"  value="<?php echo $row['age'];?>">
						</div>
					</div>					

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Date_Of_Birth');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="DOB" value="<?php echo $row['DOB'];?>" data-start-view="2">
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('place_of_birth');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="place_of_birth"  value="<?php echo $row['place_of_birth'];?>">
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_tongue');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_tongue"  value="<?php echo $row['mother_tongue'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('languages_known');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="languages_known"  value="<?php echo $row['languages_known'];?>">
						</div>
					</div>	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_name"  value="<?php echo $row['father_name'];?>">
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_occupation"  value="<?php echo $row['father_occupation'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_name"  value="<?php echo $row['mother_name'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_occupation"  value="<?php echo $row['mother_occupation'];?>">
						</div>
					</div>

					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_name" id="spouse_name"  value="<?php echo $row['spouse_name'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('spouse_occupation');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="spouse_occupation" id="spouse_occupation"  value="<?php echo $row['spouse_occupation'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('family_members_living_with_you');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="family_members_living_with"  value="<?php echo $row['family_members_living_with'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('extra_curriculur_activities');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="extra_curriculur"  value="<?php echo $row['extra_curriculur'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('proefficient_in_sports');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="proefficient_sports"  value="<?php echo $row['proefficient_sports'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('social_activities');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="social_activities"  value="<?php echo $row['social_activities'];?>">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('computer_knowledge_you_have');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="computer_knowledge_details"  value="<?php echo $row['computer_knowledge_details'];?>">
						</div>
					</div>	
					

                            
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_teacher');?></button>
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