<?php 

class M_dashboard extends CI_Model {

	

	public function get_data4 ($id_unit)
	{
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT * from ref_unit where id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_data2 ()
	{

	 return $this->db->get('ref_unit')->result_array(); 
	}

	// Unit yang dikecualikan dari chart: UK6 (id=7), UK8 (id=9), UK9/Simulasi (id=10)
	const EXCLUDED_UNITS = '(7, 9, 10)';

	public function get_status ($tahun)
	{
		$tahun = $this->db->escape($tahun);
	 $query = $this->db->query("SELECT * from ta_dokumen where tahun = $tahun AND id_unit NOT IN ".self::EXCLUDED_UNITS);
	 return $query->result_array();
	}

	public function get_statusev ($tahun)
	{
		$tahun = $this->db->escape($tahun);
	 $query = $this->db->query("SELECT * from ta_dok_ev where tahun = $tahun AND id_unit NOT IN ".self::EXCLUDED_UNITS);
	 return $query->result_array();
	}

	public function get_blminputev ($tahun)
	{
		$tahun = $this->db->escape($tahun);
	 $query = $this->db->query("SELECT * FROM ta_ev0 where tahun = $tahun AND id_unit NOT IN ".self::EXCLUDED_UNITS." GROUP BY id_unit ");
	 return $query->result_array();
	}

	public function get_blminputevunit ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT * FROM ta_ev0 where tahun = $tahun and id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_statusrinci ($tahun)
	{
		$tahun = $this->db->escape($tahun);
	 $query = $this->db->query("SELECT * from ta_dokumen a left join ref_unit b on a.id_unit=b.id_unit where tahun = $tahun ORDER BY a.status_data ASC ");
	 return $query->result_array();
	}

	public function get_konfirmasi ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.*, c.id_ev as id_evta, c.perbaikan FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev HAVING id_ev IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi left join ta_ev c on b.id_ev=c.id_ev where b.id_role in (3,7) and c.perbaikan = 1 ");
	 return $query->result_array();
	}

	public function get_konfirmasi2 ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.*, c.id_ev as id_evta, c.perbaikan FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev HAVING id_ev IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi left join ta_ev c on b.id_ev=c.id_ev where b.id_role in (1,5) and c.perbaikan = 1 ");
	 return $query->result_array();
	}

	public function get_konfirmasi0 ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.*, c.id_ev0 as id_ev0ta, c.perbaikan0 FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev0 HAVING id_ev0 IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi left join ta_ev0 c on b.id_ev0=c.id_ev0 where b.id_role in (3,7) and c.perbaikan0 = 1 ");
	 return $query->result_array();
	}

	public function get_konfirmasi02 ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.*, b.*, c.id_ev0 as id_ev0ta, c.perbaikan0 FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev0 HAVING id_ev0 IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi left join ta_ev0 c on b.id_ev0=c.id_ev0 where b.id_role in (1,5) and c.perbaikan0 = 1 ");
	 return $query->result_array();
	}

	public function get_statusunit ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT * from ta_dokumen where tahun = $tahun and id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_persenkriteria ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT SUM(CASE WHEN jawaban1 IS NOT NULL AND jawaban1 <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen, SUM(CASE WHEN jawaban1 IS NOT NULL AND jawaban1 <> '' THEN 1 ELSE 0 END) AS jumlah from ta_pm where tahun = $tahun and id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_persensub ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT SUM(CASE WHEN jawaban0 IS NOT NULL AND jawaban0 <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen, SUM(CASE WHEN jawaban0 IS NOT NULL AND jawaban0 <> '' THEN 1 ELSE 0 END) AS jumlah
		FROM ta_pm0
		WHERE tahun = $tahun AND id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_statusunitev ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT * from ta_dok_ev where tahun = $tahun and id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_persenkriteriaev ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT SUM(CASE WHEN jawaban2 IS NOT NULL AND jawaban2 <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen, SUM(CASE WHEN jawaban2 IS NOT NULL AND jawaban2 <> '' THEN 1 ELSE 0 END) AS jumlah from ta_ev where tahun = $tahun and id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_persensubev ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT SUM(CASE WHEN jawaban0ev IS NOT NULL AND jawaban0ev <> '' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen, SUM(CASE WHEN jawaban0ev IS NOT NULL AND jawaban0ev <> '' THEN 1 ELSE 0 END) AS jumlah
		FROM ta_ev0
		WHERE tahun = $tahun AND id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_rekomendasi ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT count(id_rekomendasi) as jumlah from ta_rekomendasi where tahun = $tahun and id_unit = $id_unit and status_data2 = 1 ");
	 return $query->result_array();
	}

	public function get_tl ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT count(id_tl) as jumlah from ta_tl where tahun = $tahun and id_unit = $id_unit and status_data3 = 1 ");
	 return $query->result_array();
	}

	public function get_total_unit ()
	{
	 $query = $this->db->query("SELECT COUNT(*) as total FROM ref_unit WHERE id_unit NOT IN ".self::EXCLUDED_UNITS);
	 $result = $query->row_array();
	 return (int) $result['total'];
	}

}	

 ?>