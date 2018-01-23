<hr />
<a href="<?php echo base_url();?>index.php?admin/add_employees"
	class="btn btn-primary pull-right">
	<i class="entypo-plus-circled"></i>
	<?php echo get_phrase('add_new_employee');?>
</a> 
<br>

<div class="row" style="margin-top: 10px;">
	<div class="col-md-12">

		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-users"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('all_employees');?></span>
				</a>
			</li>
			<?php 
			$query = $this->db->get('hr_roles');
			if ($query->num_rows() > 0):
				$roles = $query->result_array();
			foreach ($roles as $row):
				?>
			<li>
				<a href="#<?php echo $row['id'];?>" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs"><?php echo $row['role'];?> </span>
				</a>
			</li>
		<?php endforeach;?>
	<?php endif;?>
</ul>

<div class="tab-content" style="margin-top: 10px;">
	<div class="tab-pane active" id="home">

		<table class="table table-bordered datatable" id="table_export0" >
			<thead>
				<tr>
					<th class="col-md-1"><?php echo get_phrase('number');?></th>
					<th class="col-md-3"><?php echo get_phrase('name');?></th>
					<th class="col-md-2"><?php echo get_phrase('roles');?></th>
					<th class="col-md-1"><?php echo get_phrase('gender');?></th>
					<th class="col-md-2"><?php echo get_phrase('nationality');?></th>
					<th class="col-md-1"><?php echo get_phrase('family_status');?></th>
					<th class="col-md-1"><?php echo get_phrase('status');?></th>
					<th class="col-md-1"><?php echo get_phrase('options');?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$employees   =   $this->db->get('employee_details')->result_array();								
				foreach($employees as $row):?>
				<tr>
					<td><?php echo $row['emp_number'];?></td>

					<td><?php echo $row['name'];?></td>
					<!--//echo $this->crud_model->get_image_url('student',$row['student_id']);-->
					<td>
						<?php 
						$x = explode(',', $row['emp_type']);
						foreach ($x as $r) {
							if($r!=''){
								echo $this->db->get_where('hr_roles' , array(
									'id' => $r))->row()->role;
								echo nl2br("\n");
							}
						}  
						?>
					</td>
					<td>
						<?php 
						if($row['gender']=='M')
							echo get_phrase('Male');
						else
							echo get_phrase('Female'); 
						?>
					</td>
					<td>
						<?php 
						echo $row['nationality'];
						?>
					</td>
					<td>
						<?php 
						if($row['family_status']=='1')
							echo get_phrase('yes');
						else
							echo get_phrase('no'); 
						?>
					</td>
					<td>
						<?php 
						if($row['status']=='1')
							echo get_phrase('active');
						else if($row['status'=='2'])
							echo get_phrase('pending');
						else
							echo get_phrase('inactive'); 
						?>
					</td>
					<td>

						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">

								<!-- STUDENT PROFILE LINK -->
								<li>
									
									<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_employee_profile/<?php echo $row['emp_id'];?>');">
										<i class="entypo-user"></i>
										<?php echo get_phrase('profile');?>
									</a>
								</li>
								

								<!-- STUDENT EDITING LINK -->
								<li>
									<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_employee_edit/<?php echo $row['emp_id'];?>');">
									<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
								</a>
								</li>

								<!-- STUDENT DELETION LINK -->
							<li>
								
								<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_employees/<?php echo $row['emp_id'];?>');">
									<i class="entypo-trash"></i>
									<?php echo get_phrase('delete');?>
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
<?php 
$query = $this->db->get('hr_roles');
$i=1;
if ($query->num_rows() > 0):
	$roles = $query->result_array();
foreach ($roles as $row):
	?>
