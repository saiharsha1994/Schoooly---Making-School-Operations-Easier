<?php 
$class_info                 = $this->db->get('class')->result_array();
$single_study_material_info = $this->db->get_where('document', array('document_id' => $param2))->result_array();
foreach ($single_study_material_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('edit_study_material'); ?>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?teacher/study_material/update/<?php echo $row['document_id'] ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" id="dates" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                       placeholder="date here" value="<?php echo date("d M, Y", $row['timestamp']); ?>">
                                <span id="dates1" style=" color: red"></span>
                            </div>
                            <input type="hidden" value="<?php echo $row['document_id'] ?>" id="doc_id">
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" id="titles" name="title" class="form-control" id="field-1" value="<?php echo $row['title']; ?>">
                                <span id="titles1" style=" color: red"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-5">
                                <textarea name="description" id="description" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url(); ?>assets/css/wysihtml5-color.css"
                                          id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                            <div class="col-sm-5">
                            <span id="class_id1" style=" color: red"></span>
                                <select name="class_id" id="class_id" class="form-control selectboxit">
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php foreach ($class_info as $row2) { ?>
                                        <option value="<?php echo $row2['class_id']; ?>" <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
                            <div class="col-sm-5">
                            <span id="subject_id1" style=" color: red"></span>
                                <select name="subject_id" id="subject_id" class="form-control selectboxit">
                                <option selected style='display: none' value="<?php echo $row['subject_id']; ?>"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <div type="submit" class="btn btn-success" onclick="checkerrors()"><?php echo get_phrase('update');?></div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>


<script type="text/javascript"> 
    //Initial Load
    //window.onload = subjectnamelist;
    $(window).on('shown.bs.modal', function() { 
        var classid=document.getElementById("class_id").value;
        var subjectid=document.getElementById("subject_id").value;
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
                    $('[name=subject_id]').val( subjectid);
                    $('#subject_id').data("selectBox-selectBoxIt").refresh();
                }
                else {
                    $('#subject_id').data("selectBox-selectBoxIt").remove();
                } 
            } 
        });
         $(this).off('shown.bs.modal');
    });

    //onchanging the class
    $('#class_id').change(function () {
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
});
    function checkerrors(){
        var doc_id=document.getElementById("doc_id").value;
        var date=document.getElementById("dates").value;
        var title=document.getElementById("titles").value;
        var classid=document.getElementById("class_id").value;
        var subjectid=document.getElementById("subject_id").value;
        var des=document.getElementById("description").value;
        if(date==""){
            $("#dates1").text("Required Field");
            $("#titles1").text("");
            $("#class_id1").text("");
            $("#subject_id1").text("");
            return;
        }
        else {
            $("#dates1").text("");
        }
        if(title==""){
            $("#titles1").text("Required Field");
            $("#class_id1").text("");
            $("#subject_id1").text("");
            return;
        }
        else {
            $("#titles1").text("");
        }
        if(classid==""){
            $("#class_id1").text("Required Field");
            $("#subject_id1").text("");
            return;
        }
        else {
            $("#class_id1").text("");
        }
        if(subjectid==""){
            $("#subject_id1").text("Required Field");
            return;
        }
        else {
            $("#subject_id1").text("");
        }
        
        
        $.ajax({
            url: '<?php echo base_url();?>index.php?teacher/study_material/update/',
            type:"POST",
            data:{par0:doc_id,par1:date,par2:title,par3:classid,par4:subjectid,par5:des},
            
            success: function(response)
            {
             window.location.href="<?php echo base_url() . 'index.php?teacher/study_material/';?>";
            }
        });


    }
</script>