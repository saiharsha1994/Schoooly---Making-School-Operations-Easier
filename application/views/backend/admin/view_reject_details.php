 <?php 
 $example = "";
if (isset($_POST['submit'])) {
    $example = $_POST['select_user'];
  }
 ?>
<br>
<form class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                                
                                <div class="col-sm-4">
                                    <select name="select_user" id="exam_room" class="form-control selectboxit" style="width:100%;" >
                        <option value=""><?php echo get_phrase('select_user');?></option>
                        <?php 
                        $role = $this->db->get('hr_roles')->result_array();
                        foreach($role as $row):
                            
                        ?>
                            <!-- <option value="<?php echo $row['room_name'].",".$row['room_id'];?>" ><?php echo $row['room_name'];?>
                            </option> -->
                            <option value="<?php echo $row['id']?>" ><?php echo $row['role'];?>
                            </option>

                        <?php
                    
                        endforeach;
                        ?>
                    </select>
                                </div>
                                <div class="col-sm-3">
                                <button class="btn btn-blue" name="submit" type="submit">Submit</button>
                            </div>
                            </div>
                            
                    </form>
                    <br>
<table class="table table-bordered datatable" id="table_export">

    <thead>
        <tr>
            <th>#</th>
            <th><div><?php echo get_phrase('employee_name');?></div></th>
            <th><div><?php echo get_phrase('rejected by');?></div></th>
            
            <th><div><?php echo get_phrase('no_of_months');?></div></th>
            <th><div><?php echo get_phrase('from_date');?></div></th>
            <th><div><?php echo get_phrase('to_date');?></div></th>
            <th><div><?php echo get_phrase('rejected_on');?></div></th>
            <th><div><?php echo get_phrase('reason');?></div></th>
            <th><div><?php echo get_phrase('document');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            $notices  = $this->db->get('exit_re_entries')->result_array();
            foreach($notices as $row):?>
                <?php if( ($row['emp_type']==$example && $row['status']==3) || $row['emp_type']==$example && $row['status']==5 ){?>
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
                    
                    
                    
                    <td>

                    <?php 
                        if($row['status']==3){?>
                            <?php echo "<p style='font-size:13px'>"."rejected by Hr";?>
                        <?php
                        }else{
                    ?>
                    <?php echo "<p style='color:#e6004c;font-size:13px'>"."rejected by Ministry";?>
                    <?php 

                    }?>
                    </td>
                    
                  
                    <td><?php echo $row['no_of_months'];?></td>
                    <td><?php echo $row['from_date'];?></td>
                    <td><?php echo $row['to_date'];?></td>
                    <td><?php 
                            $createDate = new DateTime($row['added_on']);
                            $strip = $createDate->format('d-m-Y');
                            echo $strip;
                    ?></td>

                    <td>
                        <?php 
                            if($row['status']==3){
                                    echo $row['reject_reason_hr'];
                            }else{
                                echo $row['reject_reason_ministry'];
                            }
                        ?>
                    </td>
                    <td>
                    <a href="<?php echo base_url().'uploads/document/'.$row['document'];?>" download><button type="button" class="btn btn-blue btn-icon icon-left">
                        <?php echo get_phrase('document');?>
                        <i class="entypo-download"></i>
                    </button></a>
                        
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
