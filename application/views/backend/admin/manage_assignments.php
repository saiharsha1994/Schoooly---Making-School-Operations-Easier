<hr />

<?php echo form_open(base_url() . 'index.php?admin/manage_assignments/edit/');?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
		<select name="class_id" class="form-control selectboxit" onchange="return get_class_sections(this.value)">
	        <option value=""><?php echo get_phrase('select_class');?></option>
	        <?php  $classes = $this->db->get('class')->result_array();
			foreach ($classes as $row): ?>
	        <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	        <?php endforeach;?>	                               
	    </select>
		</div>	
	</div>	

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select name="section_id" class="form-control" style="width:100%;" id="section_selector_holder">
		        <option value=""><?php echo get_phrase('select_class_first');?></option>
			</select>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
			<select name="subject_id" class="form-control" style="width:100%;" id="subject_selector_holder">
		        <option value=""><?php echo get_phrase('select_class_first');?></option>			                        
			</select>
		</div>
	</div>	

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_assignments');?></button>
	</div>

</div>
<?php echo form_close();?>
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