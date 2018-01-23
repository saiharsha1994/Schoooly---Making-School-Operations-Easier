<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('reorder_inventory');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/ordered_inventory_receive/' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
						// Row count in the Table	
                ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('received_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" name="received_date" data-format="dd-mm-yyyy"
                            value="<?php echo date("d-m-Y");?>"/>
                        </div>
                    </div>     

                    
					
					<input type="hidden" class="form-control" name="id" value="<?php echo $param2;?>"/>
                    <input type="hidden" class="form-control" name="inventory_id" value="<?php echo $param3;?>"/>
					
            		<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('submit');?>
                            </button>
						</div>
					</div>
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
