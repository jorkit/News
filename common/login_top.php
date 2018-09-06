<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/login_top.css"/>
</head>
<body>
<div class="main">
    <div>
        <div class="top">
            <div class="nav">
                <div class="nav-glass">
                </div>
                <div class="nav-menu col-lg-offset-2 col-xs-offset-2 ">
                    <div class="nav-menu-left">
                        <ul>
                            <li>
                                <img src="../common/background/LOGO.png" style="margin: 0 5px 10px 0">
                                <a href="../frontEnd/homePage.php">起始站</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-menu-right">
                        <ul>
                            <?php
                            session_start();
                            if(!empty($_SESSION["user_id"])){
                                ?>
                                <li>
                                    <a href="../frontEnd/logout.php">下车</a>
                                </li>
                                <?php
                                switch($_SESSION["role_id"]){
                                    case 1:
                                        ?><li><a href='../backstage/home.php'>&nbsp管理</a></li>
                                        <?php break;
                                    case 2:
                                        ?><li><a href="../backstage/home.php">&nbsp工作</a></li>
                                        <?php break;
                                    case 3: break;
                                    default: break;
                                } ?>
                                <li>
                                    <a href="../frontEnd/userInfo.php"><?php echo $_SESSION["nickname"] ?></a>
                                </li>
                            <?php }
                            else if(empty($_SESSION["user_id"])){
                                ?>
                                <li>
                                    <a href="../frontEnd/login.php"><?php echo "上车" ?></a>
                                </li>
                            <?php }?>
                            <li>
                                <?php if(empty($_SESSION["user_id"])){ ?>
                                    <a href="../frontEnd/login.php"><img style="width: 38px;height: 38px;" class="img-circle" src="../user/uploads/默认头像.jpg"></a>
                                <?php }
                                else if(!empty($_SESSION["head_pic"])){?>
                                    <a href="../frontEnd/userInfo.php"><img style="width: 35px;height: 35px;" class="img-circle" src="<?php echo $_SESSION["head_pic"]?>"></a>
                                <?php }
                                else{?>
                                    <a href="../frontEnd/userInfo.php"><img style="width: 35px;height: 35px;" class="img-circle" src="../user/uploads/默认头像.jpg"></a>
                                <?php }?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="photo">
                <img src="../common/background/clound.png">
            </div>
        </div>
    </div>
</div>
</body>
</html>