<?php

class M_pm extends CI_Model
{

	public function get_data()
	{

		$this->db->get('ta_pm');
	}

	public function get_data2()
	{

		return $this->db->get('ref_unit')->result_array();
	}

	public function get_data3($tahun, $id_unit)
	{
		$tahun = intval($tahun);
		$id_unit = intval($id_unit);
		// Determine which table to join based on the year
		$ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT * from ta_pm a  inner join $ref_aspek_table b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ref_komponen e on a.id_komponen=e.id_komponen left join ref_unit f on a.id_unit=f.id_unit where a.tahun = $tahun  and a.id_unit = $id_unit ");
		return $query->result_array();
	}

	public function get_data30($tahun, $id_unit)
	{
		$tahun = intval($tahun);
		$id_unit = intval($id_unit);
		// Determine which table to join based on the year
		$ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
		(CASE 
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
		WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
		ELSE ''
		END) as jawabanantara
 		from ta_pm a  inner join $ref_aspek_table b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 where a.tahun = $tahun  and a.id_unit = $id_unit GROUP BY a.id_pm0 ");
		return $query->result_array();
	}


	public function get_data300($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' GROUP BY a.id_komponen ");
		return $query->result_array();
	}


	public function get_datasub1ai($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 1 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}



	public function get_datasub1a($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 1 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub1bi($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 2 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub1b($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 2 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub1ci($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 3 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub1c($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 3 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2ai($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 4 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2a($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 4 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2bi($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 5 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2b($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 5 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2ci($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 6 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2c($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 6 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3ai($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 7 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3a($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 7 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3bi($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 8 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3b($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 8 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3ci($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0  inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 9 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3c($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 9 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub4ai($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 10 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4a($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 10 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4bi($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 11 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4b($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 11 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4ci($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 12 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4c($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT * from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.id_subkomponen = 12 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, a.modified_by as pm_modified_by,  (avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2) as skorpersen, (avg(c.bobot2*NULLIF(a.jawaban1, ''))/100) as skor,
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
			ELSE ''
			END) as jawabanantara, 
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
			END) as nilai,
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
			from ta_pm a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_pm0 d on a.id_pm0=d.id_pm0 inner join ta_dokumen e on a.id_dokumen=e.id_dokumen where a.tahun = '$tahun' and a.id_unit = '$id_unit' GROUP BY a.id_subkomponen ");
		return $query->result_array();
	}



	public function get_datakrit($tahun, $id_unit)
	{

		$tahun = intval($tahun);
		$id_unit = intval($id_unit);
		// Determine which table to join based on the year
		$ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';

		// Construct the query with the chosen table
		$query = $this->db->query("
	        SELECT *, a.modified_by AS pm_modified_by 
	        FROM ta_pm a
	        INNER JOIN $ref_aspek_table b ON a.id_aspek = b.id_aspek
	        INNER JOIN ref_subkomponen c ON a.id_subkomponen = c.id_subkomponen
	        INNER JOIN ta_pm0 d ON a.id_pm0 = d.id_pm0
	        INNER JOIN ta_dokumen e ON a.id_dokumen = e.id_dokumen
	        WHERE a.tahun = $tahun AND a.id_unit = $id_unit
	        GROUP BY a.id_aspek
	    ");

		return $query->result_array();
	}

	public function get_datakom($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' GROUP BY a.id_komponen ");
		return $query->result_array();
	}


	public function get_datakom1($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '1' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datakom2($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '2' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datakom3($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '3' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datakom4($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
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
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '4' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasumkom($tahun, $id_unit)
	{
		$query = $this->db->query("SELECT a.id_komponen, 100 as sumbobot, sum((CASE 
			WHEN b.jawaban0='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as sumnilaik, 
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
			END))/100)*100) as sumnilaikpersen 
			 from ref_komponen a inner join ta_pm0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_uploaded_files($id_pm)
	{
		$this->db->select('link_bukti2');
		$this->db->from('ta_pm');
		$this->db->where('id_pm', $id_pm);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->link_bukti2;
		} else {
			return '';
		}
	}

	public function get_uploaded_files0($id_pm0)
	{
		$this->db->select('link_bukti02');
		$this->db->from('ta_pm0');
		$this->db->where('id_pm0', $id_pm0);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->link_bukti02;
		} else {
			return '';
		}
	}


	public function get_data4($id_unit)
	{
		$query = $this->db->query("SELECT * from ref_unit where id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function join_data($table, $tbljoin, $join)
	{
		$this->db->join($tbljoin, $join);
		return $this->db->get($table)->result_array();
	}

	public function join_data2($table, $tbljoin, $join, $tbljoin2, $join2)
	{
		$this->db->join($tbljoin, $join);
		$this->db->join($tbljoin2, $join2);
		return $this->db->get($table)->result_array();
	}


	public function get_load($tahun, $id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT *, count(id_pm) from ta_pm where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
	}


	//---Load Data PM
	public function insert_pm($tahun, $id_unit)
	{

		$tahun = intval($tahun);
		$id_unit = intval($id_unit);
		$created_by = $this->session->userdata('username');
		$modified_by = $this->session->userdata('username');
		$query = $this->db->query("INSERT INTO ta_pm0 (tahun, id_unit, id_dokumen, id_komponen, id_subkomponen, created_by, modified_by)
        SELECT
        b.tahun,
        b.id_unit,
        b.id_dokumen,
        a.id_komponen,
        a.id_subkomponen,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ref_subkomponen a
        JOIN 
        ta_dokumen b
        WHERE
        b.tahun = $tahun and b.id_unit = $id_unit ");

		$query5 = $this->db->query('SELECT MAX(id_pm0) AS max_id FROM ta_pm0');
		$row = $query5->row();
		$next_id = $row->max_id + 1;

		// Query to set the next auto increment value
		$query6 = $this->db->query('ALTER TABLE ta_pm0 AUTO_INCREMENT = ' . $next_id);

		// Determine which ref_aspek table to use based on the year
		$ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';

		$query2 = $this->db->query("INSERT INTO ta_pm (tahun, id_unit, id_pm0, id_dokumen, id_komponen, id_subkomponen, id_aspek, created_by, modified_by)
        SELECT
        b.tahun,
        b.id_unit,
        b.id_pm0,
        b.id_dokumen,
        b.id_komponen,
        b.id_subkomponen,
        a.id_aspek,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        $ref_aspek_table a
        JOIN 
         ta_pm0 b
         ON a.id_subkomponen=b.id_subkomponen
        WHERE
        b.tahun = $tahun and b.id_unit = $id_unit ");

		$query3 = $this->db->query('SELECT MAX(id_pm) AS max_id FROM ta_pm');
		$row = $query3->row();
		$next_id = $row->max_id + 1;

		// Query to set the next auto increment value
		$query4 = $this->db->query('ALTER TABLE ta_pm AUTO_INCREMENT = ' . $next_id);
	}
	//---Batas akhir Load Data PM

	public function sync_jawaban0($id_pm) {
		// 1. Dapatkan id_pm0 dari tabel ta_pm berdasarkan id_pm yang sedang diupdate
		$query = $this->db->query("SELECT id_pm0 FROM ta_pm WHERE id_pm = ?", array($id_pm));
		$row = $query->row();
		if (!$row) return;
		$id_pm0 = $row->id_pm0;

		// 2. Hitung rata-rata indikator (jawaban1) untuk id_pm0 tersebut
		//    menggunakan formula bobot dan konversi threshold (>=90 = '100'/AA, dll)
		$query_avg = $this->db->query("
			SELECT 
			(CASE 
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 90 THEN '100'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 80 THEN '90'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 70 THEN '80'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 60 THEN '70'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 50 THEN '60'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >= 30 THEN '50'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) >  0  THEN '30'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) =  0  THEN '0'
			ELSE ''
			END) as new_jawaban0
			FROM ta_pm a
			INNER JOIN ref_subkomponen c ON a.id_subkomponen = c.id_subkomponen
			WHERE a.id_pm0 = ?
		", array($id_pm0));

		$row_avg = $query_avg->row();
		if ($row_avg && $row_avg->new_jawaban0 !== '') {
			// 3. Update kembali hasil kalkulasi ini ke ta_pm0 agar nilai sub-komponen sinkron
			$new_jawaban0 = $row_avg->new_jawaban0;
			$this->db->where('id_pm0', $id_pm0);
			$this->db->update('ta_pm0', array('jawaban0' => $new_jawaban0));
		}
	}

	public function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	/*public function delete_data ($where,$table){

		$this->db->where($where);
		$this->db->delete($table);
	}*/


	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function update_status_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

}

?>