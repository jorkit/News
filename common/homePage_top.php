
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/homePage_top.css">
</head>
<body>
<div class="main">
    <div class="navbar navbar-fixed-top">
        <div class="top">
            <div class="nav">
                <div class="nav-glass">
                </div>
                <div class="nav-menu ">
                    <div class="nav-menu-left">
                        <ul>
                            <li>
                                <a href="../frontEnd/homePage.php">
                                    <img src="../common/background/LOGO.png" style="margin: 0 5px 10px 0">
                                </a>
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
                                    <?php
                                        if(!empty($_SESSION["head_pic"])){?>
                                            <a href="../frontEnd/userInfo.php"><img style="width: 35px;height: 35px;" class="img-circle" src="<?php echo $_SESSION["head_pic"]?>"></a>
                                        <?php }
                                        else{?>
                                            <a href="../frontEnd/userInfo.php"><img style="width: 35px;height: 35px;" class="img-circle" src="../user/uploads/默认头像.jpg"></a>
                                        <?php }?>
                                    </li>
                                    <li>
                                        <a href="../frontEnd/userInfo.php"><?php echo $_SESSION["nickname"] ?></a>
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
                                    }
                             ?>
                                    <li>
                                        <a href="../frontEnd/logout.php">下车</a>
                                    </li>
                                <?php }
                                    else if(empty($_SESSION["user_id"])){
                                    ?>
                                     <li>
                                         <a href="../frontEnd/login.php"><img style="width: 38px;height: 38px;" class="img-circle" src="../user/uploads/默认头像.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="../frontEnd/login.php"><?php echo "上车" ?></a>
                                    </li>
                                    <?php }?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav2">
            <div class="nav2-menu">
                <div class="nav2-menu-content">
                    <ul>
                        <li>
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            <a href="../frontEnd/homePage.php">首页</a>
                        </li>
                        <li>
                            <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>
                            <a href="../frontEnd/partition.php?type_id=1">电视剧</a>
                        </li>
                        <li>
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                            <a href="../frontEnd/partition.php?type_id=2">电影</a>
                        </li>
                        <li>
                            <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                            <a href="../frontEnd/partition.php?type_id=3">动漫</a>
                        </li>
                        <li>
                            <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                            <a href="../frontEnd/partition.php?type_id=4">小说</a>
                        </li>
                        <li>
                            <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                            <a href="../frontEnd/partition.php?type_id=5">综艺</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>