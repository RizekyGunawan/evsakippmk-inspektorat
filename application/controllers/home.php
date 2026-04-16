<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}
		}


	public function index (){
		/*$this->load->model('m_dokumen');
		$data['unit']= $this->m_dokumen->get_data();*/
		$data['user']= $this->m_auth2->get_datauser();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$periode = $this->session->userdata('periode');
		$data['unit2']= $this->m_home->get_data2();
		$data['unit4']= $this->m_home->get_data4($id_unit);

		$this->load->view('templates/header', $data);

		

		// Role lama (1-7) dan role baru (9-14) semua diarahkan ke v_home
		$valid_roles = [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14];
		if (in_array($this->session->userdata('id_role'), $valid_roles)) {
			$this->load->view('v_home');
		} else {
			$this->load->view('404');
		}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}

	public function update_pass (){

		$id_user 		= $this->input->post('id_user');
		$password 		= $this->input->post('password');
		$passwordhash	= password_hash("$password", PASSWORD_DEFAULT);

		$data = array(
			'password'				=> $passwordhash
		);


		$where = array(
				'id_user' => $id_user
		);

		$this->m_auth2->update_pass($where,$data,'ta_user');
		$url = $_SERVER['HTTP_REFERER'];
		redirect($url);
	}


	

}
