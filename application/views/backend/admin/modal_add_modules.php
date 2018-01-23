<?php $hr_info = $this->db->get('hr_roles')->result_array();
      $module_info = $this->db->get('modules_list')->result_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_module');?>
                </div>
            </div>
            <div class="panel-body">
                <!-- <?php echo $param2; ?> -->
                <input type="hidden" id="hide" name="hide" value="<?php echo $param2;?>">
                <?php echo form_open(base_url() . 'index.php?admin/hr_management/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
               
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>