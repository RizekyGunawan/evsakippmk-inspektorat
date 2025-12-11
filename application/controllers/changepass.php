<?php 
class Changepass extends CI_Controller 
{
	public function __construct()
	{
		
		parent::__construct();
		if ($this->session->userdata('id_role')==null) {
				redirect('auth2/index');
			}
	}       
	
	public function change_pass()
	{
		if($this->input->post('change_pass'))
		{
			$old_pass=$this->input->post('old_pass');
			$new_pass=$this->input->post('new_pass');
			$confirm_pass=$this->input->post('confirm_pass');
			$session_id=$this->session->userdata('id');
			$que=$this->db->query("select * from user_login where id='$session_id'");
			$row=$que->row();
			if((!strcmp($old_pass, $pass))&& (!strcmp($new_pass, $confirm_pass))){
				$this->Form_model->change_pass($session_id,$new_pass);
				echo "Password changed successfully !";
				}
			    else{
					echo "Invalid";
				}
		}
		$this->load->view('change_pass');	
	}
}
?>