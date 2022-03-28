<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('html/Home_model', '', TRUE);
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
	{
		$this->load->view('admin/adminpage');
	}
}