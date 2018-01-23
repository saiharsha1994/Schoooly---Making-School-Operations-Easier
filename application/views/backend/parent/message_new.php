<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open(base_url() . 'index.php?parents/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever" required>

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <!--<optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row):
                    ?>

                    <option value="admin-<?php echo $row['admin_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>-->
			<optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
				$role_id=$this->db->get_where('hr_roles', array('role' => 'admin'))->row()->id;
										
				$employees   =   $this->db->get('employee_details')->result_array();
				foreach($employees as $row){
					$exists=0;
					$roles_arr = explode(',', $row['emp_type']);
					foreach ($roles_arr as $role) {
						if($role!=''&&$role==$role_id){
							$exists=1;
						}
					}  
					if($exists==1){
						echo '<option value="admin-' . $row['emp_id'] . ' - ">' . $row['name'] . '</option>';
					}
				}
                ?>
				
            </optgroup>
            <!--<optgroup label="<?php echo get_phrase('teacher'); ?>">
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="teacher-<?php echo $row['teacher_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>-->
			
			<optgroup label="<?php echo get_phrase('teacher'); ?>">
                <?php
				$role_id=$this->db->get_where('hr_roles', array('role' => 'teacher'))->row()->id;
										
				$employees   =   $this->db->get('employee_details')->result_array();
				foreach($employees as $row){
					$exists=0;
					$roles_arr = explode(',', $row['emp_type']);
					foreach ($roles_arr as $role) {
						if($role!=''&&$role==$role_id){
							$exists=1;
						}
					}  
					if($exists==1){
						echo '<option value="teacher-' . $row['emp_id'] . ' - ">' . $row['name'] . '</option>';
					}
				}
                ?>
				
            </optgroup>
        </select>
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