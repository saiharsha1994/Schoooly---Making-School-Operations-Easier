<a href="<?php echo base_url();?>index.php?admin/pending_from_hr/<?php echo "modal";?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_exit_re-Entries');?>
    </a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th><div><?php echo get_phrase('employee_name');?></div></th>
            <th><div><?php echo get_phrase('type');?></div></th>
            <th><div><?php echo get_phrase('no_of_months');?></div></th>
            <th><div><?php echo get_phrase('document');?></div></th>
            <th><div><?php echo get_phrase('from_date');?></div></th>
            <th><div><?php echo get_phrase('to_date');?></div></th>
            <th><div><?php echo get_phrase('applied_on');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            $notices  = $this->db->get('exit_re_entries')->result_array();
            foreach($notices as $row):?>
                <?php if($row['status']=="1" ){?>
                    <tr>
                    <td><?php echo $count++;?></td>
                    <td>
                    <?php 
                    /*  $role       =   $this->db->get_where('hr_roles' , array('id'=>$row['emp_type']))->row()->role;
                    if(strtolower($role)=="teacher"){
                        $type_data       =   $this->db->get_where('teacher' , array('teacher_id'=>$row['emp_id']))->row()->name;
                        $type="teacher";
                    }
                    if(strtolower($role)=="driver"){
                        $type_data       =   $this->db->get_where('driver_details' , array('driver_id'=>$row['emp_id']))->row()->name;
                        $type="driver";
                    }
                    if(strtolower($role)=="transport admin"){
                        $type_data       =   $this->db->get_where('transport_admin' , array('trans_admin_id'=>$row['emp_id']))->row()->name;
                        $type="transport_admin";
                    }
                    if(strtolower($role)=="non teaching staff"){
                        $type_data       =   $this->db->get_where('non_teaching_staff' , array('staff_id'=>$row['emp_id']))->row()->name;
                        $type="non_teaching_staff";
                    }
                    if(strtolower($role)=="supervisor"){
                        $type_data       =   $this->db->get_where('supervisor' , array('supervisor_id'=>$row['emp_id']))->row()->name;
                         $type="supervisor";
                    }
                    if(strtolower($role)=="hr"){
                        $type_data       =   $this->db->get_where('hr_details' , array('hr_id'=>$row['emp_id']))->row()->name;
                         $type="hr";
                    }
                    if(strtolower($role)=="admin"){
                        $type_data       =   $this->db->get_where('admin' , array('admin_id'=>$row['emp_id']))->row()->name;
                         $type="admin";
                    } */
                    ?>
                    <?php echo $this->db->get_where('employee_details' , array('emp_id'=>$row['emp_id']))->row()->name;?></td>
                    <td><?php 
						echo $this->db->get_where('hr_roles' , array('id' => $row['emp_type']))->row()->role;
						
					//echo get_phrase($type);
					?></td>
                    <td><?php echo $row['no_of_months'];?></td>
                    <td>
                    <?php if($row['document']===''||$row['document']==="null" ||$row['document']==="NULL" ||$row['document']===" "){ ?>
                    <?php echo form_open(base_url().'index.php?admin/exit_reentry_management_hr_upload' , array('enctype' => 'multipart/form-data'));?>
                    <input type="hidden" name="emp_id_details" value="<?php echo $row['emp_id'];?>">
                    <input type="file" name="file_name" id="file_new" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> upload" />
                    <button type="submit" id="submit_upload" class="btn btn-md btn-success" ><?php echo get_phrase('submit');?></button>
                    

                    <?php echo form_close();?>

                    <?php }else{?>
                        <a href="<?php echo base_url().'uploads/document/'.$row['document'];?>" download><button type="button" class="btn btn-blue btn-icon icon-left">
                        <?php echo get_phrase('document');?>
                        <i class="entypo-download"></i>
                    </button></a>

                        <?php }?>
                    </td>
                    <td><?php echo $row['from_date'];?></td>
                    <td><?php echo $row['to_date'];?></td>
                    <td><?php 
                    		$createDate = new DateTime($row['added_on']);
                    		$strip = $createDate->format('d-m-Y');
                    		echo $strip;
                    ?></td>
                  
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <li>

                                    <a href="#" onclick="confirm_modal2('<?php echo base_url();?>index.php?admin/approve_reject/approve/<?php echo $row['id'];?>');">
                                        <i class="entypo-trash"></i>
                                        <?php echo get_phrase('approve');?>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="#" onclick="confirm_modal1('<?php echo base_url();?>index.php?admin/approve_reject/reject/<?php echo $row['id'];?>');">
                                        <i class="entypo-trash"></i>
                                        <?php echo get_phrase('reject');?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php

                    }?>
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

