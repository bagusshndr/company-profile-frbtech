
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Services_m"); //load model services
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data services";
        //ambil fungsi getAll untuk menampilkan semua data services
        $data["data_services"] = $this->Services_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/services
        $this->load->view('services/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data services
    public function add()
    {
        $services = $this->Services_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($services->rules()); //menerapkan rules validasi pada Services_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada Services_m
        if ($validation->run()) {
            $services->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data services berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("services");
        }
        $data["title"] = "Tambah Data services";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('services/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('services');

        $services = $this->Services_m;
        $validation = $this->form_validation;
        $validation->set_rules($services->rules());

        if ($validation->run()) {
            $services->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data services berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("services");
        }
        $data["title"] = "Edit Data services";
        $data["data_services"] = $services->getById($id);
        if (!$data["data_services"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('services/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->Services_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data services berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}