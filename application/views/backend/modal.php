    <script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }
    </script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $system_name;?></h4>
                </div>
                
                <div class="modal-body" style="height:500px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
    var delete_url_new="";
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }

    function confirm_modal1(delete_url1)
    {
        jQuery('#modal-41').modal('show', {backdrop: 'static'});
        delete_url_new=delete_url1;
        
    }

    function confirm_modal2(delete_url2)
    {
        data_transfer(delete_url2);
        jQuery('#modal-42').modal('show', {backdrop: 'static'});
        delete_url_new=delete_url2;
        
    }

    function confirm_modal3(delete_url3)
    {
        data_transfer3(delete_url3);
        jQuery('#modal-43').modal('show', {backdrop: 'static'});
        delete_url_new=delete_url2;
        
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo get_phrase('delete');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>


    <!-- (Normal Modal41)-->
    <div class="modal fade" id="modal-41">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header" style="border-color:  white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><?php echo get_phrase('reason_for_rejection');?></h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">

                    <textarea  style="border-color: #b3b3b3" id="text_area" class="form-control" placeholder="write here..." rows="4"></textarea>
                    <span id="err" style="color: red;font-size: 15px"></span>
                    
                    <br>
                    <a href="#" onclick="textarea_check()" class="btn btn-success" id="delete_link1"><?php echo get_phrase('submit');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>


       <!-- (Normal Modal42)-->
    <div class="modal fade" id="modal-42">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header" style="border-color:  white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><?php echo get_phrase('');?></h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">

                    <?php echo form_open(base_url() . 'index.php?admin/approve_reject_upload/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_document');?></label>
                        
                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x200" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select Document</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" id="userfile" accept="image/*" required>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                                <input type="hidden" name="approve_id" id="approve_id">
                            </div>
                        </div>
                    </div> 

                    
                    <span id="err" style="color: red;font-size: 15px"></span>
                    
                    <br>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>



       <!-- (Normal Modal43)-->
    <div class="modal fade" id="modal-43">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header" style="border-color:  white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><?php echo get_phrase('');?></h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">

                    <?php echo form_open(base_url() . 'index.php?admin/approve_reject_upload_ministry/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('upload_document');?></label>
                        
                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x200" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select Document</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*" required>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                                <input type="hidden" name="approve_id3" id="approve_id3">
                            </div>
                        </div>
                    </div> 

                    
                    <span id="err" style="color: red;font-size: 15px"></span>
                    
                    <br>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function textarea_check(){
        var room= document.getElementById("text_area").value;
        var x=",";
        var y=x.concat(room);
        if(room.length>0){
            
            document.getElementById('delete_link1').setAttribute('href' , delete_url_new.concat(y));
        }else{
            jQuery('#err').html("value required");
        }
    }

    function data_transfer(url){
        var thenum = url.replace( /^\D+/g, ''); 
        //document.getElementById('approve_id').html(thenum);
        document.getElementById('approve_id').value=thenum;
        

    }
     function data_transfer3(url){
        var thenum = url.replace( /^\D+/g, ''); 
        //document.getElementById('approve_id').html(thenum);
        document.getElementById('approve_id3').value=thenum;
        

    }
    </script>