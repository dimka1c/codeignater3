<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.08.16
 * Time: 18:48
 */
class VerifyLogin extends CI_Controller
{
    public function index() {
        //var_dump($_POST);
        $data = array();
        $data['login'] = $this->input->post('login', true);
        $data['password'] = $this->input->post('password');
        $data['agent'] = $this->input->user_agent();
        $data['user_ip'] = $this->input->ip_address();

        $this->load->model('mlogin');
        $arr = $this->mlogin->verifyUser($data['login'], $data['password']);
        $data['list'] = $arr;

        $this->load->library('table');
        echo $this->table->generate($arr);

        $this->load->library('session');

        $this->load->view('user_data', $data);

        $this->load->library('pagination');

        //****************************************************
        $config['base_url'] = 'http://www.your-site.com/index.php/test/page/';
        $config['total_rows'] = '200';
        $config['per_page'] = '20';

        $this->pagination->initialize($config);

        echo $this->pagination->create_links();
    }
}