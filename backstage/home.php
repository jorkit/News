<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理系统</title>
</head>
<style>
    .home-content{
        width: 87%;
        height: 895px;
        float: left;
    }
</style>
<body>
<?php
include_once dirname(__FILE__) . "/../common/checkRole.php";
include dirname(__FILE__) . "/../common/backstage_top.php";
include dirname(__FILE__) . "/../common/backstage_left.php";
?>
<div class="home-content">
    <img src="../common/background/backstage_bg.jpg" style="width: 100%;height: 100%">
</div>
</body>
</html>