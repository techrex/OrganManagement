<?php
defined('BASEPATH') OR exit('No direct script access allowed');

@session_start();
if (!isset($_SESSION['isGVerify'])) {
    $_SESSION['isGVerify'] = '0';
}

class Geetest extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        /*加载geetestlib*/
        require_once(APPPATH.'third_party/geetest/class.geetestlib.php');
        define("CAPTCHA_ID", "");
        define("PRIVATE_KEY", "");
        define("MOBILE_CAPTCHA_ID", "");
        define("MOBILE_PRIVATE_KEY", "");
    }

    public function init() {
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $timevar = explode(" ", microtime());
        $user_id = $timevar[1].substr($timevar[0], 2, 3).substr(mt_rand(), 0, 5);
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['isGVerify'] = '0';
        echo $GtSdk->get_response_str();
    }

    public function verify() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['gtserver'])) {
            echo '{"status":"fail"}';
            return;
        }
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $geetest_challenge = $this->input->post('geetest_challenge', true);
        $geetest_validate = $this->input->post('geetest_validate', true);
        $geetest_seccode = $this->input->post('geetest_seccode', true);
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {   //服务器正常
            $result = $GtSdk->success_validate($geetest_challenge, $geetest_validate, $geetest_seccode, $user_id);
            if ($result) {
                $_SESSION['isGVerify'] = '1';
                echo '{"status":"success"}';
            } else{
                $_SESSION['isGVerify'] = '0';
                echo '{"status":"fail"}';
            }
        }else{  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
                $_SESSION['isGVerify'] = '1';
                echo '{"status":"success"}';
            }else{
                $_SESSION['isGVerify'] = '0';
                echo '{"status":"fail"}';
            }
        }
    }

}
