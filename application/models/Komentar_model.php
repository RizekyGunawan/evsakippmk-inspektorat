<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar_model extends CI_Model
{

    public function simpan($data)
    {
        $this->db->insert('komentar_evaluasi', $data);
        return $this->db->insert_id();
    }

    public function get_thread($indikator_id, $subkomponen_id = null)
    {
        $this->db->select('komentar_evaluasi.*, ta_user.nm_user as sender_name')
            ->from('komentar_evaluasi')
            ->join('ta_user', 'komentar_evaluasi.evaluator_id = ta_user.id_user', 'left');

        if ($indikator_id && $indikator_id != '0') {
            $this->db->where('indikator_id', $indikator_id);
        } elseif ($subkomponen_id) {
            $this->db->where('subkomponen_id', $subkomponen_id);
            $this->db->where('indikator_id', 0);
        }

        return $this->db->order_by('created_at', 'ASC')
            ->get()->result();
    }

    public function get_by_indikator($indikator_id)
    {
        return $this->get_thread($indikator_id);
    }
}
