
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excellence extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Excellence_m"); //load model excellence
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data excellence";
        //ambil fungsi getAll untuk menampilkan semua data excellence
        $data["data_excellence"] = $this->Excellence_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/excellence
        $this->load->view('excellence/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data excellence
    public function add()
    {
        $excellence = $this->Excellence_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($excellence->rules()); //menerapkan rules validasi pada Excellence_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada Excellence_m
        if ($validation->run()) {
            $excellence->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data excellence berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("excellence");
        }
        $data["title"] = "Tambah Data excellence";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('excellence/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('excellence');

        $excellence = $this->Excellence_m;
        $validation = $this->form_validation;
        $validation->set_rules($excellence->rules());

        if ($validation->run()) {
            $excellence->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data excellence berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("excellence");
        }
        $data["title"] = "Edit Data excellence";
        $data["data_excellence"] = $excellence->getById($id);
        if (!$data["data_excellence"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('excellence/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->Excellence_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data excellence berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}