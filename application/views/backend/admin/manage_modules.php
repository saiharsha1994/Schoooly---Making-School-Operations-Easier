<?php $hr_info = $this->db->get('hr_roles')->result_array();
      $module_info = $this->db->get('modules_list')->result_array();
?>

<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th class="col-md-1"><div>#</div></th>
            <th class="col-md-3"><div><?php echo get_phrase('role');?></div></th>
            <th class="col-md-7"><div><?php echo get_phrase('modules');?></div></th>
            <th class="col-md-1"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>

    	<?php
        $count = 1;
        foreach ($hr_info as $row) { ?>   
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $row['role']; ?></td>    
            <td><?php 
            $first=0;
            $listofnumbers=explode(',', $row['modules']);
            foreach ($listofnumbers as $rownumber){
                foreach ($module_info as $modulenumber) {
                    if($modulenumber['_id']==$rownumber){
                        if($first==0){
                            $first=1;
                            echo $modulenumber['name'];
                            break;
                        }
                        else{
                            echo ", ",$modulenumber['name'];
                            break;
                        }
                    }
                }
            }?></td>
            <td class="col-md-2">

                        <div class="btn-group">

                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">

                                Action <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                <li>

                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_assign_modules/<?php echo $row['id'];?>');">

                                        <i class="entypo-trash"></i>

                                        <?php echo get_phrase('assign_modules');?>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </td>
        </tr>
        <?php } ?>
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
						"mColumns": [1,2,3]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							//datatable.fnSetColumnVis(0, false);
							//datatable.fnSetColumnVis(6, false);
							
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

