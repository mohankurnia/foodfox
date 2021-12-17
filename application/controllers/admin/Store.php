<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Store extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Session telah habis');
            redirect(base_url().'admin/login/index');
        }
    }

    public function index() {
        $this->load->model('Store_model');
        $stores = $this->Store_model->getStores();
        $store_data['stores'] = $stores;
        $judul['title'] = 'Restaurant';
        $this->load->view('admin/partials/header', $judul);
        $this->load->view('admin/store/list', $store_data);
        $this->load->view('admin/partials/footer');
    }

    public function create_restaurant() {

        $this->load->model('Category_model');
        $cat = $this->Category_model->getCategory();

        $this->load->helper('common_helper');

        $config['upload_path'] = './public/uploads/restaurant/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);

        $this->load->model('Store_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('res_name', 'Restaurant name','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');
        $this->form_validation->set_rules('url', 'URL','trim|required');
        $this->form_validation->set_rules('o_hr', 'o_hr','trim|required');
        $this->form_validation->set_rules('c_hr', 'c_hr','trim|required');
        $this->form_validation->set_rules('o_days', 'o_days','trim|required');
        $this->form_validation->set_rules('c_name', 'category','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) {
            if(!empty($_FILES['image']['name'])){
                if($this->upload->do_upload('image')) {
                    $data = $this->upload->data();
                    resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].'thumb/'.$data['file_name'], 300,270);
                    
                    $formArray['img'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('res_name');
                    $formArray['email'] = $this->input->post('email');
                    $formArray['phone'] = $this->input->post('phone');
                    $formArray['url'] = $this->input->post('url');
                    $formArray['o_hr'] = $this->input->post('o_hr');
                    $formArray['c_hr'] = $this->input->post('c_hr');
                    $formArray['o_days'] = $this->input->post('o_days');
                    $formArray['c_id'] = $this->input->post('c_name');
                    $formArray['address'] = $this->input->post('address');
        
                    $this->Store_model->create($formArray);
        
                    $this->session->set_flashdata('res_success', 'Restaurant berhasil ditambahkan');
                    redirect(base_url(). 'admin/store/index');
                } else {
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorImageUpload'] = $error;
                    $data['cats'] = $cat;
                    $judul['title'] = 'Tambah Restaurant';
                    $this->load->view('admin/partials/header', $judul);
                    $this->load->view('admin/store/add_res', $data);
                    $this->load->view('admin/partials/footer');
                }

                
            } else {
                $formArray['name'] = $this->input->post('res_name');
                $formArray['email'] = $this->input->post('email');
                $formArray['phone'] = $this->input->post('phone');
                $formArray['url'] = $this->input->post('url');
                $formArray['o_hr'] = $this->input->post('o_hr');
                $formArray['c_hr'] = $this->input->post('c_hr');
                $formArray['o_days'] = $this->input->post('o_days');
                $formArray['c_id'] = $this->input->post('c_name');
                $formArray['address'] = $this->input->post('address');
    
                $this->Store_model->create($formArray);
    
                $this->session->set_flashdata('res_success', 'Restaurant berhasil ditambahkan');
                redirect(base_url(). 'admin/store/index');
            }

        } else {
            $data['cats'] = $cat;
            $judul['title'] = 'Tambah Restaurant';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/store/add_res', $data);
            $this->load->view('admin/partials/footer');
        }
        
    }

    public function edit($id) {
        $this->load->model('Store_model');
        $store = $this->Store_model->getStore($id);

        $this->load->model('Category_model');
        $cat = $this->Category_model->getCategory();

        if(empty($store)) {
            $this->session->set_flashdata('error', 'Restaurant tidak ditemukan');
            redirect(base_url().'admin/store/index');
        }

        $this->load->helper('common_helper');

        $config['upload_path'] = './public/uploads/restaurant/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('res_name', 'Restaurant name','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');
        $this->form_validation->set_rules('url', 'URL','trim|required');
        $this->form_validation->set_rules('o_hr', 'o_hr','trim|required');
        $this->form_validation->set_rules('c_hr', 'c_hr','trim|required');
        $this->form_validation->set_rules('o_days', 'o_days','trim|required');
        $this->form_validation->set_rules('c_name', 'category','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) {

            if(!empty($_FILES['image']['name'])){
                if($this->upload->do_upload('image')) {
                    $data = $this->upload->data();
                    resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].'thumb/'.$data['file_name'], 300,270);

                    $formArray['img'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('res_name');
                    $formArray['email'] = $this->input->post('email');
                    $formArray['phone'] = $this->input->post('phone');
                    $formArray['url'] = $this->input->post('url');
                    $formArray['o_hr'] = $this->input->post('o_hr');
                    $formArray['c_hr'] = $this->input->post('c_hr');
                    $formArray['o_days'] = $this->input->post('o_days');
                    $formArray['c_id'] = $this->input->post('c_name');
                    $formArray['address'] = $this->input->post('address');
        
                    $this->Store_model->update($id, $formArray);

                    if (file_exists('./public/uploads/restaurant/'.$store['img'])) {
                        unlink('./public/uploads/restaurant/'.$store['img']);
                    }

                    if(file_exists('./public/uploads/restaurant/thumb/'.$store['img'])) {
                        unlink('./public/uploads/restaurant/thumb/'.$store['img']);
                    }

                    $this->session->set_flashdata('res_success', 'Restaurant berhasil diubah');
                    redirect(base_url(). 'admin/store/index');

                } else {
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorImageUpload'] = $error;
                    $data['store'] = $store;
                    $data['cats'] = $cat;
                    $judul['title'] = 'Edit Restaurant';
                    $this->load->view('admin/partials/header', $judul);
                    $this->load->view('admin/store/edit', $data);
                    $this->load->view('admin/partials/footer');
                }
            } else {
                $formArray['name'] = $this->input->post('res_name');
                $formArray['email'] = $this->input->post('email');
                $formArray['phone'] = $this->input->post('phone');
                $formArray['url'] = $this->input->post('url');
                $formArray['o_hr'] = $this->input->post('o_hr');
                $formArray['c_hr'] = $this->input->post('c_hr');
                $formArray['o_days'] = $this->input->post('o_days');
                $formArray['c_id'] = $this->input->post('c_name');
                $formArray['address'] = $this->input->post('address');
    
                $this->Store_model->update($id ,$formArray);
    
                $this->session->set_flashdata('res_success', 'Restaurant berhasil diubah');
                redirect(base_url(). 'admin/store/index');
            }
        } else {
            $data['store'] = $store;
            $data['cats'] = $cat;
            $judul['title'] = 'Edit Restaurant';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/store/edit', $data);
            $this->load->view('admin/partials/footer');
        }

    }

    public function delete($id){

        $this->load->model('Store_model');
        $store = $this->Store_model->getStore($id);

        if(empty($store)) {
            $this->session->set_flashdata('error', 'Restaurant tidak ditemukan');
            redirect(base_url().'admin/store');
        }

        if (file_exists('./public/uploads/restaurant/'.$store['img'])) {
            unlink('./public/uploads/restaurant/'.$store['img']);
        }

        if(file_exists('./public/uploads/restaurant/thumb/'.$store['img'])) {
            unlink('./public/uploads/restaurant/thumb/'.$store['img']);
        }

        $this->Store_model->delete($id);

        $this->session->set_flashdata('res_success', 'Restaurant berhasil dihapus');
        redirect(base_url().'admin/store/index');

    }
}