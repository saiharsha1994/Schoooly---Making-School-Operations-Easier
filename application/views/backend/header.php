<head>
    <style>
    .myautoscroll::-webkit-scrollbar  {
       width: .6em;
    }
    .myautoscroll::-webkit-scrollbar-track{
        border-radius:10px;
       -webkit-box-shadow:0 0 6px #D3D3D3 inset;
    }  
    .myautoscroll::-webkit-scrollbar-thumb{
       background-color:#C0C0C0;
       border-radius:10px;
    }

    div.myautoscroll {
           
            overflow: hidden;
        }
        div.myautoscroll:hover {
            overflow: auto;
        }
        div.myautoscroll p {
            
        }
        div.myautoscroll:hover {
            padding-right: 0px;
        }
   
    #noti_Container {
        position:relative;
    }
       
    #noti_Counter {
        display:block;
        position:absolute;
        background:#E1141E;
        color:#FFF;
        font-size:12px;
        font-weight:normal;
        padding:2px 5px;
        margin:-8px 0 0 5px;
        border-radius:50%;
        -moz-border-radius:50%; 
        -webkit-border-radius:50%;
        z-index:1;
    }
        
    /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
    #notifications {
        display:none;
        width:350px;
        position:absolute;
        top:30px;
        left:-304px;
        background:#FFF;
        border:solid 1px rgba(100, 100, 100, .20);
        -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
        z-index: 100;
    }
    /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
    #notifications:before {         
        content: '';
        display:block;
        width:0;
        height:0;
        color:transparent;
        border:10px solid #CCC;
        border-color:transparent transparent #F0F0F0;
        margin-top:-20px;
        margin-left:306px;
    }
        
    h3 {
        display:block;
        color:#333; 
        /*background:#FFF;*/
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
        /*border-bottom:solid 1px rgba(100, 100, 100, .30);*/
    }
        
    .seeAll {
        background:#F6F7F8;
        padding:8px;
        font-size:12px;
        font-weight:bold;
        border-top:solid 1px rgba(100, 100, 100, .30);
        text-align:center;
    }
    .seeAll a {
        color:#3b5998;
    }
    .seeAll a:hover {
        background:#F6F7F8;
        color:#3b5998;
        text-decoration:underline;
    }
    .msg {
       
        padding:20px;
        font-size:12px;
        font-weight:bold;
        border-top:solid 1px rgba(100, 100, 100, .30);
        
    }


        
