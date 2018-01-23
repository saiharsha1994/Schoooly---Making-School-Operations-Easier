<?php
class Gallery_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getGallery()
	{
		$q = $this->db->query('SELECT Gal_Id,Gal_Desc,Gal_Img_Url,Like_Count,Album_Id,Album_Title,Post_Time FROM '.TABLE_GALLERY);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Gal_Desc,$Gal_Img_Url,$Album_Id,$Album_Title,$Post_By)
	{
		$img = str_replace('|', '/', urldecode($Gal_Img_Url));
		$Post_Time = date("Y-m-d H:i:s");
		$dataArr = array(
			'Gal_Desc' => $Gal_Desc,
			'Gal_Img_Url' => $img,
			'Album_Id' => $Album_Id,
			'Album_Title' => urldecode($Album_Title),
			'Post_By' => $Post_By,
			'Post_Time' => $Post_Time);

		if($this->db->insert('app_gallery', $dataArr))
		{
			return true;
		}else{
			return false;
		}		
	}
	
	function getAlbum()
	{
		$q = $this->db->query('SELECT Album_Id,Album_Title,Album_Descript,Album_Count,Album_AddedOn FROM '.TABLE_ALBUM);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertAlbumData($Album_Title)
	{
		$Album_AddedOn = date("Y-m-d H:i:s");
		$dataArr = array(
			'Album_Title' => urldecode($Album_Title),
			'Album_AddedOn' => $Album_AddedOn);

		if($this->db->insert(TABLE_ALBUM, $dataArr))
		{
			return true;
		}else{
			return false;
		}
	}
	
	 
	function DeleteGalleryData($Gal_Id)
	{
		/*if($this->db->delete(TABLE_GALLERY, array('Gal_Id' => $Gal_Id)))
		{
			
		}	*/	
		if($this->db->query("DELETE FROM ".TABLE_GALLERY." WHERE Gal_Id IN(".$Gal_Id.")")) {
			return 'Success';
		}
	}
	
	function DeleteAlbumData($Album_Id)
	{
		$this->db->where('Album_Id', $Album_Id);
		$query = $this->db->delete(TABLE_ALBUM);		
		if($query == 1){
			$this->db->where('Album_Id', $Album_Id);
			$query1 = $this->db->delete(TABLE_GALLERY);
			if($query1 == 1){
				return 'Deleted Successfully';
			}
		}else{
			return false;
		}
	}
}
?>