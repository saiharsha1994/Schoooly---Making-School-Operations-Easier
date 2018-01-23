
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_inventory_category');?>
                </div>
            </div>
            <div class="panel-body">
                
                <?php echo form_open(base_url() . 'index.php?admin/request_inventory_add' , array(
                    'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
                        ));
                        // Row count in the Table   
                ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('item_name');?></label>
                        <div class="col-sm-6">
                            <select name="inventory_id" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select_item');?></option>
                                <?php 
                                $inventory = $this->db->get('inventory_categories')->result_array();
                                foreach($inventory as $row):
                                ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
   

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('requested_quantity');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="requested_quantity"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>        

                    <div class="form-group">
                        <label class="col-md-12" style="text-align: center;"><?php echo get_phrase('requested_by');?></label>
                        <!-- <div class="col-sm-6">
                            <select name="requested_by" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select_HR');?></option>
                                <?php 
                                $hr = $this->db->get('hr_details')->result_array();
                                foreach($hr as $row):
                                ?>
                                    <option value="<?php echo $row['hr_id'];?>"><?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div> -->
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    </br></br>
                        <label class="col-sm-4 control-label"><?php echo get_phrase('select_employee_role');?></label>
                        <div class="col-sm-6">
                            <select name="role" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_employees_roles(this.value)">
                                <option value=""><?php echo get_phrase('select_role');?></option>
                                <?php 
                                $hr = $this->db->get('hr_roles')->result_array();
                                foreach($hr as $row):
                                ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['role'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>

                        </br></br></br>
                        <label class="col-sm-4 control-label"><?php echo get_phrase('select_employee_name');?></label>
                        <div class="col-sm-6">
                            <select name="emp_name" id='emp_name' class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                            <option></option>
                                
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('requested_for');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="requested_for"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>       
                    
                    

                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <button type="submit" class="btn btn-info">
                                <i class="entypo-upload"></i> <?php echo get_phrase('submit');?>
                            </button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#emp_name").select2({
    placeholder: "Select Role First"
});


    function get_employees_roles(roll_id) {
        $("#emp_name").val(null).trigger('change');
        $("#emp_name").select2({
    placeholder: "Select employee"
});
        // jQuery('#emp_name').empty();
        
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_employees_roles/' + roll_id ,
            success: function(response)
            {               
                jQuery('#emp_name').html(response);
            }
        });
    }
</script>
