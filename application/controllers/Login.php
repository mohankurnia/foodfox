<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $judul['title'] = 'Login';
		$this->load->view('front/partials/header', $judul);
        $this->load->view('front/login');
    }

    public function authenticate() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username', 'trim|required');
        $this->form_validation->set_rules('password','Password', 'trim|required');

        if($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $user = $this->User_model->getByUsername($username);
                if(!empty($user)) {
                    $password = $this->input->post('password');
                    if( password_verify($password, $user['password']) == true) {

                        $userArray['user_id'] = $user['u_id'];
                        $userArray['username'] = $user['username'];
                        $this->session->set_userdata('user', $userArray);
                        redirect(base_url().'home/index');
                    } else {
                        $this->session->set_flashdata('msg', 'Password salah');
                        redirect(base_url().'login/index');
                    }
                } else {
                    $this->session->set_flashdata('msg', 'Username & Password salah');
                    redirect(base_url().'login/index');
                }
        } else {
            $judul['title'] = 'Login';
            $this->load->view('front/partials/header', $judul);
            $this->load->view('front/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect(base_url().'login/index');
    }
}
