<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Users', 'users', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_users->get_all_data_dt();
    }
}
