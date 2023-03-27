<?php

class UserModel extends CI_Model{

		public function __construct()
	{
		parent::__construct();
		$this->load->model('TagModel');
	}

	function getUser($email)
	{
		$this->db->where('email', $email);
		$user = $this->db->get('user');
		$data = $user->result_array();

		if(count($data) > 0){
			return $data[0];
		}
		else{
			return null;
		}
	}

	function getPassword($email)
	{
		$this->db->where('email', $email);
		$user = $this->db->get('user');
		$data = $user->result_array();

		if(count($data) > 0){
			return $data[0]['password'];
		}
		else{
			return null;
		}
	}

	function checkLogin($email,$password){

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$query = $this->db->get();
		$data = $query->result_array();

		if(count($data) > 0){
			return $data[0];
		}
		else{
			return null;
		}
	}

	function signup($data){
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function checkUserIsExist($email, $password)
	{
		$query = $this->db->where('email', $email)->where('password', $password)->get('user');

		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function checkDisplayNameIsExist($displayName)
	{
		$query = $this->db->where('display_name', $displayName)->get('user');

		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function checkEmailIsExist($email)
	{
		$query = $this->db->where('email', $email)->get('user');

		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}
?>
