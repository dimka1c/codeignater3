<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.08.16
 * Time: 14:08
 */
class Ver extends CI_Controller
{
    public function Index() {
        $this->output->enable_profiler(TRUE);
        $this->load->view('ver');
    }
}