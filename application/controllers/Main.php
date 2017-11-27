<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
	 
	public function index() {
         if ($this->session->userdata('is_logged_in')) {
            $this->load->view('dashboard');
        } else {
            
            $this->load->view('login');
        } 
    }
	
	public function Daily_Report() {
         if ($this->session->userdata('is_logged_in')) {
            $this->load->view('Daily_Report');
        } else {
            
            $this->load->view('login');
        } 
    }
	
		public function Ads_Report() {
         if ($this->session->userdata('is_logged_in')) {
            $this->load->view('Ads_Report');
        } else {
            
            $this->load->view('login');
        } 
    }
	
	
	//Login
	public function login_validation(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
		
        $this->load->library('form_validation');
		
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|sha1|trim|callback_validate_credentials');

        $values = $this->users_model->can_log_in();

            if ($this->form_validation->run()) {
                foreach ($values as $value) {}
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$timestamp = date('Y-m-d h:i:s');
                $data = array(
                    'id' => $value->id,
                    'username' => $value->username,
					'fname' => $value->fname,
					'lname' => $value->lname,
                    'is_logged_in' => 1
                );
				
				$ip = array(
					'user_id' => $value->id,
					'ip_address' => $ip_address,
					'timestamp' => $timestamp
				); 
				
				$this->db->insert('tbl_logs', $ip);
                $this->session->set_userdata($data);
                redirect(base_url());
				//$this->index();
            } else {
                $this->load->view('login');
            }
        
    }
	

    public function validate_credentials() {
        if ($this->users_model->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect Username or Password');
            return false;
        }
    }
	
	public function login() {
            $this->load->view('login'); 
    }
	
	public function logout() {
        $this->session->sess_destroy();
        $this->login();
    }
}
