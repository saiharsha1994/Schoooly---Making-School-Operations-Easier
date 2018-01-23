<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php 
$xyz="";
$admin= $this->session->userdata('login_user_id');
        $type_admn= $this->session->userdata('login_type');
        $admin_name= $this->session->userdata('name');
        
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('apply_exit_re-_entry'); ?>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/exit_reentry_management_hr/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Role'); ?></label>

                        <div class="col-sm-5">

                        <select id="type_admn" class="form-control selectboxit required" name="type_admn" style="width:100%;"
                        onchange="setemployee_details_data_track(this.value)" >
                        <option value="0"><?php echo get_phrase('select_type');?></option>
                        <?php 
                        $employee_details = $this->db->get('hr_roles')->result_array();
                        foreach($employee_details as $row):
                            
                        ?>
                            <option value="<?php echo $row['id']?>" ><?php echo $row['role'];?>
                            </option>

                        <?php
                    
                        endforeach;
                        ?>
                    </select>
                            <!-- <input type="text" name="name" class="form-control" id="name" value="<?php echo $admin_name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly>
                            <input type="text" name="name_id" value="<?php echo $admin?>"> -->

                        </div>
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name'); ?></label>

                        <div class="col-sm-5">

                        <select id="name_id" name="name_id" class="form-control selectboxit" style="width:100%;">
                        
                    </select>
                            <!-- <input type="text" name="name" class="form-control" id="name" value="<?php echo $admin_name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly>
                            <input type="text" name="name_id" value="<?php echo $admin?>"> -->

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('no_of_months'); ?></label>

                        <div class="col-sm-5">
                            <input type="number" name="no_of_months" class="form-control" id="no_of_months" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="from_date" value="" data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="to_date" value="" data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" id="submit" class="btn btn-md btn-success" disabled><?php echo get_phrase('submit');?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script type="text/javascript">    
function setemployee_details_data_track(data) {
var type_admn=document.getElementById("type_admn").value;
if(type_admn==0){
document.getElementById("submit").disabled=true;
}else{
    document.getElementById("submit").disabled=false;
}
     $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_employee_name_details/' + data ,
            async:false,
            success: function(response)
            {
                
                
                document.getElementById("name_id").innerHTML=response; 
                $("#name_id").data('selectBox-selectBoxIt').refresh();
            }
        });

}
</script>