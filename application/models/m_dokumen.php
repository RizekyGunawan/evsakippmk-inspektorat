<?php 



class M_dokumen extends CI_Model {

	public function get_data ()
	{

	 return $this->db->get('ta_dokumen')->result_array(); 
	}

	public function get_data3 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_dokumen a  inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' and  a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_data3monev ($tahun)
	{
		$query = $this->db->query("SELECT * from ta_dokumen a inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' AND a.id_unit NOT IN (7, 9, 10) ORDER BY a.id_unit ASC ");
	 return $query->result_array();
	}

   	public function get_data3monev2 ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT a.*,b.persen FROM
		(SELECT a.*,b.nm_unit, b.kd_unit, b.id_unit as sort_id_unit, ROUND(sum((CASE 
			WHEN c.jawaban0='100' THEN ('1'*d.bobot2)
			WHEN c.jawaban0='90' THEN ('0.9'*d.bobot2)
			WHEN c.jawaban0='80' THEN ('0.8'*d.bobot2)
			WHEN c.jawaban0='70' THEN ('0.7'*d.bobot2)
			WHEN c.jawaban0='60' THEN ('0.6'*d.bobot2)
			WHEN c.jawaban0='50' THEN ('0.5'*d.bobot2)
			WHEN c.jawaban0='30' THEN ('0.3'*d.bobot2)
			WHEN c.jawaban0='0' THEN ('0'*d.bobot2)
			ELSE ''
			END)), 2) as totalnilai FROM ta_dokumen a inner join ref_unit b on a.id_unit=b.id_unit left join ta_pm0 c on a.id_unit=c.id_unit left join ref_subkomponen d on c.id_subkomponen=d.id_subkomponen where a.tahun = $tahun and c.tahun = $tahun AND a.id_unit NOT IN (7, 9, 10) GROUP BY a.id_dokumen) a LEFT JOIN 
			
			(SELECT id_dokumen, SUM(CASE WHEN jawaban1 IS NOT NULL AND jawaban1 <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen from ta_pm where tahun = $tahun GROUP BY id_dokumen) b on a.id_dokumen=b.id_dokumen ORDER BY a.sort_id_unit ASC ");
	 return $query->result_array();
	}

	public function get_datakomp ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT d.*, a.kd_komponen, a.uraian_komponen, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaikomponen, 
			((sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaipersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen inner join ref_unit d on b.id_unit=d.id_unit where  b.tahun = $tahun GROUP BY  b.id_unit, a.id_komponen ");
	 return $query->result_array();
	}

	public function get_datasub ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT f.*, c.kd_subkomponen, c.uraian_subkomponen, g.kd_komponen,
			(CASE 
			WHEN d.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilaisub,
			((CASE 
			WHEN d.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_unit=e.id_unit inner join ref_unit f on a.id_unit=f.id_unit left join ref_komponen g on a.id_komponen=g.id_komponen where a.tahun = $tahun GROUP BY f.kd_unit, a.id_subkomponen ");
	 return $query->result_array();
	}

	public function get_datakriteria ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT f.*, c.kd_subkomponen, b.kd_aspek as kd_kriteria, b.uraian_aspek as kriteria, g.kd_komponen, (case when a.jawaban1='0' then 'Tidak' when a.jawaban1=1 then 'Ya' when a.jawaban1='' then 'Y/T' else '' end) as jawaban from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_unit=e.id_unit inner join ref_unit f on a.id_unit=f.id_unit left join ref_komponen g on a.id_komponen=g.id_komponen where a.tahun = $tahun GROUP BY a.id_unit, a.id_aspek ");
	 return $query->result_array();
	}

	public function get_data4 ($id_unit)
	{
		$query = $this->db->query("SELECT * from ref_unit where id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_data2 ()
	{

	 return $this->db->get('ref_unit')->result_array(); 
	}



	public function get_load ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT *, count(id_dokumen) from ta_dokumen where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
	}

	public function get_loadall ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT *, count(id_dokumen) from ta_dokumen where tahun = $tahun ");
		return $query->result_array();
	}

	public function getpegawai($id_pegawai) {
        $this->db->where('id_pegawai', $id_pegawai);
        $query = $this->db->get('ref_pegawai');
        return $query->row_array();
    }

	public function input_data ($data,$table)
	{
	 $this->db->insert($table,$data); 
	}

//---Load Data PM
	public function tambah_data ($id_unit,$tahun)
    {
    	$id_unit = $this->db->escape($id_unit);
    	$tahun = $this->db->escape($tahun);
        $query = $this->db->query("INSERT INTO ta_dokumen
			set tahun = $tahun, id_unit = $id_unit");
        $query2 = $this->db->query("INSERT INTO ta_dok_ev (tahun, id_unit, id_dok_ev)
        SELECT
        a.tahun,
        a.id_unit,
        a.id_dokumen
        FROM
        ta_dokumen a
        WHERE
        a.tahun = $tahun and a.id_unit = $id_unit");
    }
//---Akhir Load Data PM

    public function tambah_dataall ($tahun)
    {
    	$tahun = $this->db->escape($tahun);
    	$created_by = $this->session->userdata('username');
    	$modified_by = $this->session->userdata('username');
        $query = $this->db->query("INSERT INTO ta_dokumen (tahun, id_unit, created_by, modified_by)
		SELECT
        $tahun, 
        id_unit,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ref_unit");

        $query3 = $this->db->query('SELECT MAX(id_dokumen) AS max_id FROM ta_dokumen');
        $row = $query3->row();
        $next_id = $row->max_id + 1;

        // Query to set the next auto increment value
         $query4 = $this->db->query('ALTER TABLE ta_dokumen AUTO_INCREMENT = ' . $next_id);

        $query2 = $this->db->query("INSERT INTO ta_dok_ev (tahun, id_unit, id_dok_ev, id_dokumen, created_by, modified_by)
        SELECT
        a.tahun,
        a.id_unit,
        a.id_dokumen,
        a.id_dokumen,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ta_dokumen a
        WHERE
        a.tahun = $tahun");
    }

	public function delete_data ($where,$table){

		$this->db->where($where);
		$this->db->delete($table);
	}


	public function update_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

}

 ?>