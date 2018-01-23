
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('upload_assignment_file');?>
            	</div>
            </div>
			<div class="panel-body">				
                <?php echo form_open(base_url() . 'index.php?parents/assignment_upload/'.$param2.'/'.$param3.'/'.$param4 , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
                ?>                   

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span style="font-size:18px;"><?php echo get_phrase('file'); ?> :</span></label>
                        <div class="col-sm-5">
                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                                data-validate="required" data-message-required="<?php echo get_phrase('required');?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info" name="Import">
                                <i class="entypo-upload"></i> <?php echo get_phrase('upload');?>
                            </button>
						</div>
					</div>
        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>