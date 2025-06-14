<?php
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
        $user_data = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => isset($data['is_admin']) ? $data['is_admin'] : 0
        ];

        return $this->db->insert('users', $user_data);
    }

    public function insert_dummy()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'is_admin' => 0
        ];

        return $this->db->insert('users', $data);
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

    public function get_messages() {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('messages')->result();
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
}