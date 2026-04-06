<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasub_ev extends CI_Controller {

    public function getData()
    {
        $this->load->database();
        $id_ev0 = $this->input->get('id_ev0');

        $query = $this->db->query("
            SELECT 
                d.*,
                AVG(a.jawaban2) as skorpersen, 
                AVG(c.bobot2 * (a.jawaban2 / 100)) as skor,
                (CASE 
                    WHEN AVG(a.jawaban2) = 100 THEN 'AA'
                    WHEN AVG(a.jawaban2) >= 90 THEN 'A'
                    WHEN AVG(a.jawaban2) >= 80 THEN 'BB'
                    WHEN AVG(a.jawaban2) >= 70 THEN 'B'
                    WHEN AVG(a.jawaban2) >= 60 THEN 'CC'
                    WHEN AVG(a.jawaban2) >= 50 THEN 'C'
                    WHEN AVG(a.jawaban2) >= 30 THEN 'D'
                    ELSE 'E'
                END) as jawabanantara,
                (CASE
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  90 THEN 'AA'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  80 THEN 'A'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  70 THEN 'BB'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  60 THEN 'B'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  50 THEN 'CC'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  30 THEN 'C'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >   0 THEN 'D'
                    WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) =   0 THEN 'E'
                    ELSE ''
                END) as jawabanantara_unit
            FROM ta_ev a  
            INNER JOIN ref_aspek b ON a.id_aspek = b.id_aspek 
            INNER JOIN ref_subkomponen c ON a.id_subkomponen = c.id_subkomponen 
            INNER JOIN ta_ev0 d ON a.id_ev0 = d.id_ev0
            INNER JOIN ta_pm e ON a.id_pm = e.id_pm
            WHERE d.id_ev0 = ?
            GROUP BY d.id_ev0
        ", array($id_ev0));

        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        } else {
            $data = array();
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}