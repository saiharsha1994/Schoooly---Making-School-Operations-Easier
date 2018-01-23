<?php 
$edit_data      =   $this->db->get_where('inventory_categories' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_inventory_category');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/edit_inventory_category/'.$row['id'] , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
						// Row count in the Table	
                ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_code');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="item_code" value="<?php echo $row['item_code'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('inventory_type');?></label>
                        <div class="col-sm-6">
                            <select name="inventory_type" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select_type');?></option>
                                <?php 
                                $inventory = $this->db->get('inventory_type')->result_array();
                                foreach($inventory as $row2):
                                ?>
                                    <option value="<?php echo $row2['id'];?>" <?php if($row2['id']==$row['type_id']) echo 'selected'?> ><?php echo $row2['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_name');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_description');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>         

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('suggested_quantity');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="suggested_quantity" value="<?php echo $row['suggested_quantity'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('reorder_trigger');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reorder_trigger" value="<?php echo $row['reorder_trigger'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('reorder_quantity');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reorder_quantity" value="<?php echo $row['reorder_quantity'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('current_stock');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="stock" value="<?php echo $row['stock'];?>"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>    
					
					

					
            		<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('update_inventory_category');?>
                            </button>
						</div>
					</div>
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php 
endforeach; ?>

