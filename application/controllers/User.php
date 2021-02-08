<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Muser', 'muser_model');
        $this->load->library('upload');
         $this->load->library('email');
    }
    public function index()
	{
    $this->load->view('home');
    }
    public function login()
	{
    $this->load->view('login');
    }
    public function signup()
	{
    $this->load->view('signup');
    }
    public function submitregister() {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('paswrd', 'Password', 'trim|required');
        $this->form_validation->set_rules('confpaswrd', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('birthday', 'Date of Birth ', 'trim|required');
        
        $chpassword = $this->security->xss_clean($this->input->post('paswrd'));
        $chconfirmpassword = $this->security->xss_clean($this->input->post('confpaswrd'));
        if ($this->form_validation->run() == FALSE) {
            echo"notvalid";
        } elseif ($chpassword != $chconfirmpassword) {
            echo"passnot";
        } else {
            $userData = array();
            $userData['first_name'] = $this->security->xss_clean($this->input->post('fname'));
            $userData['last_name'] = $this->security->xss_clean($this->input->post('lname'));
            $userData['email'] = $this->security->xss_clean($this->input->post('email'));
            $userData['user_name'] = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('paswrd'));
            $emailcheck = $this->muser_model->emailallCheck($this->input->post('email'));

            if ($emailcheck != '') {
                echo "emailalready";
            } else {
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                $password = hash('sha512', $password . $random_salt);
                $userData['password'] = $password;
                $userData['salt'] = $random_salt;
                $date = date('Y-m-d');
                $userData['dateofbirth'] = $this->security->xss_clean($this->input->post('birthday'));
                $userData['gender'] = $this->security->xss_clean($this->input->post('gender'));
                $insertId = $this->muser_model->insert_user($userData);
                echo "success";
            }
        }
    }
    public function loginsubmit($error = NULL) {

        $this->form_validation->set_rules('usr_name', 'Username', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[50]');
        if ($this->form_validation->run() == false) {
            
        } else {

            $username = $this->security->xss_clean($this->input->post('usr_name'));
            $password = $this->security->xss_clean($this->input->post('password'));
            
            $alllogins = $this->muser_model->alllogins($username);
            
           if ($alllogins != '') {
                $random_salt = $alllogins->salt;
                $current_password = hash('sha512', $password . $random_salt);
                $db_password = $alllogins->password;
               
                if ($db_password == $current_password) {

                    $sesdata = array('admin_idec' => ($alllogins->user_id), 'admin_name' => ($alllogins->first_name));
                    $this->session->set_userdata($sesdata);
                    echo"success";
                } else {
                    echo"fail";
                }
            } else {
                echo"fail";
            }

        }
    }
}