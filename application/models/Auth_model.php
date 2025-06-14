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

    //cant have more than 50 char
    public function register($data) {
        $user_data = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];

        return $this->db->insert('users', $user_data);
    }

    public function insert_dummy()
    {
        $data = [
            'email' => 'tesgddfgt@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
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
}
