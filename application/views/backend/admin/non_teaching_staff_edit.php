<?php 
	$edit_data	=	$this->db->get_where('non_teaching_staff' , array(
		'staff_id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_non_teaching_staff');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/non_teaching_staff/edit/' . $row['staff_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
							value="<?php echo $row['name'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="mobile" data-validate="" value="<?php echo $row['mobile'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="" value="<?php echo $row['name'];?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="email" data-validate="" value="<?php echo $row['email'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_number');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="iqama_number" data-validate="" value="<?php echo $row['iqama_number'];?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="qualification" data-validate="" value="<?php echo $row['qualification'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="experience" data-validate="" value="<?php echo $row['experience'];?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('basic_salary');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="basic_salary" data-validate="" value="<?php echo $row['basic_salary'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_salary');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="total_salary" data-validate="" value="<?php echo $row['total_salary'];?>" >
						</div>
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('assign_bus');?></label>
                        <div class="col-sm-5">
                            <select name="assigned_bus" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                               $bus_details = $this->db->get('bus_details')->result_array();
                                foreach($bus_details as $row2):
                                ?>
                                    <option value="<?php echo $row2['bus_Id'];?>"
                                        <?php if($row['assigned_bus'] == $row2['bus_Id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                     </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('staff_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
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