<?php
require(APPPATH.'/libraries/REST_Controller.php');

class ArrivalDeparture_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Arrivaldeparture_model');
		$this->load->database();
	}
	
//	http://localhost/Tifly_Pro/index.php?web_services/ArrivalDeparture_api/addArrivalDeparture/bus_id/1/route_id/1/date/2017-09-09/pickup_start_time/12:00 AM/pickup_end_time/12:00 AM/drop_start_time/12:00 AM/drop_end_time/12:00 AM
	function addArrivalDeparture_get()
    {
		$details=array(
				'bus_id' => urldecode($this->get('bus_id')),
				'driver_id' => urldecode($this->get('driver_id')),
				'date' => urldecode($this->get('date')),
				'pickup_start_time' => urldecode($this->get('pickup_start_time')),
				'pickup_end_time' => urldecode($this->get('pickup_end_time')),
				'drop_start_time' => urldecode($this->get('drop_start_time')),
				'drop_end_time' => urldecode($this->get('drop_end_time'))
				);
				
		$data = $this->Arrivaldeparture_model->addArrivalDepartureDetails($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success insert";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php?web_services/ArrivalDeparture_api/ArrivalDepartureList/bus_id/1/from_date/2017-09-09/to_date/2017-09-99
	function ArrivalDepartureList_get()
	{
		$data = $this->Arrivaldeparture_model->getArrivalDepartureDetails($this->get('bus_id'),$this->get('from_date'),$this->get('to_date'));
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