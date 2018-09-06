<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 10:39
 */


        if (empty($_POST["saccount"])) {
            ?>
            <script type="text/javascript">
                alert("账号不能为空！")
            </script>
            <?php header("Refresh: 0.01; url=../frontEnd/registe.php");die;
        } else if ( empty($_POST["spassword"])) {
            ?>
            <script type="text/javascript">
                alert("密码不能为空！")
            </script>
            <?php header("Refresh: 0.01; url=../frontEnd/registe.php");die;
        }else if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $_POST["spassword"])){
            ?>
            <script type="text/javascript">
                alert("密码含有非法字符！")
            </script>
            <?php header("Refresh: 0.01; url=../frontEnd/registe.php");die;
        }else if ($_POST["spassword"] != $_POST["passwordcheck"]){
            ?>
            <script type="text/javascript">
                alert("两次密码不同！请重新确认密码")
            </script>
            <?php  header("Refresh: 0.01; url=../frontEnd/registe.php");die;
        }
        //date_default_timezone_set("PRC");
        //if(!$time= date ("Y-m-d H;i;s")){
        //    die("获取时间失败！");
        //}

            include_once dirname(__FILE__) . "/../common/checkaccount.php";
            $account = $_POST["saccount"];
            $password = $_POST["spassword"];

            $sql = "insert into user (role_id,nickname,account,password) values (3,'新手上路','$account','$password')";
            //echo $sql;
            include_once dirname(__FILE__) . '/../common/db.php';
            $res = mysqli_query($con, $sql);
            //_once 关闭数据库 无法在调用
//            mysqli_close($con);
            if ($res) {
                include_once dirname(__FILE__) . "/dologin.php";
                header('Refresh: 1; url=../frontEnd/homePage.php');
            } else {
                echo "注册失败！请重试";
                header('Refresh: 1; url=../frontEnd/registe.php');
            }