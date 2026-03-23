<?php
class User_model extends CI_Model {

    public function register($data) {
        return $this->db->insert('users', $data);
    }

    public function login($username) {
        // Mencari user berdasarkan username
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }
}