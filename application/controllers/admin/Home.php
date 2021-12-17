<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Session telah habis');
            redirect(base_url().'admin/login/index');
        }
        $this->load->model('Admin_model');
        $this->load->model('Store_model');
        $this->load->model('Menu_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->model('Category_model');
    }
    public function index() {
        $data['countStore'] = $this->Store_model->countStore();
        $data['countDish'] = $this->Menu_model->countDish();
        $data['countUser'] = $this->User_model->countUser();
        $data['countOrders'] = $this->Order_model->countOrders();
        $data['countCategory'] = $this->Category_model->countCategory();
        $data['countPendingOrders'] = $this->Order_model->countPendingOrders();
        $data['countDeliveredOrders'] = $this->Order_model->countDeliveredOrders();
        $data['countRejectedOrders'] = $this->Order_model->countRejectedOrders();

        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;

        $dishReport = $this->Admin_model->dishReport();
        $data['dishReport'] = $dishReport;
        $judul['title'] = 'Admin Dashboard';
        $this->load->view('admin/partials/header', $judul);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/partials/footer');
    }

    public function resReport() {
        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;
        $this->load->view('admin/reports/res_report', $data);
    }
    
    public function dishesReport() {
        $dishReport = $this->Admin_model->dishReport();
        $data['dishReport'] = $dishReport;
        $this->load->view('admin/reports/dish_report', $data);
    }

    public function usersReport() {
        echo "user";
    }

    public function ordersReport() {
        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;

        $this->load->view('admin/partials/header');
        $this->load->view('admin/reports/res_report', $data);
        $this->load->view('admin/partials/footer');
    }
    public function generate_pdf($id) {
        $this->load->library('Pdf');
        
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('www.foodfox.com');
        $pdf->SetTitle('Report');
        $pdf->SetSubject('Report generated using Codeigniter and TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');
    
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
        $pdf->SetFont('times', 'B', 12);
        
        $template = array(
            'table_open' => '<table border="1" cellpadding="2" cellspacing="1">'
        );
    
        $this->table->set_template($template);

        if($id == 1) {
            $resReport = $this->Admin_model->getResReport();
            $this->table->set_heading('Id', 'Restaurants', 'Total Penjualan');
            foreach ($resReport as $sf):
                $this->table->add_row($sf->r_id, $sf->name, $sf->price);
            endforeach; 

        } else if($id == 2) {
            $this->table->set_heading('Id', 'Nama Makanan', 'total berapa kali hidangan dipesan');
            $dishReport = $this->Admin_model->dishReport();
            foreach ($dishReport as $sf):
                $this->table->add_row($sf->d_id, $sf->d_name, $sf->qty);
            endforeach;
            
        } else {
            redirect(base_url(). 'admin/home');
        }
        
        $html = $this->table->generate();
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        $pdf->Output(md5(time()).'.pdf', 'I');
    }
}
