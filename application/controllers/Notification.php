<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property M_auth2 $m_auth2
 * @property Notifikasi_model $Notifikasi_model
 */
class Notification extends CI_Controller
{
    // Jumlah notifikasi per halaman (pagination)
    const PER_PAGE = 15;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth2/index');
        }
    }

    /**
     * Halaman semua notifikasi (GET /notification)
     * — Jika request AJAX → return JSON (dipakai oleh dropdown polling)
     * — Jika request biasa → render halaman HTML dengan pagination
     */
    public function index()
    {
        $user_id = $this->session->userdata('id_user');

        // ── AJAX: kembalikan JSON untuk dropdown ──────────────────────────────
        if ($this->input->is_ajax_request()) {
            $notifications = $this->Notifikasi_model->get_notifications($user_id, true, 10);
            $unread_count = $this->Notifikasi_model->count_unread($user_id);

            $formatted = array_map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->judul,
                    'message' => strlen($n->pesan) > 70
                        ? substr($n->pesan, 0, 67) . '...'
                        : $n->pesan,
                    'is_read' => (int) $n->is_read,
                    'created_at' => $n->created_at,
                    'url' => base_url('notification/buka_notifikasi/' . $n->id),
                    'sender_name' => isset($n->sender_name) ? $n->sender_name : '',
                ];
            }, $notifications);

            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $formatted,
                'unread_count' => $unread_count,
            ]);
            return;
        }

        // ── HTML: halaman penuh dengan pagination ─────────────────────────────
        $this->load->library('pagination');

        $total = $this->Notifikasi_model->count_all($user_id);
        $page = (int) ($this->input->get('page') ?: 1);
        $offset = ($page - 1) * self::PER_PAGE;

        $config = [
            'base_url' => base_url('notification'),
            'total_rows' => $total,
            'per_page' => self::PER_PAGE,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page',

            // Bungkus seluruh pagination
            'full_tag_open' => '<ul class="pagination pagination-sm mb-0">',
            'full_tag_close' => '</ul>',

            // Tombol prev & next — hanya bungkus <li>, CI3 otomatis buat <a>
            'prev_link' => '&laquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'next_link' => '&raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            // Nomor halaman biasa
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            // Halaman aktif (buat sendiri karena CI3 tidak generate href untuk ini)
            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',

            // Class untuk tag <a> yang digenerate otomatis oleh CI3
            'attributes' => ['class' => 'page-link'],
        ];
        $this->pagination->initialize($config);

        $data['user'] = $this->m_auth2->get_datauser();
        $data['notifications'] = $this->Notifikasi_model->get_notifications($user_id, false, self::PER_PAGE, $offset);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($user_id);
        $data['total'] = $total;
        $data['pagination'] = $this->pagination->create_links();
        $data['current_page'] = $page;
        $data['per_page'] = self::PER_PAGE;

        $this->load->view('templates/header', $data);
        $this->load->view('v_notifications', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    /**
     * Tandai semua notifikasi sebagai terbaca (GET /notification/mark_all_read)
     * Masih support non-AJAX (tombol di halaman notifikasi)
     */
    public function mark_all_read()
    {
        $user_id = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_all_read($user_id);

        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'unread_count' => 0]);
            return;
        }

        $this->session->set_flashdata('success', 'Semua notifikasi ditandai sebagai terbaca.');
        redirect('notification');
    }

    /**
     * Buka notifikasi → mark read → redirect ke halaman tujuan
     * GET /notification/buka_notifikasi/{id}
     * [FIX] Tambah verifikasi kepemilikan (user_id)
     */
    public function buka_notifikasi($id)
    {
        $user_id = $this->session->userdata('id_user');

        // [FIX] Pastikan notifikasi ini milik user yang sedang login
        $notif = $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->get('notifikasi')
            ->row();

        if ($notif) {
            $this->Notifikasi_model->mark_read($id);
            $redirect_url = $notif->url_target;
            if ($notif->subkomponen_id || $notif->indikator_id) {
                $redirect_url .= '?' . http_build_query([
                    'subkomponen' => $notif->subkomponen_id,
                    'kode' => $notif->subkomponen_kode,
                    'indikator' => $notif->indikator_id,
                    'comment_id' => $notif->komentar_id,
                    'focus' => 'indikator'
                ]);
            }
            redirect($redirect_url);
        } else {
            redirect('dashboard');
        }
    }

    /**
     * Tandai satu atau semua notifikasi sebagai terbaca — AJAX only
     * POST /notification/markAsRead/{id?}
     * — Jika $id diberikan  → mark 1 notifikasi
     * — Jika $id tidak ada  → mark semua notifikasi milik user ini
     */
    public function markAsRead($id = null)
    {
        $user_id = $this->session->userdata('id_user');

        if ($id) {
            // Verifikasi kepemilikan sebelum mark read
            $notif = $this->db
                ->where('id', $id)
                ->where('user_id', $user_id)
                ->get('notifikasi')
                ->row();
            if ($notif) {
                $this->Notifikasi_model->mark_read($id);
            }
        } else {
            $this->Notifikasi_model->mark_all_read($user_id);
        }

        $unread_count = $this->Notifikasi_model->count_unread($user_id);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'unread_count' => $unread_count]);
    }

    /**
     * Kembalikan jumlah notifikasi belum terbaca — AJAX only
     * GET /notification/unreadCount
     */
    public function unreadCount()
    {
        $user_id = $this->session->userdata('id_user');
        $count = $this->Notifikasi_model->count_unread($user_id);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'count' => $count]);
    }

    /**
     * Hapus satu notifikasi milik user yang sedang login
     * POST /notification/delete/{id}
     */
    public function delete($id)
    {
        $user_id = $this->session->userdata('id_user');

        $deleted = $this->Notifikasi_model->delete($id, $user_id);

        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => $deleted ? 'success' : 'error',
                'unread_count' => $this->Notifikasi_model->count_unread($user_id),
            ]);
            return;
        }

        if ($deleted) {
            $this->session->set_flashdata('success', 'Notifikasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Notifikasi tidak ditemukan.');
        }
        redirect('notification');
    }
}
