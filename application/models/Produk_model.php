<?php
class Produk_model extends CI_Model {

    public function get_all_produk()
    {
        return $this->db->get('produk')->result();
    }

    public function insert_produk($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function get_produk_by_id($id)
    {
        return $this->db->get_where('produk',['id'=>$id])->row();
    }

    public function update_produk($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update('produk',$data);
    }

    public function delete_produk($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('produk');
    }

}