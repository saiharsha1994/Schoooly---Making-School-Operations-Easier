<hr />

<?php echo form_open(base_url() . 'index.php?admin/balance_sheet_selector/'); 
	$from_month = array(1=>'January', 2=>'Febraury', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
?>
<div class="row">

	<div class="form-group col-md-3 col-sm-offset-1">
		<label class="col-sm-3 control-label" style="padding-top: 8px;"><?php echo get_phrase('month');?></label>
		<div class="col-sm-9">
        <select name="month" class="form-control selectboxit">
			<option value="00"><?php echo get_phrase('All');?></option>
			<?php  foreach ($from_month as $key=>$val): ?>
	            <option value="<?php echo $key;?>"><?php echo $val;?></option>
	        <?php endforeach;?>
		</select>
		</div>
	</div>
	<div class="form-group col-md-3 col-sm-offset-1">
		<label class="col-sm-6 control-label" style="padding-top: 8px;"><?php echo get_phrase('academic_year');?></label>
		<div class="form-group col-sm-6">
		<select name="year" class="form-control selectboxit">
				<!--<option value="0"><?php echo get_phrase('All');?></option>-->
				<?php for($i=2014 ; $i<2026; $i++){
						echo '<option value='.$i.'>'.$i.'</option>';
					} 
				?>
		</select>
		</div>
	</div>
	
					
	<div class="col-md-3" >
		<button type="submit" class="btn btn-info"><?php echo get_phrase('get_balance_sheet');?></button>
	</div>

</div>
<?php echo form_close();?>