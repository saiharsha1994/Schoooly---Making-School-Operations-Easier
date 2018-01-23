<?php
$edit_data = $this->db->get_where('fees_invoice', array('invoice_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<center>
    <a onClick="printDiv('invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print Invoice
        <i class="entypo-print"></i>
    </a>
</center>

    <br><br>

    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td align="right">
                    <h5><?php echo get_phrase('paid_date'); ?> : <?php echo $row['paid_on'];?></h5>
                    <h5><?php echo get_phrase('description'); ?> : <?php echo $row['description'];?></h5>
					<h5><?php echo get_phrase('receipt_number'); ?> : <?php echo $row['invoice_code'];?></h5>
                 </td>
            </tr>
			<center><img src="uploads/logo2.png"  style="max-height:60px;"/></center>
			
        </table>
        <hr>
        <table width="100%" border="0">    
            <tr>
                <td align="left"><h4><?php echo get_phrase('paid_to'); ?> </h4></td>
                <td align="right"><h4><?php echo get_phrase('bill_to'); ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?><br>            
                </td>
                <td align="right" valign="top">
                    <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?><br>
                    <?php 
                        $class_id = $this->db->get_where('enroll' , array(
                            'student_id' => $row['student_id'],
                                'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                        ))->row()->class_id;
						//echo $class_id;
                        echo get_phrase('class') . ' ' . $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
						$Section_Id=$this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->section_id;
						echo '  ' . $this->db->get_where('section', array('section_id' => $Section_Id))->row()->name;
                    ?><br>
                </td>
            </tr>
        </table>
        <hr>

        <!--<table width="100%" border="0">
			<?php $this -> db -> select('*');
			$this -> db -> from('fees_invoice');
			$this -> db -> where('invoice_code',$row['invoice_code']);
			$query = $this->db->get();
			$total_paid=0;
        	foreach ($query->result_array() as $row4): ?>
            <tr>
                <td align="right" width="80%"><?php echo get_phrase('fees_amount'); ?> :</td>
                <td align="right"><?php echo $row4['total_fees_amount']; ?></td>
            </tr>
			 <tr>
                <td align="right" width="80%"><?php echo get_phrase('fine_amount'); ?> :</td>
                <td align="right"><?php echo $row4['fine_amount']; ?></td>
            </tr>
			
			<?php $total_paid=$total_paid+$row4['total_fees_amount']+$row4['fine_amount']?>
			<?php endforeach; ?>
			
			<tr>
				<td align="right" width="80%"><h4><?php echo get_phrase('total_amount_paid'); ?> :</h4></td>
				<td align="right"><h4><?php echo $total_paid; ?></h4></td>
			</tr>
        </table>
 <hr>-->
        

        <!-- payment history -->
        <!--<h4><?php echo get_phrase('payment_history'); ?></h4>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><?php echo get_phrase('date'); ?></th>
                    <th><?php echo get_phrase('amount'); ?></th>
                    <th><?php echo get_phrase('method'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $payment_history = $this->db->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array();
                foreach ($payment_history as $row2):
                    ?>
                    <tr>
                        <td><?php echo date("d M, Y", $row2['timestamp']); ?></td>
                        <td><?php echo $row2['amount']; ?></td>
                        <td>
                            <?php 
                                if ($row2['method'] == 1)
                                    echo get_phrase('cash');
                                if ($row2['method'] == 2)
                                    echo get_phrase('check');
                                if ($row2['method'] == 3)
                                    echo get_phrase('card');
                                if ($row2['method'] == 'paypal')
                                    echo 'paypal';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tbody>
        </table>-->
		
		<h4><?php echo get_phrase('payment'); ?></h4>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
					<th><?php echo get_phrase('semester'); ?></th>
                    <th><?php echo get_phrase('fees'); ?></th>
                    <th><?php echo get_phrase('amount'); ?></th>
                    <th><?php echo get_phrase('method'); ?></th>
                    <th><?php echo get_phrase('academic_year'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
        	$count = 1;
			$total_paid=0;
			//$term_arr = array(1=>'1st term', 2=>'2nd term', 3=>'3rd term', 4=>'4th term', 5=>'Book Fee', 6=>'Bus Fee', 7=>'Others');		
        	//$student_invoice = $this->db->get('fees_invoice')->result_array();
			$this -> db -> select('*');
			$this -> db -> from('fees_invoice');
			$this -> db -> where('invoice_code',$row['invoice_code']);
			$query = $this->db->get();
        	foreach ($query->result_array() as $row3):
				?>
                    <tr>
                        <td><?php echo $this->db->get_where('semester',array('_id' =>$row3['fees_term'] ))->row()->semester;?></td>
                        <td><?php echo $this->db->get_where('fees_details',array('fees_id' =>$row3['fees_id'] ))->row()->fees_name;?></td>
                        <td><?php echo $row3['total_fees_amount']."<br>".$row3['fine_amount']; ?></td>
						<?php $total_paid=$total_paid+$row3['total_fees_amount']+$row3['fine_amount']?>
                        <td>
                            <?php 
                                if ($row3['paid_method'] == 1)
                                    echo get_phrase('cash');
                                if ($row3['paid_method'] == 2)
                                    echo get_phrase('cheque');
                                if ($row3['paid_method'] == 3)
                                    echo get_phrase('card');
                                if ($row3['paid_method'] == 'paypal')
                                    echo 'paypal';
                            ?>
                        </td>
						<td><?php echo $row3['year']; ?></td>
                    </tr>
              <?php endforeach;?>   
            </tbody>
            <tbody>
        </table>
		<table width="100%" border="0">
			<tr>
				<td align="right" width="80%"><h4><?php echo get_phrase('total_amount_paid'); ?> :</h4></td>
				<td align="right"><h4><?php echo $total_paid; ?></h4></td>
			</tr>
		</table>
    </div>
<?php endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
	
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
	
		document.body.innerHTML = printContents;
	
		window.print();
	
		document.body.innerHTML = originalContents;
	}

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>