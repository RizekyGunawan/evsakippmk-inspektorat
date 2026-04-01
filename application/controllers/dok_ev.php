<?php 



class Dok_ev extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

	public function index (){
		$this->load->model('m_dok_ev');
		

		$data['user']= $this->m_auth2->get_datauser();
		$data['unit2']= $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['unit3']= $this->m_dok_ev->get_data3($tahun,$id_unit);
		$data['unit3monev']= $this->m_dok_ev->get_data3monev($tahun);
		$data['unit3monev2']= $this->m_dok_ev->get_data3monev2($tahun);
		$data['unit4']= $this->m_home->get_data4($id_unit);

		$this->load->view('templates/header', $data);

		

		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_dok_ev', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_dok_ev2', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_dok_ev', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_dok_ev', $data);}
		elseif ($this->session->userdata('id_role')==1)  {
		$this->load->view('v_dok_ev2', $data);}
		elseif ($this->session->userdata('id_role')==2)  {
		$this->load->view('v_dok_ev', $data);}
		elseif ($this->session->userdata('id_role')==3)  {
		$this->load->view('v_dok_ev', $data);}
		elseif (in_array($this->session->userdata('id_role'), [10, 11, 12])) {
		$this->load->view('v_dok_ev', $data);}
		else {
		$this->load->view('403');}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	



public function update_data (){

		$id_unit 				= $this->input->post('id_unit');
		$tahun 					= $this->input->post('tahun');
		$id_dok_ev 				= $this->input->post('id_dok_ev');
		$status_data1 			= $this->input->post('status_data1');
		$modified_by 			= $this->session->userdata('username');

		$data = array(
			'status_data1'			=> $status_data1,
			'modified_by'			=> $modified_by,
		);


		$where = array(
				'id_dok_ev' => $id_dok_ev
		);

		$this->m_dok_ev->update_data($where,$data,'ta_dok_ev');
		redirect('/dok_ev/index');	
	}


	public function update_data2() {
    $id_dok_ev = $this->input->post('id_dok_ev');
    $modified_by = $this->session->userdata('username');
    $lap_ev = $_FILES['lap_ev'];

    if ($lap_ev['name'] == '') {
        // File tidak diunggah
        echo "No file uploaded"; die();
    } else {
        // Konfigurasi upload
        $config['upload_path'] = './assets/dok_ev';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 15360; // Ukuran file maksimal dalam kilobytes (15MB = 15 * 1024KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('lap_ev')) {
            // Gagal upload, tampilkan pesan error
            $error = $this->upload->display_errors();
            echo "Upload Gagal: " . $error; die();
        } else {
            // Sukses upload
            $lap_ev = $this->upload->data('file_name');
        }
    }

    $data = array(
        'lap_ev' => $lap_ev,
        'modified_by' => $modified_by,
    );

    $where = array(
        'id_dok_ev' => $id_dok_ev,
    );

    $this->m_dok_ev->update_data($where, $data, 'ta_dok_ev');
    redirect('/dok_ev/index');
}




	public function update_data3() {

    $id_dok_ev = $this->input->post('id_dok_ev');
    $modified_by = $this->session->userdata('username');
    $ba_ev = $_FILES['ba_ev'];

    if ($ba_ev['name'] == '') {
        // File tidak diunggah
        echo "No file uploaded"; die();
    } else {
        // Konfigurasi upload
        $config['upload_path'] = './assets/dok_ev';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 15360; // Ukuran file maksimal dalam kilobytes (15MB = 15 * 1024KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('ba_ev')) {
            // Gagal upload, tampilkan pesan error
            $error = $this->upload->display_errors();
            echo "Upload Gagal: " . $error; die();
        } else {
            // Sukses upload
            $ba_ev = $this->upload->data('file_name');
        }
    }

    $data = array(
        'ba_ev' => $ba_ev,
        'modified_by' => $modified_by,
    );

    $where = array(
        'id_dok_ev' => $id_dok_ev,
    );

    $this->m_dok_ev->update_data($where, $data, 'ta_dok_ev');
    redirect('/dok_ev/index');
}


public function dashboard_rekap (){
	$this->load->model('m_dok_ev');
	
	$data['user']= $this->m_auth2->get_datauser();
	$data['unit2']= $this->m_home->get_data2();
	$tahun = $this->session->userdata('tahun');
	$id_unit = $this->session->userdata('id_unit');
	
	// Get component scores for all units
	$data['datakomp']= $this->m_dok_ev->get_datakomp($tahun);
	$data['unit4']= $this->m_home->get_data4($id_unit);
	
	$this->load->view('templates/header', $data);
	
	if ($this->session->userdata('id_role')==4)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==5)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==6)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==7)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==1)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==2)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif ($this->session->userdata('id_role')==3)  {
	$this->load->view('v_dok_ev_dashboard', $data);}
	elseif (in_array($this->session->userdata('id_role'), [10, 11, 12])) {
	$this->load->view('v_dok_ev_dashboard', $data);}
	else {
	$this->load->view('403');}

	$this->load->view('templates/sidebar');
	$this->load->view('templates/footer', $data);
}


public function perbandingan (){
	$this->load->model('m_dok_ev');
	
	$data['user']= $this->m_auth2->get_datauser();
	$data['unit2']= $this->m_home->get_data2();
	$tahun = $this->session->userdata('tahun');
	$id_unit = $this->session->userdata('id_unit');
	
	// Get comparison data for current and previous year
	$tahun_current = intval($tahun);
	$tahun_previous = $tahun_current - 1;
	$data['perbandingan']= $this->m_dok_ev->get_perbandingan_data($tahun_current, $tahun_previous);
	$data['unit4']= $this->m_home->get_data4($id_unit);
	
	$this->load->view('templates/header', $data);
	
	if ($this->session->userdata('id_role')==4)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==5)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==6)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==7)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==1)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==2)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif ($this->session->userdata('id_role')==3)  {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	elseif (in_array($this->session->userdata('id_role'), [10, 11, 12])) {
	$this->load->view('v_dok_ev_perbandingan', $data);}
	else {
	$this->load->view('403');}

	$this->load->view('templates/sidebar');
	$this->load->view('templates/footer', $data);
}


}

 ?>