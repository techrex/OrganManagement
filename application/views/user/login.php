<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="WebSite of SSTA">
    <meta name="author" content="TechRex">
    <title>通信科协</title>
    <!-- <link rel="shortcut icon" href="<?=DIR_IMG?>gt_favicon.png"> -->
    <!-- Bootstrap itself -->
    <link href="<?=DIR_BT?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link href="<?=DIR_FA?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    html, body {
        height: 100%;
        margin: 0;
    }
    body {
        padding-top: 1em;
        position: relative;
        font-family: -apple-system, BlinkMacSystemFont, "PingFang SC", Helvetica, Tahoma, Arial, "Hiragino Sans GB", "Microsoft YaHei", 微软雅黑, SimSun, 宋体, Heiti, 黑体, sans-serif;
        font-weight: lighter;
    }
    .center-container {
        width: 300px;
        opacity: 1;
        -webkit-transition: opacity 0.5s ease-in-out;
        -moz-transition: opacity 0.5s ease-in-out;
        transition: opacity 0.5s ease-in-out;
    }
    .form-container {
        width: 300px;
        margin-left: 0px;
        transition: margin-left 0.5s cubic-bezier(0.18, 0.36, 0.6, 1);
    }
    @media (min-width: 330px) {
        .center-container {
            position: absolute;
            padding-top: 1em;
            margin-left: -150px;
            bottom: 0;
            top: 0;
            left: 50%;
        }
    }
    </style>
</head>
<body>
    <div class="container">
    <div class="center-container">
        <div class="form-container">
            <form id="lgform" method="post" accept-charset="utf-8">
                <legend>管理员登录</legend>

                <div class="form-group">
                    <label for="stuid">学号</label>
                    <input type="text" class="form-control" id="stuid" name="stuid" placeholder="请输入学号">
                </div>
                <div class="form-group">
                    <label for="passwd">密码</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="请输入密码">
                </div>
                <div id="popup-captcha"></div>
                <button type="submit" id="lgbtn" class="btn btn-success">确认</button>
                <button id="regbtn" class="btn btn-info">激活账号</button>
            </form>
        </div>
    </div>
    </div>
    <!-- Load js libs only when the page is loaded. -->
    <script src="//cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?=DIR_BT?>js/bootstrap.min.js"></script>
    <script src="//static.geetest.com/static/tools/gt.js"></script>
    <!-- jsbn Js -->
    <script language="JavaScript" type="text/javascript" src="<?=DIR_JSBN?>jsbn.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?=DIR_JSBN?>prng4.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?=DIR_JSBN?>rng.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?=DIR_JSBN?>rsa.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var rsa_verify = function () {
                var stuid = $('#stuid').val(),
                    passwd = $('#passwd').val(),
                    publickey = '<?=$publickey?>',
                    rsakey = new RSAKey(),
                    enc, res;
                if (stuid === '' || passwd === '') {
                    alert('学号密码不能为空');
                    return;
                }
                try {
                    rsakey.setPublic(publickey, "10001");
                    enc = rsakey.encrypt(passwd);
                } catch (err) {
                    alert('系统错误，请联系管理员');
                }
                $.post('/user/lgcheck', {stuid:stuid, passwd: enc}, function(data) {
                    try {
                        res = JSON.parse(data);
                        switch (res.code) {
                            case 1:
                                window.location.href = '/user';
                                break;
                            case 0:
                                alert('学号密码不能为空');
                                break;
                            case -1:
                                alert('学号必须为8位数字');
                                break;
                            case -2:
                                alert('学号密码错误');
                                break;
                            case -3:
                                alert('解密失败，请联系管理员');
                                break;
                            case -4:
                                alert('请先激活账号');
                                break;
                            case -5:
                                alert('未完成验证');
                                break;
                            default:
                                alert('未知错误，请联系管理员');
                        }
                    } catch (err) {
                        alert('系统错误，请联系管理员');
                    }
                });
            },
            handlerPopup = function (captchaObj) {
                captchaObj.onSuccess(function () {
                    var validate = captchaObj.getValidate();
                    $.ajax({
                        url: "/geetest/verify", // 进行二次验证
                        type: "post",
                        dataType: "json",
                        data: {
                            geetest_challenge: validate.geetest_challenge,
                            geetest_validate: validate.geetest_validate,
                            geetest_seccode: validate.geetest_seccode
                        },
                        success: function (data) {
                            if (data && data.status && (data.status === "success")) {
                                rsa_verify();
                            } else {
                                alert('验证失败，请重新验证');
                            }
                        },
                        error: function () {
                            alert('系统错误，请联系管理员');
                        }
                    });
                });
                captchaObj.onError(function () {
                    alert('网络错误，请稍后重试');
                });
                captchaObj.onFail(function () {
                    alert('验证失败，请重新验证');
                });
                // 将验证码加到id为captcha的元素里
                captchaObj.appendTo("#popup-captcha");
                $("#lgbtn").click(function () {
                    event.preventDefault();
                    var stuid = $('#stuid').val(),
                        passwd = $('#passwd').val();
                    if (stuid === '' || passwd === '') {
                        alert('学号密码不能为空');
                        return;
                    }
                    if (!/^\d{8}$/.test(stuid)) {
                        alert('学号必须为8位数字');
                        return;
                    }
                    captchaObj.show();
                });
        };
        // 验证开始需要向网站主后台获取id，challenge，success（是否启用failback）
        $.ajax({
            url: "/geetest/init/" + (new Date()).getTime(), // 加随机数防止缓存
            type: "get",
            dataType: "json",
            success: function (data) {
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    product: "popup",
                    offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                    // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                }, handlerPopup);
            }
        });

        $('#regbtn').click(function(event) {
            event.preventDefault();
            window.location.href = '/user/activate';
        });
    });
    </script>
</body>

</html>
