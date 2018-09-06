    <?php
    /**
     * Created by PhpStorm.
     * User: 潘多拉
     * Date: 2018/7/27
     * Time: 19:05
     */
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    if(!($id = $_POST["sid"])){
        ?>
        <script type="text/javascript">
            alert("信息获取失败，请重试")
        </script>
        <?php
        header("Refresh: 0.01; url=../frontEnd/userInfo.php");die;
    }
    //取出密码对照判断是否本人操作
    include_once dirname(__FILE__) . '/../common/db.php';
    $res_check = mysqli_query($con,"select password from user where id=$id");
    if($res_check){
        $row = mysqli_fetch_array($res_check,1);
        $check = $row["password"];
    }

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["pic"]["name"]);
    $extension = end($temp);     // 获取文件后缀名
    if (empty($_FILES["pic"]["name"])){
        $imgurl = $_POST["spic"];
    } //echo $_FILES["pic"]["size"];
    else if ((($_FILES["pic"]["type"] == "image/gif")
            || ($_FILES["pic"]["type"] == "image/jpeg")
            || ($_FILES["pic"]["type"] == "image/jpg")
            || ($_FILES["pic"]["type"] == "image/pjpeg")
            || ($_FILES["pic"]["type"] == "image/x-png")
            || ($_FILES["pic"]["type"] == "image/png"))
        && ($_FILES["pic"]["size"] < 2048000)   // 小于 2000 kb
        && in_array($extension, $allowedExts)) {
        move_uploaded_file($_FILES["pic"]["tmp_name"], "uploads/" . iconv("UTF-8", "gbk",$_FILES["pic"]["name"]));
        $imgurl = "../user/uploads/" . $_FILES["pic"]["name"];

        //    echo  "文件以保存到：../user/upload/".$_FILES["img"]["name"];
    }
    else {
        ?>
        <script type="text/javascript">
            alert('非法文件，请选择正确图片!')
        </script>
        <?php
        header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    }
    if (empty($_POST["snickname"])) {
        ?>
        <script type="text/javascript">
            alert("昵称不能为空!")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    } else if ($_POST["spasswordOld"] != $check) {
        ?>
        <script type="text/javascript">
            alert("原密码错误！请重试")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    }  else if ($_POST["spasswordcheck"] != $_POST["spassword"]){
        ?>
        <script type="text/javascript">
            alert("两次密码不同请重新确认！")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    } else if (empty($_POST["sage"])) {
        ?>
        <script type="text/javascript">
            alert("年龄不能为空！")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    } else if (empty($_POST["ssex"])) {
        ?>
        <script type="text/javascript">
            alert("性别未选择!")
        </script>
        <?php header("Refresh: 0.01; url=../backstage/userEdit.php?id=$id");die;
    }
    //date_default_timezone_set("PRC");
    //if(!$time= date ("Y-m-d H;i;s")){
    //    die("获取时间失败！");
    //}
    else {
        $role_id = $_POST["srole_id"];
        $nickname = $_POST["snickname"];
        if(!empty($_POST["spassword"])) {
            $password = $_POST["spassword"];
        }
        else $password = $_POST["spasswordOld"];
        $age = $_POST["sage"];
        $sex = $_POST["ssex"];
        $signature = $_POST["ssignature"];

        $sql = "update user set nickname='$nickname',password='$password',age=$age,sex=$sex,head_pic='$imgurl',signature='$signature' where id=$id";
        //echo $sql;
        include_once dirname(__FILE__) . '/../common/db.php';
        $res = mysqli_query($con, $sql);
        mysqli_close($con);
        if ($res) {
            include dirname(__FILE__) . "/../frontEnd/jumping.php";
            if($role_id == 2) {
                header("Refresh: 1; url=../backstage/editorList.php");die;
            }
            else
                header("Refresh: 1; url=../backstage/userList.php");die;
        } else {
            echo "修改失败！请重试";
            if($role_id == 2) {
                header("Refresh: 1; url=../backstage/editorEdit.php?id=$id");die;
            }
            else
                header("Refresh: 1; url=../backstage/userEdit.php?id=$id");die;
        }
    }