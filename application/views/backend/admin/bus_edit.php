<?php 
	$edit_data	=	$this->db->get_where('bus_details' , array(
		'bus_Id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_bus');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/manage_bus/edit/' . $row['bus_Id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('route_name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
							value="<?php echo $row['name'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('chassis_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="chassis_number" data-validate="" value="<?php echo $row['chassis_number'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('plate_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="plate_number" data-validate="" value="<?php echo $row['plate_number'];?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fahas');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="fahas" data-validate="" value="<?php echo $row['fahas'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bus_from');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="bus_from" data-validate="" value="<?php echo $row['bus_from'];?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bus_to');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="bus_to" data-validate="" value="<?php echo $row['bus_to'];?>" >
						</div>
					</div>

					
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>