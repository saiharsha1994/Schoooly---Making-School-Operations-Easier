
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/non_teaching_staff_add/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_new_staff');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('mobile');?></div></th>
            <th><div><?php echo get_phrase('email');?></div></th>
            <th><div><?php echo get_phrase('iqama_number');?></div></th>
            <th><div><?php echo get_phrase('qualification');?></div></th>
			<th><div><?php echo get_phrase('experience');?></div></th>
			<th><div><?php echo get_phrase('basic_salary');?></div></th>
			<th><div><?php echo get_phrase('total_salary');?></div></th>
			<th><div><?php echo get_phrase('staff_documents');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
			$count = 1;
        	foreach ($non_teaching_staffs as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['mobile'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['iqama_number'];?></td>
            <td><?php echo $row['qualification'];?></td>
            <td><?php echo $row['experience'];?></td>
            <td><?php echo $row['basic_salary'];?></td>
            <td><?php echo $row['total_salary'];?></td>
			<td>
				<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/non_teaching_staff_docs/<?php echo $row['staff_id'];?>');">
					<i class="entypo-eye"></i>
					<?php echo get_phrase('documents');?>
				</a>
			</td>
            <td>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						<!-- EDITING LINK -->
                        <li>
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/non_teaching_staff_edit/<?php echo $row['staff_id'];?>');">
								<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
                            </a>
						</li>
                        <li class="divider"></li>
                        <!-- DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/non_teaching_staff/delete/<?php echo $row['staff_id'];?>');">
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
	});
		
</script>

