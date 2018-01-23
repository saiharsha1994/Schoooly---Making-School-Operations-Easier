
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_inventory_type');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/add_inventory_type' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
						// Row count in the Table	
                ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('type_code');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="type_code"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>         

                    
            		<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('create_inventory_type');?>
                            </button>
						</div>
					</div>
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>


