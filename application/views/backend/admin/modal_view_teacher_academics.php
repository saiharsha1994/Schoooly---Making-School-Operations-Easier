<?php 
$edit_data		=	$this->db->get_where('teacher_academics', array('academic_id' => $param2), 1, 0)->result_array();
foreach ( $edit_data as $row):
	$title = $row['title'];
	$class_id = $row['class_id'];
	$section_id = $row['section_id'];
	$subject_id = $row['subject_id'];
	$teacher_id = $row['teacher_id'];
	$semester_id = $row['semester_id'];
	$book_name = $row['book_name'];
	$academic_id = $row['academic_id'];
endforeach;
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('view_teachers_academics');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/upload_teacher_academics' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
					//$max_count = 200;	
                ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $title;?>"/>
                        </div>
                    </div>                   
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
						<div class="col-sm-5">
							<select name="class_id" class="form-control selectboxit" style="width:100%;"
								onchange="return get_class_section_subject(this.value)">
								<option value=""><?php echo get_phrase('select_class');?></option>
								<?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
								?>
									<option value="<?php echo $row['class_id'];?>" <?php if($row['class_id'] == $class_id) echo 'selected';?>><?php echo $row['name'];?></option>
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
		                        <option value=""><?php echo get_phrase('select_section');?></option>
		                         <?php
                              	$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                              	foreach($sections as $row2):
                              ?>
                              <option value="<?php echo $row2['section_id'];?>"
                              	<?php if($section_id == $row2['section_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
								<?php endforeach;?>           	
		                    </select>                            
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                        <div class="col-sm-6">
							<select name="subject_id" class="form-control " style="width:100%;" id="subject_holder">
		                        <option value=""><?php echo get_phrase('select_subject');?></option>
		                         <?php
                              	$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                              	foreach($subjects as $row2):
                              ?>
                              <option value="<?php echo $row2['subject_id'];?>"
                              	<?php if($subject_id == $row2['subject_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
								<?php endforeach;?>             	
		                    </select>                            
                        </div>
                    </div>

                    <div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
						<div class="col-sm-6">
							<select name="teacher_id" class="form-control selectboxit" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								<!-- <option value=""><?php echo get_phrase('select_teacher');?></option> -->
								<?php 
								$teachers = $this->db->get('teacher')->result_array();
								foreach($teachers as $row):
								?>
									<option value="<?php echo $row['teacher_id'];?>" <?php if($row['teacher_id'] == $teacher_id) echo 'selected';?>><?php echo $row['name'];?></option>
								<?php
								endforeach;
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
									<option value="<?php echo $row['_id'];?>" <?php if($row['_id'] == $semester_id) echo 'selected';?>><?php echo $row['semester'];?></option>
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
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $book_name;?>"/>
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
									<th><?php echo get_phrase('complete_by');?></th>							
									<th><?php echo get_phrase('completed_on');?></th>							
								</tr>
							</thead>
							<tbody>
								<?php
									$this->db->select('*');
									$this->db->where('class_id',$class_id);
									$this->db->where('academic_id',$academic_id);
									//$this->db->group_by('academic_id');
									$this->db->order_by('day','asc');
									$query = $this->db->get('teacher_academics');
									if($query->result() == TRUE):									
									 foreach($query->result_array() as $row):
										static $max_count = 0;
								?>	
									<tr>
										<td><?php echo $row['day'];?></td>
										<td><?php echo $row['from_page'];?></td>
										<td><?php echo $row['to_page'];?></td>										
										<td><?php echo $row['complete_by'];?></td>										
										<td><?php echo $row['completed_on'];?></td>										
									</tr>	
							<?php $max_count++; endforeach;?>
							<?php endif; ?>	
							</tbody>
                        </table>
						</div>                    
                    </div>                    
					<input type="hidden" class="form-control" name="max_count" value="<?php echo $max_count;?>"/>            		
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>