<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
    public function getRoleUsers($role, $id_users)
    {
        $result = $this->db->query("SELECT tu.id_users, tu.nama, tu.email, tu.roles, tu.foto, tu.username FROM tb_users AS tu WHERE tu.roles = '$role' AND tu.id_users = '$id_users'")->row();
        return $result;
    }
    
    public function get_all_data_dt()
    {
        $this->datatables->select('u.nama, u.email, u.username');
        $this->datatables->order_by('u.ins', 'desc');
        $this->datatables->where('u.roles', 'users');
        $this->datatables->from('tb_users AS u');
        return print_r($this->datatables->generate());
    }
}
