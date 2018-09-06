<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>资讯信息修改</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Edit.css">
</head>
<body>
<?php
    include dirname(__FILE__) . "/../common/checkEditor.php";
    include dirname(__FILE__) . "/../common/backstage_top.php";
    include dirname(__FILE__) . "/../common/backstage_left.php";
        if(empty($_GET["news_id"])){
            echo "信息获取失败，<a href='newsList.php'>请重试</a>";
            header("Refresh: 1; url=newsList.php");
        }
        $news_id = $_GET["news_id"];
        $sql = "select * from news left join newstype on news.type_id=newstype.type_id where news_id=$news_id";
        include_once dirname(__FILE__) . '/../common/db.php';
        $res = mysqli_query($con,$sql);
        if(!$res){
            echo "信息获取失败，<a href='newsList.php'>请重试</a>";
            header("Refresh: 1; url=newsList.php");
        }
        $row = mysqli_fetch_array($res,1);
        if(!$row){
            echo "信息获取失败，<a href='newsList.php'>请重试</a>";
            header("Refresh: 1; url=newsList.php");
        }
?>
<div class="right">
    <div class="right-top">
        <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>资讯管理</span>
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>资讯信息修改</span>
    </div>
    <div class="right-content">
        <form action="../news/saveEdit.php?editor_id=<?php echo $row['editor_id'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $row['news_id'] ?>" />
            <input type="hidden" name="spic" value="<?php echo $row['pic'] ?>" />
            <input type="hidden" name="stype" value="<?php echo $row['type'] ?>" />
            <div class="right-content-info">
                    <div class="group">
                        <div class="group-label">
                            <span>资讯标题：</span>
                        </div>
                        <input type="text" class="form-control" name="stitle" placeholder="资讯标题" value="<?php echo $row['title'] ?>">
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>资讯类型：</span>
                        </div>
                        <div class="group-sel">
                            <select class="form-control" name="stype_id">
                                <option value="1"<?php  if( $row["type_id"] == 2) echo "selected ='selected'" ?>>电视剧</option>
                                <option value="2"<?php  if( $row["type_id"] == 2) echo "selected ='selected'" ?>>电影</option>
                                <option value="3"<?php  if( $row["type_id"] == 3) echo "selected ='selected'" ?>>动漫</option>
                                <option value="4"<?php  if( $row["type_id"] == 4) echo "selected ='selected'" ?>>小说</option>
                                <option value="5"<?php  if( $row["type_id"] == 5) echo "selected ='selected'" ?>>综艺</option>
                            </select>
                        </div>
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>国家：</span>
                        </div>
                        <div class="group-sel">
                            <select class="form-control" name="scountry">
                                <option value="中国"<?php  if( $row["country"] == "中国") echo "selected ='selected'" ?>>中国</option>
                                <option value="欧美"<?php  if( $row["country"] == "欧美") echo "selected ='selected'" ?>>欧美</option>
                                <option value="日韩"<?php  if( $row["country"] == "日韩") echo "selected ='selected'" ?>>日韩</option>
                                <option value="泰国"<?php  if( $row["country"] == "泰国") echo "selected ='selected'" ?>>泰国</option>
                                <option value="印度"<?php  if( $row["country"] == "印度") echo "selected ='selected'" ?>>印度</option>
                            </select>
                        </div>
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>语种：</span>
                        </div>
                        <div class="group-sel">
                            <select class="form-control" name="slanguage">
                                <option value="华语"<?php  if( $row["language"] == "华语") echo "selected ='selected'" ?>>华语</option>
                                <option value="英语"<?php  if( $row["language"] == "英语") echo "selected ='selected'" ?>>英语</option>
                                <option value="德语"<?php  if( $row["language"] == "德语") echo "selected ='selected'" ?>>德语</option>
                                <option value="日语"<?php  if( $row["language"] == "日语") echo "selected ='selected'" ?>>日语</option>
                                <option value="法语"<?php  if( $row["language"] == "法语") echo "selected ='selected'" ?>>法语</option>
                                <option value="泰语"<?php  if( $row["language"] == "法语") echo "selected ='selected'" ?>>泰语</option>
                                <option value="印度语"<?php  if( $row["language"] == "法语") echo "selected ='selected'" ?>>印度语</option>
                            </select>
                        </div>
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>评分：</span>
                        </div>
                        <input type="text" class="form-control" name="sscore" placeholder="评分" value="<?php echo $row['score'] ?>">
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>编辑：</span>
                        </div>
                        <div class="group-sel">
                            <select class="form-control" name="seditor">
                                <?php
                                $res_editor = mysqli_query($con, "select * from user where role_id=2");
                                if ($res_editor) {
                                    if($_SESSION["role_id"] == 1){
                                        while ($row_editor = mysqli_fetch_array($res_editor, MYSQLI_ASSOC)){
                                            ?>
                                            <option value="<?php echo $row_editor["id"] ?>" <?php if($row_editor["id"] == $row["editor_id"]) echo "selected='selected'"?>><?php echo $row_editor["account"] ?></option>
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
                        <textarea class="form-control" rows="2" name="sabstract" placeholder="资讯摘要" ><?php echo $row['abstract'] ?></textarea>
                    </div>
                    <div class="group">
                        <div class="group">
                            <div class="group-label">
                                <span>资讯配图：</span>
                            </div>
                            <input type="file" class="form-control" name="spic" >
                        </div>
                    </div>
                    <div class="group">
                        <div class="group-label">
                            <span>当前配图：</span>
                        </div>
                            <img class="img-thumbnail" style="width: 110px;height: 150px" src="<?php echo $row["pic"]?>"/>
                     </div>
                </div>
                <div class="right-content-footer">
                    <button  type="submit" class="btn btn-primary" style="width: 80px;height: 35px">保存</button>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button  type="button" class="btn btn-default" style="width: 80px;height: 35px" onclick="window.location.href='newsList.php?pageindex=<?php echo $_SESSION["pageindex"]-1?>'">返回</button>
                </div>
        </form>
    </div>
</div>
</body>
</html>