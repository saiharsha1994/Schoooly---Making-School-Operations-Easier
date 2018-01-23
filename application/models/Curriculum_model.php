<?php
class Curriculum_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getCurriculum()
	{
		$q = $this->db->query('SELECT Cur_Id,Cur_Title,Cur_Desc,Sub_Type,Prg_Type,Added_On FROM '.TABLE_CURRICULUM);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Cur_Title,$Cur_Desc,$Sub_Type,$Prg_Type)
	{
		$Added_On = date("Y-m-d H:i:s");
		$dataArr = array(
			'Cur_Title' => urldecode($Cur_Title),
			'Cur_Desc' => $Cur_Desc,
			'Sub_Type' => urldecode($Sub_Type),
			'Prg_Type' => urldecode($Prg_Type),
			'Added_On' => $Added_On);

		if($this->db->insert(TABLE_CURRICULUM, $dataArr))
		{
			return 'Success';
		}		
	}
	
	function deleteCurriculum($Cur_Id)
	{
		$this->db->delete(TABLE_CURRICULUM, array('Cur_Id' => $Cur_Id));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
}
?>