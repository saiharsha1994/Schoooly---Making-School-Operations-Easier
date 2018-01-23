<div class="row">
	<div class="col-md-12">        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
							<th><div><?php echo get_phrase('description');?></div></th>
							<th><div><?php echo get_phrase('due_date');?></div></th>
							<th><div><?php echo get_phrase('class');?></div></th>
							<th><div><?php echo get_phrase('section');?></div></th>
							<th><div><?php echo get_phrase('subject');?></div></th>
							<th><div><?php echo get_phrase('added_on');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($homework as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['Title'];?></td>
							<td><?php echo $row['Description'];?></td>
							<td><?php echo $row['Due_Date'];?></td>
							<td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
							<td><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></td>
							<td><?php echo $this->crud_model->get_subject_name_by_id($row['subject_id']);?></td>
							<td><?php echo $row['Date'];?></td>
														
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
            
            
			
            
		</div>
	</div>
</div>