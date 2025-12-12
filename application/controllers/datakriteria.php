<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datakriteria extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_pm = $this->input->get('id_pm');

        // Lakukan logika untuk mengambil data berdasarkan ID yang diberikan
        // Misalnya, mengambil data dari database
        $tahun = $this->session->userdata('tahun');
        $tahun = intval($tahun);
        $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
        // Contoh logika untuk mengambil data dari database
        $query = $this->db->query("SELECT * from ta_pm a  
                                    inner join $ref_aspek_table b on a.id_aspek=b.id_aspek 
                                    inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen 
                                    inner join ta_pm0 d on a.id_pm0=d.id_pm0 
                                    where a.id_pm = ?", array($id_pm)); // Menjalankan query dan mendapatkan hasilnya

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
