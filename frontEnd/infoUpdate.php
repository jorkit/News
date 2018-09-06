<?php
include dirname(__FILE__) . "/../common/login_top.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>信息修改</title>
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/infoUpdate.css">
    <style>
        .pic .inputCheck {position: absolute;width: 180px;height: 180px;float: left;
            visibility: hidden;}
        .pic .inputCheck+label{display: inline-block;width: 180px;height: 180px;border-radius: 90px;
            background: url(<?php if(!empty($_SESSION["head_pic"]))echo $_SESSION["head_pic"];else echo "../user/uploads/默认头像.jpg" ?>);background-size:180px 180px;}
    </style>
</head>
<body>
<?php
    $user_id = $_SESSION["user_id"];
    include_once dirname(__FILE__) . "/../common/db.php";
    $res = mysqli_query($con,"select * from user where id=$user_id");
    mysqli_close($con);
    if($res){
        $row = mysqli_fetch_array($res,1);
    }
    else{
        ?>
        <script type="text/javascript">
            alert("信息读取失败！")
        </script>
        <?php header("Refresh: 0.01; url=homePage.php");
        die;
}
?>
<div class="main2">
    <div class="content">
        <div class="content-left">
            <ul class="nav .nav-stacked">
                <li role="presentation" class="active ">个人中心</li>
                <li role="presentation" ><a href="#">个人信息</a></li>
            </ul>
        </div>
        <form action="../user/saveInfo.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="spic" value="<?php echo $row["head_pic"]?>">
            <div class="content-right">
                <div class="content-right-top">
                    <b style="width: 30px;display:inline-block"></b>
                    我的信息
                </div>
                <div class="info-list1">
                    <div class="info-headphoto">
                        <div class="pic">
                            <input type="file" name="pic" class="inputCheck" id="agreement"><label for="agreement"></label>
                        </div>
                    </div>
                </div>
                <div class="info-line">
                    <div class="info-list2">
                            <div class="info-list2-left">
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >昵称：</label>
                                    </div>
                                    <input type="text" name="snickname" class="form-control" placeholder="你的昵称" maxlength="10" value="<?php echo $row["nickname"]?>">
                                </div>
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >年龄：</label>
                                    </div>
                                    <input type="text" name="sage" class="form-control" placeholder="你的年龄" maxlength="3" value="<?php echo $row["age"]?>">
                                </div>
                                <div class="form-group">
                                    <label for="ssex" class="control-label">性别：</label>
                                    <div class="info-user2">
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" <?php if($row['sex'] == 1) echo "checked" ?> name="ssex" value="1">&nbsp;&nbsp;男
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" <?php if($row['sex'] == 2) echo "checked" ?> name="ssex" value="2">&nbsp&nbsp女
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >原密码：</label>
                                    </div>
                                    <input type="password" name="spasswordOld" class="form-control" placeholder="原始密码" maxlength="15">
                                </div>
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >密码：</label>
                                    </div>
                                    <input type="password" name="spassword" class="form-control" placeholder="新的密码" maxlength="15">
                                </div>
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >确认密码：</label>
                                    </div>
                                    <input type="password" name="spasswordcheck" class="form-control" placeholder="再次输入新的密码" maxlength="15">
                                </div>
                                <div class="group">
                                    <div class="info-user">
                                        <label class="info-lab" >个性签名：</label>
                                    </div>
                                    <textarea class="form-control" rows="2" name="ssignature" maxlength="30" ><?php echo $row["signature"]?></textarea>
                                </div>
                            </div>
                            <div class="info-list2-right">
                                <div class="info-list3">
                                    <button id="form_submit" type="submit" class="btn btn-default" style="width: 82px;height: 32px">保存</button>
                                    <div>&nbsp</div>
                                    <div>&nbsp</div>
                                    <input type="button" class="btn btn-default" value="返回" onclick="window.location.href='userInfo.php'" style="width: 82px;height: 32px">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include dirname(__FILE__) . "/../common/footer.php";
?>
</body>
</html>
