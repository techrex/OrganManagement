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

class Recruit extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        if (!$this->checkauth()) {
            return;
        }
        $data = array(
            'stuid' => $_SESSION['stuid'],
            'realname' => $_SESSION['realname'],
            'extra_css' => array(
                DIR_DT.'css/datatables.min.css',
                DIR_CSS.'manage/recruit.css'
            ),
            'active' => 'recruit',
            'content_title' => '招新报名',
            'content_des' => ''
        );
        $data_footer = array(
            'extra_js' => array(
                DIR_DT.'js/datatables.min.js',
                DIR_JS.'jquery.form-validator.js',
                DIR_JS.'manage/recruit.js'
            )
        );
        $this->load->view('manage/header', $data);
        $this->load->view('manage/recruit');
        $this->load->view('manage/footer', $data_footer);
    }

    public function get()
    {
        if (!$this->checkauth(true)) {
            echo "[]";
            return;
        }
        $query = $this->db->get("recruit");
        $res = array('data'=>$query->result_array());
        echo(json_encode($res, JSON_UNESCAPED_UNICODE));
    }

    public function add()
    {
        if (!$this->checkauth()) {
            return;
        }
        $realname = $this->input->post('realname', true);
        $sex = $this->input->post('sex', true);
        $stuid = $this->input->post('stuid', true);
        $class = $this->input->post('class', true);
        $mobile_long = $this->input->post('mobile_long', true);
        $mobile_short = $this->input->post('mobile_short', true);
        $otherclub = $this->input->post('otherclub', true);
        $resume = $this->input->post('resume', true);
        if (empty($realname) || empty($sex) || empty($stuid) || empty($class) || empty($mobile_long) || empty($otherclub) || empty($resume)) {
            $data = array(
                'type' => 'danger',
                'msg' => '报名信息不全，请重新输入'
            );
            $this->load->view('prompt', $data);
            return;
        }
        if (!preg_match('|^\d{1}$|', $sex) || !preg_match('|^\d{8}$|', $stuid) || !is_numeric($class) || intval($class) < 0 || intval($class) > 11 || !preg_match('|^\d{11}$|', $mobile_long)) {
            $data = array(
                'type' => 'danger',
                'msg' => '报名信息格式错误，请重新输入'
            );
            $this->load->view('prompt', $data);
            return;
        }
        if (empty($mobile_short)) {
            $mobile_short = '';
        } else {
            if (!preg_match('|^\d{6}$|', $mobile_short)) {
                $data = array(
                    'type' => 'danger',
                    'msg' => '报名信息格式错误，请重新输入'
                );
                $this->load->view('prompt', $data);
                return;
            }
        }
        $this->load->database();
        $query = $this->db->get_where("recruit", array('stuid' => $stuid));
        if ($query->num_rows() > 0) {
            $data = array(
                'type' => 'warning',
                'msg' => '此人已报名，请勿重复报名'
            );
            $this->load->view('prompt', $data);
            return;
        } else {
            $data = array(
                'stuid' => $stuid,
                'realname' => $realname,
                'sex' => $sex,
                'class' => $class,
                'mobile_long' => $mobile_long,
                'mobile_short' => $mobile_short,
                'otherclub' => $otherclub,
                'resume' => $resume,
            );
            $this->db->insert('recruit', $data);
            $data = array(
                'type' => 'success',
                'msg' => '报名成功，<a href="/manage/recruit" class="alert-link">点此返回</a>'
            );
            $this->load->view('prompt', $data);
        }
    }

}
