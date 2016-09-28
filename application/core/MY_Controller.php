<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct(){

        parent::__construct();

        /*设置UTF-8编码*/
        header ( 'Content-Type: text/html; charset=UTF-8' );

        /*设置静态文件目录*/
        define('DIR_STATIC',base_url().'static/');
        define('DIR_IMG', base_url().'static/images/');
        define('DIR_CSS', base_url().'static/css/');
        define('DIR_JS', base_url().'static/js/');
        define('DIR_FONT', base_url().'static/fonts/');
        define('DIR_BT', base_url().'static/bootstrap/');
        define('DIR_ADMIN', base_url().'static/adminLTE/');
        define('DIR_AD', base_url().'static/artDialog/');
        define('DIR_PACE', base_url().'static/pace/');
        define('DIR_DT', base_url().'static/datatables/');
        define('DIR_FA', base_url().'static/font-awesome/');
        define('DIR_JSBN', base_url().'static/js/jsbn/');
        define('DIR_TIME', base_url().'static/js/timer/');

    }

    public function checkauth($notview = false)
    {
        if ($_SESSION['login']!='1') {
            if (!$notview) {
                redirect('/user/login');
            }
            return false;
        }
        if (!isset($_SESSION['stuid'])) {
            $_SESSION['login'] = '0';
            if (!$notview) {
                redirect('/user/login');
            }
            return false;
        }
        $stuid = $_SESSION['stuid'];
        $query = $this->db->get_where("user", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            $_SESSION['login'] = '0';
            if (!$notview) {
                $data = array(
                    'type' => 'danger',
                    'msg' => '账户不存在'
                );
                $this->load->view('prompt', $data);
            }
            return false;
        }
        if ($query->result_array()[0]['status'] == '0') {
            $_SESSION['login'] = '0';
            if (!$isview) {
                $data = array(
                    'type' => 'danger',
                    'msg' => '账户未激活'
                );
                $this->load->view('prompt', $data);
            }
            return false;
        }
        $_SESSION['realname'] = $query->result_array()[0]['realname'];
        return true;
    }

    public function getUserinfo()
    {
        # code...
    }
}

