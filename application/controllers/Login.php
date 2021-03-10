<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url','form');
	    $this->load->library(['form_validation', 'session']);
        $this->load->database();
	    $this->load->model('Login_model');
	}

	public function index()
	{
		$this->load->view('register_view');
	}

	public function add_register(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('input_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[input_password]');

		$this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');

		if($this->form_validation->run() == FALSE){
            $this->load->view('register_view');
		}else{
			$first_name 	= $this->input->post('first_name');
			$last_name 	= $this->input->post('last_name');
			$email 	= $this->input->post('email');
			$mobile 		= $this->input->post('mobile');
			$input_password 	= $this->input->post('input_password');
			$hashPassword = md5($input_password);

			$insert_data = array(
			    'first_name' => $first_name,
			    'last_name' => $last_name,
			    'email' => $email,
			    'contact_no' => $mobile,
			    'password' => $hashPassword
			);

			$checkDuplicate = $this->Login_model->checkDuplicate($email);

			if($checkDuplicate == 0){
                $insertUser = $this->Login_model->insertUser($insert_data);
			
				if($insertUser)
				{
					$data['status'] = 'true';
					$data['message_display'] = 'New User Register Successfully.';
					$this->load->view('register_view',$data);
				}
				else
				{   
					$data['status'] = 'false';
					$data['error_message'] = 'Unable to save user. Please try again';
					$this->load->view('register_view',$data);
				}
			}else{
				$data['status'] = 'false';
                $data['message_display'] = 'User email alreary exists';
				$this->load->view('register_view',$data);
			}
		}	
		
	}

	public function add_login() {

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('input_password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				$data['employee_details'] = $this->Login_model->get_emp_details();
			    $this->load->view('dashboard', $data);
			}else{
			   $this->load->view('login_view');
			}
		} else {
			$login = $this->input->post('email');
	        $password = $this->input->post('input_password');

	        $result = $this->Login_model->login_check($login, $password);

			if ($result == TRUE) {
				$username = $this->input->post('email');
				$result = $this->Login_model->fetch_user_data($username);
				// print_r($result);exit;
				if ($result != false) {
					$data = array(
						'first_name' => $result[0]->first_name,
						'last_name' => $result[0]->last_name,
						'email' => $result[0]->email,
						'mobile' => $result[0]->contact_no,
						'id' => $result[0]->emp_id,
					);

					$session_data = array(
						'first_name' => $result[0]->first_name,
						'last_name' => $result[0]->last_name,
						'email' => $result[0]->email,
						'mobile' => $result[0]->contact_no,
						'id' => $result[0]->emp_id,
					);
					$this->session->set_userdata('logged_in', $session_data);

					$data['status'] = 'true';
					$data['message_display'] = 'Login Successfully.';

					$data['employee_details'] = $this->Login_model->get_emp_details();
					
					$this->load->view('dashboard', $data);
				}
			} else {
				$data['status'] = 'false';
				$data['error_message'] = 'Please enter valid email and password';
				$this->load->view('login_view', $data);
			}
		}
	}

	public function logout(){
		$sess_array = array(
		   'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);

		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_view', $data);
	}

	public function save_emp_details(){

		$id = $this->input->post('emp_id');

		if($id){
            $name = $this->input->post('name');
	        $salary = $this->input->post('salary');

	        $data = array(
	            'name' => $name,
	            'salary' => $salary,
	            'updated_on' => date('Y-m-d H:i:s')
	        );
	        
	        $data_pro = $this->Login_model->update_emp_data($id, $data);

	        echo json_encode(array("status" => 'true' , 'msg' => 'Data update Successfully.'));
		}else{
            $name = $this->input->post('name');
	        $salary = $this->input->post('salary');

	        $data = array(
	            'name' => $name,
	            'salary' => $salary,
	            'created_on' => date('Y-m-d H:i:s')
	        );
	        
	        $data_pro = $this->Login_model->save_emp_data($data);

	        echo json_encode(array("status" => 'true' , 'msg' => 'Data inserted Successfully.'));
		}
		
	}

	public function delete()
    {
        $this->Login_model->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function get_product_by_id()
    {
        $id = $this->input->post('emp_id');
         
        $data = $this->Login_model->get_by_id($id);
          
        $arr = array('success' => false, 'data' => '');
        if($data){
        $arr = array('success' => true, 'data' => $data);
        }
        echo json_encode($arr);
    }

}
