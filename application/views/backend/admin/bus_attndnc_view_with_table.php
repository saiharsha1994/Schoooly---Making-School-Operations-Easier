<hr />
<?php 
$st_count="";
   $arr['student_list']=array();
?>
 <style type="text/css">

 .font-bold {
color: black;}
 .table-responsive 
{   
    
    overflow-x: scroll;   
    overflow-y: scroll;     
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
   
}

#columnchart_material {
 overflow-x: scroll; 
 overflow-y: hidden;     

}
 </style>
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

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Report</a></li>
    <li><a data-toggle="tab" href="#menu1">Summary</a></li>
     <li><a data-toggle="tab" href="#menu2">chart_view</a></li>
   
  </ul>
  <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
        <div style="overflow-x:auto ">
        <div class="row">
        <div class="col-sm-6">
            <button class="btn btn-default" style="background: white"><span class="badge" style="background: #F5E3CB;color: black">P</span> Pickup-in</button><br>
            <button class="btn btn-default" style="background: white"><span class="badge" style="background: #F5E3CB;color: black">P</span> Pickup-out</button><br>
            <button class="btn btn-default" style="background: white"><span class="badge" style="background: #F5E3CB;color: black">P</span> Drop-in</button><br>
            <button class="btn btn-default" style="background: white"><span class="badge" style="background: #F5E3CB;color: black">P</span> Drop-out</button>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12" style="margin: 5px;text-align: center;">
          <button class="btn btn-default btn-sm" style="background-color: #F5E3CB;color: black">P</button><a style="color: black">Present</a>
          <button class="btn btn-default btn-sm" style="background-color: #FF9354;color: black">A</button><a style="color: black">Absent</a>
          <button class="btn btn-default btn-sm" style="background-color: #DAEEF3;color: black">U</button><a style="color: black">Unexecuted</a>
          <button class="btn btn-default pull-right" onclick="printData()">print</button>
        <button class="btn btn-default pull-right" id="btnExport">Excel</button>
        </div>
        </div>
        </div>
        
