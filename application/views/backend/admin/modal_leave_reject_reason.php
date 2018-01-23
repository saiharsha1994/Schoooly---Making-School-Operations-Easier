<?php 
$leave_id = $param2;
$role = $param3;
// foreach ( $edit_data as $row):
// 	$title = $row['title'];
// 	$class_id = $row['class_id'];
// 	$section_id = $row['section_id'];
// 	$subject_id = $row['subject_id'];
// 	$teacher_id = $row['teacher_id'];
// 	$semester_id = $row['semester_id'];
// 	$book_name = $row['book_name'];
// 	$academic_id = $row['academic_id'];
// endforeach;
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('reject_leave');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/reject_leaves/'.$leave_id.'/'.$role , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
					//$max_count = 200;	
                ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('enter_reason');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reason"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>                   
					
				
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button class="btn btn-info" type="submit" );" >
                                <i class="entypo-upload"></i> <?php echo get_phrase('submit');?>
                            </button>
						</div>
					</div>    


        		<?php echo form_close();?>
            </div>
        </div>
    </div>
</div>