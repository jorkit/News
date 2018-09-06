<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 10:39
 */
    include_once dirname(__FILE__) . "/../common/checkRole.php";
        if (empty($_POST["stype"])) {
            ?>
            <script type="text/javascript">
                alert("类型名称不能为空!")
            </script>
            <?php header("Refresh: 0.01; url=../backstage/typeAdd.php");
        }
//    date_default_timezone_set("PRC");
//    if (!$time = date("Y-m-d H;i;s")) {
//        die("获取时间失败！");
//    }
        else {
            $type = $_POST["stype"];
            $sql = "insert into newstype (type) values ('$type')";
            include_once dirname(__FILE__) . '/../common/db.php';
            $res = mysqli_query($con, $sql);
            mysqli_close($con);
            if ($res) {
                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                header('Refresh: 1; url=../backstage/typeList.php');
            } else {
                echo "添加失败！请重试";
                header('Refresh: 1; url=../backstage/typeList.php');
            }
        }