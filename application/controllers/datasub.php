<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasub extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_pm0 = $this->input->get('id_pm0');

        // Query yang dioptimalkan untuk menghitung rata-rata jawaban1
        $this->db->select([
            'a.*',
            'b.*',
            'c.*',
            'd.*',
            'AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) as avg_jawaban1',
            'CASE ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 90 THEN "AA" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 80 THEN "A" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 70 THEN "BB" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 60 THEN "B" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 50 THEN "CC" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) >= 30 THEN "C" ' .
            '   WHEN AVG(CAST(a.jawaban1 AS DECIMAL(10,2))) > 0 THEN "D" ' .
            '   ELSE "E" ' .
            'END as jawabanantara',
            'ROUND(AVG(CAST(a.jawaban1 AS DECIMAL(10,2))), 0) as skorpersen',
            'ROUND(AVG(CAST(a.jawaban1 AS DECIMAL(10,2))), 0) as skor'
        ]);
        
        $this->db->from('ta_pm a');
        $this->db->join('ref_aspek b', 'a.id_aspek = b.id_aspek');
        $this->db->join('ref_subkomponen c', 'a.id_subkomponen = c.id_subkomponen');
        $this->db->join('ta_pm0 d', 'a.id_pm0 = d.id_pm0');
        $this->db->where('d.id_pm0', $id_pm0);
        $this->db->group_by('d.id_pm0');
        
        $query = $this->db->get();

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
