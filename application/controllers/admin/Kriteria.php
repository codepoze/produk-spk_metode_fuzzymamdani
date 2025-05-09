<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);
    }

    public function index()
    {
        $this->template->load('admin', 'Kriteria', 'kriteria', 'view');
    }

    public function list_dt()
    {
        $this->m_kriteria->list_dt();
    }

    public function show()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_kriteria', ['id_kriteria' => $post['id']]);

        $this->_response_message($response);
    }

    public function store()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'nama'  => $post['nama'],
            'jenis' => $post['jenis'],
        ];

        $this->db->trans_start();
        if (empty($post['id_kriteria'])) {
            $this->crud->i('tb_kriteria', $data);
        } else {
            $this->crud->u('tb_kriteria', $data, ['id_kriteria' => $post['id_kriteria']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }

        $this->_response_message($response);
    }

    public function destroy()
    {
        $post = $this->input->post(NULL, TRUE);

        $check = checking_data($this->db->database, 'tb_kriteria', 'id_kriteria', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_kriteria', $post['id'], 'id_kriteria');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }

        $this->_response_message($response);
    }
}
