<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller — Base controller untuk semua controller aplikasi.
 * Menyediakan auth guard terpusat dan konstanta role.
 */
class MY_Controller extends CI_Controller
{
    // Konstanta role baru (9-14)
    const ROLE_ADMIN = 9;
    const ROLE_KETUA_TIM = 10;
    const ROLE_PENGENDALI_TEKNIS = 11;
    const ROLE_PENGENDALI_MUTU = 12;
    const ROLE_TIM_EVALUATOR = 13;
    const ROLE_UNIT_KERJA = 14;

    // Grup role untuk kemudahan cek
    const ROLES_SUPERVISOR = [10, 11, 12]; // Ketua Tim, P.Teknis, P.Mutu
    const ROLES_EVALUATOR = [13];
    const ROLES_UK = [14];
    const ROLES_ADMIN = [9];
    // Semua role baru
    const ROLES_ALL_NEW = [9, 10, 11, 12, 13, 14];
    // Role lama yang masih aktif
    const ROLES_ALL_OLD = [1, 2, 3, 4, 5, 6, 7];
    // Semua role gabungan
    const ROLES_ALL = [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14];

    // ─── Permission Groups per Modul ────────────────────────────────────────
    // Memusatkan definisi akses sehingga perubahan role cukup di satu tempat.

    // Siapa yang boleh MELIHAT halaman Evaluasi Inspektorat (/ev)
    const ROLES_CAN_VIEW_EV = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14];

    // Siapa yang boleh MENGEDIT data di /ev (Role 14 = hanya baca)
    const ROLES_CAN_EDIT_EV = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12, 13];

    // Siapa yang boleh akses /rekomendasi
    const ROLES_CAN_REKOMENDASI = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12, 14];

    // Siapa yang boleh akses /tl (tindak lanjut)
    const ROLES_CAN_TL = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12, 14];

    // Siapa yang boleh akses /dokumen
    const ROLES_CAN_DOKUMEN = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14];

    // Siapa yang menggunakan tampilan v_dokumen (penuh, bisa input)
    const ROLES_DOKUMEN_FULL = [1, 4, 5, 13, 14];

    // Siapa yang menggunakan tampilan v_dokumen2 (monitoring/read)
    const ROLES_DOKUMEN_READ = [2, 3, 6, 7, 10, 11, 12];
    // ────────────────────────────────────────────────────────────────────────

    public function __construct()
    {
        parent::__construct();

        // Auth guard terpusat — redirect ke login jika belum login
        if ($this->session->userdata('id_role') == null) {
            redirect('auth2/index');
        }
    }

    /**
     * Cek apakah role saat ini ada dalam daftar role yang diizinkan.
     * Tampilkan 404 jika tidak diizinkan.
     *
     * @param array $allowed_roles
     */
    protected function _check_role(array $allowed_roles)
    {
        $id_role = (int) $this->session->userdata('id_role');
        if (!in_array($id_role, $allowed_roles)) {
            show_404();
            exit;
        }
    }

    /**
     * Cek apakah user saat ini termasuk role supervisor (10, 11, 12).
     */
    protected function _is_supervisor(): bool
    {
        return in_array((int) $this->session->userdata('id_role'), self::ROLES_SUPERVISOR);
    }

    /**
     * Cek apakah user saat ini adalah Tim Evaluator (13).
     */
    protected function _is_evaluator_baru(): bool
    {
        return (int) $this->session->userdata('id_role') === self::ROLE_TIM_EVALUATOR;
    }

    /**
     * Cek apakah user saat ini adalah Unit Kerja baru (14).
     */
    protected function _is_uk_baru(): bool
    {
        return (int) $this->session->userdata('id_role') === self::ROLE_UNIT_KERJA;
    }

    /**
     * Cek apakah user saat ini adalah Admin baru (9).
     */
    protected function _is_admin_baru(): bool
    {
        return (int) $this->session->userdata('id_role') === self::ROLE_ADMIN;
    }
}
