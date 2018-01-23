<div class="row">
	<div class="col-md-12">
		
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/inform_to_all/send/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('select_bus');?></label>
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('message');?></label>
                        <div class="col-sm-6">
							<textarea class="form-control" name="message" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus></textarea>
						</div>
					</div>

					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('send');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        
    </div>
</div>