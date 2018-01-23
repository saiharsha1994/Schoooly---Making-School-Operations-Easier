<?php 
$edit_data		=	$this->db->get_where('teacher_academics', array('academic_id' => $academic_id), 1, 0)->result_array();
foreach ( $edit_data as $row):
	$title = $row['title'];
	$class_id = $row['class_id'];
	$section_id = $row['section_id'];
	$subject_id = $row['subject_id'];
	$teacher_id = $row['teacher_id'];
	$semester_id = $row['semester_id'];
	$book_name = $row['book_name'];
	$academic_id = $row['academic_id'];
endforeach;
?>

<hr />

<?php echo form_open(base_url() . 'index.php?admin/view_teacher_academics_records/'.$academic_id);?>
<div class="row">

	<div class="col-sm-2 ">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('title');?></label>
			<input type="text" class="form-control input" name="title" style="margin-left: 10px;"
            data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $title;?>" disabled="disabled"/>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
		<?php 
			$c_name 		=   $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name;?>
			<input type="text" class="form-control input" name="class"
            data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $c_name;?>" disabled="disabled"/>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
			<?php 
			$sb_name 		=   $this->db->get_where('subject' , array('subject_id'=>$subject_id))->row()->name;?>
			<input type="text" class="form-control input" name="class"
            data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $sb_name;?>" disabled="disabled"/>    
		</div>
	</div>


  <div class="col-sm-2 ">
    <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('year');?></label>
     <select name="year" id="year" class="form-control selectboxit" style="width:100%;" onchange="enablesubmit(this.value)" 
                        >
                        <option value="0"><?php echo get_phrase('year');?></option>
                        <?php 
                        $academic_year = $this->db->get('academic_year')->result_array();
                        foreach($academic_year as $row):
                        ?>
                            <option value="<?php echo $row['academic_year'];?>" ><?php echo $row['academic_year'];?>
                            </option>

                        <?php
                        endforeach;
                        ?>
                    </select>
    </div>
  </div>
  <div class="col-sm-2 ">
    <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"><?php echo get_phrase('month');?></label>
      <select name="month" id="month" class="form-control selectboxit" style="width:100%;" onchange="enablesubmit_new(this.value)">
                        <option value="0"><?php echo get_phrase('month');?></option>
                         <option value="January">Jan</option>
                <option value="February">Feb</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">Aug</option>
                <option value="September">Sep</option>
                <option value="October">Oct</option>
                <option value="November">Nov</option>
                <option value="December">Dec</option>

                    </select>
    </div>
  </div>

  <div class="col-sm-2 ">
    <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px; margin-left: 10px;"></label>
      <button type="submit" disabled id="submit" class="btn btn-info form-control"><?php echo get_phrase('view_records');?></button>
    </div>
  </div>


</div>
<?php echo form_close();?>


  <script type="text/javascript">
  	function enablesubmit(value){
  		if(value==0){
  			$('#month').data('selectBox-selectBoxIt').enable();
  			document.getElementById("submit").disabled=true;
  		}else{
  			$('#month').data('selectBox-selectBoxIt').disable();
  			document.getElementById("submit").disabled=false;
  		}
  		

  	}
  	 	function enablesubmit_new(value){
  	 		if(value==0){
  	 			$('#year').data('selectBox-selectBoxIt').enable();
  				document.getElementById("submit").disabled=true;

  	 		}else{
  	 				$('#year').data('selectBox-selectBoxIt').disable();
  					document.getElementById("submit").disabled=false;
  	 		}
  		

  	}
  </script>