<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		$this->load->view('html/homepage');
	}

    /* 
    *加载个人用户注册页面
     */
    public function register_load()
    {
        $this->load->view('html/register');
    }

    /* 
    *个人用户注册
    */
    public function register_fun()
    {
        $user_name = $this->input->post('user_name');
        $select_where = array('user_name' => $user_name);
        $result = $this->Home_model->selectDB('*', $select_where, 'user',true);
        if ($result['data']) {
            $result['code'] = 0;
            $result['msg'] = '用户已存在！';
        } else {
            $user_tel = $this->input->post('user_tel');
            $user_pwd = $this->input->post('user_pwd');
            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            $identity = 1;
            $data = array(
                'user_tel' => $user_tel,
                'user_pwd' => $user_pwd,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'identity' => $identity,

            );
            $result = $this->Home_model->insertDB('user', $data);
        }
        echo json_encode($result);
    }

    /* 
    *加载企业用户注册页面
     */
    public function register2_load()
    {
        $this->load->view('html/register2');
    }

    /* 
    *企业用户注册
    */
    public function register2_fun()
    {
        $user_name = $this->input->post('user_name');
        $user_company = $this->input->post('user_company');
        $select_where1 = array('user_name' => $user_name);
        $select_where2 = array('user_company' => $user_company);
        $result1 = $this->Home_model->selectDB('*', $select_where1, 'user', true);
        $result2 = $this->Home_model->selectDB('*', $select_where2, 'user', true);
        if ($result1['data']) {
            $result1['code'] = 0;
            $result1['msg'] = '用户已存在！';
            echo json_encode($result1);
        } elseif ($result2['data']) {
            $result2['code'] = 0;
            $result2['msg'] = '企业已存在！';
            echo json_encode($result2);
        } else {
            $result2['code'] = 1;
            $result2['msg'] = '注册成功！';
            $user_company = $this->input->post('user_company');
            $user_tel = $this->input->post('user_tel');
            $user_pwd = $this->input->post('user_pwd');
            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            $identity = 2;
            $data = array(
                'user_company' => $user_company,
                'user_tel' => $user_tel,
                'user_pwd' => $user_pwd,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'identity' => $identity,

            );
            $result = $this->Home_model->insertDB('user', $data);
            echo json_encode($result);
        }  
    }

    /* 
    *加载登陆页面
     */
    public function login_load()
    {
        $this->load->view('html/login');
    }

     /* 
    *用户登录
    */
    public function login_fun()
    {
        $user_name = $this->input->post('user_name');
        $user_pwd = $this->input->post('user_pwd');
        $select_where = array('user_name' => $user_name, 'user_pwd' => $user_pwd);
        $result = $this->Home_model->selectDB('*', $select_where, 'user', 1);
        if ($result['data']) {
            $this->session->set_userdata('user_info', $result['data']);
            $result['code'] = 1;
            $result['msg'] = '登录成功！';
        } else {
            $result['code'] = 0;
            $result['msg'] = '用户名或密码不正确！';
        }
        echo json_encode($result);
    }

    /* 
    *退出登录 
    */
    public function logout_fun()
    {
        $this->session->unset_userdata('user_info');
        redirect(base_url('home'));
    }
}