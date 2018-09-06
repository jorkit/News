    <?php
    /**
     * Created by PhpStorm.
     * User: 潘多拉
     * Date: 2018/7/27
     * Time: 19:05
     */
    //获取角色id
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    $role_id = $_POST["srole_id"];
    if($role_id == 2){
        $route = "../backstage/editorAdd.php";
    }
    else $route = "../backstage/userAdd.php";
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["pic"]["name"]);
    $extension = end($temp);     // 获取文件后缀名
    if (empty($_FILES["pic"]["name"])){
        $imgurl = NULL;
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
        header("Refresh: 0.01; url=$route");die;
    }
    if (empty($_POST["saccount"])) {
        ?>
        <script type="text/javascript">
            alert("姓名不能为空!")
        </script>
        <?php header("Refresh: 0.01; url=$route");die;
    } else if (empty($_POST["sage"])) {
        ?>
        <script type="text/javascript">
            alert("年龄不能为空！")
        </script>
        <?php header("Refresh: 0.01; url=$route");die;
    } else if (empty($_POST["ssex"])) {
        ?>
        <script type="text/javascript">
            alert("性别未选择!")
        </script>
        <?php header("Refresh: 0.01; url=$route");die;
    } else if (empty($_POST["spassword"])){
        ?>
        <script type="text/javascript">
            alert("密码不能为空！")
        </script>
        <?php header("Refresh: 0.01; url=$route");die;
    } else if ($_POST["spasswordcheck"] != $_POST["spassword"]){
        ?>
        <script type="text/javascript">
            alert("两次密码不同请重新确认！")
        </script>
        <?php header("Refresh: 0.01; url=$route");die;
    }
    //date_default_timezone_set("PRC");
    //if(!$time= date ("Y-m-d H;i;s")){
    //    die("获取时间失败！");
    //}
    else {
        $account = $_POST["saccount"];
        $password = $_POST["spassword"];
        $age = $_POST["sage"];
        $sex = $_POST["ssex"];
        $signature = $_POST["ssignature"];

        $sql = "insert into user (role_id,nickname,account,password,age,sex,head_pic,signature) values ($role_id,'$account','$account','$password','$age','$sex','$imgurl','$signature')";
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
            echo "添加失败！请重试";
            if($role_id == 2) {
                header("Refresh: 1; url=../backstage/editorEdit.php?id=$id");die;
            }
            else
                header("Refresh: 1; url=../backstage/userEdit.php?id=$id");die;
        }
    }