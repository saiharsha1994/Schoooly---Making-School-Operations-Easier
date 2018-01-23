        <hr />
        <?php 
        $class_info = $this->db->get('class')->result_array();
        $student_info = $this->db->get('student')->result_array(); 
        $section_data=$this->db->get_where('section' , array('class_id'=> $class_id))->result_array();
        $leavelist=$this->db->query("SELECT id,student_id,from_date,to_date,reason,status,reject_reason FROM leave_records WHERE student_id IN (SELECT student_id FROM student WHERE class_id='$class_id' AND section_id='$section_id') AND user_type=1 AND (status=2 OR status=3)")->result_array(); 

        ?> 
        <?php echo form_open(base_url() . 'index.php?teacher/pending_leaves_view/');?>
    <form method="POST">
        <div class="row">
            <div class="form-group col-md-4 col-sm-offset-1">
                <label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('class');?></label>
                <div class="col-sm-9">
                <select name="class_id" id="class_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select  Class">
                    <option value=""><?php echo get_phrase('select_class');?></option>
                    <?php foreach ($class_info as $row) { ?>
                            <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id) echo 'selected';?>><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="class_id1" style=" color: red"></span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('section');?></label>
                <div class="form-group col-sm-9">
                <select name="section_id" id="section_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select Section">
                <option value=""><?php echo get_phrase('select_section');?></option>
                    <?php foreach ($section_data as $row) { ?>
                            <option value="<?php echo $row['section_id']; ?>" <?php if($row['section_id'] == $section_id) echo 'selected';?>><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="section_id1" style=" color: red"></span>
                </div>
            </div>
            
                            
            <div class="col-md-3" >
                <button id="submit"  name="submit" class="btn btn-info"><?php echo get_phrase('get_list');?></button>
            </div>

        </div>
        </form>

        <hr/>
        <table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-2"><?php echo get_phrase('student_name');?></th>
            <th class="col-md-1.5"><?php echo get_phrase('from_date');?></th>
            <th class="col-md-1.5"><?php echo get_phrase('to_date');?></th>
            <th class="col-md-4"><?php echo get_phrase('reason');?></th>
            <th class="col-md-2"><?php echo get_phrase('status');?></th>
        </tr>
    </thead>
<tbody>
        <?php
        $count = 1;
        foreach ($leavelist as $row) { ?>   
        <tr>
            <td><?php echo $count++; ?></td>

            <?php foreach ($student_info as $row1) { ?>
                            <?php if($row1['student_id'] == $row['student_id']){?>
                                    <td><?php echo $row1['name'] ?></td>
                              <?php  }?>
                    <?php } ?>

            <!-- <td><?php echo date("d M, Y", $row['from_date']); ?></td>
            <td><?php echo date("d M, Y", $row['to_date']); ?></td>  -->
                <td><?php echo date("d-m-Y", strtotime($row['from_date'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['to_date'])); ?></td> 
                <td><?php echo $row['reason']?></td>
                <?php if($row['status']==2){?>
                    <td style="color: #00AD5E;">
                        <?php echo get_phrase('Leave Approved');?>
                    </td>
                    <?php }
                    elseif($row['status']==3){?>
                    <td>
                        <?php echo '<span style="color:#df1a1a;">Leave Rejected</span>';?>
                        <?php echo get_phrase('-');?>
                        <?php echo $row['reject_reason'];?>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>


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
            document.getElementById("submit").disabled=true;
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

    <script type="text/javascript">
            jQuery(window).load(function ()
            {
                var $ = jQuery;

                $("#table-2").dataTable({
                    "sPaginationType": "bootstrap",
                    "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
                });

                $(".dataTables_wrapper select").select2({
                    minimumResultsForSearch: -1
                });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
            $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>