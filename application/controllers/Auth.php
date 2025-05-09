<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk load model
        $this->load->model('crud');
    }

    // untuk halaman login
    public function login()
    {
        checking_role_session($this->role);

        if (empty($this->username)) {
            $this->load->view('pages/login/view');
        } else {
            $this->auth($this->username, $this->password);
        }
    }

    // untuk mengecek data login
    public function check_validation()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/view');
        } else {
            $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
            $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

            $this->auth($username, $password);
        }
    }

    // untuk mengecek data username dan password
    public function auth($username, $password)
    {
        $user = $this->db->get_where('tb_users', ['username' => $username]);
        $count = $user->result();
        if (count($count) >= 1) {
            $row = $user->row_array();
            if (password_verify($password, $row['password'])) {
                if ($row['roles'] == 'admin') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit(json_encode(array('status' => true, 'link' => admin_url())));
                } else if ($row['roles'] == 'distribusi') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit(json_encode(array('status' => true, 'link' => distribusi_url())));
                } else if ($row['roles'] == 'supplier') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit(json_encode(array('status' => true, 'link' => supplier_url())));
                }
            } else {
                exit($this->_response_message(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
            }
        } else {
            exit($this->_response_message(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
        }
    }

    // untuk halaman register
    public function register()
    {
        checking_role_session($this->role);

        if (empty($this->username)) {
            $this->load->view('register/view');
        } else {
            $this->auth($this->username, $this->password);
        }
    }

    // untuk simpan data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        // data users
        $users = [
            'id_users' => acak_id('tb_users', 'id_users'),
            'nama'     => $post['nama'],
            'email'    => $post['email'],
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'roles'    => 'users',
        ];
        // data pelanggan
        $pelanggan = [
            'id_pelanggan' => acak_id('tb_pelanggan', 'id_pelanggan'),
            'id_users'     => $users['id_users'],
        ];

        $this->db->trans_start();
        $this->crud->i('tb_users', $users);
        $this->crud->i('tb_pelanggan', $pelanggan);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk logout
    public function logout()
    {
        $session_data = [
            'id'       => '',
            'id_users' => '',
            'username' => '',
            'password' => '',
            'role'     => '',
        ];
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
