<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>授权管理</title>
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/List.css">
</head>
<body>
<?php
include_once dirname(__FILE__) . "/../common/checkadmin.php";
include dirname(__FILE__) . "/../common/backstage_top.php";
include dirname(__FILE__) . "/../common/backstage_left.php";
?>
<div class="right">
    <div class="right-top">
        <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>授权管理</span>
    </div>
    <div class="right-search">
        <form action="" method="post">
            <label >关键字：</label>
            <input type="text" class="form-control" placeholder="关键字">
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <div class="right-content">
        <div class="right-content-table">
            <table class="table table-bordered">
                <thead>
                <tr >
                    <th style="width: 7%;vertical-align: middle;">编号</th>
                    <th style="width: 10%;vertical-align: middle;">角色</th>
                    <th style="width: 10%;vertical-align: middle;">操作</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;">1</td>
                        <td style="vertical-align: middle;">编辑</td>
                        <td style="vertical-align: middle;"><a href="authorityEdit.php?role_id=2" type="submit" class="btn  btn-primary btn-sm">授权</a></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;">2</td>
                        <td style="vertical-align: middle;">普通用户</td>
                        <td style="vertical-align: middle;"><a href="authorityEdit.php?role_id=3" type="submit" class="btn  btn-primary btn-sm">授权</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>