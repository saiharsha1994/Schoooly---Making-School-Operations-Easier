<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('create_student_payment');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/student_invoice/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));	
				$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term');
				?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_id');?></label>
                        
						<div class="col-sm-4">
							<input type="text" class="form-control" id="student_id" value="" >
						</div> 
						<div class="col-sm-2">
							<button class="btn btn-info" id="stu_id_btn" type="button"><?php echo get_phrase('search');?></button>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-6">							
							<select name="class_id" id="class_id_drop" class="form-control"
	                                        	onchange="return get_class_sections(this.value)">
	                            <option value=""><?php echo get_phrase('select_class');?></option>
	                            <?php  $classes = $this->db->get('class')->result_array();
								foreach ($classes as $row): ?>
	                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>
				<!--	<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-6">
		                        <select name="section_id" class="form-control" style="width:100%;" id="section_selector_holder" onchange="return get_class_students(this.value)">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div> -->
					<input type="hidden" class="form-control" name="class_id_hid" id="class_id_hid">
					<input type="hidden" class="form-control" name="std_ID" id="std_ID">
					<input type="hidden" class="form-control" name="std_special_hid" id="std_special_hid">
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<select name="stu_name" class="form-control" id="student_selection_holder" onchange="return check_SpecialStud(this.value)">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
						</div>
					</div>
					<div style="margin-top: 20px;" id="payment_details">
					<div class="form-group">
					<label class="col-sm-3" style="text-align: center;"></label>
					<label class="col-sm-6" style="text-align: center;"><?php echo get_phrase('Payment Details');?></label>
					<div class="col-sm-2">
							<button class="btn btn-info" id="add_more_btn" type="button" onclick="call_ajax()"><i class="entypo-plus-circled"></i><?php echo get_phrase('Add More');?></button>
						</div>
						</div>
						<br>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('semester');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_semester[]" class="form-control " id='fees_semester_0' >
							<!-- onchange="return get_class_fees(this.value,this.id)" -->
	                            <option value=""><?php echo get_phrase('select_semester');?></option>
	                            <?php  $classes = $this->db->get('semester')->result_array();
								foreach ($classes as $row): ?>
	                            <option value="<?php echo $row['_id'];?>"><?php echo $row['semester'];?></option>
	                            <?php endforeach;?>
	                                            
	                        </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fees_type');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_type[]" class="form-control " id='fees_type_0' onchange="return get_fees_details(this.value,this.id)" >
							<!--  -->
	                            <option value=""><?php echo get_phrase('select_type');?></option>
	                            <option value="1"><?php echo get_phrase('tution_fee');?></option>
	                            <option value="2"><?php echo get_phrase('other_fee');?></option>
	                                            
	                        </select>
						</div>
					</div>


					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fees');?></label>
                        
						<div class="col-sm-6">							
							<select name="fees_id[]" id="fees_id_0" class="form-control"
	                                        	onchange="return get_class_fees(this.value,this.id)">
	                            <option value=""><?php echo get_phrase('select_fees_type_first');?></option>
	                                            
	                        </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-3">
							<input type="text" class="form-control" name="fees_amount[]" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo get_phrase('select_fees');?>"  id="class_fees_0" readonly>
						</div>
						<span style="color: rgb(52, 52, 52);display:none;" class="col-sm-3" id="special_txt_0"><strong>*Special Admission</strong></span>
						<span style="color: rgb(52, 52, 52);display:none;" class="col-sm-3" id="concess_txt_0"><strong>*Fees Concession</strong></span>
					</div>
					<div class="form-group" id="class_fine_div_0">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fine_amount');?></label>
                        
						<div class="col-sm-3">
