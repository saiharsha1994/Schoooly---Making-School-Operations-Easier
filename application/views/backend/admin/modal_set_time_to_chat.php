<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php?admin/set_time_to_chat' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
		<div class="form-group">
		<?php $chat_time=$this->db->get_where('settings', array('type' => 'chat_time'))->row()->description;
			if($chat_time!=''){
				$chat_time_arr=explode(",",$chat_time);
			}
			$start_time_arr=explode(":",$chat_time_arr[0]);
			$end_time_arr=explode(":",$chat_time_arr[1]);
			
			$start_hour=$start_time_arr[0];
			$start_min_arr=explode(" ",$start_time_arr[1]);
			$start_min=$start_min_arr[0];
			$start_ampm=$start_min_arr[1];
			
			$end_hour=$end_time_arr[0];
			$end_min_arr=explode(" ",$end_time_arr[1]);
			$end_min=$end_min_arr[0];
			$end_ampm=$end_min_arr[1];
			
			?>
			<label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
            <div class="col-sm-9">
				<div class="col-md-3">
					<select name="time_start" class="form-control selectboxit">
						<option value=""><?php echo get_phrase('hour');?></option>
						<?php for($i = 0; $i <= 12 ; $i++):?>
							<option value="<?php echo $i;?>" <?php if($i ==$start_hour)echo 'selected="selected"';?>>
                                        <?php echo sprintf("%02d", $i);?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-md-4">
					<select name="time_start_min" class="form-control selectboxit">
						<option value=""><?php echo get_phrase('minutes');?></option>
						<?php for($i = 0; $i <= 11 ; $i++):?>
                            <option value="<?php echo $i * 5;?>" <?php if (($i * 5) == $start_min) echo 'selected';?>><?php echo sprintf("%02d", $i*5);?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-md-3">
					<select name="starting_ampm" class="form-control selectboxit">
						<option value="1" <?php if($start_ampm	==	'AM')echo 'selected="selected"';?>>am</option>
                        <option value="2" <?php if($start_ampm	==	'PM')echo 'selected="selected"';?>>pm</option>
                    </select>
				</div>
            </div>
        </div>
        <div class="form-group">

			<label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
				<div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_end" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
							<option value="<?php echo $i;?>" <?php if($i ==$end_hour)echo 'selected="selected"';?>>
                                        <?php echo sprintf("%02d", $i);?></option>
                        <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_end_min" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
							<<option value="<?php echo $i * 5;?>" <?php if (($i * 5) == $end_min) echo 'selected';?>><?php echo sprintf("%02d", $i*5);?></option>
                        <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="1" <?php if($end_ampm	==	'AM')echo 'selected="selected"';?>>am</option>
							<option value="2" <?php if($end_ampm	==	'PM')echo 'selected="selected"';?>>pm</option>
                        </select>
                    </div>
                </div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-info"><?php echo get_phrase('set_time');?></button>
				</div>
            </div>
		<?php echo form_close();?>
	</div>
</div>

