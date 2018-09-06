<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/7/18
     * Time: 10:53
     */
        include_once dirname(__FILE__) . "/../common/checkEditor.php";
        $pageindex = $_SESSION["pageindex"]-1;
        $id = $_GET["news_id"];
        $sql = "delete from news where news_id = $id";
        include_once dirname(__FILE__) . '/../common/db.php';
        $res = mysqli_query($con, $sql);
        mysqli_close($con);
        if ($res) {
            include dirname(__FILE__) . '/../frontEnd/jumping.php';
            header("Refresh: 1; url=../backstage/newsList.php?pageindex=$pageindex");
        } else {
            echo "删除失败！请重试";
            header("Refresh: 1; url=../backstage/newsList.php?pageindex=$pageindex");
        }