<table class="table table-bordered datatable" id="table_export1">
    <thead>
        <tr>
            <th style="background-color: #4BACC6;color: white;text-align: center;"><div><?php echo get_phrase('roll');?></div></th>
            <th style="background-color: #4BACC6;color: white;text-align: center;"><div><?php echo get_phrase('name');?></div></th>
            <?php 
            $count_print=1;
            foreach ($month_days as $row) {
            ?>
            <th style="background-color: #4BACC6;color: white">
            
            <div style="text-align: center;">
            
            <?php echo get_phrase($row);

           
            ?>
            <?php echo $count_print;
             $count_print++;?>
              
            </div></th>
        <?php
                }
            ?>
            
        </tr>
    </thead>
    <tbody style="text-align: center;">
             <?php
            $count = 1; 
            $arr['present_counter']=array();
            $arr['absent_Counter']=array();
            $arr['leave_counter']=array();
            $arr['u_counter']=array();
            $arr['n_counter']=array();
            $arr['b_counter']=array();
            $arr['v_counter']=array();
            $sql="SELECT E.student_id,E.roll,S.name  FROM enroll E INNER JOIN student S ON
   E.student_id=S.student_id WHERE E.year='".$year_date."' AND S.assigned_bus='".$bus."' AND S.Admission_Status=1 AND S.Transport_Facility=1";
    $notices  =$this->db->query($sql)->result_array();
        
            foreach($notices as $row2):
              $p_count=0;
             $a_count=0; $l_count=0; $u_count=0; $n_count=0; $b_count=0; $v_count=0;?>
             
         <tr class="font-bold">
         <td><?php echo $row2['roll'];?></td>
         <td><?php echo $row2['name'];?></td>
         <?php 

         
            foreach ($dates as $row1) {
                $arr['tracker']=array();
                
                $this->db->where('att_date',$row1);
               
                 $this->db->where('student_id',$row2['student_id']);
                $q = $this->db->get('attendance_driver');
              
                if ($q->num_rows() > 0) 
                {
                    $attendance_date=$this->db->get_where('attendance_driver' , array('student_id' => $row2['student_id'],'att_date'=>$row1))->row()->att_date;
                    if($row1==$attendance_date){
                     
                          $trip_stat= $this->db->get_where('attendance_driver' , array('student_id' => $row2['student_id'],'att_date'=>$row1))->result_array();
                         $this->db->where('att_date',$row1);
                          $this->db->where('student_id',$row2['student_id']);
                          $zz = $this->db->get('attendance_driver');
                          $row_counter=0;
                          foreach ($trip_stat as $value) {
                            # code...
                            $row_counter=$value['trip_type'];
                          }

                           if($row_counter==2 && $zz->num_rows()==1){
                              array_push($arr['tracker'],0);
                                    array_push($arr['tracker'],0);
                            }
                            
                          foreach ($trip_stat as $val) {
                           
                              if($val['trip_type']==1){
                                    array_push($arr['tracker'],$val['in_status']);
                                    array_push($arr['tracker'],$val['out_status']);
                              }else{
                                    array_push($arr['tracker'],$val['in_status']);
                                    array_push($arr['tracker'],$val['out_status']);
                              }
                              
                          }
                          if($row_counter==1 && $zz->num_rows()){
                              array_push($arr['tracker'],0);
                                    array_push($arr['tracker'],0);
                            }


                     
            ?>

             <td>
                
                    <div class="row">
                <?php
                
                for($m=0;$m<4;$m++){
                            if($arr['tracker'][$m]==1){?>
                                    <div class="col-sm-12" style="border-style: ridge;background: #F5E3CB;color: black">P</div>
                                    
                                <?php
                                $p_count++;
                            }
                            if($arr['tracker'][$m]==2){?>
                                <div class="col-sm-12" style="border-style: ridge;background: #FF9354;color: black">A</div>
                                
                            <?php
                                $a_count++;
                             }
                             if($arr['tracker'][$m]==0 || empty($arr['tracker'][$m])){?>
                                <div class="col-sm-12" style="border-style: ridge;background: #DAEEF3;color: black">U</div>
                             <?php
                                $u_count++;
                            }

                    }


                    ?>
                  
                    </div>
                    </td>

            <?php
                }
            ?>

           
         
            <?php
                }else{
                    ?><td>
                    <div class="row">
                    <div class="col-sm-12" style="border-style: ridge;background: #DAEEF3;color: black">U<?php $u_count++;?>
                    </div>
                    <div class="col-sm-12" style="border-style: ridge;background: #DAEEF3;color: black">U<?php $u_count++;?></div>
                    <div class="col-sm-12" style="border-style: ridge;background: #DAEEF3;color: black">U<?php $u_count++;?></div>
                    <div class="col-sm-12" style="border-style: ridge;background: #DAEEF3;color: black">U<?php $u_count++;?></div>
                    </div>

        </td>
                    <?php

                
               }
                  
              
                    unset($trip_stat);
               unset($attendance_date);
             unset($attendance_stats);
            
            }

            array_push($arr['present_counter'], $p_count);
           array_push($arr['absent_Counter'], $a_count);
           array_push($arr['leave_counter'], $l_count);
           array_push($arr['u_counter'], $u_count);
           array_push($arr['n_counter'], $n_count);
           array_push($arr['b_counter'], $b_count);
           array_push($arr['v_counter'], $v_count);

            ?>
         </tr>
        <?php 

        endforeach;?>
        </tbody>
    </table>

