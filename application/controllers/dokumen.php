<?php 



class Dokumen extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

	public function index (){
		$this->load->model('m_dokumen');
		

		$data['user']= $this->m_auth2->get_datauser();
		$data['unit2']= $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['unit3']= $this->m_dokumen->get_data3($tahun,$id_unit);
		$data['unit3monev']= $this->m_dokumen->get_data3monev($tahun);
		$data['unit3monev2']= $this->m_dokumen->get_data3monev2($tahun);
		$data['unit4']= $this->m_home->get_data4($id_unit);
		$data['loadtu']= $this->m_dokumen->get_load($tahun,$id_unit);
		$data['loadtuall']= $this->m_dokumen->get_loadall($tahun);

		$this->load->view('templates/header', $data);

		

		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_dokumen', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_dokumen', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_dokumen2', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_dokumen2', $data);}
		elseif ($this->session->userdata('id_role')==1)  {
		$this->load->view('v_dokumen', $data);}
		elseif ($this->session->userdata('id_role')==2)  {
		$this->load->view('v_dokumen2', $data);}
		elseif ($this->session->userdata('id_role')==3)  {
		$this->load->view('v_dokumen2', $data);}else {
		$this->load->view('404');}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	

	public function tambah_data (){

		$id_unit 				= $this->input->post('id_unit');
		$tahun 					= $this->input->post('tahun');
	

		$this->m_dokumen->tambah_data($id_unit,$tahun);
		redirect('/dokumen/index');
	}

	public function tambah_dataall (){

		$tahun 					= $this->input->post('tahun');
	

		$this->m_dokumen->tambah_dataall($tahun);
		redirect('/dokumen/index');
	}




	public function hapus ($id_dokumen){

		$where = array('id_dokumen' => $id_dokumen);
		$this->m_dokumen->delete_data($where, 'ta_dokumen');
		redirect ('/dokumen/index');

	}



public function update_data (){

		$id_unit 				= $this->input->post('id_unit');
		$tahun 					= $this->input->post('tahun');
		$id_dokumen 			= $this->input->post('id_dokumen');
		$status_data 			= $this->input->post('status_data');
		$modified_by 			= $this->session->userdata('username');

		$data = array(
			'status_data'			=> $status_data,
			'modified_by'			=> $modified_by,
		);


		$where = array(
				'id_dokumen' => $id_dokumen
		);

		$this->m_dokumen->update_data($where,$data,'ta_dokumen');
		redirect('/dokumen/index');	
	}


	public function update_data2() {

    $id_dokumen = $this->input->post('id_dokumen');
    $modified_by = $this->session->userdata('username');
    $dok_lap = $_FILES['dok_lap'];

    if ($dok_lap['name'] == '') {
        // File tidak diunggah
        echo "No file uploaded"; die();
    } else {
        // Konfigurasi upload
        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 15360; // Ukuran file maksimal dalam kilobytes (15MB = 15 * 1024KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('dok_lap')) {
            // Gagal upload, tampilkan pesan error
            $error = $this->upload->display_errors();
            echo "Upload Gagal: " . $error; die();
        } else {
            // Sukses upload
            $dok_lap = $this->upload->data('file_name');
        }
    }

    $data = array(
        'dok_lap' => $dok_lap,
        'modified_by' => $modified_by,
    );

    $where = array(
        'id_dokumen' => $id_dokumen,
    );

    $this->m_dokumen->update_data($where, $data, 'ta_dokumen');
    redirect('/dokumen/index');
}


