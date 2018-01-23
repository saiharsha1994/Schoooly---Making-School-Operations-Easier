<hr />

<?php echo form_open(base_url() . 'index.php?admin/balance_sheet_selector/');
	$from_month = array(01=>'January', 02=>'Febraury', 03=>'March', 04=>'April', 05=>'May', 06=>'June', 07=>'July', 08=>'August', 09=>'September', 10=>'October', 11=>'November', 12=>'December');
?>
<div class="row">

	<div class="form-group col-md-3 col-sm-offset-1">
		<label class="col-sm-3 control-label" style="padding-top: 8px;"><?php echo get_phrase('month');?></label>
		<div class="form-group col-sm-9">
        <select name="month" class="form-control selectboxit">
			<option value="00"><?php echo get_phrase('All');?></option>
			<?php  foreach ($from_month as $key=>$val): ?>
	            <option value="<?php echo $key;?>" <?php if($month == $key) echo 'selected';?>><?php echo $val;?></option>
	        <?php endforeach;?>
		</select>
		</div>
	</div>
	<div class="form-group col-md-3 col-sm-offset-1">
		<label class="col-sm-6 control-label" style="padding-top: 8px;"><?php echo get_phrase('year');?></label>
		<div class="form-group col-sm-6">
		<select name="year" class="form-control selectboxit">
				<!--<option value="0"><?php echo get_phrase('All');?></option>-->
				<?php for($i=2014 ; $i<2026; $i++){
						if($year == $i)
							$select = 'selected';
						else
							$select = '';
						echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
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


<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-area"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('balance_sheet');?></h3>
			<h4 style="color: #696969;">
				<?php if($month==00){
					echo get_phrase('month');?>:&nbsp
					<?php echo 'All';
				}else{
					echo get_phrase('month');?>:&nbsp
					<?php echo $from_month[$month];
				}
				?>
				<!--<?php echo get_phrase('month');?> :&nbsp<?php echo $from_month[$month]?> -->
				
			</h4>
			<h4 style="color: #696969;">				 
				<?php echo get_phrase('year');?> :&nbsp<?php echo $year?>
			</h4>
			
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>

<?php echo form_open(base_url() . 'index.php?admin/balance_sheet_selector/');?>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table class="table table-bordered">
	<thead>
		<tr>
			<th><div><?php echo get_phrase('expence');?></div></th>
            <th><div><?php echo get_phrase('income');?></div></th>
		</tr>
	</thead>
    <tbody>
		<tr>
			<td><?php 
			/*$expense = $this->db->get_where('expense' , array(
                'year' => $year 
            ))->result_array();
			*/
			if($year=='0' && $month=='0'){
				$expense =  $this->db->query("SELECT total_amount FROM expense",
				array())->result_array();
			}
			else if($year=='0' && $month!='0'){
				$expense =  $this->db->query("SELECT total_amount FROM expense WHERE (month(inserted_on)=?)",
				array($month))->result_array();
			}else if($month=='0' && $year!='0'){
				$expense =  $this->db->query("SELECT total_amount FROM expense WHERE (year(inserted_on) = ?)",
				array($year))->result_array();	
			}else{
				$expense =  $this->db->query("SELECT total_amount FROM expense WHERE (year(inserted_on) = ?) AND (month(inserted_on)=?)",
				array($year, $month))->result_array();	
			}
			
			foreach ($expense as $row)
			{
				$period_array[] = floatval($row['total_amount']); //can it be float also?
			}
			if (empty($period_array)) {
				$total = 0;
			}else{
				$total = array_sum($period_array);	
			}
			
			echo $total;
			?></td>
			
            <td><?php 
			
			if($year=='0' && $month=='0'){
				$income =  $this->db->query("SELECT total_fees_amount,fine_amount FROM fees_invoice",array($year, $month))->result_array();
			}
			else if($year=='0' && $month!='0'){
				$income =  $this->db->query("SELECT total_fees_amount,fine_amount FROM fees_invoice WHERE (month(paid_on)=?)",
				array($month))->result_array();
			}else if($month=='0' && $year!='0'){
				$income =  $this->db->query("SELECT total_fees_amount,fine_amount FROM fees_invoice WHERE (year(paid_on)=?)",
				array($year))->result_array();
			}else{
				$income =  $this->db->query("SELECT total_fees_amount,fine_amount FROM fees_invoice WHERE (year(paid_on) = ?) AND  (month(paid_on)=?)",
				array($year, $month))->result_array();
			}
			
			foreach ($income as $row)
			{
				$income_array[] = floatval($row['total_fees_amount']+$row['fine_amount']); //can it be float also?
			}
			if (empty($income_array)) {
				$total = 0;
			}else{
				$total = array_sum($income_array);	
			}
			echo $total;?></td>
		</tr>
	</tbody>
</table>
</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        

    /*    var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    
                    {
                        "sExtends": "xls",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(5, true);
                                  }
                            });
                        },
                        
                    },
                ]
            },
            
        });
        
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });	*/
    });
        
</script>

