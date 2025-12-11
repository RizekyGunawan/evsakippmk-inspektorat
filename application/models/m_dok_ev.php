<?php 



class M_dok_ev extends CI_Model {

	public function get_data ()
	{

	 return $this->db->get('ta_dok_ev')->result_array(); 
	}

	public function get_data3 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_dok_ev a  inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' and  a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_data3monev ($tahun)
	{
		$query = $this->db->query("SELECT * from ta_dok_ev a  inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' ");
	 return $query->result_array();
	}

	public function get_data3monev2 ($tahun)
	{
		$tahun = $this->db->escape($tahun);
		$query = $this->db->query("SELECT a.*,b.persen FROM (SELECT a.*,b.nm_unit, b.kd_unit, ROUND(sum((CASE 
			WHEN c.jawaban0ev='100' THEN ('1'*d.bobot2)
			WHEN c.jawaban0ev='90' THEN ('0.9'*d.bobot2)
			WHEN c.jawaban0ev='80' THEN ('0.8'*d.bobot2)
			WHEN c.jawaban0ev='70' THEN ('0.7'*d.bobot2)
			WHEN c.jawaban0ev='60' THEN ('0.6'*d.bobot2)
			WHEN c.jawaban0ev='50' THEN ('0.5'*d.bobot2)
			WHEN c.jawaban0ev='30' THEN ('0.3'*d.bobot2)
			WHEN c.jawaban0ev='0' THEN ('0'*d.bobot2)
			ELSE ''
			END)), 2) as totalnilai FROM ta_dok_ev a inner join ref_unit b on a.id_unit=b.id_unit left join ta_ev0 c on a.id_unit=c.id_unit left join ref_subkomponen d on c.id_subkomponen=d.id_subkomponen where a.tahun = $tahun and c.tahun = $tahun GROUP BY a.id_dok_ev) a LEFT JOIN 
			
			(SELECT id_dok_ev, SUM(CASE WHEN jawaban2 IS NOT NULL AND jawaban2 <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen from ta_ev where tahun = $tahun GROUP BY id_dok_ev) b on a.id_dok_ev=b.id_dok_ev ");
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

	public function input_data ($data,$table)
	{
	 $this->db->insert($table,$data); 
	}

	public function delete_data ($where,$table){

		$this->db->where($where);
		$this->db->delete($table);
	}


	public function update_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
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

	public function get_perbandingan_data ($tahun_current, $tahun_previous)
	{
		$tahun_current = intval($tahun_current);
		$tahun_previous = intval($tahun_previous);
		
		$query = $this->db->query("SELECT 
			curr.id_unit,
			curr.nm_unit,
			COALESCE(prev.totalnilai, 0) as nilai_$tahun_previous,
			COALESCE(curr.totalnilai, 0) as nilai_$tahun_current,
			CASE 
				WHEN COALESCE(prev.totalnilai, 0) = 0 THEN 0
				ELSE ROUND(((curr.totalnilai - COALESCE(prev.totalnilai, 0)) / COALESCE(prev.totalnilai, 1)) * 100, 2)
			END as persentase_perubahan,
			ROUND(curr.totalnilai - COALESCE(prev.totalnilai, 0), 2) as selisih
		FROM 
			(SELECT 
				a.id_unit,
				b.nm_unit,
				ROUND(sum((CASE 
					WHEN c.jawaban0ev='100' THEN ('1'*d.bobot2)
					WHEN c.jawaban0ev='90' THEN ('0.9'*d.bobot2)
					WHEN c.jawaban0ev='80' THEN ('0.8'*d.bobot2)
					WHEN c.jawaban0ev='70' THEN ('0.7'*d.bobot2)
					WHEN c.jawaban0ev='60' THEN ('0.6'*d.bobot2)
					WHEN c.jawaban0ev='50' THEN ('0.5'*d.bobot2)
					WHEN c.jawaban0ev='30' THEN ('0.3'*d.bobot2)
					WHEN c.jawaban0ev='0' THEN ('0'*d.bobot2)
					ELSE 0
					END)), 2) as totalnilai 
			FROM ta_dok_ev a 
			INNER JOIN ref_unit b ON a.id_unit=b.id_unit 
			LEFT JOIN ta_ev0 c ON a.id_unit=c.id_unit AND c.tahun = $tahun_current
			LEFT JOIN ref_subkomponen d ON c.id_subkomponen=d.id_subkomponen 
			WHERE a.tahun = $tahun_current
			GROUP BY a.id_unit, b.nm_unit) curr
		LEFT JOIN 
			(SELECT 
				a.id_unit,
				ROUND(sum((CASE 
					WHEN c.jawaban0ev='100' THEN ('1'*d.bobot2)
					WHEN c.jawaban0ev='90' THEN ('0.9'*d.bobot2)
					WHEN c.jawaban0ev='80' THEN ('0.8'*d.bobot2)
					WHEN c.jawaban0ev='70' THEN ('0.7'*d.bobot2)
					WHEN c.jawaban0ev='60' THEN ('0.6'*d.bobot2)
					WHEN c.jawaban0ev='50' THEN ('0.5'*d.bobot2)
					WHEN c.jawaban0ev='30' THEN ('0.3'*d.bobot2)
					WHEN c.jawaban0ev='0' THEN ('0'*d.bobot2)
					ELSE 0
					END)), 2) as totalnilai 
			FROM ta_dok_ev a 
			LEFT JOIN ta_ev0 c ON a.id_unit=c.id_unit AND c.tahun = $tahun_previous
			LEFT JOIN ref_subkomponen d ON c.id_subkomponen=d.id_subkomponen 
			WHERE a.tahun = $tahun_previous
			GROUP BY a.id_unit) prev
		ON curr.id_unit = prev.id_unit
		ORDER BY curr.nm_unit ASC");
		
	 	return $query->result_array();
	}

}

 ?>