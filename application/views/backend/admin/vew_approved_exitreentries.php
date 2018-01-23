<?php 
$user = "";
if (isset($_POST['submit'])) {
	$user = $_POST['select_user'];
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
                foreach($role as $row):?>
					<option value="<?php echo $row['id']?>" ><?php echo $row['role'];?>
					</option>
				<?php
                    endforeach;?>
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
            <th><div><?php echo get_phrase('status');?></div></th>
            
            <th><div><?php echo get_phrase('no_of_months');?></div></th>
            <th><div><?php echo get_phrase('from_date');?></div></th>
            <th><div><?php echo get_phrase('to_date');?></div></th>
            <th><div><?php echo get_phrase('executed_document');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1; 
        $notices  = $this->db->get('exit_re_entries')->result_array();
        foreach($notices as $row):?>
			<?php if( ($row['emp_type']==$user && $row['status']==2) || $row['emp_type']==$user && $row['status']==4 ){?>
				<tr>
					<td><?php echo $count++;?></td>
                    <td>
                    <?php echo $this->db->get_where('employee_details' , array('emp_id'=>$row['emp_id']))->row()->name;?></td>
                    <td>
					<?php 
                        if($row['status']==2){?>
                            <?php echo "<p style='color:#4E89FF;font-size:13px'>"."Approved by Hr";?>
                        <?php
                        }else{
							echo "<p style='color:#00CA3D;font-size:13px'>"."Approved by Ministry";
						}
						?>
                    </td>
					<td><?php echo $row['no_of_months'];?></td>
                    <td><?php echo $row['from_date'];?></td>
                    <td><?php echo $row['to_date'];?></td>
                   <td>
                    <a href="<?php echo base_url().'uploads/document/'.$row['executed_doc'];?>" download><button type="button" class="btn btn-blue btn-icon icon-left">
                        <?php echo get_phrase('executed_document');?>
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
