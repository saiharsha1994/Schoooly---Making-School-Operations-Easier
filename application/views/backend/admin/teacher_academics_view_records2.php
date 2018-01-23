
<?php 
$edit_data		=	$this->db->get_where('teacher_academics', array('academic_id' => $academic_id), 1, 0)->result_array();
foreach ( $edit_data as $row):
	$title = $row['title'];
$class_id = $row['class_id'];
$section_id = $row['section_id'];
$subject_id = $row['subject_id'];
$teacher_id = $row['teacher_id'];
$semester_id = $row['semester_id'];
$book_name = $row['book_name'];
$academic_id = $row['academic_id'];
endforeach;


$fd=date("Y-m-d",$from_date);
$td=date("Y-m-d",$to_date);



?>

<hr />

<?php echo form_open(base_url() . 'index.php?admin/view_teacher_academics_records/'.$academic_id);?>
<div class="row">

	<div class="col-sm-2 ">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('title');?></label>
			<input type="text" class="form-control input" name="title" style="margin-left: 10px;"
			data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $title;?>" disabled="disabled"/>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<?php 
			$c_name 		=   $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name;?>
			<input type="text" class="form-control input" name="class"
			data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $c_name;?>" disabled="disabled"/>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
			<?php 
			$sb_name 		=   $this->db->get_where('subject' , array('subject_id'=>$subject_id))->row()->name;?>
			<input type="text" class="form-control input" name="class"
			data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $sb_name;?>" disabled="disabled"/>    
		</div>
	</div>


	<div class="col-sm-2 ">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('year');?></label>
			<select name="year" id="year" class="form-control selectboxit" style="width:100%;" onchange="enablesubmit(this.value)" 
			>
			<option value="0"><?php echo get_phrase('year');?></option>
			<?php 
			$academic_year = $this->db->get('academic_year')->result_array();
			foreach($academic_year as $row):
				?>
			<option value="<?php echo $row['academic_year'];?>" ><?php echo $row['academic_year'];?>
			</option>

			<?php
			endforeach;
			?>
		</select>
	</div>
</div>
<div class="col-sm-2 ">
	<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('month');?></label>
		<select name="month" id="month" class="form-control selectboxit" style="width:100%;" onchange="enablesubmit_new(this.value)">
			<option value="0"><?php echo get_phrase('month');?></option>
			<option value="January">Jan</option>
			<option value="February">Feb</option>
			<option value="March">March</option>
			<option value="April">April</option>
			<option value="May">May</option>
			<option value="June">June</option>
			<option value="July">July</option>
			<option value="August">Aug</option>
			<option value="September">Sep</option>
			<option value="October">Oct</option>
			<option value="November">Nov</option>
			<option value="December">Dec</option>

		</select>
	</div>
</div>

<div class="col-sm-2 ">
	<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"></label>
		<button type="submit" disabled id="submit" class="btn btn-info form-control"><?php echo get_phrase('view_records');?></button>
	</div>
</div>


</div>
<?php echo form_close();?>

<hr/>
<div class="container">
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#home">Report</a></li>
	<li><a data-toggle="tab" href="#menu1">Chart_View</a></li>

</ul>

