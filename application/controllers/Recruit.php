<?php
defined('BASEPATH') OR exit('No direct script access allowed');

@session_start();

class Recruit extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        if (mktime(24,0,0,9,30,2016) < time()) {
            $data = array(
                'type' => 'danger',
                'msg' => '现在不是报名时间'
            );
            $this->load->view('prompt', $data);
            return;
        }
        if (false) {
            $data = array(
                'type' => 'warning',
                'msg' => '系统维护请稍后再试'
            );
            $this->load->view('prompt', $data);
            return;
        }
        $this->load->view('recruit');
    }

    public function submit() {
        if (mktime(24,0,0,9,30,2016) < time()) {
            $data = array(
                'type' => 'danger',
                'msg' => '现在不是报名时间'
            );
            $this->load->view('prompt', $data);
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
                'realname' => $realname,
                'sex' => $sex,
                'class' => $class,
                'mobile_long' => $mobile_long,
                'mobile_short' => $mobile_short,
                'otherclub' => $otherclub,
                'resume' => $resume,
            );
            $this->db->where('stuid', $stuid);
            $this->db->update('recruit', $data);
            $data = array(
                'type' => 'info',
                'msg' => '报名信息更新成功'
            );
            $this->load->view('prompt', $data);
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
                'msg' => '报名成功'
            );
            $this->load->view('prompt', $data);
        }
    }

    public function check() {
        if (mktime(24,0,0,9,30,2016) < time()) {
            echo json_encode(array(
                'code' => '-1',
                'msg' => 'Not recruit time'
            ));
            return;
        }
        $stuid = $this->input->post('stuid', true);
        if (empty($stuid) || strlen($stuid) != 8) {
            echo json_encode(array(
                'code' => '-2',
                'msg' => 'Invalid stuid'
            ));
            return;
        }
        $this->load->database();
        $query = $this->db->get_where("recruit", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            echo json_encode(array(
                'code' => '0',
                'msg' => 'Not recruited'
            ));
            return;
        }
        $data = $query->result_array()[0];
        echo json_encode(array(
            'code' => '1',
            'msg' => $data
        ), JSON_UNESCAPED_UNICODE);
    }
}
