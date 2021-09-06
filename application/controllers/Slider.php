
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Slider_m"); //load model slider
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data Slider";
        //ambil fungsi getAll untuk menampilkan semua data slider
        $data["data_slider"] = $this->Slider_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/slider
        $this->load->view('slider/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data slider
    public function add()
    {
        $slider = $this->Slider_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($slider->rules()); //menerapkan rules validasi pada Slider_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada Slider_m
        if ($validation->run()) {
            $slider->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data slider berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("slider");
        }
        $data["title"] = "Tambah Data slider";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('slider/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('slider');

        $slider = $this->Slider_m;
        $validation = $this->form_validation;
        $validation->set_rules($slider->rules());

        if ($validation->run()) {
            $slider->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data slider berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("slider");
        }
        $data["title"] = "Edit Data slider";
        $data["data_slider"] = $slider->getById($id);
        if (!$data["data_slider"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('slider/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->Slider_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data slider berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}