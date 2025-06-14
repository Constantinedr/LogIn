<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->library('email');
        $this->config->item('smtp_user'); 
        $this->load->helper(['form', 'url']);
    }

    public function login() {
        $this->load->view('login');
    }

    public function registry() {
        $this->load->view('registry');
    }

    public function LostPass() {
        $this->load->view('LostPass');
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


    public function send_reset_link() {
        $email = $this->input->post('email');

        $user = $this->Auth_model->get_user_by_email($email);
        if (!$user) {
            echo "Email not found. <a href='".site_url('auth/login')."'>Go back</a>";
            return;
        }

        $token = random_string('alnum', 32);
        $this->Auth_model->save_password_reset_token($email, $token);

        $reset_link = site_url('auth/reset_password/' . $token);

        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'lampadarisconstantine@gmail.com', 
            'smtp_pass' => 'ctpizsygdqvyqzbl',   
            'smtp_crypto' => 'tls',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'crlf'      => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('yourgmail@gmail.com', 'Your App Name');
        $this->email->to($email);
        $this->email->subject('Password Reset Request');
        $this->email->message("Click the link below to reset your password:<br><a href='$reset_link'>$reset_link</a>");

        if ($this->email->send()) {
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
            show_error($this->email->print_debugger());
        }
    }

    public function reset_password($token = null) {
        if (!$token) {
            show_404();
        }

        $email = $this->Auth_model->get_email_by_token($token);
        if (!$email) {
            echo "Invalid or expired token.";
            return;
        }

        $data['token'] = $token;
        $this->load->view('reset_password', $data);
    }

    public function update_password() {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $email = $this->Auth_model->get_email_by_token($token);

        if (!$email) {
            echo "Invalid token.";
            return;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->Auth_model->update_password_by_email($email, $hashed);
        $this->Auth_model->clear_reset_token($email);

        redirect('auth/login');
    }
}
