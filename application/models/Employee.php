<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Model {
	/*
	function for get all employee data in database.

	*/
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
	/*
	 * Get one employee data with ID 
	 *
	 * @param string $ID the id want to be find
	 */
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
	/*
	 * Insert multiple data
	 *
	 * @param string $data array of employee data
	 */
	public function insert_batch($data)
	{

		$result = $this->db->insert_batch('Employee', $data);

		if ($result) {
			return true;
		} else {
			return false;
		}
		
	}
	/*
	 * Change employee data with $id
	 *
	 * @param string $id the id want to change
	 * @param array $data all data you have changed
	 */
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

	/*
	 * Delete employee data with $id
	 *
	 * @param string $id the id want to change
	 */
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

	/*
	 * Create a new employee with $data.
	 *
	 * @param array $data all data you want to add 
	 */
	public function add($data)
	{
		$result = $this->db->insert('Employee', $data);

		if ($result) {
			return $result;
		} else {
			return false;
		}
		
	}

	/*
	 * Delete all employee data
	 *
	 */
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