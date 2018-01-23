<hr />

<?php echo form_open(base_url() . 'index.php?admin/attendance_selector/');?>
<div class="row">

	<div class="col-md-2 col-md-offset-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y" , $timestamp);?>"/>
		</div>
	</div>

	<?php
		$query = $this->db->get_where('section' , array('class_id' => $class_id));
		if($query->num_rows() > 0):
			$sections = $query->result_array();
	?>

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
				<?php foreach($sections as $row):?>
					<option value="<?php echo $row['section_id'];?>"
						<?php if($section_id == $row['section_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<?php endif;?>
	<input type="hidden" name="class_id" value="<?php echo $class_id;?>">
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_attendance');?></button>
	</div>
	
	<div class="col-md-3" style="margin-top: 20px;">
		<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_minimum_attendance/<?php echo $class_id?>');" 

    class="btn btn-primary" >

    <i class="e"></i>

    <?php echo get_phrase('set_attendance_percentage');?>

</a> 
	</div>

</div>
<?php echo form_close();?>






<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-area"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('attendance_for_class');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?></h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('section');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #696969;">
				<?php echo date("d M Y" , $timestamp);?>
			</h4>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>

<div class="row">

	<div class="col-md-2"></div>

	<div class="col-md-8">

	<?php echo form_open(base_url() . 'index.php?admin/attendance_update/'.$class_id.'/'.$section_id.'/'.$timestamp);?>
		<div id="attendance_update">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo get_phrase('roll');?></th>
						<th class="text-center"><?php echo get_phrase('name');?></th>
					<!--	<th><?php echo get_phrase('status');?></th>  -->
						<th class="text-center"><?php echo get_phrase('status_in');?></th>
						<th class="text-center"><?php echo get_phrase('status_out');?></th>
						<th class="col-md-2 text-center"><?php echo get_phrase('bus_attendance');?></th>
						<th class="col-md-2 text-center"><?php echo get_phrase('attendance_percentage');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					if($section_id != ''){
						$attendance_of_students = $this->db->get_where('attendance' , array(
							'class_id' => $class_id, 'section_id' => $section_id , 'year' => $running_year,'timestamp'=>$timestamp
						))->result_array();
					}
					foreach($attendance_of_students as $row):
				?>
					<tr>
						<td><?php echo $count++;?></td>
						<td>
							<?php echo $this->db->get_where('student', array('student_id'=>$row['student_id']))->row()->student_code;?>
						</td>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
						<!--	<select class="form-control selectboxit" name="status_<?php echo $row['attendance_id'];?>">
								<option value="0" <?php if($row['status'] == 0) echo 'selected';?>><?php echo get_phrase('undefined');?></option>
								<option value="1" <?php if($row['status'] == 1) echo 'selected';?>><?php echo get_phrase('present');?></option>
								<option value="2" <?php if($row['status'] == 2) echo 'selected';?>><?php echo get_phrase('absent');?></option>
							</select>	-->
							<input type="checkbox" class="form-control" name="in_status_<?php echo $row['attendance_id'];?>" <?php echo ($row['In_Status'] == 1 ? 'checked' : '2');?>>
						</td>
						<td>
							<input type="checkbox" class="form-control" name="out_status_<?php echo $row['attendance_id'];?>" <?php echo ($row['Out_Status'] == 1 ? 'checked' : '2');?>>
						</td>
						<td align="center">
							<!-- <img src="<?php echo $this->crud_model->get_att_image_url('grayradiolist.png')?>"  /> -->
							<?php
							$d=date("Y-m-d",$timestamp); 
							$status=$this->db->get_where('attendance_driver', array('student_id'=>$row['student_id'],'att_date'=>$d,'trip_type'=>'1'));
							if($status->num_rows()>0)
							{
								foreach ($status->result_array() as $row2) {
									if($row2['in_status']=='1'){?>
										<img src="<?php echo $this->crud_model->get_att_image_url('greenradiolist.png')?>"/>
									<?php }
									else if($row2['in_status']=='2'){?>
										<img src="<?php echo $this->crud_model->get_att_image_url('redradiolist.png')?>"/>
									<?php }
									else{?>
										<img src="<?php echo $this->crud_model->get_att_image_url('grayradiolist.png')?>"/>
									<?php }
								} 
							}
							else{?>
								<img src="<?php echo $this->crud_model->get_att_image_url('grayradiolist.png')?>"/>
							<?php } ?>

						</td>
						
							<?php
							$id=$row['student_id']; 
							$query = $this->db->query("SELECT * FROM semester WHERE '$d' >= start_date AND '$d' <= end_date"); 
							if($query->num_rows()>0){
								foreach ($query->result_array() as $row2 ) {
									$st=$row2['start_date'];
									$et=$row2['end_date'];
								}
							}
							$query2 = $this->db->query("SELECT * FROM attendance WHERE student_id = '$id' AND att_date >= '$st' AND att_date <= '$et' AND status = '1'"); 
							if($query2->num_rows()>0){
								$num_days=$query2->num_rows();
							}
							$query3 = $this->db->query("SELECT * FROM attendance WHERE student_id = '$id' AND att_date >= '$st' AND att_date <= '$et' AND status = '1' AND In_Status = '1' "); 
							$num_present=$query3->num_rows();
							$p= ($num_present/$num_days)*100;
							$min = $this->db->get_where('settings' , array('type' => 'attendance_percentage'))->row()->description;
							$per=round($p,2).'%';
							if($p>=$min){
								?>
						<td align="center" style="color: #00AD5E;">
						<?php echo $per; ?>
						</td>
						<?php } else {?>
							<td align="center" style="color: #df1a1a;">
						<?php echo $per; ?>
						</td>
						<?php } ?>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>

		<center>
			<button type="submit" class="btn btn-success" id="submit_button">
				<i class="entypo-check"></i> <?php echo get_phrase('save_changes');?>
			</button>
		</center>
		<?php echo form_close();?>

	</div>

	

</div>


<script type="text/javascript">




</script>