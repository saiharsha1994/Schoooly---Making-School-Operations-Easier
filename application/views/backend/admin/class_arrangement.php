<?php 
$running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>
<a href="<?php echo base_url();?>index.php?admin/class_arrangement_add/<?php echo "";?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('arrange_the_class');?>
    </a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th><div><?php echo get_phrase('room_name');?></div></th>
            <th><div><?php echo get_phrase('student_name');?></div></th>
            <th><div><?php echo get_phrase('exam');?></div></th>
            <th><div><?php echo get_phrase('seat_number');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 

            $notices  = $this->db->order_by('seat_number', 'AESC')->get_where('exam_class_arrangements' , array('year'=>$running_year))->result_array();
            foreach($notices as $row):?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td>
                    <?php 
                    $exam_rooms  = $this->db->get_where('exam_rooms' , array('room_id'=>$row['room_id']))->row()->room_name;
                    echo $exam_rooms;
                    ?> 
                    </td>
                    <td><?php 
                       $student  = $this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->name;
                    echo $student;
                   ?></td>
                    <td>

                    <?php 
                    $exam_schedule  = $this->db->get_where('exam_schedule' , array('_id'=>$row['exam_id']))->row()->title;
                    echo $exam_schedule;
                    
                    ?></td>
                    <td><?php echo $row['seat_number'];?></td>
                    <td><?php 
                    $class_id  = $this->db->get_where('student' , array('class_id'=>$row['class_id']))->row()->class_name;
                    echo $class_id;
                    ?></td>
                  
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                
                                <li>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/class_arrangement/delete/<?php echo $row['id'].",".$row['room_id'];?>');">
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
                        "mColumns": [0,1,2,3,4,5]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0,1,2,3,4,5]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(6, false);
                            
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
