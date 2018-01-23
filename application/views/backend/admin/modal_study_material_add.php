<?php $class_info = $this->db->get('class')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('add_study_material'); ?>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/study_material/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                placeholder="<?php echo get_phrase('select_date');?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        </div>
                        <span></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="title" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-5">
                            <textarea name="description" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" id="class_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Class">
                            <option id="one" style="font-size: 15px" value="">Select Class</option>
                        <!-- <option id="one" style="display: none"></option> -->
                                <?php foreach ($class_info as $row) { ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>

                        <div class="col-sm-5">
                            <select name="subject_id" id="subject_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Subject">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('file_type'); ?></label>

                        <div class="col-sm-5">
                            <select name="file_type" class="form-control selectboxit">
                                <option value=""><?php echo get_phrase('select_file_type'); ?></option>
                                <option value="image"><?php echo get_phrase('image'); ?></option>
                                <option value="doc"><?php echo get_phrase('doc'); ?></option>
                                <option value="pdf"><?php echo get_phrase('pdf'); ?></option>
                                <option value="excel"><?php echo get_phrase('excel'); ?></option>
                                <option value="other"><?php echo get_phrase('other'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success"><?php echo get_phrase('upload');?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
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

});
    /*function onclik(){
    //$('#class_id').data("selectBox-selectBoxIt").remove(0);
    //showFirstOption: false
    }*/

    /*$('#subject_id').change(function () {
        var sectionid = this.value;
        alert(sectionid);
    });*/

    $('#class_id').change(function () {
        var classid = this.value;
        if(classid==""){
            //alert("hi");
            $('#subject_id').data("selectBox-selectBoxIt").remove();
        }
        else {
            $.ajax({
            url: '<?php echo base_url();?>index.php?admin/subject_data/' +classid ,
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
        
});

    
</script>