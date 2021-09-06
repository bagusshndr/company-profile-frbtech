<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetCon_m extends CI_Model
{
    private $table = 'setting_contact';
    public $alamat;
    public $no_telp;
    public $email;
    public $instagram;
    public $linkedin;
    public $whatsapp;
    public $status_id;

    //validasi form, method ini akan mengembailkan data berupa rules validasi form       
    public function rules()
    {
        return [
            [
                'field' => 'alamat',  //samakan dengan atribute name pada tags input
                'label' => 'alamat',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'no_telp',
                'label' => 'no_telp',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'instagram',
                'label' => 'instagram',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'linkedin',
                'label' => 'linkedin',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'whatsapp',
                'label' => 'whatsapp',
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
            "alamat" => $this->input->post('alamat'),
            "no_telp" => $this->input->post('no_telp'),
            "email" => $this->input->post('email'),
            "instagram" => $this->input->post('instagram'),
            "linkedin" => $this->input->post('linkedin'),
            "whatsapp" => $this->input->post('whatsapp'),
            "status_id" => $this->input->post('status_id')
        );
        return $this->db->insert($this->table, $data);
    }

    //edit data mahasiswa
    public function update()
    {
        $data = array(
            "alamat" => $this->input->post('alamat'),
            "no_telp" => $this->input->post('no_telp'),
            "email" => $this->input->post('email'),
            "instagram" => $this->input->post('instagram'),
            "linkedin" => $this->input->post('linkedin'),
            "whatsapp" => $this->input->post('whatsapp'),
            "status_id" => $this->input->post('status_id')
        );
        return $this->db->update($this->table, $data, array('id' => $this->input->post('id')));
    }

    //hapus data mahasiswa
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}