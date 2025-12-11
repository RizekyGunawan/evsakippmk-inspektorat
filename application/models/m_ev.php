<?php 

class M_ev extends CI_Model {

	public function get_data ()
	{

	 return $this->db->get('ta_ev')->result_array(); 
	}

	public function get_data2 ()
	{

	 return $this->db->get('ref_unit')->result_array(); 
	}

	public function get_konfirmasi ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a left join ta_konfirmasi b on a.id_ev=b.id_ev where a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_history_konfirmasi ($tahun,$id_unit,$id_ev)
	{
		$query = $this->db->query("SELECT * from ta_konfirmasi where tahun = '$tahun'  and id_unit = '$id_unit' and id_ev = '$id_ev' ");
	 return $query->result_array();
	}

	public function get_konfirmasi0 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev0 a left join ta_konfirmasi b on a.id_ev0=b.id_ev0 where a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function get_history_konfirmasi0 ($tahun,$id_unit,$id_ev0)
	{
		$query = $this->db->query("SELECT * from ta_konfirmasi where tahun = '$tahun'  and id_unit = '$id_unit' and id_ev0 = '$id_ev0' ");
	 return $query->result_array();
	}


	public function get_data3 ($tahun,$id_unit)
	{	
		$tahun = intval($tahun);
    	$id_unit = intval($id_unit);
	    // Determine which table to join based on the year
	    $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT * from ta_ev a  inner join $ref_aspek_table b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_pm e on a.id_pm=e.id_pm inner join ta_pm0 f on d.id_pm0=f.id_pm0 inner join ref_komponen g on a.id_komponen=g.id_komponen left join ref_unit h on a.id_unit=h.id_unit where a.tahun = $tahun  and a.id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_data3form ($tahun,$id_unit,$id_ev)
	{
		$tahun = intval($tahun);
    	$id_unit = intval($id_unit);
	    // Determine which table to join based on the year
	    $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT * from ta_ev a  left join $ref_aspek_table b on a.id_aspek=b.id_aspek left join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen left join ta_ev0 d on a.id_ev0=d.id_ev0 left join ta_pm e on a.id_pm=e.id_pm left join ta_pm0 f on d.id_pm0=f.id_pm0 left join ref_komponen g on a.id_komponen=g.id_komponen where a.tahun = '$tahun'  and a.id_unit = '$id_unit' and a.id_ev = '$id_ev' ");
	 return $query->result_array();
	}

	public function get_data30form ($tahun,$id_unit,$id_ev0)
	{
		$query = $this->db->query("SELECT * from ta_ev0 a  left join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen left join ref_komponen b on a.id_komponen=b.id_komponen where a.tahun = '$tahun'  and a.id_unit = '$id_unit' and a.id_ev0 = '$id_ev0' ");
	 return $query->result_array();
	}

	public function get_data30 ($tahun,$id_unit)
	{
		$tahun = intval($tahun);
    	$id_unit = intval($id_unit);
	    // Determine which table to join based on the year
	    $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
		(CASE 
		WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
		WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
		WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
		WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
		WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
		WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
		ELSE ''
		END) as jawabanantara
 		from ta_ev a  inner join $ref_aspek_table b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_pm e on a.id_pm=e.id_pm inner join ta_pm0 f on d.id_pm0=f.id_pm0 where a.tahun = $tahun  and a.id_unit = $id_unit GROUP BY a.id_ev0 ");
	 return $query->result_array();
	}

	public function get_data300 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' GROUP BY a.id_komponen ");
		return $query->result_array();
	}


	public function get_datasub1ai ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 1 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	

