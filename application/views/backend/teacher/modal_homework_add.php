<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_homework');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?teacher/homework/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="Title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="Description" 
                            	value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Due_Date');?></label>
                        
						<div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="Due_Date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-5">
		                        <select name="section_id" class="form-control" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
		                    <div class="col-sm-5">
		                        <select name="subject_id" class="form-control" id="subject_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default"><?php echo get_phrase('add_homework');?></button>
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