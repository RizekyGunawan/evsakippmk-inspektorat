<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datakonfirmasi extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_ev = $this->input->get('id_ev');

        // Lakukan logika untuk mengambil data berdasarkan ID yang diberikan
        // Misalnya, mengambil data dari database

        // Contoh logika untuk mengambil data dari database
        $query = $this->db->query("SELECT * from ta_ev
                                    where id_ev = ?", array($id_ev)); // Menjalankan query dan mendapatkan hasilnya

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
