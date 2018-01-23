
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('upload_academic_syllabus');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/upload_academic_syllabus' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
                ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                <div class="col-sm-5">
                    <select name="class_id" class="form-control select2"  data-validate="required" data-message-required="<?php echo get_phrase('required');?>" style="width:100%;"
                        onchange="return get_class_section_subject(this.value)">
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
            <div id="section_subject_selection_holder"></div>
                   

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                        <div class="col-sm-5">
                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                                data-validate="required" data-message-required="<?php echo get_phrase('required');?>"/>
                        </div>
                    </div>

            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('upload_syllabus');?>
                            </button>
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
            url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>
