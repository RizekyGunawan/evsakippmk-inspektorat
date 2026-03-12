<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth2 extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{

		$config = [
			"img_path" => "./assets/captcha/",
			"img_url" => base_url('assets/captcha'),
			'img_width' => '150',
			'img_height' => 40,
			'border' => 1,
			'font_size' => 20,
			'font_path' => FCPATH . 'system/fonts/texb.ttf',
			"expiration" => 3600,
			'word_length' => 4,
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(168, 169, 168),
				'text' => array(0, 0, 0),
				'grid' => array(168, 169, 168)
			)
		];

		$captcha = create_captcha($config);

		$this->session->unset_userdata('captcha_word');
		$this->session->set_userdata('captcha_word', $captcha['word']);


		$data['image'] = $captcha['image'];

		$this->load->view('v_login', $data);
	}


	function login()
	{

		$config = array(
			'img_path' => './assets/captcha/',
			'img_url' => base_url('assets/captcha'),
			'img_width' => '150',
			'img_height' => 40,
			'border' => 1,
			'font_size' => 20,
			'font_path' => FCPATH . 'system/fonts/texb.ttf',
			'expiration' => 3600,
			'word_length' => 4,
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(168, 169, 168),
				'text' => array(0, 0, 0),
				'grid' => array(168, 169, 168)
			)
		);

		$captcha = create_captcha($config);

		$this->session->unset_userdata('captcha_word');
		$this->session->set_userdata('captcha_word', $captcha['word']);


		$data['image'] = $captcha['image'];


		$this->form_validation->set_rules('username', 'Username', 'trim|required|regex_match[/^[a-zA-Z0-9_\-\.]+$/]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$tahun = $this->input->post('tahun');
		$sendedcaptcha = $this->input->post('captcha');
		/*$periode = $this->input->post('periode');*/

		$cekuser = $this->m_auth2->cekuser($username);
		if ($this->form_validation->run($cekuser) != false) {
			/*$ceklogin = $this->m_auth2->ceklogin($username,$password);
			if ($ceklogin){*/

			if (is_array($cekuser) || is_object($cekuser)) {
				foreach ($cekuser as $row) {
					if (password_verify($password, $row->password)) {


						$this->session->set_userdata('id_user', $row->id_user);
						$this->session->set_userdata('username', $row->username);
						$this->session->set_userdata('id_unit', $row->id_unit);
						$this->session->set_userdata('id_role', $row->id_role);
						$this->session->set_userdata('nm_user', $row->nm_user);
						$this->session->set_userdata('nm_unit', $row->nm_unit);
						$this->session->set_userdata('tahun', $tahun);
						$this->session->set_userdata('id_unit2', $row->id_unit);
						/*$this->session->set_userdata('periode', $periode);*/

					}
				}

				// Role lama (1-7) + Role baru (9-14)
				$allowed_roles = [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14];
				if (in_array((int)$this->session->userdata('id_role'), $allowed_roles)) {
					// Admin (role 9) langsung ke halaman Manajemen User
					if ((int)$this->session->userdata('id_role') === 9) {
						redirect('users/index');
					}
					redirect('dashboard/index');
				} else {
					echo "<script>alert('Username atau Password salah.');</script>";
					$this->load->view('v_login', $data);
				}

			} else {
				echo "<script>alert('Username atau Password salah.');</script>";
				$this->load->view('v_login', $data);

			}

		} else {

			$this->load->view('v_login', $data);

		}

	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('auth2/index');
	}

	public function get_user_by_unit_ajax()
	{
		$id_unit = $this->input->get('id_unit');
		$user = $this->m_auth2->get_user_by_unit($id_unit);
		echo json_encode($user);
	}

	public function get_evaluator_ajax()
	{
		$user = $this->m_auth2->get_evaluator();
		echo json_encode($user);
	}

}

?>