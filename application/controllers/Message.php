<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    public function submit() {
        $data = [
            'message' => $this->input->post('message'),
            'user_id' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->Auth_model->save_message($data);
        redirect('dashboard');
    }
}
