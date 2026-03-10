<?php 



class Users extends MY_Controller {

	public function __construct()
		{
			parent::__construct(); // MY_Controller handles auth guard
		}

	public function index (){
		$this->load->model('m_users');

		$id_role = (int) $this->session->userdata('id_role');
		$id_unit = $this->session->userdata('id_unit');
		$tahun   = $this->session->userdata('tahun');

		// Admin baru (9) — tampilkan halaman manajemen user khusus
		if ($id_role === 9) {
			$data['unit_list']       = $this->m_users->get_all_units();
			$data['evaluator_list']  = $this->m_users->get_users_by_role(13);
			$data['user_list']       = $this->m_users->get_new_role_users();
			$data['assignment_list'] = $this->m_users->get_evaluator_assignments();

			$this->load->view('templates/header', $data);
			$this->load->view('v_admin_users', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/footer', $data);
			return;
		}

		// Role lama (4,5,6,7) — halaman user lama
		$data['user']   = $this->m_users->get_data();
		$data['unit2']  = $this->m_home->get_data2();
		$data['users']  = $this->m_users->get_data3($id_unit);
		$data['unit4']  = $this->m_home->get_data4($id_unit);
		$data['unites1']= $this->m_users->get_data5();

		$this->load->view('templates/header', $data);

		if (in_array($id_role, [4, 5, 6, 7])) {
			// v_users tidak ada — tampilkan pesan sementara
			echo '<div class="content-wrapper"><section class="content pt-3"><div class="container-fluid"><div class="alert alert-info">Halaman manajemen user untuk role ini sedang dalam pengembangan.</div></div></section></div>';
		} else {
			$this->load->view('404', $data);
		}

		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer', $data);
	}


	/**
	 * Buat user baru (Tim Evaluator / Unit Kerja) — hanya Admin (9)
	 */
	public function create_user()
	{
		$this->_check_role([9]);
		$this->load->model('m_users');

		$nm_user  = $this->input->post('nm_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id_role  = (int) $this->input->post('id_role');
		$id_unit  = $this->input->post('id_unit') ?: null;

		// Validasi sederhana
		if (!in_array($id_role, [13, 14])) {
			$this->session->set_flashdata('error', 'Role tidak valid.');
			redirect('users/index');
			return;
		}

		// Cek username sudah ada
		$cek = $this->m_users->cek_username($username);
		if ($cek) {
			$this->session->set_flashdata('error', 'Username "' . htmlspecialchars($username) . '" sudah digunakan.');
			redirect('users/index');
			return;
		}

		$data = [
			'nm_user'  => $nm_user,
			'username' => $username,
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'id_role'  => $id_role,
			'id_unit'  => ($id_role == 14) ? $id_unit : null,
		];

		$this->m_users->insert_user($data);
		$this->session->set_flashdata('success', 'User "' . htmlspecialchars($username) . '" berhasil dibuat.');
		redirect('users/index');
	}


	/**
	 * Assign Tim Evaluator ke Unit Kerja — hanya Admin (9)
	 */
	public function assign_evaluator()
	{
		$this->_check_role([9]);
		$this->load->model('m_users');

		$id_user    = (int) $this->input->post('id_user');
		$id_unit    = (int) $this->input->post('id_unit');
		$tahun      = (int) $this->input->post('tahun');
		$created_by = $this->session->userdata('username');

		if (!$id_user || !$id_unit || !$tahun) {
			$this->session->set_flashdata('error', 'Data tidak lengkap.');
			redirect('users/index');
			return;
		}

		$data = [
			'id_user'    => $id_user,
			'id_unit'    => $id_unit,
			'tahun'      => $tahun,
			'created_by' => $created_by,
		];

		// Gunakan INSERT IGNORE via raw query untuk hindari duplicate
		$this->db->query(
			"INSERT IGNORE INTO ta_evaluator_unit (id_user, id_unit, tahun, created_by) VALUES (?, ?, ?, ?)",
			[$id_user, $id_unit, $tahun, $created_by]
		);

		$this->session->set_flashdata('success', 'Penugasan evaluator berhasil disimpan.');
		redirect('users/index');
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
        '8' => 'No Role',
        // Role baru
        '9'  => 'Admin (Baru)',
        '10' => 'Ketua Tim',
        '11' => 'Pengendali Teknis',
        '12' => 'Pengendali Mutu',
        '13' => 'Tim Evaluator',
        '14' => 'Unit Kerja (Baru)',
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
    	// Admin baru (role 9): hanya bisa assign Tim Evaluator (13) dan Unit Kerja (14)
    	if ($this->session->userdata('id_role') == 9):
        $valid_roles = array('13', '14');
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

            // Valid roles mapping (termasuk role baru)
			$roles = [
			    '1' => 'Unit Kerja',
			    '2' => 'Pembina',
			    '3' => 'Evaluator',
			    '4' => 'Admin',
			    '5' => 'Admin Unit Kerja',
			    '6' => 'Admin Pembina',
			    '7' => 'Admin Evaluator',
			    '8' => 'No Role',
			    '9'  => 'Admin',
			    '10' => 'Ketua Tim',
			    '11' => 'Pengendali Teknis',
			    '12' => 'Pengendali Mutu',
			    '13' => 'Tim Evaluator',
			    '14' => 'Unit Kerja',
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


	

	
	


	/**
	 * Edit user (nama + password opsional) — hanya Admin (9)
	 */
	public function edit_user()
	{
		$this->_check_role([9]);
		$this->load->model('m_users');

		$id_user     = (int) $this->input->post('id_user');
		$nm_user     = trim($this->input->post('nm_user'));
		$password    = $this->input->post('password');
		$modified_by = $this->session->userdata('username');

		if (!$id_user || !$nm_user) {
			$this->session->set_flashdata('error', 'Data tidak lengkap.');
			redirect('users/index');
			return;
		}

		// Pastikan hanya role 13/14 yang bisa diedit
		$target = $this->m_users->get_user_by_id($id_user);
		if (!$target || !in_array((int)$target['id_role'], [13, 14])) {
			$this->session->set_flashdata('error', 'User tidak valid untuk diedit.');
			redirect('users/index');
			return;
		}

		$data = ['nm_user' => $nm_user, 'modified_by' => $modified_by];

		if (!empty($password)) {
			if (strlen($password) < 6) {
				$this->session->set_flashdata('error', 'Password minimal 6 karakter.');
				redirect('users/index');
				return;
			}
			$data['password'] = password_hash($password, PASSWORD_BCRYPT);
		}

		$this->m_users->update_data(['id_user' => $id_user], $data, 'ta_user');
		$this->session->set_flashdata('success', 'User "' . htmlspecialchars($target['username']) . '" berhasil diperbarui.');
		redirect('users/index');
	}


	/**
	 * Hapus user (soft delete — set status=0) — hanya Admin (9)
	 */
	public function delete_user()
	{
		$this->_check_role([9]);
		$this->load->model('m_users');

		$id_user = (int) $this->input->post('id_user');
		if (!$id_user) {
			$this->session->set_flashdata('error', 'ID user tidak valid.');
			redirect('users/index');
			return;
		}

		$target = $this->m_users->get_user_by_id($id_user);
		if (!$target || !in_array((int)$target['id_role'], [13, 14])) {
			$this->session->set_flashdata('error', 'User tidak dapat dihapus.');
			redirect('users/index');
			return;
		}

		$this->m_users->delete_user_by_id($id_user);
		$this->session->set_flashdata('success', 'User "' . htmlspecialchars($target['username']) . '" berhasil dihapus.');
		redirect('users/index');
	}


	/**
	 * Cabut penugasan evaluator dari unit kerja — hanya Admin (9)
	 */
	public function remove_assignment()
	{
		$this->_check_role([9]);

		$id_assignment = (int) $this->input->post('id_assignment');
		if (!$id_assignment) {
			$this->session->set_flashdata('error', 'ID penugasan tidak valid.');
			redirect('users/index');
			return;
		}

		$this->db->where('id', $id_assignment)->delete('ta_evaluator_unit');
		$this->session->set_flashdata('success', 'Penugasan berhasil dicabut.');
		redirect('users/index');
	}

}

 ?>