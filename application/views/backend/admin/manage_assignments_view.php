<hr />

<?php echo form_open(base_url() . 'index.php?admin/manage_assignments/edit/');?>
<div class="row">

		<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
		<select name="class_id" class="form-control selectboxit" onchange="return get_class_sections(this.value)">
	        <option value=""><?php echo get_phrase('select_class');?></option>
	        <?php  $classes = $this->db->get('class')->result_array();
			foreach ($classes as $row): ?>
	        <option value="<?php echo $row['class_id'];?>" <?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
	        <?php endforeach;?>	                               
	    </select>
		</div>	
	</div>	

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select name="section_id" class="form-control" style="width:100%;" id="section_selector_holder">
		        <?php  $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
			foreach ($sections as $row): ?>
	        <option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
	        <?php endforeach;?>	
			</select>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
			<select name="subject_id" class="form-control" style="width:100%;" id="subject_selector_holder">
		        <?php  $subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
			foreach ($subjects as $row): ?>
	        <option value="<?php echo $row['subject_id'];?>"><?php echo $row['name'];?></option>
	        <?php endforeach;?>	
			</select>
		</div>
	</div>	

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_assignments');?></button>
	</div>
</div>
<?php echo form_close();?>



<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-area"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('assignment_for_class');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?></h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('section');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #696969;">
				<?php echo get_phrase('subject');?> <?php echo $this->db->get_where('subject' , array('subject_id' => $section_id))->row()->name;?> 
			</h4>
			<!--<h4 style="color: #696969;">
				<?php echo date("d M Y" , $timestamp);?>
			</h4>	-->
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>

<div class="row">

	<div class="col-md-1"></div>

	<div class="col-md-10">

	<?php echo form_open();?>
		<div id="attendance_update">
			<div style="clear:both;"></div>
			<br>
			<table class="table table-bordered table-striped datatable" id="table-2">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center"><?php echo get_phrase('roll');?></th>
						<th class="text-center"><?php echo get_phrase('name');?></th>					
						<th class="text-center"><?php echo get_phrase('title');?></th>
						<th class="text-center"><?php echo get_phrase('description');?></th>
						<th class="text-center"><?php echo get_phrase('due_date');?></th>
						<th class="text-center"><?php echo get_phrase('added_on');?></th>
						<th class="text-center"><?php echo get_phrase('download');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;					
					if($class_id != '' && $section_id != '' && $subject_id != ''){
						$this->db->order_by("added_on", "desc");
						$assignment_ids = $this->db->get_where('assignment_teacher' , array(
							'class_id' => $class_id, 'section_id' => $section_id , 'subject_id' => $subject_id ))->result_array();
						$this->db->order_by("date_added", "desc");
						$enroll_list = $this->db->get_where('enroll' , array(
							'class_id' => $class_id, 'section_id' => $section_id , 'year' => $year ))->result_array();
						// print_r($enroll_list);
					}
					foreach($assignment_ids as $assign_val){
						$this->db->order_by("added_on", "desc");
						$assignment_list = $this->db->get_where('assignment_parent' , array(
							'assignment_id' => $assign_val['assignment_id'], 'subject_id' => $subject_id ))->result_array();
						$submit_arr = array();	
						foreach($assignment_list as $assign_list){
							$submit_arr [] = $assign_list['student_id']
				?>
					<tr>
						<td><?php echo $count++;?></td>
						<td>
							<?php echo $this->db->get_where('student', array('student_id'=>$assign_list['student_id']))->row()->student_code;?>
						</td>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $assign_list['student_id']))->row()->name;?>
						</td>
						<td>
							<?php echo $assign_val['title']; ?>
						</td>
						<td>
							<?php echo $assign_val['description']; ?>
						</td>
						<td>
							<?php echo $assign_val['due_date']; ?>
						</td>
						<td>
							<?php echo $assign_list['added_on']; ?>
						</td>
						<td>
							<a href="<?php echo base_url().'uploads/assignments_teacher/'.$assign_list['doc_url']; ?>" class="btn btn-blue btn-icon icon-left">
								<i class="entypo-download"></i>
								<?php echo get_phrase('download');?>
							</a>
						</td>
					</tr>
					<?php }
						foreach($enroll_list as $stud_list){
							if(!in_array($stud_list['student_id'],$submit_arr) ){
					?>
					<tr>
						<td><?php echo $count++;?></td>
						<td>
							<?php echo $this->db->get_where('student', array('student_id'=>$stud_list['student_id']))->row()->student_code;?>
						</td>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $stud_list['student_id']))->row()->name;?>
						</td>
						<td>
							<?php echo $assign_val['title']; ?>
						</td>
						<td>
							<?php echo $assign_val['description']; ?>
						</td>
						<td>
							<?php echo $assign_val['due_date']; ?>
						</td>
						<td>
							<?php echo 'NULL' ?>
						</td>
						<td>
							<button class="btn btn-danger btn-xs"><?php echo get_phrase('Pending');?></button>
						</td>
					</tr>
					<?php
							}	
						}
					}					
					?>
				</tbody>
			</table>
		</div>

		<?php echo form_close();?>

	</div>

	

</div>


<script type="text/javascript">

	function get_class_sections(class_id) {		
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
	
	jQuery(document).ready(function($)
	{
		var datatable = $("#table-2").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(2, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(2, true);
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
	});

</script>