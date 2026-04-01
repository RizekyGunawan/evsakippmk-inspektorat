<?php

class Pm extends MY_Controller
{

	public function __construct()
	{
		parent::__construct(); // MY_Controller handles auth guard
	}

	public function index()
	{
		$this->load->model('m_pm');

		$data['user'] = $this->m_auth2->get_datauser();
		$data['unit2'] = $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		// Catatan: id_unit untuk UK (14) dikunci dari session, tidak bisa pilih unit lain
		$tahun = $this->session->userdata('tahun');
		/*$periode = $this->session->userdata('periode');*/
		$data['mandiri'] = $this->m_pm->get_data3($tahun, $id_unit);
		$data['mandiri0'] = $this->m_pm->get_data30($tahun, $id_unit);
		$data['sub1ai'] = $this->m_pm->get_datasub1ai($tahun, $id_unit);
		$data['sub1a'] = $this->m_pm->get_datasub1a($tahun, $id_unit);
		$data['sub1bi'] = $this->m_pm->get_datasub1bi($tahun, $id_unit);
		$data['sub1b'] = $this->m_pm->get_datasub1b($tahun, $id_unit);
		$data['sub1ci'] = $this->m_pm->get_datasub1ci($tahun, $id_unit);
		$data['sub1c'] = $this->m_pm->get_datasub1c($tahun, $id_unit);
		$data['sub2ai'] = $this->m_pm->get_datasub2ai($tahun, $id_unit);
		$data['sub2a'] = $this->m_pm->get_datasub2a($tahun, $id_unit);
		$data['sub2bi'] = $this->m_pm->get_datasub2bi($tahun, $id_unit);
		$data['sub2b'] = $this->m_pm->get_datasub2b($tahun, $id_unit);
		$data['sub2ci'] = $this->m_pm->get_datasub2ci($tahun, $id_unit);
		$data['sub2c'] = $this->m_pm->get_datasub2c($tahun, $id_unit);
		$data['sub3ai'] = $this->m_pm->get_datasub3ai($tahun, $id_unit);
		$data['sub3a'] = $this->m_pm->get_datasub3a($tahun, $id_unit);
		$data['sub3bi'] = $this->m_pm->get_datasub3bi($tahun, $id_unit);
		$data['sub3b'] = $this->m_pm->get_datasub3b($tahun, $id_unit);
		$data['sub3ci'] = $this->m_pm->get_datasub3ci($tahun, $id_unit);
		$data['sub3c'] = $this->m_pm->get_datasub3c($tahun, $id_unit);
		$data['sub4ai'] = $this->m_pm->get_datasub4ai($tahun, $id_unit);
		$data['sub4a'] = $this->m_pm->get_datasub4a($tahun, $id_unit);
		$data['sub4bi'] = $this->m_pm->get_datasub4bi($tahun, $id_unit);
		$data['sub4b'] = $this->m_pm->get_datasub4b($tahun, $id_unit);
		$data['sub4ci'] = $this->m_pm->get_datasub4ci($tahun, $id_unit);
		$data['sub4c'] = $this->m_pm->get_datasub4c($tahun, $id_unit);
		$data['kom1'] = $this->m_pm->get_datakom1($tahun, $id_unit);
		$data['kom2'] = $this->m_pm->get_datakom2($tahun, $id_unit);
		$data['kom3'] = $this->m_pm->get_datakom3($tahun, $id_unit);
		$data['kom4'] = $this->m_pm->get_datakom4($tahun, $id_unit);
		$data['komp'] = $this->m_pm->get_datakom($tahun, $id_unit);
		$data['sub'] = $this->m_pm->get_datasub($tahun, $id_unit);
		$data['kri'] = $this->m_pm->get_datakrit($tahun, $id_unit);
		$data['sumkom'] = $this->m_pm->get_datasumkom($tahun, $id_unit);
		$data['loadtu'] = $this->m_pm->get_load($tahun, $id_unit);

		$data['unit4'] = $this->m_home->get_data4($id_unit);

		$this->load->view('templates/header', $data);


		// Role lama (1-7) + Tim Evaluator (13) + Unit Kerja baru (14)
		$id_role = (int) $this->session->userdata('id_role');
		$roles_allowed_pm = [1, 2, 3, 4, 5, 6, 7, 13, 14];
		if (in_array($id_role, $roles_allowed_pm)) {
			$this->load->view('v_pm', $data);
		} else {
			$this->load->view('404');
		}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}



	public function insert_pm()
	{


		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');




		$this->m_pm->insert_pm($tahun, $id_unit);
		redirect('/pm/index');
	}


