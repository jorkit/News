    <?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/7/18
     * Time: 10:53
     */
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    $role_id = $_GET["role_id"];
    $pageindex = $_SESSION["pageindex"]-1;
    $id = $_GET["id"];
    $sql = "delete from user where id = $id";
    include_once dirname(__FILE__) . '/../common/db.php';
    $res = mysqli_query($con, $sql);
    mysqli_close($con);
    if ($res) {
        include dirname(__FILE__) . '/../frontEnd/jumping.php';
            if($role_id == 2) {
                header("Refresh: 1; url=../backstage/editorList.php?pageindex=$pageindex");die;
            }
            else
                header("Refresh: 1; url=../backstage/userList.php?pageindex=$pageindex");die;
        } else {
            echo "删除失败！请重试";
        if ($role_id == 2) {
            header("Refresh: 1; url=../backstage/editorList.php?pageindex=$pageindex");
            die;
        } else
            header("Refresh: 1; url=../backstage/userList.php?pageindex=$pageindex");die;
        }