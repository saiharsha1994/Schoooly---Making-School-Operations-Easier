<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_roles/');" 

    class="btn btn-primary pull-right">

    <i class="entypo-plus-circled"></i>

    <?php echo get_phrase('add_new_roles');?>

</a> 

<br><br>
<table class="table table-bordered datatable" id="table_export">

    <thead>

        <tr>

            <th class="col-md-2">#</th>

            <th class="col-md-8"><div><?php echo get_phrase('role');?></div></th>

            <th class="col-md-2"><div><?php echo get_phrase('options');?></div></th>

        </tr>

    </thead>

    <tbody>

        <?php

            $count = 1; 

            foreach($hr_roles as $row):?>

                <tr>

                    <td class="col-md-2"><?php echo $count++;?></td>

                    <td class="col-md-8"><?php echo $row['role']?></td>

                    <td class="col-md-2">

                        <div class="btn-group">

                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">

                                Action <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                <li>

                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/add_roles/delete/<?php echo $row['id'];?>');">

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

                        "mColumns": [0,1,2]

                    },

                    {

                        "sExtends": "pdf",

                        "mColumns": [0,1,2]

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