	public function update_data()
	{

		$id_pm = $this->input->post('id_pm');
		$jawaban1 = $this->input->post('jawaban1');
		$uraian_jawaban1 = $this->input->post('uraian_jawaban1');
		$link_bukti = $this->input->post('link_bukti');
		$link_bukti3 = $this->input->post('link_bukti3');
		$modified_by = $this->session->userdata('username');

		$data = array(
			'id_pm' => $id_pm,
			'jawaban1' => $jawaban1,
			'uraian_jawaban1' => $uraian_jawaban1,
			'link_bukti' => $link_bukti,
			'link_bukti3' => $link_bukti3,
			'modified_by' => $modified_by,

		);


		$where = array(
			'id_pm' => $id_pm
		);

		$result = $this->m_pm->update_data($where, $data, 'ta_pm');

		// [FIX #2] Sinkronisasi otomatis nilai sub-komponen (jawaban0)
		$this->m_pm->sync_jawaban0($id_pm);

	}

	public function update_data2()
	{
		$this->load->library('form_validation');
		$jawabanantara = $this->input->post('jawabanantara');
		$valid_jawaban0 = array();

		// Determine valid answers based on the value of jawabanantara
		switch ($jawabanantara) {
			case 'AA':
				$valid_jawaban0 = array('100');
				break;
			case 'A':
				$valid_jawaban0 = array('90');
				break;
			case 'BB':
				$valid_jawaban0 = array('80');
				break;
			case 'B':
				$valid_jawaban0 = array('70');
				break;
			case 'CC':
				$valid_jawaban0 = array('60');
				break;
			case 'C':
				$valid_jawaban0 = array('50');
				break;
			case 'D':
				$valid_jawaban0 = array('30');
				break;
			case 'E':
				$valid_jawaban0 = array('0');
				break;
			default:
				// Handle unexpected jawabanantara values if necessary
				break;
		}

		// Validate 'jawaban0' field
		$this->form_validation->set_rules('jawaban0', 'Jawaban0', 'in_list[' . implode(',', $valid_jawaban0) . ']');

		if ($this->form_validation->run() == FALSE) {
			// Handle validation errors
			redirect('/pm/index');
		} else {
			$id_pm0 = $this->input->post('id_pm0');
			$jawaban0 = $this->input->post('jawaban0');
			$uraian_jawaban0 = $this->input->post('uraian_jawaban0');
			$link_bukti0 = $this->input->post('link_bukti0');
			$link_bukti03 = $this->input->post('link_bukti03');
			$modified_by = $this->session->userdata('username');

			// Validate the selected role
			if (!in_array($jawaban0, $valid_jawaban0)) {
				show_error('Invalid answer selected.');
			} else {
				$data = array(
					'id_pm0' => $id_pm0,
					'jawaban0' => $jawaban0,
					'uraian_jawaban0' => $uraian_jawaban0,
					'link_bukti0' => $link_bukti0,
					'link_bukti03' => $link_bukti03,
					'modified_by' => $modified_by
				);

				$where = array(
					'id_pm0' => $id_pm0
				);

				$this->m_pm->update_data($where, $data, 'ta_pm0');
			}
		}
	}



	public function upload_bukti()
	{

		$id_pm = $this->input->post('id_pm');
		$modified_by = $this->session->userdata('username');
		$files = $_FILES['link_bukti2'];

		// Konfigurasi upload
		$config['upload_path'] = './assets/bukti_pm';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|xlsx|docx';

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

		// Get existing uploaded files
		$existing_files = $this->m_pm->get_uploaded_files($id_pm);
		if ($existing_files) {
			$uploaded_files = array_merge(explode(';', $existing_files), $uploaded_files);
		}

		// Gabungkan nama file yang berhasil diupload menjadi string yang dipisahkan dengan koma
		$link_bukti2 = implode(';', $uploaded_files);

		$data = array(
			'link_bukti2' => $link_bukti2,
			'modified_by' => $modified_by,
		);


		$where = array(
			'id_pm' => $id_pm
		);

		$this->m_pm->update_data($where, $data, 'ta_pm');
		redirect('/pm/index');
	}

	public function delete_file()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$file = $data['file'];
		$id_pm = $data['id_pm'];

