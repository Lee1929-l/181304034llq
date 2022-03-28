<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public $result_arr;
    protected $table_name = "";

    public function __construct()
    {
        parent::__construct();
        $this->result_val = array('code' => 0, 'msg' => '发生错误');
        $this->load->database(); 
        $this->conn = $this->load->database('school_enterprise_cooperation_db', true);
    }
}