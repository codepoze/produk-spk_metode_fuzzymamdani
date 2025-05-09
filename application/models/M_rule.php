<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_rule extends CI_Model
{
    public function list()
    {
        $result = $this->db->query("SELECT r.id_rule, r.id_kriteria, r.id_skala, r.kondisi, k.nama AS kriteria, s.nama AS skala FROM tb_rule AS r LEFT JOIN tb_kriteria AS k ON k.id_kriteria = r.id_kriteria LEFT JOIN tb_skala AS s ON s.id_skala = r.id_skala ORDER BY r.id_rule ASC");
        return $result;
    }

    public function list_dt()
    {
        $this->datatables->select('r.id_rule, r.kondisi, k.nama AS kriteria, s.nama AS skala');
        $this->datatables->join('tb_kriteria AS k', 'k.id_kriteria = r.id_kriteria', 'left');
        $this->datatables->join('tb_skala AS s', 's.id_skala = r.id_skala', 'left');
        $this->datatables->order_by('r.id_rule', 'asc');
        $this->datatables->from('tb_rule AS r');
        return print_r($this->datatables->generate());
    }
}
