
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/fees_detail_add/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_new_fees_detail');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
            <th><div><?php echo get_phrase('semester');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('fee_type');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $count = 1;
            $term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');
            $expenses = $this->db->get('fees_details')->result_array();
            foreach ($expenses as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['fees_name'];?></td>
            <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
            <td><?php echo $this->db->get_where('semester',array('_id' =>$row['fees_term'] ))->row()->semester;?></td>
            <td><?php echo $row['fees_amount'];?></td>
            <td><?php if($row['type']=='1')
                            echo 'Tution Fee';
                     else
                        echo 'Other Fee';?></td>
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- teacher EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/fees_detail_edit/<?php echo $row['fees_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                                        </li>
                        <li class="divider"></li>
                        
                        <!-- teacher DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/fees_type/delete/<?php echo $row['fees_id'];?>');">
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
                            datatable.fnSetColumnVis(2, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(2, true);
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

