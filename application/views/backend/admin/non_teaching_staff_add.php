<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_staff');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/non_teaching_staff/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="mobile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="email" data-validate="" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="iqama_number" data-validate="" value="">
						</div>
					</div>		
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="qualification" data-validate="" value="">
						</div>
					</div>					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="experience" data-validate="" value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('basic_salary');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="basic_salary" data-validate="" value="">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_salary');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="total_salary" data-validate="" value="">
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
                       <label class="col-sm-3 control-label"><?php echo get_phrase('staff_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                        </div>
                    </div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_new_staff');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>