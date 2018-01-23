<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type=”text/css”>
		#test {
			width: 20%; 
			word-break: break-all;
			word-wrap: break-word;
		}
	</style>
</head>
<body>



	<hr />

	<?php echo form_open(base_url() . 'index.php?admin/pending_leaves_view/');?>
	<div class="row" >

		<div class="col-md-3 col-sm-offset-4" >
			<div class="form-group">
			<label class="control-label"><?php echo get_phrase('select_employee_role');?></label>
				<select name="role" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
					<option value=""><?php echo get_phrase('select_role');?></option>
					<?php 
					$hr = $this->db->get('hr_roles')->result_array();
					foreach($hr as $row):
						?>
					<option value="<?php echo $row['id'];?>" <?php if($role==$row['id']) echo 'selected';?> ><?php echo $row['role'];?></option>
					<?php
					endforeach;
					?>
				</select>
			</div>
		</div>

		<div class="col-md-3" style="margin-top: 20px;">
			<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_leave_requests');?></button>
		</div>

	</div>
	<?php echo form_close();?>


	<hr />

	<div class="row">



		<div style="margin-left: 15px; margin-right: 15px;">

			<!-- <?php echo form_open(base_url() . 'index.php?admin/attendance_update/'.$class_id.'/'.$section_id.'/'.$timestamp);?> -->
			<div id="pending_leaves_table">
				<table class="table table-bordered datatable table-striped">
					<thead>
						<tr>
							<th class="text-center col-md-1" style="font-weight: bold;"><?php echo get_phrase('ID');?></th>
							<th class="text-center col-md-3" style="font-weight: bold;"><?php echo get_phrase('name');?></th>
							<th class="text-center col-md-1" style="font-weight: bold;"><?php echo get_phrase('from_date');?></th>
							<th class="text-center col-md-1" style="font-weight: bold;"><?php echo get_phrase('to_date');?></th>
							<!--	<th><?php echo get_phrase('status');?></th>  -->
							<th class="text-center col-md-1" style="font-weight: bold;"><?php echo get_phrase('no._of_days');?></th>
							<th class="text-center col-md-4" style="font-weight: bold;"><?php echo get_phrase('reason');?></th>
							<th class="text-center col-md-1" style="font-weight: bold;"><?php echo get_phrase('options');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						$leaves = $this->db->get_where('leave_records' , array('user_type' => $role, 'status' =>"1"))->result_array();
						foreach($leaves as $row):
							?>
						<tr>
							<td align="center"><?php echo $row['student_id'];?></td>
							<td align="center">
								<?php 
								
								echo $this->db->get_where('employee_details', array('emp_id'=>$row['student_id']))->row()->name;?>
							</td>
							<td align="center">
								<?php echo date('d-m-Y',strtotime($row['from_date']));?>
							</td>
							<td align="center">
								<?php echo date('d-m-Y',strtotime($row['to_date']));?>
							</td>
							<td align="center">
								<?php echo $row['no_of_days'];?>
							</td>
							<td align="center">
								<?php echo $row['reason'];?>
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-default pull-right" role="menu">
										<!-- SYLLABUS VIEW LINK -->
										<li>
											<a href="<?php echo base_url();?>index.php?admin/update_leaves/<?php echo $row['id'];?>/approve/<?php echo $role;?>">
												<i class="entypo-download"></i>
												<?php echo get_phrase('approve');?>
											</a>
										</li>
										<li class="divider"></li>
										<!-- SYLLABUS EDIT LINK -->
										<li>
											<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_leave_reject_reason/<?php echo $row['id'];?>/<?php echo $role;?>');">
												<i class="entypo-pencil"></i>
												<?php echo get_phrase('reject');?>
											</a>
										</li>
									</ul>
								</div>
							</td>


						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>

		<center>
			<!-- <button type="submit" class="btn btn-success" id="submit_button">
				<i class="entypo-check"></i> <?php echo get_phrase('save_changes');?>
			</button> -->
		</center>
		<?php echo form_close();?>

	</div>

	

</div>

</body>
</html>