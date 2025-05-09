<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
    public $id;
    public $id_users;
    public $username;
    public $password;
    public $role;

    public function __construct()
    {
        parent::__construct();

        // untuk variabel global
        $this->id       = $this->session->userdata('id');
        $this->id_users = $this->session->userdata('id_users');
        $this->username = $this->session->userdata('username');
        $this->password = $this->session->userdata('password');
        $this->role     = $this->session->userdata('role');
    }

    // untuk respon json
    public function _response($data)
    {
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }

    // untuk response message
    public function _response_message($message)
    {
        $message['csrf'] = $this->security->get_csrf_hash();
        $this->_response($message);
    }

    // untuk simpan riwayat barang masuk keluar
    public function _insert_in_out_item($no_transaksi, $jenis_transaksi, $kd_barang_or_bahan_baku, $jumlah)
    {
        $data = [
            'no_transaksi'            => $no_transaksi,
            'jenis_transaksi'         => $jenis_transaksi,
            'kd_barang_or_bahan_baku' => $kd_barang_or_bahan_baku,
            'jumlah'                  => $jumlah
        ];
        $this->db->trans_start();
        $this->crud->i('tb_barang_masuk_keluar', $data);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
