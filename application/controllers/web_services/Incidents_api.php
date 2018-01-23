<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Incidents_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Incidents_model');
		$this->load->database();
	}	
//	http://localhost/Schoooly/index.php/web_services/Incidents_api/listIncident/from_date/2017-04-01/to_date/2017-04-12/bus_id/1
	function listIncident_get()
    {
		$data = $this->Incidents_model->getIncidentList($this->get('from_date'),$this->get('to_date'),$this->get('bus_id'));
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
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
//	http://localhost/Schoooly/index.php/web_services/Incidents_api/listIncidentById/id/1
	function listIncidentById_get()
    {
		$data = $this->Incidents_model->getIncidentListById($this->get('id'));
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
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Incidents_api/addIncident/date/2017-01-02/driver_id/1/driver_name/thouseef/bus_id/1/bus_name/bus1/details/Small Accident/report/file.pdf/fine_amt/100/status/1/document/file.jpg
		
	function addIncident_post()
    {
		//status 1=>paid ; 2=>unpaid 
		$details=array(
				'date' => urldecode($this->post('date')),
				'driver_id' => urldecode($this->post('driver_id')),
				'driver_name' => urldecode($this->post('driver_name')),
				'bus_id' => urldecode($this->post('bus_id')),
				'bus_name' => urldecode($this->post('bus_name')),
				'details' => urldecode($this->post('details')),
				'report_upload' => urldecode($this->post('report')),
				'fine_amount' => urldecode($this->post('fine_amt')),
				'status' => urldecode($this->post('status')),
				'document_upload' => urldecode($this->post('document'))
				);
							
		$data = $this->Incidents_model->addDetails($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Incidents_api/editIncident/incident_id/1/date/2017-01-02/driver_id/1/driver_name/thouseef/bus_id/1/bus_name/bus1/details/Small Accident/report/file.pdf/fine_amt/100/status/1/document/file.jpg
	function editIncident_post()
    {
		//status 1=>paid ; 2=>unpaid 
		$details=array(
				'date' => urldecode($this->post('date')),
				'driver_id' => urldecode($this->post('driver_id')),
				'driver_name' => urldecode($this->post('driver_name')),
				'bus_id' => urldecode($this->post('bus_id')),
				'bus_name' => urldecode($this->post('bus_name')),
				'details' => urldecode($this->post('details')),
				'report_upload' => urldecode($this->post('report')),
				'fine_amount' => urldecode($this->post('fine_amt')),
				'status' => urldecode($this->post('status')),
				'document_upload' => urldecode($this->post('document'))
				);
							
		$data = $this->Incidents_model->editDetails($details,$this->post('incident_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Incidents_api/deleteIncident/incident_id/1
	function deleteIncident_post()
    {
		$data = $this->Incidents_model->deleteDetails($this->post('incident_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Incidents_api/addHealthRequest/user_id/1/user_type/1/reason/somereason
	function addHealthRequest_post()
    {
		$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
		$details=array(
				'request_by' => urldecode($this->post('user_id')),
				'user_type' => urldecode($this->post('user_type')),
				'year' => $running_year,
				'reason' => urldecode($this->post('reason')));
		$data = $this->Incidents_model->addHealthRequest($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Incidents_api/listHealthRequest/user_id/1/user_type/1
	function listHealthRequest_get()
    {
		$data = $this->Incidents_model->getHealthRequestListByUsertype($this->get('user_id'),$this->get('user_type'));
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
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
}
?>