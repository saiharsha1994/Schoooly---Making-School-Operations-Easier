<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Gallery_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Gallery_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/gallery
	function gallery_get()
    {
		$data = $this->Gallery_model->getGallery();
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found in ".TABLE_GALLERY;
            $this->response($ret_val, 404);
        }
	}
	
	
	//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/insertGallery/Gal_Desc/Desc/Gal_Img_Url/Urls/Album_Id/1/Album_Title/tik/Post_By/1
	function insertGallery_post()
    { 
		$data = $this->Gallery_model->InsertData($this->post('Gal_Desc'),$this->post('Gal_Img_Url'),
												$this->post('Album_Id'),$this->post('Album_Title'),
												$this->post('Post_By'));
        if($data)
        {
			/*$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! Snaps of our fun filled day has been updated on the app." ,"image_url" => "");	
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
			}*/
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_GALLERY;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/albumList
	function albumList_get()
    {
		$data = $this->Gallery_model->getAlbum();
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ALBUM;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/insertAlbum/Album_Title/Title
	function insertAlbum_post()
    { 
		$data = $this->Gallery_model->InsertAlbumData($this->post('Album_Title'));
        if($data)
        {
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! Snaps of our fun filled day has been updated on the app." ,"image_url" => "");	
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_ALBUM;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/deleteGalleryImage/Gal_Id/1
	function deleteGalleryImage_post()
    { 
		$data = $this->Gallery_model->DeleteGalleryData($this->post('Gal_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to Delete in ".TABLE_GALLERY;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Gallery_Api/deleteAlbum/Album_Id/1
	function deleteAlbum_post()
    { 
		$data = $this->Gallery_model->DeleteAlbumData($this->post('Album_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to Delete in ".TABLE_ALBUM;
            $this->response($ret_val, 404);
        }
	}
}
?>