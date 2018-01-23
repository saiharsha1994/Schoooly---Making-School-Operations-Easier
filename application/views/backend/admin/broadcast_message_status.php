<?php 
	$dataArr=explode("-", $param2);
	$msg_code=$dataArr[0];
	$sender=$dataArr[1];
	$receiver=$dataArr[2];
	
	$edit_data	=	$this->db->get_where('message' , array(
		'message_thread_code' => $msg_code
	))->result_array();
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('message_status');?>
            	</div>
            </div>
			<div class="panel-body">
				<div class="row">
					<table class="table-bordered table-striped table-condensed cf" cellspacing="5" width="100%">
						<thead>
							<?php echo " Sender : ".urldecode(get_phrase($sender));?><br/>
							<?php echo " Receiver : ".urldecode(get_phrase($receiver));?>							  									  
							
							<tr>                
								<th><?php echo get_phrase('message');?></th>
								<th><?php echo get_phrase('status');?></th>								  									  
							</tr>
						</thead>
						<tbody>
					<?php foreach ($edit_data as $row){ ?>
							<tr>
								<td data-title="Message"><?php echo $row['message']; ?></td>
								<td data-title="Status"><?php if($row['read_status']==0){echo get_phrase('unread');}else{echo get_phrase('read');} ?></td>
							</tr>
						 
					<?php } ?>
						</tbody>			  
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
