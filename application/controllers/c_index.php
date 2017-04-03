<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: User
 * Date: 025 25.08.16
 * Time: 17:01
 *
 * Основной контроллер приложения
 *
 */
class C_Index extends CI_Controller
{

    public function index($nolog = 0, $nopsw = 0){

        $this->output->enable_profiler(TRUE);
        $this->load->model('m_model');
        $all_user['all_user'] = $this->m_model->loadAllUser();
        //var_dump($all_user);

        if (!empty($_POST['usr_name']) AND !empty($_POST['password'])) {

            $data['id'] = trim($this->input->post('usr_name', true));
            $data['password'] = trim($this->input->post('password'));
            $data['agent'] = $this->input->user_agent();
            $data['user_ip'] = $this->input->ip_address();

            $user = $this->m_model->verifyUser($data);

            //var_dump($user);
            if (isset($user[0])) {
                $user_name = $user[0]['user_name'];
                $user_id = $user[0]['id_user'];
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_id'] = (int) $user_id;
            } else {
                $user_name = "";
                $user_id = "";
            }

            if(!isset($_SESSION['user_id'])) {      //пользователь не авторизован
                //$err['err_login'] = 'не верный логин или пароль';
                $all_user['err_login'] = 'не верный логин или пароль';
                $this->load->view('index',$all_user);
            } else { // возвращено имя пользователя, пользователь найден
                //echo 'второй вход -- пользователь найден <br>';
                $data['user_name'] = $user_name;
                $data['user_id'] = $user_id;

                $data['km'] = $this->m_model->loadData($user_id);
                $this->load->view('tab',$data);
        }

        } else {
            //echo 'первый вход';
            $this->load->view('index',$all_user);
        }

    }

    public function exit_login() {
        session_destroy();
        header("Location: /");
    }

    public function calendar() {
//        $this->output->enable_profiler(TRUE);
        $this->load->model('m_model');
        $data['user_name'] =  $_SESSION['user_name'];
        $data['user_id'] = $_SESSION['user_id'];
        $data['workday'] = $this->m_model->work_day($data['user_id']);
        //var_dump(($data['workday']));
        $this->load->view('entry',$data);
    }

    public function probegi($data_run = 0, $data_end = 0) {
        $this->load->model('m_model');
        $data['user_name'] =  $_SESSION['user_name'];
        $data['user_id'] = $_SESSION['user_id'];
        $data['workday'] = $this->m_model->work_day($data['user_id']);

        $this->load->view('entry',$data);

    }

    public function tabdata() {
        $curPage = $_POST['page'];
        $rowsPerPage = $_POST['rows'];
        $sortingField = $_POST['sidx'];
        $sortingOrder = $_POST['sord'];


        $this->load->model('m_model');
        $data = $this->m_model->loadDataGrid($_SESSION['user_id']);


        $response['page'] = 1;
        $response['total'] = 2;
        $response['records'] = 50;
//id_overall as id, data, time_run, time_end, speedometer_start, speedometer_end, rest_fuel_begin, fueled
        $i = 0;
        foreach ($data as $res) {
            $response['rows'][$i]['id'] = $res['id'];
            $response['rows'][$i]['cell'] = array($res['id'], $res['data'], $res['time_run'], $res['time_end'], $res['speedometer_start'], $res['speedometer_end'], $res['rest_fuel_begin'], $res['fueled']);
            $i++;
        }

        echo json_encode($response);

    }

    public function tab() {

        //$this->output->enable_profiler(TRUE);
        $this->load->view('tab');
    }

    public function writedata() {
            //читаем новые значения
        $id = $_POST['id'];
        $time1 = $_POST['time1'];
        $time2 = $_POST['time2'];
        $km1 = $_POST['km1'];
        $km2 = $_POST['km2'];

        var_dump($_POST);
    }
}