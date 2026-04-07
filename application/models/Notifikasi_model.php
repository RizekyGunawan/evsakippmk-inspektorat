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
        $result = $this->db->select('notifikasi.*, k.isi_komentar, k.pengirim_role, u.nm_user, u.username, r.nm_unit')
            ->from('notifikasi')
            ->join('komentar_evaluasi k', 'notifikasi.komentar_id = k.id', 'left')
            ->join('ta_user u', 'k.evaluator_id = u.id_user', 'left')
            ->join('ref_unit r', 'u.id_unit = r.id_unit', 'left')
            ->where('notifikasi.user_id', $user_id)
            ->where('notifikasi.is_read', 0)
            ->order_by('notifikasi.created_at', 'DESC')
            ->get()->result();

        foreach ($result as &$row) {
            if ($row->pengirim_role == 'subkomponen') {
                $row->sender_name = !empty($row->nm_unit) ? $row->nm_unit : $row->nm_user;
            } else {
                // Untuk evaluator, tambahkan username agar tidak general 'Tim Evaluator'
                $row->sender_name = $row->nm_user . (!empty($row->username) ? ' (' . $row->username . ')' : '');
            }
        }
        return $result;
    }

    public function count_unread($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->where('is_read', 0)
            ->count_all_results('notifikasi');
    }

    public function get_all($user_id)
    {
        $result = $this->db->select('notifikasi.*, k.isi_komentar, k.pengirim_role, u.nm_user, u.username, r.nm_unit')
            ->from('notifikasi')
            ->join('komentar_evaluasi k', 'notifikasi.komentar_id = k.id', 'left')
            ->join('ta_user u', 'k.evaluator_id = u.id_user', 'left')
            ->join('ref_unit r', 'u.id_unit = r.id_unit', 'left')
            ->where('notifikasi.user_id', $user_id)
            ->order_by('notifikasi.created_at', 'DESC')
            ->get()->result();

        foreach ($result as &$row) {
            if ($row->pengirim_role == 'subkomponen') {
                $row->sender_name = !empty($row->nm_unit) ? $row->nm_unit : $row->nm_user;
            } else {
                $row->sender_name = $row->nm_user . (!empty($row->username) ? ' (' . $row->username . ')' : '');
            }
        }
        return $result;
    }

    public function mark_read($id)
    {
        return $this->db->where('id', $id)
            ->update('notifikasi', ['is_read' => 1]);
    }

    public function mark_all_read($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->update('notifikasi', ['is_read' => 1]);
    }
}
