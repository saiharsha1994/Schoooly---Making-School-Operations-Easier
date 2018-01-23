<?php 
	$edit_data	=	$this->db->get_where('non_teaching_staff' , array(
		'staff_id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('documents');?>
            	</div>
            </div>
			<div class="panel-body">
				<!--<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">
						<?php echo get_phrase('documents');?>
					</label>
					<div class="col-sm-6">
						<?php echo $row['staff_documents'];?>
					</div>
				</div>
				-->
				
				<?php $img_urls = explode('~',$row['staff_documents']);
					echo '<div class="row">
							<table class="table-bordered table-striped table-condensed cf" cellspacing="5" width="100%">
								<thead>
									<tr>                
									  <th>Name</th>
									  <th>Document</th>								  									  
									</tr>
								</thead>
								<tbody>';
					foreach($img_urls as $img_row){      
						$image_exts = array('jpg','jpeg','gif','png','PNG','bmp');
						$pdf_exts = array('pdf');
						
						if(in_array(pathinfo($img_row, PATHINFO_EXTENSION), $image_exts)){
							echo '<tr>
							<td data-title="Name">'.$img_row.'</td>
							<td data-title="Document"><a href="'.base_url().'uploads/non_teaching_staff_doc/'.$img_row.'" download="'.$img_row.'"><img src="'.base_url().'uploads/non_teaching_staff_doc/'.$img_row.'" height="100" width="100"></a></td></tr>';
						}else if(in_array(pathinfo($img_row, PATHINFO_EXTENSION), $pdf_exts)){
							echo '<tr>
							<td data-title="Name">'.$img_row.'</td>
							<td data-title="Document"><a href="'.base_url().'uploads/non_teaching_staff_doc/'.$img_row.'" download="'.$img_row.'">Download Document</a></td></tr>';	
						} 
					}
					echo '</tbody>			  
					</table>
					<br><span>* Click Document to download!</span>
					</div>';
				?>
				
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>