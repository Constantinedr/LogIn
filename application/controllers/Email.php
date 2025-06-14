<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailReset extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('email');
        $this->load->helper(['url', 'string']);
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

        $reset_link = site_url('emailReset/reset_password/'.$token);
        $this->email->from('noreply@example.com', 'Your App Name');
        $this->email->to($email);
        $this->email->subject('Password Reset Request');
        $this->email->message("Click the link below to reset your password:\n\n$reset_link");

        if ($this->email->send()) {
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
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

        echo "Password updated successfully. <a href='".site_url('auth/login')."'>Login</a>";
    }
}
