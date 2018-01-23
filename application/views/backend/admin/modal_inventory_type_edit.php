<?php 
$edit_data		=	$this->db->get_where('inventory_type' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_inventory_type');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/edit_inventory_type/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('type_code');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="type_code" value="<?php echo $row['type_code'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
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

<?php
endforeach;
?>