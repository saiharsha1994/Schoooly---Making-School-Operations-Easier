<?php 	
	$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');
	
	/*$term_from_month = array(01=>'January', 02=>'Febraury', 03=>'March', 04=>'April', 05=>'May', 06=>'June', 07=>'July', 08=>'August', 09=>'September', 10=>'October', 11=>'November', 12=>'December');
	$term_to_month = array(01=>'January', 02=>'Febraury', 03=>'March', 04=>'April', 05=>'May', 06=>'June', 07=>'July', 08=>'August', 09=>'September', 10=>'October', 11=>'November', 12=>'December');*/
	
	$term_from_month = array(1=>'January', 2=>'Febraury', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
	$term_to_month = array(1=>'January', 2=>'Febraury', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
				
	$edit_data	=	$this->db->get_where('fees_details' , array(
		'fees_id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_fees');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/fees_details/edit/' . $row['fees_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['fees_name'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-6">							
							<select name="class_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
	                            <option value=""><?php echo get_phrase('select_class');?></option>
	                            <?php  $classes = $this->db->get('class')->result_array();
								foreach ($classes as $row2): ?>								
	                            <option value="<?php echo $row2['class_id'];?>" <?php if($row['class_id']==$row2['class_id'])echo 'selected';?> ><?php echo $row2['name'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="fees_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['fees_amount'];?>">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_month');?></label>
                        
						<div class="col-sm-6">							
							<select name="from_month" class="form-control "  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
	                            <option value=""><?php echo get_phrase('select_from_month');?></option>
	                            <?php  foreach ($term_from_month as $key=>$val): ?>
	                            <option value="<?php echo $key;?>" <?php if($row['start_month']==$key)echo 'selected';?>><?php echo $val;?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_month');?></label>
                        
						<div class="col-sm-6">							
							<select name="to_month" class="form-control " data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
	                            <option value=""><?php echo get_phrase('select_to_month');?></option>
	                            <?php  foreach ($term_to_month as $key=>$val): ?>
	                            <option value="<?php echo $key;?>" <?php if($row['end_month']==$key)echo 'selected';?>><?php echo $val;?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_term" class="form-control " data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
	                            <option value=""><?php echo get_phrase('select_term');?></option>
	                            <?php  foreach ($term_arr as $key=>$val): ?>
	                            <option value="<?php echo $key;?>" <?php if($row['fees_term']==$key)echo 'selected';?>><?php echo $val;?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
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