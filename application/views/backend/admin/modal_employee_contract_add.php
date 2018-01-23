<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('employee_contract');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/emp_contract/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('employee_contract');?></label>
                        <div class="col-sm-6">
                            <select name="emp_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select_employee');?></option>
                                <?php 
                                	$emp = $this->db->get('teacher')->result_array();
                                	foreach ($emp as $row):
                                ?>
                                <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('contract');?></label>
                        <div class="col-sm-6">
                            <select name="contract_type" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								<option value=""><?php echo get_phrase('select');?></option>
								<option value="full time"><?php echo get_phrase('full_time');?></option>
								<option value="part time"><?php echo get_phrase('part_time');?></option>
								<option value="intern"><?php echo get_phrase('intern');?></option>
							</select>
                        </div>
                    </div>
                    
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default"><?php echo get_phrase('submit');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>