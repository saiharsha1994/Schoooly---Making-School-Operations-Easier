<?php 
$running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('create_schedule');?>
                </div>
            </div>
            <div class="panel-body">
                
                <?php echo form_open(base_url() . 'index.php?admin/exam_schedule/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('semester');?></label>
						<div class="col-sm-5">
							<select name="semester_id" class="form-control select2"  data-validate="required" data-message-required="<?php echo get_phrase('required');?>" style="width:100%;">
								<option value=""><?php echo get_phrase('select_semester');?></option>
								<?php 
									$this -> db -> select('ac_id');
									$this -> db -> from('academic_year');
									$this -> db -> where('academic_year', $running_year);
									$query2 = $this->db->get();
									$ac_id= $query2->row('ac_id');
									
									$this -> db -> select('*');	 
									$this -> db -> from('semester');
									$this -> db -> where('academic_year_id',$ac_id);
									$query = $this -> db -> get();
									print_r($query);
									foreach($query->result_array() as $row):
									?>
										<option value="<?php echo $row['_id'];?>"><?php echo $row['semester'];?></option>
									<?php endforeach;?>
							</select>
						</div>
					</div>
			
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="Title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                                value="">
                        </div>
                    </div>
                    <input type="hidden" name="runningear" value=<?php echo $running_year;?>>
                    <input type="hidden" name="admin_id" value=<?php echo $this->session->userdata('login_user_id');?>>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="From_Date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('to_date');?></label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="To_Date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div> 
                    
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default"><?php echo get_phrase('SUBMIT');?></button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>