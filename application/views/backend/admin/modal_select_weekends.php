<div class="row">

	<div class="col-md-12">

		<div class="panel panel-primary" data-collapsed="0">

           <div class="panel-heading">

               <div class="panel-title">

                  <i class="entypo-plus-circled"></i>

                  <?php echo get_phrase('select_weekends');?>

              </div>

          </div>

          <div class="panel-body">



            <?php echo form_open(base_url() . 'index.php?admin/select_weekends' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
            <?php
            $w='';  
            $weekends       =   $this->db->get_where('settings', array('type' => 'weekends'))->row()->description;
            if($weekends!='')
            {
                $w=explode(',', $weekends);
            }
            ?>


            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('monday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='monday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="monday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="monday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="monday" />
                                    <?php }?>
                                
                       
                </div>

            </div>

            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('tuesday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='tuesday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="tuesday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="tuesday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox"  class='weekends' name="weekends[]" value="tuesday" />
                                    <?php }?>
                                
                       
                </div>

            </div>



            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('wednesday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='wednesday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="wednesday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="wednesday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="wednesday" />
                                    <?php }?>
                                
                       
                </div>

            </div>



            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('thursday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='thursday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="thursday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="thursday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="thursday" />
                                    <?php }?>
                                
                       
                </div>

            </div>

            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('friday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='friday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="friday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="friday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="friday" />
                                    <?php }?>
                                
                       
                </div>

            </div>

            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('saturday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='saturday'){?>
                                <input type="checkbox" class='weekends' name="weekends[]" value="saturday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="saturday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="saturday" />
                                    <?php }?>
                                
                       
                </div>

            </div>

            <div class="form-group">

                <label class="col-sm-5 control-label"><?php echo get_phrase('sunday');?></label>

                <div class="col-sm-4">
                    <?php 
                    if ($w!=''){
                        $m=0;
                        foreach($w as $day){
                            if($day=='sunday'){?>
                                <input type="checkbox" name="weekends[]" class='weekends' value="sunday" checked="checked" />
                                <?php $m=1;
                                break;}}
                                if($m==0){
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="sunday" />
                                 <?php }}
                                 else{
                                    ?>
                                    <input type="checkbox" class='weekends' name="weekends[]" value="sunday" />
                                    <?php }?>
                                
                       
                </div>

            </div>





            <div class="form-group">

              <div class="col-sm-offset-5 col-sm-5">

                 <div type="submit" class="btn btn-default" onclick="CheckForm()"><?php echo get_phrase('submit');?></div>

             </div>

         </div>

         <?php echo form_close();?>

     </div>

 </div>

</div>

</div>

<script type="text/javascript">
 window.onload=function(){
   ins=document.getElementsByName('weekends[]');
}

function CheckForm(){
    var checked=0;
    var elements = document.getElementsByName("weekends[]");
    var c='';
    for(var i=0; i < elements.length; i++){
        if(elements[i].checked) {
            checked = checked+1;
            c=c+elements[i].value+',';
        }
    }
    if (checked<1) {
        alert('Please select atleast 1 day');
        return;
    }
    else if(checked>3)
    {
        alert('Weekend cannot be more than 3 days');
        return;
    }
    
    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/select_weekends',
            type:"POST",
            data:{par0:c},
            
            success: function(response)
            {
             window.location.href="<?php echo base_url() . 'index.php?admin/additional_breaks';?>";
            }
        });
    
}
</script>