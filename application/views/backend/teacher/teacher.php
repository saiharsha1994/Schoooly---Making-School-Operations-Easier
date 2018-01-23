
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <!--<th width="80"><div><?php echo get_phrase('photo');?></div></th>-->
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$role_id=$this->db->get_where('hr_roles', array('role' => 'teacher'))->row()->id;
							$teachers=array();
									
							$employees   =   $this->db->get('employee_details')->result_array();
							foreach($employees as $row){
								$exists=0;
								$x = explode(',', $row['emp_type']);
								foreach ($x as $r) {
									if($r!=''&&$r==$role_id){
										$exists=1;
									}
								}
								if($exists==1){
									$teachers[]=$row;
								}
							}
                              
                            //print_r($teachers);
							foreach($teachers as $row):?>
                        <tr>
                            <!--<td><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30" /></td>-->
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

