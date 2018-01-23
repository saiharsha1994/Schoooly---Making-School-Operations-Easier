<hr />

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<div class="row">

	<div class="col-md-12">
		
		<?php  echo form_open(base_url() . 'index.php?admin/exam_table_add_to_db' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>


        <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('exam');?></label>
                <div class="col-sm-5">
                <select name="exam_title" class="form-control selectboxit" style="width:100%;"
                        onchange="getDateDetails1(this.value)" >
                        <option value=""><?php echo get_phrase('select_exam');?></option>
                        <?php 
                        $exam_schedule = $this->db->get('exam_schedule')->result_array();
                        foreach($exam_schedule as $row):
                        ?>
                            <option value="<?php echo $row['title'].",".$row['_id'];?>" ><?php echo $row['title'];?>
                            </option>

                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                <div class="col-sm-5">
                    <select name="class_id" class="form-control selectboxit" style="width:100%;"
                        onchange="return get_class_section_subject(this.value)" id="class_id">
                        <option value=""><?php echo get_phrase('select_class');?></option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>" <?=$row['class_id'] == $class_id ? ' selected="selected"' : '';?>><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div id="section_subject_selection_holder"></div>
             
            <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
            <div id="notice_calendar"></div>
            </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                <div class="col-sm-5">
                <input type="text" class="form-control" name="contract_date" id="datepicker" required/>
                
                </div>
            </div>


            <div class="form-group" id="time_start" >
                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                <div class="col-sm-6">
                    <div class="col-md-3">
                        <select name="time_start" id="time_start" class="form-control selectboxit" onchange="enableEnd()">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                                            </div>
                    <div class="col-md-3">
                        <select name="time_start_min" class="form-control selectboxit" required>
                            <option value=""><?php echo get_phrase('minutes');?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control selectboxit">
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" id="time_end">
                <label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_end" required id="time_end" class="form-control selectboxit" onchange="enablesubmit()" >
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" required class="form-control selectboxit" >
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>
        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" id="submit" class="btn btn-info" disabled><?php echo get_phrase('submit');?></button>
              </div>
            </div>
    <?php echo form_close();?>

	</div>
</div>


<script type="text/javascript">
$('#time_start').hide();
$('#time_end').hide();
$('#datepicker').datepicker();

        function enableEnd(){
            $('#time_end').show();
        }

        function enablesubmit(){
            document.getElementById("submit").disabled=false;
        }
    function getDateDetails1(data){
        $('#time_start').show();
        document.getElementById("notice_calendar").innerHTML = "";
        var calendar = $('#notice_calendar');
                
                $('#notice_calendar').fullCalendar({
                    header: {
                        // left: 'title',
                         right: 'prev , next'
                    },
                    
                    //defaultView: 'basicWeek',
                    
                    editable: false,
                    firstDay: 1,
                    height: 100,
                    width:200,
                    droppable: false,
                    
                    events: [

                        <?php 
                        
                        $exam_schedule    =   $this->db->get('exam_schedule')->result_array();
                        foreach($exam_schedule as $row):
                        ?>
                        {
                            title: "<?php echo $row['title'];?>",
                            backgroundColor  : '#cccc00',
                            start: "<?php echo date($row['from_date']);?>", 
                            end:  "<?php echo date($row['to_date']);?> "
                            
                        },
                      

                        <?php 
                        endforeach
                        ?>
                        
                    ]

                });

}




jQuery(document).ready(function(){
	console.log('I am here');
	var class_id = jQuery('#class_id').val();
	console.log(jQuery('#class_id').val());	
	if(!isNaN(class_id)){
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
	}	
});	
    function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>