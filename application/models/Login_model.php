<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->table = "user";
	}

	public function checkDuplicate($email)
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->like('email', $email);
		return $this->db->count_all_results();
	}

	public function insertUser($data)
	{
		if($this->db->insert('user', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function update_emp_data($id, $data)
    {
        $where = array('id' => $id);
        $this->db->update('emp_details', $data, $where);
        return $this->db->affected_rows(); 
    } 

	function login_check($login, $password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $login);
        $this->db->where('password', md5($password));
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1){
		   return true;
		}else{
		   return false;
		}
	}

	public function fetch_user_data($username) {
	    $condition = "email =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		   return $query->result();
		} else {
		   return false;
		}
	}

	public function get_all_details($id){
        $this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $id);
		$query = $this->db->get();
        return $query->result();
	}

	public function checkLogin($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    public function save_emp_data($data) {
        $query = $this->db->insert('emp_details', $data);
        return $query;
    }

    public function delete()
    {
        $id = $this->input->post('emp_id');
        $this->db->where('id', $id);
        $this->db->delete('emp_details');

        // $this->db->where('id', $id);
        //$data['status'] = $status;
        // $this->db->update('emp_details', $data);
    }

    public function get_emp_details(){
        $this->db->select('*');
		$this->db->from('emp_details');
		// $this->db->where('status', '1');
		$query = $this->db->get();
        return $query->result();
	}

	public function get_by_id($id)
    {
        $this->db->from('emp_details');
        $this->db->where('id',$id);
        $query = $this->db->get();
  
        return $query->row();
    }
}