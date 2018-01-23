<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_notice_add/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_new_notice');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>#</th>
            <th><div><?php echo get_phrase('notice_title');?></div></th>
            <th><div><?php echo get_phrase('notice_info');?></div></th>
            <th><div><?php echo get_phrase('notice_date');?></div></th>
            <th><div><?php echo get_phrase('notice_addedOn');?></div></th>
			<th width="80"><div><?php echo get_phrase('image');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('app_notice_tbl' )->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $count++;?></td>
                    <td><?php echo $row['Notice_Title'];?></td>
                    <td><?php echo $row['Notice_Info'];?></td>
                    <td><?php echo $row['Notice_Date'];?></td>
                    <td><?php echo $row['Notice_AddedOn'];?></td>
					 <td><img src="<?php echo $row['Notice_Img'];?>" class="img-circle" width="30" /></td>
                    <td>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
								
								<!-- teacher DELETION LINK -->
								<li>
									<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/notice/delete/<?php echo $row['Notice_Id'];?>');">
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

