<?php $hr_info = $this->db->get('hr_roles')->result_array();
      $module_info = $this->db->get('modules_list')->result_array();
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('module_list');?>
            	</div>
            </div>
			<div class="panel-body">
				<!-- <?php echo $param2; ?> -->
                <input type="hidden" id="hide" name="hide" value="<?php echo $param2;?>">
                <?php echo form_open(base_url() . 'index.php?admin/hr_management/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	           
            <?php foreach($hr_info as $idmatch){
                    if($idmatch['id']==$param2){
                        $listofmodules=$idmatch['modules'];
                        $listofnumbers=explode(',', $listofmodules);
                        break;
                    }
            }?>


            <?php foreach($module_info as $module){ 
                $true=0;
                    foreach($listofnumbers as $check){
                        if($module['_id']==$check){
                            $true=1;
                            break;
                        }
                    }

                ?>
                <div class="form-group">

                    <label class="col-sm-5 control-label"><?php echo $module['name'];?></label>

                        <div class="col-sm-4">

                        <?php 
                        if($true==1){?>
                            <input type="checkbox" checked="checked" name="moduleslist" value="<?php echo $module['_id'];?>"/>
                        <?php }
                        else{?>
                            <input type="checkbox" name="moduleslist" value="<?php echo $module['_id'];?>"/>
                        <?php }?>    
                        </div>
                </div>
            <?php } ?>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<div type="submit" onclick="CheckForm()" class="btn btn-info"><?php echo get_phrase('add_modules');?></div>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 window.onload=function(){
   //ins=document.getElementsByName('weekends[]');
}

function CheckForm(){
    var checked=0;
    var elements = document.getElementsByName("moduleslist");
    var para = document.getElementById("hide").value;
    var c='';
    for(var i=0; i < elements.length; i++){
        if(elements[i].checked) {
            checked = checked+1;
            c=c+elements[i].value+',';
        }
    }
    /*if (checked<1) {
        alert('Please select atleast 1 Module');
        return;
    }*/
    c = c.replace(/\,$/, '');
    /*alert(para);
    alert(c);*/
    
    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/selected_modules',
            type:"POST",
            data:{par0:c,par1:para},
            
            success: function(response)
            {
             window.location.href="<?php echo base_url() . 'index.php?admin/manage_modules';?>";
            }
        });
    
}
</script>