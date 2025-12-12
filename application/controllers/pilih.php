<?php 

class Pilih extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

		public function pilih (){

		$id_unit =  $this->input->post('id_unit');
		$nm_unit =  $this->input->post('nm_unit');
		$tahun =  $this->input->post('tahun');


		
		$this->session->set_userdata('id_unit', $id_unit);
		$this->session->set_userdata('nm_unit', $nm_unit);
		$this->session->set_userdata('tahun', $tahun);

		
		$url = $_SERVER['HTTP_REFERER'];
		redirect($url);

	}
}