</div>
    </div>

    <div id="menu1" class="tab-pane fade">
               
     <div style="overflow-x:auto">
     <div class="col-sm-12">
      <button id="btnExport_new" class="btn btn-default pull-right" style="margin: 5px">Excel</button>
      <button  class="btn btn-default pull-right" style="margin: 5px"  onclick="printData1()">Print</button>
     </div>
      <table class="table table-bordered datatable" id="table_export_new" border="1" cellspacing="0">

  <thead>
    <tr >
      <th style="text-align: center;"><div><?php echo get_phrase('roll_no');?></div></th>
            <th style="text-align: center;color: black"><div><?php echo get_phrase('student_name');?></div></th>
            <th style="text-align: center;background-color: #F5E3CB;color: black"><div><?php echo get_phrase('present');?></div></th>
            <th style="text-align: center;background-color: #FF9354;color: black"><div><?php echo get_phrase('absent');?></div></th>
            <th style="text-align: center;background-color:  #DAEEF3;color: black"><div><?php echo get_phrase('unexecuted');?></div></th>
    </tr>
  </thead>
    <tbody style="text-align: center;">
    <?php
      $count = 0; 
      $percentage_counter=0;
     $sql="SELECT E.student_id,E.roll,S.name  FROM enroll E INNER JOIN student S ON
   E.student_id=S.student_id WHERE E.year='".$year_date."' AND S.assigned_bus='".$bus."'";
    $student_count  =$this->db->query($sql)->result_array();
      $st_count=sizeof($student_count);
            foreach($student_count as $row_student):?>
        <tr class="font-bold">
          
        
                    <td><?php echo $row_student['roll'];?></td>
                    <td><?php echo $row_student['name'];?></td>
                   <td style="background-color: #F5E3CB"><?php echo $arr['present_counter'][$count];?></td>
                   <?php 

                        if($arr['present_counter'][$count]>$percentage_counter){
                            $percentage_counter=$arr['present_counter'][$count];
                        }
                   ?>
                    <td style="background-color: #FF9354"><?php echo $arr['absent_Counter'][$count];?></td> 
                    <td style="background-color:  #DAEEF3"><?php echo $arr['u_counter'][$count];?></td>


           <?php 
           //array_push($arr['student_list'], $this->db->get_where('student' , array('student_id' => $row_student['student_id']))->row()->name);
           array_push($arr['student_list'], $row_student['roll']);
           $count++;?>
           
        </tr>

        <?php 

        endforeach;?>
    </tbody>
  </table>
  <iframe id="txtArea1" style="display:none"></iframe>
  </div>
    
  </div>

    <div id="menu2" class="tab-panel fade" >
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var counter=0;
    var percentage_month="<?php echo $percentage_counter;?>";
    var month="<?php echo sizeof($month_days);?>";
    var new_arr=new Array();
  var st_count="<?php echo $st_count?>";
  var js_array =<?php echo json_encode($arr['student_list'] );?>;

  var present_countr=<?php echo json_encode($arr['present_counter']);?>;
  var absent_countr=<?php echo json_encode($arr['absent_Counter']);?>;
  var st1=['Name', 'Absent%', 'Present%'];
  new_arr.push(st1);
    for(var i=0;i<js_array.length;i++){
//var str2=['student new one',80,10];
     var str2=[js_array[i],(absent_countr[i]*100)/percentage_month,(present_countr[i]*100)/percentage_month];
    
    new_arr.push(str2);

    }
  
  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
    
      

      function drawChart() {
        
        var data = google.visualization.arrayToDataTable(new_arr);
      

        var options = {
          title: 'Attendance percentage',
          hAxis: {title: 'Student List', titleTextStyle: {color: 'black'}},
           legend: { position: 'left'},
           
           colors: ['#e6693e','#e0440e'],
          width: data.getNumberOfRows() * 110,
          isStacked: true,
          height: 500,
          vAxis: {minValue: 0}
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div class="row">
<div class="col-sm-12">
      
      <button id="btnExport_chart" class="btn btn-success btn-lg pull-right" style="margin: 5px"  onclick="printData_chart()">Print</button>
     </div>
</div>
    <div class="container" style="margin-top: 10px">

    <table class="table table-responsive" id="table_chart">
      <div id="columnchart_material" style="height: 500px;"></div>
    </table>
    </div>
    

    </div>

  </div>
<script src="<?php echo base_url('assets/js/jquery.table2excel.js');?>"></script>
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

    jQuery(document).ready(function($)
 {

 $("#btnExport_new").click(function(){
  $("#table_export_new").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "Bus_Attendance_summary" //do not include extension
  });
});

 $("#btnExport").click(function(){
  $("#table_export1").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "Total_Bus_Attendance_count" //do not include extension
  });
});

  
  var datatable = $("#table_export_new").dataTable({
   "sPaginationType": "bootstrap",
   "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
   "oTableTools": {
    "aButtons": [
     
    ]
   },
   
  });
  $("#table_export1").dataTable({
   "sPaginationType": "bootstrap",
  });
  
  $(".dataTables_wrapper select").select2({
   minimumResultsForSearch: -1
  });
 });

    var datatable = $("#table_export").dataTable({
   "sPaginationType": "bootstrap",
   "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
   "oTableTools": {
    "aButtons": [
     
     {
      "sExtends": "xls",
      "mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33]
     },
     {
      "sExtends": "pdf",
      "mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32]
     },
     {
      "sExtends": "print",
      "fnSetText"    : "Press 'esc' to return",
      "fnClick": function (nButton, oConfig) {
        datatable.fnSetColumnVis(0, true);
       datatable.fnSetColumnVis(<?php echo $month_counter;?>, true);
       
       this.fnPrint( true, oConfig );
       
       window.print();
       
       $(window).keyup(function(e) {
          if (e.which == 32) {
           datatable.fnSetColumnVis(0, true);
           datatable.fnSetColumnVis(<?php echo $month_counter;?>, true);
          }
       });
      },
      
     },
    ]
   },
   
  });

    function printData1() {
    var a = document.getElementById("table_export_new");
    newWin = window.open(""), newWin.document.write(a.outerHTML), newWin.print(), newWin.close()
}

function printData() {
    var a = document.getElementById("table_export1");
    newWin = window.open(""), newWin.document.write(a.outerHTML), newWin.print(), newWin.close()
}
 function printData_chart() {
    var a = document.getElementById("columnchart_material");
    newWin = window.open(""), newWin.document.write(a.outerHTML), newWin.print(), newWin.close()
}
    </script>

    