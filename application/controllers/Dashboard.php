<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }
        $data['messages'] = $this->Auth_model->get_messages();
        $data['user'] = $this->Auth_model->get_user_by_id($user_id);
        $this->load->view('dashboard', $data);
    }

    public function update_user() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        
        $current_user = $this->Auth_model->get_user_by_id($user_id);

        
        $submitted_data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
        ];

        $password = $this->input->post('password');
        $has_changes = false;

       
        if (
            $submitted_data['first_name'] !== $current_user->first_name ||
            $submitted_data['last_name'] !== $current_user->last_name ||
            $submitted_data['email'] !== $current_user->email
        ) {
            $has_changes = true;
        }

       
        if (!empty($password)) {
           
            $has_changes = true;
            $submitted_data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        
        if ($has_changes) {
            $this->Auth_model->update_user($user_id, $submitted_data);
            $this->session->set_flashdata('success', 'Your profile has been updated successfully.');
        }

        redirect('dashboard');
    }
}