		// Hapus file dari server
		$file_path = './assets/bukti_pm/' . $file;
		if (file_exists($file_path)) {
			if (unlink($file_path)) {
				// Dapatkan file yang sudah ada dari database
				$existing_files = $this->m_pm->get_uploaded_files($id_pm);
				if ($existing_files) {
					$files_array = explode(';', $existing_files);
					$files_array = array_diff($files_array, [$file]);
					$updated_files = implode(';', $files_array);

					// Perbarui database
					$data = array('link_bukti2' => $updated_files);
					$where = array('id_pm' => $id_pm);
					$this->m_pm->update_data($where, $data, 'ta_pm');

					// Kembalikan daftar file yang diperbarui sebagai respons
					echo json_encode(['success' => true, 'files' => $updated_files]);
					return;
				}
			} else {
				echo json_encode(['success' => false, 'message' => 'Gagal menghapus file dari server']);
				return;
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'File tidak ditemukan']);
			return;
		}
		echo json_encode(['success' => false, 'message' => 'Gagal menghapus file']);
	}



	public function upload_bukti0()
	{

		$id_pm0 = $this->input->post('id_pm0');
		$modified_by = $this->session->userdata('username');
		$files = $_FILES['link_bukti02'];

		// Konfigurasi upload
		$config['upload_path'] = './assets/bukti_pm';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|xlsx|docx';

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

		// Get existing uploaded files
		$existing_files = $this->m_pm->get_uploaded_files0($id_pm0);
		if ($existing_files) {
			$uploaded_files = array_merge(explode(';', $existing_files), $uploaded_files);
		}

		// Gabungkan nama file yang berhasil diupload menjadi string yang dipisahkan dengan koma
		$link_bukti02 = implode(';', $uploaded_files);

		$data = array(
			'link_bukti02' => $link_bukti02,
			'modified_by' => $modified_by,
		);


		$where = array(
			'id_pm0' => $id_pm0
		);

		$this->m_pm->update_data($where, $data, 'ta_pm0');
		redirect('/pm/index');
	}


	public function delete_file0()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$file = $data['file'];
		$id_pm0 = $data['id_pm0'];

		// Hapus file dari server
		$file_path = './assets/bukti_pm/' . $file;
		if (file_exists($file_path)) {
			if (unlink($file_path)) {
				// Dapatkan file yang sudah ada dari database
				$existing_files = $this->m_pm->get_uploaded_files0($id_pm0);
				if ($existing_files) {
					$files_array = explode(';', $existing_files);
					$files_array = array_diff($files_array, [$file]);
					$updated_files = implode(';', $files_array);

					// Perbarui database
					$data = array('link_bukti02' => $updated_files);
					$where = array('id_pm0' => $id_pm0);
					$this->m_pm->update_data($where, $data, 'ta_pm0');

					// Kembalikan daftar file yang diperbarui sebagai respons
					echo json_encode(['success' => true, 'files' => $updated_files]);
					return;
				}
			} else {
				echo json_encode(['success' => false, 'message' => 'Gagal menghapus file dari server']);
				return;
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'File tidak ditemukan']);
			return;
		}
		echo json_encode(['success' => false, 'message' => 'Gagal menghapus file']);
	}



	public function excel()
	{

		date_default_timezone_set('Asia/Jakarta'); // Atur ke zona waktu yang sesuai

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['mandiri'] = $this->m_pm->get_data3($tahun, $id_unit);
		$data['mandiri0'] = $this->m_pm->get_data30($tahun, $id_unit);
		$data['mandiri00'] = $this->m_pm->get_data300($tahun, $id_unit);
		$data['mandiri000'] = $this->m_pm->get_datasumkom($tahun, $id_unit);

		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Aplikasi EvSAKIP");
		$object->getProperties()->setLastModifiedBy("Aplikasi EvSAKIP");
		$object->getProperties()->setTitle("Penilaian Mandiri SAKIP - EvSAKIP");

		$object->setActiveSheetIndex(0);

		// Proteksi worksheet
		$object->getActiveSheet()->getProtection()->setSheet(true); // Proteksi worksheet
		$object->getActiveSheet()->getProtection()->setPassword('evsakipinspektoratbpkp'); // Atur kata sandi jika diperlukan

		// Melindungi workbook
		$object->getSecurity()->setLockWindows(true);
		$object->getSecurity()->setLockStructure(true);
		$object->getSecurity()->setWorkbookPassword('evsakipinspektoratbpkp'); // Atur kata sandi jika diperlukan

		if ($this->session->userdata('tahun') >= 2024):

			$object->getActiveSheet()->setCellValue('A1', 'No');
			$object->getActiveSheet()->setCellValue('B1', 'Komponen/ Subkomponen/ Kriteria');
			$object->getActiveSheet()->setCellValue('C1', 'Bobot');
			$object->getActiveSheet()->mergeCells('D1:E1');
			$object->getActiveSheet()->setCellValue('D1', 'Keberadaan, Kualitas, dan Pemanfaatan');
			$object->getActiveSheet()->setCellValue('E1', 'Keberadaan, Kualitas, dan Pemanfaatan');
			$object->getActiveSheet()->setCellValue('F1', 'Jawaban Antara');
			$object->getActiveSheet()->setCellValue('G1', 'Nilai Akhir');
			$object->getActiveSheet()->mergeCells('H1:I1');
			$object->getActiveSheet()->setCellValue('H1', 'Nilai Akuntabilitas Kinerja');
			$object->getActiveSheet()->setCellValue('I1', 'Nilai Akuntabilitas Kinerja');
			$object->getActiveSheet()->setCellValue('J1', 'Informasi Tambahan');
			$object->getActiveSheet()->setCellValue('K1', 'Penjelasan Jawaban');
			$object->getActiveSheet()->mergeCells('L1:N1');
			$object->getActiveSheet()->setCellValue('L1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('M1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('N1', 'Bukti Dukung');


			$object->getActiveSheet()->freezePane('A2');
			$sheet = $object->getActiveSheet();

			$rangeall = 'A1:N98';

			// Mendefinisikan gaya border
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$sheet->getStyle($rangeall)->applyFromArray($styleArray);


			$steel = '1F4E78'; // Contoh warna merah, Anda dapat mengganti dengan kode warna yang diinginkan
			$white = 'FFFFFF';
			$range = 'A1:N1';
			$alignment = $object->getActiveSheet()->getStyle($range)->getAlignment();

			$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($steel);
			$object->getActiveSheet()->getStyle($range)->getFont()->setColor(new PHPExcel_Style_Color($white));
			$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);
			$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$alignment->setWrapText(true);

			$rangeB = 'B2:B98';
			$alignment = $object->getActiveSheet()->getStyle($rangeB)->getAlignment();
			$alignment->setWrapText(true);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$rangeJ = 'J2:J98';
			$alignment = $object->getActiveSheet()->getStyle($rangeJ)->getAlignment();
			$alignment->setWrapText(true);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$rangeK = 'K2:K98';
			$alignment = $object->getActiveSheet()->getStyle($rangeK)->getAlignment();
			$alignment->setWrapText(true);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$rangeCI = 'C2:I98';
			$alignment = $object->getActiveSheet()->getStyle($rangeCI)->getAlignment();
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$rangeLN = 'L2:N98';
			$alignment = $object->getActiveSheet()->getStyle($rangeLN)->getAlignment();
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


			$columnB = 'B';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnB)->setWidth($width);

			$columnD = 'D';
			$width = 10; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnD)->setWidth($width);

			$columnE = 'E';
			$width = 10; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnE)->setWidth($width);

			$columnJ = 'J';
			$width = 45; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnJ)->setWidth($width);

			$columnK = 'K';
			$width = 60; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnK)->setWidth($width);

			$columnL = 'L';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnL)->setWidth($width);

			$columnM = 'M';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnM)->setWidth($width);

			$columnN = 'N';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnN)->setWidth($width);



			$baris = 2;
			$no = 1;


			$alreadyDisplayed = array();

			foreach ($data['mandiri'] as $pm) {
				$subkomponen = $pm['uraian_subkomponen'];
				$komponen = $pm['uraian_komponen'];

				// Periksa apakah komponen sudah ditampilkan sebelumnya
				if (!in_array($komponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_komponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $komponen);
					$object->getActiveSheet()->setCellValue('C' . $baris, $pm['bobot']);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Loop untuk menambahkan nilai dari data['mandiri00']
					foreach ($data['mandiri00'] as $pm00) {
						// Periksa apakah komponen dan subkomponen pada iterasi saat ini sesuai dengan data['mandiri00']
						if ($pm00['uraian_komponen'] == $komponen && $pm00['uraian_subkomponen'] == $subkomponen) {
							$object->getActiveSheet()->setCellValue('H' . $baris, $pm00['nilaik']);
							$persentase00 = number_format(floatval($pm00['nilaikpersen']), 2, ",", "") . '%';
							$object->getActiveSheet()->setCellValue('I' . $baris, $persentase00);

							$sky = '87CEEB';
							$range = 'A' . $baris . ':N' . $baris;

							$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
							$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($sky);
							$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);

							break; // Keluar dari loop jika nilai sudah ditambahkan
						}
					}

					// Tandai komponen sebagai sudah ditampilkan
					$alreadyDisplayed[] = $komponen;

					$baris++;
				}

				// Loop tambahan untuk menyisipkan data sumber lain ke baris yang sama
				foreach ($data['mandiri0'] as $pm0) {
					$nilai = '';
					if ($pm0['jawaban0'] == "100") {
						$nilai = "AA";
					} elseif ($pm0['jawaban0'] == "90") {
						$nilai = "A";
					} elseif ($pm0['jawaban0'] == "80") {
						$nilai = "BB";
					} elseif ($pm0['jawaban0'] == "70") {
						$nilai = "B";
					} elseif ($pm0['jawaban0'] == "60") {
						$nilai = "CC";
					} elseif ($pm0['jawaban0'] == "50") {
						$nilai = "C";
					} elseif ($pm0['jawaban0'] == "30") {
						$nilai = "D";
					} elseif ($pm0['jawaban0'] == "0") {
						$nilai = "E";
					}
					if ($pm0['id_pm0'] == $pm['id_pm0']) {
						// Tambahkan kolom data lain sesuai dengan kebutuhan Anda
						$object->getActiveSheet()->setCellValue('C' . $baris, $pm0['bobot2']);
						$persentaseskor = number_format(floatval($pm0['skorpersen']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('D' . $baris, $persentaseskor);
						$skor = number_format(floatval($pm0['skor']), 2, ",", "");
						$object->getActiveSheet()->setCellValue('E' . $baris, $skor);
						$object->getActiveSheet()->setCellValue('F' . $baris, $pm0['jawabanantara']);
						$object->getActiveSheet()->setCellValue('G' . $baris, $nilai);
						$object->getActiveSheet()->setCellValue('H' . $baris, floatval($pm0['jawaban0']) * floatval($pm0['bobot2']) / 100);
						$persentase0 = number_format(floatval($pm0['jawaban0']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('I' . $baris, $persentase0);
						$object->getActiveSheet()->setCellValue('J' . $baris, '');
						$object->getActiveSheet()->setCellValue('K' . $baris, $pm0['uraian_jawaban0']);
						$object->getActiveSheet()->setCellValue('L' . $baris, $pm0['link_bukti0']);
						$object->getActiveSheet()->setCellValue('M' . $baris, $pm0['link_bukti03']);
						$object->getActiveSheet()->setCellValue('N' . $baris, $pm0['link_bukti02']);



						break;
					}
				}


				if (!in_array($subkomponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_subkomponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $subkomponen);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


					$bisque = 'FFE4C4';
					$range = 'A' . $baris . ':N' . $baris;

					$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($bisque);
					$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);


					// Tandai subkomponen sebagai sudah ditampilkan
					$alreadyDisplayed[] = $subkomponen;

					$baris++;
				}

				$opsi = '';
				$jawaban1 = '';
				switch ($pm['jawaban1']) {
					case '100':
						$opsi = 'AA';
						$jawaban1 = '100';
						break;
					case '90':
						$opsi = 'A';
						$jawaban1 = '90';
						break;
					case '80':
						$opsi = 'BB';
						$jawaban1 = '80';
						break;
					case '70':
						$opsi = 'B';
						$jawaban1 = '70';
						break;
					case '60':
						$opsi = 'CC';
						$jawaban1 = '60';
						break;
					case '50':
						$opsi = 'C';
						$jawaban1 = '50';
						break;
					case '30':
						$opsi = 'D';
						$jawaban1 = '30';
						break;
					case '0':
						$opsi = 'E';
						$jawaban1 = '0';
						break;
					default:
						$opsi = 'E';
						$jawaban1 = 'Belum Diisi';
				}
				$buktiupload = '';
				if ($pm['link_bukti2'] == "") {
					$buktiupload = "";
				} elseif ($pm['link_bukti2'] != "0") {
					$buktiupload = "0";
				} elseif ($pm['jawaban1'] == "") {
					$buktiupload = "Belum Diisi";
				}
				$informasi_tambahan = $pm['ket_pengisian1'] . "\n" . $pm['ket_pengisian2'] . "\n" . $pm['ket_pengisian3'];
				$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_aspek']);
				$object->getActiveSheet()->setCellValue('B' . $baris, $pm['uraian_aspek']);
				$object->getActiveSheet()->setCellValue('C' . $baris, '');
				$object->getActiveSheet()->setCellValue('D' . $baris, $opsi);
				$object->getActiveSheet()->setCellValue('E' . $baris, $jawaban1);
				$object->getActiveSheet()->setCellValue('F' . $baris, '');
				$object->getActiveSheet()->setCellValue('G' . $baris, '');
				$object->getActiveSheet()->setCellValue('H' . $baris, '');
				$object->getActiveSheet()->setCellValue('I' . $baris, '');
				$object->getActiveSheet()->setCellValue('J' . $baris, $informasi_tambahan);
				$object->getActiveSheet()->setCellValue('K' . $baris, $pm['uraian_jawaban1']);
				$object->getActiveSheet()->setCellValue('L' . $baris, $pm['link_bukti']);
				$object->getActiveSheet()->setCellValue('M' . $baris, $pm['link_bukti3']);
				$object->getActiveSheet()->setCellValue('N' . $baris, $pm['link_bukti2']);

				$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
				$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$object->getActiveSheet()->getStyle('B' . $baris)->getAlignment()->setWrapText(true);
				$object->getActiveSheet()->getStyle('J' . $baris)->getAlignment()->setWrapText(true);



				$baris++;
			}

			foreach ($data['mandiri000'] as $pm000) {

				$predikat = '';
				$sumnilaik = floatval(str_replace(',', '.', $pm000['sumnilaik']));
				if ($sumnilaik >= 90.01 && $sumnilaik <= 100) {
					$predikat = "AA";
				} elseif ($sumnilaik >= 80.01 && $sumnilaik <= 90.00) {
					$predikat = "A";
				} elseif ($sumnilaik >= 70.01 && $sumnilaik <= 80.00) {
					$predikat = "BB";
				} elseif ($sumnilaik >= 60.01 && $sumnilaik <= 70.00) {
					$predikat = "B";
				} elseif ($sumnilaik >= 50.01 && $sumnilaik <= 60.00) {
					$predikat = "CC";
				} elseif ($sumnilaik >= 30.01 && $sumnilaik <= 50.00) {
					$predikat = "C";
				} elseif ($sumnilaik >= 0.01 && $sumnilaik <= 30.00) {
					$predikat = "D";
				} elseif ($sumnilaik == 0) {
					$predikat = "E";
				}
				$object->getActiveSheet()->setCellValue('B' . $baris, 'NILAI AKUNTABILITAS KINERJA');
				$object->getActiveSheet()->setCellValue('C' . $baris, '100');
				$object->getActiveSheet()->setCellValue('G' . $baris, $predikat);
				$object->getActiveSheet()->setCellValue('H' . $baris, $pm000['sumnilaik']);
				$persentase000 = number_format(floatval($pm000['sumnilaikpersen']), 2, ",", "") . '%';
				$object->getActiveSheet()->setCellValue('I' . $baris, $persentase000);

				$steel = '1F4E78';
				$white = 'FFFFFF';
				$range = 'A' . $baris . ':N' . $baris;

				$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($steel);
				$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);
				$object->getActiveSheet()->getStyle($range)->getFont()->setColor(new PHPExcel_Style_Color($white));
			}
		endif;


		if ($this->session->userdata('tahun') <= 2023):

			$object->getActiveSheet()->setCellValue('A1', 'No');
			$object->getActiveSheet()->setCellValue('B1', 'Komponen/ Subkomponen/ Kriteria');
			$object->getActiveSheet()->setCellValue('C1', 'Bobot');
			$object->getActiveSheet()->mergeCells('D1:E1');
			$object->getActiveSheet()->setCellValue('D1', 'Keberadaan, Kualitas, dan Pemanfaatan');
			$object->getActiveSheet()->setCellValue('E1', 'Keberadaan, Kualitas, dan Pemanfaatan');
			$object->getActiveSheet()->setCellValue('F1', 'Jawaban Antara');
			$object->getActiveSheet()->setCellValue('G1', 'Nilai Akhir');
			$object->getActiveSheet()->mergeCells('H1:I1');
			$object->getActiveSheet()->setCellValue('H1', 'Nilai Akuntabilitas Kinerja');
			$object->getActiveSheet()->setCellValue('I1', 'Nilai Akuntabilitas Kinerja');
			$object->getActiveSheet()->setCellValue('J1', 'Penjelasan Jawaban');
			$object->getActiveSheet()->mergeCells('K1:M1');
			$object->getActiveSheet()->setCellValue('K1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('L1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('M1', 'Bukti Dukung');


			$object->getActiveSheet()->freezePane('A2');
			$sheet = $object->getActiveSheet();

			$rangeall = 'A1:M98';

			// Mendefinisikan gaya border
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$sheet->getStyle($rangeall)->applyFromArray($styleArray);


			$steel = '1F4E78'; // Contoh warna merah, Anda dapat mengganti dengan kode warna yang diinginkan
			$white = 'FFFFFF';
			$range = 'A1:M1';
			$alignment = $object->getActiveSheet()->getStyle($range)->getAlignment();

			$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($steel);
			$object->getActiveSheet()->getStyle($range)->getFont()->setColor(new PHPExcel_Style_Color($white));
			$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);
			$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$alignment->setWrapText(true);

			$rangeB = 'B2:B98';
			$alignment = $object->getActiveSheet()->getStyle($rangeB)->getAlignment();
			$alignment->setWrapText(true);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$rangeJ = 'J2:J98';
			$alignment = $object->getActiveSheet()->getStyle($rangeJ)->getAlignment();
			$alignment->setWrapText(true);
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$rangeCI = 'C2:I98';
			$alignment = $object->getActiveSheet()->getStyle($rangeCI)->getAlignment();
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$rangeKM = 'K2:M98';
			$alignment = $object->getActiveSheet()->getStyle($rangeKM)->getAlignment();
			$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


			$columnB = 'B';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnB)->setWidth($width);

			$columnD = 'D';
			$width = 10; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnD)->setWidth($width);

			$columnE = 'E';
			$width = 10; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnE)->setWidth($width);

			$columnJ = 'J';
			$width = 60; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnJ)->setWidth($width);

			$columnK = 'K';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnK)->setWidth($width);

			$columnL = 'L';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnL)->setWidth($width);

			$columnM = 'M';
			$width = 30; // Lebar kolom yang diinginkan

			$object->getActiveSheet()->getColumnDimension($columnM)->setWidth($width);



			$baris = 2;
			$no = 1;


			$alreadyDisplayed = array();

			foreach ($data['mandiri'] as $pm) {
				$subkomponen = $pm['uraian_subkomponen'];
				$komponen = $pm['uraian_komponen'];

				// Periksa apakah komponen sudah ditampilkan sebelumnya
				if (!in_array($komponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_komponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $komponen);
					$object->getActiveSheet()->setCellValue('C' . $baris, $pm['bobot']);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Loop untuk menambahkan nilai dari data['mandiri00']
					foreach ($data['mandiri00'] as $pm00) {
						// Periksa apakah komponen dan subkomponen pada iterasi saat ini sesuai dengan data['mandiri00']
						if ($pm00['uraian_komponen'] == $komponen && $pm00['uraian_subkomponen'] == $subkomponen) {
							$object->getActiveSheet()->setCellValue('H' . $baris, $pm00['nilaik']);
							$persentase00 = number_format(floatval($pm00['nilaikpersen']), 2, ",", "") . '%';
							$object->getActiveSheet()->setCellValue('I' . $baris, $persentase00);

							$sky = '87CEEB';
							$range = 'A' . $baris . ':M' . $baris;

							$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
							$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($sky);
							$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);

							break; // Keluar dari loop jika nilai sudah ditambahkan
						}
					}

					// Tandai komponen sebagai sudah ditampilkan
					$alreadyDisplayed[] = $komponen;

					$baris++;
				}

				// Loop tambahan untuk menyisipkan data sumber lain ke baris yang sama
				foreach ($data['mandiri0'] as $pm0) {
					$nilai = '';
					if ($pm0['jawaban0'] == "100") {
						$nilai = "AA";
					} elseif ($pm0['jawaban0'] == "90") {
						$nilai = "A";
					} elseif ($pm0['jawaban0'] == "80") {
						$nilai = "BB";
					} elseif ($pm0['jawaban0'] == "70") {
						$nilai = "B";
					} elseif ($pm0['jawaban0'] == "60") {
						$nilai = "CC";
					} elseif ($pm0['jawaban0'] == "50") {
						$nilai = "C";
					} elseif ($pm0['jawaban0'] == "30") {
						$nilai = "D";
					} elseif ($pm0['jawaban0'] == "0") {
						$nilai = "E";
					}
					if ($pm0['id_pm0'] == $pm['id_pm0']) {
						// Tambahkan kolom data lain sesuai dengan kebutuhan Anda
						$object->getActiveSheet()->setCellValue('C' . $baris, $pm0['bobot2']);
						$persentaseskor = number_format(floatval($pm0['skorpersen']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('D' . $baris, $persentaseskor);
						$skor = number_format(floatval($pm0['skor']), 2, ",", "");
						$object->getActiveSheet()->setCellValue('E' . $baris, $skor);
						$object->getActiveSheet()->setCellValue('F' . $baris, $pm0['jawabanantara']);
						$object->getActiveSheet()->setCellValue('G' . $baris, $nilai);
						$object->getActiveSheet()->setCellValue('H' . $baris, floatval($pm0['jawaban0']) * floatval($pm0['bobot2']) / 100);
						$persentase0 = number_format(floatval($pm0['jawaban0']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('I' . $baris, $persentase0);
						$object->getActiveSheet()->setCellValue('J' . $baris, $pm0['uraian_jawaban0']);
						$object->getActiveSheet()->setCellValue('K' . $baris, $pm0['link_bukti0']);
						$object->getActiveSheet()->setCellValue('L' . $baris, $pm0['link_bukti03']);
						$object->getActiveSheet()->setCellValue('M' . $baris, $pm0['link_bukti02']);



						break;
					}
				}


				if (!in_array($subkomponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_subkomponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $subkomponen);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


					$bisque = 'FFE4C4';
					$range = 'A' . $baris . ':M' . $baris;

					$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($bisque);
					$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);


					// Tandai subkomponen sebagai sudah ditampilkan
					$alreadyDisplayed[] = $subkomponen;

					$baris++;
				}



				$opsi = '';
				$jawaban1 = '';
				switch ($pm['jawaban1']) {
					case '100':
						$opsi = 'AA';
						$jawaban1 = '100';
						break;
					case '90':
						$opsi = 'A';
						$jawaban1 = '90';
						break;
					case '80':
						$opsi = 'BB';
						$jawaban1 = '80';
						break;
					case '70':
						$opsi = 'B';
						$jawaban1 = '70';
						break;
					case '60':
						$opsi = 'CC';
						$jawaban1 = '60';
						break;
					case '50':
						$opsi = 'C';
						$jawaban1 = '50';
						break;
					case '30':
						$opsi = 'D';
						$jawaban1 = '30';
						break;
					case '0':
						$opsi = 'E';
						$jawaban1 = '0';
						break;
					default:
						$opsi = 'E';
						$jawaban1 = '0';
				}
				$buktiupload = '';
				if ($pm['link_bukti2'] == "") {
					$buktiupload = "";
				} elseif ($pm['link_bukti2'] != "0") {
					$buktiupload = "0";
				} elseif ($pm['jawaban1'] == "") {
					$buktiupload = "Belum Diisi";
				}

				$object->getActiveSheet()->setCellValue('A' . $baris, $pm['kd_aspek']);
				$object->getActiveSheet()->setCellValue('B' . $baris, $pm['uraian_aspek']);
				$object->getActiveSheet()->setCellValue('C' . $baris, '');
				$object->getActiveSheet()->setCellValue('D' . $baris, $opsi);
				$object->getActiveSheet()->setCellValue('E' . $baris, $jawaban1);
				$object->getActiveSheet()->setCellValue('F' . $baris, '');
				$object->getActiveSheet()->setCellValue('G' . $baris, '');
				$object->getActiveSheet()->setCellValue('H' . $baris, '');
				$object->getActiveSheet()->setCellValue('I' . $baris, '');
				$object->getActiveSheet()->setCellValue('J' . $baris, $pm['uraian_jawaban1']);
				$object->getActiveSheet()->setCellValue('K' . $baris, $pm['link_bukti']);
				$object->getActiveSheet()->setCellValue('L' . $baris, $pm['link_bukti3']);
				$object->getActiveSheet()->setCellValue('M' . $baris, $pm['link_bukti2']);

				$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
				$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$object->getActiveSheet()->getStyle('B' . $baris)->getAlignment()->setWrapText(true);



				$baris++;
			}

			foreach ($data['mandiri000'] as $pm000) {

				$predikat = '';
				$sumnilaik = floatval(str_replace(',', '.', $pm000['sumnilaik']));
				if ($sumnilaik >= 90.01 && $sumnilaik <= 100) {
					$predikat = "AA";
				} elseif ($sumnilaik >= 80.01 && $sumnilaik <= 90.00) {
					$predikat = "A";
				} elseif ($sumnilaik >= 70.01 && $sumnilaik <= 80.00) {
					$predikat = "BB";
				} elseif ($sumnilaik >= 60.01 && $sumnilaik <= 70.00) {
					$predikat = "B";
				} elseif ($sumnilaik >= 50.01 && $sumnilaik <= 60.00) {
					$predikat = "CC";
				} elseif ($sumnilaik >= 30.01 && $sumnilaik <= 50.00) {
					$predikat = "C";
				} elseif ($sumnilaik >= 0.01 && $sumnilaik <= 30.00) {
					$predikat = "D";
				} elseif ($sumnilaik == 0) {
					$predikat = "E";
				}
				$object->getActiveSheet()->setCellValue('B' . $baris, 'NILAI AKUNTABILITAS KINERJA');
				$object->getActiveSheet()->setCellValue('C' . $baris, '100');
				$object->getActiveSheet()->setCellValue('G' . $baris, $predikat);
				$object->getActiveSheet()->setCellValue('H' . $baris, $pm000['sumnilaik']);
				$persentase000 = number_format(floatval($pm000['sumnilaikpersen']), 2, ",", "") . '%';
				$object->getActiveSheet()->setCellValue('I' . $baris, $persentase000);

				$steel = '1F4E78';
				$white = 'FFFFFF';
				$range = 'A' . $baris . ':M' . $baris;

				$object->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$object->getActiveSheet()->getStyle($range)->getFill()->getStartColor()->setRGB($steel);
				$boldStyle = $object->getActiveSheet()->getStyle($range)->getFont()->setBold(true);
				$object->getActiveSheet()->getStyle($range)->getFont()->setColor(new PHPExcel_Style_Color($white));
			}
		endif;


		$filename = "Data_PM_SAKIP_" . $pm['kd_unit'] . "_" . $pm['tahun'] . "_" . date('His_dmY') . ".xlsx";

		$object->getActiveSheet()->setTitle("PM_SAKIP_" . $pm['kd_unit'] . "_" . $pm['tahun'] . "");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');

		exit;

	}

}

?>