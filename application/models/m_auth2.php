<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth2 extends CI_Model
{

	function cekuser($username)
	{
		$username = $this->db->escape($username);
		$query = $this->db->query("SELECT * FROM ta_user a left join ref_unit b on a.id_unit=b.id_unit where a.username =$username ");
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}


	}

	function ceklogin($username, $password)
	{

		$username = $this->db->escape($username);
		$password = $this->db->escape($password);
		$query = $this->db->query("SELECT * FROM ta_user a left join ref_unit b on a.id_unit=b.id_unit where a.username =$username and a.password = $password ");
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}

	}

	public function get_datauser()
	{

		return $this->db->get('ta_user')->result_array();
	}


	public function update_pass($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_user_by_unit($id_unit)
	{
		return $this->db->where('id_unit', $id_unit)
			->order_by('id_role', 'ASC')
			->get('ta_user')->row();
	}

	public function get_evaluator()
	{
		// Default to some evaluator roles if specific assignment not found
		return $this->db->where_in('id_role', [3, 4, 7])
			->get('ta_user')->row();
	}
}



