<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kriteria extends CI_Model
{
    public function list()
    {
        $result = $this->db->query("SELECT k.id_kriteria, k.nama, k.jenis FROM tb_kriteria AS k");
        return $result;
    }

    public function list_jenis($jenis)
    {
        $result = $this->db->query("SELECT k.id_kriteria, k.nama, k.jenis FROM tb_kriteria AS k WHERE k.jenis = '$jenis'");
        return $result;
    }

    public function list_dt()
    {
        $this->datatables->select('k.id_kriteria, k.nama, k.jenis');
        $this->datatables->order_by('k.id_kriteria', 'desc');
        $this->datatables->from('tb_kriteria AS k');
        return print_r($this->datatables->generate());
    }
}
