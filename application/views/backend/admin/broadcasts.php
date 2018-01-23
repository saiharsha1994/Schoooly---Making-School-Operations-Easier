<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_broadcasts_add/');" 
	class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('new_broadcasts');?>
</a> 
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_set_time_to_chat/');" class="btn btn-primary pull-right" style="margin-right: 10px;">
	<i class="e"></i>
	<?php echo get_phrase('set_time_to_chat');?>
</a>
<br><br>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>#</th>
            <th><div><?php echo get_phrase('message_code');?></div></th>
            <th><div><?php echo get_phrase('sender');?></div></th>
			<th><div><?php echo get_phrase('receiver');?></div></th>
			<th><div><?php echo get_phrase('status');?></div></th>
		</tr>
	</thead>
    <tbody>
		<?php
			$count = 1; 
			$notices  =   $this->db->get('message_thread')->result_array();
            foreach($notices as $row):?>
				<tr>
					<td><?php echo $count++;?></td>
                    <td><?php echo $row['message_thread_code'];?></td>
                    <td><?php $sendArr=explode("-", $row['sender']);
					 if($sendArr[0]=='parent'){
						$senderName=$this->db->get_where('parent' , array('parent_id' => $sendArr[1]))->row()->name;
					}else {
						$senderName=$this->db->get_where('employee_details' , array('emp_id' => $sendArr[1]))->row()->name;
					}
					echo $senderName."-".$sendArr[0];?></td>
                    <td><?php $receiveArr=explode("-", $row['reciever']);
					 if($receiveArr[0]=='parent'){
						$receiverName=$this->db->get_where('parent' , array('parent_id' => $receiveArr[1]))->row()->name;
					}else {
						$receiverName=$this->db->get_where('employee_details' , array('emp_id' => $receiveArr[1]))->row()->name;
					}
					
					echo $receiverName."-".$receiveArr[0];?></td>
					<td>
						<div class="btn-group">
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/broadcast_message_status/<?php echo $row['message_thread_code']."-".$senderName."-".$receiverName;?>');">
								<i class="entypo-eye"></i>
								<?php echo get_phrase('message_status');?>
							</a>
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

