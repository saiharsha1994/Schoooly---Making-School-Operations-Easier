<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_inventory_type_add/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_new_inventory_type');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th class="col-md-1">#</th>
            <th class="col-md-1"><?php echo get_phrase('type_code');?></th>
            <th class="col-md-2"><?php echo get_phrase('name');?></th>
            <th class="col-md-3"><?php echo get_phrase('description');?></th>
            <th class="col-md-1"><?php echo get_phrase('options');?></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('inventory_type')->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $row['id'];?></td>
                    <td><?php echo $row['type_code'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['description'];?></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
								<!-- teacher EDITING LINK -->
								<li>
									<a href="#"  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_inventory_type_edit/<?php echo $row['id'];?>');"> 
										<i class="entypo-pencil"></i>
										<?php echo get_phrase('edit');?>
									</a>
								</li>
								<li class="divider"></li>
								<!-- teacher DELETION LINK -->
								<li>
									<a href="#"  onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_inventory_type/<?php echo $row['id'];?>');">
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
                    
                    
                ]
            },
            
        });
        
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
        
</script>