</style>
</head>
<div class="row">
      
    <?php 
        if ($this->session->userdata('parent_login') == 1) {
            echo '<div class="pull-right" style="width:; height:; background: ; margin-right: 25px; display:"><ul style="list-style:none; display:block; height:21px; padding:12px 10px; display:block;"><li id="noti_Container" style="float:left; font:13px helvetica; font-weight:bold; margin:3px 0;"><div id="noti_Counter" style="display: none;"></div><a href="" id="noti_Button" ><img src="https://maxcdn.icons8.com/windows8/PNG/26/Messaging/message-26.png" title="Message" width="26"></a><div id="notifications" style=""><h3 style="background: #F0F0F0;">Notifications</h3><div class="myautoscroll" onscroll="myFunction()"><div style="height:230px; width: 340px;" onscroll="myFunction()" id="msgDiv"></div></div><div class="seeAll" style="background: #F0F0F0;"><a href="index.php?parents/notifications/"></a></div></div></li></ul></div>';
        }
        if ($this->session->userdata('teacher_login') == 1) {
            echo '<div class="pull-right" style="width:; height:; background: ; margin-right: 25px; display:">
				<ul style="list-style:none; display:block; height:21px; padding:12px 10px; display:block;">
					<li id="noti_Container" style="float:left; font:13px helvetica; font-weight:bold; margin:3px 0;">
						<div id="noti_Counter" style="display: none;"></div>
						<a href="" id="noti_Button" >
							<img src="https://maxcdn.icons8.com/windows8/PNG/26/Messaging/message-26.png" title="Message" width="26"></a>
							<div id="notifications" style="">
								<h3 style="background: #F0F0F0;">Notifications</h3>
								<div class="myautoscroll" onscroll="myFunction()">
								<div style="height:230px; width: 340px;" onscroll="myFunction()" id="msgDiv"></div>
							</div>
							<div class="seeAll" style="background: #F0F0F0;">
								<a href="index.php?admin/notifications/"></a>
							</div>
						</div>
					</li>
				</ul>
			</div>';
        }
    ?>

    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:200; margin:0px;"><?php echo $system_name;?></h2>
    </div>
    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix ">
        
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
            <div id="session_static">           
               <li>
                    <h4>
                        <a href="#" style="color: #696969;"
                            <?php if($account_type == 'admin'):?> 
                            onclick="get_session_changer()"
                        <?php endif;?>>
                            <?php echo get_phrase('running_session');?> : <?php echo $running_year;?>
                        </a>
                    </h4>
               </li>
           </div>
        </ul>
        
        
        <ul class="list-inline links-list pull-right">

        <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                            <i class="entypo-user"></i> <?php echo $this->session->userdata('name');?>
                    </a>

                <?php if ($account_type != 'parent'):?>
                <ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
                    <li>
                        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                            <i class="entypo-info"></i>
                            <span><?php echo get_phrase('edit_profile');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                            <i class="entypo-key"></i>
                            <span><?php echo get_phrase('change_password');?></span>
                        </a>
                    </li>
                </ul>
                <?php endif;?>
                <?php if ($account_type == 'parent'):?>
                <ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
                    <li>
                        <a href="<?php echo base_url();?>index.php?parents/manage_profile">
                            <i class="entypo-info"></i>
                            <span><?php echo get_phrase('edit_profile');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php?parents/manage_profile">
                            <i class="entypo-key"></i>
                            <span><?php echo get_phrase('change_password');?></span>
                        </a>
                    </li>
                </ul>
                <?php endif;?>
            </li>
            
            <li>
                <a href="<?php echo base_url();?>index.php?login/logout">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>
    </div>
    
</div>

<hr style="margin-top:0px;" />

<script type="text/javascript">
    function get_session_changer()
    {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_session_changer/',
            success: function(response)
            {
                jQuery('#session_static').html(response);
            }
        });
    }
</script>

