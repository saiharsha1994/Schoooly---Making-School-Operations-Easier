<hr />

<div class="row" style="margin-top: 50px">

	<div class="col-md-12">
		
		<?php  echo form_open(base_url() . 'index.php?admin/add_room_to_db' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>

        <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo get_phrase('exam_room');?></label>
               
                <div class="col-sm-3">
                <input type="text" name="room_id" id="room_id" class="form-control" placeholder="<?php echo get_phrase('enter_room_number_/_id');?>" autocomplete="off" required>
                <span id="span_name"></span>
                </div>
                </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo get_phrase('seat_capacity');?></label>
                
                <div class="col-sm-3">
                    <input type="text" name="seat_capacity" id="seat_capacity" class="form-control" placeholder="<?php echo get_phrase('enter_seat_capacity_for_each_room');?>" onclick="roomcheck()" autocomplete="off"  required >
                    <span id="span"></span>
                </div>
            </div>
            <input type="hidden" name="hide_track" id="hide_track" value="">
        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" id="submit" class="btn btn-info center" disabled><?php echo get_phrase('submit');?></button>
              </div>
            </div>
    <?php echo form_close();?>

	</div>
</div>
<script type="text/javascript">
var track=0;
    $('#seat_capacity').on('keyup', function () {
        var num=document.getElementById("seat_capacity").value;
        var num1=parseInt(num);
        if(isNaN(num)==true){
            jQuery('#span').html("should be number only");
            document.getElementById("submit").disabled=true;
            
        }else{
            jQuery('#span').html("");
            
                document.getElementById("submit").disabled=false;
            
            
            
        }

              $('#checkemail').html('');
            });

 $('#room_id').on('keyup', function () {
var room= document.getElementById("room_id").value;
       //jQuery('#span_name').html(room);
       $.ajax({

            url: '<?php echo base_url();?>index.php?admin/room_name_data/' + room.toUpperCase() ,
            async:false,
            success: function(response)
            {
                //alert(response);
                if(room.toUpperCase() === response){
                    
                     $('#hide_track').val("1");
                    jQuery('#span_name').html("should be unique");
                    
                }else{
                    jQuery('#span_name').html("");
                    $('#hide_track').val("2");
                   
                    
                }
                

                
            }
        });
});

    // $('#room_id').on('keyup', function () {
       $("input#room_id").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
 
});

    // });
</script>