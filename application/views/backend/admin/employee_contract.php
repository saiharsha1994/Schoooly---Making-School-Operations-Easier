<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_employee_contract_add/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_new');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>#</th>
            <th><div><?php echo get_phrase('employee');?></div></th>
            <th><div><?php echo get_phrase('role');?></div></th>
            <th><div><?php echo get_phrase('contract_type');?></div></th>
            <th><div><?php echo get_phrase('added_on');?></div></th>
			<th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			foreach($emp_contracts as $row):?>
				<tr>
					<td><?php echo $count++;?></td>
					<td><?php echo $this->db->get_where('teacher' , array('teacher_id' => $row['emp_id']))->row()->name;?></td>
                    <td><?php echo $this->db->get_where('hr_roles' , array('id' => $row['emp_type']))->row()->role;?></td>
                    <td><?php echo $row['contract_type'];?></td>
                    <td><?php echo date("d-m-Y h:m:s", strtotime($row['added_on']));?></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
								
								<!-- DELETION LINK -->
								<li>
									<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/emp_contract/delete/<?php echo $row['id'];?>');">
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
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
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
    });
        
</script>