public function update_data3() {

    $id_dokumen = $this->input->post('id_dokumen');
    $modified_by = $this->session->userdata('username');
    $files = $_FILES['upload_bukti_tag'];
    
    // Konfigurasi upload
    $config['upload_path'] = './assets/bukti_pm';
    $config['allowed_types'] = 'jpg|png|pdf|xlsx|docx';

    // Load library upload dengan konfigurasi di atas
    $this->load->library('upload', $config);

    // Array untuk menyimpan nama file yang berhasil diupload
    $uploaded_files = array();

    // Loop untuk mengunggah setiap file
    for ($i = 0; $i < count($files['name']); $i++) {
        $_FILES['file']['name'] = $files['name'][$i];
        $_FILES['file']['type'] = $files['type'][$i];
        $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
        $_FILES['file']['error'] = $files['error'][$i];
        $_FILES['file']['size'] = $files['size'][$i];

        if ($this->upload->do_upload('file')) {
            // Jika upload berhasil, tambahkan nama file ke array
            $uploaded_files[] = $this->upload->data('file_name');
        } else {
            // Jika upload gagal, keluarkan pesan error
            echo "Upload Gagal: " . $this->upload->display_errors();
            die();
        }
    }

    // Gabungkan nama file yang berhasil diupload menjadi string yang dipisahkan dengan koma
    $upload_bukti_tag = implode(',', $uploaded_files);

    $data = array(
        'upload_bukti_tag' => $upload_bukti_tag,
        'modified_by' => $modified_by,
    );

    $where = array(
        'id_dokumen' => $id_dokumen,
    );

    $this->m_dokumen->update_data($where, $data, 'ta_dokumen');
    redirect('/dokumen/index');
}


	
	public function excelnilai(){

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['unit3monev2']= $this->m_dokumen->get_data3monev2($tahun);

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Ev-SAKIP BPKP");
		$object->getProperties()->setLastModifiedBy("Ev-SAKIP BPKP");
		$object->getProperties()->setTitle("Data Nilai PM");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'NO');
		$object->getActiveSheet()->setCellValue('B1', 'KODE UNIT');
		$object->getActiveSheet()->setCellValue('C1', 'NAMA UNIT');
		$object->getActiveSheet()->setCellValue('D1', 'NILAI SA');
		$object->getActiveSheet()->setCellValue('E1', 'STATUS SA');

		$baris = 2;
		$no = 1;

		foreach ($data['unit3monev2'] as $nilai) {
			$status_data = '';
			if ($nilai['status_data'] == "1") {
			    $status_data = "Final";
			} elseif ($nilai['status_data'] == "0") {
			    $status_data = "Draft";
			} elseif ($enilai['status_data'] == "") {
			    $status_data = "Belum Input";
			}
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $nilai['kd_unit']);
			$object->getActiveSheet()->setCellValue('C'.$baris, $nilai['nm_unit']);
			$object->getActiveSheet()->setCellValue('D'.$baris, $nilai['totalnilai']);
			$object->getActiveSheet()->setCellValue('E'.$baris, $status_data);

			$baris++;

		}

		$timestamp = date("Y-m-d_His");

		$filename="Data_NilaidanStatus_PM_" . $timestamp . '.xlsx';

		$object->getActiveSheet()->setTitle("Data_NilaidanStatus_PM");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');

		exit;

	}

	public function excelkomp(){

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['komponen']= $this->m_dokumen->get_datakomp($tahun);

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Ev-SAKIP BPKP");
		$object->getProperties()->setLastModifiedBy("Ev-SAKIP BPKP");
		$object->getProperties()->setTitle("Data Kompilasi Komponen PM");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'NO');
		$object->getActiveSheet()->setCellValue('B1', 'KODE UNIT');
		$object->getActiveSheet()->setCellValue('C1', 'NAMA UNIT');
		$object->getActiveSheet()->setCellValue('D1', 'KODE KOMPONEN');
		$object->getActiveSheet()->setCellValue('E1', 'URAIAN KOMPONEN');
		$object->getActiveSheet()->setCellValue('F1', 'NILAI');
		$object->getActiveSheet()->setCellValue('G1', 'PERSEN');

		$baris = 2;
		$no = 1;

		foreach ($data['komponen'] as $komp) {
			
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $komp['kd_unit']);
			$object->getActiveSheet()->setCellValue('C'.$baris, $komp['nm_unit']);
			$object->getActiveSheet()->setCellValue('D'.$baris, $komp['kd_komponen']);
			$object->getActiveSheet()->setCellValue('E'.$baris, $komp['uraian_komponen']);
			$object->getActiveSheet()->setCellValue('F'.$baris, $komp['nilaikomponen']);
			$object->getActiveSheet()->setCellValue('G'.$baris, $komp['nilaipersen']);

			$baris++;

		}

		$timestamp = date("Y-m-d_His");

		$filename="Data_KompilasiKomponen_PM_" . $timestamp . '.xlsx';

		$object->getActiveSheet()->setTitle("Data_KompilasiKomponen_PM");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');

		exit;

	}


	public function excelsub(){

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['subkomponen']= $this->m_dokumen->get_datasub($tahun);

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Ev-SAKIP BPKP");
		$object->getProperties()->setLastModifiedBy("Ev-SAKIP BPKP");
		$object->getProperties()->setTitle("Data Kompilasi SubKomponen PM");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'NO');
		$object->getActiveSheet()->setCellValue('B1', 'KODE UNIT');
		$object->getActiveSheet()->setCellValue('C1', 'NAMA UNIT');
		$object->getActiveSheet()->setCellValue('D1', 'KODE KOMPONEN');
		$object->getActiveSheet()->setCellValue('E1', 'KODE SUBKOMPONEN');
		$object->getActiveSheet()->setCellValue('F1', 'URAIAN SUBKOMPONEN');
		$object->getActiveSheet()->setCellValue('G1', 'NILAI');
		$object->getActiveSheet()->setCellValue('H1', 'PERSEN');

		$baris = 2;
		$no = 1;

		foreach ($data['subkomponen'] as $sub) {
			
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $sub['kd_unit']);
			$object->getActiveSheet()->setCellValue('C'.$baris, $sub['nm_unit']);
			$object->getActiveSheet()->setCellValue('D'.$baris, $sub['kd_komponen']);
			$object->getActiveSheet()->setCellValue('E'.$baris, $sub['kd_subkomponen']);
			$object->getActiveSheet()->setCellValue('F'.$baris, $sub['uraian_subkomponen']);
			$object->getActiveSheet()->setCellValue('G'.$baris, $sub['nilaisub']);
			$object->getActiveSheet()->setCellValue('H'.$baris, $sub['nilaipersen']);

			$baris++;

		}

		$timestamp = date("Y-m-d_His");

		$filename="Data_KompilasiSubKomponen_PM_" . $timestamp . '.xlsx';

		$object->getActiveSheet()->setTitle("Data_KompilasiSubKomponen_PM");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');

		exit;

	}

	public function excelkriteria(){

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['kriteria']= $this->m_dokumen->get_datakriteria($tahun);

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Ev-SAKIP BPKP");
		$object->getProperties()->setLastModifiedBy("Ev-SAKIP BPKP");
		$object->getProperties()->setTitle("Data Kompilasi Kriteria PM");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'NO');
		$object->getActiveSheet()->setCellValue('B1', 'KODE UNIT');
		$object->getActiveSheet()->setCellValue('C1', 'NAMA UNIT');
		$object->getActiveSheet()->setCellValue('D1', 'KODE KOMPONEN');
		$object->getActiveSheet()->setCellValue('E1', 'KODE SUBKOMPONEN');
		$object->getActiveSheet()->setCellValue('F1', 'KODE KRITERIA');
		$object->getActiveSheet()->setCellValue('G1', 'URAIAN KRITERIA');
		$object->getActiveSheet()->setCellValue('H1', 'JAWABAN');

		$baris = 2;
		$no = 1;

		foreach ($data['kriteria'] as $krit) {
			
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $krit['kd_unit']);
			$object->getActiveSheet()->setCellValue('C'.$baris, $krit['nm_unit']);
			$object->getActiveSheet()->setCellValue('D'.$baris, $krit['kd_komponen']);
			$object->getActiveSheet()->setCellValue('E'.$baris, $krit['kd_subkomponen']);
			$object->getActiveSheet()->setCellValue('F'.$baris, $krit['kd_kriteria']);
			$object->getActiveSheet()->setCellValue('G'.$baris, $krit['kriteria']);
			$object->getActiveSheet()->setCellValue('H'.$baris, $krit['jawaban']);

			$baris++;

		}

		$timestamp = date("Y-m-d_His");

		$filename="Data_KompilasiKriteria_PM_" . $timestamp . '.xlsx';

		$object->getActiveSheet()->setTitle("Data_KompilasiKriteria_PM");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');

		exit;

	}

}

 ?>