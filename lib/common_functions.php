<?php
	/* Contains common functions APIs */
	
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
		
	function errorMessage($str) {
		return '<div style="width:100%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
	}
	
	function successMessage($str) {
		return '<div style="width:100%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
	}
	
	// Check, if username session is NOT set then this page will jump to login page
	function iniz_session($ajax=0){
		// Inialize session
		session_start();
		if (!isset($_SESSION['username'])) {
			if($ajax)
				echo "SystemSessionTimeOut~index.php";
			else
				header('Location: index.php');
			exit;
		}elseif(auto_logout("user_time")){  //User Inactivity Session Time Out
			session_unset();
			session_destroy();
			if($db_conn)
				$db_conn->close();
			if($ajax)
				echo "SystemSessionTimeOut~index.php";
			else
				echo "Your session has expired! <a href='index.php'>Login here</a>";
			exit;
		}elseif($ajax){  //html strip tags to avoid XSS			
			$_POST=array_map('strip_tags',$_POST);
		}	
	}	
	
	function toInArray($cus_ids){
		$res_id_arr ='';
		foreach($cus_ids as $cus_id){
			$res_id_arr .= "'".$cus_id."',";
		}
		$res_id_arr = rtrim($res_id_arr,",");
		return $res_id_arr;
	}
	
	
?>