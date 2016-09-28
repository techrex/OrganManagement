<?php
defined('BASEPATH') OR exit('No direct script access allowed');

@session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = '0';
}
if (!isset($_SESSION['rsa_public'])) {
    $_SESSION['rsa_public'] = '';
}
if (!isset($_SESSION['rsa_private'])) {
    $_SESSION['rsa_private'] = '';
}
if (!isset($_SESSION['isGVerify'])) {
    $_SESSION['isGVerify'] = '0';
}

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('string');

        /*加载phpseclib*/
        set_include_path(APPPATH.'third_party/phpseclib');

        require_once('Crypt/RSA.php');
    }

    private function RSA_NewKeyPair()
    {
        $rsa = new Crypt_RSA();
        $rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
        $rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_RAW);
        $key = $rsa->createKey(1024);
        $_SESSION['rsa_private'] = $key['privatekey'];
        $_SESSION['rsa_public'] = $key['publickey']['n']->toHex();
    }

    public function index()
    {
        if ($_SESSION['login']!='1') {
            redirect('/user/login');
        }
        redirect('/manage');
    }

    public function login()
    {
        if ($_SESSION['login']=='1') {
            redirect('/manage');
        }
        $this->RSA_NewKeyPair();
        $_SESSION['isGVerify'] = '0';
        $data = array(
            'publickey' => $_SESSION['rsa_public'],
        );
        $this->load->view('user/login', $data);
    }

    public function lgcheck()
    {
        if ($_SESSION['isGVerify'] != '1') {
            echo(json_encode(array('code' => -5, 'msg' => 'Not verified!')));
            return;
        }
        $_SESSION['isGVerify'] = '0';
        $stuid = $this->input->post('stuid', true);
        $encrypted = $this->input->post('passwd', true);
        if (empty($stuid) || empty($encrypted)) {
            echo(json_encode(array('code' => 0, 'msg' => 'Empty stuid or password!')));
            return;
        }
        if (!preg_match('|^\d{8}$|', $stuid)) {
            echo(json_encode(array('code' => -1, 'msg' => 'Invalid stuid!')));
            return;
        }
        $this->load->database();
        $query = $this->db->get_where("user", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            echo(json_encode(array('code' => -2, 'msg' => 'Stuid or password uncorrect!')));
            return;
        }
        if ($query->result_array()[0]['status'] == '0') {
            echo(json_encode(array('code' => -4, 'msg' => 'Stuid not activated!')));
            return;
        }
        $rsa = new Crypt_RSA();
        try {
            $encrypted = pack('H*', $encrypted);
            $rsa->loadKey($_SESSION['rsa_private']);
            $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
            $decrypted = $rsa->decrypt($encrypted);

            $passwd_indb = $query->result_array()[0]['passwd'];
            if (password_verify($decrypted, $passwd_indb)) {
                $_SESSION['login'] = '1';
                $_SESSION['stuid'] = $stuid;
                echo(json_encode(array('code' => 1, 'msg' => 'Login success!')));
            } else {
                echo(json_encode(array('code' => -2, 'msg' => 'Stuid or password uncorrect!')));
            }
        } catch(Exception $e) {
            echo(json_encode(array('code' => -3, 'msg' => 'Decryption error!')));
        }
    }

    public function activate()
    {
        if ($_SESSION['login']=='1') {
            redirect('/manage');
        }
        $_SESSION['isGVerify'] = '0';
        $_SESSION['token'] = random_string('alnum', 16);
        $data = array(
            'token' => $_SESSION['token']
        );
        $this->load->view('user/activate', $data);
    }

    public function actcheck()
    {
        if ($_SESSION['isGVerify'] != '1') {
            echo(json_encode(array('code' => -5, 'msg' => 'Not verified!')));
            return;
        }
        $_SESSION['isGVerify'] = '0';
        $stuid = $this->input->post('stuid', true);
        $token = $this->input->post('token', true);
        if (empty($token) || $token != $_SESSION['token']) {
            echo(json_encode(array('code' => -4, 'msg' => 'Invalid token!')));
            $_SESSION['token'] = '';
            return;
        }
        $_SESSION['token'] = random_string('alnum', 16);
        if (empty($stuid)) {
            echo(json_encode(array('code' => 0, 'msg' => 'Empty stuid!', 'token' => $_SESSION['token'])));
            return;
        }
        if (!preg_match('|^\d{8}$|', $stuid)) {
            echo(json_encode(array('code' => -1, 'msg' => 'Invalid stuid!', 'token' => $_SESSION['token'])));
            return;
        }
        $this->load->database();
        $query = $this->db->get_where("user", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            echo(json_encode(array('code' => -2, 'msg' => 'Unknown stuid!', 'token' => $_SESSION['token'])));
            return;
        }
        if ($query->result_array()[0]['status'] != '0') {
            echo(json_encode(array('code' => -3, 'msg' => 'Already activated!', 'token' => $_SESSION['token'])));
            return;
        }
        $realname = $query->result_array()[0]['realname'];
        $this->load->model('email_model');
        $email = $query->result_array()[0]['email'];
        $emailArray = explode("@", $email);
        $emailhost = '//mail.'.$emailArray[1];
        $timevar = explode(" ", microtime());
        $user_info = $stuid.'#'.$email.'#'.$timevar[1].substr($timevar[0], 2).substr(mt_rand(),0,4);
        $emailToken = hash('sha256', 'test'.random_string('alnum', 24), false);
        $actUrl = 'http://www.hdussta.cn/user/actlink?actoken='.$emailToken;
        $emailBody = '<table style="color: rgb(34, 34, 34); font-family: Helvetica, Arial, sans-serif; font-size: 16px; border-collapse: collapse; border-spacing: 0px; line-height: 1.5; margin: 0px auto; max-width: 680px;"><tbody><tr><td style="-webkit-font-smoothing: subpixel-antialiased; margin: 0px; padding: 0px; word-break: break-word; border-collapse: collapse !important;"><span style="font-size: xx-large; color: rgb(87, 193, 234);">通信科协</span><br><hr style="color: rgb(221, 221, 221); background: rgb(221, 221, 221); border: none; height: 1px; margin: 20px 0px 30px;"><table width="100%" style="color: rgb(34, 34, 34); border-collapse: collapse; border-spacing: 0px;"><tbody><tr><td style="font-size: 16px; -webkit-font-smoothing: subpixel-antialiased; color: rgb(34, 34, 34); margin: 0px; padding: 0px; word-break: break-word; border-collapse: collapse !important;"><p style="line-height: 27.2px; margin: 0px 0px 10px; padding: 0px;">'.$realname.'，你好！</p><p style="line-height: 27.2px; margin: 0px 0px 10px; padding: 0px;">欢迎激活通信科协账户，请在24小时内点击下面链接验证邮箱：</p><p style="line-height: 27.2px; margin: 24px 0px; padding: 0px;"><a href="'.$actUrl.'" target="_blank" style="display: block;outline: none;text-decoration: none;cursor: pointer;color: rgb(255, 255, 255);background: #57C1EA;border-radius: 4px;padding: 8px 16px;word-break: break-all;">'.$actUrl.'</a></p><p style="line-height: 20.4px; color: rgb(153, 153, 153); font-size: 12px; margin: 0px 0px 10px; padding: 0px;">如果你没有激活过通信科协账户&nbsp;，请忽略此邮件。</p></td></tr></tbody></table><hr style="color: rgb(221, 221, 221); background: rgb(221, 221, 221); border: none; height: 1px; margin: 20px 0px;"><table width="100%" style="color: rgb(34, 34, 34); border-collapse: collapse; border-spacing: 0px;"><tbody><tr><td colspan="2" align="center" style="font-size: 16px; -webkit-font-smoothing: subpixel-antialiased; color: rgb(34, 34, 34); margin: 0px; padding: 0px; word-break: break-word; border-collapse: collapse !important;"><p style="line-height: 20.4px; color: rgb(153, 153, 153); font-size: 12px; margin: 0px 0px 10px; padding: 0px;">如有疑问请联系我们 ：<a href="mailto:admin@hdussta.cn" target="_blank" style="outline: none; cursor: pointer; color: rgb(153, 153, 153);">admin@hdussta.cn</a></p></td></tr></tbody></table></td></tr></tbody></table>';
        if($this->email_model->send($email, '欢迎激活通信科协账户，请验证邮箱', $emailBody)) {
            $query = $this->db->get_where("activate", array('stuid' => $stuid));
            if ($query->num_rows() > 0) {
                $data = array(
                    'token' => $emailToken,
                    'time' => time()
                );
                $this->db->where('stuid', $stuid);
                $this->db->update('activate', $data);
                echo(json_encode(array('code' => 2, 'msg' => 'Reactivation success!', 'emailUrl' => $emailhost)));
                return;
            } else {
                $data = array(
                    'stuid' => $stuid,
                    'token' => $emailToken,
                    'time' => time()
                );
                $this->db->insert('activate', $data);
                echo(json_encode(array('code' => 1, 'msg' => 'Activation success!', 'emailUrl' => $emailhost)));
                return;
            }
        } else {
            echo(json_encode(array('code' => -6, 'msg' => 'Email send error!', 'token' => $_SESSION['token'])));
            return;
        }
    }

    public function actlink()
    {
        $actoken = $this->input->get('actoken', true);
        if (empty($actoken)) {
            $data = array(
                'type' => 'danger',
                'msg' => '激活参数不全'
            );
            $this->load->view('prompt', $data);
            return;
        }
        $this->load->database();
        $query = $this->db->get_where("activate", array('token' => $actoken));
        if ($query->num_rows() < 1) {
            $data = array(
                'type' => 'danger',
                'msg' => '无效的激活链接'
            );
            $this->load->view('prompt', $data);
            return;
        }
        if (time() - $query->result_array()[0]['time'] > 86400) {
            $data = array(
                'type' => 'danger',
                'msg' => '激活链接已失效，请<a href="/user/activate" class="alert-link">重新获取</a>'
            );
            $this->load->view('prompt', $data);
            return;
        }
        $stuid = $query->result_array()[0]['stuid'];
        $query = $this->db->get_where("user", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            $data = array(
                'type' => 'danger',
                'msg' => '无效的激活链接'
            );
            $this->load->view('prompt', $data);
            return;
        }
        if ($query->result_array()[0]['status'] != '0') {
            $data = array(
                'type' => 'warning',
                'msg' => '该账户已激活，请<a href="/user/login" class="alert-link">直接登录</a>'
            );
            $this->load->view('prompt', $data);
            return;
        }
        $_SESSION['stuid'] = $stuid;
        $this->RSA_NewKeyPair();
        $_SESSION['isGVerify'] = '0';
        $data = array(
            'stuid' => $stuid,
            'publickey' => $_SESSION['rsa_public'],
        );
        $this->load->view('user/actlink', $data);
    }

    public function actcomfirm()
    {
        if ($_SESSION['isGVerify'] != '1') {
            echo(json_encode(array('code' => -5, 'msg' => 'Not verified!')));
            return;
        }
        $_SESSION['isGVerify'] = '0';
        if (!isset($_SESSION['stuid']) || empty($_SESSION['stuid'])) {
            echo(json_encode(array('code' => 0, 'msg' => 'Empty stuid!')));
            return;
        }
        $stuid = $_SESSION['stuid'];
        $encrypted = $this->input->post('passwd', true);
        if (empty($stuid) || empty($encrypted)) {
            echo(json_encode(array('code' => -1, 'msg' => 'Empty password!')));
            return;
        }
        $this->load->database();
        $query = $this->db->get_where("user", array('stuid' => $stuid));
        if ($query->num_rows() < 1) {
            echo(json_encode(array('code' => -2, 'msg' => 'Stuid uncorrect!')));
            return;
        }
        if ($query->result_array()[0]['status'] != '0') {
            echo(json_encode(array('code' => -3, 'msg' => 'Stuid already activated!')));
            return;
        }
        $rsa = new Crypt_RSA();
        try {
            $encrypted = pack('H*', $encrypted);
            $rsa->loadKey($_SESSION['rsa_private']);
            $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
            $decrypted = $rsa->decrypt($encrypted);
            $data = array(
                'passwd' => password_hash($decrypted, PASSWORD_DEFAULT),
                'status' => '1'
            );
            $this->db->where('stuid', $stuid);
            $this->db->update('user', $data);
            $this->db->where('stuid', $stuid);
            $this->db->delete('activate');
            echo(json_encode(array('code' => 1, 'msg' => 'Activate success!')));
        } catch(Exception $e) {
            echo(json_encode(array('code' => -4, 'msg' => 'Decryption error!')));
        }
    }

    public function lgout()
    {
        @session_destroy();
        redirect('/user/login');
    }

}
