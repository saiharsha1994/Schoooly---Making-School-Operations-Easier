<?php print "<link rel='stylesheet' href='assets/css/star.css'>"; ?>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_assignments');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/add_assignments/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
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
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-6">
		                        <select name="section_id" class="form-control" style="width:100%;" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
		                    <div class="col-sm-6">
		                        <select name="subject_id" class="form-control" style="width:100%;" id="subject_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="assign_title" id="assign_title">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="assign_desc" id="assign_desc">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Due_Date');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="due_date" value="" data-start-view="1">
						</div> 
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('assignment_file'); ?> </label>
                        <div class="col-sm-5">
                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                                data-validate="required" data-message-required="<?php echo get_phrase('required');?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info" name="Import">
                                <i class="entypo-upload"></i> <?php echo get_phrase('add_assignment');?>
                            </button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

	function get_class_sections(class_id) {		
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }	
	
</script>