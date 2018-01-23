<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php 
$teacher_id1= $this->session->userdata('login_user_id');
        //$type= '2';
        //$teacher_name= $this->db->get_where('teacher' , array('teacher_id' => $teacher_id1))->row()->name;
        $teacher_name=$this->session->userdata('name');
        /*echo $teacher_name;
        echo $teacher_id1;*/
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

                <?php echo form_open(base_url().'index.php?admin/exit_reentry_management/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $teacher_name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('no_of_months'); ?></label>

                        <div class="col-sm-5">
                            <input type="number" name="no_of_months" class="form-control" id="no_of_months" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autocomplete="off" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="from_date" name="from_date" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="to_date" name="to_date" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
                    <div class="col-sm-5 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success center-block"><?php echo get_phrase('apply');?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script type="text/javascript">    
</script>