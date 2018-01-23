<div class="row">

	<div class="col-md-12">

		<div class="panel panel-primary" data-collapsed="0">

        	<div class="panel-heading">

            	<div class="panel-title">

            		<i class="entypo-plus-circled"></i>

					<?php echo get_phrase('add_additional_break');?>

            	</div>

            </div>

			<div class="panel-body">

				

                <?php echo form_open(base_url() . 'index.php?admin/additional_breaks/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    

					<div class="form-group">

                        <label class="col-sm-3 control-label"><?php echo get_phrase('academic_year');?></label>

                        <div class="col-sm-6">

                            <select name="academic_year_id" class="form-control select" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">

                                <option value=""><?php echo get_phrase('select_academic_year');?></option>

                                <?php 

                                	$academic_year = $this->db->get('academic_year')->result_array();

                                	foreach ($academic_year as $row):

                                ?>

                                <option value="<?php echo $row['academic_year'];?>"><?php echo $row['academic_year'];?></option>

                            <?php endforeach;?>

                            </select>

                        </div>

                    </div>

					<div class="form-group">

						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>

                        

						<div class="col-sm-5">

							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">

						</div>

					</div>

                    

					<div class="form-group">

						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('start_date');?></label>

                        

						<div class="col-sm-6">

                            <input type="text" class="datepicker form-control" name="from_date"

                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>

                        </div>

					</div>

					

					<div class="form-group">

						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('end_date');?></label>

                        

						<div class="col-sm-6">

                            <input type="text" class="datepicker form-control" name="to_date"

                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>

                        </div>

					</div>

					

                    

                    <div class="form-group">

						<div class="col-sm-offset-3 col-sm-5">

							<button type="submit" class="btn btn-default"><?php echo get_phrase('submit');?></button>

						</div>

					</div>

                <?php echo form_close();?>

            </div>

        </div>

    </div>

</div>