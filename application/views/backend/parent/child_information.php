<head>
<script type="text/javascript">
$(document).ready(function(){

    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover',
        content : "<?php echo $this->db->get_where('student' , array('student_id' => $student_id
                                ))->row()->reject_reason;?>"
    });
});
</script>
<style type="text/css">
    .bs-example{
        margin: 150px 50px;
    }
</style>
</head>
<hr />
<div class="row">
    <div class="col-md-12">
        
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
        
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('roll');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('parent');?></div></th>
                            <th><div><?php echo get_phrase('Status');?></div></th>
                            <th><div><?php echo get_phrase('parent_email');?></div></th>
                            <th style="" id="options"><div><?php echo get_phrase('options');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $students   =   $this->db->get_where('student' , array('student_id' => $student_id
                                ))->result_array();                             
                                foreach($students as $row):?>
                        <tr>
                            <td>
                                <?php echo $row['student_code'];?>
                            </td>

                            <td><img src="<?php echo $this->crud_model->get_stu_image_url($row['student_id'])?>" class="img-circle" width="30" /></td>

                            <td>
                                <?php echo $row['name'];?>
                            </td>

                            <td>
                                <?php echo $row['Area'];?>
                            </td>


                            <td>
                                <?php 
                                    $parent_id = $row['parent_id'];
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name;
                                ?>
                            </td>
                            
                            <td>
                                <?php 
                                  if ($row['Admission_Status'] == 1) {
                                      echo "<p style='color: green;'>Approved</p>";
                                  }
                                  else if ($row['Admission_Status'] == 2) {
                                      echo "<p style='color: blue;'>Pending</p>";
                                  }else{
                                    echo '<a style="color: red;" data-toggle="popover" title="Reason" data-content="">Rejected</a>';
                                  }
                                 
                                ?>
                            </td>

                            <td>
        
                                <?php 
                                    $parent_id = $row['parent_id'];
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email;
                                ?>
                            
                            </td>

                            <td style="" id="options_td">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu" >
                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_child_edit/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </td>

                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                    
            </div>
        

        </div>
        
        
    </div>
</div>



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
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, false);
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(1, true);
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

    /*$(document).ready(function(){
        var status = "<?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->Admission_Status;?>";
        //alert(status)

        if (status == 1) {
            document.getElementById('options').style.display = 'none';
            document.getElementById('options_td').style.display = 'none';
        }
    });*/
        
</script> 