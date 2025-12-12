<?php 



class Users extends CI_Controller {

	public function __construct()
		{
			parent::__construct();

			if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}

			
		}

	public function index (){
		$this->load->model('m_users');
		

		$data['user']= $this->m_users->get_data();
		$data['unit2']= $this->m_home->get_data2();
		$id_unit = $this->session->userdata('id_unit');
		$tahun = $this->session->userdata('tahun');
		$data['users']= $this->m_users->get_data3($id_unit);
		$data['unit4']= $this->m_home->get_data4($id_unit);
		$data['unites1']= $this->m_users->get_data5();

		$this->load->view('templates/header', $data);

		if ($this->session->userdata('id_role')==4)  {
		$this->load->view('v_users', $data);}
		elseif ($this->session->userdata('id_role')==5)  {
		$this->load->view('v_users', $data);}
		elseif ($this->session->userdata('id_role')==6)  {
		$this->load->view('v_users', $data);}
		elseif ($this->session->userdata('id_role')==7)  {
		$this->load->view('v_users', $data);}else {
		$this->load->view('404', $data);}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);

	}


	function get_data()
    {
        $list = $this->m_users->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // Define the mapping array
    	$role_mapping = array(
        '1' => 'Unit Kerja',
        '2' => 'Pembina',
        '3' => 'Evaluator',
        '4' => 'Admin',
        '5' => 'Admin Unit Kerja',
        '6' => 'Admin Pembina',
        '7' => 'Admin Evaluator',
        '8' => 'No Role'
    );

    	// Define the mapping array
    	$es1_mapping = array(
        '0' => 'Tidak',
        '1' => 'BPKP',
        '2' => 'D1',
        '3' => 'D2',
        '4' => 'D3',
        '5' => 'D4',
        '6' => 'D5',
        '7' => 'Setma'
    );

        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->nipbaru;
            $row[] = $field->golruang;
            $row[] = $field->pangkat;
            $row[] = $field->jabatan;
            $row[] = $field->nm_unit;
            $row[] = isset($es1_mapping[$field->id_unit_es1]) ? $es1_mapping[$field->id_unit_es1] : 'Tidak';
            $row[] = isset($role_mapping[$field->id_role]) ? $role_mapping[$field->id_role] : 'Unknown Role';
            $row[] = '<div class="btn btn-success btn-xs open-modal" data-id_user="'.$field->id_user.'"><i class="fas fa-edit"></i></div>';
            
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_users->count_all(),
            "recordsFiltered" => $this->m_users->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);  
    }

	

public function update_data()
    {
        $this->load->library('form_validation');

   		if ($this->session->userdata('id_role') == 4):                     
        // Define the valid options
        $valid_roles = array('1', '2', '3', '5', '6', '7', '8');
    	endif;
    	if ($this->session->userdata('id_role') == 5):                     
        // Define the valid options
        $valid_roles = array('1', '5', '8');
    	endif;
    	if ($this->session->userdata('id_role') == 6):                     
        // Define the valid options
        $valid_roles = array('1', '2', '5', '6', '8');
    	endif;
    	if ($this->session->userdata('id_role') == 7):                     
        // Define the valid options
        $valid_roles = array('3', '7', '8');
    	endif;

    	if ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==1)  {
		$valid_roles2 = array('1', '7', '409');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==2)  {
		$valid_roles2 = array('2', '328', '329', '330', '331', '332');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==3)  {
		$valid_roles2 = array('3', '333', '334', '335', '336', '337');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==4)  {
		$valid_roles2 = array('4', '338', '339', '340', '341');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==5)  {
		$valid_roles2 = array('5', '342', '343', '344', '345', '346');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==6)  {
		$valid_roles2 = array('6', '347', '348', '349', '350');}

		elseif ($this->session->userdata('id_role')==5 && $this->session->userdata('id_unit_es1')==7)  {
		$valid_roles2 = array('1', '7', '409');}

       
		else {
		}

        // Set validation rules
        $this->form_validation->set_rules('id_user', 'User ID', 'required|integer');
        $this->form_validation->set_rules('id_role', 'Role', 'required|in_list['.implode(',', $valid_roles).']');
        if ($this->session->userdata('id_role') == 5 && ($this->session->userdata('id_unit_es1')==1 || $this->session->userdata('id_unit_es1')==2 || $this->session->userdata('id_unit_es1')==3 || $this->session->userdata('id_unit_es1')==4 || $this->session->userdata('id_unit_es1')==5 || $this->session->userdata('id_unit_es1')==6 || $this->session->userdata('id_unit_es1')==7)):
        $this->form_validation->set_rules('id_unit', 'Unit', 'required|in_list['.implode(',', $valid_roles2).']');
    	endif;

        if ($this->form_validation->run() == FALSE) {
            // Handle validation errors
            // You can redirect back to the form or show errors
            redirect('/users/index');
        } else {
            // Data submission logic here
            $id_user = $this->input->post('id_user');
            $id_role = $this->input->post('id_role');
            $id_unit = $this->input->post('id_unit');
            $id_unit_es1 = $this->input->post('id_unit_es1');
            $modified_by = $this->session->userdata('username');

            // Valid roles mapping
			$roles = [
			    '1' => 'Unit Kerja',
			    '2' => 'Pembina',
			    '3' => 'Evaluator',
			    '4' => 'Admin',
			    '5' => 'Admin Unit Kerja',
			    '6' => 'Admin Pembina',
			    '7' => 'Admin Evaluator',
			    '8' => 'No Role'
			];
            $nm_user = $roles[$id_role];

            // Validate the selected role
            if (!in_array($id_role, $valid_roles)) {
                // Handle the error if an invalid role is detected
                show_error('Invalid role selected.');
            } else {
                $data = array(
                    'id_role'		=> $id_role,
                    'nm_user' 		=> $nm_user,
                    'id_unit' 		=> $id_unit,
                    'id_unit_es1' 	=> $id_unit_es1,
                    'modified_by'	=> $modified_by,
                );

                $where = array(
                    'id_user' => $id_user
                );

                $this->m_users->update_data($where, $data, 'ta_user');
                redirect('/users/index');
            }
        }
    }


	

	
	

}

 ?>