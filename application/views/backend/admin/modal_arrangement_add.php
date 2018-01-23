<?php 
$running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>


<script type="text/javascript">
    var class2_id=0;
    var click_Counter=0;var track_click_populate=0;
    var exam_id;var class_id_tracker=0;
    var class_id;var section_id;var remove_Section;var class_check;var class_track_id;
    var arr1=[],arr2=[],arr3=[],arr4=[],arr5=[],arr6=[],arr7=[],arr8=[];
    
</script>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('arrange_class');?>
                </div>
            </div>
            <div class="panel-body">
                <br><br><br>
                     <form class="form-horizontal" id="target"> 
                    <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo get_phrase('room');?></label>
                <div class="col-sm-4">
                <select id="exam_room" class="form-control selectboxit" style="width:100%;"
                        onchange="getSeatcapacity(this.value)" >
                        <option value=""><?php echo get_phrase('select_room');?></option>
                        <?php 
                        $exam_rooms = $this->db->get('exam_rooms')->result_array();
                        foreach($exam_rooms as $row):
                            if((int)$row['remaining_seats']>0){
                        ?>
                            <!-- <option value="<?php echo $row['room_name'].",".$row['room_id'];?>" ><?php echo $row['room_name'];?>
                            </option> -->
                            <option value="<?php echo $row['room_name']?>" ><?php echo $row['room_name'];?>
                            </option>

                        <?php
                    }
                        endforeach;
                        ?>
                    </select>
                </div>
                </div>
                    <input type="hidden" id="running_year" value=<?php echo $running_year;?>>
                    <input type="hidden" id="admin_id" value=<?php echo $this->session->userdata('login_user_id');?>>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('seat_capacity');?></label>
                        <div class="col-sm-4">
                        <div id="section_seat_holder" value="" class="form-control"></div>
                          <!--   <input type="text" class="form-control" id="section_seat_holder" name="section_seat_holder" value="" disabled /> -->
                        </div>

                   
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('exam');?></label>
                        <div class="col-sm-4" id="exam_id_div">
                        
                          <select  id="exam_id" class="form-control" style="width:100%;" onchange="setExamid(this.value)"  disabled 
                         >
                        <option value=""><?php echo get_phrase('select_exam');?></option>
                        <?php 
                        $exam_schedule = $this->db->get('exam_schedule')->result_array();
                        foreach($exam_schedule as $row):
                        ?>
                            <!-- <option value="<?php echo $row['room_name'].",".$row['room_id'];?>" ><?php echo $row['room_name'];?>
                            </option> -->
                            <option value="<?php echo $row['_id']?>" ><?php echo $row['title'];?>
                            </option>

                        <?php
                        endforeach;
                        ?>
                    </select>
                        </div>

                    <div class="edit-area">
                        <div class="btn btn-default"  style="color: white;background: white;border-color: white" >
                                <div class="btn btn-success controls">
                                    <div class="add" id="add"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo get_phrase('add_class');?></div>
                                </div>
                                <span id="error" style="color: red"></span>
                                </div>
                        </div>
                    </div>

                        <!-- inline form -->
                              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class1" class="form-inline form-control" style="width:100%;" 
                onmouseover ="getDataSection(this.value)" onchange="setClassData(this.value)" 
                         >
                        <option id="starti" value="starti"><?php echo get_phrase('class');?></option>
                    </select>
                    
                </div>
                </div>
                  <!-- inline form -->
                              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class2" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startii" value="startii"><?php echo get_phrase('class');?></option>
                    </select>
                </div>
                </div>

                <!-- inline form -->
                              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class3" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startiii" value="startiii"><?php echo get_phrase('class');?></option>
                       
                    </select>
                </div>
                </div>

                <!-- inline form -->
                              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class4" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startiv" value="startiv"><?php echo get_phrase('class');?></option>
                    </select>
                </div>
                </div>

                <!-- inline form -->
                              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class5" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startv" value="startv"><?php echo get_phrase('class');?></option>
                       
                    </select>
                </div>
                </div>
                <!-- inline form -->

                            <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class6" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startvi" value="startvi"><?php echo get_phrase('class');?></option>
                       
                    </select>
                </div>
                </div>


                <!-- inline form -->

                            <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class7" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startvii" value="startvii"><?php echo get_phrase('class');?></option>
                       
                    </select>
                </div>
                </div>

                <!-- inline form -->

                            <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-4 form-inline">
                <select  id="class8" class="form-inline form-control" style="width:100%;" 
                onmouseover="getDataSection(this.value)" onchange="setClassData(this.value)">
                        <option id="startviii" value="startviii"><?php echo get_phrase('class');?></option>
                    </select>
                </div>
                </div>

                <span id="class_details" value=""></span>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4 text-center">
                            <div type="submit" id="data_submit" onclick="submit()" class="btn btn-info center-block"><?php echo get_phrase('submit_arrangement');?></div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function submit(){

    var v1=document.getElementById('class1').value;
    var v2=document.getElementById('class2').value;
    var v3=document.getElementById('class3').value;
    var v4=document.getElementById('class4').value;
    var v5=document.getElementById('class5').value;
    var v6=document.getElementById('class6').value;
    var v7=document.getElementById('class7').value;
    var v8=document.getElementById('class8').value;

    var room=document.getElementById('exam_room').value;
    var running_year=document.getElementById('running_year').value;
    var admin_id=document.getElementById('admin_id').value;
    var exam_id=document.getElementById('exam_id').value;
    var seat_capacity=document.getElementById('section_seat_holder').value;

    var stu=room+","+running_year+","+admin_id+","+exam_id+","+seat_capacity.trim()+","+v1+","+v2+","+v3+","+v4+","
    +v5+","+v6+","+v7+","+v8;
  //alert(stu);
  //alert("hi");

  $.ajax({
            url: '<?php echo base_url();?>index.php?admin/getStudents_by_Class/' + stu ,
            success: function(response)
            {
                
                alert("<?php echo get_phrase('data_added_succesfully');?>");
            window.location.href="<?php echo base_url() . 'index.php?admin/class_arrangement/';?>";

             
          
                }  
            
        });
}



