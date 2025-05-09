<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_skala extends CI_Model
{
    public function list()
    {
        $result = $this->db->query("SELECT s.id_skala, k.nama AS kriteria, k.jenis, s.nama AS skala, s.batas_bawah, s.batas_tengah, s.batas_atas FROM tb_skala AS s LEFT JOIN tb_kriteria AS k ON k.id_kriteria = s.id_kriteria");
        return $result;
    }

    public function list_jenis($jenis)
    {
        $result = $this->db->query("SELECT s.id_skala, k.nama AS kriteria, k.jenis, s.nama AS skala, s.batas_bawah, s.batas_tengah, s.batas_atas FROM tb_skala AS s LEFT JOIN tb_kriteria AS k ON k.id_kriteria = s.id_kriteria WHERE k.jenis = '$jenis'");
        return $result;
    }

    public function list_dt()
    {
        $this->datatables->select('s.id_skala, k.nama AS kriteria, k.jenis, s.nama AS skala, s.batas_bawah, s.batas_tengah, s.batas_atas');
        $this->datatables->join('tb_kriteria AS k', 'k.id_kriteria = s.id_kriteria', 'left');
        $this->datatables->order_by('s.id_skala', 'desc');
        $this->datatables->from('tb_skala AS s');
        return print_r($this->datatables->generate());
    }
}
