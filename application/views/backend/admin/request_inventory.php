<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_request_inventory/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('new_request');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th class="col-md-1">#</th>
            <th class="col-md-2"><?php echo get_phrase('item_name');?></th>
            <th class="col-md-1"><?php echo get_phrase('quantity');?></th>
			<th class="col-md-2"><?php echo get_phrase('requested_by');?></th>
            <th class="col-md-3"><?php echo get_phrase('requested_for');?></th>
            <th class="col-md-1"><?php echo get_phrase('date');?></th>
            <th class="col-md-1"><?php echo get_phrase('options');?></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('request_inventory')->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $row['id'];?></td>
                    <td><?php echo $this->db->get_where('inventory_categories' , array('id' => $row['inventory_id']))->row()->name;?></td>
                    <td><?php echo $row['requested_quantity'];?></td>
                    <td><?php echo $this->db->get_where('employee_details' , array('emp_id' => $row['requested_by']))->row()->name;?></td>
					<td><?php echo $row['requested_for'];?></td>
                    <td><?php echo date("d-m-Y",strtotime($row['date']))?></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-default pull-right" role="menu">
								<!-- teacher EDITING LINK -->
								<!-- <li>
									<a href="#"   onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_request_inventory_edit/<?php echo $row['id'];?>');" >
										<i class="entypo-pencil"></i>
										<?php echo get_phrase('edit');?>
									</a>
								</li>
								<li class="divider"></li> -->
								<!-- teacher DELETION LINK -->
								<li>
									<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/request_inventory_delete/<?php echo $row['id'];?>/<?php echo $row['inventory_id'];?>/<?php echo $row['requested_quantity'];?>');" >  
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

