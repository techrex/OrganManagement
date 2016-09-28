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
    <title>提示</title>
    <!-- <link rel="shortcut icon" href="<?=DIR_IMG?>gt_favicon.png"> -->
    <!-- Bootstrap itself -->
    <link href="<?=DIR_BT?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link href="<?=DIR_FA?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .container {
            padding-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-<?=$type?>" role="alert">
            <?=$msg?>
        </div>
    </div>
    <!-- Load js libs only when the page is loaded. -->
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?=DIR_BT?>js/bootstrap.min.js"></script>

</body>
</html>
