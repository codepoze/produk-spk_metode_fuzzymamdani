<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skala extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);
    }

    public function index()
    {
        $data = [
            'kriteria' => $this->m_kriteria->list()->result(),
        ];

        $this->template->load('admin', 'Skala', 'skala', 'view', $data);
    }

    public function list_dt()
    {
        $this->m_skala->list_dt();
    }

    public function get_skala()
    {
        $post = $this->input->get(NULL, TRUE);

        $get = $this->crud->gwra('tb_skala', ['id_kriteria' => $post['id_kriteria']]);

        $result = [];

        foreach ($get as $key => $value) {
            $result[] = [
                'id_skala' => $value['id_skala'],
                'nama'     => $value['nama'],
            ];
        }

        $this->_response($result);
    }

    public function show()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_skala', ['id_skala' => $post['id']]);

        $this->_response_message($response);
    }

    public function store()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_kriteria'  => $post['id_kriteria'],
            'nama'         => $post['nama'],
            'batas_bawah'  => empty($post['batas_bawah']) ? NULL : $post['batas_bawah'],
            'batas_tengah' => empty($post['batas_tengah']) ? NULL : $post['batas_tengah'],
            'batas_atas'   => empty($post['batas_atas']) ? NULL : $post['batas_atas'],
        ];

        $this->db->trans_start();
        if (empty($post['id_skala'])) {
            $this->crud->i('tb_skala', $data);
        } else {
            $this->crud->u('tb_skala', $data, ['id_skala' => $post['id_skala']]);
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

        $check = checking_data($this->db->database, 'tb_skala', 'id_skala', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_skala', $post['id'], 'id_skala');
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
