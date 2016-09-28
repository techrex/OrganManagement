<?php
defined('BASEPATH') OR exit('No direct script access allowed');

@session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = '0';
}
if (!isset($_SESSION['stuid'])) {
    $_SESSION['login'] = '0';
    $_SESSION['stuid'] = '';
}

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        if (!$this->checkauth()) {
            return;
        }
        redirect('/manage/recruit');
    }
}
