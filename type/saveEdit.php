<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 10:39
 */
        include_once dirname(__FILE__) . "/../common/checkadmin.php";
        if(empty($id=$_POST["sid"])){
            echo "信息获取失败，<a href='../backstage/typeList.php'>请重试</a>";
            header("Refresh: 1; url=../backstage/typeList.php");
        }
        if(empty($_POST["stype"])) {
            ?>
            <script type="text/javascript">
                alert("类型名称不能为空!")
            </script>
            <?php header("Refresh: 0.01; url=../backstage/typeEdit.php?type_id=$id");
        }
        //    date_default_timezone_set("PRC");
        //    if (!$time = date("Y-m-d H;i;s")) {
        //        die("获取时间失败！");
        //    }
        else {
            $type = $_POST["stype"];
            $sql = "update newstype set type = '$type' where type_id = $id";
            //echo $sql;
            include_once dirname(__FILE__) . '/../common/db.php';
            $res = mysqli_query($con, $sql);
            mysqli_close($con);
            if ($res) {
                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                header('Refresh: 1; url=../backstage/typeList.php');
            } else {
                echo "修改！请重试";
                header('Refresh: 1; url=../backstage/typeList.php');
            }
        }