	public function get_datasub1a ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 1 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub1bi ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 2 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub1b ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 2 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	
	public function get_datasub1ci ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 3 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub1c ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 3 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2ai ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 4 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2a ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 4 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2bi ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 5 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2b ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 5 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub2ci ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 6 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub2c ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 6 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3ai ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 7 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3a ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 7 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3bi ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 8 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3b ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 8 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub3ci ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0  inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 9 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub3c ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 9 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub4ai ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 10 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4a ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 10 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4bi ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 11 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4b ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 11 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4ci ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 12 and a.tahun = '$tahun' and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datasub4c ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT * from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.id_subkomponen = 12 and a.tahun = '$tahun'  and a.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasub ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, a.modified_by AS ev_modified_by,  (avg(c.bobot2*a.jawaban2)/c.bobot2)*100 as skorpersen, avg(c.bobot2*a.jawaban2) as skor,
			(CASE 
			WHEN '100'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'BB'
			WHEN '75'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='99' THEN 'B' 
			WHEN '50'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='75' THEN 'CC'
			WHEN '25'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='50' THEN 'C'  
			WHEN '0'<((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) <='25' THEN 'D'
			WHEN '0'=((avg(c.bobot2*a.jawaban2)/c.bobot2)*100) THEN 'E'
			ELSE ''
			END) as jawabanantara, 
			(CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END) as nilai,
			((CASE 
			WHEN d.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN d.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN d.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN d.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN d.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN d.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN d.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN d.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END/c.bobot2)*100) as nilaipersen
			from ta_ev a  inner join ref_aspek b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.tahun = '$tahun' and a.id_unit = '$id_unit' GROUP BY a.id_subkomponen ");
		return $query->result_array();
	}


	public function get_datakrit ($tahun,$id_unit)
	{
		$tahun = intval($tahun);
    	$id_unit = intval($id_unit);
    	// Determine which table to join based on the year
	    $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		$query = $this->db->query("SELECT *, a.modified_by AS ev_modified_by from ta_ev a  inner join $ref_aspek_table b on a.id_aspek=b.id_aspek inner join ref_subkomponen c on a.id_subkomponen=c.id_subkomponen inner join ta_ev0 d on a.id_ev0=d.id_ev0 inner join ta_dokumen e on a.id_dok_ev=e.id_dokumen inner join ta_pm f on a.id_pm=f.id_pm inner join ta_pm0 g on d.id_pm0=g.id_pm0 inner join ta_dok_ev h on a.id_dok_ev=h.id_dok_ev where a.tahun = $tahun  and a.id_unit = $id_unit GROUP BY a.id_aspek ");
		return $query->result_array();
	}


