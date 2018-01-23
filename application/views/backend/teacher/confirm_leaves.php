        <hr />
        <?php $class_info = $this->db->get('class')->result_array(); ?>
        <?php echo form_open(base_url() . 'index.php?teacher/confirm_leaves_view/');?>
    <form method="POST">
        <div class="row">
            <div class="form-group col-md-4 col-sm-offset-1">
                <label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('class');?></label>
                <div class="col-sm-9">
                <select name="class_id" id="class_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Class">
                    <option value=""><?php echo get_phrase('select_class');?></option>
                    <?php foreach ($class_info as $row) { ?>
                            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="class_id1" style=" color: red"></span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('section');?></label>
                <div class="form-group col-sm-9">
                <select name="section_id" id="section_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select Section">
                </select>
                <span id="section_id1" style=" color: red"></span>
                </div>
            </div>
            
                            
            <div class="col-md-3" >
                <button id="submit"  name="submit" class="btn btn-info" disabled><?php echo get_phrase('get_list');?></button>
            </div>

        </div>
        </form>


    <script type="text/javascript">
    $(document).ready(function(){

        $('#section_id').change(function () {
            var z=document.getElementById("section_id").value;
            if(!z){
                document.getElementById("submit").disabled=true;
            }else{
                document.getElementById("submit").disabled=false;
            
            }
        });

        $('#class_id').change(function () {
            //alert("hi");
            var classid = this.value;
            if(classid==""){
                //alert("hi");
                $('#section_id').data("selectBox-selectBoxIt").remove();
            }
            else {
                $.ajax({
                url: '<?php echo base_url();?>index.php?teacher/section_data/' +classid ,
                async:false,
                success: function(response){
               
                    var obj = JSON.parse(response);
                    var x1=[];
                    x1=obj.section;
                    x2=obj.id;
                    if(x1.length>0){
                        $('#section_id').data("selectBox-selectBoxIt").remove();
                        $('#section_id')
                            .append($('<option>', { value : "" })
                            .text("Select Section"));
                    for(var i=0;i<x1.length;i++){
                        $('#section_id')
                            .append($('<option>', { value : x2[i] })
                            .text(x1[i]));  
                        }
                        $('#section_id').data("selectBox-selectBoxIt").refresh();
                    }
                    else {
                        $('#section_id').data("selectBox-selectBoxIt").remove();
                    } 
                }   
            });  
            }     
    });            
});

    </script>