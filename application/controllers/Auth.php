<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
    }

    public function login() {
        $this->load->view('login');
    }

    public function registry() {
        $this->load->view('registry');
    }

    public function register_user() {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'confirm_password' => $this->input->post('confirm_password')
        ];

        if ($data['password'] !== $data['confirm_password']) {
            echo "Passwords do not match. <a href='".site_url('auth/registry')."'>Try again</a>";
            return;
        }

        if ($this->Auth_model->get_user_by_email($data['email'])) {
            echo "Email already registered. <a href='".site_url('auth/registry')."'>Try again</a>";
            return;
        }

        if ($this->Auth_model->register($data)) {
           redirect('auth/login');
        } else {
            echo "Registration failed. <a href='".site_url('auth/registry')."'>Try again</a>";
        }
    }

    public function login_user() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Auth_model->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            redirect('dashboard');
        } else {
            echo "Login failed. <a href='".site_url('auth/login')."'>Try again</a>";
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }

    public function create_dummy_user() {
        $this->Auth_model->insert_dummy();
        echo "User created. <a href='".site_url('auth/login')."'>Login</a>";
    }
}