<div class="tab-pane" id="<?php echo $row['id'];?>">

	<table class="table table-bordered datatable" id='<?php echo 'table_export'.$i?>' >
		<?php $i=$i+1; ?>
		<thead>
			<tr>
				<th class="col-md-1"><b><?php echo get_phrase('number');?></b></th>
				<th class="col-md-3"><?php echo get_phrase('name');?></th>
				<th class="col-md-2"><?php echo get_phrase('roles');?></th>
				<th class="col-md-1"><?php echo get_phrase('gender');?></th>
				<th class="col-md-2"><?php echo get_phrase('nationality');?></th>
				<th class="col-md-1"><?php echo get_phrase('family_status');?></th>
				<th class="col-md-1"><?php echo get_phrase('status');?></th>
				<th class="col-md-1"><?php echo get_phrase('options');?></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$s = $row['id'];



			$employees   =   $this->db->get('employee_details')->result_array();

			foreach($employees as $row2){
				$exists=0;

				$x = explode(',', $row2['emp_type']);
				foreach ($x as $r) {
					if($r!=''&&$r==$s){
						$exists=1;
					}
				}  
				if($exists==1){?>
	
			<tr>
				<td><?php echo $row2['emp_number'];?></td>

				<td><?php echo $row2['name'];?></td>
				
				<td>
					<?php 
					$x = explode(',', $row2['emp_type']);
					foreach ($x as $r) {
						if($r!=''){
							echo $this->db->get_where('hr_roles' , array(
								'id' => $r))->row()->role;
							echo nl2br("\n");
						}
					}  
					?>
				</td>
				<td>
					<?php 
					if($row2['gender']=='M')
						echo get_phrase('Male');
					else
						echo get_phrase('Female'); 
					?>
				</td>
				<td>
					<?php 
					echo $row2['nationality'];
					?>
				</td>
				<td>
					<?php 
					if($row2['family_status']=='1')
						echo get_phrase('yes');
					else
						echo get_phrase('no'); 
					?>
				</td>
				<td>
					<?php 
					if($row2['status']=='1')
						echo get_phrase('active');
					else if($row2['status'=='2'])
						echo get_phrase('pending');
					else
						echo get_phrase('inactive'); 
					?>
				</td>
				<td>

					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							Action <span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-default pull-right" role="menu">

							
							<li>
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_employee_profile/<?php echo $row2['emp_id'];?>');">
										<i class="entypo-user"></i>
										<?php echo get_phrase('profile');?>
									</a>
							</li>
							
							

							
							<li>
								
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_employee_edit/<?php echo $row2['emp_id'];?>');">
									<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
								</a>
							</li>

							
							<li>
								
								<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_employees/<?php echo $row2['emp_id'];?>');">
									<i class="entypo-trash"></i>
									<?php echo get_phrase('delete');?>
								</a>
							</li>
						</ul>
					</div>

				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

</div>
<?php endforeach;?>
<?php endif;?>

</div>


</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">


	jQuery(document).ready(function($)
	{
		
		$.ajax({
			url: '<?php echo base_url();?>index.php?admin/get_roles' ,
			success: function(response)
			{				
				var z = response;

				for(var i=0;i<=z;i++)
				{
					var x2 = "#table_export"+i;

					var datatable = $(x2).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
						"oTableTools": {
							"aButtons": [

							{
								"sExtends": "xls",
								"mColumns": [0, 2, 3, 4]
							},
							{
								"sExtends": "pdf",
								"mColumns": [0, 2, 3, 4]
							},
							{
								"sExtends": "print",
								"fnSetText"	   : "Press 'esc' to return",
								"fnClick": function (nButton, oConfig) {
									datatable.fnSetColumnVis(1, false);
									datatable.fnSetColumnVis(5, false);

									this.fnPrint( true, oConfig );

									window.print();

									$(window).keyup(function(e) {
										if (e.which == 27) {
											datatable.fnSetColumnVis(1, true);
											datatable.fnSetColumnVis(5, true);
										}
									});
								},

							},
							]
						},

					});

					$(".dataTables_wrapper select").select2({
						minimumResultsForSearch: -1
					});
				}

			}
		});
		
	});

</script>