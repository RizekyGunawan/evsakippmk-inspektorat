<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasub extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_pm0 = $this->input->get('id_pm0');

        // Lakukan logika untuk mengambil data berdasarkan ID yang diberikan
        // Misalnya, mengambil data dari database

        // Contoh logika untuk mengambil data dari database
        $query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban1)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban1) as skor,
        (CASE 
        WHEN '100'=((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) THEN 'BB'
        WHEN '75'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='99' THEN 'B' 
        WHEN '50'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='75' THEN 'CC'
        WHEN '25'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='50' THEN 'C'  
        WHEN '0'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='25' THEN 'D'
        WHEN '0'=((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) THEN 'E'
        ELSE ''
        END) as jawabanantara
        from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 where d.id_pm0 = ?", array($id_pm0)); // Menjalankan query dan mendapatkan hasilnya

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
