
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_m"); //load model user
    }

    //method pertama yang akan di eksekusi
    public function index()
    {

        $data["title"] = "List Data User";
        //ambil fungsi getAll untuk menampilkan semua data user
        $data["data_user"] = $this->User_m->getAll();
        //load view header.php pada folder views/templates
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        //load view index.php pada folder views/user
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    //method add digunakan untuk menampilkan form tambah data user
    public function add()
    {
        $user = $this->User_m; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($user->rules()); //menerapkan rules validasi pada User_m
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada User_m
        if ($validation->run()) {
            $user->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data user berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("user");
        }
        $data["title"] = "Tambah Data user";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('user');

        $user = $this->User_m;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data user berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("user");
        }
        $data["title"] = "Edit Data user";
        $data["data_user"] = $user->getById($id);
        if (!$data["data_user"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->User_m->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data user berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}