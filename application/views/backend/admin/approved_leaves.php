<hr />

<?php echo form_open(base_url() . 'index.php?admin/approved_leaves_view/');?>
<div class="row" >

	<div class="col-md-3 col-sm-offset-4" >
		<div class="form-group">
			<label class="control-label"><?php echo get_phrase('select_employee_role');?></label>
				<select name="role" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
					<option value=""><?php echo get_phrase('select_role');?></option>
					<?php 
					$hr = $this->db->get('hr_roles')->result_array();
					foreach($hr as $row):
						?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['role'];?></option>
					<?php
					endforeach;
					?>
				</select>
			</div>
	</div>

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('view_leave_records');?></button>
	</div>

</div>
<?php echo form_close();?>