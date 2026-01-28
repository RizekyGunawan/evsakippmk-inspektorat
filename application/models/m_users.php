<?php 



class M_users extends CI_Model {


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
         
        if ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==1)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 6);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==2)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 1);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==3)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 2);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==4)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 3);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==5)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 4);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==6)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 5);}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==7)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 6);}

        elseif ($this->session->userdata('id_role')==6)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_induk', 6);}

        elseif ($this->session->userdata('id_role')==7)  {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('c.id_unit', 301);}

		else {
		$this->db->select('*');
        $this->db->from('ref_pegawai a');
        $this->db->join('ta_user b', 'a.nip = b.nip', 'left');
        $this->db->join('ref_unit c', 'b.id_unit = c.id_unit', 'left');
        $this->db->where('b.id_unit', $this->session->userdata('id_unit'));}

        
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
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

	public function get_data ()
	{

	 return $this->db->get('ta_user')->result_array(); 
	}

	public function get_data3 ($id_unit)
	{
		$id_unit = $this->db->escape($id_unit);
		$query = $this->db->query("SELECT * from ref_pegawai a inner join ta_user b on a.nip=b.nip inner join ref_unit c on b.id_unit=c.id_unit where b.id_unit = $id_unit ");
	 return $query->result_array();
	}

	public function get_data5 ()
	{


		if (($this->session->userdata('id_role')==5 || $this->session->userdata('id_role')==6) && $this->session->userdata('id_unit_es1')==1)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (409) ");
		return $query->result_array();}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==2)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (328,329,330,331,332) ");
		return $query->result_array();}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==3)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (333,334,335,336,337) ");
		return $query->result_array();}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==4)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (338,330,340,341) ");
		return $query->result_array();}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==5)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (342,343,344,345,346) ");
		return $query->result_array();}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==6)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (347,348,349,350) ");
		return $query->result_array();}

		elseif (($this->session->userdata('id_role')==5 || $this->session->userdata('id_role')==6) && $this->session->userdata('id_unit_es1')==7)  {
		$query = $this->db->query("SELECT * FROM ref_unit where id_unit in (409) ");
		return $query->result_array();}



		else {
		$query = $this->db->query("SELECT * FROM ref_unit ");
		return $query->result_array();}

		

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



	
	

	public function update_data ($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

}

 ?>