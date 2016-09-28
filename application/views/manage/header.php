<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="WebSite of SSTA">
    <meta name="author" content="TechRex">
    <title>通信科协</title>
    <!-- Bootstrap 3.3.6 -->
    <link href="<?=DIR_BT?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=DIR_FA?>css/font-awesome.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=DIR_ADMIN?>css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=DIR_ADMIN?>css/skin-blue.min.css">
    <!-- Pace style -->
    <link href="<?=DIR_PACE?>css/pace-theme-minimal.css" rel="stylesheet">
<?php if (isset($extra_css)): ?>
<?php foreach ($extra_css as $each_css):?>
    <link rel="stylesheet" href="<?=$each_css?>">
<?php endforeach ;?>
<?php endif ?>
    <style type="text/css">
        .font-cn {
            font-family: -apple-system, BlinkMacSystemFont, "PingFang SC", Helvetica, Tahoma, Arial, "Hiragino Sans GB", "Microsoft YaHei", 微软雅黑, SimSun, 宋体, Heiti, 黑体, sans-serif !important;
        }
<?php if (isset($style)): ?>
<?=$style?>
<?php endif ?>
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><small>SSTA</small></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg font-cn">通信科协</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?=DIR_IMG?>user.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?=$realname?></span>
                        </a>
                        <ul class="dropdown-menu font-cn">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?=DIR_IMG?>user.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?=$realname?>
                                    <small>退休老干部</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">个人信息</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/user/lgout" class="btn btn-default btn-flat">登出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=DIR_IMG?>user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?=$realname?></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <!-- Optionally, you can add icons to the links -->
                <li <?php if($active=='dashboard'){echo 'class="active"';}?>><a href="/manage"><i class="fa fa-dashboard"></i> <span class="font-cn">首页</span></a></li>
                <li <?php if($active=='recruit'){echo 'class="active"';}?>><a href="/manage/recruit"><i class="fa fa-user-plus"></i> <span class="font-cn">招新报名</span></a></li>
                <!-- <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li> -->
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="font-cn">
                <?=$content_title?>
                <small><?=$content_des?></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
