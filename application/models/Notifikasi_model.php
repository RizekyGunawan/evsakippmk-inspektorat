<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{

    public function create($data)
    {
        return $this->db->insert('notifikasi', $data);
    }

    public function get_unread($user_id)
    {
        return $this->db->select('notifikasi.*, k.isi_komentar, k.pengirim_role, u.nm_user as sender_name')
            ->from('notifikasi')
            ->join('komentar_evaluasi k', 'notifikasi.komentar_id = k.id', 'left')
            ->join('ta_user u', 'k.evaluator_id = u.id_user', 'left')
            ->where('notifikasi.user_id', $user_id)
            ->where('notifikasi.is_read', 0)
            ->order_by('notifikasi.created_at', 'DESC')
            ->get()->result();
    }

    public function count_unread($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_read', 0)
            ->count_all_results('notifikasi');
    }

    public function mark_read($id)
    {
        return $this->db->where('id', $id)
            ->update('notifikasi', ['is_read' => 1]);
    }
}
