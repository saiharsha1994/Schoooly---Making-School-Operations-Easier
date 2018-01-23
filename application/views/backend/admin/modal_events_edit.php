<?php 
$edit_data		=	$this->db->get_where('app_event' , array('Event_Id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_event');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/events/edit/'.$row['Event_Id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('event_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="Event_Title" value="<?php echo $row['Event_Title'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('event_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="Event_Date" value="<?php echo Date('m/d/Y',strtotime($row['Event_Date']));?>"/>
                                </div>
                            </div>
                            
                                                    
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_event');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>