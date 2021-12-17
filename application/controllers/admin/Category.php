<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Session telah habis');
            redirect(base_url().'admin/login/index');
        }
    }

    public function index() {
        $this->load->model('Category_model');
        $cats = $this->Category_model->getCategory();
        $cats_data['cats'] = $cats;
        $judul['title'] = 'Category';
        $this->load->view('admin/partials/header', $judul);
        $this->load->view('admin/category/list', $cats_data);
        $this->load->view('admin/partials/footer');
    }

    public function create_category() {
        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category', 'trim|required');

        if($this->form_validation->run() == true) {
            $cat['c_name'] = $this->input->post('category');
            $this->Category_model->create_cat($cat);
            $this->session->set_flashdata('cat_success', 'Category berhasil ditambahkan');
            redirect(base_url().'admin/category/index');
        } else {
            $judul['title'] = 'Tambah Category';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/category/add_cat');
            $this->load->view('admin/partials/footer');
        }
    }

    public function edit($id) {
        $this->load->model('Category_model');
        $cat = $this->Category_model->getCat($id);
        if(empty($cat)) {
            $this->session->set_flashdata('error', 'Category tidak ditemukan');
            redirect(base_url().'admin/category/index');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category', 'trim|required');

        if($this->form_validation->run() == true) {

            $cat['c_name'] = $this->input->post('category');
            $this->Category_model->update($id, $cat);
            
            $this->session->set_flashdata('cat_success', 'Category berhasil diubah');
            redirect(base_url().'admin/category/index');

        } else {
            $data['cat'] = $cat;
            $judul['title'] = 'Edit Category';
            $this->load->view('admin/partials/header', $judul);
            $this->load->view('admin/category/edit', $data);
            $this->load->view('admin/partials/footer');
        }

    }

    public function delete($id) {
        $this->load->model('Category_model');
        $cat = $this->Category_model->getCat($id);

        if(empty($cat)) {
            $this->session->set_flashdata('error', 'Category tidak ditemukan');
            redirect(base_url().'admin/category/index');
        }

        $cat = $this->Category_model->delete($id);

        $this->session->set_flashdata('cat_success', 'Category berhasil dihapus');
        redirect(base_url().'admin/category/index');
    }
}