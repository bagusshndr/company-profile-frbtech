
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Client_m"); //load model client
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data client";
        //ambil fungsi getAll untuk menampilkan semua data client
        $data["data_client"] = $this->Client_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/client
        $this->load->view('client/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data client
    public function add()
    {
        $client = $this->Client_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($client->rules()); //menerapkan rules validasi pada Client_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada Client_m
        if ($validation->run()) {
            $client->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data client berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("client");
        }
        $data["title"] = "Tambah Data client";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('client/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('client');

        $client = $this->Client_m;
        $validation = $this->form_validation;
        $validation->set_rules($client->rules());

        if ($validation->run()) {
            $client->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data client berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("client");
        }
        $data["title"] = "Edit Data client";
        $data["data_client"] = $client->getById($id);
        if (!$data["data_client"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('client/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->Client_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data client berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}