<input type="text" class="form-control" name="fine_amount[]" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo get_phrase('select_fees');?>"  id="class_fine_0" readonly>
						</div>
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-6">
                            <select name="method[]" class="form-control ">
                                <option value="1"><?php echo get_phrase('cash');?></option>
                                <option value="2"><?php echo get_phrase('cheque');?></option>
                                <option value="3"><?php echo get_phrase('card');?></option>
                            </select>
                        </div>
                    </div>
                    </div>
					
					<div class="form-group">
						
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="description" value="" >
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><i class="entypo-upload"></i><?php echo get_phrase('add_fees_detail');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 	var payment_count;
	$( document ).ready(function() {
    payment_count=1;
});
	function call_ajax(){
		var fees_term = jQuery('#fees_term').val();
		if (fees_term=='') {
			alert('fill first');
		}
		else{
			drawRow();
		}
		
    }

    

    function drawRow() { 
    	//alert('ello');

        //var c = $("<div class='form-group'><label class='col-sm-3' style='text-align: center;''></label><label class='col-sm-6' style='text-align: center;'><?php echo get_phrase('Payment Details');?></label><div class='col-sm-2'></div></div>");
        //var x= a.student_id +','+a.class_id+','+a.section_id;

        $("#payment_details").append($("<hr id='hr_"+payment_count+"'></hr><div style='margin-top: 20px;' id='payment_details_"+payment_count+"'><div class='form-group' id='payment_"+payment_count+"'><label class='col-sm-3' style='text-align: center;''></label><label class='col-sm-6' style='text-align: center;'><?php echo get_phrase('Payment Details');?></label><div class='col-sm-2'><div class='col-sm-2'><button class='btn btn-info' id='remove_btn' type='button' onclick='remove_payment(this.value)' value='"+payment_count+"'><i class='entypo-trash'></i><?php echo get_phrase('Remove');?></button></div></div><div class='form-group'><label for='field-1' class='col-sm-3 control-label'><?php echo get_phrase('semester');?></label><div class='col-sm-6'><select name='fees_semester[]' class='form-control' id='fees_semester_"+payment_count+"' ><option value=''><?php echo get_phrase('select_semester');?></option><?php  $classes = $this->db->get('semester')->result_array();foreach ($classes as $row): ?><option value='<?php echo $row['_id'];?>'><?php echo $row['semester'];?></option><?php endforeach;?></select></div></div><div class='form-group'><label class='col-sm-3 control-label'><?php echo get_phrase('fees_type');?></label><div class='col-sm-6'><select name='fees_type[]' class='form-control' id='fees_type_"+payment_count+"' onchange='return get_fees_details(this.value,this.id)' ><option value=''><?php echo get_phrase('select_type');?></option><option value='1'><?php echo get_phrase('tution_fee');?></option><option value='2'><?php echo get_phrase('other_fee');?></option></select></div></div><div class='form-group'><label for='field-1' class='col-sm-3 control-label'><?php echo get_phrase('fees');?></label><div class='col-sm-6'><select name='fees_id[]' id='fees_id_"+payment_count+"' class='form-control' onchange='return get_class_fees(this.value,this.id)'><option value=''><?php echo get_phrase('select_fees_type_first');?></option></select></div></div><div class='form-group'><label class='col-sm-3 control-label'><?php echo get_phrase('amount');?></label><div class='col-sm-3'><input type='text' class='form-control' name='fees_amount[]' data-validate='required' data-message-required='<?php echo get_phrase('value_required');?>' value='<?php echo get_phrase('select_term');?>'  id='class_fees_"+payment_count+"' readonly></div><span style='color: rgb(52, 52, 52);display:none;' class='col-sm-3' id='special_txt_"+payment_count+"'><strong>*Special Admission</strong></span><span style='color: rgb(52, 52, 52);display:none;' class='col-sm-3' id='concess_txt_"+payment_count+"'><strong>*Fees Concession</strong></span></div><div class='form-group' id='class_fine_div_"+payment_count+"'><label for='field-1' class='col-sm-3 control-label'><?php echo get_phrase('fine_amount');?></label><div class='col-sm-3'><input type='text' class='form-control' name='fine_amount[]' data-validate='required' data-message-required='<?php echo get_phrase('value_required');?>' value='<?php echo get_phrase('select_term');?>'  id='class_fine_"+payment_count+"' readonly></div></div><div class='form-group'><label class='col-sm-3 control-label'><?php echo get_phrase('method');?></label><div class='col-sm-6'><select name='method[]' class='form-control '><option value='1'><?php echo get_phrase('cash');?></option><option value='2'><?php echo get_phrase('cheque');?></option><option value='3'><?php echo get_phrase('card');?></option></select></div></div></div>"));
        // , c.append($("<td><input type='checkbox' id='check' name='checkbox[]' onclick='EnableTransbtn()' value='" + x + "'/></td>")), c.append($("<td>" + a.student_id + "</td>")), c.append($("<td>" + a.name + "</td>")), c.append($("<td>" + a.class_name + "</td>")), c.append($("<td>" + a.section_name + "</td>"))
        payment_count++;
        	
    }


    function remove_payment(val){
		$("#hr_"+val).remove();
		$("#payment_details_"+val).remove();
    }
