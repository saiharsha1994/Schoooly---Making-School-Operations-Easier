
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_daily_syllabus');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/upload_teacher_academics' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
						// Row count in the Table
					$max_count = 200;	
                ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>                   
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
						<div class="col-sm-6">
							<select name="class_id" class="form-control selectboxit" style="width:100%;"
								onchange="return get_class_section_subject(this.value)">
								<option value=""><?php echo get_phrase('select_class');?></option>
								<?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
								?>
									<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>

					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                        <div class="col-sm-6">
							<select name="section_id" class="form-control " style="width:100%;" id="section_holder">
		                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                    </select>                            
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                        <div class="col-sm-6">
							<select name="subject_id" class="form-control " style="width:100%;" id="subject_holder">
		                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                    </select>                            
                        </div>
                    </div>

                    <!--<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
						<div class="col-sm-6">
							<select name="teacher_id" class="form-control selectboxit" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								 <option value=""><?php echo get_phrase('select_teacher');?></option> 
								<?php 
								$teachers = $this->db->get('teacher')->result_array();
								foreach($teachers as $row):
								?>
									<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>-->
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        
						<div class="col-sm-5">
							<select name="teacher_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$role_id=$this->db->get_where('hr_roles', array('role' => 'teacher'))->row()->id;
										
									$employees   =   $this->db->get('employee_details')->result_array();
									foreach($employees as $row){
										$exists=0;
										$role_arr = explode(',', $row['emp_type']);
										foreach ($role_arr as $role) {
											if($role!=''&&$role==$role_id){
												$exists=1;
											}
										}  
										if($exists==1){
											echo '<option value="' . $row['emp_id'] . '">' . $row['name'] . '</option>';
										}
									}
								?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('semester');?></label>
						<div class="col-sm-6">
							<select name="semester_id" class="form-control selectboxit" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								<!-- <option value=""><?php echo get_phrase('select_semester');?></option> -->
								<?php 
								$running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
								$ac_year_id 		=   $this->db->get_where('academic_year' , array('academic_year'=>$running_year))->row()->ac_id;
								$semesters = $this->db->get_where('semester',array('academic_year_id'=>$ac_year_id))->result_array();
								foreach($semesters as $row):
								?>
									<option value="<?php echo $row['_id'];?>"><?php echo $row['semester'];?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>


                   
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('book_name');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_name"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>                    
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
                        <table class="table table-bordered responsive">
							<thead>
								<tr>								
									<th><?php echo get_phrase('day');?></th>
									<th><?php echo get_phrase('start_page');?></th>
									<th><?php echo get_phrase('end_page');?></th>							
								</tr>
							</thead>
							<tbody>
								<?php
									$count=1;
									for($count=1;$count<=$max_count;$count++){ ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><input type="text" class="form-control" name="start_page<?php echo $count;?>"/></td>
										<td><input type="text" class="form-control" name="end_page<?php echo $count;?>"/></td>
									</tr>	
							<?php	}	
								?>
							</tbody>
                        </table>
						</div>                    
                    </div>                    
					<input type="hidden" class="form-control" name="max_count" value="<?php echo $max_count;?>"/>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('insert_daily_syllabus');?>
                            </button>
						</div>
					</div>
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
			success: function(response)
			{				
                jQuery('#section_holder').html(response);
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
			success: function(response)
			{				
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>
