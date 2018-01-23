<?php
class Noticeboard_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	
	
	function getNoticeboardDet()
	{
	   $this -> db -> select('*');
	   $this -> db -> from(TABLE_NOTICEBOARD);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {					
					$data[] = $row;						
				}				
			return $data;
		   }else{
				return false;
		   }
	}	
	
	function getNoticeboardDetById($id)
	{
		$this -> db -> select('*');
	    $this -> db -> from(TABLE_NOTICEBOARD);
	    $this -> db -> where('Not_Id', $id);	   
	    $this -> db -> limit(1);		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {				
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function addNoticeboardDet($DataArr)
	{
		$this->db->insert(TABLE_NOTICEBOARD, $DataArr);
		$query = $this->db->insert_id();
		// print_r($query);
		// exit;
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	
	function UpdateNoticeboardDetById($Not_Id,$DataArr)
	{
		$this->db->where('Not_Id',$Not_Id);
		$query = $this->db->update(TABLE_NOTICEBOARD,$DataArr);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	
	function deleteNoticeboardDetById($id)
	{
		$this->db->where('Not_Id', $id);
		$query = $this->db->delete(TABLE_NOTICEBOARD);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
	
	function deleteMultiNoticeboardDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Not_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_NOTICEBOARD);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
}
?>