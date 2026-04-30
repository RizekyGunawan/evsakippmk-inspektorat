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
		$tahun = (int) $this->session->userdata('tahun');  // cast lebih awal
		$id_ev = $this->session->userdata('id_ev');
		$id_ev0 = $this->session->userdata('id_ev0');

		// Deklarasikan id_role dan id_user lebih awal
		// agar tersedia saat filtering dan get_assigned_units()
		$id_role = (int) $this->session->userdata('id_role');
		$id_user = (int) $this->session->userdata('id_user');

		// Auto-generate form evaluasi menggunakan idempotent insert
		if (!empty($tahun) && !empty($id_unit)) {
			// By-pass dependency: Automatically initialize Unit Kerja's PM records if they haven't opened it, 
			// so Evaluators can immediately assess without waiting for PM module finalization.
			$this->load->model('m_pm');
			$this->m_pm->insert_pm($tahun, $id_unit);
			$this->m_ev->insert_ev($tahun, $id_unit);
		}

		$data['evaluasi'] = $this->m_ev->get_data3($tahun, $id_unit);
		$data['evaluasi0'] = $this->m_ev->get_data30($tahun, $id_unit);
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
		// Ambil data rekapitulasi dari model
		$rekap_units_raw = $this->m_ev->get_rekap_all_units($tahun);

		// Filter unit kerja yang disembunyikan
		$hidden_units = ['deputi 6', 'set. djsn', 'simulasi'];
		$data['rekap_units'] = array_filter($rekap_units_raw, function ($u) use ($hidden_units) {
			$nm = strtolower(trim($u['nm_unit']));
			foreach ($hidden_units as $h) {
				if (strpos($nm, $h) !== false) {
					return false; // Hide this unit
				}
			}
			return true; // Keep this unit
		});

		$data['rekap_detail'] = $this->m_ev->get_rekap_detail_all_units($tahun);

		// Load view dengan template
		$this->load->view('templates/header', $data);
		$this->load->view('v_ev_rekap_unit', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);
	}


	/**
	 * Export Excel — Rekapitulasi Unit Kerja
	 * Menghasilkan file .xlsx yang mereplikasi tabel rekapitulasi lintas unit kerja.
	 * Struktur: Header judul → Header kolom → Komponen (biru) → Sub-Komponen (peach)
	 *           → Aspek/Kriteria (putih) → Total Akumulasi (abu-abu) → Predikat (hitam)
	 * Hak akses sama dengan rekap_unit().
	 */
	public function excel_rekap_unit()
	{
		date_default_timezone_set('Asia/Jakarta');
		ini_set('memory_limit', '256M');

		// --- Guard: hak akses sama dengan rekap_unit() ---
		$id_role = (int) $this->session->userdata('id_role');
		$roles_rekap = [2, 3, 4, 5, 6, 7, 10, 11, 12, 13];
		if (!in_array($id_role, $roles_rekap)) {
			show_404();
			return;
		}

		$this->load->model('m_ev');
		$tahun = (int) $this->session->userdata('tahun');
		$rekap_units_raw = $this->m_ev->get_rekap_all_units($tahun);

		// Filter unit kerja yang disembunyikan
		$hidden_units = ['deputi 6', 'set. djsn', 'simulasi'];
		$rekap_units = array_filter($rekap_units_raw, function ($u) use ($hidden_units) {
			$nm = strtolower(trim($u['nm_unit']));
			foreach ($hidden_units as $h) {
				if (strpos($nm, $h) !== false) {
					return false; // Hide this unit
				}
			}
			return true; // Keep this unit
		});

		$rekap_detail = $this->m_ev->get_rekap_detail_all_units($tahun);

		// ----------------------------------------------------------------
		// Bangun struktur data (sama dengan logika di v_ev_rekap_unit.php)
		// ----------------------------------------------------------------
		$units = [];   // [id_unit => nm_unit]
		$unit_totals = [];   // [id_unit => total_nilai]
		$unit_predicates = [];  // [id_unit => predikat]
		$structure = [];   // hierarki komponen → sub → aspek

		if (is_array($rekap_units)) {
			foreach ($rekap_units as $unit) {
				$units[$unit['id_unit']] = $unit['nm_unit'];
				$total = isset($unit['total_nilai']) ? floatval($unit['total_nilai']) : 0;
				$unit_totals[$unit['id_unit']] = $total;

				if ($total > 90)
					$predikat = 'AA';
				elseif ($total > 80)
					$predikat = 'A';
				elseif ($total > 70)
					$predikat = 'BB';
				elseif ($total > 60)
					$predikat = 'B';
				elseif ($total > 50)
					$predikat = 'CC';
				elseif ($total > 30)
					$predikat = 'C';
				elseif ($total > 0)
					$predikat = 'D';
				else
					$predikat = 'E';
				$unit_predicates[$unit['id_unit']] = $predikat;
			}
		}

		if (is_array($rekap_detail)) {
			foreach ($rekap_detail as $row) {
				$kid = $row['id_komponen'];
				$sid = $row['id_subkomponen'];
				$aid = $row['id_aspek'];
				$uid = $row['id_unit'];

				if (!isset($structure[$kid])) {
					$structure[$kid] = [
						'uraian' => $row['uraian_komponen'],
						'bobot' => $row['bobot_komponen'],
						'subs' => [],
						'scores' => [],
					];
				}
				if (!isset($structure[$kid]['subs'][$sid])) {
					$structure[$kid]['subs'][$sid] = [
						'uraian' => $row['uraian_subkomponen'],
						'bobot' => $row['bobot_subkomponen'],
						'aspeks' => [],
						'scores' => [],
					];
				}
				// Cegah overwrite dari duplicate rows yang bernilai kosong/0 jika nilai sebelumnya sudah terisi (valid)
				if (!isset($structure[$kid]['subs'][$sid]['scores'][$uid]) || (isset($row['nilai_subkomp']) && $row['nilai_subkomp'] !== '' && $row['nilai_subkomp'] !== null && floatval($row['nilai_subkomp']) > 0)) {
					$structure[$kid]['subs'][$sid]['scores'][$uid] = $row['nilai_subkomp'];
				}

				if (!isset($structure[$kid]['subs'][$sid]['aspeks'][$aid])) {
					$structure[$kid]['subs'][$sid]['aspeks'][$aid] = [
						'uraian' => $row['uraian_aspek'],
						'answers' => [],
					];
				}

				// Proteksi yang sama untuk data aspek/kriteria
				if (!isset($structure[$kid]['subs'][$sid]['aspeks'][$aid]['answers'][$uid]) || (isset($row['jawaban2']) && $row['jawaban2'] !== '' && $row['jawaban2'] !== null)) {
					$structure[$kid]['subs'][$sid]['aspeks'][$aid]['answers'][$uid] = $row['jawaban2'];
				}
			}
		}

		// Masukkan nilai per komponen dari $rekap_units ke $structure
		if (is_array($rekap_units)) {
			foreach ($rekap_units as $unit) {
				if (isset($structure[1]))
					$structure[1]['scores'][$unit['id_unit']] = $unit['komp1'];
				if (isset($structure[2]))
					$structure[2]['scores'][$unit['id_unit']] = $unit['komp2'];
				if (isset($structure[3]))
					$structure[3]['scores'][$unit['id_unit']] = $unit['komp3'];
				if (isset($structure[4]))
					$structure[4]['scores'][$unit['id_unit']] = $unit['komp4'];
			}
		}

		// ----------------------------------------------------------------
		// PHPExcel
		// ----------------------------------------------------------------
		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()
			->setCreator('Aplikasi EvSAKIP — Inspektorat')
			->setLastModifiedBy('Aplikasi EvSAKIP — Inspektorat')
			->setTitle('Rekapitulasi Unit Kerja EV SAKIP ' . $tahun)
			->setSubject('Nilai Gabungan Evaluasi SAKIP Seluruh Unit Kerja')
			->setDescription('Diekspor dari Aplikasi EvSAKIP pada ' . date('d-m-Y H:i'));

		$sheet = $objPHPExcel->setActiveSheetIndex(0);
		$sheet->setTitle('Rekap Unit Kerja');

		// ----------------------------------------------------------------
		// Hitung total kolom agar bisa membuat range dinamis
		// col A=0, B=1, C=2, D=3 ... D+N_unit-1
		// ----------------------------------------------------------------
		$col_bobot = 2;   // C  — Bobot
		$col_unit_start = 3;   // D  — Kolom pertama unit
		$total_units = count($units);
		$col_unit_last = $col_unit_start + $total_units - 1;  // indeks kolom unit terakhir
		$last_col_letter = PHPExcel_Cell::stringFromColumnIndex($col_unit_last);
		$full_range = 'A1:' . $last_col_letter;   // dipakai untuk range keseluruhan

		// ----------------------------------------------------------------
		// WARNA TEMA
		// ----------------------------------------------------------------
		$C_HEADER = '1F4E78';  // Biru tua — header
		$C_COMP = '87CEEB';  // Biru langit — Komponen
		$C_SUB = 'FFE4C4';  // Peach — Sub-Komponen
		$C_TOTAL = '6C757D';  // Abu-abu — Total Akumulasi
		$C_PRED = '343A40';  // Hitam — Predikat
		$C_WHITE = 'FFFFFF';
		$C_BLACK = '000000';

		// ----------------------------------------------------------------
		// BARIS 1 — Judul Utama (merge seluruh kolom)
		// ----------------------------------------------------------------
		$judul_text = 'REKAPITULASI NILAI GABUNGAN EVALUASI SAKIP SELURUH UNIT KERJA — TAHUN ' . $tahun;
		$sheet->mergeCells('A1:' . $last_col_letter . '1');
		$sheet->setCellValue('A1', $judul_text);
		$style_judul = $sheet->getStyle('A1');
		$style_judul->getFont()->setBold(true)->setSize(12)
			->setColor(new PHPExcel_Style_Color($C_WHITE));
		$style_judul->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setRGB($C_HEADER);
		$style_judul->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
			->setWrapText(true);
		$sheet->getRowDimension(1)->setRowHeight(30);

		// ----------------------------------------------------------------
		// BARIS 2 — Header Kolom
		// ----------------------------------------------------------------
		$sheet->setCellValue('A2', 'No');
		$sheet->setCellValue('B2', 'Komponen / Sub-Komponen / Indikator');
		$sheet->setCellValue('C2', 'Bobot');

		$col_idx = $col_unit_start;
		foreach ($units as $uid => $nm_unit) {
			$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
			$sheet->setCellValue($col . '2', $nm_unit);
			$sheet->getColumnDimension($col)->setWidth(16);
		}

		$header_range = 'A2:' . $last_col_letter . '2';
		$style_header = $sheet->getStyle($header_range);
		$style_header->getFont()->setBold(true)->setColor(new PHPExcel_Style_Color($C_WHITE));
		$style_header->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setRGB($C_HEADER);
		$style_header->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
			->setWrapText(true);
		$sheet->getRowDimension(2)->setRowHeight(40);

		// Lebar kolom tetap
		$sheet->getColumnDimension('A')->setWidth(8);
		$sheet->getColumnDimension('B')->setWidth(45);
		$sheet->getColumnDimension('C')->setWidth(10);

		// ----------------------------------------------------------------
		// BARIS DATA — Iterasi hierarki
		// ----------------------------------------------------------------
		$baris = 3;
		$no_comp = 1;

		foreach ($structure as $comp_id => $comp) {

			// --- Baris Komponen (biru) ---
			$row_range = 'A' . $baris . ':' . $last_col_letter . $baris;
			$sheet->setCellValue('A' . $baris, $no_comp);
			$sheet->setCellValue('B' . $baris, strtoupper($comp['uraian']));
			$sheet->setCellValue('C' . $baris, number_format(floatval($comp['bobot']), 2));

			$col_idx = $col_unit_start;
			foreach ($units as $uid => $nm) {
				$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
				$score = isset($comp['scores'][$uid]) ? floatval($comp['scores'][$uid]) : 0;
				$sheet->setCellValue($col . $baris, number_format($score, 2));
				$sheet->getStyle($col . $baris)->getAlignment()
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}

			$style_comp = $sheet->getStyle($row_range);
			$style_comp->getFont()->setBold(true)->setColor(new PHPExcel_Style_Color($C_BLACK));
			$style_comp->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
				->getStartColor()->setRGB($C_COMP);
			$sheet->getStyle('A' . $baris)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('C' . $baris)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$no_comp++;
			$baris++;

			// --- Iterasi Sub-Komponen (peach) ---
			$char_sub = 'a';
			foreach ($comp['subs'] as $sub_id => $sub) {

				$row_range = 'A' . $baris . ':' . $last_col_letter . $baris;
				$no_sub = ($no_comp - 1) . '.' . $char_sub;
				$sheet->setCellValue('A' . $baris, $no_sub);
				$sheet->setCellValue('B' . $baris, $sub['uraian']);
				$sheet->setCellValue('C' . $baris, number_format(floatval($sub['bobot']), 2));

				$col_idx = $col_unit_start;
				foreach ($units as $uid => $nm) {
					$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
					$score = isset($sub['scores'][$uid]) ? floatval($sub['scores'][$uid]) : 0;
					$sheet->setCellValue($col . $baris, number_format($score, 2));
					$sheet->getStyle($col . $baris)->getAlignment()
						->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}

				$style_sub = $sheet->getStyle($row_range);
				$style_sub->getFont()->setBold(true)->setColor(new PHPExcel_Style_Color($C_BLACK));
				$style_sub->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()->setRGB($C_SUB);
				$sheet->getStyle('A' . $baris)->getAlignment()
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$sheet->getStyle('C' . $baris)->getAlignment()
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$char_sub++;
				$baris++;

				// --- Iterasi Aspek/Kriteria (putih) ---
				$no_asp = 1;
				$jml_kriteria = count($sub['aspeks']);
				$bobot_sub_val = isset($sub['bobot']) ? floatval($sub['bobot']) : 0;
				$bobot_kriteria = ($jml_kriteria > 0) ? ($bobot_sub_val / $jml_kriteria) : 0;

				foreach ($sub['aspeks'] as $asp_id => $asp) {

					$row_range = 'A' . $baris . ':' . $last_col_letter . $baris;
					$sheet->setCellValue('A' . $baris, $no_asp);
					$sheet->setCellValue('B' . $baris, $asp['uraian']);
					$sheet->setCellValue('C' . $baris, ($bobot_kriteria > 0) ? number_format($bobot_kriteria, 2) : '-');

					$col_idx = $col_unit_start;
					foreach ($units as $uid => $nm) {
						$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
						$val = isset($asp['answers'][$uid]) && $asp['answers'][$uid] !== '' ? floatval($asp['answers'][$uid]) : '';
						if ($val !== '') {
							$score_proporsional = ($val / 100) * $bobot_kriteria;
							$display = number_format($score_proporsional, 2);
						} else {
							$display = '-';
						}
						$sheet->setCellValue($col . $baris, $display);
						$sheet->getStyle($col . $baris)->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}

					$sheet->getStyle($row_range)->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
						->getStartColor()->setRGB($C_WHITE);
					$sheet->getStyle($row_range)->getFont()
						->setColor(new PHPExcel_Style_Color($C_BLACK));
					$sheet->getStyle('A' . $baris)->getAlignment()
						->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$sheet->getStyle('C' . $baris)->getAlignment()
						->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					$no_asp++;
					$baris++;
				}
			}
		}

		// ----------------------------------------------------------------
		// BARIS TOTAL AKUMULASI (abu-abu gelap)
		// ----------------------------------------------------------------
		$row_range = 'A' . $baris . ':' . $last_col_letter . $baris;
		$sheet->mergeCells('A' . $baris . ':B' . $baris);
		$sheet->setCellValue('A' . $baris, 'TOTAL AKUMULASI NILAI');
		$sheet->setCellValue('C' . $baris, '100.00');

		$col_idx = $col_unit_start;
		foreach ($units as $uid => $nm) {
			$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
			$total = isset($unit_totals[$uid]) ? floatval($unit_totals[$uid]) : 0;
			$sheet->setCellValue($col . $baris, number_format($total, 2));
			$sheet->getStyle($col . $baris)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		}

		$style_total = $sheet->getStyle($row_range);
		$style_total->getFont()->setBold(true)->setColor(new PHPExcel_Style_Color($C_WHITE));
		$style_total->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setRGB($C_TOTAL);
		$style_total->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$baris++;

		// ----------------------------------------------------------------
		// BARIS PREDIKAT (hitam)
		// ----------------------------------------------------------------
		$row_range = 'A' . $baris . ':' . $last_col_letter . $baris;
		$sheet->mergeCells('A' . $baris . ':C' . $baris);
		$sheet->setCellValue('A' . $baris, 'NILAI / PREDIKAT');

		$col_idx = $col_unit_start;
		foreach ($units as $uid => $nm) {
			$col = PHPExcel_Cell::stringFromColumnIndex($col_idx++);
			$pred = isset($unit_predicates[$uid]) ? $unit_predicates[$uid] : 'E';
			$sheet->setCellValue($col . $baris, $pred);
			$sheet->getStyle($col . $baris)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		}

		$style_pred = $sheet->getStyle($row_range);
		$style_pred->getFont()->setBold(true)->setColor(new PHPExcel_Style_Color($C_WHITE));
		$style_pred->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setRGB($C_PRED);
		$style_pred->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		// ----------------------------------------------------------------
		// Border keseluruhan tabel
		// ----------------------------------------------------------------
		$last_data_row = $baris;
		$table_range = 'A1:' . $last_col_letter . $last_data_row;
		$sheet->getStyle($table_range)->applyFromArray([
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
				],
			],
		]);

		// Wrap text kolom B (uraian)
		$sheet->getStyle('B3:B' . $last_data_row)->getAlignment()
			->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		// Freeze baris header + 3 kolom pertama
		$sheet->freezePane('D3');

		// ----------------------------------------------------------------
		// Nama file yang deskriptif
		// ----------------------------------------------------------------
		$tgl_ekspor = date('d-m-Y');
		$nama_file = 'Rekapitulasi_Unit_Kerja_EV_SAKIP_' . $tahun . '_' . $tgl_ekspor . '.xlsx';

		// ----------------------------------------------------------------
		// Output ke browser
		// ----------------------------------------------------------------
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $nama_file . '"');
		header('Cache-Control: max-age=0');

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('php://output');
		exit;
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


	/**
	 * Reset Data Evaluasi Inspektorat
	 * Menghapus ta_ev, ta_ev0, ta_dok_ev untuk unit & tahun terpilih.
	 * Hanya dapat diakses oleh Admin (role 9).
	 */
	public function reset_data_ev()
	{
		$id_unit = $this->input->post('id_unit');
		$tahun = $this->input->post('tahun');
		$role = (int) $this->session->userdata('id_role');

		if ($role === 9 && !empty($id_unit) && !empty($tahun)) {
			$this->load->model('m_ev');
			$this->db->delete('ta_ev', ['id_unit' => $id_unit, 'tahun' => $tahun]);
			$this->db->delete('ta_ev0', ['id_unit' => $id_unit, 'tahun' => $tahun]);
			$this->db->delete('ta_dok_ev', ['id_unit' => $id_unit, 'tahun' => $tahun]);

			$this->session->set_flashdata('success', 'Data Evaluasi Inspektorat unit terpilih tahun ' . $tahun . ' berhasil direset secara bersih.');
		} else {
			$this->session->set_flashdata('error', 'Anda tidak memiliki otoritas, atau form tidak lengkap.');
		}

		redirect('/users/index');
	}


	public function update_data()
	{
		$id_role_check = (int) $this->session->userdata('id_role');
		if (!in_array($id_role_check, self::ROLES_CAN_EDIT_EV)) {
			show_error('Akses Ditolak: Anda tidak memiliki izin untuk mengedit Evaluasi Inspektorat.', 403);
			return;
		}

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
		$id_role_check = (int) $this->session->userdata('id_role');
		if (!in_array($id_role_check, self::ROLES_CAN_EDIT_EV)) {
			show_error('Akses Ditolak: Anda tidak memiliki izin untuk mengedit Evaluasi Inspektorat.', 403);
			return;
		}

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
			'id_unit' => $this->input->post('id_unit_lke') ? $this->input->post('id_unit_lke') : $this->session->userdata('id_unit'),
			'tahun' => $this->session->userdata('tahun'),
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

		$pengirim_nama = $this->session->userdata('nm_unit') ?: $this->session->userdata('username');
		$judul = ($pengirim_role == 'subkomponen' ? 'Balasan' : 'Komentar') . ' Evaluasi dari ' . $pengirim_nama;
		$pesan = 'Komentar pada: ' . $this->input->post('label_lokasi');

		$target_users = [];
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');

		// 1. Dapatkan semua ID User yang pernah nimbrung di percakapan (Thread) tersebut
		$indikator_id_val = $this->input->post('indikator');
		$subkomponen_id_val = $this->input->post('subkomponen');
		$thread_participants = $this->Komentar_model->get_thread($indikator_id_val, $subkomponen_id_val);
		foreach ($thread_participants as $t) {
			if (!empty($t->evaluator_id)) {
				$target_users[] = $t->evaluator_id;
			}
		}

		// 2. Jika pengirim membalas, kirimkan juga default ke pihak seberang (agar percakapan pertama dinotif)
		if ($pengirim_role == 'subkomponen') {
			$non_tim_ev = $this->db
				->select('id_user')
				->where_in('id_role', [2, 3, 4, 6, 7, 10, 11, 12])
				->get('ta_user')
				->result();
			foreach ($non_tim_ev as $u) {
				$target_users[] = $u->id_user;
			}

			$tim_ev = $this->db
				->select('ta_user.id_user')
				->from('ta_user')
				->join('ta_evaluator_unit teu', 'ta_user.id_user = teu.id_user')
				->where('ta_user.id_role', 13)
				->where('teu.id_unit', $id_unit)
				->where('teu.tahun', $tahun)
				->get()
				->result();
			foreach ($tim_ev as $u) {
				$target_users[] = $u->id_user;
			}
		} else {
			$units = $this->db
				->select('id_user')
				->where('id_unit', $id_unit)
				->where_in('id_role', [1, 5, 14])
				->get('ta_user')
				->result();
			foreach ($units as $u) {
				$target_users[] = $u->id_user;
			}
		}

		// 3. TARGET USER ASLI HARUS DIHUKUM MASUK KOTAK NOTIFIKASI SECARA ABSOLUT
		$target_user_input = $this->input->post('target_user');
		if (!empty($target_user_input)) {
			$target_users[] = $target_user_input;
		}

		// 4. Pastikan pengikut tidak mendapat notifikasi mengenai komentarnya sendiri
		$current_uid = $this->session->userdata('id_user');
		$final_targets = array_unique($target_users);
		$final_targets = array_diff($final_targets, [$current_uid]);

		foreach ($final_targets as $uid) {
			if ($uid) {
				$this->Notifikasi_model->create([
					'user_id' => $uid,
					'komentar_id' => $komentar_id,
					'indikator_id' => $this->input->post('indikator'),
					'subkomponen_id' => $this->input->post('subkomponen'),
					'subkomponen_kode' => $this->input->post('subkomponen_kode'),
					'judul' => $judul,
					'pesan' => $pesan,
					'url_target' => 'ev/index'
				]);
			}
		}

		echo json_encode(['status' => 'success']);
	}


	public function get_komentar()
	{
		$indikator_id = $this->input->get('indikator_id');
		$subkomponen_id = $this->input->get('subkomponen_id');
		$id_unit_lke = $this->input->get('id_unit_lke'); // Tangkap parameter dari LKE yang sedang dilihat
		$komentar = $this->Komentar_model->get_thread($indikator_id, $subkomponen_id, $id_unit_lke);
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