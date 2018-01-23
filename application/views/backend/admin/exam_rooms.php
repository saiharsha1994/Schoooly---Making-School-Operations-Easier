<a href="<?php echo base_url();?>index.php?admin/modal_room_add<?php echo "";?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_exam_rooms');?>
    </a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th><div><?php echo get_phrase('room_name');?></div></th>
            <th><div><?php echo get_phrase('seat_capacity');?></div></th>
            <th><div><?php echo get_phrase('year');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            $notices  = $this->db->get('exam_rooms')->result_array();
            foreach($notices as $row):?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $row['room_name'];?></td>
                    <td><?php echo $row['seat_capacity'];?></td>
                    <td><?php echo $row['year'];?></td>
                  
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                
                                <li>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam_rooms/delete/<?php echo $row['room_id'];?>');">
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
                        "mColumns": [0,1,2,3]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0,1,2,3]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(4, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(3, true);
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
