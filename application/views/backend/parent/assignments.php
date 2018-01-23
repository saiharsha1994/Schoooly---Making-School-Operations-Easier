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
							<th><div><?php echo get_phrase('download');?></div></th>
							<th><div><?php echo get_phrase('added_on');?></div></th>
							<th><div><?php echo get_phrase('actions');?></div></th>
							
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($assignment_teacher as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['due_date'];?></td>
							<td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
							<td><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></td>
							<td><?php echo $this->crud_model->get_subject_name_by_id($row['subject_id']);?></td>
							<td align="center">
									<a class="btn btn-default btn-xs"
										href="<?php echo base_url();?>index.php?parents/download_assignment/<?php echo $row['assignment_id'];?>">
										<i class="entypo-download"></i> <?php echo get_phrase('download');?>
									</a>
								</td>
							<td><?php echo $row['added_on'];?></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-default pull-right" role="menu">
										
										<!-- Upload LINK -->
										<li>
											<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/assignment_upload/<?php echo $row['assignment_id'];?>/<?php echo $student_id;?>/<?php echo $row['subject_id'];?>');">
												<i class="entypo-upload"></i>
													<?php echo get_phrase('upload_assignment');?>
											</a>
										</li>
									</ul>
								</div>
							</td>							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
            
            
			
            
		</div>
	</div>
</div>