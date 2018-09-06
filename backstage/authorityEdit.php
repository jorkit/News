<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>角色授权</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/List.css">
</head>
<body>
<?php
    include dirname(__FILE__) . "/../common/backstage_top.php";
    include dirname(__FILE__) . "/../common/backstage_left.php";
    include_once dirname(__FILE__) . "/../common/db.php";
    $res = mysqli_query($con,"select * from route");
    mysqli_close($con);
    if(!$res){
        echo "信息获取失败";
        header("Refresh: 1; url='authority.php'");die;
    }
?>
    <div class="container">
        <form action="" method="post">
        <div class="text-center">
            <h2>编辑角色</h2>
        </div>
        <table  class="table">
            <tr>
                <th class="text-left">编号</th>
                <th class="text-center">类型</th>
                <th class="text-right">授权</th>
            </tr>
            <tr>
                <?php
                while($row = mysqli_fetch_array($res,1)){
                ?>
                <td class="text-left">1</td>
                <td class="text-center">操作</td>
                <td class="text-right" >
                    <div style="vertical-align: middle">
                        <input type="checkbox"  value="1">
                    </div>
                </td>
        <?php}
          ?>
            </tr>
        </table>
        <div class="right-content-footer">
            <button  type="submit" class="btn btn-primary" style="width: 80px;height: 35px">保存</button>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <button  type="button" class="btn btn-default" style="width: 80px;height: 35px" onclick="window.location.href='authority.php'">返回</button>
        </div>
        </form>
    </div>
</body>
</html>