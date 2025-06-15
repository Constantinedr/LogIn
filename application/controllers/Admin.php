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

    public function delete_user($user_id) {
        $this->Auth_model->delete_messages_by_user_id($user_id);
        $this->Auth_model->delete_user_by_id($user_id);
        $this->session->set_flashdata('success', 'User and their messages deleted successfully.');
        redirect('admin/dashboard');
    }

    public function edit_user($user_id) {
        $data['user'] = $this->Auth_model->get_user_by_id($user_id);
        if (!$data['user']) {
            show_404();
        }
        $this->load->view('edit_user_form', $data);
    }

    public function update_user($user_id) {
        $submitted_data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $submitted_data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->Auth_model->update_user($user_id, $submitted_data);
        $this->session->set_flashdata('success', 'User updated successfully.');
        redirect('admin/dashboard');
    }

    public function user_messages($user_id) {
        $user = $this->Auth_model->get_user_by_id($user_id);
        if (!$user) {
            show_404();
        }

        $data['user'] = $user;
        $data['messages'] = $this->Auth_model->get_messages_by_user_id($user_id);

        $this->load->view('user_messages', $data);
    }
}