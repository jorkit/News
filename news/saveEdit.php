<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/7/18
     * Time: 10:39
     */
    //检验参数是否有效
    include_once dirname(__FILE__) . "/../common/checkEditor.php";
    $editor_id = $_GET["editor_id"];
    $type = $_POST["stype"];
    $type_gbk = iconv("UTF-8", "gbk", $_POST["stype"]);
    if(empty($id=$_POST["sid"])){
        echo "信息获取失败，<a href='../backstage/newsList.php'>请重试</a>";
        header("Refresh: 1; url=../backstage/newsList.php");die;
    }
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["spic"]["name"]);
    //echo $_FILES["pic"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if(empty($_FILES["spic"]["name"])){
        $imgurl = $_POST["spic"];
    }
    else if("../news/uploads/$type/" . $_FILES["spic"]["name"] == $_POST["spic"]){
        $imgurl = $_POST["spic"];
    }
    else if ((($_FILES["spic"]["type"] == "image/gif")
            || ($_FILES["spic"]["type"] == "image/jpeg")
            || ($_FILES["spic"]["type"] == "image/jpg")
            || ($_FILES["spic"]["type"] == "image/pjpeg")
            || ($_FILES["spic"]["type"] == "image/x-png")
            || ($_FILES["spic"]["type"] == "image/png"))
        && ($_FILES["spic"]["size"] < 2048000)   // 小于 2000 kb
        && in_array($extension, $allowedExts)){
        move_uploaded_file($_FILES["spic"]["tmp_name"], "../news/uploads/$type_gbk/" . iconv("UTF-8", "gbk",$_FILES["spic"]["name"]));
        $imgurl = "../news/uploads/$type/".$_FILES["spic"]["name"];

        //    echo  "文件以保存到：upload/".$_FILES["img"]["name"];
    }
     else {
        ?>
        <script type="text/javascript">
            alert('非法文件，请选择正确图片!')
        </script>
        <?php
        header("Refresh: 0.01; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");die;
    }
        if (empty($_POST["stitle"])) {
            ?>
            <script type="text/javascript">
                alert("标题不能为空!")
            </script>
            <?php header("Refresh: 0.01; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");die;
        } else if (empty($_POST["sscore"])) {
            ?>
            <script type="text/javascript">
                alert("未评分!")
            </script>
            <?php header("Refresh: 0.01; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");die;
        } else if (empty($_POST["sabstract"])) {
            ?>
            <script type="text/javascript">
                alert("摘要不能为空!")
            </script>
            <?php header("Refresh: 0.01; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");die;
        }

//    date_default_timezone_set("PRC");
//    if(!$time= date ("Y-m-d H;i;s")){
//        die("获取时间失败！");
//    }
        else {
            $id = $_POST["sid"];
            $title = $_POST["stitle"];
            $type_id = $_POST["stype_id"];
            $country = $_POST["scountry"];
            $language = $_POST["slanguage"];
            $score = $_POST["sscore"];
            if($_SESSION["role_id"] == 1) {
                $editor_id = $_POST["seditor"];
            }
            $abstract = $_POST["sabstract"];

            $sql = "update news set title='$title',type_id=$type_id,editor_id=$editor_id,pic='$imgurl',abstract='$abstract',country='$country',language='$language', 
                    score='$score' where news_id=$id";
            //echo $sql;
            include_once dirname(__FILE__) . '/../common/db.php';
            $res = mysqli_query($con, $sql);
            mysqli_close($con);
            if ($res) {
                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                header("Refresh: 1; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");
            } else {
                echo "修改失败！请重试";
                header("Refresh: 1; url=../backstage/newsEdit.php?news_id=$id&editor_id=$editor_id");die;
            }
        }