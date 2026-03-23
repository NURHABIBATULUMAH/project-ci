<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library dan model yang dibutuhkan
        $this->load->library(['form_validation', 'session']);
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                // Hashing password agar aman di database
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->User_model->register($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silahkan login.');
            redirect('auth/login');
        }
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->login($username);

            // Verifikasi user dan password
            if ($user && password_verify($password, $user['password'])) {
                $session_data = [
                    'username' => $user['username'], 
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Langsung redirect ke halaman utama produk
                redirect('produk'); 
                
            } else {
                // Jika gagal, beri pesan error dan balik ke login
                $this->session->set_flashdata('error', 'Username atau Password salah');
                redirect('auth/login');
            }
        }
    }

    public function logout() {
        // Hapus semua data session saat logout
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}