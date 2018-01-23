<hr />
<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php?admin/approve_marks');?>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label"><?php echo get_phrase('class');?></label>
				<select name="class_id" class="form-control selectboxit">
					<option value=""><?php echo get_phrase('select_a_class');?></option>
					<?php 
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
						?>
					<option value="<?php echo $row['class_id'];?>"
						<?php if ($class_id == $row['class_id']) echo 'selected';?>>
						<?php echo $row['name'];?>
					</option>
					<?php
					endforeach;
					?>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label"><?php echo get_phrase('exam');?></label>
				<select name="exam_id" class="form-control selectboxit">
					<option value=""><?php echo get_phrase('select_an_exam');?></option>
					<?php 
					$exams = $this->db->get_where('exam_schedule' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
						?>
					<option value="<?php echo $row['_id'];?>"
						<?php if ($exam_id == $row['_id']) echo 'selected';?>>
						<?php echo $row['title'];?>
					</option>
					<?php
					endforeach;
					?>
				</select>
			</div>
		</div>
		<input type="hidden" name="operation" value="selection">
		<div class="col-md-4" style="margin-top: 20px;">
			<button type="submit" class="btn btn-info"><?php echo get_phrase('view_marksheet');?></button>
		</div>
		<?php echo form_close();?>
	</div>
</div>

<?php if ($class_id != '' && $exam_id != ''):
	$check=$this->db->get_where('mark' , array(
							'class_id' => $class_id , 
							'exam_id' => $exam_id ,  
							'year' => $running_year
							));
	if($check->num_rows()>0){?>

	<br>
	<?php echo form_open(base_url() . 'index.php?admin/approve_marks_update/'.$class_id.'/'.$exam_id);?>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" style="text-align: center;">
			<div class="tile-stats tile-gray">
				<div class="icon"><i class="entypo-docs"></i></div>
				<h3 style="color: #696969;">
					<?php
					$exam_name  = $this->db->get_where('exam_schedule' , array('_id' => $exam_id))->row()->title;
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					echo get_phrase('marksheet');
					?>
				</h3>
				<h4 style="color: #696969;">
					<?php echo get_phrase('class') . ' ' . $class_name;?> : <?php echo $exam_name;?>
				</h4>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>


	<hr />

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td style="text-align: center;">
							<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
						</td>
						<?php 
						$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
						foreach($subjects as $row):
							?>
						<td style="text-align: center;"><?php echo $row['name'];?></td>
					<?php endforeach;?>
					<td style="text-align: center;"><?php echo get_phrase('status');?></td>
					<td style="text-align: center;"><?php echo get_phrase('options');?></td>
				</tr>
			</thead>
			<tbody>
				<?php
				
				$students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
				$students2=$this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year));
				$no_st= $students2->num_rows();
				$no_ap=0;
				foreach($students as $row):

					
					$sta = 	$this->db->get_where('mark' , array(
							'class_id' => $class_id , 
							'exam_id' => $exam_id ,  
							'student_id' => $row['student_id'],
							'year' => $running_year
							))->row()->status;
				if($sta=='2'){
					$no_ap+=1;
				}
					?>
				<tr>
					<td style="text-align: center;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
					<?php
					$total_marks = 0;
					$total_grade_point = 0;  
					foreach($subjects as $row2):
						?>
					<td style="text-align: center;">
						<?php 
						$obtained_mark_query = 	$this->db->get_where('mark' , array(
							'class_id' => $class_id , 
							'exam_id' => $exam_id , 
							'subject_id' => $row2['subject_id'] , 
							'student_id' => $row['student_id'],
							'year' => $running_year
							));
						if ( $obtained_mark_query->num_rows() > 0) {
							$obtained_marks = $obtained_mark_query->row()->mark_obtained;
							$status=$obtained_mark_query->row()->status;
							$s='marks_obtained_'.$row['student_id'].'_'.$row2['subject_id'];
								//echo $obtained_marks;
							?>
							<input type="text" class="form-control"  <?php if($status=='2') echo 'readonly';?> name="marks_obtained_<?php echo $row['student_id'];?>_<?php echo $row2['subject_id'];?>"
							value="<?php echo $obtained_marks;?>">
							<?php } 
							

							?>
						</td>
					<?php endforeach;?>
					<td style="text-align: center;"><?php if($status==1)
						echo "Pending";
						else
							echo "Approved";
						?>
					</td>
					<td style="text-align: center;"><div class="btn-group">

						<a <?php if($status=='2') echo "onclick='return false'";?> href="<?php echo base_url();?>index.php?admin/approve_marks_status/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $row['student_id'];?>" 
							class="btn btn-default">
							<?php echo get_phrase('approve');?>
						</a>

					</div></td>
				</tr>

			<?php endforeach;?>

		</tbody>
	</table>
	<center>
		<button type="submit" <?php if($no_st==$no_ap) echo 'disabled';?> class="btn btn-info"><?php echo get_phrase('update_marks');?></button>
	</center>
</div>
</div>
<?php }
else
{echo '<script language="javascript">';
echo "window.onload = function () { alert('No Data Available') }";
echo '</script>';}?>
<?php endif;?>

<?php echo form_close();?>