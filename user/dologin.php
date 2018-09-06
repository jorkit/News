<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/7/20
     * Time: 9:30
     */
    session_start();
    if(empty($_REQUEST["saccount"]) || empty($_REQUEST["spassword"])){
        ?>
        <script type="text/javascript">
            alert("请确认已输入账号和密码")
        </script>
        <?php header("Refresh: 0.01; url='../frontEnd/login.php");
    }
    else {
        $account = $_REQUEST["saccount"];
        $password = $_REQUEST["spassword"];
        include_once dirname(__FILE__) . "/../common/db.php";
        $res = mysqli_query($con, "select * from user ");
        mysqli_close($con);
        if ($res) {
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                if ($account == $row["account"]) {
                    if ($password == $row["password"]) {
                        switch ($_SESSION["role_id"] = $row["role_id"]){
                            case 1:
                                $_SESSION["user_id"] = $row["id"];
                                $_SESSION["account"] = $row["account"];
                                $_SESSION["nickname"] = $row["nickname"];
                                if(empty($row["head_pic"])){
                                    $_SESSION["head_pic"] = "../user/uploads/默认头像.jpg";
                                }
                                else $_SESSION["head_pic"] = $row["head_pic"];
                                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                                header("Refresh: 1; url='../frontEnd/homePage.php'");
                                break;
                            case 2:
                                $_SESSION["user_id"] = $row["id"];
                                $_SESSION["nickname"] = $row["nickname"];
                                if(empty($row["head_pic"])){
                                    $_SESSION["head_pic"] = "../user/uploads/默认头像.jpg";
                                }
                                else $_SESSION["head_pic"] = $row["head_pic"];
                                $_SESSION["account"] = $row["account"];
                                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                                header("Refresh: 1; url='../frontEnd/homePage.php'");
                                break;
                            case 3:
                                $_SESSION["user_id"] = $row["id"];
                                $_SESSION["nickname"] = $row["nickname"];
                                if(empty($row["head_pic"])){
                                    $_SESSION["head_pic"] = "../user/uploads/默认头像.jpg";
                                }
                                else $_SESSION["head_pic"] = $row["head_pic"];
                                include dirname(__FILE__) . '/../frontEnd/jumping.php';
                                header("Refresh: 1; url='../frontEnd/homePage.php'");
                                break;
                            default:
                                echo "登录出错！<a href = '../frontEnd/login.php'>请重试</a>";
                                header("Refresh: 1; url='login.php");die;
                        }
                    }
                }
            }
            if(empty($_SESSION["user_id"])){
                ?>
                <script type="text/javascript">
                    alert("账号或密码不正确！请重新登录")
                </script>
                <?php header("Refresh: 0.01; url='../frontEnd/login.php");
            }
        }
        else {
            echo "登录出错！<a href = '../frontEnd/login.php'>请重试</a>";
            header("Refresh: 1; url='../frontEnd/login.php");die;
        }
    }
