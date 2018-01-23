<a href="<?php echo base_url();?>index.php?admin/exam_time_table_add/<?php echo $class_id; ?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_exam_time_table');?>
    </a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th><div><?php echo get_phrase('exam_date');?></div></th>
            <th><div><?php echo get_phrase('exam_title');?></div></th>
            <th><div><?php echo get_phrase('class_name');?></div></th>
            <th><div><?php echo get_phrase('section_name');?></div></th>
            <th><div><?php echo get_phrase('subject_name');?></div></th>
             <th><div><?php echo get_phrase('start_time');?></div></th>
            <th><div><?php echo get_phrase('end_time');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            $notices  =   $this->db->get_where('exam_time_table' , array('class_id' => $class_id))->result_array();
            foreach($notices as $row):?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $row['exam_date'];?></td>
                    <td><?php echo $row['exam_title'];?></td>
                    <td>

                    <?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;?>
                        

                    </td>
                    <td><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></td>
                    <td>

                    <?php 
                        if($row['subject_id']==0){
                        $xyz="---";
                        }else{
                            $xyz=$this->db->get_where('subject' , array('subject_id' => $row['subject_id']))->row()->name;
                        }
                    ?>

                    <?php echo $xyz;?></td>
                    <td><?php echo $row['start_time'];?></td>
                     <td><?php echo $row['end_time'];?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                
                                <!-- teacher DELETION LINK -->
                                <li>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam_time_table_delete/<?php echo $row['tt_id'].",".$class_id;?>');">
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
                        "mColumns": [0,1,2,3,4,5,6,7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0,1,2,3,4,5,6,7]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(8, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(7, true);
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
