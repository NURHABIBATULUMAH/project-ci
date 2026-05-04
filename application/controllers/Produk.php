<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load semua library dan model yang dibutuhkan
        $this->load->model('Produk_model');
        $this->load->library(['form_validation', 'upload', 'session']);
        $this->load->helper(['url', 'form']);

        // Proteksi: Jika belum login, tendang ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    /**
     * TAMPILAN DASHBOARD / DAFTAR BARANG
     */
    public function index() {
        // Menghitung jumlah request pending untuk badge notifikasi admin
        $data['notif_count'] = $this->db->where('status', 'pending')->count_all_results('peminjaman');
        $data['produk'] = $this->Produk_model->get_all_produk();
        $data['username'] = $this->session->userdata('username'); 
        $data['role'] = $this->session->userdata('role'); 
        $this->load->view('list_produk', $data);
    }

    /**
     * FITUR CRUD PRODUK (TAMBAH, EDIT, UPDATE, HAPUS)
     */
    public function tambah() {
        $this->load->view('tambah_produk');
    }

    public function simpan() {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->upload->initialize($config);

        if ($this->upload->do_upload('gambar')) {
            $data = [
                'nama_produk'  => $this->input->post('nama_produk'),
                'stok'         => $this->input->post('stok'),
                'deskripsi'    => $this->input->post('deskripsi'),
                'email_kontak' => $this->input->post('email_kontak'),
                'gambar'       => $this->upload->data('file_name')
            ];
            $this->Produk_model->insert_produk($data);
            redirect('produk');
        }
    }

    public function edit($id) {
        $data['produk'] = $this->Produk_model->get_produk_by_id($id);
        $this->load->view('edit_produk', $data);
    }

    public function update($id) { 
        $data = [
            'nama_produk'  => $this->input->post('nama_produk'),
            'stok'         => $this->input->post('stok'),
            'deskripsi'    => $this->input->post('deskripsi'),
            'email_kontak' => $this->input->post('email_kontak')
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('gambar')) {
                $data['gambar'] = $this->upload->data('file_name');
            }
        }

        $this->db->where('id', $id);
        $this->db->update('produk', $data);
        $this->session->set_flashdata('pesan', 'Data produk berhasil diperbarui!');
        redirect('produk');
    }

    public function hapus($id) {
        $this->Produk_model->delete_produk($id);
        redirect('produk');
    }

    /**
     * FITUR PEMINJAMAN & RIWAYAT (USER)
     */
    public function pinjam($id) {
        $data = [
            'user_id'       => $this->session->userdata('id'),
            'produk_id'     => $id,
            'jumlah_pinjam' => $this->input->post('jumlah_pinjam'),
            'status'        => 'pending'
        ];
        $this->db->insert('peminjaman', $data);
        redirect('produk/pinjaman_saya');
    }

    public function pinjaman_saya() {
        $user_id = $this->session->userdata('id');
        $this->db->select('peminjaman.*, produk.nama_produk, produk.gambar');
        $this->db->from('peminjaman');
        $this->db->join('produk', 'produk.id = peminjaman.produk_id');
        $this->db->where('peminjaman.user_id', $user_id);
        $this->db->order_by('peminjaman.id', 'DESC');
        $data['riwayat'] = $this->db->get()->result();
        $this->load->view('riwayat_pinjam', $data);
    }

    // User klik tombol "Kembalikan"
    public function ajukan_kembali($id_pinjam) {
        $this->db->where('id', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'menunggu_kembali']);
        $this->session->set_flashdata('pesan', 'Permintaan pengembalian dikirim ke Admin.');
        redirect('produk/pinjaman_saya');
    }

    /**
     * FITUR MANAJEMEN REQUEST (ADMIN)
     */
    public function daftar_pinjam() {
        $this->db->select('peminjaman.*, users.username, produk.nama_produk');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.user_id');
        $this->db->join('produk', 'produk.id = peminjaman.produk_id');
        $this->db->order_by('id', 'DESC');
        $data['pinjaman'] = $this->db->get()->result();
        $this->load->view('daftar_pinjam', $data);
    }

    // Admin Menyetujui Peminjaman
    public function acc_pinjam($id_pinjam) {
        $pinjam = $this->db->get_where('peminjaman', ['id' => $id_pinjam])->row();
        
        // Kurangi stok barang di tabel produk
        $this->db->set('stok', 'stok - ' . (int)$pinjam->jumlah_pinjam, FALSE);
        $this->db->where('id', $pinjam->produk_id);
        $this->db->update('produk');

        // Update status menjadi 'disetujui'
        $this->db->update('peminjaman', ['status' => 'disetujui'], ['id' => $id_pinjam]);
        redirect('produk/daftar_pinjam');
    }

    // Admin Menyetujui Pengembalian (Tombol Terima Barang)
    public function terima_kembali($id_pinjam) {
        $pinjam = $this->db->get_where('peminjaman', ['id' => $id_pinjam])->row();
        
        // Tambahkan kembali stok barang di tabel produk
        $this->db->set('stok', 'stok + ' . (int)$pinjam->jumlah_pinjam, FALSE);
        $this->db->where('id', $pinjam->produk_id);
        $this->db->update('produk');

        // Update status menjadi 'selesai'
        $this->db->update('peminjaman', ['status' => 'selesai'], ['id' => $id_pinjam]);
        $this->session->set_flashdata('pesan', 'Barang telah diterima kembali dan stok bertambah.');
        redirect('produk/daftar_pinjam');
    }

    public function tolak_pinjam($id_pinjam) {
        $alasan = $this->input->post('alasan');
        $this->db->update('peminjaman', ['status' => 'ditolak', 'alasan_penolakan' => $alasan], ['id' => $id_pinjam]);
        redirect('produk/daftar_pinjam');
    }
}