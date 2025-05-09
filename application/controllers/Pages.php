<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'title'   => 'Home',
            'content' => 'pages/home/view',
            'css'     => '',
            'js'      => ''
        ];

        $this->load->view('pages/base', $data);
    }

    public function about()
    {
        $data = [
            'title'   => 'About',
            'content' => 'pages/about/view',
            'css'     => '',
            'js'      => ''
        ];

        $this->load->view('pages/base', $data);
    }
}
