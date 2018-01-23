<a href="javascript:;" class="btn btn-danger pull-right multi_option" id="multi_susp" style="display:none;">
<i class="entypo-bookmarks"></i>
<?php echo get_phrase('Suspendend');?>
</a>
<a href="javascript:;" class="btn btn-success pull-right multi_option" id="multi_admit" style="margin-right:10px;display:none;">
<i class="entypo-credit-card"></i>
<?php echo get_phrase('Fees Paid');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('Student');?></div></th>
            <th><div><?php echo get_phrase('Roll');?></div></th>
            <th><div><?php echo get_phrase('Class');?></div></th>
            <th><div><?php echo get_phrase('Fees Term');?></div></th>
            <th><div><?php echo get_phrase('Fees Amount');?></div></th>
			<th><div><?php echo get_phrase('Status');?></div></th>
			<th><div><input type="checkbox" id="checkAll"/>&nbsp<?php echo get_phrase('options');?></div></th>			
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	$this->db->where('year' , $running_year);
        	$pendingFee = $this->db->get('fees_pending')->result_array();
        	foreach ($pendingFee as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td>
				<?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?>
			</td>
			<td><?php echo $row['student_roll'];?></td>
            <td>
				<?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?>
			</td>
            <td>
            	<?php
					if ($row['fees_term'] == 1)
            			echo get_phrase('First Term');
            		if ($row['fees_term'] == 2)
            			echo get_phrase('Second Term');
            		if ($row['fees_term'] == 3)
            			echo get_phrase('Third Term');
					?>
			</td>
            <td><?php echo $row['fees_amount'];?></td>
			<td>
				<?php if($row['action_status'] == 2):?>
					<button class="btn btn-success btn-xs"><?php echo get_phrase('Fees Paid');?></button>
				<?php endif;?>
				<?php if($row['action_status'] == 3):?>
					<button class="btn btn-danger btn-xs"><?php echo get_phrase('Suspendend');?></button>
				<?php endif;?>
				<?php if($row['action_status'] == 1):?>
					<button class="btn btn-info btn-xs"><?php echo get_phrase('Open');?></button>
				<?php endif;?>
			</td>			
			<td>
				<input class="chk" type="checkbox" name="multidelcheck" value="<?php echo $row['pending_id'];?>">
            <!--    <div class="btn-group">
                    
					
					<?php if($row['action_status'] == 3):?>
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
						<ul class="dropdown-menu dropdown-default pull-right" role="menu">
							 
							<li>
								<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/fees_pending/update/<?php echo $row['pending_id'];?>');">
									<i class="entypo-trash"></i>
									<?php echo get_phrase('Fees Paid');?>
								</a>
							</li>
						</ul>
					<?php endif;?>
					<?php if($row['action_status'] == 2):?>
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        No Action <span class="caret"></span>
                    </button>
					<?php endif;?>
                </div>  -->
            </td>  
        </tr>
        <?php endforeach;?>
    </tbody>
</table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({
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
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(6, false);
							
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
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		/* Multi Delete Part */
		$("#checkAll").click(function () {
			$('.chk').prop('checked', this.checked);
			if($('.chk:checked').length > 0){
				$(".multi_option").show();
			}else{
				$(".multi_option").hide();
			}
		});
		$(".chk").click(function () {
			$("#checkAll").prop('checked', ($('.chk:checked').length == $('.chk').length) ? true : false);	
			if($('.chk:checked').length > 0){
				$(".multi_option").show();
			}else{
				$(".multi_option").hide();
			}
		});
		$("#multi_susp").click(function () {
			var res = confirm("Do you wanna suspend the students ?");
			if (res == true){
				var multi_id='';
				$('input[name="multidelcheck"]:checked').each(function() {
					multi_id = multi_id  + this.value + ',';					
				});
				var data = 'multi_id=' +multi_id+ '&act=multi_susp';
				console.log(data);
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/fees_pending_actions/multi_susp/' + multi_id ,
					success: function(response)
					{
						alert(response);
						location.reload();
					}
				});			
			}
		});	
		$("#multi_admit").click(function () {
			var res = confirm("Has the fees been Paid, Do you wanna readmit the students ?");
			if (res == true){
				var multi_id='';
				$('input[name="multidelcheck"]:checked').each(function() {
					multi_id = multi_id  + this.value + ',';					
				});
				var data = 'multi_id=' +multi_id+ '&act=multi_admit';
				console.log(data);
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/fees_pending_actions/multi_admit/' + multi_id ,
					success: function(response)
					{
						alert(response);
						location.reload();
					}
				});			
			}
		});	
	});
		
</script>

