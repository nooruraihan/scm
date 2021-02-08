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
    $userSession_data=$this->session->userdata();
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
                if ($_FILES['imageval']['name'] != '') {

                    $target_dir_logo = "images/users/";
                    $filename_logo = $_FILES["imageval"]["name"];
                    foreach ($filename_logo as $key => $tmp_name) 
                    {
                        $filename_logo = $filename_logo[0];
                        $fileName_logo = preg_replace('#[^a-z.0-9]#i', '',
                                $tmp_name);
                        $kaboom_logo = explode(".", $fileName_logo); // Split file name into an array using the dot
                        $fileExt_logo = end($kaboom_logo); // Now target the last array element to get the file extension
                        $fileName_logo = time() . rand() . "." . $fileExt_logo;
                        $target_file_logo = $target_dir_logo . basename($fileName_logo);
                        $imageFileType_logo = pathinfo($target_file_logo,
                                PATHINFO_EXTENSION);
                        $fileTmpLoc = $_FILES["imageval"]["tmp_name"];
                        move_uploaded_file($fileTmpLoc[$key],
                                $target_file_logo);
                        $userData['image'] = $fileName_logo;
                    }
                } 
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

                    $sesdata = array('user_id' => ($alllogins->user_id), 'user_name' => ($alllogins->first_name));
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
    public function welcome()
	{
    $this->load->view('Thankyou');
    }
    public function logout() {
       
            $this->session->sess_destroy();
            redirect(site_url(). '/user/login' );
   
    }
    public function userprofile($userid) {
        $data['userdetails'] = $this->muser_model->getuserById($userid);
        $this->load->view('userprofile', $data);
        
        }
        public function editprofile($userid) {
        $data['userdetails'] = $this->muser_model->getuserById($userid);
        $this->load->view('editprofile', $data);
        
        }
        public function updateuser($userid) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
           
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('birthday', 'Date of Birth ', 'trim|required');
        
            if ($this->form_validation->run() == FALSE) {
                echo"notvalid";
            } 
            else {
                $userData = array();
                $userdetails = $this->muser_model->getuserById($userid);
                $userData['first_name'] = $this->security->xss_clean($this->input->post('fname'));
                $userData['last_name'] = $this->security->xss_clean($this->input->post('lname'));
                $userData['email'] = $this->security->xss_clean($this->input->post('email'));
                $userData['user_name'] = $this->security->xss_clean($this->input->post('email'));
                //$password = $this->security->xss_clean($this->input->post('paswrd'));
                //$password = $this->security->xss_clean($this->input->post('paswrd'));
                $emailcheck = $this->muser_model->alllogins($this->input->post('email'));
                
                if ($emailcheck != '' && $emailcheck->user_id != $userid) {
                   echo "emailalready";
                } else {
                 
                    $date = date('Y-m-d');
                    $userData['dateofbirth'] = $this->security->xss_clean($this->input->post('birthday'));
                    $userData['gender'] = $this->security->xss_clean($this->input->post('gender'));
                    if ($_FILES['imageval']['name'] != '') {
    
                        $target_dir_logo = "images/users/";
                        $filename_logo = $_FILES["imageval"]["name"];
                        foreach ($filename_logo as $key => $tmp_name) 
                        {
                            $filename_logo = $filename_logo[0];
                            $fileName_logo = preg_replace('#[^a-z.0-9]#i', '',
                                    $tmp_name);
                            $kaboom_logo = explode(".", $fileName_logo); 
                            $fileExt_logo = end($kaboom_logo);
                            $fileName_logo = time() . rand() . "." . $fileExt_logo;
                            $target_file_logo = $target_dir_logo . basename($fileName_logo);
                            $imageFileType_logo = pathinfo($target_file_logo,
                                    PATHINFO_EXTENSION);
                            $fileTmpLoc = $_FILES["imageval"]["tmp_name"];
                            if ($fileExt_logo != '')
                            {
                                move_uploaded_file($fileTmpLoc[$key],
                                        $target_file_logo);
                                unlink("images/users/" . $userdetails->image);
                                $userData['image'] = $fileName_logo;
                            }
                        }
                    }
                    else
                    {
                        $userData['image'] = $userdetails->image;
                    } 
                    $insertId = $this->muser_model->update_user($userid,$userData);
                    echo "success";
                }
            }
        }
}