</script>

<script type="text/javascript">
    function get_class_students(section_id) {
		var class_id = jQuery('#class_id_hid').val();
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_sec_students/' + class_id + '/' + section_id  ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
jQuery('#stu_id_btn').click(function(){
	var std_code = jQuery.trim($('#student_id').val()); 	
	if(std_code.length != 0){
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_studentsByCode/' + std_code ,dataType: 'json',
            success: function(response)
            {
                console.log(response.class_id);
				jQuery('#class_id_drop').val(response.class_id);				
				get_class_sections(response.class_id);
				setTimeout(function(){jQuery('#student_selection_holder').val(response.student_id);},1000);				
				setTimeout(check_SpecialStud(response.student_id),1000);				
            }
        });	
	}
});
	function get_class_fees(fees_id,id) {
		
		var c= id.split('_');
		var cur= c[2];

		
		var sem = jQuery('#fees_semester_'+cur).val();
		
		// if(sem==''||type==''){
		// 	alert('Select Semester and Fees Type');
		// }
		var class_id = jQuery('#class_id_hid').val();
		var student_id = jQuery('#std_ID').val();
		if(student_id=='')
			alert('select_student');
			//alert(fees_id);
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_fees/' + fees_id + '/' + student_id ,dataType: 'json', 
            success: function(response)
            {             
            	//alert(response);   
                jQuery('#class_fees_'+cur).val(response.total_val);
				if(jQuery('#std_special_hid').val() == 2){
				 	jQuery('#class_fees_'+cur).prop('readonly',false);
				}else{
					jQuery('#class_fees_'+cur).prop('readonly',true);
				}
				if(response.Fees_Concession == 2){				 	
				 	jQuery('#concess_txt_'+cur).show();
					jQuery('#concess_txt_'+cur).html('<strong>*Fees Concession of '+response.Concession_Percent+'%</strong>');
				}else{					
					jQuery('#concess_txt_'+cur).hide();
				}
            }
        });
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_fine/' + fees_id,
            success: function(response)
            {                
                jQuery('#class_fine_'+cur).val(response);
				if(jQuery('#std_special_hid').val() == 2){
				 	jQuery('#class_fine_div_'+cur).hide();
				 	jQuery('#special_txt_'+cur).show();
				}else{
					jQuery('#class_fine_div_'+cur).show();
					jQuery('#special_txt_'+cur).hide();
				}
            }
        }); 
	}	

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
                jQuery('#class_id_hid').val(class_id);
                jQuery('#student_id').val('');
            }
        });
    }	

    function get_fees_details(fees_type,id) {
    	var c= id.split('_');
		var cur= c[2];
		
		var sem = jQuery('#fees_semester_'+cur).val();
		//var type = jQuery('#fees_semester_'+cur).val();
		
		if(sem==''||fees_type==''){
			alert('Select Semester and Fees Type');
		}
		var class_id = jQuery('#class_id_hid').val();
		if(class_id=='')
		{
			alert('Please select student');
			return;
		}
		//var student_id = jQuery('#std_ID').val();


    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_fees_details/' + class_id + '/' + sem + '/' + fees_type ,
            success: function(response)
            {
                jQuery('#fees_id_'+cur).html(response);
                //jQuery('#class_id_hid').val(class_id);
                //jQuery('#student_id').val('');
            }
        });
    }
	function check_SpecialStud(student_id){
		
		if(student_id=='')
			return;
		//alert(student_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/check_SpecialStud/' + student_id ,dataType: 'json',
            success: function(response)
            {	
				jQuery('#std_special_hid').val(response.Admission_Type);               	
				jQuery('#std_ID').val(student_id);               	
            }
        });
    }

</script>