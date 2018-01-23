<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
    <div class="col-sm-5">
        <select name="subject_id" class="form-control selectboxit" style="width:100%;">
        <?php
        	$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        	foreach($subjects as $row):
        ?>
    	<option value="<?php echo $row['subject_id'];?>"><?php echo $row['name'];?></option>
    	<?php endforeach;?>
        </select>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };
                    
                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    });
    
</script>