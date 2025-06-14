<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Auth_model');
        if (!$this->session->userdata('is_admin')) {
            redirect('auth/login');
        }
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }
        $data['admin'] = $this->Auth_model->get_user_by_id($user_id);
        $data['users'] = $this->Auth_model->get_all_users();
        $data['messages'] = $this->Auth_model->get_all_messages();
        $this->load->view('admin_dashboard', $data);
    }

    public function update_admin() {
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

        redirect('admin/dashboard');
    }
}