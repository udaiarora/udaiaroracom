<?php 
/**
* 
*/
class Site extends CI_Controller
{
	
	function index()
	{
		$data = array();
		
		if ($query = $this->site_model->get_records()) {
			$data['records'] = $query;
		}
		$this->load->view('option_view', $data);
	}
}