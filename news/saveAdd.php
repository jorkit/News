    <?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/7/18
     * Time: 10:39
     */
    //检验参数是否有效
    include_once dirname(__FILE__) . "/../common/checkRole.php";
   $type_id = $_POST["stype_id"];
   switch($type_id){
       case 1;
       $type = "电视剧";break;
       case 2;
       $type = "电影";break;
       case 3;
       $type = "动漫";break;
       case 4;
       $type = "小说";break;
       case 5;
       $type = "综艺";break;
    }
    $type_gbk = iconv("UTF-8", "gbk", $type);
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["spic"]["name"]);
    //echo $_FILES["pic"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if(empty($_FILES["spic"]["name"])){
        ?>
        <script type="text/javascript">
            alert('配图未选择!')
        </script>
        <?php
        header("Refresh: 0.01; url=../backstage/newsAdd.php");die;
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
        header("Refresh: 0.01; url=../backstage/newsAdd.php");die;
    }
    if (empty($_POST["stitle"])) {
        ?>
        <script type="text/javascript">
            alert("标题不能为空!")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/newsAdd.php");die;
    } else if (empty($_POST["sscore"])) {
        ?>
        <script type="text/javascript">
            alert("未评分!")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/newsAdd.php");die;
    } else if (empty($_POST["sabstract"])) {
        ?>
        <script type="text/javascript">
            alert("摘要不能为空!")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/newsAdd.php");die;
    }

    //    date_default_timezone_set("PRC");
    //    if(!$time= date ("Y-m-d H;i;s")){
    //        die("获取时间失败！");
    //    }
    else {
        $title = $_POST["stitle"];
        $country = $_POST["scountry"];
        $language = $_POST["slanguage"];
        $score = $_POST["sscore"];
        $editor_id = $_POST["seditor"];
        $abstract = $_POST["sabstract"];

        $sql = "insert into news (title,type_id,editor_id,pic,abstract,country,language, score) values ('$title',$type_id,$editor_id,'$imgurl','$abstract','$country','$language',$score)";
        //echo $sql;
        include_once dirname(__FILE__) . '/../common/db.php';
        $res = mysqli_query($con, $sql);
        mysqli_close($con);
        if ($res) {
            include dirname(__FILE__) . '/../frontEnd/jumping.php';
            header("Refresh: 1; url=../backstage/newsList.php");
        } else {
            echo "添加失败！请重试";
            header("Refresh: 1; url=../backstage/newsAdd.php");die;
        }
    }