<?php
	/* Contains common functions for Halal bites APIs */
	
	function toJson($ret_Val){
		if(is_array($ret_Val)){
			echo json_encode($ret_Val);
		}else{
			$ret_val = array();
			$ret_val ['responsecode'] = 100;
			$ret_val ['responsemsg'] = "Global Error. ret_Val is not an Array.";
			echo json_encode($ret_Val);
		}
		if($stmt)
			$stmt->close();
		if($db_conn)
			$db_conn->close();
		exit;
	}

	function encrypt_decrypt($action, $string) {
	   $output = false;

	   $key = 'Al-amaanah tech bismillah@123';

	   // initialization vector 
	   $iv = md5(md5($key));

	   if( $action == 'encrypt' ) {
		   $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
		   $output = base64_encode($output);
	   }
	   else if( $action == 'decrypt' ){
		   $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
		   $output = rtrim($output, "");
	   }
	   return $output;
	}
	
	function errorMessage($str) {
		return '<div style="width:50%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
	}
	
	function successMessage($str) {
		return '<div style="width:50%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
	}
	
	function toInArray($cus_ids){
		$res_id_arr ='';
		foreach($cus_ids as $cus_id){
			$res_id_arr .= "'".$cus_id."',";
		}
		$res_id_arr = rtrim($res_id_arr,",");
		return $res_id_arr;
	}
	/* Add Two Associate Array */
	function addAssociateArr($cust, $lda) {
		foreach ($cust as $key => $value) {
			$lda[$key] = $lda[$key] + $cust[$key];
		}
		return $lda;
	}
	/* User Inactivity Session Time Out*/
	function auto_logout($field)
	{
		$t = time();
		$t0 = $_SESSION[$field];
		$diff = $t - $t0;		
		if ($diff > 1800 || !isset($t0))	// 10 minutes
		{          
			return true;
		}
		else
		{
			$_SESSION[$field] = time();
		}
	}
	
?>