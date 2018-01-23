<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_HR');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/hr_management/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        <div class="col-sm-6">
							<input type="number" class="form-control" name="mobile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        <div class="col-sm-6">
							<input type="number" class="form-control" name="age" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        <div class="col-sm-6">
							<select name="gender" id="gender" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Class">
                            <option id="none" style="font-size: 15px" value="">Select Gender</option>
                            <option id="male" style="font-size: 15px" value="male">Male</option>
                            <option id="female" style="font-size: 15px" value="female">Female</option>
                  
                            </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        <div class="col-sm-6">
							<textarea name="address" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_contact');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="alternate_contact" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="qualification" data-validate="" value="">
						</div>
					</div>	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_No');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="iqama_no" data-validate="" value="">
						</div>
					</div>	

					<div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('iqama_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" name="iqama_doc" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_applied_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="iqama_applied_on" class="form-control datepicker" data-format="D, dd MM yyyy"
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('iqama_expire_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="iqama_expire_on" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_No');?></label>
                        <div class="col-sm-6">
							<input type="text" class="form-control" name="passport_no" data-validate="" value="">
						</div>
					</div>	

					<div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('passport_documents');?></label>
                        <div class="col-sm-5">
                            <input type="file" name="passport_doc" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_applied_on'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="passport_applied_on" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('passport_expire_on'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" name="passport_expire_on" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>

                    <div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        <div class="col-sm-5">
                            <input type="file" name="photo" multiple name="images[]" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                        </div>
                    </div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_new_HR');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>