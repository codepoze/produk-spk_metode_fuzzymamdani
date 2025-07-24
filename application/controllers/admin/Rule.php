<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule extends MY_Controller
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

        $this->template->load('admin', 'Rule', 'rule', 'view', $data);
    }

    public function list_dt()
    {
        $this->m_rule->list_dt();
    }

    public function show()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_rule', ['id_rule' => $post['id']]);

        $this->_response_message($response);
    }

    public function store()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_kriteria' => $post['id_kriteria'],
            'id_skala'    => $post['id_skala'],
            'kondisi'     => $post['kondisi'],
        ];

        $this->db->trans_start();
        if (empty($post['id_rule'])) {
            $this->crud->i('tb_rule', $data);
        } else {
            $this->crud->u('tb_rule', $data, ['id_rule' => $post['id_rule']]);
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

        $check = checking_data($this->db->database, 'tb_rule', 'id_rule', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_rule', $post['id'], 'id_rule');
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
