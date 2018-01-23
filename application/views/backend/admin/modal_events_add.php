<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_events');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/events/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('event_title');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="Event_Title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('event_date');?></label>
                        
						<div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="Event_Date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default"><?php echo get_phrase('add_event');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>