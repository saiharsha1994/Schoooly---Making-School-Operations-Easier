<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_driver');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/manage_drivers/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('nationality');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="nationality" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="iqama_number" data-validate="" value="">
						</div>
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('iqama_expiry_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="iqama_expiry_date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="passport_number" data-validate="" value="">
						</div>
					</div>	

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('passport_expiry_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="passport_expiry_date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="mobile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
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
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_new_bus');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>