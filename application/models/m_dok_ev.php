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

}

 ?>