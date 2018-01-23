<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('set_minimum_attendance_percentage');?>
                </div>
            </div>
            <div class="panel-body">
                
                <?php echo form_open(base_url() . 'index.php?admin/minimum_attendance_percentage' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
                    <?php
        $query = $this->db->get_where('settings' , array('type' => 'attendance_percentage'))->row()->description;
    ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('minimum_percentage');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="percentage" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                                value="<?php echo $query?>">
                        </div>
                    </div>

                    <input type="hidden" name="class_id" value="<?php echo $param2;?>">
                    
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default"><?php echo get_phrase('submit');?></button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>