<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['produk']=$this->Produk_model->get_all_produk();
        $this->load->view('list_produk',$data);
    }

    public function tambah()
    {
        $this->load->view('tambah_produk');
    }

    public function simpan()
{
    $this->form_validation->set_rules('nama_produk','Nama Produk','required');
    $this->form_validation->set_rules('email_kontak','Email','required|valid_email');

    if($this->form_validation->run()==FALSE){
        $this->load->view('tambah_produk');
    } else {

            $config['upload_path'] = './upload';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload');
            $this->upload->initialize($config);

                if(!$this->upload->do_upload('gambar')){
                echo "<pre>";
                echo $this->upload->display_errors();
                die();
            } else {

            $upload = $this->upload->data();

            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'deskripsi' => $this->input->post('deskripsi'),
                'email_kontak' => $this->input->post('email_kontak'),
                'gambar' => $upload['file_name']
            ];

            $this->Produk_model->insert_produk($data);

            redirect('produk');
        }
    }
}

    public function edit($id)
    {
        $data['produk']=$this->Produk_model->get_produk_by_id($id);
        $this->load->view('edit_produk',$data);
    }

    public function update($id)
    {
        $data=[
            'nama_produk'=>$this->input->post('nama_produk'),
            'deskripsi'=>$this->input->post('deskripsi'),
            'email_kontak'=>$this->input->post('email_kontak')
        ];

        $this->Produk_model->update_produk($id,$data);
        redirect('produk');
    }

    public function delete($id)
    {
        $this->Produk_model->delete_produk($id);
        redirect('produk');
    }

}