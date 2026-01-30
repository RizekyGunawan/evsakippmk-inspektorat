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

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth2/index');
        }
    }

    public function index()
    {
        $data['user'] = $this->m_auth2->get_datauser();
        $user_id = $this->session->userdata('id_user');
        $data['notifications'] = $this->Notifikasi_model->get_all($user_id);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($user_id);

        $this->load->view('templates/header', $data);
        $this->load->view('v_notifications', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    public function mark_all_read()
    {
        $user_id = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_all_read($user_id);
        $this->session->set_flashdata('success', 'Semua notifikasi ditandai sebagai terbaca.');
        redirect('notification');
    }

    public function buka_notifikasi($id)
    {
        $notif = $this->db->where('id', $id)->get('notifikasi')->row();
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
}