<script>
    $(document).ready(function () {

        //$('#noti_Counter').fadeOut('fast');
        //for parent ////////////////////////////////////////////////////////////////////////////////
        <?php 
        if ($this->session->userdata('parent_login') == 1) {?>
            notifications_count('<?php echo $parent_id = $this->session->userdata('parent_id'); ?>');
            //alert(<?php $parent_id?>);
        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.

        $('#noti_Button').click(function () {
            //alert("notifications")
            fill_msg('<?php echo $parent_id = $this->session->userdata('parent_id'); ?>');
            // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
            $('#notifications').fadeToggle('fast', 'linear', function () {
                if ($('#notifications').is(':hidden')) {
                    //$('#noti_Button').css('background-color', '');
                }
                else $('#noti_Button').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
            });

            $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.

            return false;
        });

        // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
        $(document).click(function () {
            $('#notifications').hide();

            // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
            if ($('#noti_Counter').is(':hidden')) {
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                //$('#noti_Button').css('background-color', '#2E467C');
            }
        });

        $('#notifications').click(function () {
            //return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
            //alert("notifications")
        });

        /*function fill_msg(){

            //$('#msgDiv').empty();
            
        }*/

    function fill_msg(parent_id){
        $('#msgDiv').empty();

            var url = '<?php echo base_url();?>index.php?parents/get_notifications_order_by_time/' + parent_id;
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                dataType: "JSON",
                async: false,
                success: function(data){
                    //alert(data);
                    drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

            change_status(parent_id);
    }

    //*************  **************//
    function fill_msg2(parent_id){
        //$('#msgDiv').empty();

            var url = '<?php echo base_url();?>index.php?parents/get_notifications2/' + parent_id;
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                dataType: "JSON",
                async: false,
                success: function(data){
                    //alert(data);
                    drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

            //change_status(parent_id);
    }

    function drawTable(data) {

    if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          drawRow(data[i]);
        }
    }
}

function drawRow(rowData) {

    var msg = rowData.alert_msg;
    $('#msgDiv').append("<div class='msg' style='height: 80px; padding-top: 5%; padding-buttom: 5%;'>" + msg + "</div>");
}


       
        /*$(".myautoscroll").scroll(function(){
          alert("scroll")
        });*/


    function notifications_count(parent_id){
        var url;
        var data;

            url = '<?php echo base_url();?>index.php?parents/get_notifications/' + parent_id;
            //data = "parent_id="+parent_id;
        
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                dataType: "JSON",
                success: function(data){
                    //alert(data.length);
                    if (data.length > 0) {
                        $('#noti_Counter')
                        .text(data.length); 
                        $('#noti_Counter').fadeIn('fast'); 


                    }

            
                }
            });

    }

        //**** changes the notifications status ****//
        function change_status(parent_id){
            //alert(parent_id)
            var url = '<?php echo base_url();?>index.php?parents/change_notifications_status/' + parent_id;
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                //dataType: "JSON",
                async: false,
                success: function(data){
                    //alert(data);
                    //drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

            //fill_msg2(parent_id);
        }
            <?php } ?>

        //for teacher//////////////////////////////////////////////////////////////////////////////////
        <?php 
        if ($this->session->userdata('teacher_login') == 1) {?>
            notifications_count('<?php echo $teacher_id = $this->session->userdata('teacher_id'); ?>');
            //alert(<?php echo $teacher_id ?>);

        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.

        $('#noti_Button').click(function () {
            //alert("notifications")
            fill_msg('<?php echo $teacher_id = $this->session->userdata('teacher_id'); ?>');
            // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
            $('#notifications').fadeToggle('fast', 'linear', function () {
                if ($('#notifications').is(':hidden')) {
                    //$('#noti_Button').css('background-color', '');
                }
                else $('#noti_Button').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
            });

            $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.

            return false;
        });

        // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
        $(document).click(function () {
            $('#notifications').hide();

            // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
            if ($('#noti_Counter').is(':hidden')) {
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                //$('#noti_Button').css('background-color', '#2E467C');
            }
        });

        $('#notifications').click(function () {
            //return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
            //alert("notifications")
        });

        /*function fill_msg(){

            //$('#msgDiv').empty();
            
        }*/

    function fill_msg(teacher_id){
        $('#msgDiv').empty();

            var url = '<?php echo base_url();?>index.php?admin/get_notifications_order_by_time/' + teacher_id;
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                dataType: "JSON",
                async: false,
                success: function(data){
                    //alert(data);
                    drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

            change_status(teacher_id);
    }

    //*************  **************//
    function drawTable(data) {

    if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          drawRow(data[i]);
        }
    }
}

function drawRow(rowData) {

    var msg = rowData.alert_msg;
    $('#msgDiv').append("<div class='msg' style=' padding-top: 4%; padding-buttom: 4%;'>" + msg + "</div>");
}

    function notifications_count(teacher_id){
        var url;
        var data;

            url = '<?php echo base_url();?>index.php?admin/get_notifications/' + teacher_id;
            //data = "parent_id="+parent_id;
        
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                dataType: "JSON",
                success: function(data){
                    //alert(data.length);
                    if (data.length > 0) {
                        $('#noti_Counter')
                        .text(data.length); 
                        $('#noti_Counter').fadeIn('fast'); 


                    }

            
                }
            });

    }

        //**** changes the notifications status ****//
        function change_status(teacher_id){
            //alert(parent_id)
            var url = '<?php echo base_url();?>index.php?admin/change_notifications_status/' + teacher_id;
         //alert(url)

            $.ajax({
                url : url ,
                //type: "POST",
                //data: data ,
                //dataType: "JSON",
                async: false,
                success: function(data){
                    //alert(data);
                    //drawTable(data);
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

            //fill_msg2(parent_id);
        }
            <?php } ?>    
    });
</script>