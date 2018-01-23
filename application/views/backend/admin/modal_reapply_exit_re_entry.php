<?php 
  $exit_re_entries = $this->db->get_where('exit_re_entries', array('id' => $param2))->result_array();
  $teacher_id1= $this->session->userdata('login_user_id');
        //$type= '2';
        //$teacher_name= $this->db->get_where('teacher' , array('teacher_id' => $teacher_id1))->row()->name;
   //echo $param2;
        $teacher_name=$this->session->userdata('name');
   foreach ($exit_re_entries as $row) {
        //echo $row['reason'];
?>  
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('reapply_exit_re-_entry'); ?>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/exit_reentry_management/update' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $teacher_name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('no_of_months'); ?></label>

                        <div class="col-sm-5">
                            <input type="number" name="no_of_months" class="form-control" id="no_of_months" data-validate="required" value="<?php echo $row['no_of_months']; ?>" data-message-required="<?php echo get_phrase('value_required');?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="from_date" name="from_date" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php if($row['from_date']=="null"){ 

                                    } 
                                else{
                                    echo date('d M, Y', strtotime($row['from_date']));
                                    } ?>"
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="to_date" name="to_date" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php if($row['to_date']=="null"){ 

                                    } 
                                else{
                                    echo date('d M, Y', strtotime($row['to_date']));
                                    } ?>"
                                placeholder="<?php echo get_phrase('select_date');?>">
                        </div>
                        <span></span>
                    </div>
                    <input type="hidden" value="<?php echo $row['id'] ?>" id="reapply_id" name="reapply_id">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" id="file_name" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                            <span id="documentname"><?php 
                                if($row['document']=="null"){
                                    echo "No Document";
                                }
                                else{
                                    echo $row['document'];
                                }?></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php 
                         if($row['status']==3){
                            echo get_phrase('HR_rejection_reason');
                         } 
                         else{
                            echo get_phrase('ministry_rejection_reason');
                         }?></label>

                        <div class="col-sm-5">
                            <textarea name="description1" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" readonly><?php 
                            if($row['status']==3){
                            echo $row['reject_reason_hr'];
                             } 
                             else{
                            echo $row['reject_reason_ministry'];
                             }?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-5 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success"><?php echo get_phrase('reapply');?></button>
                    </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){
    $("#file_name").on('change',function(){
        $("#documentname").html("");
    });
});    
</script>