<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasub extends CI_Controller {

    public function getData()
    {
        $this->load->database();

        $id_pm0 = $this->input->get('id_pm0');

        $query = $this->db->query("
            SELECT 
                d.*,
                AVG(a.jawaban1) as skorpersen, 
                AVG(c.bobot2 * (a.jawaban1 / 100)) as skor,
                (CASE 
                    WHEN AVG(a.jawaban1) = 100 THEN 'AA'
                    WHEN AVG(a.jawaban1) >= 90 THEN 'A'
                    WHEN AVG(a.jawaban1) >= 80 THEN 'BB'
                    WHEN AVG(a.jawaban1) >= 70 THEN 'B'
                    WHEN AVG(a.jawaban1) >= 60 THEN 'CC'
                    WHEN AVG(a.jawaban1) >= 50 THEN 'C'
                    WHEN AVG(a.jawaban1) >= 30 THEN 'D'
                    ELSE 'E'
                END) as jawabanantara
            from ta_pm a  
            inner join ref_aspek b on a.id_aspek=b.id_aspek 
            inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen 
            inner join ta_pm0 d on a.id_pm0=d.id_pm0 
            where d.id_pm0 = ?
            GROUP BY d.id_pm0
        ", array($id_pm0));

        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        } else {
            $data = array();
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

}