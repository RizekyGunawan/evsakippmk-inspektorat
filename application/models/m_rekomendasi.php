<?php 



class M_rekomendasi extends CI_Model {

	public function get_data ()
	{

	 return $this->db->get('ta_dokumen')->result_array(); 
	}

	public function get_data3 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_rekomendasi a  left join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' and  a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_data3monev ($tahun)
	{
		$query = $this->db->query("SELECT * from ta_dokumen a  inner join ref_unit b on a.id_unit=b.id_unit where a.tahun = '$tahun' ");
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
		$query = $this->db->query("SELECT *, count(id_rekomendasi) from ta_rekomendasi where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
	}

	public function get_sev ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT * from ta_dok_ev where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
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

	public function update_data2 ($id_unit,$tahun)
    {
    	$id_unit = $this->db->escape($id_unit);
    	$tahun = $this->db->escape($tahun);
    	$created_by = $this->session->userdata('username');
    	$modified_by = $this->session->userdata('username');
        $query = $this->db->query("UPDATE ta_rekomendasi
			set status_data2 = 1 and modified_by = '$modified_by'
			where tahun = $tahun and id_unit = $id_unit");
        $query2 = $this->db->query("INSERT INTO ta_tl (tahun, id_unit, id_rekomendasi, created_by, modified_by)
        SELECT
        tahun,
        id_unit,
        id_rekomendasi,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ta_rekomendasi
        WHERE
        tahun = $tahun and id_unit = $id_unit");
    }

}

 ?>