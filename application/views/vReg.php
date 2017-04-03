<?php
// $data['title'] который передается в вьюху отображается как $title
    echo '<h1>'.$title.'</h1>';
// Путь auth-имя контроллера,  reg_user название вызываемой ф-ции
    echo form_open('auth/reg_user');
    echo validation_errors();
    echo form_label('Введите логин: ').'<br>';
    echo form_input('login').'<br>';
    echo form_label('Введите пароль: ').'<br>';
    echo form_password('password').'<br>';
    echo form_label('Повторите пароль: ').'<br>';
    echo form_password('passwordc').'<br>';
    echo form_label('Введите email: ').'<br>';
    echo form_password('email').'<br>';
    echo form_label('Введите телефон: ').'<br>';
    echo form_password('phone').'<br>';
    echo form_submit('sub','Регистрация');
    echo form_close();
