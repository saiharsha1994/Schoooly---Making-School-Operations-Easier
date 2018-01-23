<hr />

<?php echo form_open(base_url() . 'index.php?admin/submit_view_attendance/');?>
<div class="row">
<?php
		 $classes = $this->db->get('class')->result_array();
		
	?>
	<div class="form-group col-md-4 col-sm-offset-1">
		<div class="form-group">
		<label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('class');?></label>
		<div class="col-sm-9">
			<select class="form-control selectboxit" name="class_id"  id="class_id">
			<option value=""><?php echo get_phrase('select_class');?></option>
				<?php foreach ($classes as $row):?>
					<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
			</div>
		</div>
	</div>
		

	<div class="form-group col-md-4">
                <label class="col-sm-2 control-label" style="padding-top: 8px;">Section</label>
                <div class="form-group col-sm-9">
                <select name="section_id" id="section_id" class="form-control selectboxit" data-validate="required" data-message-required="Please Select Section">
                </select>
                <span id="section_id1" style=" color: red"></span>
                </div>
            </div>

            <div class="form-group col-md-3">
                <label class="col-sm-2 control-label" style="padding-top: 8px;">Month</label>
                <div class="form-group col-sm-9">
                <select name="month" id="month" class="form-control selectboxit" data-validate="required" data-message-required="Please Select month">
                <option value="0">select month</option>
                <option value="January">Jan</option>
                <option value="February">Feb</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">Aug</option>
                <option value="September">Sep</option>
                <option value="October">Oct</option>
                <option value="November">Nov</option>
                <option value="December">Dec</option>
                </select>
                <span id="month_id1" style=" color: red"></span>
                </div>
            </div>
            </div>
            <div class="row">
	<div class="form-group col-md-4 col-sm-offset-1">
    <?php
         $year = $this->db->get('academic_year')->result_array();
        
    ?>
                <label class="col-sm-2 control-label" style="padding-top: 8px;">Year</label>
                <div class="form-group col-sm-9">
                <select name="year" id="year" class="form-control selectboxit" data-validate="required" data-message-required="Please Select month">
                <option value="0">select academic year</option>
                <?php foreach ($year as $row):?>

                    <option value="<?php echo $row['ac_id'];?>"><?php echo $row['academic_year'];?></option>
                <?php endforeach;?>
                
                </select>
                <span id="month_id1" style=" color: red"></span>
                </div>
            </div>

	<div class="form-group col-md-4 text-center">
		<button id="submit"  name="submit" class="btn btn-info" disabled>Get Attendance List</button>
	</div>

</div>
<?php echo form_close();?>

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
            
            var classid = this.value;
            if(classid==""){
                //alert("hi");
                $('#section_id').data("selectBox-selectBoxIt").remove();
            }
            else {
                $.ajax({
                url: '<?php echo base_url();?>index.php?admin/section_ajax/' +classid ,
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

    