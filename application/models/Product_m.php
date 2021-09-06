<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_m extends CI_Model
{
    private $table = 'product';
    public $nama;
    public $deskripsi;
    public $foto;
    public $link;
    public $status_id;

    //validasi form, method ini akan mengembailkan data berupa rules validasi form       
    public function rules()
    {
        return [
            [
                'field' => 'nama',  //samakan dengan atribute name pada tags input
                'label' => 'nama',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'deskripsi',
                'label' => 'deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'foto',
                'label' => 'foto',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'link',
                'label' => 'link',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status_id',
                'label' => 'status_id',
                'rules' => 'trim|required'
            ]
        ];
    }

    //menampilkan data mahasiswa berdasarkan id mahasiswa
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
        //query diatas seperti halnya query pada mysql 
        //select * from mahasiswa where id='$id'
    }

    //menampilkan semua data mahasiswa
    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
        //fungsi diatas seperti halnya query 
        //select * from mahasiswa order by id desc
    }

    //menyimpan data mahasiswa
    public function save()
    {
        $data = array(
            "nama" => $this->input->post('nama'),
            "deskripsi" => $this->input->post('deskripsi'),
            "foto" => $this->input->post('foto'),
            "link" => $this->input->post('link'),
            "status_id" => $this->input->post('status_id')
        );
        return $this->db->insert($this->table, $data);
    }

    //edit data mahasiswa
    public function update()
    {
        $data = array(
            "nama" => $this->input->post('nama'),
            "deskripsi" => $this->input->post('deskripsi'),
            "foto" => $this->input->post('foto'),
            "link" => $this->input->post('link'),
            "status_id" => $this->input->post('status_id')
        );
        return $this->db->update($this->table, $data, array('id' => $this->input->post('id')));
    }

    //hapus data mahasiswa
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }

    public function _uploadGambar()
    {
        $config['upload_path']          = './upload/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->id;
        $config['overwrite']			= true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }
}