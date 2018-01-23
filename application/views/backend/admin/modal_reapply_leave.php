<?php $class_info = $this->db->get('class')->result_array(); 
  $leave_info = $this->db->get_where('leave_records', array('id' => $param2))->result_array();
   //echo $param2;
   foreach ($leave_info as $row) {
        //echo $row['reason'];
?>  
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('apply_leave'); ?>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/staff_leave_apply/update' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="from_date" name="timestamp1" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php echo date("d M, Y", $row['from_date']); ?>" 
                                placeholder="<?php echo get_phrase('select_date');?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        </div>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" id="to_date" name="timestamp2" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php echo date("d M, Y", $row['to_date']); ?>"
                                placeholder="<?php echo get_phrase('select_date');?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        </div>
                        <span></span>
                    </div>
                    <input type="hidden" value="<?php echo $row['id'] ?>" id="leave_id" name="leave_id">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('reason'); ?></label>

                        <div class="col-sm-5">
                            <textarea name="description" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"><?php echo $row['reason'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('leave_rejection_reason'); ?></label>

                        <div class="col-sm-5">
                            <textarea name="description1" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" readonly><?php echo $row['reject_reason'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success"><?php echo get_phrase('reapply');?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<?php } ?>
<script type="text/javascript">

/*$(document).ready(function(){
     //$.validator.setDefaults({ ignore: [':hidden:not(.selectboxit)']   });
     $("form").data("validator").settings.ignore = "";

     $('#class_id').validate({ 
            rules: {
                'class_id': {
                    required: true
                }
            },
            messages: {
                'class_id': {
                    required: 'Please Select Class'
                }
            },

        });

       $('#subject_id').validate({ 
            rules: {
                'subject_id': {
                    required: true
                }
            },
            messages: {
                'subject_id': {
                    required: 'Please Select Subject'
                }
            },

        }); 

});*/
    /*function onclik(){
    //$('#class_id').data("selectBox-selectBoxIt").remove(0);
    //showFirstOption: false
    }*/

    /*$('#subject_id').change(function () {
        var sectionid = this.value;
        alert(sectionid);
    });*/

    /*$('#class_id').change(function () {
        var classid = this.value;
        if(classid==""){
            //alert("hi");
            $('#subject_id').data("selectBox-selectBoxIt").remove();
        }
        else {
            $.ajax({
            url: '<?php echo base_url();?>index.php?teacher/subject_data/' +classid ,
            async:false,
            success: function(response){
           
                var obj = JSON.parse(response);
                var x1=[];
                x1=obj.subject;
                x2=obj.id;
                if(x1.length>0){
                    $('#subject_id').data("selectBox-selectBoxIt").remove();
                    $('#subject_id')
                        .append($('<option>', { value : "" })
                        .text("Select Subject"));
                for(var i=0;i<x1.length;i++){
                    $('#subject_id')
                        .append($('<option>', { value : x2[i] })
                        .text(x1[i]));  
                    }
                    $('#subject_id').data("selectBox-selectBoxIt").refresh();
                }
                else {
                    $('#subject_id').data("selectBox-selectBoxIt").remove();
                } 
            }   
        });  
        }
        
});*/

    
</script>