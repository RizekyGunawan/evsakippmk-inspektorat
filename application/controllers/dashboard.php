<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}
		}


	public function index (){
		
		$data['user']= $this->m_auth2->get_datauser();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$periode = $this->session->userdata('periode');
		$data['unit2']= $this->m_home->get_data2();
		$data['unit4']= $this->m_home->get_data4($id_unit);
		$data['status_data']= $this->m_dashboard->get_status($tahun);
		$data['status_dataev']= $this->m_dashboard->get_statusev($tahun);
		$data['blminiputev']= $this->m_dashboard->get_blminputev($tahun);
		$data['blminiputevunit']= $this->m_dashboard->get_blminputevunit($tahun,$id_unit);
		$data['statusrinci']= $this->m_dashboard->get_statusrinci($tahun);
		$data['konfirmasi']= $this->m_dashboard->get_konfirmasi($tahun,$id_unit);
		$data['konfirmasi2']= $this->m_dashboard->get_konfirmasi2($tahun,$id_unit);
		$data['konfirmasi0']= $this->m_dashboard->get_konfirmasi0($tahun,$id_unit);
		$data['konfirmasi02']= $this->m_dashboard->get_konfirmasi02($tahun,$id_unit);
		$data['statusunit']= $this->m_dashboard->get_statusunit($tahun,$id_unit);
		$data['persenkriteria']= $this->m_dashboard->get_persenkriteria($tahun,$id_unit);
		$data['persensub']= $this->m_dashboard->get_persensub($tahun,$id_unit);
		$data['statusunitev']= $this->m_dashboard->get_statusunitev($tahun,$id_unit);
		$data['persenkriteriaev']= $this->m_dashboard->get_persenkriteriaev($tahun,$id_unit);
		$data['persensubev']= $this->m_dashboard->get_persensubev($tahun,$id_unit);
		$data['rekomendasi']= $this->m_dashboard->get_rekomendasi($tahun,$id_unit);
		$data['tl']= $this->m_dashboard->get_tl($tahun,$id_unit);

		$this->load->view('templates/header', $data);


		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==1)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==2)  {
		$this->load->view('v_dashboard', $data);}
		elseif ($this->session->userdata('id_role')==3)  {
		$this->load->view('v_dashboard', $data);}else {
		$this->load->view('404');}


		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}

	
	

}
