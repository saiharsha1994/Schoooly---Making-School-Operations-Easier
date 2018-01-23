<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>#</th>
            <th><div><?php echo get_phrase('event_title');?></div></th>
            <th><div><?php echo get_phrase('event_date');?></div></th>
            <th><div><?php echo get_phrase('event_addedOn');?></div></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('app_event' )->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $count++;?></td>
                    <td><?php echo $row['Event_Title'];?></td>
                    <td><?php echo Date('m/d/Y',strtotime($row['Event_Date']));?></td>
                    <td><?php echo $row['Event_AddedOn'];?></td>
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

