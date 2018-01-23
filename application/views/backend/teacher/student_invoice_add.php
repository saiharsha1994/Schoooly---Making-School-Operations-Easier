<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('create_student_payment');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/student_invoice/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));	
				$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');
				?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-6">							
							<select name="class_id" class="form-control selectboxit"
	                                        	onchange="return get_class_sections(this.value)">
	                            <option value=""><?php echo get_phrase('select_class');?></option>
	                            <?php  $classes = $this->db->get('class')->result_array();
								foreach ($classes as $row): ?>
	                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
				<!--	<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-6">
		                        <select name="section_id" class="form-control" style="width:100%;" id="section_selector_holder" onchange="return get_class_students(this.value)">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div> -->
					<input type="hidden" class="form-control" name="class_id_hid" id="class_id_hid">
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<select name="stu_name" class="form-control" id="student_selection_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_term" class="form-control selectboxit" onchange="return get_class_fees(this.value)">
	                            <option value=""><?php echo get_phrase('select_term');?></option>
	                            <?php  foreach ($term_arr as $key=>$val): ?>
	                            <option value="<?php echo $key;?>"><?php echo $val;?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="fees_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo get_phrase('select_term_first');?>"  id="class_fees" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fine_amount');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="fine_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo get_phrase('select_term_first');?>"  id="class_fine" readonly>
						</div>
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-6">
                            <select name="method" class="form-control selectboxit">
                                <option value="1"><?php echo get_phrase('cash');?></option>
                                <option value="2"><?php echo get_phrase('cheque');?></option>
                                <option value="3"><?php echo get_phrase('card');?></option>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="description" value="" >
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
<script type="text/javascript">
    function get_class_students(section_id) {
		var class_id = jQuery('#class_id_hid').val();
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_sec_students/' + class_id + '/' + section_id  ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">

	function get_class_fees(term_val) {
		var class_id = jQuery('#class_id_hid').val();
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_fees/' + class_id + '/' + term_val,
            success: function(response)
            {                
                jQuery('#class_fees').val(response);
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_fine/' + class_id + '/' + term_val,
            success: function(response)
            {                
                jQuery('#class_fine').val(response);
            }
        }); 
	}	
	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
                jQuery('#class_id_hid').val(class_id);
            }
        });
    }

</script>