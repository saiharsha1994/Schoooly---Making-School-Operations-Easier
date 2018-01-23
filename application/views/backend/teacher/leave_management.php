<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_apply_leave');" 
    class="btn btn-primary pull-right">
    <?php echo get_phrase('apply_leave'); ?>
</button>
<div style="clear:both;"></div>
<br>
<!-- <?php echo $teacher_id; ?>
<br>
<?php echo $type; ?> -->
<!-- <?php echo date("Y-m-d");?> -->
<!-- <?php echo $year; ?> -->
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-2"><?php echo get_phrase('from_date');?></th>
            <th class="col-md-2"><?php echo get_phrase('to_date');?></th>
            <th class="col-md-3"><?php echo get_phrase('reason');?></th>
            <th class="col-md-2"><?php echo get_phrase('status');?></th>
            <th class="col-md-2"><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        foreach ($leave_info as $row) { ?>   
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo date("d M, Y", strtotime($row['from_date'])); ?></td>
            <td><?php echo date("d M, Y", strtotime($row['to_date'])); ?></td>
                <!-- <td><?php echo date("d-m-Y", strtotime($row['from_date'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['to_date'])); ?></td> -->
                <td><?php echo $row['reason']?></td>
                <!-- <td><?php echo $row['status'] ?></td> -->
                <!-- <td><?php 
                    if($row['status']==1){
                        echo 'Leave Approval Pending';
                    }
                    elseif($row['status']==2){
                        echo 'Leave Approved';
                    }
                    elseif($row['status']==3){
                        echo 'Leave Rejected';
                    }
                    ?></td> -->
                    <?php if($row['status']==1){?>
                    <td>
                        <?php echo get_phrase('Leave Approval Pending');?>
                    </td>
                    <?php }
                    elseif($row['status']==2){?>
                    <td style="color: #00AD5E;">
                        <?php echo get_phrase('Leave Approved');?>
                    </td>
                    <?php }
                    elseif($row['status']==3){?>
                    <td style="color: #df1a1a;">
                        <?php echo get_phrase('Leave Rejected');?>
                    </td>
                    <?php } ?>
                    <td>
                        <div class="btn-group">

                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">

                                Action <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                <li>

                                    <!-- <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/assign_roles/delete/<?php echo $row['id'];?>');"> -->
                                    <?php
                                        if($row['status']==3){?>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reapply_leave/<?php echo $row['id']?>');">

                                        <i class="entypo-pencil"></i>

                                        <?php echo get_phrase('reapply_leave');?>

                                    </a>

                                       <?php }?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/leave_managment/delete/<?php echo $row['id'];?>');">

                                        <i class="entypo-trash"></i>

                                        <?php echo get_phrase('delete');?>

                                    </a>
                                </li>

                            </ul>

                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <script type="text/javascript">
            jQuery(window).load(function ()
            {
                var $ = jQuery;

                $("#table-2").dataTable({
                    "sPaginationType": "bootstrap",
                    "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
                });

                $(".dataTables_wrapper select").select2({
                    minimumResultsForSearch: -1
                });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
            $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>