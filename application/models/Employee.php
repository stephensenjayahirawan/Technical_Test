<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Model {

	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('employee');
		$result = $this->db->get();

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return false;
		}
		
	}
	public function get($ID)
	{
		$this->db->select('*');
		$this->db->where('ID', $ID);
		$this->db->from('employee');
		$result = $this->db->get();

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return false;
		}
		
	}

	public function update($id, $data)
	{
		$this->db->where('ID', $id);
		$result = $this->db->update('employee', $data);
		
		if ($result) {
			return $result;
		} else {
			return false;
		}
		
	}	

	public function delete($id)
	{
		$this->db->where('ID', $id);
		$result  = $this->db->delete('Employee');

		if ($result) {
			return $result;
		} else {
			return false;
		}
		
	}

	public function add($data)
	{
		$result = $this->db->insert('Employee', $data);

		if ($result) {
			return $result;
		} else {
			return false;
		}
		
	}

	public function clearAll()
	{
		$this->db->where('ID >', 0);
		$result = $this->db->delete('employee');

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}


}

/* End of file Employee.php */
/* Location: ./application/models/Employee.php */