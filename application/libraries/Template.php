<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter Template Library
 *
 * Create template format in CodeIgniter
 *
 * @packge     CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

class Template
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    // untuk load view
    public function load($role, $title, $module, $view, array $data = [])
    {
        // untuk judul halaman
        $data['title'] = $title;
        // untuk content
        $data['content'] = "{$role}/{$module}/{$view}";
        // untuk css local
        $css = "{$role}/{$module}/css/{$view}";
        $data['css'] = ($this->_check_file_exist($css) ? $css : '');
        // untuk js local
        $js = "{$role}/{$module}/js/{$view}";
        $data['js'] = ($this->_check_file_exist($js) ? $js : '');
        // untuk load view
        $this->ci->load->view("{$role}/base", $data);
    }

    // untuk check file tersedia
    private function _check_file_exist($file_path)
    {
        $target_file = APPPATH . "views/{$file_path}.php";
        if (file_exists($target_file)) {
            return true;
        } else {
            return false;
        }
    }
}