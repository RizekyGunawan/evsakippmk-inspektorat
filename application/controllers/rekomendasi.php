<?php 



class Rekomendasi extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

	public function index (){
		$this->load->model('m_rekomendasi');
		

		$data['user']= $this->m_auth2->get_datauser();
		$data['unit2']= $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['rekom']= $this->m_rekomendasi->get_data3($tahun,$id_unit);
		$data['unit3monev']= $this->m_rekomendasi->get_data3monev($tahun);
		$data['unit4']= $this->m_home->get_data4($id_unit);
		$data['loadtu']= $this->m_rekomendasi->get_load($tahun,$id_unit);
		$data['sev']= $this->m_rekomendasi->get_sev($tahun,$id_unit);

		$this->load->view('templates/header', $data);


		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==1)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==2)  {
		$this->load->view('v_rekomendasi', $data);}
		elseif ($this->session->userdata('id_role')==3)  {
		$this->load->view('v_rekomendasi', $data);}else {
		$this->load->view('404');}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	

	public function tambah_data (){

		$id_unit 				= $this->input->post('id_unit');
		$tahun 					= $this->input->post('tahun');
		$uraian_rekomendasi 	= $this->input->post('uraian_rekomendasi');
		$created_by 			= $this->session->userdata('username');
		$modified_by 			= $this->session->userdata('username');
		
		$data = array(
			'id_unit'				=> $id_unit,
			'tahun'					=> $tahun,
			'uraian_rekomendasi'	=> $uraian_rekomendasi,
			'created_by'			=> $created_by,
			'modified_by'			=> $modified_by,
	);

		$this->m_rekomendasi->input_data($data, 'ta_rekomendasi');
		redirect('/rekomendasi/index');
	}




	public function hapus ($id_rekomendasi){

		$where = array('id_rekomendasi' => $id_rekomendasi);
		$this->m_rekomendasi->delete_data($where, 'ta_rekomendasi');
		redirect ('/rekomendasi/index');

	}



public function update_data (){

		$id_rekomendasi 		= $this->input->post('id_rekomendasi');
		$uraian_rekomendasi 	= $this->input->post('uraian_rekomendasi');
		$modified_by 			= $this->session->userdata('username');

		$data = array(
			'uraian_rekomendasi'	=> $uraian_rekomendasi,
		);


		$where = array(
				'id_rekomendasi' => $id_rekomendasi,
				'modified_by'	 => $modified_by,

		);

		$this->m_rekomendasi->update_data($where,$data,'ta_rekomendasi');
		redirect('/rekomendasi/index');	
	}


	public function update_data2 (){

		$id_unit 				= $this->input->post('id_unit');
		$tahun 					= $this->input->post('tahun');
		
		
		$this->m_rekomendasi->update_data2($id_unit,$tahun);
		redirect('/rekomendasi/index');	
	}

	


}

 ?>