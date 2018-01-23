<head>
    <style type="text/css">
    <?php 
    $weekends       =   $this->db->get_where('settings', array('type' => 'weekends'))->row()->description;
            if($weekends!='')
            {
                $w=explode(',', $weekends);
            }
            foreach ($w as $row) {
                if($row!=''){

                    if($row=='monday'){?>
                        .fc-mon {
                         background-color: #cccccc;}
                    <?php } if($row=='tuesday'){?>
                        .fc-tue {
                         background-color: #cccccc;}
                    <?php } if($row=='wednesday'){?>
                        .fc-wed {
                         background-color: #cccccc;}
                    <?php } if($row=='thursday'){?>
                        .fc-thu {
                         background-color: #cccccc;}
                    <?php } if($row=='friday'){?>
                        .fc-fri {
                         background-color: #cccccc;}
                    <?php } if($row=='saturday'){?>
                        .fc-sat {
                         background-color: #cccccc;}
                    <?php } if($row=='sunday'){?>
                        .fc-sun {
                         background-color: #cccccc;}
                    <?php }
                }
            }?>
    

    </style>
</head>

<hr />

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('noticeboard_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('student');?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                </div>
                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('employee_details');?>" 
                            data-postfix="" data-duration="800" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('employee');?></h3>
                   <p>Total Employees</p>
                </div>
                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('parent');?>" 
                            data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('parent');?></h3>
                   <p>Total parents</p>
                </div>
                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php 
                        $check  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                        $query = $this->db->get_where('attendance' , $check);
                        $present_today      =   $query->num_rows();
                        ?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>" 
                            data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('attendance');?></h3>
                   <p>Total present student today</p>
                </div>
                
            </div>
        </div>
    </div>
    
</div>



    <script>
  $(document).ready(function() {
      
      var calendar = $('#notice_calendar');
                
                $('#notice_calendar').fullCalendar({
                    header: {
                        left: 'title',
                        right: 'today prev,next'
                    },
                    
                    //defaultView: 'basicWeek',
                    
                    editable: false,
                    firstDay: 1,
                    height: 530,
                    droppable: false,
                    
                    events: [
                        <?php 
                        $notices    =   $this->db->get('noticeboard')->result_array();
                        
                        foreach($notices as $row):
                        ?>
                        {
                            title: "<?php echo $row['notice_title'];?>",
                            start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
                            end:    new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
                        },


                        <?php 
                        endforeach
                        ?>


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
                        <?php 
                        $vacation    =   $this->db->get('vacation_additional_break')->result_array();
                        
                        foreach($vacation as $row):
                        ?>
                        {
                            title: "<?php echo $row['title'];?>",
                            backgroundColor  : '#006400',
                            start: "<?php echo date($row['from_date']);?>", 
                            end:  "<?php echo date($row['to_date']);?> "
                            
                        },
                      

                        <?php 
                        endforeach
                        ?>
            
            
                        
                    ]

                });

                $('#notice_calendar').css('.fc-fri','color:blue');

    });
  </script>

  
