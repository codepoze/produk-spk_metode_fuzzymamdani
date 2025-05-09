<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{
    public $users;

    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk mengambil detail user
        $this->users = get_users_detail($this->id);
    }

    // untuk default
    public function index()
    {
        $data = [
            'data' => $this->m_users->getRoleUsers('admin', $this->users->id_users),
        ];
        // untuk load view
        $this->template->load('admin', 'Profil', 'profil', 'view', $data);
    }

    // untuk ubah foto
    public function upd_foto()
    {
        $_FILES['inpfoto']['name']     = $_FILES['inpfotoprofil']['name'][0];
        $_FILES['inpfoto']['type']     = $_FILES['inpfotoprofil']['type'][0];
        $_FILES['inpfoto']['tmp_name'] = $_FILES['inpfotoprofil']['tmp_name'][0];
        $_FILES['inpfoto']['error']    = $_FILES['inpfotoprofil']['error'][0];
        $_FILES['inpfoto']['size']     = $_FILES['inpfotoprofil']['size'][0];

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpfoto')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $data = [
                'foto' => $detailFile['file_name'],
            ];
            $this->db->trans_start();
            $this->crud->u('tb_users', $data, ['id_users' => $this->users->id_users]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk ubah akun
    public function upd_akun()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'nama'     => $post['inpnama'],
            'email'    => $post['inpemail'],
            'username' => $post['inpusername'],
            'roles'    => 'admin'
        ];
        $this->db->trans_start();
        $this->crud->u('tb_users', $data, ['id_users' => $this->users->id_users]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk ubah keamanan
    public function upd_keamanan()
    {
        $post = $this->input->post(NULL, TRUE);

        $pwd_lama = $post['inppasswordlama'];
        $pwd_baru = $post['inppasswordbaru'];
        $konfirmasi_pwd_baru = $post['inpkonfirmasipassword'];

        $users = $this->crud->gda('tb_users', ['id_users' => $this->users->id_users]);
        $check_pwd = password_verify($pwd_lama, $users['password']);

        if ($check_pwd === true) {
            if ($pwd_baru === $konfirmasi_pwd_baru) {

                $data = [
                    'password' => password_hash($pwd_baru, PASSWORD_DEFAULT),
                    'roles'    => 'admin'
                ];
                $this->db->trans_start();
                $this->crud->u('tb_users', $data, ['id_users' => $this->users->id_users]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Terdapat kesalahan pada sistem!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil!', 'type' => 'success', 'button' => 'Ok!'];
                }
            } else {
                $response = ['title' => 'Gagal!', 'text' => 'Password baru dan konfirmasi password baru tidak sama!', 'type' => 'error', 'button' => 'Ok!'];
            }
        } else {
            $response = ['title' => 'Gagal!', 'text' => 'Password lama yang Anda masukkan tidak sama!', 'type' => 'error', 'button' => 'Ok!'];
        }
        // untuk respon json
        $this->_response($response);
    }
}
