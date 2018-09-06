<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>编辑信息修改</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Edit.css">
</head>
<body>
<?php
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    include dirname(__FILE__) . "/../common/backstage_top.php";
    include dirname(__FILE__) . "/../common/backstage_left.php";
    if(empty($_GET["id"])){
        echo "信息获取失败，<a href='editorList.php'>请重试</a>";
        header("Refresh: 1; url=editorList.php");
    }
    $id = $_GET["id"];
    $sql = "select * from user where id=$id";
    include_once dirname(__FILE__) . '/../common/db.php';
    $res = mysqli_query($con,$sql);
    mysqli_close($con);
    if(!$res){
        echo "信息获取失败，<a href='editorList.php'>请重试</a>";
        header("Refresh: 1; url=editorList.php");
    }
    $row = mysqli_fetch_array($res,1);
    if(!$row){
        echo "信息获取失败，<a href='editorList.php'>请重试</a>";
        header("Refresh: 1; url=editorList.php");
    }
?>
<div class="right">
    <div class="right-top">
        <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>编辑管理</span>
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>编辑信息修改</span>
    </div>
    <div class="right-content">
        <form action="../user/saveuserEdit.php" method="post" enctype="multipart/form-data">
            <input name="sid" type="hidden" value="<?php  echo $row["id"]?>"/>
            <input name="spic" type="hidden" value="<?php  echo $row["head_pic"]?>"/>
            <input name="srole_id" type="hidden" value="<?php echo $row["role_id"]?>"/>
            <div class="right-content-info">
                <div class="group" style="margin-bottom: 60px">
                    <div class="group-label">
                        <span>当前头像：</span>
                    </div>
                    <img class="img-thumbnail img-circle" style="width: 100px;height: 100px" src="<?php if(empty($row["head_pic"]))echo "../user/uploads/默认头像.jpg"; else echo $row["head_pic"] ?>"/>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>头像：</span>
                    </div>
                    <input type="file"  name="pic" class="form-control">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>昵称：</span>
                    </div>
                    <input type="text"  name="snickname" class="form-control" placeholder="昵称" maxlength="10" value="<?php  echo $row["nickname"]?>">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>年龄：</span>
                    </div>
                    <input type="text"  name="sage" class="form-control" placeholder="年龄" maxlength="3" value="<?php  echo $row["age"]?>">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>性别：</span>
                    </div>
                    <div class="radio-inline" style="margin-top: 15px">
                        <label>
                            <input type="radio" style="width: 15px;height: 15px"<?php if($row['sex'] == 1) echo "checked" ?> name="ssex" value="1">男&nbsp&nbsp&nbsp
                        </label>
                    </div>
                    <div class="radio-inline" style="margin-top: 14px">
                        <label>
                            <input type="radio"  style="width: 15px;height: 15px"<?php if($row['sex'] == 2) echo "checked" ?> name="ssex" value="2">女
                        </label>
                    </div>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>原密码：</span>
                    </div>
                    <input type="password" name="spasswordOld" class="form-control" maxlength="15" placeholder="原密码">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>新密码：</span>
                    </div>
                    <input type="password" name="spassword" class="form-control" maxlength="15" placeholder="新密码">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>确认新密码：</span>
                    </div>
                    <input type="password" name="spasswordcheck" class="form-control" maxlength="15" placeholder="确认新密码">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>个性签名：</span>
                    </div>
                    <textarea  name="ssignature" class="form-control" rows="3" maxlength="30" placeholder="个性签名" ><?php  echo $row["signature"]?></textarea>
                </div>
            </div>
            <div class="right-content-footer">
                <button  type="submit" class="btn btn-primary" style="width: 80px;height: 35px">保存</button>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <button  type="button" class="btn btn-default" style="width: 80px;height: 35px" onclick="window.location.href='<?php if($row["role_id"] == 2)echo "editorList.php";else echo "userList.php"?>?pageindex=<?php echo $_SESSION["pageindex"]-1?>'">返回</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>