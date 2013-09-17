<?php 
/**
* 
*/
class Site_model extends CI_Model
{
	
	function get_records()
	{
		$query = $this->db->get('users');
		return $query->result();
	}
}