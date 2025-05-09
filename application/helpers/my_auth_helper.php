<?php
defined('BASEPATH') or exit('No direct script access allowed');

// untuk mengecek session user
if (!function_exists('checking_session')) {
    function checking_session($user_data, $user_level, array $level)
    {
        $search = in_array($user_level, $level);
        if (empty($user_data) || $search == 0) {
            redirect('auth/login');
        }
    }
}

// untuk mengecek role user
if (!function_exists('checking_role_session')) {
    function checking_role_session($role)
    {
        if ($role) {
            return redirect($role);
        }
    }
}

// untuk mengecek user
if (!function_exists('get_users_detail')) {
    function get_users_detail($id)
    {
        if ($id) {
            $ci = get_instance();
            $result = $ci->db->query("SELECT * FROM tb_users WHERE id = '$id'")->row();
            return $result;
        }
    }
}
