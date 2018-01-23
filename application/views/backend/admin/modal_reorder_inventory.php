<?php 
$edit_data      =   $this->db->get_where('inventory_categories', array('id' => $param2), 1, 0)->result_array();
foreach ( $edit_data as $row):
    $id = $row['id'];
    $item_code = $row['item_code'];
    $type_id = $row['type_id'];
    $name = $row['name'];
    $description = $row['description'];
    $suggested_quantity = $row['suggested_quantity'];
    $reorder_trigger = $row['reorder_trigger'];
    $reorder_quantity = $row['reorder_quantity'];
    $stock = $row['stock'];
endforeach;
?>


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
                
                <?php echo form_open(base_url() . 'index.php?admin/reorder_inventory_add/' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','method'=>'POST','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
                        // Row count in the Table   
                ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_code');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="item_code1" value="<?php echo $item_code?>" readonly
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_name');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name1" value="<?php echo $name?>" readonly
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_description');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description1" value="<?php echo $description?>" readonly
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>         

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('suggested_quantity');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="suggested_quantity" value="<?php echo $suggested_quantity?>" readonly
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        
   

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('reorder_quantity');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reorder_quantity" value="<?php echo $reorder_quantity?>" 
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('current_stock');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="stock" value="<?php echo $stock?>" readonly
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>    
                    
                    <input type="hidden" class="form-control" name="inventory_id" value="<?php echo $id;?>"/>
                    <input type="hidden" class="form-control" name="name" value="<?php echo $name;?>"/>
                    <input type="hidden" class="form-control" name="item_code" value="<?php echo $item_code;?>"/>
                    <input type="hidden" class="form-control" name="description" value="<?php echo $description;?>"/>
                    <input type="hidden" class="form-control" name="type_id" value="<?php echo $type_id;?>"/>

                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('reorder');?>
                            </button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

