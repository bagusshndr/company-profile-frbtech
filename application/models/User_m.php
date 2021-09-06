<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    private $table = 'user';
    public $username;
    public $password;
    public $status_id;

    //validasi form, method ini akan mengembailkan data berupa rules validasi form       
    public function rules()
    {
        return [
            [
                'field' => 'username',  //samakan dengan atribute name pada tags input
                'label' => 'username',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status_id',
                'label' => 'status_id',
                'rules' => 'trim|required'
            ],
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
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "status_id" => $this->input->post('status_id')
        );
        return $this->db->insert($this->table, $data);
    }

    //edit data mahasiswa
    public function update()
    {
        $data = array(
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
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