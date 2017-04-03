<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.08.16
 * Time: 18:46
 */
class mlogin extends CI_Model
{
    public function verifyUser($login, $password) {
        echo $login.' / '.$password;
        echo '<br> Connect to DataBase...<br>';

        $this->load->database();
        //$db = $this->load->database("",TRUE);
        $sql = "SELECT user_name FROM users WHERE user_login = '".$login."' AND user_password = '".$password."'";
        echo '<br>'.$sql.'<br>';
        $query = $this->db->query('select * from users');
        return $query->result_array();

//        foreach ($query->result_array() as $row)
//        {
//            echo $row['id_user'];
//            echo '<hr>';
//        }

    }

}