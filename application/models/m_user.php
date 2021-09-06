<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_user extends CI_Model {
        private $_table = "user";
        
        public $username;
        public $password;
        public $status_id;

        public function rules() {
            return [
                ['field' => 'username',
                'label' => 'Username',
                'rules' => 'required'],
                
                ['field' => 'password',
                'label' => 'Password',
                'rules' => 'required'],
            
                ['field' => 'status_id',
                'label' => 'Status id',
                'rules' => 'required']
            ];
        }

        public function getAll() {
            return $this->db->get($this->_table)->result();
        }
        
        public function getById() {
            return $this->db->get_where($this->_table, ['id' => $id])->row();
        }
        
        public function save() {
            $post = $this->input->post();
            $this->username = $post["username"];
            $this->password = $post["password"];
            $this->status_id = $post["status_id"];
            return $this->db->insert($this->_table, $this);
        }

        public function update() {
            $post = $this->input->post();
            $this->id = $post[$id];
            $this->username = $post["username"];
            $this->password = $post["password"];
            $this->status_id = $post["status_id"];
            return $this->db->update($this->_table, $this, array('id' => $post['id']));
        }
        
        public  function delete() {
            return $this->db->delete($this->_table, array("id" => $id));
        }
    }

?>