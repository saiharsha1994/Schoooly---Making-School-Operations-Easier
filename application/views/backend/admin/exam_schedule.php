<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_create_schedule/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('create_schedule');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>#</th>
            <th><div><?php echo get_phrase('semeter');?></div></th>
            <th><div><?php echo get_phrase('title');?></div></th>
            <th><div><?php echo get_phrase('from_date');?></div></th>
            <th><div><?php echo get_phrase('to_date');?></div></th>
            <th><div><?php echo get_phrase('running_year');?></div></th>

            <th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('exam_schedule')->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $count++;?></td>
                    <td><?php echo $this->db->get_where('semester' , array('_id'=>$row['semester_id']))->row()->semester;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['from_date'];?></td>
                    <td><?php echo $row['to_date'];?></td>
                    <td><?php echo $row['year'];?></td>
					 
                    <td>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
								
								<!-- teacher DELETION LINK -->
								<li>
									<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam_schedule/delete/<?php echo $row['_id'];?>');">
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
                        "mColumns": [0,1,2,3,4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0,1,2,3,4]
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
                                      datatable.fnSetColumnVis(4, true);
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