$(document).ready(function(){
     $("#class1").hide();
     $("#class2").hide();
      $("#class3").hide();
     $("#class4").hide();
      $("#class5").hide();
     $("#class6").hide();
     $("#class7").hide();
     $("#class8").hide();
     $("#data_submit").hide();
     // $("#data_submit").attr('disabled','disabled');
     //$('#data_submit[type=submit]').attr('disabled', true);
    $("#add").click(function(){
        if(exam_id==null){
            jQuery('#error').html("<?php echo get_phrase("select_exam_first");?>");
        }else{
            if(click_Counter==0 && track_click_populate==0){
                $("#class1").show();
                class_id="#class1";
                class_check="startii";
                class_track_id=0; 
                array_tracker=arr1;
                click_Counter++;
                track_click_populate=1;
        }
        if(click_Counter==1 && track_click_populate==0){
                $("#class2").show();
                class_id="#class2";
                class_check="startiii";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
                //$('#data_submit[type=submit]').attr('disabled', false);
                $("#data_submit").show();
               
        }
         if(click_Counter==2 && track_click_populate==0){
                $("#class3").show();
                class_id="#class3";
                class_check="startiv";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
               
        }
         if(click_Counter==3 && track_click_populate==0){
                $("#class4").show();
                class_id="#class4";
                class_check="startv";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
               
        }
         if(click_Counter==4 && track_click_populate==0){
                $("#class5").show();
                class_id="#class5";
                class_check="startvi";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
               
        }
        
        if(click_Counter==5 && track_click_populate==0){
                $("#class6").show();
                class_id="#class6";
                class_check="startvii";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
               
        }
        if(click_Counter==6 && track_click_populate==0){
                $("#class7").show();
                class_id="#class7";
                class_check="startviii";
                class_track_id=0;
                click_Counter++;
                track_click_populate=1;
               
        }
        if(click_Counter==7 && track_click_populate==0){
                $("#class8").show();
                class_id="#class8";
                class_check="startvix";
                class_track_id=0;
               click_Counter++;
               track_click_populate=1;
        }
        }
        
        
    });
});

function setExamid(data){
    exam_id=data;
jQuery('#error').html("");
}




function getDataSection(data1){
if(class_track_id>0){

}else{
    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_section_class/' + class_id_tracker ,
            success: function(response)
            {
                // alert(response);
                var obj = JSON.parse(response);
                var x1=[];var x2=[];
                x1=obj.d1;x2=obj.d2;

                for(var i=0;i<x1.length;i++){

                    
                    $(class_id)
                        .append($('<option>', { value : x2[i] })
                        .text(x1[i])); 
                    
                    }
                    // alert(i);
          
                }  
            
        });
    class_track_id++;

}

}

function setClassData(data){
        class_id_tracker=data;
        track_click_populate=0;
        //alert(class_id_tracker);
}


    function getSeatcapacity(data) {
        
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_room_seat_capacity/' + data ,
            success: function(response)
            {
                document.getElementById('section_seat_holder').value=response;
                jQuery('#section_seat_holder').html(response);
                $('#exam_id').prop('disabled', false);
            }
        });
     
    }


</script>