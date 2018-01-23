<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('new_broadcast');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/broadcasts/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
						<div class="col-sm-6">
							<select name="class_id" class="form-control selectboxit" style="width:100%;"
								onchange="return get_class_section_subject(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								<option value=""><?php echo get_phrase('select_class');?></option>
								<?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
								?>
									<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>

					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                        <div class="col-sm-6">
							<select name="section_id" class="form-control " style="width:100%;" id="section_holder"data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
		                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                    </select>                            
                        </div>
                    </div>
					<div class="form-group">

						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('message');?></label>
						<div class="col-sm-5">
							<textarea  id="message" class="form-control" name="message" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="" />
							</div>

					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default"><?php echo get_phrase('send');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
			success: function(response)
			{				
                jQuery('#section_holder').html(response);
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
			success: function(response)
			{				
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>