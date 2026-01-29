<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Notifikasi_model $Notifikasi_model
 */
class Notification extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth2/login');
        }
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
