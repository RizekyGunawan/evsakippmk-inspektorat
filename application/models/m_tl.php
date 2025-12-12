<?php 



class M_tl extends CI_Model {

	public function get_data ()
	{

	 return $this->db->get('ta_tl')->result_array(); 
	}

	public function get_data3 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_tl a  inner join ref_unit b on a.id_unit=b.id_unit inner join ta_rekomendasi c on a.id_rekomendasi=c.id_rekomendasi where a.tahun = '$tahun' and  a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_data3monev ($tahun)
	{
		$query = $this->db->query("SELECT * from ta_tl a  inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' ");
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
		$query = $this->db->query("SELECT *, count(id_tl) from ta_tl where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
	}

	

	public function update_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

}

 ?>