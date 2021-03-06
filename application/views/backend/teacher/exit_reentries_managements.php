<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_exit_re_entry_add');" 
    class="btn btn-primary pull-right">
    <?php echo get_phrase('apply_exit_re-_entry'); ?>
</button>
<div style="clear:both;"></div>
<br>
<!-- <?php echo $teacher_id; ?>
<br>
<?php echo $type; ?> -->
<!-- <?php echo date("Y-m-d");?> -->
<!-- <?php echo $year; ?> -->
<!-- <?php echo $teacher_name; ?> -->
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th >#</th>
            <th ><?php echo get_phrase('date');?></th>
            <th ><?php echo get_phrase('no._of_months');?></th>
            <th ><?php echo get_phrase('from_date');?></th>
            <th ><?php echo get_phrase('to_date');?></th>
            <th ><?php echo get_phrase('documents');?></th>
            <th ><?php echo get_phrase('status');?></th>
            <th ><?php echo get_phrase('executed_document');?></th>
            <th ><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
            <?php
        $count = 1;
        foreach ($exit_reentry_info as $row) { ?>   
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php 
            if($row['status']==1){
                echo "Applied: ".date("d-m-Y", strtotime($row['added_on']));
                } 
            else if($row['status']==2){
                echo "Executed: ".date("d-m-Y", strtotime($row['added_on']));
                }
            else if($row['status']==3){
                echo "Rejected: ".date("d-m-Y", strtotime($row['added_on']));
                }
            else if($row['status']==4){
                echo "Approved: ".date("d-m-Y", strtotime($row['added_on']));
                }
            else if($row['status']==5){
                echo "Rejected: ".date("d-m-Y", strtotime($row['added_on']));
                }?></td>
            <?php 
            $data1=" months";
            $totalmonths =$row['no_of_months']. ' ' . $data1;?>
            <td><?php echo $totalmonths; ?></td>
            <td><?php if($row['from_date']=='null'){
                    echo "--";
                }
                else{
                    echo date("d-m-Y", strtotime($row['from_date']));
                }?></td>
            <td><?php if($row['to_date']=='null'){
                    echo "--";
                }
                else{
                    echo date("d-m-Y", strtotime($row['to_date']));
                }?></td>
            <td>
                 <?php if($row['document']  =="null"){
                    echo "No Documents"; 
                 }
                 else {?>
                    <a href="<?php echo base_url().'uploads/document/'.$row['document']; ?>" class="btn btn-blue btn-icon icon-left" download>
                        <i class="entypo-download"></i>
                        <?php echo get_phrase('download');?>
                    </a>
                 <?php } ?>   
                </td>
                      <?php if($row['status']==1){?>
                    <td>
                        <?php echo get_phrase('Approval Pending');?>
                    </td>
                    <?php }
                    elseif($row['status']==2){?>
                    <td style="color: #00AD5E;">
                        <?php echo get_phrase('Approver By HR');?>
                    </td>
                    <?php }
                    elseif($row['status']==3){?>
                    <td style="color: #df1a1a;">
                        <?php echo get_phrase('Rejected By HR');?>
                    </td>
                    <?php }
                    elseif($row['status']==4){?>
                    <td style="color: #00AD5E;">
                        <?php echo get_phrase('Confirmed By Ministry');?>
                    </td>
                    <?php }
                    elseif($row['status']==5){?>
                    <td style="color: #df1a1a;">
                        <?php echo get_phrase('Canceled By Ministry');?>
                    </td>
                    <?php }?>
                    <td>
                     <?php if($row['executed_doc']  =="null"){
                        echo "No Documents"; 
                     }
                     else {?>
                        <a href="<?php echo base_url().'uploads/document/'.$row['executed_doc']; ?>" class="btn btn-blue btn-icon icon-left" download>
                            <i class="entypo-download"></i>
                            <?php echo get_phrase('download');?>
                        </a>
                     <?php } ?>   
                </td>
                    <td> 
                        <div class="btn-group">

                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">

                                Action <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                <li>

                                    <!-- <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/assign_roles/delete/<?php echo $row['id'];?>');"> -->
                                    <?php
                                        if($row['status']==3 || $row['status']==5){?>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reapply_exit_re_entry/<?php echo $row['id']?>');">

                                        <i class="entypo-pencil"></i>

                                        <?php echo get_phrase('reapply');?>

                                    </a>

                                       <?php }?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/exit_reentry_management/delete/<?php echo $row['id'];?>');">

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