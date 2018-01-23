<?php
class Chatting_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getChatList($Message_Thread,$current_user)
	{
		$this->db->where('sender',$current_user);
		$this->db->where('message_thread_code',$Message_Thread);
		$q = $this->db->get(TABLE_MESSAGE_THREAD);
		if ($q->num_rows() > 0) 
		{
			$Type='sender';
		} else {
			$Type= 'reciever';
		}
		
		$this -> db -> select('*');
	    $this -> db -> from(TABLE_MESSAGE);
		$this -> db -> where('message_thread_code',$Message_Thread);
		if($Type=='sender'){
			$this -> db -> where('sender_clear_status',0);
		}else {
			$this -> db -> where('receiver_clear_status',0);
		}
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {

			$senderArray = explode("-",$row['sender']);
				//echo $senderArray[0];
				if($senderArray[0]=='parent'){
					$row['sender_name']=$this->db->get_where('parent' , array('parent_id' => $senderArray[1]))->row()->name;
				}else if($senderArray[0]=='teacher'){
					$row['sender_name']=$this->db->get_where('employee_details' , array('emp_id' => $senderArray[1]))->row()->name;
				}else if($senderArray[0]=='admin'){
					$row['sender_name']=$this->db->get_where('employee_details' , array('emp_id' => $senderArray[1]))->row()->name;
				}			
				$data[] = $row;	
			}				
			return $data;
		}else{
			return false;
		}		
	}
	
	function getContactList($PostTo_Id)
	{	
		$this -> db -> select('*');
	    $this -> db -> from(TABLE_MESSAGE_THREAD);
		$where = "((sender='".$PostTo_Id."' AND sender_clear_status=0) or (reciever='".$PostTo_Id."'AND receiver_clear_status=0))"; 
	    $this -> db -> where($where);	   
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {
				
				$senderArray = explode("-",$row['sender']);
				//echo $senderArray[0];
				if($senderArray[0]=='parent'){
					$row['sender_name']=$this->db->get_where('parent' , array('parent_id' => $senderArray[1]))->row()->name;
				}else if($senderArray[0]=='teacher'){
					$row['sender_name']=$this->db->get_where('employee_details' , array('emp_id' => $senderArray[1]))->row()->name;
				}else if($senderArray[0]=='admin'){
					$row['sender_name']=$this->db->get_where('employee_details' , array('emp_id' => $senderArray[1]))->row()->name;
				}
				$recieverArray = explode("-",$row['reciever']);
				//echo $senderArray[0];
				if($recieverArray[0]=='parent'){
					$row['reciever_name']=$this->db->get_where('parent' , array('parent_id' => $recieverArray[1]))->row()->name;
				}else if($recieverArray[0]=='teacher'){
					$row['reciever_name']=$this->db->get_where('employee_details' , array('emp_id' => $recieverArray[1]))->row()->name;
				}else if($recieverArray[0]=='admin'){
					$row['reciever_name']=$this->db->get_where('employee_details' , array('emp_id' => $recieverArray[1]))->row()->name;
				}
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function InsertData($PostBy_Id,$PostBy_Name,$Message,$PostTo_Id,$PostTo_Name,$PostTo_Type,$Post_Type,$Post_Url)
	{
		$img = str_replace('|', '/', urldecode($Post_Url));
		$Post_On = date("Y-m-d H:i:s");
		$dataArr = array(
			'PostBy_Id' => $PostBy_Id,
			'PostBy_Name' => urldecode($PostBy_Name),
			'Message' => urldecode($Message),
			'PostTo_Id' => $PostTo_Id,
			'PostTo_Name' => urldecode($PostTo_Name),
			'PostTo_Type' => $PostTo_Type,
			'Post_Url' => $img,
			'Post_Type' => $Post_Type,
			'Post_On' => $Post_On);

		if($this->db->insert(TABLE_CHAT, $dataArr)){
			$Chat_Id = $this->db->insert_id();
			return $Chat_Id;
		}
		else{
			return 0;
		}		
	}
	
	
	 ////////private message//////
    function send_new_message($sender,$reciever,$message,$post_type,$post_url) {
        
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
		$img = str_replace('|', '/', urldecode($post_url));
        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
			$data_message_thread['last_message_timestamp']            = $timestamp;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0){
			$message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
			
			$this->db->where('sender', $sender);
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE_THREAD, array('sender_clear_status' => 0,'receiver_clear_status' => 0));
		}
        if ($num2 > 0){
			$message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
						
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE_THREAD, array('sender_clear_status' => 0,'receiver_clear_status' => 0));
		}
            
        $data_message['message_thread_code']    = $message_thread_code;
		if($message=='null'){
			$data_message['message']                = '';
		}else{
			 $data_message['message']                = urldecode($message);
		}
       
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
		$data_message['post_type']              = $post_type;
		
		$data_message['post_url']              = $img;
       
		if($this->db->insert('message', $data_message)){
			return $message_thread_code;	
		}

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

   function clearChat($message_thread_code,$current_user){
		
		$this->db->where('sender',$current_user);
		$this->db->where('message_thread_code',$message_thread_code);
		$q = $this->db->get(TABLE_MESSAGE_THREAD);
		if ($q->num_rows() > 0) 
		{
			$this->db->where('sender', $current_user);
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE_THREAD, array('sender_clear_status' => 1));
						
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE, array('sender_clear_status' => 1));
		} else {
			$this->db->where('reciever', $current_user);
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE_THREAD, array('receiver_clear_status' => 1));
			
			$this->db->where('message_thread_code', $message_thread_code);
			$this->db->update(TABLE_MESSAGE, array('receiver_clear_status' => 1));
		}
		return true;
	}

    function mark_thread_messages_read($message_thread_code,$current_user) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
       
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

	
	 ////////broadcast message//////
    function send_new_broadcast_message($sender,$message,$class_id,$section_id) {
        
		$post_type=1;
		$post_url=null;
		$reciever="";
		/*$this->db->select('parent_id');
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$query = $this->db->get('student');*/
		$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		
		$query = $this->db->query("SELECT parent_id FROM student WHERE student_id IN 
				(SELECT student_id FROM enroll WHERE class_id=".$class_id." AND section_id=".$section_id." AND year='".$running_year."')");
			
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$reciever='parent-'.$row['parent_id'];
				
				$timestamp  = strtotime(date("Y-m-d H:i:s"));
				$img = str_replace('|', '/', urldecode($post_url));
				//check if the thread between those 2 users exists, if not create new thread
				$num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
				$num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

				if ($num1 == 0 && $num2 == 0) {
					$message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
					$data_message_thread['message_thread_code'] = $message_thread_code;
					$data_message_thread['sender']              = $sender;
					$data_message_thread['reciever']            = $reciever;
					$data_message_thread['last_message_timestamp']            = $timestamp;
					$this->db->insert('message_thread', $data_message_thread);
				}
				if ($num1 > 0){
					$message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
					
					$this->db->where('sender', $sender);
					$this->db->where('message_thread_code', $message_thread_code);
					$this->db->update(TABLE_MESSAGE_THREAD, array('sender_clear_status' => 0,'receiver_clear_status' => 0));
				}
				if ($num2 > 0){
					$message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
								
					$this->db->where('message_thread_code', $message_thread_code);
					$this->db->update(TABLE_MESSAGE_THREAD, array('sender_clear_status' => 0,'receiver_clear_status' => 0));
				}
					
				$data_message['message_thread_code']    = $message_thread_code;
				if($message=='null'){
					$data_message['message']                = '';
				}else{
					 $data_message['message']                = urldecode($message);
				}
			   
				$data_message['sender']                 = $sender;
				$data_message['timestamp']              = $timestamp;
				$data_message['post_type']              = $post_type;
				$data_message['post_url']              = $img;
			   
				$this->db->insert('message', $data_message);
			}
			return true;
		}else{
			return false;
		}
    }
	
    function count_unread_message_of_thread($current_user) {
       
		$this->db->where('sender!=',$current_user);
		$this->db->where('read_status',0);
		$q = $this->db->get(TABLE_MESSAGE);
		if ($q->num_rows() > 0) {
			foreach (($q->result_array()) as $row) {
				$data[] = $row;	
			}
			return $data;	
		}else{
			return false;
		}
	}
		/*$unread_message_counter = 0;
        
		$messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }*/
}
?>