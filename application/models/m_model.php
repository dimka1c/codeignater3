<?php


class m_model extends CI_Model
{

    public function verifyUser($data_user) {
        //var_dump($data_user);
        //echo '<hr>';
        $id = $data_user['id'];
        $password = $data_user['password'];
        $this->load->database();
        //$db = $this->load->database("",TRUE);
        $sql = "SELECT user_name,id_user FROM users WHERE id_user = '".$id."' AND user_password = '".$password."'";
        //echo '<br>'.$sql.'<br>';
        //echo '<hr>';
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        return $arr;

/*
        if(isset($arr[0]['user_name'])) {
            return $arr[0]['user_name']; //пользователь найден, возвращаем имя пользоватея
        } else {
            return 'no_user'; // пользователь не найден
        }
        //return $query->result_array();
*/

    }

    public function loadAllUser() {     //возвращает имена всех пользователей из БД
        //$this->load->database();
        $sql = "SELECT user_name,id_user FROM users";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;

    }

    public function loadData($id_user) {    //возвращает пробеги по водителю за последний месяц
        $sql = "SELECT * FROM overall WHERE user=".$id_user;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function work_day($id_user) {    // возвращает рабочие дни
        $sql = "SELECT data FROM overall WHERE user=".$id_user." AND (speedometer_start<>0 AND speedometer_end<>0)";
        //$sql = "SELECT data FROM overall WHERE user=".$id_user;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function loadDataGrid($id_user) {    //возвращает пробеги по водителю за последний месяц
        $sql = "SELECT id_overall as id, data, time_run, time_end, speedometer_start, speedometer_end, rest_fuel_begin, fueled FROM overall where user=".$id_user;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

}