<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Session telah habis');
            redirect(base_url().'admin/login/index');
        }
    }

    public function index() {
        $this->load->model('User_model');
        $users = $this->User_model->getUsers();
        $data['users'] = $users;
        $judul['title'] = 'Users';
        $this->load->view('admin/partials/header', $judul);
        $this->load->view('admin/user/list', $data);
        $this->load->view('admin/partials/footer');
    }

    public function create_user() {

        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('firstname', 'First Name','trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) {
            $formArray['username'] = $this->input->post('username');
            $formArray['f_name'] = $this->input->post('firstname');
            $formArray['l_name'] = $this->input->post('lastname');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['phone'] = $this->input->post('phone');
            $formArray['address'] = $this->input->post('address');


            $this->User_model->create($formArray);

            $this->session->set_flashdata('success', 'User berhasil ditambahkan');
            redirect(base_url(). 'admin/user/index');
        } else {
            $judul['title'] = 'Tambah Users';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/user/add_user');
            $this->load->view('admin/partials/footer');
        }
        
    }

    public function edit($id) {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($id);

        if(empty($user)) {
            $this->session->set_flashdata('error', 'User tidak ditemukan');
            redirect(base_url().'admin/user/index');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('firstname', 'First Name','trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) { 

            $formArray['username'] = $this->input->post('username');
            $formArray['f_name'] = $this->input->post('firstname');
            $formArray['l_name'] = $this->input->post('lastname');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['phone'] = $this->input->post('phone');
            $formArray['address'] = $this->input->post('address');


            $this->User_model->update($id,$formArray);

            $this->session->set_flashdata('success', 'User berhasil diubah');
            redirect(base_url(). 'admin/user/index');
        } else {
            $data['user'] = $user;
            $judul['title'] = 'Edit User';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/user/edit', $data);
            $this->load->view('admin/partials/footer');
        }
    }

    public function delete($id) {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($id);

        if(empty($user)) {
            $this->session->set_flashdata('error', 'User tidak ditemukan');
            redirect(base_url().'admin/user/index');
        }

        $this->User_model->delete($id);

        $this->session->set_flashdata('success', 'User berhasil dihapus');
        redirect(base_url().'admin/user/index');

    }

}