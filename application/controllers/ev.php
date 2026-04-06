<?php

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property M_auth2 $m_auth2
 * @property M_home $m_home
 * @property M_ev $m_ev
 * @property Komentar_model $Komentar_model
 * @property Notifikasi_model $Notifikasi_model
 */
class Ev extends MY_Controller
{

	public function __construct()
	{
		parent::__construct(); // MY_Controller handles auth guard
	}

	public function index()
	{
		$this->load->model('m_ev');

		$data['user'] = $this->m_auth2->get_datauser();
		$data['unit2'] = $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$id_ev = $this->session->userdata('id_ev');
		$id_ev0 = $this->session->userdata('id_ev0');

		// Auto-generate form evaluasi menggunakan idempotent insert
		if (!empty($tahun) && !empty($id_unit)) {
			$this->m_ev->insert_ev($tahun, $id_unit);
		}

		$data['evaluasi'] = $this->m_ev->get_data3($tahun, $id_unit);
		$data['evaluasi0'] = $this->m_ev->get_data30($tahun, $id_unit);
		$data['sub1ai'] = $this->m_ev->get_datasub1ai($tahun, $id_unit);
		$data['sub1a'] = $this->m_ev->get_datasub1a($tahun, $id_unit);
		$data['sub1bi'] = $this->m_ev->get_datasub1bi($tahun, $id_unit);
		$data['sub1b'] = $this->m_ev->get_datasub1b($tahun, $id_unit);
		$data['sub1ci'] = $this->m_ev->get_datasub1ci($tahun, $id_unit);
		$data['sub1c'] = $this->m_ev->get_datasub1c($tahun, $id_unit);
		$data['sub2ai'] = $this->m_ev->get_datasub2ai($tahun, $id_unit);
		$data['sub2a'] = $this->m_ev->get_datasub2a($tahun, $id_unit);
		$data['sub2bi'] = $this->m_ev->get_datasub2bi($tahun, $id_unit);
		$data['sub2b'] = $this->m_ev->get_datasub2b($tahun, $id_unit);
		$data['sub2ci'] = $this->m_ev->get_datasub2ci($tahun, $id_unit);
		$data['sub2c'] = $this->m_ev->get_datasub2c($tahun, $id_unit);
		$data['sub3ai'] = $this->m_ev->get_datasub3ai($tahun, $id_unit);
		$data['sub3a'] = $this->m_ev->get_datasub3a($tahun, $id_unit);
		$data['sub3bi'] = $this->m_ev->get_datasub3bi($tahun, $id_unit);
		$data['sub3b'] = $this->m_ev->get_datasub3b($tahun, $id_unit);
		$data['sub3ci'] = $this->m_ev->get_datasub3ci($tahun, $id_unit);
		$data['sub3c'] = $this->m_ev->get_datasub3c($tahun, $id_unit);
		$data['sub4ai'] = $this->m_ev->get_datasub4ai($tahun, $id_unit);
		$data['sub4a'] = $this->m_ev->get_datasub4a($tahun, $id_unit);
		$data['sub4bi'] = $this->m_ev->get_datasub4bi($tahun, $id_unit);
		$data['sub4b'] = $this->m_ev->get_datasub4b($tahun, $id_unit);
		$data['sub4ci'] = $this->m_ev->get_datasub4ci($tahun, $id_unit);
		$data['sub4c'] = $this->m_ev->get_datasub4c($tahun, $id_unit);
		$data['kom1'] = $this->m_ev->get_datakom1($tahun, $id_unit);
		$data['kom2'] = $this->m_ev->get_datakom2($tahun, $id_unit);
		$data['kom3'] = $this->m_ev->get_datakom3($tahun, $id_unit);
		$data['kom4'] = $this->m_ev->get_datakom4($tahun, $id_unit);
		$data['komp'] = $this->m_ev->get_datakom($tahun, $id_unit);
		$data['sub'] = $this->m_ev->get_datasub($tahun, $id_unit);
		$data['kri'] = $this->m_ev->get_datakrit($tahun, $id_unit);
		$data['sumkom'] = $this->m_ev->get_datasumkom($tahun, $id_unit);
		$data['loadtu'] = $this->m_ev->get_load($tahun, $id_unit);
		$data['konfirmasi'] = $this->m_ev->get_konfirmasi($tahun, $id_unit);
		$data['h_konfirmasi'] = $this->m_ev->get_history_konfirmasi($tahun, $id_unit, $id_ev);
		$data['gage'] = $this->m_ev->get_gage($tahun, $id_unit, $id_ev);
		$data['evaluasiform'] = $this->m_ev->get_data3form($tahun, $id_unit, $id_ev);
		$data['konfirmasi0'] = $this->m_ev->get_konfirmasi0($tahun, $id_unit);
		$data['h_konfirmasi0'] = $this->m_ev->get_history_konfirmasi0($tahun, $id_unit, $id_ev0);
		$data['gage0'] = $this->m_ev->get_gage0($tahun, $id_unit, $id_ev0);
		$data['evaluasi0form'] = $this->m_ev->get_data30form($tahun, $id_unit, $id_ev0);
		$data['loadk'] = $this->m_ev->get_loadk($tahun, $id_unit, $id_ev);
		$data['loadk0'] = $this->m_ev->get_loadk0($tahun, $id_unit, $id_ev0);
		$data['konfirmasi0notif'] = $this->m_ev->get_konfirmasi0notif($tahun, $id_unit);
		$data['konfirmasi0notif2'] = $this->m_ev->get_konfirmasi0notif2($tahun, $id_unit);

		// ---------------------------------------------------------------
		// Ambil id_role sekarang agar bisa dipakai di blok berikutnya
		// ---------------------------------------------------------------
		$id_role = (int) $this->session->userdata('id_role');
		$id_user = (int) $this->session->userdata('id_user');

		// ---------------------------------------------------------------
		// UNIT SWITCHER: Supervisor (10, 11, 12) bisa lihat semua unit.
		// Jika id_unit kosong (akun supervisor tidak punya unit default),
		// otomatis pilih unit pertama dari daftar semua unit kerja.
		// ---------------------------------------------------------------
		$all_units = $this->m_home->get_data2();
		$data['all_units'] = $all_units; // dikirim ke view untuk dropdown

		if (in_array($id_role, [10, 11, 12])) {
			if (empty($id_unit) && !empty($all_units)) {
				$id_unit = $all_units[0]['id_unit'];
				$this->session->set_userdata('id_unit', $id_unit);
				redirect('ev/index');
				return;
			}
		}

		// ---------------------------------------------------------------
		// FILTERING: Tim Evaluator (13) hanya boleh akses unit tugasnya
		// ---------------------------------------------------------------
		$data['assigned_units'] = [];
		if ($id_role === 13) {
			$assigned = $this->m_ev->get_assigned_units($id_user, $tahun);
			$assigned_ids = array_column($assigned, 'id_unit');
			$data['assigned_units'] = $assigned;

			if (!in_array((int) $id_unit, $assigned_ids)) {
				if (!empty($assigned_ids)) {
					// Arahkan ke unit pertama yang ditugaskan
					$this->session->set_userdata('id_unit', $assigned_ids[0]);
					redirect('ev/index');
					return;
				} else {
					show_error('Anda belum ditugaskan ke unit manapun. Hubungi Admin untuk pengaturan penugasan.');
					return;
				}
			}
		}

		// ---------------------------------------------------------------
		// HISTORY: Supervisor (10, 11, 12) dapat melihat log perubahan EV
		// ---------------------------------------------------------------
		if (in_array($id_role, [10, 11, 12])) {
			$data['ev_history'] = $this->m_ev->get_ev_history_by_unit($id_unit, $tahun);
		} else {
			$data['ev_history'] = [];
		}

		// Focal context for notification redirection
		$data['focus_sub'] = $this->input->get('kode');
		$data['focus_indikator'] = $this->input->get('indikator');

		$data['unit4'] = $this->m_home->get_data4($id_unit);

		$this->load->view('templates/header', $data);

		// Semua role boleh melihat /ev — termasuk UK Baru (14) yang hanya baca.
		// Kontrol tombol edit dilakukan di v_ev.php via $can_edit_ev.
		if (in_array($id_role, self::ROLES_CAN_VIEW_EV)) {
			$data['can_edit_ev'] = in_array($id_role, self::ROLES_CAN_EDIT_EV);
			$this->load->view('v_ev', $data);
		} else {
			$this->load->view('404');
		}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	/**
	 * Menampilkan halaman Rekapitulasi Unit Kerja
	 * Hanya dapat diakses oleh role 2-7 (Pembina, Evaluator, Admin, Admin UK, Admin Pembina, Admin Evaluator)
	 * Menampilkan data gabungan evaluasi dari semua unit kerja
	 */
	public function rekap_unit()
	{
		// Role yang boleh akses: role lama (2-7) + Supervisor (10,11,12) + Tim Evaluator (13)
		// Unit Kerja (14) dan Admin (9) tidak bisa akses halaman Rekapitulasi
		$id_role = (int) $this->session->userdata('id_role');
		$roles_rekap = [2, 3, 4, 5, 6, 7, 10, 11, 12, 13];
		if (!in_array($id_role, $roles_rekap)) {
			show_404();
			return;
		}

		$this->load->model('m_ev');

		// Ambil data user dan unit
		$data['user'] = $this->m_auth2->get_datauser();
		$data['unit2'] = $this->m_home->get_data2();

		// Ambil tahun dari session
		$tahun = $this->session->userdata('tahun');

		// Ambil data rekapitulasi dari model
		$data['rekap_units'] = $this->m_ev->get_rekap_all_units($tahun);
		$data['rekap_detail'] = $this->m_ev->get_rekap_detail_all_units($tahun);

		// Load view dengan template
		$this->load->view('templates/header', $data);
		$this->load->view('v_ev_rekap_unit', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);
	}



	public function set_userdata_session()
	{
		$id_ev = $this->input->post('id_ev');
		$this->session->set_userdata('id_ev', $id_ev);
	}

	public function set_userdata_session0()
	{
		$id_ev0 = $this->input->post('id_ev0');
		$this->session->set_userdata('id_ev0', $id_ev0);
	}


	/**
	 * Unit Switcher untuk Tim Evaluator (role 13).
	 * Memvalidasi unit yang dipilih memang merupakan unit tugasnya,
	 * lalu update id_unit di session dan redirect ke ev/index.
	 */
	public function set_unit_session()
	{
		$id_role = (int) $this->session->userdata('id_role');
		$id_unit = (int) $this->input->post('id_unit');
		$id_user = (int) $this->session->userdata('id_user');
		$tahun = (int) $this->session->userdata('tahun');

		if ($id_role === 13 && $id_unit > 0) {
			$this->load->model('m_ev');
			$assigned = $this->m_ev->get_assigned_units($id_user, $tahun);
			$assigned_ids = array_column($assigned, 'id_unit');
			if (in_array($id_unit, $assigned_ids)) {
				$this->session->set_userdata('id_unit', $id_unit);
			}
		}
		redirect('ev/index');
	}

	/**
	 * Unit Switcher untuk Supervisor (role 10, 11, 12).
	 * Supervisor boleh memilih unit kerja manapun tanpa batasan penugasan.
	 * Update id_unit di session lalu redirect ke ev/index.
	 */
	public function set_unit_session_supervisor()
	{
		$id_role = (int) $this->session->userdata('id_role');
		$id_unit = (int) $this->input->post('id_unit');

		if (in_array($id_role, [10, 11, 12]) && $id_unit > 0) {
			$this->session->set_userdata('id_unit', $id_unit);
		}
		redirect('ev/index');
	}


	public function insert_ev()
	{


		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');




		$this->m_ev->insert_ev($tahun, $id_unit);
		redirect('/ev/index');
	}


	public function update_data()
	{

		$id_ev = $this->input->post('id_ev');
		$jawaban2 = $this->input->post('jawaban2');
		$catatan_ev = $this->input->post('catatan_ev');
		$rekomendasi = $this->input->post('rekomendasi');
		$perbaikan = $this->input->post('perbaikan');
		$modified_by = $this->session->userdata('username');
		$id_role = (int) $this->session->userdata('id_role');

		// Ambil data lama sebelum di-update untuk audit trail
		$old = $this->m_ev->get_single_ev($id_ev);
		if ($old) {
			$fields_to_track = [
				'jawaban2' => $jawaban2,
				'catatan_ev' => $catatan_ev,
				'rekomendasi' => $rekomendasi,
				'perbaikan' => $perbaikan,
			];
			foreach ($fields_to_track as $field => $new_val) {
				if ((string) $old[$field] !== (string) $new_val) {
					$this->m_ev->insert_ev_history([
						'id_ev' => $id_ev,
						'id_unit' => $old['id_unit'] ?? null,
						'tahun' => $old['tahun'] ?? null,
						'field_name' => $field,
						'old_value' => $old[$field],
						'new_value' => $new_val,
						'changed_by' => $modified_by,
						'id_role' => $id_role,
					]);
				}
			}
		}

		$data = array(
			'id_ev' => $id_ev,
			'jawaban2' => $jawaban2,
			'catatan_ev' => $catatan_ev,
			'rekomendasi' => $rekomendasi,
			'perbaikan' => $perbaikan,
			'modified_by' => $modified_by,
		);

		$where = array('id_ev' => $id_ev);

		$this->m_ev->update_data($where, $data, 'ta_ev');
	}



	public function update_data2()
	{

		$id_ev0 = $this->input->post('id_ev0');
		$jawaban0ev = $this->input->post('jawaban0ev');
		$catatan_ev0 = $this->input->post('catatan_ev0');
		$rekomendasi0 = $this->input->post('rekomendasi0');
		$perbaikan0 = $this->input->post('perbaikan0');
		$modified_by = $this->session->userdata('username');
		$id_role = (int) $this->session->userdata('id_role');

		// Audit trail: ambil data lama sebelum diupdate, catat setiap field yang berubah
		$old0 = $this->m_ev->get_single_ev0($id_ev0);
		if ($old0) {
			$fields_to_track0 = [
				'jawaban0ev' => $jawaban0ev,
				'catatan_ev0' => $catatan_ev0,
				'rekomendasi0' => $rekomendasi0,
				'perbaikan0' => $perbaikan0,
			];
			foreach ($fields_to_track0 as $field => $new_val) {
				if ((string) ($old0[$field] ?? '') !== (string) $new_val) {
					$this->m_ev->insert_ev_history([
						'id_ev0' => $id_ev0,
						'id_unit' => $old0['id_unit'] ?? null,
						'tahun' => $old0['tahun'] ?? null,
						'field_name' => $field,
						'old_value' => $old0[$field] ?? '',
						'new_value' => $new_val,
						'changed_by' => $modified_by,
						'id_role' => $id_role,
					]);
				}
			}
		}

		$data = array(
			'id_ev0' => $id_ev0,
			'jawaban0ev' => $jawaban0ev,
			'catatan_ev0' => $catatan_ev0,
			'rekomendasi0' => $rekomendasi0,
			'perbaikan0' => $perbaikan0,
			'modified_by' => $modified_by,
		);


		$where = array(
			'id_ev0' => $id_ev0
		);

		$this->m_ev->update_data($where, $data, 'ta_ev0');
	}


	public function update_konfirmasi()
	{


		$tahun = $this->input->post('tahun');
		$id_unit = $this->input->post('id_unit');
		$id_role = (int) $this->session->userdata('id_role'); // [FIX] ambil dari session, bukan POST
		$id_ev = $this->input->post('id_ev');
		$uraian_konfirmasi = $this->input->post('uraian_konfirmasi');
		$tenggat_waktu = $this->input->post('tenggat_waktu');
		$bukti_perbaikan = $this->input->post('bukti_perbaikan');
		$log_user = $this->input->post('log_user');
		$created_by = $this->session->userdata('username');
		$modified_by = $this->session->userdata('username');

		$data = array(
			'tahun' => $tahun,
			'id_unit' => $id_unit,
			'id_role' => $id_role,
			'id_ev' => $id_ev,
			'uraian_konfirmasi' => $uraian_konfirmasi,
			'tenggat_waktu' => $tenggat_waktu,
			'bukti_perbaikan' => $bukti_perbaikan,
			'log_user' => $log_user,
			'created_by' => $created_by,
			'modified_by' => $modified_by,
		);

		$this->m_ev->input_data($data, 'ta_konfirmasi');
		redirect('/ev/index');
	}

	public function update_konfirmasi0()
	{


		$tahun = $this->input->post('tahun');
		$id_unit = $this->input->post('id_unit');
		$id_role = (int) $this->session->userdata('id_role'); // [FIX] ambil dari session, bukan POST
		$id_ev0 = $this->input->post('id_ev0');
		$uraian_konfirmasi = $this->input->post('uraian_konfirmasi');
		$tenggat_waktu = $this->input->post('tenggat_waktu');
		$bukti_perbaikan = $this->input->post('bukti_perbaikan');
		$log_user = $this->input->post('log_user');
		$created_by = $this->session->userdata('username');
		$modified_by = $this->session->userdata('username');

		$data = array(
			'tahun' => $tahun,
			'id_unit' => $id_unit,
			'id_role' => $id_role,
			'id_ev0' => $id_ev0,
			'uraian_konfirmasi' => $uraian_konfirmasi,
			'tenggat_waktu' => $tenggat_waktu,
			'bukti_perbaikan' => $bukti_perbaikan,
			'log_user' => $log_user,
			'created_by' => $created_by,
			'modified_by' => $modified_by,
		);

		$this->m_ev->input_data($data, 'ta_konfirmasi');
		redirect('/ev/index');
	}


	public function simpan_komentar()
	{
		$id_role = $this->session->userdata('id_role');
		$pengirim_role = ($id_role == 1 || $id_role == 5 || $id_role == 14) ? 'subkomponen' : 'evaluator';
		$parent_id = $this->input->post('parent_id') ?: null;

		$komentar_id = $this->Komentar_model->simpan([
			'parent_id' => $parent_id,
			'pengirim_role' => $pengirim_role,
			'evaluator_id' => $this->session->userdata('id_user'),
			'target_user_id' => $this->input->post('target_user'),
			'menu' => 'Evaluasi Inspektorat',
			'sub_menu' => 'Pelaporan Kinerja',
			'komponen_id' => $this->input->post('komponen'),
			'subkomponen_id' => $this->input->post('subkomponen'),
			'subkomponen_kode' => $this->input->post('subkomponen_kode'),
			'indikator_id' => $this->input->post('indikator'),
			'section' => $this->input->post('section'),
			'label_lokasi' => $this->input->post('label_lokasi'),
			'isi_komentar' => $this->input->post('komentar')
		]);

		$this->Notifikasi_model->create([
			'user_id' => $this->input->post('target_user'),
			'komentar_id' => $komentar_id,
			'indikator_id' => $this->input->post('indikator'),
			'subkomponen_id' => $this->input->post('subkomponen'),
			'subkomponen_kode' => $this->input->post('subkomponen_kode'),
			'judul' => ($pengirim_role == 'subkomponen' ? 'Balasan' : 'Komentar') . ' Evaluasi',
			'pesan' => 'Komentar pada: ' . $this->input->post('label_lokasi'),
			'url_target' => 'ev/index' # Akan diarahkan ke halaman evaluasi
		]);

		echo json_encode(['status' => 'success']);
	}


	public function get_komentar()
	{
		$indikator_id = $this->input->get('indikator_id');
		$subkomponen_id = $this->input->get('subkomponen_id');
		$komentar = $this->Komentar_model->get_thread($indikator_id, $subkomponen_id);
		echo json_encode($komentar);
	}


	public function excel()
	{

		date_default_timezone_set('Asia/Jakarta'); // Atur ke zona waktu yang sesuai

		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['evaluasi'] = $this->m_ev->get_data3($tahun, $id_unit);
		$data['evaluasi0'] = $this->m_ev->get_data30($tahun, $id_unit);
		$data['evaluasi00'] = $this->m_ev->get_data300($tahun, $id_unit);
		$data['evaluasi000'] = $this->m_ev->get_datasumkom($tahun, $id_unit);

		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();


		$object->getProperties()->setCreator("Aplikasi EvSAKIP");
		$object->getProperties()->setLastModifiedBy("Aplikasi EvSAKIP");
		$object->getProperties()->setTitle("Evaluasi SAKIP - EvSAKIP");

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
			$object->getActiveSheet()->setCellValue('K1', 'Catatan Evaluasi');
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

			foreach ($data['evaluasi'] as $ev) {
				$subkomponen = $ev['uraian_subkomponen'];
				$komponen = $ev['uraian_komponen'];

				// Periksa apakah komponen sudah ditampilkan sebelumnya
				if (!in_array($komponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_komponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $komponen);
					$object->getActiveSheet()->setCellValue('C' . $baris, $ev['bobot']);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Loop untuk menambahkan nilai dari data['evaluasi00']
					foreach ($data['evaluasi00'] as $ev00) {
						// Periksa apakah komponen dan subkomponen pada iterasi saat ini sesuai dengan data['evaluasi00']
						if ($ev00['uraian_komponen'] == $komponen && $ev00['uraian_subkomponen'] == $subkomponen) {
							$object->getActiveSheet()->setCellValue('H' . $baris, $ev00['nilaik']);
							$persentase00 = number_format(floatval($ev00['nilaikpersen']), 2, ",", "") . '%';
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
				foreach ($data['evaluasi0'] as $ev0) {
					$nilai = '';
					if ($ev0['jawaban0ev'] == "100") {
						$nilai = "AA";
					} elseif ($ev0['jawaban0ev'] == "90") {
						$nilai = "A";
					} elseif ($ev0['jawaban0ev'] == "80") {
						$nilai = "BB";
					} elseif ($ev0['jawaban0ev'] == "70") {
						$nilai = "B";
					} elseif ($ev0['jawaban0ev'] == "60") {
						$nilai = "CC";
					} elseif ($ev0['jawaban0ev'] == "50") {
						$nilai = "C";
					} elseif ($ev0['jawaban0ev'] == "30") {
						$nilai = "D";
					} elseif ($ev0['jawaban0ev'] == "0") {
						$nilai = "E";
					}
					if ($ev0['id_ev0'] == $ev['id_ev0']) {
						// Tambahkan kolom data lain sesuai dengan kebutuhan Anda
						$object->getActiveSheet()->setCellValue('C' . $baris, $ev0['bobot2']);
						$persentaseskor = number_format(floatval($ev0['skorpersen']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('D' . $baris, $persentaseskor);
						$skor = number_format(floatval($ev0['skor']), 2, ",", "");
						$object->getActiveSheet()->setCellValue('E' . $baris, $skor);
						$object->getActiveSheet()->setCellValue('F' . $baris, $ev0['jawabanantara']);
						$object->getActiveSheet()->setCellValue('G' . $baris, $nilai);
						$object->getActiveSheet()->setCellValue('H' . $baris, floatval($ev0['jawaban0ev']) * floatval($ev0['bobot2']) / 100);
						$persentase0 = number_format(floatval($ev0['jawaban0ev']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('I' . $baris, $persentase0);
						$object->getActiveSheet()->setCellValue('J' . $baris, '');
						$object->getActiveSheet()->setCellValue('K' . $baris, $ev0['catatan_ev0']);
						$object->getActiveSheet()->setCellValue('L' . $baris, $ev0['link_bukti0']);
						$object->getActiveSheet()->setCellValue('M' . $baris, $ev0['link_bukti03']);
						$object->getActiveSheet()->setCellValue('N' . $baris, $ev0['link_bukti02']);



						break;
					}
				}


				if (!in_array($subkomponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_subkomponen']);
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
				if ($ev['jawaban2'] == "1") {
					$opsi = "Ya";
				} elseif ($ev['jawaban2'] == "0") {
					$opsi = "Tidak";
				} elseif ($ev['jawaban2'] == "") {
					$opsi = "Y/T";
				}
				$jawaban2 = '';
				if ($ev['jawaban2'] == "1") {
					$jawaban2 = "100";
				} elseif ($ev['jawaban2'] == "0") {
					$jawaban2 = "0";
				} elseif ($ev['jawaban2'] == "") {
					$jawaban2 = "Belum Diisi";
				}
				$informasi_tambahan = $ev['ket_pengisian1'] . "\n" . $ev['ket_pengisian2'] . "\n" . $ev['ket_pengisian3'];
				$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_aspek']);
				$object->getActiveSheet()->setCellValue('B' . $baris, $ev['uraian_aspek']);
				$object->getActiveSheet()->setCellValue('C' . $baris, '');
				$object->getActiveSheet()->setCellValue('D' . $baris, $opsi);
				$object->getActiveSheet()->setCellValue('E' . $baris, $jawaban2);
				$object->getActiveSheet()->setCellValue('F' . $baris, '');
				$object->getActiveSheet()->setCellValue('G' . $baris, '');
				$object->getActiveSheet()->setCellValue('H' . $baris, '');
				$object->getActiveSheet()->setCellValue('I' . $baris, '');
				$object->getActiveSheet()->setCellValue('J' . $baris, $informasi_tambahan);
				$object->getActiveSheet()->setCellValue('K' . $baris, $ev['catatan_ev']);
				$object->getActiveSheet()->setCellValue('L' . $baris, $ev['link_bukti']);
				$object->getActiveSheet()->setCellValue('M' . $baris, $ev['link_bukti3']);
				$object->getActiveSheet()->setCellValue('N' . $baris, $ev['link_bukti2']);

				$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
				$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$object->getActiveSheet()->getStyle('B' . $baris)->getAlignment()->setWrapText(true);
				$object->getActiveSheet()->getStyle('J' . $baris)->getAlignment()->setWrapText(true);



				$baris++;
			}

			foreach ($data['evaluasi000'] as $ev000) {

				$predikat = '';
				$sumnilaik = floatval(str_replace(',', '.', $ev000['sumnilaik']));
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
				$object->getActiveSheet()->setCellValue('H' . $baris, $ev000['sumnilaik']);
				$persentase000 = number_format(floatval($ev000['sumnilaikpersen']), 2, ",", "") . '%';
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
			$object->getActiveSheet()->setCellValue('J1', 'Catatan Evaluasi');
			$object->getActiveSheet()->mergeCells('K1:M1');
			$object->getActiveSheet()->setCellValue('K1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('L1', 'Bukti Dukung');
			$object->getActiveSheet()->setCellValue('M1', 'Bukti Dukung');


			$object->getActiveSheet()->freezePane('A2');
			$sheet = $object->getActiveSheet();

			$rangeall = 'A2:M98';

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

			foreach ($data['evaluasi'] as $ev) {
				$subkomponen = $ev['uraian_subkomponen'];
				$komponen = $ev['uraian_komponen'];

				// Periksa apakah komponen sudah ditampilkan sebelumnya
				if (!in_array($komponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_komponen']);
					$object->getActiveSheet()->setCellValue('B' . $baris, $komponen);
					$object->getActiveSheet()->setCellValue('C' . $baris, $ev['bobot']);

					$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
					$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Loop untuk menambahkan nilai dari data['evaluasi00']
					foreach ($data['evaluasi00'] as $ev00) {
						// Periksa apakah komponen dan subkomponen pada iterasi saat ini sesuai dengan data['evaluasi00']
						if ($ev00['uraian_komponen'] == $komponen && $ev00['uraian_subkomponen'] == $subkomponen) {
							$object->getActiveSheet()->setCellValue('H' . $baris, $ev00['nilaik']);
							$persentase00 = number_format(floatval($ev00['nilaikpersen']), 2, ",", "") . '%';
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
				foreach ($data['evaluasi0'] as $ev0) {
					$nilai = '';
					if ($ev0['jawaban0ev'] == "100") {
						$nilai = "AA";
					} elseif ($ev0['jawaban0ev'] == "90") {
						$nilai = "A";
					} elseif ($ev0['jawaban0ev'] == "80") {
						$nilai = "BB";
					} elseif ($ev0['jawaban0ev'] == "70") {
						$nilai = "B";
					} elseif ($ev0['jawaban0ev'] == "60") {
						$nilai = "CC";
					} elseif ($ev0['jawaban0ev'] == "50") {
						$nilai = "C";
					} elseif ($ev0['jawaban0ev'] == "30") {
						$nilai = "D";
					} elseif ($ev0['jawaban0ev'] == "0") {
						$nilai = "E";
					}
					if ($ev0['id_ev0'] == $ev['id_ev0']) {
						// Tambahkan kolom data lain sesuai dengan kebutuhan Anda
						$object->getActiveSheet()->setCellValue('C' . $baris, $ev0['bobot2']);
						$persentaseskor = number_format(floatval($ev0['skorpersen']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('D' . $baris, $persentaseskor);
						$skor = number_format(floatval($ev0['skor']), 2, ",", "");
						$object->getActiveSheet()->setCellValue('E' . $baris, $skor);
						$object->getActiveSheet()->setCellValue('F' . $baris, $ev0['jawabanantara']);
						$object->getActiveSheet()->setCellValue('G' . $baris, $nilai);
						$object->getActiveSheet()->setCellValue('H' . $baris, floatval($ev0['jawaban0ev']) * floatval($ev0['bobot2']) / 100);
						$persentase0 = number_format(floatval($ev0['jawaban0ev']), 2, ",", "") . '%';
						$object->getActiveSheet()->setCellValue('I' . $baris, $persentase0);
						$object->getActiveSheet()->setCellValue('J' . $baris, $ev0['catatan_ev0']);
						$object->getActiveSheet()->setCellValue('K' . $baris, $ev0['link_bukti0']);
						$object->getActiveSheet()->setCellValue('L' . $baris, $ev0['link_bukti03']);
						$object->getActiveSheet()->setCellValue('M' . $baris, $ev0['link_bukti02']);



						break;
					}
				}


				if (!in_array($subkomponen, $alreadyDisplayed)) {
					$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_subkomponen']);
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
				if ($ev['jawaban2'] == "1") {
					$opsi = "Ya";
				} elseif ($ev['jawaban2'] == "0") {
					$opsi = "Tidak";
				} elseif ($ev['jawaban2'] == "") {
					$opsi = "Y/T";
				}
				$jawaban2 = '';
				if ($ev['jawaban2'] == "1") {
					$jawaban2 = "100";
				} elseif ($ev['jawaban2'] == "0") {
					$jawaban2 = "0";
				} elseif ($ev['jawaban2'] == "") {
					$jawaban2 = "Belum Diisi";
				}
				$object->getActiveSheet()->setCellValue('A' . $baris, $ev['kd_aspek']);
				$object->getActiveSheet()->setCellValue('B' . $baris, $ev['uraian_aspek']);
				$object->getActiveSheet()->setCellValue('C' . $baris, '');
				$object->getActiveSheet()->setCellValue('D' . $baris, $opsi);
				$object->getActiveSheet()->setCellValue('E' . $baris, $jawaban2);
				$object->getActiveSheet()->setCellValue('F' . $baris, '');
				$object->getActiveSheet()->setCellValue('G' . $baris, '');
				$object->getActiveSheet()->setCellValue('H' . $baris, '');
				$object->getActiveSheet()->setCellValue('I' . $baris, '');
				$object->getActiveSheet()->setCellValue('J' . $baris, $ev['catatan_ev']);
				$object->getActiveSheet()->setCellValue('K' . $baris, $ev['link_bukti']);
				$object->getActiveSheet()->setCellValue('L' . $baris, $ev['link_bukti3']);
				$object->getActiveSheet()->setCellValue('M' . $baris, $ev['link_bukti2']);

				$alignment = $object->getActiveSheet()->getStyle('A' . $baris)->getAlignment();
				$alignment->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$alignment->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

				$object->getActiveSheet()->getStyle('B' . $baris)->getAlignment()->setWrapText(true);



				$baris++;
			}

			foreach ($data['evaluasi000'] as $ev000) {

				$predikat = '';
				$sumnilaik = floatval(str_replace(',', '.', $ev000['sumnilaik']));
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
				$object->getActiveSheet()->setCellValue('H' . $baris, $ev000['sumnilaik']);
				$persentase000 = number_format(floatval($ev000['sumnilaikpersen']), 2, ",", "") . '%';
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


		$filename = "Data_Eva_SAKIP_" . $ev['kd_unit'] . "_" . $ev['tahun'] . "_" . date('His_dmY') . ".xlsx";

		$object->getActiveSheet()->setTitle("EVA_SAKIP_" . $ev['kd_unit'] . "_" . $ev['tahun'] . "");

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