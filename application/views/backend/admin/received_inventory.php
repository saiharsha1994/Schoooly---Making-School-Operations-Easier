<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-1"><?php echo get_phrase('item_code');?></th>
            <th class="col-md-1"><?php echo get_phrase('inventory_type');?></th>
            <th class="col-md-2"><?php echo get_phrase('item_name');?></th>

            <th class="col-md-3"><?php echo get_phrase('description');?></th>
            <th class="col-md-1"><?php echo get_phrase('reorder_quantity');?></th>
            <th class="col-md-1"><?php echo get_phrase('received_date');?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            $notices  =  $this->db->get_where('ordered_inventory' , array('status' => '2'))->result_array();
            foreach($notices as $row):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['item_code'];?></td>
                    <td><?php echo $this->db->get_where('inventory_type' , array('id' => $row['type_id']))->row()->name;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['reorder_quantity'];?></td>
                    <td><?php echo $row['received_date'];?></td>
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

