<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加资讯</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Edit.css">
</head>
<body>
<?php
include_once dirname(__FILE__) . "/../common/checkRole.php";
include dirname(__FILE__) . "/../common/backstage_top.php";
include dirname(__FILE__) . "/../common/backstage_left.php";
?>
<div class="right">
    <div class="right-top">
        <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>资讯管理</span>
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>添加资讯</span>
    </div>
    <div class="right-content">
        <form action="../news/saveAdd.php" method="post" enctype="multipart/form-data">
            <div class="right-content-info">
                <div class="group">
                    <div class="group-label">
                        <span>资讯标题：</span>
                    </div>
                    <input type="text" class="form-control" name="stitle" placeholder="资讯标题">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>资讯类型：</span>
                    </div>
                    <div class="group-sel">
                        <select class="form-control" name="stype_id">
                            <option value="1">电视剧</option>
                            <option value="2">电影</option>
                            <option value="3">动漫</option>
                            <option value="4">小说</option>
                            <option value="5">综艺</option>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>资讯配图：</span>
                    </div>
                    <input type="file" class="form-control" name="spic">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>国家：</span>
                    </div>
                    <div class="group-sel">
                        <select class="form-control" name="scountry">
                            <option value="中国">中国</option>
                            <option value="欧美">欧美</option>
                            <option value="日韩">日韩</option>
                            <option value="泰国">泰国</option>
                            <option value="印度">印度</option>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>语种：</span>
                    </div>
                    <div class="group-sel">
                        <select class="form-control" name="slanguage">
                            <option value="华语">华语</option>
                            <option value="英语">英语</option>
                            <option value="德语">德语</option>
                            <option value="日语">日语</option>
                            <option value="法语">法语</option>
                            <option value="泰语">泰语</option>
                            <option value="印度语">印度语</option>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>评分：</span>
                    </div>
                    <input type="text" class="form-control" name="sscore" placeholder="评分">
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>编辑：</span>
                    </div>
                    <div class="group-sel">
                        <select class="form-control" name="seditor">
                            <?php
                                include_once dirname(__FILE__) . "/../common/db.php";
                                $res = mysqli_query($con, "select * from user where role_id=2");
                                if ($res) {
                                    if($_SESSION["role_id"] == 1){
                                         while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                              ?>
                                        <option value="<?php echo $row["id"] ?>"><?php echo $row["account"] ?></option>
                             <?php      }
                                    }
                                    else{
                                        ?>
                                        <option value="<?php echo $_SESSION["user_id"] ?>"><?php echo $_SESSION["account"] ?></option>
                              <?php }
                               }
                              ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="group-label">
                        <span>资讯摘要：</span>
                    </div>
                    <textarea class="form-control" name="sabstract" rows="2" placeholder="资讯摘要"></textarea>
                </div>
            </div>
            <div class="right-content-footer">
                <button  type="submit" class="btn btn-primary" style="width: 80px;height: 35px">添加</button>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <button  type="button" class="btn btn-default" style="width: 80px;height: 35px" onclick="window.location.href='newsList.php?pageindex=<?php echo $_SESSION["pageindex"]-1?>'">返回</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>