	public function get_datakom ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' GROUP BY a.id_komponen ");
		return $query->result_array();
	}



	public function get_datakom1 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '1' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datakom2 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '2' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_datakom3 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '3' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datakom4 ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT *, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as nilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/a.bobot)*100) as nilaikpersen
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where a.id_komponen = '4' and b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_datasumkom ($tahun,$id_unit)
	{
		$query = $this->db->query("SELECT a.id_komponen, 100 as sumbobot, sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END)) as sumnilaik, 
			((sum((CASE 
			WHEN b.jawaban0ev='100' THEN ('1'*c.bobot2)
			WHEN b.jawaban0ev='90' THEN ('0.9'*c.bobot2)
			WHEN b.jawaban0ev='80' THEN ('0.8'*c.bobot2)
			WHEN b.jawaban0ev='70' THEN ('0.7'*c.bobot2)
			WHEN b.jawaban0ev='60' THEN ('0.6'*c.bobot2)
			WHEN b.jawaban0ev='50' THEN ('0.5'*c.bobot2)
			WHEN b.jawaban0ev='30' THEN ('0.3'*c.bobot2)
			WHEN b.jawaban0ev='0' THEN ('0'*c.bobot2)
			ELSE ''
			END))/100)*100) as sumnilaikpersen 
			 from ref_komponen a inner join ta_ev0 b on a.id_komponen=b.id_komponen inner join ref_subkomponen c on b.id_subkomponen=c.id_subkomponen where b.tahun = '$tahun' and b.id_unit = '$id_unit' ");
		return $query->result_array();
	}


	public function get_data4 ($id_unit)
	{
		$query = $this->db->query("SELECT * from ref_unit where id_unit = '$id_unit' ");
	 return $query->result_array();
	}

	public function join_data ($table,$tbljoin,$join,$tbljoin2,$join2)
	{
		$this->db->join($tbljoin,$join);
		$this->db->join($tbljoin2,$join2);
		return $this->db->get($table)->result_array();
	}


	public function get_load ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT *, count(id_ev) from ta_ev where tahun = $tahun and id_unit = $id_unit ");
		return $query->result_array();
	}

	public function get_loadk ($tahun,$id_unit,$id_ev)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$id_ev = $this->db->escape($id_ev);
		$query = $this->db->query("SELECT *, count(id_konfirmasi) as loadk from ta_konfirmasi where tahun = $tahun and id_unit = $id_unit and id_ev = $id_ev ");
		return $query->result_array();
	}

	public function get_loadk0 ($tahun,$id_unit,$id_ev0)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$id_ev0 = $this->db->escape($id_ev0);
		$query = $this->db->query("SELECT *, count(id_konfirmasi) as loadk0 from ta_konfirmasi where tahun = $tahun and id_unit = $id_unit and id_ev0 = $id_ev0 ");
		return $query->result_array();
	}

	public function get_gage ($tahun,$id_unit,$id_ev)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$id_ev = $this->db->escape($id_ev);
		$query = $this->db->query("SELECT * FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit and id_ev = $id_ev ORDER BY id_konfirmasi DESC
			LIMIT 1 ");
		return $query->result_array();
	}

	public function get_gage0 ($tahun,$id_unit,$id_ev0)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$id_ev0 = $this->db->escape($id_ev0);
		$query = $this->db->query("SELECT * FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit and id_ev0 = $id_ev0 ORDER BY id_konfirmasi DESC
			LIMIT 1 ");
		return $query->result_array();
	}



	public function get_konfirmasinotif ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.* FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev HAVING id_ev IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi ");
	 return $query->result_array();
	}


	public function get_konfirmasi0notif ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT a.id_konfirmasi_last, b.* FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev0 HAVING id_ev0 IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi ");
	 return $query->result_array();
	}

	public function get_konfirmasi0notif2 ($tahun,$id_unit)
	{
		$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
	 $query = $this->db->query("SELECT * FROM ta_ev0 a left join (SELECT a.id_konfirmasi_last, b.* FROM (SELECT *,MAX(id_konfirmasi) as id_konfirmasi_last FROM ta_konfirmasi where tahun = $tahun and id_unit = $id_unit GROUP BY id_ev0 HAVING id_ev0 IS NOT NULL ORDER BY id_konfirmasi_last DESC) a left join ta_konfirmasi b on a.id_konfirmasi_last=b.id_konfirmasi) b on a.id_ev0=b.id_ev0  where a.tahun = $tahun and a.id_unit = $id_unit ");
	 return $query->result_array();
	}


	public function insert_ev ($tahun,$id_unit)
    {
    	$tahun = $this->db->escape($tahun);
		$id_unit = $this->db->escape($id_unit);
		$created_by = $this->session->userdata('username');
    	$modified_by = $this->session->userdata('username');
        $query = $this->db->query("INSERT INTO ta_ev0 (tahun, id_unit, id_pm0, id_ev0, id_dok_ev, id_komponen, id_subkomponen, created_by, modified_by)
        SELECT
        a.tahun,
        a.id_unit,
        a.id_pm0,
        a.id_pm0,
        a.id_dokumen,
        a.id_komponen,
        a.id_subkomponen,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ta_pm0 a
        WHERE
        a.tahun = $tahun and a.id_unit = $id_unit ");


        $query2 = $this->db->query("INSERT INTO ta_ev (tahun, id_unit, id_pm0, id_pm, id_ev0, id_ev, id_dok_ev, id_komponen, id_subkomponen, id_aspek, created_by, modified_by)
        SELECT
        a.tahun,
        a.id_unit,
        a.id_pm0,
        a.id_pm,
        a.id_pm0,
        a.id_pm,
        a.id_dokumen,
        a.id_komponen,
        a.id_subkomponen,
        a.id_aspek,
        '$created_by' AS created_by,
        '$modified_by' AS modified_by
        FROM
        ta_pm a
        WHERE
        a.tahun = $tahun and a.id_unit = $id_unit ");


    }


	public function input_data ($data,$table)
	{
	 $this->db->insert($table,$data); 
	}

	/*public function delete_data ($where,$table){

		$this->db->where($where);
		$this->db->delete($table);
	}*/


	public function update_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function update_status_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function get_rekap_all_units ($tahun)
	{
		$query = $this->db->query("SELECT 
			d.id_unit,
			d.nm_unit,
			SUM(CASE 
				WHEN a.id_komponen = 1 THEN
					(CASE 
						WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
						WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
						WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
						WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
						WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
						WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
						WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
						WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
						ELSE 0
					END)
				ELSE 0
			END) as komp1,
			SUM(CASE 
				WHEN a.id_komponen = 2 THEN
					(CASE 
						WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
						WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
						WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
						WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
						WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
						WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
						WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
						WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
						ELSE 0
					END)
				ELSE 0
			END) as komp2,
			SUM(CASE 
				WHEN a.id_komponen = 3 THEN
					(CASE 
						WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
						WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
						WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
						WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
						WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
						WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
						WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
						WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
						ELSE 0
					END)
				ELSE 0
			END) as komp3,
			SUM(CASE 
				WHEN a.id_komponen = 4 THEN
					(CASE 
						WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
						WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
						WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
						WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
						WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
						WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
						WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
						WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
						ELSE 0
					END)
				ELSE 0
			END) as komp4,
			SUM(CASE 
				WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
				WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
				WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
				WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
				WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
				WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
				WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
				WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
				ELSE 0
			END) as total_nilai,
			(SUM(CASE 
				WHEN b.jawaban0ev='100' THEN (1*c.bobot2)
				WHEN b.jawaban0ev='90' THEN (0.9*c.bobot2)
				WHEN b.jawaban0ev='80' THEN (0.8*c.bobot2)
				WHEN b.jawaban0ev='70' THEN (0.7*c.bobot2)
				WHEN b.jawaban0ev='60' THEN (0.6*c.bobot2)
				WHEN b.jawaban0ev='50' THEN (0.5*c.bobot2)
				WHEN b.jawaban0ev='30' THEN (0.3*c.bobot2)
				WHEN b.jawaban0ev='0' THEN (0*c.bobot2)
				ELSE 0
			END) / 100) * 100 as pemenuhan
		FROM ref_komponen a 
		INNER JOIN ta_ev0 b ON a.id_komponen=b.id_komponen 
		INNER JOIN ref_subkomponen c ON b.id_subkomponen=c.id_subkomponen 
		INNER JOIN ref_unit d ON b.id_unit=d.id_unit
		WHERE b.tahun = '$tahun'
		GROUP BY d.id_unit, d.nm_unit
		ORDER BY d.nm_unit ASC");
		return $query->result_array();
	}

	public function get_rekap_detail_all_units ($tahun)
	{
		$tahun = intval($tahun);
		$ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
		
		$query = $this->db->query("SELECT 
			komp.id_komponen,
			komp.kd_komponen,
			komp.uraian_komponen,
			komp.bobot as bobot_komponen,
			sub.id_subkomponen,
			sub.kd_subkomponen,
			sub.uraian_subkomponen,
			sub.bobot2 as bobot_subkomponen,
			asp.id_aspek,
			asp.kd_aspek,
			asp.uraian_aspek,
			ev0.id_unit,
			ev0.jawaban0ev,
			(CASE 
				WHEN ev0.jawaban0ev='100' THEN (1*sub.bobot2)
				WHEN ev0.jawaban0ev='90' THEN (0.9*sub.bobot2)
				WHEN ev0.jawaban0ev='80' THEN (0.8*sub.bobot2)
				WHEN ev0.jawaban0ev='70' THEN (0.7*sub.bobot2)
				WHEN ev0.jawaban0ev='60' THEN (0.6*sub.bobot2)
				WHEN ev0.jawaban0ev='50' THEN (0.5*sub.bobot2)
				WHEN ev0.jawaban0ev='30' THEN (0.3*sub.bobot2)
				WHEN ev0.jawaban0ev='0' THEN (0*sub.bobot2)
				ELSE 0
			END) as nilai_subkomp,
			ev.jawaban2,
			unit.nm_unit
		FROM ref_komponen komp
		INNER JOIN ref_subkomponen sub ON komp.id_komponen = sub.id_komponen
		LEFT JOIN $ref_aspek_table asp ON sub.id_subkomponen = asp.id_subkomponen
		LEFT JOIN ta_ev0 ev0 ON sub.id_subkomponen = ev0.id_subkomponen AND ev0.tahun = $tahun
		LEFT JOIN ta_ev ev ON asp.id_aspek = ev.id_aspek AND ev0.id_ev0 = ev.id_ev0 AND ev.tahun = $tahun
		LEFT JOIN ref_unit unit ON ev0.id_unit = unit.id_unit
		WHERE komp.id_komponen <= 4
		ORDER BY komp.id_komponen, sub.id_subkomponen, asp.id_aspek, unit.nm_unit");
		
		return $query->result_array();
	}

}

 ?>
