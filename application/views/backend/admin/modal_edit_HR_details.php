<?php 
$hr_info = $this->db->get_where('hr_details', array('hr_id' => $param2))->result_array();
foreach ($hr_info as $row) {
        //echo $row['reason'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_HR_details');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/hr_management/update/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

	                <input type="hidden" name="hiddenid" value="<?php echo $row['hr_id'] ?>">
                    <input type="hidden" name="iqamahidden" value="<?php echo $row['iqama_doc'] ?>">
                    <input type="hidden" name="passporthidden" value="<?php echo $row['passport_doc'] ?>">
                    <input type="hidden" name="photohidden" value="<?php echo $row['photo'] ?>">

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'] ?>" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        <div class="col-sm-6">
							<input type="number" class="form-control" name="mobile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['mobile'] ?>" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['email'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['password'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        <div class="col-sm-6">
							<input type="number" class="form-control" name="age" value="<?php echo $row['age']?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        <div class="col-sm-6">
							<select name="gender" id="gender" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Class">
                            <option id="none" style="font-size: 15px" value="">Select Gender</option>
                            <?php
                            if($row['sex']=='male'){
                             ?>
                            <option id="male" style="font-size: 15px" value="male" selected="true">Male</option>
                            <?php } 
                            else {
                            ?>
                            <option id="male" style="font-size: 15px" value="male">Male</option>
                            <?php }
                            if($row['sex']=='female'){
                             ?>
                            <option id="female" style="font-size: 15px" value="female" selected="true">Female</option>
                            <?php } 
                            else {
                            ?>
                            <option id="female" style="font-size: 15px" value="female">Female</option>
                            <?php } ?>
                            </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        <div class="col-sm-6">
							<textarea name="address" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" value="<?php echo $row['address'] ?>"><?php 
                            if($row['address']=='null'){

                            }
                            else{
                                echo $row['address'];
                            } ?></textarea>
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_contact');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="alternate_contact" value="<?php 
                            if($row['alternate_contact']=='null'){

                            }
                            else{
                                echo $row['alternate_contact'];
                            } ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="qualification" data-validate="" value="<?php 
                            if($row['qualification']=='null'){

                            }
                            else{
                                echo $row['qualification'];
                            } ?>">
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_No');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="iqama_no" data-validate="" value="<?php 
                            if($row['iqama_no']=='null'){

                            }
                            else{
                                echo $row['iqama_no'];
                            } ?>">
						</div>
					</div>	

					<div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('iqama_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" id="iqama_doc" name="iqama_doc" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                            <span id="iqamadocument"><?php 
                                if($row['iqama_doc']=="null"){
                                    echo "No Document";
                                }
                                else{
                                    echo $row['iqama_doc'];
                                }?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_applied_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="iqama_applied_on" class="form-control datepicker" data-format="D, dd MM yyyy"
                                placeholder="<?php echo get_phrase('select_date');?>" value="<?php 
                                if($row['iqama_applied_on']=='null'){

                                    }
                                else{
                                        echo date("d M, Y", strtotime($row['iqama_applied_on']));
                                    }?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_expire_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="iqama_expire_on" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                placeholder="<?php echo get_phrase('select_date');?>" value="<?php 
                                if($row['iqama_expire_on']=='null'){

                                }
                                else{
                                    echo date("d M, Y", strtotime($row['iqama_expire_on']));
                                }?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_No');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="passport_no" data-validate="" value="<?php 
                            if($row['passport_no']=='null'){

                            }
                            else{
                                echo $row['passport_no'];
                            } ?>">
						</div>
					</div>	

					<div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('passport_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" id="passport_doc" name="passport_doc" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                            <span id="passportdocument"><?php 
                                if($row['passport_doc']=="null"){
                                    echo "No Document";
                                }
                                else{
                                    echo $row['passport_doc'];
                                }?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_applied_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="passport_applied_on" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="<?php echo get_phrase('select_date');?>" value="<?php 
                            if($row['passport_applied_on']=='null'){

                            }
                            else{
                                echo date("d M, Y", strtotime($row['passport_applied_on']));
                            } ?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_expire_on'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" name="passport_expire_on" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="<?php echo get_phrase('select_date');?>" value="<?php 
                            if($row['passport_expire_on']=='null'){

                            }
                            else{
                                echo date("d M, Y", strtotime($row['passport_expire_on']));
                            } ?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        <div class="col-sm-5">
                            <input type="file" id="photo" name="photo" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                            <span id="photodocument"><?php 
                                if($row['photo']=="null"){
                                    echo "No Photo";
                                }
                                else{
                                    echo $row['photo'];
                                }?></span>
                        </div>
                    </div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Update_HR_details');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
    $("#iqama_doc").on('change',function(){
        $("#iqamadocument").html("");
    });
});
$(document).ready(function(){
    $("#passport_doc").on('change',function(){
        $("#passportdocument").html("");
    });
});
$(document).ready(function(){
    $("#photo").on('change',function(){
        $("#photodocument").html("");
    });
});    
</script>