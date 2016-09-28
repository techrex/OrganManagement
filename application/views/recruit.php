<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="WebSite of SSTA">
    <meta name="author" content="TechRex">
    <title>通信科协2016招新报名</title>
    <!-- <link rel="shortcut icon" href="<?=DIR_IMG?>gt_favicon.png"> -->
    <!-- Bootstrap itself -->
    <link href="<?=DIR_BT?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link href="<?=DIR_FA?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    body {
        background-color: #e8ebed;
        font-family: "Microsoft YaHei", helvetica;
        font-weight: lighter;
    }
    @media (min-width: 350px) {
        signup-container {
            position: absolute;
            left: 50%;
            width: 300px;
            margin-left: -150px;
        }
    }
    .img-responsive {
        width: 100%;
    }
    #signup-timer {
        margin: 0 auto;
        float: none;
    }

    .redCountdownValue span {
        font-family: "Microsoft Yahei";
    }

    .signup-header {
        box-shadow: 0 1px 5px -1px rgba(0, 0, 0, 0.4);
        margin-bottom: 15px;
        background-color: #fff;
    }

    .signup-header .list-group-item {
        border-radius: 0px;
        border: 0;
        border-top: 1px solid #ddd;
    }

    .signup-form {
        padding: 1em;
        /*box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);*/
        box-shadow: 0 1px 5px -1px rgba(0, 0, 0, 0.4);
        margin-bottom: 15px;
        background-color: #fff;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="signup-header">
            <ul class="list-group">
                <li class="list-group-item" style="padding:0">
                    <div class="signup-wrapper">
                        <img class="img-responsive center-block" src="<?=DIR_IMG?>recruit.jpg">
                    </div>
                </li>
                <li class="list-group-item">
                    <div id="signup-timer" class="center-block">
                        <div style="font-size:1em">距离报名结束还有</div>
                        <div id="rC_PE" class="redCountdownDemo"></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div id="signup-time" style="font-size:1em">
                    <strong>报名截止时间：9月30日晚24点</strong>
                    </div>
                </li>
                <li class="list-group-item">
                    <div id="signup-summary" style="font-size:1em">
                        <strong>报名方式：</strong>
                        <br>1、线上报名。
                        <br>2、纸质报名表请在9月30日前交到1教北楼102室
                        <br><strong>提示：</strong>
                        <br>填写学号就能查看已报名的信息啦~
                    </div>
                </li>
            </ul>
        </div>
        <div class="signup-form">
            <form action="/recruit/submit" method="post">
                <div class="form-group">
                    <label for="stuid" class="control-label">学号</label>
                    <input type="text" class="form-control" name="stuid" id="stuid" placeholder="请输入学号" data-validation="number_string" data-validation-length="8">
                </div>
                <div class="form-group">
                    <label for="realname" class="control-label">姓名</label>
                    <input type="text" class="form-control" name="realname" id="realname" placeholder="请输入姓名" data-validation="required" data-validation-error-msg="请填写姓名">
                </div>
                <div class="form-group">
                    <label for="sex" class="control-label">性别</label>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="1" data-validation="required" data-validation-error-msg="请选择性别">男
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="2" data-validation="required" data-validation-error-msg="请选择性别">女
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="class" class="control-label">班级</label>
                    <select class="form-control" id="class" name="class" data-validation="required" data-validation-error-msg="请选择班级">
                        <option value="0" selected disabled>请选择班级</option>
                        <option value="1">通信一班</option>
                        <option value="2">通信二班</option>
                        <option value="3">通信三班</option>
                        <option value="4">通信四班</option>
                        <option value="5">通信五班</option>
                        <option value="6">通信六班</option>
                        <option value="7">通信七班</option>
                        <option value="8">通信八班</option>
                        <option value="9">通信九班</option>
                        <option value="10">中英一班</option>
                        <option value="11">中英二班</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile_long" class="control-label">手机长号</label>
                    <input type="tel" class="form-control" name="mobile_long" id="mobile_long" placeholder="请输入手机长号" data-validation="number_string" data-validation-length="11">
                </div>
                <div class="form-group">
                    <label for="mobile_short" class="control-label">手机短号</label>
                    <input type="tel" class="form-control" name="mobile_short" id="mobile_short" placeholder="请输入手机短号" data-validation="number_string" data-validation-length="6" data-validation-optional="true">
                </div>
                <div class="form-group">
                    <label for="otherclub" class="control-label">参加其他社团情况</label>
                    <textarea name="otherclub" class="form-control" id="otherclub" rows="5" placeholder="亲请如实填写哦~" data-validation="required" data-validation-error-msg="没有参加别的社团也请写个无"></textarea>
                    <p style="float: right;color: #8d8d8d;">还可以输入<span id="maxlength1">300</span>字</p>
                </div>
                <div class="form-group">
                    <label for="resume" class="control-label">个人简历</label>
                    <textarea name="resume" class="form-control" id="resume" rows="5" placeholder="亲这里可以填特长，经历还有对通信科协的愿景哦~" data-validation="required" data-validation-error-msg="写一下介绍一下自己嘛"></textarea>
                    <p style="float: right;color: #8d8d8d;">还可以输入<span id="maxlength2">300</span>字</p>
                </div>
                <div class="form-group">
                    <button type="submit" id="submitbtn" class="btn btn-success">提交</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Load js libs only when the page is loaded. -->
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?=DIR_BT?>js/bootstrap.min.js"></script>
    <script src="<?=DIR_JS?>jquery.form-validator.js"></script>
    <!-- for timer -->
    <script src="<?=DIR_TIME?>jquery.knob.min.js"></script>
    <script src="<?=DIR_TIME?>jquery.ba-throttle-debounce.min.js"></script>
    <script src="<?=DIR_TIME?>jquery.redcountdown.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var form_validate = function() {
                var zh_cn = {
                    lengthBadStart: '必须是 ',
                    lengthBadEnd: ' 位',
                }
                $.validate({
                    language : zh_cn
                });
                $("#otherclub").restrictLength($('#maxlength1'));
                $("#resume").restrictLength($('#maxlength2'));
            }
            /*Timer Start*/
            var timeNow = new Date(),
                secNow = parseInt(timeNow.getTime()/1000),
                timeEnd = new Date(2016,8,30,24),
                secEnd = parseInt(timeEnd.getTime()/1000),
                secd = secEnd - secNow;
            $('#rC_PE').redCountdown({ preset: "flat-colors-very-fat", end: $.now() + secd });
            /*Timer End*/
            form_validate();
            $('#stuid').blur(function() {
                var stuid = $('#stuid').val();
                if (stuid && stuid.length == 8) {
                    $.post('/recruit/check', {stuid: stuid}, function(data) {
                        try {
                            var dataJson = JSON.parse(data);
                            if (dataJson.code && dataJson.code == 1) {
                                $('#realname').val(dataJson.msg.realname);
                                $("input[name='sex'][value='"+dataJson.msg.sex+"']").prop("checked", true);
                                $('#class').val(dataJson.msg.class);
                                $('#mobile_long').val(dataJson.msg.mobile_long);
                                $('#mobile_short').val(dataJson.msg.mobile_short);
                                $('#otherclub').val(dataJson.msg.otherclub);
                                $('#resume').val(dataJson.msg.resume);
                                alert('你已经报过名啦，直接提交即可更新报名信息');
                            }
                        } catch (e) {
                            return;
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
