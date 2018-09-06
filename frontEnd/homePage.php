<?php
include dirname(__FILE__) . "/../common/homePage_top.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>主页</title>
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/homePage.css">
    <script src="../js/turn.js"></script>
    <style type="text/css">
        *{ margin: 0; padding: 0; text-decoration: none;}
        #picture_turn { width: 1200px; height: 400px; border: 1px solid #333; overflow: hidden; position: relative;}
        #list { width: 8400px; height: 400px; position: absolute; z-index: 1;}
        #list img { height: 400px;width: 1200px; float: left;}
        #buttons { position: absolute; height: 10px; width: 100px; z-index: 2; bottom: 20px; left: 250px;}
        #buttons span { cursor: pointer; float: left; border: 1px solid #fff; width: 10px; height: 10px; border-radius: 50%; background: white; margin-right: 5px;}
        #buttons .on {  background: limegreen;}
        .arrow { cursor: pointer; display: none;line-height: 39px; text-align: center; font-size: 36px; font-weight: bold; width: 40px; height: 40px;  position: absolute; z-index: 2; top: 180px; background-color: RGBA(0,0,0,.3); color: #ffffff;}
        .arrow:hover { background-color: RGBA(0,0,0,.7);text-decoration: none;color: limegreen}
        #picture_turn:hover .arrow { display: block;}
        #prev { left: 20px;}
        #next { right: 20px;}
    </style>
</head>
<body>
<div class="content">
    <div class="picture_turn" id="picture_turn">
        <div id="list" style="left: -1200px;">
            <img src="pic_turn/5.jpg" alt="5">
            <a href="#"><img src="pic_turn/1.jpg" alt="1"></a>
            <a href="#"><img src="pic_turn/2.jpg" alt="2"></a>
            <a href="#"><img src="pic_turn/3.jpg" alt="3"></a>
            <a href="#"><img src="pic_turn/4.jpg" alt="4"></a>
            <a href="#"><img src="pic_turn/5.jpg" alt="5"></a>
            <img src="pic_turn/1.jpg" alt="1">
        </div>
        <div id="buttons">
            <span index="1" class="on"></span>
            <span index="2" class=""></span>
            <span index="3" class=""></span>
            <span index="4" class=""></span>
            <span index="5" class=""></span>
        </div>
        <a href="javascript:;" id="prev" class="arrow">&lt</a>
        <a href="javascript:;" id="next" class="arrow">&gt</a>
    </div>
    <?php
    include_once dirname(__FILE__) . "/../common/db.php";
    $countRes = mysqli_query($con,"select count(*) from newstype");
    $rowcount = mysqli_fetch_array($countRes);
    $count = $rowcount[0];
    $res_type = mysqli_query($con,"select * from newstype");
    if(!$res_type || !$countRes ){
        die("网站维护中，请下次光临！");
    }
    $order = 1;
    while ($count > 0){
        $res_left = mysqli_query($con,"select * from news where type_id = $order");
        $res_right = mysqli_query($con,"select * from news where type_id = $order order by score desc");
        $row_type = mysqli_fetch_array($res_type,MYSQLI_ASSOC)
        ?>
        <div class="play">
            <div class="left">
                <div class="left-top">
                    <div class="left-top-title">
                        <span><img src="../common/background/小电视.png"></span>
                        <span><?php echo $row_type["type"]?></span>
                    </div>
                    <div class="left-top-search">
                        <span><a href="">最新动态</a></span>
                        <span><a href="">排行</a></span>
                    </div>
                    <a href="partition.php?type_id=<?php echo $row_type["type_id"]?>" type="button" class="left-top-more btn btn-default btn-sm">
                        更多<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="left-content">
                    <?php
                    $num = 10;
                    while ($num>0){
                        $row_news = mysqli_fetch_array($res_left,MYSQLI_ASSOC)
                        ?>
                        <div class="spread-module">
                            <a href="detail.php?news_id=<?php echo $row_news["news_id"]?>">
                                <img src="../news/<?php echo $row_news["pic"]?>" style="width: 150px;height: 200px;border: 2px solid white;border-radius:10px;">
                                <div class="title">
                                    <p>《<?php echo $row_news["title"]?>》</p>
                                </div>
                            </a>
                        </div>
                        <?php
                        $num -- ;
                    }
                    ?>
                </div>
            </div>
            <div class="right ">
                <div class="right-list">
                    <div class="right-top">
                        <span><?php echo $row_type["type"]?></span>
                        <span class="right-top-1">排行</span>
                    </div>
                    <div class="right-content">
                        <ul>
                            <?php
                            $num = 9;
                            while($num>0){
                                $row_news_right = mysqli_fetch_array($res_right,MYSQLI_ASSOC)
                                ?>
                                <li><a href="detail.php?news_id=<?php echo $row_news_right["news_id"]?>"><?php echo $row_news_right["title"]?></a></li>
                                <?php $num --;} ?>
                            <li><a class="btn btn-default" style=" width: 200px" href="partition.php?type_id=<?php echo $row_type["type_id"]?>">查看更多<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $count --;
        $order ++;
    }
    ?>
</div>
<?php
include dirname(__FILE__) . "/../common/footer.php";
mysqli_close($con);
?>
</body>
</html>