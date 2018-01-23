<div class="row">

	<div class="col-md-12">

		<div class="panel panel-primary" data-collapsed="0">

        	<div class="panel-heading">

            	<div class="panel-title">

            		<i class="entypo-plus-circled"></i>

					<?php echo get_phrase('add_role');?>

            	</div>

            </div>

			<div class="panel-body">

				

                <?php echo form_open(base_url() . 'index.php?admin/add_roles/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">

						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('role');?></label>

                        

						<div class="col-sm-5">

							<input type="text" id="role" class="form-control" name="role" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="" autocomplete="off">
                                <span id="span_name"></span>
						</div>

					</div>
                    <input type="hidden" name="hide_track" id="hide_track" value="">
                    <div class="form-group">

						<div class="col-sm-offset-3 col-sm-5">

							<button id="submit" type="submit" class="btn btn-default" disabled><?php echo get_phrase('submit');?></button>

						</div>

					</div>

                <?php echo form_close();?>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
var track=0;
 $('#role').on('keyup', function () {

var role= document.getElementById("role").value;
       //jQuery('#span_name').html(room);
       $.ajax({
            url: '<?php echo base_url();?>index.php?admin/role_name_data/' + role.toUpperCase() ,
            async:false,
            success: function(response)
            {
                //alert(response);
                if(role.toUpperCase() === response){
                    
                     $('#hide_track').val("1");
                    jQuery('#span_name').html("should be unique");
                    document.getElementById("submit").disabled=true;
                    
                }else{
                    jQuery('#span_name').html("");
                    $('#hide_track').val("2");
                    document.getElementById("submit").disabled=false;
                   
                    
                }
                

                
            }
        });
});
    // });
</script>