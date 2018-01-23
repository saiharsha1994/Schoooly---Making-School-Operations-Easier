<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_fees_detail');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/fees_details/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
				$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');
				/*
				$term_from_month = array(01=>'January', 02=>'Febraury', 03=>'March', 04=>'April', 05=>'May', 06=>'June', 07=>'July', 08=>'August', 09=>'September', 10=>'October', 11=>'November', 12=>'December');
				$term_to_month = array(01=>'January', 02=>'Febraury', 03=>'March', 04=>'April', 05=>'May', 06=>'June', 07=>'July', 08=>'August', 09=>'September', 10=>'October', 11=>'November', 12=>'December');
				*/
				$term_from_month = array(1=>'January', 2=>'Febraury', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
				$term_to_month = array(1=>'January', 2=>'Febraury', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
				?>
				
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('semester');?></label>
                        
						<div class="col-sm-6">							
							<select name="semester_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
	                            <option value=""><?php echo get_phrase('select_semester');?></option>
	                            <?php  $classes = $this->db->get('semester')->result_array();
								foreach ($classes as $row): ?>
	                            <option value="<?php echo $row['_id'];?>"><?php echo $row['semester'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-6">							
							<select name="class_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
	                            <option value=""><?php echo get_phrase('select_class');?></option>
	                            <?php  $classes = $this->db->get('class')->result_array();
								foreach ($classes as $row): ?>
	                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="fees_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>
                        
						<div class="col-sm-6">							
							<input type="text" class="form-control datepicker" name="from_date" data-format="dd-mm-yyyy" value="" data-format="dd-mm-yyyy" data-start-view="2">
	                                            
	                        </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date');?></label>
                        
						<div class="col-sm-6">							
							<input type="text" class="form-control datepicker" name="to_date"  data-format="dd-mm-yyyy" value="" data-format="dd-mm-yyyy" data-start-view="2">
							
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_type" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
	                            <option value=""><?php echo get_phrase('select_type');?></option>
	                            <option value="1"><?php echo get_phrase('tution_fee');?></option>
	                            <option value="2"><?php echo get_phrase('other_fee');?></option>
	                            
	                                            
	                        </select>
						</div>
					</div>
					
					
										
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_fees_detail');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>