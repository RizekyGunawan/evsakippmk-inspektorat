<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar_model extends CI_Model
{

    public function simpan($data)
    {
        $this->db->insert('komentar_evaluasi', $data);
        return $this->db->insert_id();
    }

    public function get_thread($indikator_id, $subkomponen_id = null, $id_unit_param = null)
    {
        // 1. Ambil id_unit dari parameter. Jika tidak ada, baru fallback ke session.
        $id_unit = $id_unit_param ? $id_unit_param : $this->session->userdata('id_unit');
        $tahun = $this->session->userdata('tahun');

        // 2. Modifikasi SELECT untuk meracik nama user dengan nama unitnya (khusus untuk role Unit)
        $this->db->select('komentar_evaluasi.*, IF(ta_user.id_role IN (1,5,14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name', FALSE)
            ->from('komentar_evaluasi')
            ->join('ta_user', 'komentar_evaluasi.evaluator_id = ta_user.id_user', 'left')
            ->join('ta_unit', 'ta_user.id_unit = ta_unit.id_unit', 'left');

        if ($indikator_id && $indikator_id != '0') {
            $this->db->where('komentar_evaluasi.indikator_id', $indikator_id);
        } elseif ($subkomponen_id) {
            $this->db->where('komentar_evaluasi.subkomponen_id', $subkomponen_id);
            $this->db->where('komentar_evaluasi.indikator_id', 0);
        }

        if ($id_unit) {
            $this->db->where('komentar_evaluasi.id_unit', $id_unit);
        }
        if ($tahun) {
            $this->db->where('komentar_evaluasi.tahun', $tahun);
        }

        return $this->db->order_by('komentar_evaluasi.created_at', 'ASC')
            ->get()->result();
    }

    public function get_by_indikator($indikator_id, $id_unit_param = null)
    {
        return $this->get_thread($indikator_id, null, $id_unit_param);
    }
}
