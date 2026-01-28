<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datakriteria_ev extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_ev = $this->input->get('id_ev');

        // Lakukan logika untuk mengambil data berdasarkan ID yang diberikan
        // Misalnya, mengambil data dari database
        $tahun = $this->session->userdata('tahun');
        $tahun = intval($tahun);
        $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
        // Contoh logika untuk mengambil data dari database
        $query = $this->db->query("SELECT * from ta_ev a 
                                        inner join $ref_aspek_table b on a.id_aspek=b.id_aspek
                                        inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen
                                        inner join ta_ev0 d on a.id_ev0=d.id_ev0
                                        inner join ta_pm e on a.id_pm=e.id_pm
                                        inner join ta_pm0 f on d.id_pm0=f.id_pm0 
                                    where a.id_ev = ?", array($id_ev)); // Menjalankan query dan mendapatkan hasilnya

        if ($query->num_rows() > 0) {
            $data = $query->row_array(); // Mengambil data hasil query sebagai array
        } else {
            $data = array(); // Jika tidak ada data, inisialisasikan dengan array kosong
        }

        // Mengirimkan data sebagai respon JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
