
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/student_invoice_add/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('create_student_payment');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('invoice_code');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
			<th><div><?php echo get_phrase('term');?></div></th>
            <th><div><?php echo get_phrase('method');?></div></th>
			
            <th><div><?php echo get_phrase('amount');?></div></th>
			<th><div><?php echo get_phrase('description');?></div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
			<th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
			$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');			
        	$student_invoice = $this->db->get('fees_invoice')->result_array();
        	foreach ($student_invoice as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['invoice_code'];?></td>
            <td><?php echo $this->crud_model->get_student_det($row['student_id']);?></td>
            <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
			<td><?php echo $term_arr[$row['fees_term']];?></td>
            <td><?php 
					            		if ($row['paid_method'] == 1)
					            			echo get_phrase('cash');
					            		if ($row['paid_method'] == 2)
					            			echo get_phrase('cheque');
					            		if ($row['paid_method'] == 3)
					            			echo get_phrase('card');					                    
				?>
			</td>
            <td><?php $total = $row['total_fees_amount'] + $row['fine_amount'] ; echo $total;?></td>
			<td><?php echo $row['description'];?></td>
			<td><?php $mysqldate = strtotime( $row['paid_on'] ); $phpdate = date( 'd M,Y', $mysqldate ); echo $phpdate;?></td>
			
            <td align="center">
					            	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"
					            		class="btn btn-default">
					            			<?php echo get_phrase('view_invoice');?>
					            	</a>
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

