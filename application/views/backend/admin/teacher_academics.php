<hr />
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/teachers_academics_add/');" 
	class="btn btn-primary pull-right">
	<i class="entypo-plus-circled"></i>
	<?php echo get_phrase('add_daily_syllabus');?>
</a> 
<br><br><br>

<div class="row">
	<div class="col-md-12">

		<div class="tabs-vertical-env">

			<ul class="nav tabs-vertical">
				<?php 
				//print_r($subj_arr);
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
					?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/teacher_academics/<?php echo $row['class_id'];?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('class');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
		</ul>

		<div class="tab-content">

			<div class="tab-pane active">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo get_phrase('title');?></th>
							<th><?php echo get_phrase('section');?></th>
							<th><?php echo get_phrase('subject');?></th>
							<th><?php echo get_phrase('teacher');?></th>								
							<th><?php echo get_phrase('date');?></th>
							<th><?php echo get_phrase('book_name');?></th>
							<th><?php echo get_phrase('option');?></th>
						</tr>
					</thead>
					<tbody>

						<?php
						$count    = 1;
						$this->db->select('*');
						$this->db->where('class_id',$class_id);
						$this->db->where('year',$running_year);
						$this->db->group_by('academic_id');
						$this->db->order_by('timestamp','desc');
						$query = $this->db->get('teacher_academics');
						if($query->result() == TRUE):
							foreach($query->result_array() as $row):
						/*	$syllabus = $this->db->get_where('teacher_academics' , array(
								'class_id' => $class_id , 'year' => $running_year
							))->result_array();	
							foreach ($syllabus as $row):  */
								?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $this->db->get_where('section' , array(
									'section_id' => $row['section_id'] , 'class_id' => $class_id
									))->row()->name;
									?>
								</td>
								<td><?php echo $this->db->get_where('subject' , array(
									'subject_id' => $row['subject_id'] , 'class_id' => $class_id
									))->row()->name;
									?>
								</td>
								<td><?php echo $this->db->get_where('employee_details' , array(
									'emp_id' => $row['teacher_id']))->row()->name;
									?>
								</td>							
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['book_name'], 0, 20);?><?php if(strlen($row['book_name']) > 20) echo '...';?>
								</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
											Action <span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-default pull-right" role="menu">
										<!-- SYLLABUS VIEW LINK -->
											<li>
												<a href="<?php echo base_url(); ?>index.php?admin/view_teacher_academics/<?php echo $row['academic_id'];?>">
													<i class="entypo-download"></i>
													<?php echo get_phrase('view');?>
												</a>
											</li>
											<li class="divider"></li>
											<!-- SYLLABUS EDIT LINK -->
											<li>
												<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_update_teacher_academics/<?php echo $row['academic_id'];?>');">
													<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
												</a>
											</li>
										</ul>
									</div>
								</td>


								<!-- <td align="center">
									<a class="btn btn-default btn-xs" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_teacher_academics/<?php echo $row['academic_id'];?>');"
										href="#">
										<i class="entypo-download"></i> <?php echo get_phrase('view');?>
									</a>
								</td> -->
							</tr>
						<?php endforeach;?>
					<?php endif; ?>	
				</tbody>
			</table>
		</div>

	</div>

</div>	

</div>
</div>