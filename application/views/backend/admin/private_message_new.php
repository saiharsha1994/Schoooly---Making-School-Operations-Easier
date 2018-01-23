<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open(base_url() . 'index.php?admin/private_message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group" style="border-bottom:none;">
		<div class="checkbox-inline col-md-2 col-sm-3">
			<label><input type="radio" name="optionsRadios" value="1" checked="checked">&nbsp;<?php echo get_phrase('single_message'); ?></label>
		</div>
		<div class="checkbox-inline col-md-2 col-sm-3">
			<label><input type="radio" name="optionsRadios" value="2">&nbsp;<?php echo get_phrase('group_message'); ?></label>
		</div>
		<input type="hidden" value="1" name="msg_type" id="msg_type">
	</div>
    <div class="form-group" id="single_div">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever">

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
			<optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
				$role_id=$this->db->get_where('hr_roles', array('role' => 'admin'))->row()->id;
										
				$employees   =   $this->db->get('employee_details')->result_array();
				foreach($employees as $row){
					$exists=0;
					$roles_arr = explode(',', $row['emp_type']);
					foreach ($roles_arr as $role){
						if($role!=''&&$role==$role_id){
							$exists=1;
						}
					}  
					if($exists==1){
						echo '<option value="admin-' . $row['emp_id'] . '">' . $row['name'] . '</option>';
					}
				}
				?>
            </optgroup>
            <!--<optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row):
                    ?>

                    <option value="admin-<?php echo $row['admin_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>-->
            <!--<optgroup label="<?php echo get_phrase('student'); ?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>

                    <option value="student-<?php echo $row['student_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>-->
            <optgroup label="<?php echo get_phrase('parent'); ?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="parent-<?php echo $row['parent_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
        </select>
    </div>
	<div id="group_div" style="display:none;">
		<br>
		<label for="subject">&nbsp;<?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
		<div class="form-group" style="border-bottom:none;">
			<span class="col-sm-2 control-label"><?php echo get_phrase('class');?></span> 
			<div class="col-sm-5" style="padding-left:0px;">
				<select name="class_id" class="form-control selectboxit" style="width:100%;"
							onchange="return get_class_section(this.value)">
					<option value=""><?php echo get_phrase('select_class');?></option>
							<?php 
							$classes = $this->db->get('class')->result_array();
							foreach($classes as $row):
							?>
								<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
							<?php
							endforeach;
							?>
				</select>
			</div>
		</div>
		<br>
		<div class="form-group" style="border-bottom:none;">
			<span class="col-sm-2 control-label"><?php echo get_phrase('section');?></span> 
			<div class="col-sm-5"style="padding-left:0px;">
				<select name="section_id" class="form-control " style="width:100%;" id="section_holder">
					<option value=""><?php echo get_phrase('select_class_first');?></option>
									
				</select>                            
			</div>
		</div>
		<br>
    </div>


    <div class="compose-message-editor">
        <textarea row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
            id="sample_wysiwyg"></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

</div>
<script>	
	$(document).ready(function(){
		$("input:radio[name=optionsRadios]").click(function(e){
			$("#msg_type").val($(this).attr('value'));
			var hid_val = $("#msg_type").val();
			console.log(hid_val);
			if(hid_val == 1){
				$('#group_div').hide();
				$('#single_div').show();
			}else if(hid_val == 2){
				$('#group_div').show();
				$('#single_div').hide();
			}				
		});	
	});	
	function get_class_section(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
			success: function(response)
			{				
                jQuery('#section_holder').html(response);
            }
        });		
    }
</script>		