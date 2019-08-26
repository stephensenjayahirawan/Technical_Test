<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('pdf');
	}

	public function index()
	{
		$this->load->model('Employee');
		
		$data['Employee'] = $this->Employee->getAll();
		

		$this->load->view('Template/Header');
		$this->load->view('Layout/V_Home',$data);
		$this->load->view('Template/Footer');
	}

	public function get($id)
	{
		$this->load->model('Employee');

		$data = $this->Employee->get($id);
		echo json_encode($data);

	}

	public function downloadPDF()
	{
		// $pdf = new FPDF('l','mm','A3');
        // membuat halaman baru
		// $pdf->AddPage('L');
  //       // setting jenis font yang akan digunakan
		// $pdf->SetFont('Arial','B',16);
  //       // mencetak string 
		// $pdf->Cell(190,7,'Employee Data',0,1,'C');
		// $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
		$pdf=new PDF_MC_Table('l','mm','A3');
		$pdf->AddPage('L');

		$pdf->SetFont('Arial','',14);
		//Table with 20 rows and 4 columns
		$pdf->SetWidths(array(10,50,25,40,40,30,40,35,60,70));
		
		// for($i=0;$i<20;$i++)
		// 	$pdf->Output();
		// $pdf->Cell(10,7,'',0,1);
		// $pdf->SetFont('Arial','B',10);
		// $pdf->Cell(10,12,'ID',1,0);
		// $pdf->Cell(50,12,'NAME',1,0);
		// $pdf->Cell(20,12,'GENDER',1,0);
		// $pdf->Cell(20,12,'PLACE OF BIRTH',1,0);
		// $pdf->Cell(20,12,'DATE OF BIRTH',1,0);
		// $pdf->Cell(30,12,'RELIGION',1,0);
		// $pdf->Cell(40,12,'ADDRESS',1,0);
		// $pdf->Cell(40,12,'PHONE',1,0);
		// $pdf->Cell(40,12,'EMAIL',1,0);
		// $pdf->Cell(40,12,'NOTES',1,1);
		// $pdf->SetFont('Arial','',10);
		$pdf->Row(array('ID','NAME','GENDER','PLACE OF BIRTH','DATE OF BIRTH','RELIGION','ADDRESS','PHONE','EMAIL','NOTES'));
		$this->load->model('Employee');
		$data = $this->Employee->getAll();
		foreach ($data as $key) {
			$pdf->Row(array($key['ID'],$key['NAME'],$key['GENDER'],$key['PLACE_OF_BIRTH'],$key['DATE_OF_BIRTH'],$key['RELIGION'],$key['ADDRESS'],$key['PHONE'],$key['EMAIL'],$key['NOTES']));
		// 	$pdf->Cell(10,6,$key['ID'],1,0);
		// 	$pdf->Cell(50,6,$key['NAME'],1,0);
		// 	$pdf->Cell(20,6,$key['GENDER'],1,0);
		// 	$pdf->Cell(40,6,$key['PLACE_OF_BIRTH'],1,0);
		// 	$pdf->Cell(32,6,$key['DATE_OF_BIRTH'],1,0);
		// 	$pdf->Cell(30,6,$key['RELIGION'],1,0);
		// 	$pdf->Cell(40,6,$key['ADDRESS'],1,0);
		// 	$pdf->Cell(40,6,$key['PHONE'],1,0);
		// 	$pdf->Cell(40,6,$key['EMAIL'],1,0);
		// 	$pdf->MultiCell(40,6,$key['NOTES'],1,'L');
		}
			$pdf->Output();

  //       // $mahasiswa = $this->db->get('mahasiswa')->result();
  //       // foreach ($mahasiswa as $row){
  //       //     $pdf->Cell(20,6,$row->nim,1,0);
  //       //     $pdf->Cell(85,6,$row->nama_lengkap,1,0);
  //       //     $pdf->Cell(27,6,$row->no_hp,1,0);
  //       //     $pdf->Cell(25,6,$row->tanggal_lahir,1,1); 
  //       // }
		// $pdf->Output();
        // $pdf->Output('D','Employee Data.pdf');

	}

	public function exportToCSV()
	{
		$this->load->model('Employee');
		// $this->load->dbutil();

		// $query = $this->db->query("SELECT * FROM Employee");

		// force_download( $this->dbutil->csv_from_result($query));

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
	public function store()
	{
		// NAME
		// GENDER
		// PLACE_OF_BIRTH
		// DATE_OF_BIRTH
		// RELIGION
		// ADDRESS
		// PHONE
		// EMAIL
		// NOTES

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
require_once APPPATH.'/third_party/fpdf181/fpdf.php';
class PDF_MC_Table extends FPDF
{
	var $widths;
	var $aligns;

	function SetWidths($w)
	{
    //Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
    //Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
    //Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
    //Issue a page break first if needed
		$this->CheckPageBreak($h);
    //Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
        //Draw the border
			$this->Rect($x,$y,$w,$h);
        //Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
    //Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
    //If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
    //Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}