<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->table = "emp_details";
	}

	public function get_emp_details(){
        $this->db->select('*');
		$this->db->from($this->table);
		// $this->db->where('id', $id);
		$query = $this->db->get();
        return $query->result();
	}

}