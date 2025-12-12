<?php 

class M_home extends CI_Model {

	

	public function get_data4 ($id_unit)
	{
		$query = $this->db->query("SELECT * from ref_unit where id_unit = '$id_unit' ");
	 return $query->result_array();
	}


	public function get_data2 ()
	{

		$id_role = $this->session->userdata('id_role');
        $id_unit_es1 = $this->session->userdata('id_unit_es1');
		if (($id_role==5 || $id_role==1) && $id_unit_es1==1)  {
				
				
				 return $this->db->get('ref_unit')->result_array(); 
				}



		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==2)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (2,328,329,330,331,332) ");
	 			return $query->result_array();
				
				}


		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==3)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (3,333,334,335,336,337) ");
	 			return $query->result_array();
				
				}


		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==4)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (4,338,330,340,341) ");
	 			return $query->result_array();
				
				}



		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==5)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (5,342,343,344,345,346) ");
	 			return $query->result_array();
				
				}


		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==6)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (6,347,348,349,350) ");
	 			return $query->result_array();
				
				}


		elseif (($id_role==5 || $id_role==1) && $id_unit_es1==7)  {
				
				$query = $this->db->query("SELECT * from ref_unit where id_unit in (1,7,409,410,411,412,413) ");
	 			return $query->result_array();
				
      			 }


		else {
				
				 return $this->db->get('ref_unit')->result_array(); 
				
			}
		}
	

}	

 ?>