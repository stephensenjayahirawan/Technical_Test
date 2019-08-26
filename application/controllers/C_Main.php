<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Main extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	/*
	* Load homepage and show all employee data
	*/
	public function index()
	{
		$this->load->model('Employee');
		
		$data['Employee'] = $this->Employee->getAll();
		
		$this->load->view('Template/Header');
		$this->load->view('Layout/V_Home',$data);
		$this->load->view('Template/Footer');
	}

	/*
	* Show data of an employee in JSON
	*/
	public function get()
	{
		$id = $this->input->post('ID');

		if (!isset($id)) {
			redirect('/','refresh');
		}
		$this->load->model('Employee');

		$data = $this->Employee->get($id);

		$origDate =  $data[0]['DATE_OF_BIRTH'];
		$newDate = date("m/d/Y", strtotime($origDate));

		$data[0]['DATE_OF_BIRTH'] = $newDate;
		echo (json_encode($data));


	}
	/*
	* download example csv file
	*/
	public function exampleCSV()
	{
		$this->load->helper('download');
		force_download(APPPATH.'..\assets\csv\Example.csv',NULL);
		redirect('','refresh');
		
	}
	/*
	* Generate PDF of all employee data
	*/
	public function downloadPDF()
	{

		$this->load->model('Employee');
		$data['Employee'] =  $this->Employee->getAll();

		$this->load->library('Mydompdf');

		$this->mydompdf->setPaper('A4', 'landscape');
		$this->mydompdf->filename = "laporan-petanikode.pdf";
		$this->mydompdf->load_view('layout/V_Report', $data);
		return;
		
	}

	/*
	* Generate CSV file that contain all employee data
	*/
	public function exportToCSV()
	{
		$this->load->model('Employee');

		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=\"Employee".".csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");

		$handle = fopen('php://output', 'w');
		$data = array(
			'1'=> 'ID',
			'2'=> 'Name',
			'3'=> 'Gender',
			'4'=> 'Place of Birth',
			'5'=> 'Date of Birth',
			'6'=> 'Religion',
			'7'=> 'Address',
			'8'=> 'Phone',
			'9'=> 'Email',
			'10'=> 'Notes',
		);
		fputcsv($handle, $data);

		$data = $this->Employee->getAll();
		foreach ($data as $data) {
			fputcsv($handle, $data);
		}
		fclose($handle);
		exit;
		redirect('','refresh');
	}

	/*
	* Delete all employee data and insert all employee data from csv
	*/
	public function importCSV()
	{

		$csv = $_FILES['csv_file']['tmp_name'];
		$handle = fopen($csv,"r");
		$row = fgetcsv($handle, 10000, ",");
		$data = array();
		$iterator = 0;
		while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
		{
			$employee = array(
				'ID' => $row[0],
				'NAME' => $row[1],
				'GENDER' => strtoupper($row[2]),
				'PLACE_OF_BIRTH' => $row[3],
				'DATE_OF_BIRTH' => $row[4],
				'RELIGION' => $row[5],
				'ADDRESS' => $row[6],
				'PHONE' => $row[7],
				'EMAIL' => $row[8],
				'NOTES' => $row[9],
			);
			$iterator ++;
			$explodedDate = explode('/', $employee['DATE_OF_BIRTH']);
			$day = $explodedDate[0];
			if (isset($explodedDate[1])) {
				$month = $explodedDate[1];
			}
			if (isset($explodedDate[2])) {
				$year = $explodedDate[2];
			}
			if (checkdate($month, $day, $year)) {
				if (strtoupper($employee['GENDER']) == 'MALE' || strtoupper($employee['GENDER']) == 'FEMALE'){
					$origDate =  $year.'-'.$month.'-'.$day ;
					// $newDate = date('Y-m-d', strtotime($origDate));
					$employee['DATE_OF_BIRTH'] =  $origDate;
					
					array_push($data, $employee);
				}else{
					$this->session->set_flashdata('error', 'Wrong Gender value. Gender should be either MALE or FEMALE');
					redirect('/','refresh');

					break;
				}
			}else{
				$this->session->set_flashdata('error', 'Wrong date format or wrong date. Date format should be dd/mm/yyyy');
				redirect('/','refresh');
				break;
			}

		}
		$this->load->model('Employee');
		$result = $this->Employee->clearAll();
		if ($result) {

			$result = $this->Employee->insert_batch($data);
			if ($result) {
				$this->session->set_flashdata('success', 'Successfully upload csv and insert '.$iterator .' employee data');
			}else{
				$this->session->set_flashdata('error', 'There is an error when uploading csv or insert employee data');
			}
		} else {
			$this->session->set_flashdata('error', 'There is an error when deleting all employee data');

		}
		redirect('/','refresh');
		
		return;
		
	}
	/*
	* Store employee data to database
	*/
	public function store()
	{
		$this->form_validation->set_rules('NAME', 'NAME', 'required|trim');
		$this->form_validation->set_rules('GENDER', 'GENDER', 'required|trim|in_list[MALE,FEMALE]');
		$this->form_validation->set_rules('DATE_OF_BIRTH', 'DATE_OF_BIRTH', 'required');
		$this->form_validation->set_rules('PLACE_OF_BIRTH', 'PLACE_OF_BIRTH', 'required|trim');
		$this->form_validation->set_rules('RELIGION', 'RELIGION', 'trim|required');
		$this->form_validation->set_rules('ADDRESS', 'ADDRESS', 'trim|required');
		$this->form_validation->set_rules('PHONE', 'Phone', 'required|numeric');
		$this->form_validation->set_rules('EMAIL', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('NOTES', 'NOTES', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
		}
		else
		{
			$origDate =  $this->input->post('DATE_OF_BIRTH');

			$newDate = date("Y-m-d", strtotime($origDate));

			$data = array(
				'NAME' => $this->input->post('NAME'),
				'GENDER' => $this->input->post('GENDER'),
				'DATE_OF_BIRTH' => $newDate,
				'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
				'RELIGION' => $this->input->post('RELIGION'),
				'ADDRESS' => $this->input->post('ADDRESS'),
				'PHONE' => $this->input->post('PHONE'),
				'EMAIL' => $this->input->post('EMAIL'),
				'NOTES' => $this->input->post('NOTES'),
			);
			$this->load->model('Employee');

			$result = $this->Employee->add($data);

			if ($result) {
				$this->session->set_flashdata('success', 'Successfully add a new employee data');
			}else{
				$this->session->set_flashdata('error', 'There is an error when adding a new employee');
			}
		}
		
		redirect('/','refresh');
	}
	/*
	* Edit employee data with $id

	* @param $id the id want to be updated
	*/
	public function edit($id)
	{
		
		$this->form_validation->set_rules('EDIT_NAME', 'NAME', 'required|trim');
		$this->form_validation->set_rules('EDIT_GENDER', 'GENDER', 'required|trim|in_list[MALE,FEMALE]');
		$this->form_validation->set_rules('EDIT_DATE_OF_BIRTH', 'DATE_OF_BIRTH', 'required');
		$this->form_validation->set_rules('EDIT_PLACE_OF_BIRTH', 'PLACE_OF_BIRTH', 'required|trim');
		$this->form_validation->set_rules('EDIT_RELIGION', 'RELIGION', 'trim|required');
		$this->form_validation->set_rules('EDIT_ADDRESS', 'ADDRESS', 'trim|required');
		$this->form_validation->set_rules('EDIT_PHONE', 'Name', 'required|numeric');
		$this->form_validation->set_rules('EDIT_EMAIL', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('EDIT_NOTES', 'NOTES', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
		}
		else
		{


			$origDate =  $this->input->post('EDIT_DATE_OF_BIRTH');
			$newDate = date("Y-m-d", strtotime($origDate));
			$data = array(
				'NAME' => $this->input->post('EDIT_NAME'),
				'GENDER' => $this->input->post('EDIT_GENDER'),
				'DATE_OF_BIRTH' => $newDate,
				'PLACE_OF_BIRTH' => $this->input->post('EDIT_PLACE_OF_BIRTH'),
				'RELIGION' => $this->input->post('EDIT_RELIGION'),
				'ADDRESS' => $this->input->post('EDIT_ADDRESS'),
				'PHONE' => $this->input->post('EDIT_PHONE'),
				'EMAIL' => $this->input->post('EDIT_EMAIL'),
				'NOTES' => $this->input->post('EDIT_NOTES'),
			);
			$this->load->model('Employee');

			$result = $this->Employee->update($id,$data);
			
			if ($result) {
				$this->session->set_flashdata('success', 'Successfully add a new employee data');
			}else{
				$this->session->set_flashdata('error', 'There is an error when adding a new employee');
			}
		}
		
		redirect('/','refresh');
	}
	/*
	* Delete employee data with $id

	* @param $id the employee id want to be deleted
	*/
	public function delete($id)
	{
		$this->load->model('Employee');

		$result = $this->Employee->delete($id);
		if ($result) {
			$this->session->set_flashdata('success', 'Successfully delete employee data');
		}else{
			$this->session->set_flashdata('error', 'There is an error when deleting employee data');
		}
		redirect('/','refresh');
	}

	/*
	* Delete all employee data 
	*/
	public function deleteAll()
	{

		$this->load->model('Employee');

		$result = $this->Employee->clearAll();

		if ($result) {
			$this->session->set_flashdata('success', 'Successfully delete all employee data');
		} else {
			$this->session->set_flashdata('error', 'There is an error when deleting all employee data');
			# code...
		}
		

		redirect('/','refresh');
	}

}

/* End of file C_Main.php */
/* Location: ./application/controllers/C_Main.php */