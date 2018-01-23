<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_bus');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/manage_bus/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('route_name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('chassis_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="chassis_number" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('plate_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="plate_number" data-validate="" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fahas');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="fahas" data-validate="" value="">
						</div>
					</div>		
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bus_from');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="bus_from" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bus_to');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="bus_to" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
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