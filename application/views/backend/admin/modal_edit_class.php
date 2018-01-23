<?php 
$edit_data		=	$this->db->get_where('class' , array('class_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
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
				
                <?php echo form_open(base_url() . 'index.php?admin/classes/do_update/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('numeric_name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name_numeric" value="<?php echo $row['name_numeric'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select');?></option>
                                
								<?php 
								$role_id=$this->db->get_where('hr_roles', array('role' => 'teacher'))->row()->id;
								$employees   =   $this->db->get('employee_details')->result_array();
								foreach($employees as $row2){
									$exists=0;
									$x = explode(',', $row2['emp_type']);
									foreach ($x as $r) {
										if($r!=''&&$r==$role_id){
											$exists=1;
										}
									}  
									if($exists==1){?>
										<option value="<?php echo $row2['emp_id']; ?>"
											<?php if($row['teacher_id'] == $row2['emp_id'])echo 'selected';?>>
											<?php echo $row2['name'];?></option>
								<?php }
								}?>
                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_class');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


