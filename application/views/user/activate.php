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
    .success-container {
        display: none;
        width: 300px;
        margin-left: 0px;
        text-align: center;
    }
    .success-container .img-mail {
        display: block;
        width: 100px;
        margin: auto;
    }
    .success-container .success-title {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
    }
    .success-container .success-body {
        font-size: 16px;
        margin: 8px 0;
        line-height: 1.5em;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="center-container">
            <div class="form-container">
                <form id="actform" method="post" accept-charset="utf-8">
                    <legend>账号激活</legend>
                    <div class="form-group">
                        <label for="stuid">学号</label>
                        <input type="text" class="form-control" name="stuid" id="stuid" placeholder="请输入学号">
                    </div>
                    <div id="popup-captcha"></div>
                    <button type="submit" id="actbtn" class="btn btn-success">确认</button>
                    <button id="lgbtn" class="btn btn-info">返回登录</button>
                </form>
            </div>
            <div class="success-container">
                <img src="<?=DIR_IMG?>mail.png" class="img-mail" alt="Image">
                <div class="success-title">已发送验证邮件</div>
                <div class="success-body">点击邮箱中的链接即可完成激活</div>
                <button id="emailbtn" class="btn btn-success">点击按钮前往邮箱</button>
            </div>
        </div>
    </div>
    <!-- Load js libs only when the page is loaded. -->
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?=DIR_BT?>js/bootstrap.min.js"></script>
    <script src="//static.geetest.com/static/tools/gt.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var token = '<?=$token?>',
            emailUrl,
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
                            var stuid = $('#stuid').val();
                            if (data && (data.status === "success")) {
                                $.post('/user/actcheck', {stuid: stuid, token: token}, function(data) {
                                    try {
                                        res = JSON.parse(data);
                                        if (res && res.token) {
                                            token = res.token;
                                        }
                                        switch (res.code) {
                                            case 1: // activate
                                            case 2: // reactivate
                                                if (res && res.emailUrl) {
                                                    emailUrl = res.emailUrl;
                                                }
                                                actAnimate();
                                                break;
                                            case 0:
                                                alert('学号不能为空');
                                                break;
                                            case -1:
                                                alert('学号必须为8位数字');
                                                break;
                                            case -2:
                                                alert('未知的学号');
                                                break;
                                            case -3:
                                                alert('该账户已激活，请勿重复激活');
                                                break;
                                            case -4:
                                                alert('Token已失效，请刷新页面后重试');
                                                break;
                                            case -5:
                                                alert('未完成验证');
                                                break;
                                            case -6:
                                                alert('邮件发送失败，请联系管理员');
                                                break;
                                            default:
                                                alert('未知错误，请联系管理员');
                                        }
                                    } catch (err) {
                                        alert('系统错误，请联系管理员');
                                    }
                                });
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
                $("#actbtn").click(function () {
                    event.preventDefault();
                    var stuid = $('#stuid').val();
                    if (stuid === '') {
                        alert('学号不能为空');
                        return;
                    }
                    if (!/^\d{8}$/.test(stuid)) {
                        alert('学号必须为8位数字');
                        return;
                    }
                    isActed = false;
                    callbackAction = 'activate';
                    captchaObj.show();
                });
            },
            actAnimate = function () {
                $('.center-container').css('opacity', '0');
                $('.form-container').css('margin-left', '-30px');
                setTimeout(function() {
                    $('.form-container').css('display', 'none');
                    $('.success-container').css('display', 'block');
                    $('.center-container').css('opacity', '1');
                }, 500);
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
        $('#emailbtn').click(function(event) {
            event.preventDefault();
            if (emailUrl) {
                window.location.href = emailUrl;
            } else {
                alert('没有解析出邮箱网址，请你自己手动打开邮箱');
            }
        });
        $('#lgbtn').click(function(event) {
            event.preventDefault();
            window.location.href = '/user/login';
        });
    });
    </script>
</body>
</html>
