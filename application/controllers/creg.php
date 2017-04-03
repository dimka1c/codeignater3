<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creg extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/ сReg
     *	- or -
     * 		http://example.com/index.php/сReg/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/сReg/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['title']='Форма регистрации';
        $this->load->view('vReg',$data);
    }

    /**
     * Регистрация пользователя
     */
    public function reg_user()
    {
        // Собираем в массив все POST данные
        $arr= array(
            'login' => $this->db->escape($this->input->post('login',TRUE)),
            'pass' => $this->db->escape($this->input->post('password')),
            'email' => $this->db->escape($this->input->post('email')),
            'phone' => $this->db->escape($this->input->post('phone'))
        );
        // Проверка формы на валидацию. Все поля обязательны
        // Логин должен быть от 5 до 12 символов. Так же убираем если есть пробелы и проверяем на xss
        $this->form_validation->set_rules('login', 'Имя пользователя', 'trim|required|min_length[5]|max_length[12]|xss_clean ');
        // Пароль сверяется с полем повторного ввода пароля. Так же проверяем на xss
        $this->form_validation->set_rules('password', 'Пароль', 'required|matches[passwordc]|xss_clean ');
        // Это поле просто обязательно. Так же проверяем на xss
        $this->form_validation->set_rules('passwordc', 'Повтор пароля', 'required|xss_clean ');
        // Поле почты проверяется на корректный email адрес. Так же убираем если есть пробелы и проверяем на xss
        $this->form_validation->set_rules('email', 'Почта', 'trim|required|valid_email|xss_clean ');
        // Поле телефона содержит только целые числа от 5 до 10 символов
        $this->form_validation->set_rules('phone', 'Телефон', 'required|integer|min_length[5]|max_length[10]');

        if ($this->form_validation->run() == FALSE)
        {
            //  Если форма не прошла валидацию, отсылаем пользователя заполнять ее заново
            $data['title']='Данные не корректны';
            $this->load->view('vReg',$data);
        }
        else
        {
            // Подключаем модель которая будет обрабатывать запросы
            $this->load->model('logic');
            // Если пользователь с таким логином не найден
            if ($this->logic->user_verify($arr['login'])){
                // Создаем массив с данными сессии и записываем нового пользователя в БД
                $authdata = array(
                    'login' => $login,
                    'logged_in' => true
                );

                // Добавляем данные в сессию
                $this->session->set_userdata($authdata);

                // Добавляем данные о пользователе в БД

                $this->logic->insert('users',$arr);

                // Редиректим на нужную нам страницу
                header('Location: /index.php?/cReg/ok');
            }
            // Если пользователь существует отправляем его заполнять форму заново
            else {
                $data['title']='Логин занят';
                $this->load->view('vReg',$data);
            }
        }
    }

    /**
     * Страница успешной регистрации
     */
    public function ok()
    {
        $this->load->model('logic');
        if($this->logic->sess_verify()){
            $data['title']='Здравствуйте '.$this->session->userdata('login');
            $this->load->view('vEnter',$data);
        }
    }
}

/* End of file cReg.php */
/* Location: ./application/controllers/cReg.php */