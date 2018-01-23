<?php
class Fees_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getFeesDetails($Student_Id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$year= $query->row('description');
		$status = array('1', '3', '4', '5');
		$this -> db -> select('pending_id,fees_term,fees_amount,action_status,reject_reason');	 
		$this -> db -> from(TABLE_FEE_PENDING);	
		$this -> db -> where('student_id',$Student_Id);
		$this -> db -> where_in('action_status',$status);
		$this -> db -> where('year',$year);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getFeesPaidDetails($Student_Id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$year= $query->row('description');
		
		$this -> db -> select('fees_term,total_fees_amount,fine_amount,paid_on');	 
		$this -> db -> from(TABLE_FEE_INVOICE);	
		$this -> db -> where('student_id',$Student_Id);
		$this -> db -> where('year',$year);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function postBankReceipt($pending_id,$amount,$receipt){
		
		$details=array('paid_amt'=> $amount,
					'bank_receipt'=> $receipt,
					'action_status'=>4);
					
		$this->db->where('pending_id',$pending_id);
		$this->db->update('fees_pending',$details);
		return true;		
	}
	
}
?>