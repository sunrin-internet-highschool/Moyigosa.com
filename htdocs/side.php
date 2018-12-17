<link rel="stylesheet" type="text/css" href="/side.css">

<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/side.js"></script>
</head>
<div id="side" style="right:-30em">
    <div id="side_top">
        <div id="login">
            <?php
            if(isset($_POST['logout'])){
                session_unset();
            }
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "<a href=\"user.php\" target=\"_self\"><img src=\"/picture/linemenu/user.png\" width=\"55px\" height=\"55px\"></a>";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"image\" src=\"/picture/linemenu/logout.png\">";
                echo "<input type=\"hidden\" name=\"logout\" name=\"logout\">";
                echo "</form>";
            }else{//로그인 안된 상태
                $_SESSION['temp']=true;
                echo "<a href=\"/login.php\" target=\"_self\" clsss=\"side_login\"><img src=\"/picture/linemenu/login.png\" width=\"146px\" height=\"55px\"></a>";
                echo "<a href=\"/signUp.php\" target=\"_self\" class=\"side_signup\"><img src=\"/picture/linemenu/signup.png\" width=\"146px\" height=\"55px\"></a>";
            }
                ?>
        </div>
        <img src="/picture/linemenu/xicon.png" width="47px" height="47px" class="close">
    </div>
    <div id="side_middle">
        <form method="get" action="">
            <a href="/index.php">
                <div class="side_element">
                    <span>메인페이지</span>
                </div>
            </a>
            <?php
        require_once('cnn.php');
        $result = mysqli_query($conn, "select distinct year,month,grade,subject,concat(year,month,grade,subject) as 'tag' from list");
        while($row = $result->fetch_assoc()) {
            $tag=$row['tag'];
            $year=$row['year'];
            $month=$row['month'];
            $grade=$row['grade'];
            $subject=$row['subject'];
            if(isset($_SESSION[$tag])){
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    if(isset($_GET[$i])&&!empty($_GET[$i])){
                        $_SESSION[$tag]['answer'][$i]=$_GET[$i];
                    }
                }
                /*if(isset($_SESSION['id'])){
                    for($i=1;$i<=$_SESSION[$def]['max'];$i++){
                        if(isset($_GET[$i])&&!empty($_GET[$i])){
                            mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$i." and year=".$_GET['year']." and month=".$_GET['month']." and grade=".$_GET['grade']." and subject='".$_GET['subject']."'");
                            mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$i.",".$_GET[$i].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."')");
                        }
                    }
                }*/
                echo "<div>";
                echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$_SESSION[$tag]['jump'],"\">";
                echo "<div class=\"side_element\"><span>$year","년 ","$month","월 ","$grade","학년"," $subject</span><a class=\"omr_viewer\"><img src=\"/picture/linemenu/plusicon.png\" width=\"33\" height=\"31\"></a></div>";
                echo "</a>";
                echo "<div class=\"omr\" style=\"display:none\">";
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    echo "<div class=\"omr_row\">";
                    echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$i,"\">";
                    if($i<10){
                        echo "0",$i;
                    }else{
                        echo $i;
                    }
                    echo "</a>";
                    for($j=1;$j<=5;$j++){
                        if(isset($_SESSION[$tag]['answer'][$i])&&$_SESSION[$tag]['answer'][$i]==$j){
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" checked=\"checked\" id=\"$tag","$i","$j\"> <label for=\"$tag","$i","$j\">&nbsp;</label>";
                        }else{
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" id=\"$tag","$i","$j\"><label for = \"$tag","$i","$j\">&nbsp;</label>";
                        }
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "<div class=\"side_omr_submit\" style=\"display:none\">";
                echo "<input type=\"submit\" name=\"check_all\" value=\"전체 채점\" class=\"check_all\">";
                echo "<input type=\"submit\" name=\"uncheck_all\" value=\"전체 채점 취소\" class=\"uncheck_all\">";
                echo "<input type=\"submit\" name=\"submit_all\" value=\"확인\" class=\"submit_all\">";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
        </form>
    </div>
</div>
<div id="background" style="display:none">
</div>
