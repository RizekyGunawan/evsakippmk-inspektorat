<?php 



class Tl extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

	public function index (){
		$this->load->model('m_tl');
		

		$data['user']= $this->m_auth2->get_datauser();
		$data['unit2']= $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['tla']= $this->m_tl->get_data3($tahun,$id_unit);
		$data['unit3monev']= $this->m_tl->get_data3monev($tahun);
		$data['unit4']= $this->m_home->get_data4($id_unit);
		$data['loadtu']= $this->m_tl->get_load($tahun,$id_unit);

		$this->load->view('templates/header', $data);

		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==1)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==2)  {
		$this->load->view('v_tl', $data);}
		elseif ($this->session->userdata('id_role')==3)  {
		$this->load->view('v_tl', $data);}else {
		$this->load->view('404');}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	



public function update_data (){

		$id_tl 					= $this->input->post('id_tl');
		$uraian_tl 				= $this->input->post('uraian_tl');
		$target_tl 				= $this->input->post('target_tl');
		$realisasi_tl 			= $this->input->post('realisasi_tl');
		$bukti_tl 				= $this->input->post('bukti_tl');
		$modified_by 			= $this->session->userdata('username');

		$data = array(
			'uraian_tl'			=> $uraian_tl,
			'target_tl'			=> $target_tl,
			'realisasi_tl'		=> $realisasi_tl,
			'bukti_tl'			=> $bukti_tl,
			'modified_by'	 	=> $modified_by,
		);


		$where = array(
				'id_tl' => $id_tl
		);

		$this->m_tl->update_data($where,$data,'ta_tl');
		redirect('/tl/index');	
	}


	public function update_data2 (){

		$id_tl 					= $this->input->post('id_tl');
		$status_data3 			= $this->input->post('status_data3');
		$modified_by 			= $this->session->userdata('username');

		$data = array(
			'status_data3'			=> $status_data3,
			'modified_by'	 		=> $modified_by,
		);


		$where = array(
				'id_tl' => $id_tl
		);

		$this->m_tl->update_data($where,$data,'ta_tl');
		redirect('/tl/index');	
	}


	


}

 ?>