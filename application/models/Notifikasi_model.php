<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
    /**
     * Buat notifikasi baru.
     */
    public function create($data)
    {
        return $this->db->insert('notifikasi', $data);
    }

    /**
     * Ambil daftar notifikasi milik user.
     *
     * @param  int      $user_id     ID user penerima
     * @param  bool     $only_unread true  = hanya yang belum dibaca
     * @param  int|null $limit       Batas jumlah baris (null = semua)
     * @param  int      $offset      Baris awal untuk pagination
     * @return array    Hasil query dengan field tambahan sender_name
     */
    public function get_notifications($user_id, $only_unread = false, $limit = null, $offset = 0)
    {
        $this->db
            ->select('notifikasi.*, k.isi_komentar, k.pengirim_role, u.nm_user, u.username, r.nm_unit')
            ->from('notifikasi')
            ->join('komentar_evaluasi k', 'notifikasi.komentar_id = k.id', 'left')
            ->join('ta_user u', 'k.evaluator_id = u.id_user', 'left')
            ->join('ref_unit r', 'u.id_unit = r.id_unit', 'left')
            ->where('notifikasi.user_id', $user_id);

        if ($only_unread) {
            $this->db->where('notifikasi.is_read', 0);
        }

        $this->db->order_by('notifikasi.created_at', 'DESC');

        if ($limit !== null) {
            $this->db->limit((int) $limit, (int) $offset);
        }

        $result = $this->db->get()->result();

        foreach ($result as &$row) {
            if (isset($row->pengirim_role) && $row->pengirim_role == 'subkomponen') {
                $row->sender_name = !empty($row->nm_unit) ? $row->nm_unit : $row->nm_user;
            } else {
                $row->sender_name = $row->nm_user . (!empty($row->username) ? ' (' . $row->username . ')' : '');
            }
        }

        return $result;
    }

    /**
     * Alias backward-compatible: ambil notifikasi belum dibaca (maks 10).
     */
    public function get_unread($user_id, $limit = 10)
    {
        return $this->get_notifications($user_id, true, $limit);
    }

    /**
     * Alias backward-compatible: ambil semua notifikasi.
     */
    public function get_all($user_id)
    {
        return $this->get_notifications($user_id, false);
    }

    /**
     * Hitung notifikasi yang belum dibaca.
     */
    public function count_unread($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('is_read', 0)
            ->count_all_results('notifikasi');
    }

    /**
     * Hitung total notifikasi (semua status baca) — dipakai pagination.
     */
    public function count_all($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->count_all_results('notifikasi');
    }

    /**
     * Tandai satu notifikasi sebagai terbaca.
     */
    public function mark_read($id)
    {
        return $this->db
            ->where('id', $id)
            ->update('notifikasi', ['is_read' => 1]);
    }

    /**
     * Tandai semua notifikasi milik user sebagai terbaca.
     */
    public function mark_all_read($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->update('notifikasi', ['is_read' => 1]);
    }

    /**
     * Hapus satu notifikasi.
     * Hanya bisa menghapus notifikasi milik sendiri (user_id wajib cocok).
     *
     * @param  int  $id       ID notifikasi
     * @param  int  $user_id  ID user pemilik
     * @return bool true jika berhasil dihapus
     */
    public function delete($id, $user_id)
    {
        $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->delete('notifikasi');

        return $this->db->affected_rows() > 0;
    }
}
