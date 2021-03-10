<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url','form');
	    $this->load->library(['form_validation', 'session']);
        $this->load->database();
	    $this->load->model('Dashboard_model');
	}

	public function index()
	{
		$data['employee_details'] = $this->Dashboard_model->get_emp_details();
		$this->load->view('dashboard', $data);
	}
}