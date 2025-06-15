<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function save_message($data) {
        $this->db->insert('messages', $data);
    }

    public function register($data) {
        $verification_token = random_string('alnum', 64);

        $user_data = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => isset($data['is_admin']) ? $data['is_admin'] : 0,
            'email_verified' => 0,
            'verification_token' => $verification_token
        ];

        if ($this->db->insert('users', $user_data)) {
            return $verification_token;
        }

        return false;
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function login($username, $password)
    {
        $query = $this->db->get_where('users', ['username' => $username]);
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function delete_user_by_id($id) {
        $this->db->where('id', $id)->delete('users');
    }

    public function delete_messages_by_user_id($user_id) {
        $this->db->where('user_id', $user_id)->delete('messages');
    }

    public function verify_email($token) {
        $this->db->where('verification_token', $token);
        $this->db->where('email_verified', 0);
        return $this->db->update('users', ['email_verified' => 1, 'verification_token' => null]);
    }

    public function get_user_by_token($token) {
        return $this->db->get_where('users', ['verification_token' => $token])->row();
    }

    public function get_messages() {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('messages')->result();
    }

    public function get_all_users() {
        $this->db->select('id, first_name, last_name, email, is_admin');
        $this->db->where('is_admin', 0);
        $this->db->order_by('id', 'ASC');
        return $this->db->get('users')->result();
    }

    public function get_all_messages() {
        $this->db->select('messages.*, users.email as user_email');
        $this->db->from('messages');
        $this->db->join('users', 'messages.user_id = users.id', 'left');
        $this->db->where('users.is_admin', 0);
        $this->db->order_by('messages.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function save_password_reset_token($email, $token) {
        return $this->db->where('email', $email)
                        ->update('users', ['reset_token' => $token, 'token_created_at' => date('Y-m-d H:i:s')]);
    }

    public function get_email_by_token($token) {
        $query = $this->db->get_where('users', ['reset_token' => $token]);
        $user = $query->row();
        return $user ? $user->email : false;
    }

    public function update_password_by_email($email, $hashed_password) {
        return $this->db->where('email', $email)
                        ->update('users', ['password' => $hashed_password]);
    }

    public function clear_reset_token($email) {
        return $this->db->where('email', $email)
                        ->update('users', ['reset_token' => null, 'token_created_at' => null]);
    }

    public function get_messages_by_user_id($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->order_by('created_at', 'DESC')
                        ->get('messages')
                        ->result();
    }
}