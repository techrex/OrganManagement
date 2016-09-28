<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WebSite of SSTA">
    <meta name="author" content="TechRex">
    <title>通信科协</title>
    <!-- <link rel="shortcut icon" href="<?=DIR_IMG?>gt_favicon.png"> -->
    <!-- Bootstrap itself -->
    <link href="<?=DIR_BT?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?=DIR_CSS?>magister.css">
    <!-- Fonts -->
    <link href="<?=DIR_FA?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Fonts:English -->
    <!-- <link href='http://fonts.useso.com/css?family=Wire+One' rel='stylesheet' type='text/css'> -->
    <!-- Fonts:通信科协 -->
    <!-- <link href='http://www.youziku.com/webfont/CSS/ebe31e759b693619aa648ac5260508be' rel='stylesheet' type='text/css'/> -->
    <style type="text/css">
    html {
        background:#505D6E url(<?=DIR_IMG?>back.jpg) no-repeat center center fixed;
    }

    @font-face {
        font-family: 'Wire One';
        font-style: normal;
        font-weight: 400;
        src: local('Wire One'), local('WireOne'), url(<?=DIR_FONT?>wireOne.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
    }

    @font-face {
        font-family: 'Source-Han-Light462401';
        src: url("<?=DIR_FONT?>Source-Han-Light.woff");
        font-weight: normal;
        font-style: normal;
    }

    .zh-cn {
        font-family: "Microsoft Jhenghei", "Microsoft Yahei";
    }

    .zh-cn.title {
        font-family: "Microsoft Jhenghei", "Source-Han-Light462401","Microsoft Yahei";
        font-size: 5em;
        font-weight: lighter;
    }

    .subtitle {
        font-size: 4.5em;
    }

    .zh-cn.btn-lg{
        font-size: 1.3em;
    }

    .section .container {
        margin-top: -1.5em;
    }

    .model-list {
        margin-top: 0;
        text-align: left;
    }
    </style>
</head>
<!-- use "theme-invert" class on bright backgrounds, also try "text-shadows" class -->

<body class="theme-invert">
    <nav class="mainmenu">
        <div class="container">
            <div class="dropdown">
                <button type="button" class="navbar-toggle" data-toggle="dropdown"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <!-- <a data-toggle="dropdown" href="#">Dropdown trigger</a> -->
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="#head" class="active">Hello World</a></li>
                    <li><a href="#introduction">Introduction</a></li>
                    <li><a href="#model">Model</a></li>
                    <li><a href="#contact">Get in touch</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main (Home) section -->
    <section class="section" id="head">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">
                    <!-- Site Title, your name, HELLO msg, etc. -->
                    <h1 class="zh-cn title">通信科协</h1>
                    <h2 class="subtitle">Let's make something interesting.</h2>
                    <!-- Short introductory (optional) -->
                    <h3 class="zh-cn tagline">一个让任何人都有机会提出想法，并在此分享、实践、交流的实验室平台<br>一个为提高通信学子动手实践能力与全面提升专业素养的技术型学生组织</h3>
                    <!-- Nice place to describe your site in a sentence or two -->
                    <p><a href="/recruit" class="zh-cn btn btn-default btn-lg">在线报名</a></p>
                    <!-- <p><a href="#" class="zh-cn btn btn-default btn-lg" disabled>系统维护中</a></p> -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
    </section>
    <!-- Second (About) section -->
    <section class="section" id="introduction">
        <div class="container">
            <h2 class="zh-cn text-center title">协会简介</h2>
            <div class="row">
                <div class="zh-cn tagline col-sm-8 col-sm-offset-2">
                    <br>
                    <p>　　通信科协，全称通信工程学院学生科技协会，隶属于杭州电子科技大学通信工程学院，是一个让任何人都有机会提出想法，并在此分享、实践、交流的实验室平台，是一个为提高通信学子动手实践能力与全面提升专业素养的技术型学生组织。通信科协由学院内对各类技术感兴趣的同学组成，是一个相对自由的协会，拥有自己的实验室和实验器材。科协专注于技术，内部结构较为简单，下设器件部，负责协会经费规划，设备管理和元器件采购；组织部，负责协会日常活动的组织和通知。科协的主要研究方向有单片机自动化控制、通信原理、高频通信电路、四旋翼飞行器、EDA仪器仪表、嵌入式系统等。
                        <!-- <br>在这里不仅可以充实自己，展现与发展你的技能和设计
                    <br>更可以结识在不同行业却有共同爱好及理想的朋友。
                    <br>可以使用协会里的实验设备，电子元器件和各种工具。
                    <br>自由开放的协作空间，给你提供一个舒适的创造环境。
                    <br>定期举行各种讨论活动和培训课程 -->
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Third (Works) section -->
    <section class="section" id="model">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">
                    <!-- Site Title, your name, HELLO msg, etc. -->
                    <h1 class="zh-cn title">优秀成员</h1>
                    <h2 class="subtitle">Who is next</h2>
                    <!-- Short introductory (optional) -->
                    <h3 class="zh-cn model-list tagline col-sm-6 col-sm-offset-3">
                        陈冲　　　杭州海康威视数字技术股份有限公司<br>
                        杜菲凡　　美国国家仪器有限公司（NI）<br>
                        何佩轩　　北京邮电大学研究生<br>
                        胡舜峰　　中国移动通信集团<br>
                        黄龙　　　杭州超距科技有限公司<br>
                        姜梦梅　　电子科技大学研究生<br>
                        林大凯　　上海交通大学研究生<br>
                        任青春　　杭州海康威视数字技术股份有限公司<br>
                        石学诚　　阿里巴巴网络技术有限公司<br>
                        王少华　　浙江宇视科技有限公司<br>
                        王忠耀　　华为技术有限公司<br>
                        吴旷　　　香港大学研究生<br>
                        徐勇　　　浙江大华技术股份有限公司<br>
                        张涛　　　上海交通大学研究生<br>
                        周博坤　　北京瑞荻互动科技有限公司<br>
                        曾泓杰　　杭州华三通信技术有限公司<br>
                        More . . .
                    </h3>
                    <!-- Nice place to describe your site in a sentence or two -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
    </section>
    <!-- Fourth (Contact) section -->
    <section class="section" id="contact">
        <div class="container">
            <h2 class="text-center title">Get in touch</h2>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <p class="zh-cn lead">欢迎来1教北102实验室面基 :)</p>
                    <p class="zh-cn lead"><a href="http://jq.qq.com/?_wv=1027&k=2L7N7Tg">2015通信科协新生群：561440652</a></p>
                    <p class="zh-cn lead">
                        <a href="http://blog.hdussta.cn">协会博客：blog.hdussta.cn</a>
                    </p>
                    <p class="zh-cn lead">协会Github等正在建设中。。。敬请期待</p>
                    <!-- <p>Feel free to email me, or drop me a line in Twitter!</p>
                    <p><b>gt@gettemplate.com</b>
                        <br>
                        <br>
                    </p>
                    <ul class="list-inline list-social">
                        <li><a href="https://twitter.com/serggg" class="btn btn-link"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
                        <li><a href="https://github.com/pozhilov" class="btn btn-link"><i class="fa fa-github fa-fw"></i> Github</a></li>
                        <li><a href="http://linkedin/in/pozhilov" class="btn btn-link"><i class="fa fa-linkedin fa-fw"></i> LinkedIn</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Load js libs only when the page is loaded. -->
    <script src="<?=DIR_JS?>jquery.min.js"></script>
    <script src="<?=DIR_BT?>js/bootstrap.min.js"></script>
    <!--<script src="assets/js/modernizr.custom.72241.js"></script> -->
    <!-- Custom template scripts -->
    <script src="<?=DIR_JS?>magister.js"></script>
</body>

</html>
