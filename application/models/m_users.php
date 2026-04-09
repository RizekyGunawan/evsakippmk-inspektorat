<?php



class M_users extends CI_Model
{


	var $table = "ref_pegawai"; //nama tabel dari database
	var $column_order = array('nama', 'nipbaru', 'golruang', 'jabatan', 'nm_unit', 'id_unit_es1', 'id_role'); //field yang ada di table user
	var $column_search = array('nama', 'nipbaru', 'golruang', 'jabatan', 'nm_unit', 'id_unit_es1', 'id_role'); //field yang diizin untuk pencarian 
	var $order = array('id_user' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		if ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 1) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 6);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 2) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 1);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 3) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 2);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 4) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 3);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 5) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 4);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 6) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 5);
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 7) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 6);
		} elseif ($this->session->userdata('id_role') == 6) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_induk', 6);
		} elseif ($this->session->userdata('id_role') == 7) {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('c.id_unit', 301);
		} else {
			$this->db->select('*');
			$this->db->from('ref_pegawai a');
			$this->db->join('ta_user b', 'a.nip = b.nip', 'left');
			$this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
			$this->db->where('b.id_unit', $this->session->userdata('id_unit'));
		}



		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_data()
	{

		return $this->db->get('ta_user')->result_array();
	}

	public function get_data3($id_unit)
	{
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT * from ref_pegawai a inner join ta_user b on a.nip=b.nip inner join ref_unit c on b.id_unit=c.id_unit where b.id_unit = $id_unit ");
		return $query->result_array();
	}

	public function get_data5()
	{


		if (($this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6) && $this->session->userdata('id_unit_es1') == 1) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (409) ");
			return $query->result_array();
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 2) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (328,329,330,331,332) ");
			return $query->result_array();
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 3) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (333,334,335,336,337) ");
			return $query->result_array();
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 4) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (338,330,340,341) ");
			return $query->result_array();
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 5) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (342,343,344,345,346) ");
			return $query->result_array();
		} elseif ($this->session->userdata('id_role') == 5 && $this->session->userdata('id_unit_es1') == 6) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (347,348,349,350) ");
			return $query->result_array();
		} elseif (($this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6) && $this->session->userdata('id_unit_es1') == 7) {
			$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (409) ");
			return $query->result_array();
		} else {
			$query = $this->db->query("SELECT * FROM ref_unit ");
			return $query->result_array();
		}



	}



	public function get_data4($id_unit)
	{
		$query = $this->db->query("SELECT * from ref_unit where id_unit = '$id_unit' ");
		return $query->result_array();
	}

	public function get_data2()
	{

		return $this->db->get('ref_unit')->result_array();
	}






	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	// ============================================================
	// METHOD BARU — Admin Role (9)
	// ============================================================

	public function get_all_units()
	{
		return $this->db->order_by('nm_unit')->get('ref_unit')->result_array();
	}

	public function get_users_by_role($id_role)
	{
		$id_role = intval($id_role);
		return $this->db->query("SELECT id_user, nm_user, username FROM ta_user WHERE id_role = $id_role ORDER BY nm_user")->result_array();
	}

	public function cek_username($username)
	{
		$username = $this->db->escape_str($username);
		return $this->db->query("SELECT id_user FROM ta_user WHERE username = '$username' LIMIT 1")->num_rows() > 0;
	}

	public function insert_user(array $data)
	{
		return $this->db->insert('ta_user', $data);
	}

	public function get_new_role_users()
	{
		return $this->db->query(
			"SELECT u.id_user, u.nm_user, u.username, u.id_role, r.nm_unit
			 FROM ta_user u LEFT JOIN ref_unit r ON u.id_unit = r.id_unit
			 ORDER BY 
			   CASE 
			     WHEN u.id_role = 9 THEN 1 
			     WHEN u.id_role BETWEEN 1 AND 8 THEN 2 
			     ELSE 3 
			   END ASC, 
			   u.id_role ASC, 
			   u.nm_user ASC"
		)->result_array();
	}

	public function get_evaluator_assignments()
	{
		return $this->db->query(
			"SELECT eu.*, u.nm_user, u.username, r.nm_unit
			 FROM ta_evaluator_unit eu
			 LEFT JOIN ta_user u ON eu.id_user = u.id_user
			 LEFT JOIN ref_unit r ON eu.id_unit = r.id_unit
			 ORDER BY eu.tahun DESC, u.nm_user"
		)->result_array();
	}

	public function get_user_by_id($id_user)
	{
		$id_user = intval($id_user);
		$query = $this->db->query(
			"SELECT id_user, nm_user, username, id_role, id_unit FROM ta_user WHERE id_user = $id_user LIMIT 1"
		);
		$row = $query->row_array();
		return $row ?: null;
	}

	public function delete_user_by_id($id_user)
	{
		$id_user = intval($id_user);
		return $this->db->where('id_user', $id_user)->delete('ta_user');
	}

}

?>