<div class="tab-content">
	<div id="home" class="tab-pane fade in active">
		<div class="row">

			<div class="form-group">
				<div style="margin-left: 15px; margin-right: 15px;">
					<table class="table table-bordered datatable" id="table_export">
						<thead>
							<tr>
								<th colspan="1"></th>
								<th colspan="2" style="text-align: center"><strong><?php echo get_phrase('assigned_pages');?></strong></th>
								<th colspan="2" style="text-align: center"><strong><?php echo get_phrase('completed_pages');?></strong></th>
								<th colspan="2"></th>
							</tr>
							<tr>
								<th align="center"><?php echo get_phrase('day');?></th>
								<th align="center"><?php echo get_phrase('start_page');?></th>
								<th align="center"><?php echo get_phrase('end_page');?></th>							
								<th align="center"><?php echo get_phrase('start_page');?></th>
								<th align="center"><?php echo get_phrase('end_page');?></th>							
								<th align="center"><?php echo get_phrase('completed_by');?></th>							
								<th align="center"><?php echo get_phrase('completed_on');?></th>
							</tr>							
						</thead>
						<tbody>
							<?php
							$arr['start_page_asign']=array();
							$arr['end_page_asign']=array();
							$arr['day_tracker']=array();
							$arr['start_page_complt']=array();
							$arr['end_page_cmplt']=array();

							$query = $this->db->query("SELECT * FROM teacher_academics WHERE class_id = $class_id AND academic_id = $academic_id AND completed_on>= '$fd'
								AND completed_on<='$td' ORDER BY day asc");
									// $this->db->select('*');
									// $this->db->where('class_id',$class_id);
									// $this->db->where('academic_id',$academic_id);
									// $this->db->where('completed_on>=','echo $fd');
									// $this->db->where('completed_on<=','echo $td');
									// //$this->db->group_by('academic_id');
									// $this->db->order_by('day','asc');
									// $query = $this->db->get('teacher_academics');
							if($query->result() == TRUE):									
								foreach($query->result_array() as $row):
									static $max_count = 0;
								?>	
								<tr>
									<td ><?php echo $row['day'];array_push($arr['day_tracker'], "Day".$row['day']); ?></td>
									<td ><?php echo $row['from_page'];array_push($arr['start_page_asign'], $row['from_page']);
										?></td>
										<td ><?php echo $row['to_page'];array_push($arr['end_page_asign'], $row['to_page']);
											?></td>	
											<td ><?php echo $row['completed_start_page'];array_push($arr['start_page_complt'],$row['completed_start_page']) ;?></td>
											<td ><?php echo $row['completed_end_page'];array_push($arr['end_page_cmplt'], $row['completed_end_page']) ;?></td>										
											<td ><?php echo $this->crud_model->get_teacher_name($row['complete_by']);?></td>										
											<td ><?php echo $row['completed_on'];?></td>										
										</tr>	
										<?php $max_count++; endforeach;?>
									<?php endif; ?>	
								</tbody>
							</table>
						</div>                    
					</div>         
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-sm-5">
							<button onclick="location.href='<?php echo base_url(); ?>index.php?admin/teacher_academics'" class="btn btn-info">
								<i class="entypo-back"></i> <?php echo get_phrase('close');?>
							</button>
						</div>
					</div>

	<!-- <a href="<?php echo base_url(); ?>index.php?admin/teacher_academics">
		<i class="entypo-doc"></i>
		<span><?php echo get_phrase('daily_syllabus'); ?></span>
	</a> -->
</div>

</div>

<div id="menu1" class="tab-panel fade">

	<div class="row">
	<div class="col-sm-12">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		var new_arr=new Array();
		var day_tracker =<?php echo json_encode($arr['day_tracker']);?>;
		var start_page_asign =<?php echo json_encode($arr['start_page_asign']);?>;
		var end_page_asign =<?php echo json_encode($arr['end_page_asign']);?>;
		var start_page_asign_new =<?php echo json_encode($arr['start_page_complt']);?>;
		var end_page_asign_new =<?php echo json_encode($arr['end_page_cmplt']);?>;


		var st1=['Day New','From Page','To Page'];
		new_arr.push(st1);
	
		for(var i=0;i<day_tracker.length;i++){
			
			var str2=[day_tracker[i]+"\nAssigned",start_page_asign[i],end_page_asign[i]];
			new_arr.push(str2);
			var str3=[day_tracker[i]+"\nCompleted",start_page_asign_new[i],end_page_asign_new[i]];
			new_arr.push(str3);

		}


		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);



		function drawChart() {

			var data = google.visualization.arrayToDataTable(new_arr);

var options = {
          title: 'Daily Syllabus',
          hAxis: {title: 'Day', titleTextStyle: {color: 'black'}},

           legend: { position: 'left'},
           
           
           
          width: data.getNumberOfRows() * 80,
          isStacked: true,
          
          vAxis: {minValue: 0}
        };

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>
	<div class="row">
<div class="col-sm-12">
      
      <button id="btnExport_chart" class="btn btn-info btn-md pull-right" style="margin: 5px"  onclick="printData_chart()">Print</button>
     </div>
</div>
	
	<table class="table table-responsive" id="table_chart" style="margin-top: 10px">
		<div id="columnchart_material" style="width: 100%; height: 500px;"></div>
		</table>

	
	
	</div>
	</div>



</div>
</div>
</div>
<script type="text/javascript">
	function enablesubmit(value){
		if(value==0){
			$('#month').data('selectBox-selectBoxIt').enable();
			document.getElementById("submit").disabled=true;
		}else{
			$('#month').data('selectBox-selectBoxIt').disable();
			document.getElementById("submit").disabled=false;
		}


	}
	function enablesubmit_new(value){
		if(value==0){
			$('#year').data('selectBox-selectBoxIt').enable();
			document.getElementById("submit").disabled=true;

		}else{
			$('#year').data('selectBox-selectBoxIt').disable();
			document.getElementById("submit").disabled=false;
		}


	}

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [

				{
					"sExtends": "xls",
					"mColumns": [0,1,2,3,4,5,6]
				},
				{
					"sExtends": "pdf",
					"mColumns": [0,1,2,3,4,5,6]
				},
				{
					"sExtends": "print",
					"fnSetText"    : "Press 'esc' to return",
					"fnClick": function (nButton, oConfig) {
						datatable.fnSetColumnVis(0, true);
						datatable.fnSetColumnVis(6, true);

						this.fnPrint( true, oConfig );

						window.print();

						$(window).keyup(function(e) {
							if (e.which == 27) {
								datatable.fnSetColumnVis(0, true);
								datatable.fnSetColumnVis(6, true);
							}
						});
					},

				},
				]
			},

		});

	});
 function printData_chart() {
    var a = document.getElementById("columnchart_material");
    newWin = window.open(""), newWin.document.write(a.outerHTML), newWin.print(), newWin.close()
}

</script>
<style type="text/css">
	
 .font-bold {
color: black;}
 .table-responsive 
{   
    
    overflow-x: scroll;   
    overflow-y: scroll;     
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
   
}

#columnchart_material {
 overflow-x: scroll; 
 overflow-y: hidden;     

}

#columnchart_material1 {
 overflow-x: scroll; 
 overflow-y: hidden;     

}
 </style>
</style>