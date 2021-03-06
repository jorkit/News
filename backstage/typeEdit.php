<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>类型修改</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Edit.css">
</head>
<body>
<?php
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    include dirname(__FILE__) . "/../common/backstage_top.php";
    include dirname(__FILE__) . "/../common/backstage_left.php";
    if(empty($_GET["type_id"])){
        echo "信息获取失败，<a href='typeList.php'>请重试</a>";
        header("Refresh: 1; url=typeList.php");
    }
    $id = $_GET["type_id"];
    $sql = "select * from newstype where type_id=$id";
    include_once dirname(__FILE__) . '/../common/db.php';
    $res = mysqli_query($con,$sql);
    mysqli_close($con);
    if(!$res){
        echo "信息获取失败，<a href='typeList.php'>请重试</a>";
        header("Refresh: 1; url=typeList.php");
    }
    $row = mysqli_fetch_array($res,1);
    if(!$row){
        echo "信息获取失败，<a href='typeList.php'>请重试</a>";
        header("Refresh: 1; url=typeList.php");
    }
?>
    <div class="right">
        <div class="right-top">
            <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            <span>用户管理</span>
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            <span>类型修改</span>
        </div>
        <div class="right-content">
            <form action="../type/saveEdit.php" method="post">
                <input name="sid" type="hidden" value="<?php echo $row["type_id"]?>"/>
                <div class="right-content-info">
                    <div class="group" style="padding: 200px">
                        <div class="group-label">
                            <span>类型：</span>
                        </div>
                        <input type="text" class="form-control" name="stype" placeholder="类型名称" value="<?php echo $row["type"]?>">
                    </div>
                </div>
                <div class="right-content-footer">
                    <button  type="submit" class="btn btn-primary" style="width: 80px;height: 35px">保存</button>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button  type="button" class="btn btn-default" style="width: 80px;height: 35px" onclick="window.location.href='typeList.php?pageindex=<?php echo $_SESSION["pageindex"]-1?>'">返回</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>