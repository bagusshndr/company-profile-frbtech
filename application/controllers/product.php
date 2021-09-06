
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Product_m"); //load model product
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data product";
        //ambil fungsi getAll untuk menampilkan semua data product
        $data["data_product"] = $this->Product_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/product
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data product
    public function add()
    {
        $product = $this->Product_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($product->rules()); //menerapkan rules validasi pada Product_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada Product_m
        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data product berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("product");
        }
        $data["title"] = "Tambah Data product";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('product/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('product');

        $product = $this->Product_m;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data product berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("product");
        }
        $data["title"] = "Edit Data product";
        $data["data_product"] = $product->getById($id);
        if (!$data["data_product"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('product/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->Product_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data product berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}