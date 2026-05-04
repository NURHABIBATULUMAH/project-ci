<?php
class Produk_model extends CI_Model {

    // UPDATE: Menambahkan JOIN agar bisa memanggil nama admin/petugas yang menambah barang
    public function get_all_produk() {
        $this->db->select('produk.*, users.username as nama_admin');
        $this->db->from('produk');
        // Pastikan kolom pembandingnya sesuai (misal: user_id di tabel produk)
        $this->db->join('users', 'users.id = produk.user_id', 'left'); 
        return $this->db->get()->result();
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id' => $id])->row();
    }

    public function insert_produk($data) {
        // Otomatis masukkan user_id dari session agar tahu siapa yang menambah barang
        $data['user_id'] = $this->session->userdata('id');
        return $this->db->insert('produk', $data);
    }

    public function update_produk($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }

    public function delete_produk($id) {
        $this->db->where('id', $id);
        return $this->db->delete('produk');
    }
}