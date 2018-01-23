<hr />

<?php echo form_open(base_url() . 'index.php?admin/submit_view_attendance_bus/');?>
<div class="row">
<?php
         $bus_details = $this->db->get('bus_details')->result_array();
        
    ?>
    <div class="form-group col-md-4 col-sm-offset-1">
        <div class="form-group">
        <label class="col-sm-2 control-label" style="padding-top: 8px;"><?php echo get_phrase('bus');?></label>
        <div class="col-sm-9">
            <select class="form-control selectboxit" name="bus_Id"  id="bus_Id" onchange="enable_month()">
            <option value="0"><?php echo get_phrase('select_bus');?></option>
                <?php foreach ($bus_details as $row):?>
                    <option value="<?php echo $row['bus_Id'];?>"><?php echo $row['name'];?></option>
                <?php endforeach;?>
            </select>
            </div>
        </div>
    </div>
        
            <div class="form-group col-md-3">
                <label class="col-sm-2 control-label" style="padding-top: 8px;">Month</label>
                <div class="form-group col-sm-9">
                <select name="month" id="month" class="form-control selectboxit" data-validate="required" data-message-required="Please Select month" disabled>
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

    <div class="form-group col-md-4">
        <button id="submit"  name="submit" class="btn btn-info" disabled>Get Attendance List</button>
    </div>

</div>
<?php echo form_close();?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#month').change(function () {
            var z=document.getElementById("month").value;
            if(!z || z=="0"){
                document.getElementById("submit").disabled=true;
            }else{
                document.getElementById("submit").disabled=false;
            
            }
        });
            
});

    function enable_month(){
        var z=document.getElementById("bus_Id").value;
         if(!z || z=="0"){
            $('#month').data('selectBox-selectBoxIt').disable();
            document.getElementById("submit").disabled=true;
         }else{
            $('#month').data('selectBox-selectBoxIt').enable();
         }
       
    }


    </script>

    