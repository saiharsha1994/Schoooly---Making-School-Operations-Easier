<head>
</head>
<hr />
<center><div style="width: 300px;" class="pull-right" id="result" class=""></div></center>
<div class="jumbotron-fluid" style="height: 70px;"></div>
<div class="row">

    <div class="col-md-12">
    
        
        <ul class="nav nav-tabs bordered" style="background: ;">
            <li>
                <a href="">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('list_all_students');?></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('sort_by_class');?></span>
                    <span>
                    <select class="" ONCHANGE="get_class_sections(this.value)" id="class_id">
                      <option value="" ><?php echo get_phrase('select_class');?></option>
                      <?php 
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                      ?>
                      <option value="<?php echo $row['class_id'];?>">
                        <?php echo $row['name'];?>
                      </option>
                    <?php
                    endforeach;
                    ?>
                    </select>
                </span>

                </a>
            </li>

            <!-- <li>
                <a href="#">
                <span class="visible-xs"><i class="entypo-users"></i></span>
                <span>
                    <select class="" ONCHANGE="change_bus(this)">
                      <option style="display: none;">Select Class</option>
                      <option>LKG</option>
                      <option>UKG</option>
                    </select>
                </span>
                  
                </a>
            </li> -->

            <li>
                <a href="#" id="selectBySection">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('sort_by_section');?></span>
                    <span>
                    <select style="width: 101px;" class="" ONCHANGE="filter_data(this.value)" id="section_selector_holder">
                      <option value=""><?php echo get_phrase('select_section');?></option>
                     
                    </select>

                </span>

                </a>
            </li>

            <!-- <li>
                <a href="#" class="form-control">
                <span class="visible-xs"><i class="entypo-users"></i></span>
                <span>
                    <select class="" ONCHANGE="change_bus(this)">
                      <option style="display: none;">Select Section</option>
                      <option>A</option>
                      <option>B</option>
                    </select>
                </span>
                  
                </a>
            </li> -->
        
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <!-- <table class="table" id="table_export"> -->
                <table class="table" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><b><?php echo get_phrase('roll');?></b></div></th>
                            <th width="80"><div><b><?php echo get_phrase('photo');?></b></div></th>
                            <th><div><b><?php echo get_phrase('name');?></b></div></th>
                            <th class="span3"><div><b><?php echo get_phrase('address');?></b></div></th>
                            <th><div><b><?php echo get_phrase('parent');?></b></div></th>
                            <th><div><b><?php echo get_phrase('parent_email');?></b></div></th>
                            <th><div><b><?php echo get_phrase('options');?></b></div></th>
                        </tr>
                    </thead>
                    <tbody id="admissionDataTable">
                        
                    </tbody>
                </table>
                    
            </div>
        

        </div>
        
        
    </div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

jQuery(document).ready(function($)
  {
    

    var datatable = $("#table_export").dataTable({
      "sPaginationType": "bootstrap",
      "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
      "oTableTools": {
        "aButtons": [
          
          {
            "sExtends": "xls",
            "mColumns": [0, 2, 3, 4]
          },
          {
            "sExtends": "pdf",
            "mColumns": [0, 2, 3, 4]
          },
          {
            "sExtends": "print",
            "fnSetText"    : "Press 'esc' to return",
            "fnClick": function (nButton, oConfig) {
              datatable.fnSetColumnVis(1, false);
              datatable.fnSetColumnVis(5, false);
              
              this.fnPrint( true, oConfig );
              
              window.print();
              
              $(window).keyup(function(e) {
                  if (e.which == 27) {
                    datatable.fnSetColumnVis(1, true);
                    datatable.fnSetColumnVis(5, true);
                  }
              });
            },
            
          },
        ]
      },
      
    });
    
    $(".dataTables_wrapper select").select2({
      minimumResultsForSearch: -1
    });
  });


//Listing filtered data in table
$(document).ready(function(){
    fill_table(); 
});

    
function fill_table(){
       
    $("#admissionDataTable").empty();
    //var data = $('#getList').serialize();
    //alert(data)
    $.ajax({
      
        url : '<?php echo base_url();?>index.php?admin/get_rejected_data/',
        dataType: "JSON",
        success: function(data)
        {
             //alert(data[0].response)
             drawTable(data);
             

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('No data found!');
            $("#result").html('<div class="alert alert-danger"><strong>Error!</strong>  A problem has been occurred.</div>');
                    window.setTimeout(function() {
                       $(".alert").fadeTo(500, 0).slideUp(500, function(){
                       $(this).remove(); 
                       });
            }, 1000);
        }
    });

}

function drawTable(data) {

    if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          drawRow(data[i]);
        }
    }else{
        //alert("No records found")
        $("#result").html('<div class="alert alert-info"><strong>Info!</strong> Sorry No records found.</div>');
                    window.setTimeout(function() {
                       $(".alert").fadeTo(500, 0).slideUp(500, function(){
                       $(this).remove(); 
                       });
                    }, 1000);
    }
}

function drawRow(rowData) {

    var row = $("<tr />");

    $("#admissionDataTable").append(row); 
   // var img = '<img src="http://localhost/Schoooly/uploads/student_image/'+rowData.photo+'" class="img-circle" width="30"/>';
    row.append($("<td>" + rowData.student_code + "</td>"));
    //row.append($("<td>" + img + "</td>"));
	 row.append($('<td><img src=<?php echo base_url();?>uploads/student_image/'+rowData.photo+' class="img-circle" width="30"/></td>'));
	
    row.append($("<td>" + rowData.name + "</td>"));
    row.append($("<td>" + rowData.Area + "</td>"));
    row.append($("<td>" + rowData.parent_name + "</td>"));
    row.append($("<td>" + rowData.parent_email + "</td>"));
    row.append($("<td>" + rowData.btn + "</td>"));
    
}


    function showModalDelete(student_id){
         //alert(student_id)
         confirm_modal('<?php echo base_url();?>index.php?admin/rejected_admission_delete/delete/'+student_id+'');
    }

    function get_class_sections(class_id) {
      
      $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            async:false, 
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

      //select_class(class_id);
      filter_data();

  }

  var class_id;
  var section_id;

function filter_data(){
  $("#admissionDataTable").empty();
    class_id = document.getElementById('class_id').value;
    section_id = document.getElementById('section_selector_holder').value;
    //alert(class_id +' & '+ section_id)
    if (class_id == '') {
      fill_table();
    }
    else if (class_id !== '' && section_id !== '') {
      //alert(class_id +' & '+ section_id)
      get_filter_student(class_id, section_id);
    }else if(class_id !== ''){
      //alert(class_id +' & '+ section_id)
      get_filter_student1(class_id);
    }
}

function get_filter_student(class_id, section_id){
        var url;
        var data;

            url = '<?php echo base_url();?>index.php?admin/get_rejected_filter_data/';
            data = "class_id="+class_id+"&section_id="+section_id;
        
         //alert(url)
         //alert(data)
            $.ajax({
                url : url ,
                type: "POST",
                data: data ,
                dataType: "JSON",
                success: function(data){
                    //alert(data);
                    
                      drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

}


</script>