<link rel="stylesheet" type="text/css" href="/side.css">
<?php
if(isset($_GET['delete'])){
    unset($_SESSION[$_GET['delete']]);
}
?>


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
                echo "<script>location.href=\"/\";</script>";
            }
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "<a href=\"/user.php\" target=\"_self\"><img src=\"/picture/linemenu/user.png\" width=\"55px\" height=\"55px\"></a>";
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
        <form method="get" action="" id="side_submit">
           <input type="hidden" name="delete" class="delete" value="">
            <?php
            if(isset($_GET['year']))
                echo "<input type=\"hidden\" name=\"year\" value=\"",$_GET['year'],"\">";
            if(isset($_GET['month']))
                echo "<input type=\"hidden\" name=\"month\" value=\"",$_GET['month'],"\">";
            if(isset($_GET['grade']))
                echo "<input type=\"hidden\" name=\"grade\" value=\"",$_GET['grade'],"\">";
            if(isset($_GET['subject']))
                echo "<input type=\"hidden\" name=\"subject\" value=\"",$_GET['subject'],"\">";
            if(isset($_GET['jump']))
                echo "<input type=\"hidden\" name=\"jump\" value=\"",$_GET['jump'],"\">";
            if(isset($_GET['btype']))
                echo "<input type=\"hidden\" name=\"btype\" value=\"",$_GET['btype'],"\">";
            if(isset($_GET['stype']))
                echo "<input type=\"hidden\" name=\"stype\" value=\"",$_GET['stype'],"\">";
            ?>
            <a href="/index.php">
                <div class="side_element" draggable="true">
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
                
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    if(isset($_GET[$tag.$i])&&!empty($_GET[$tag.$i])){
                        $_SESSION[$tag]['answer'][$i]=$_GET[$tag.$i];
                        if(isset($_SESSION['id'])){
                            $result1 = mysqli_query($conn, "select bigtype,smalltype from list where year=$year and month=$month and grade=$grade and subject='$subject' and num=".$_GET[$tag.$i]);
                            while($row1 = $result1->fetch_assoc()) {
                                $btype=$row1['bigtype'];
                                $stype=$row1['smalltype'];
                            }
                            mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$_SESSION[$tag]['num'][$i]." and year=".$year." and month=".$month." and grade=".$grade." and subject='".$subject."' and bigtype='$btype' and smalltype='$stype'");
                            mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_SESSION[$tag]['num'][$i].",".$_GET[$tag.$i].','.$year.','.$month.','.$grade.",'".$subject."','$btype','$stype')");
                        }
                    }
                }
                
                if(isset($_GET['check_all'.$tag])){
                    for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                        $_SESSION[$tag]['check'][$i]=true;
                    }
                }
                
                if(isset($_GET['uncheck_all'.$tag])){
                    for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                        $_SESSION[$tag]['check'][$i]=false;
                    }
                }
                
                if(isset($_SESSION['id'])){
                    for($i2=1;$i2<=$_SESSION[$tag]['max'];$i2++){
    $result2 = mysqli_query($conn, "SELECT answer FROM ".$_SESSION['id']." where year=".$_SESSION[$tag]['year'][$i2]." and month=".$_SESSION[$tag]['month'][$i2]." and grade=".$_SESSION[$tag]['grade'][$i2]." and subject='".$_SESSION[$tag]['subject'][$i2]."' and smalltype='".$_SESSION[$tag]['stype'][$i2]."' and bigtype='".$_SESSION[$tag]['btype'][$i2]."' and num=".$_SESSION[$tag]['num'][$i2]);
    while($row2 = $result2->fetch_assoc()) {
        $_SESSION[$tag]['answer'][$i2]=$row2['answer'];
    }
                        
                    }
}//$COOKIE['answer'.$def][$i] = 계정 정답 불러오기
                
                echo "<div>";
                echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$_SESSION[$tag]['jump'],"\">";
                echo "<div class=\"side_element\" ><span>$year","년 ","$month","월 ","$grade","학년"," $subject</span><a class=\"omr_viewer\"><img src=\"/picture/linemenu/plusicon.png\" width=\"auto\" height=\"60px\" value=\"$year$month$grade$subject\"></a></div>";
                echo "</a>";
                echo "<div class=\"omr\" style=\"display:none\">";
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    if(isset($_SESSION[$tag]['check'][$i])&&$_SESSION[$tag]['check'][$i]==true){
                        if(isset($_SESSION[$tag]['answer'][$i])&&$_SESSION[$tag]['answer'][$i]==$_SESSION[$tag]['correct'][$i]){
                            echo "<div class=\"omr_row\" style=\"background-color:#CCFFCC;\">";
                            echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$i,"\" style=\"color:#669966;\">";
                        }else{
                            echo "<div class=\"omr_row\" style=\"background-color:#FFCCCC;\">";
                            echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$i,"\" style=\"color:#CC6666;\">";
                        }
                    }else{
                        echo "<div class=\"omr_row\">";
                        echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$i,"\">";
                    }
                    
                    if($i<10){
                        echo "0",$i;
                    }else{
                        echo $i;
                    }
                    echo "</a>";
                    for($j=1;$j<=5;$j++){
                        if(isset($_SESSION[$tag]['answer'][$i])&&$_SESSION[$tag]['answer'][$i]==$j){
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" checked=\"checked\" id=\"$tag","$i","$j\"> <label for=\"$tag","$i","$j\">&nbsp;</label>";
                        }else if(isset($_SESSION[$tag]['check'][$i])&&$_SESSION[$tag]['check'][$i]==true&&$_SESSION[$tag]['correct'][$i]==$j){
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" id=\"$tag","$i","$j\" style=\"background-color:red;\"> <label for=\"$tag","$i","$j\">&nbsp;</label>";
                        }else{
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" id=\"$tag","$i","$j\"><label for = \"$tag","$i","$j\">&nbsp;</label>";
                        }
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "<div class=\"side_omr_submit\" style=\"display:none\">";
                echo "<input type=\"submit\" name=\"check_all$tag\" value=\"전체 채점\" class=\"check_all\">";
                echo "<input type=\"submit\" name=\"uncheck_all$tag\" value=\"전체 채점 취소\" class=\"uncheck_all\">";
                echo "<input type=\"submit\" name=\"submit_all$tag\" value=\"확인\" class=\"submit_all\">";
                echo "</div>";
                echo "</div>";
            }
        }
        $result = mysqli_query($conn, "select distinct subject,bigtype,smalltype,concat(subject,bigtype,smalltype) as 'tag' from list");
        while($row = $result->fetch_assoc()) {
            $tag=$row['tag'];
            $btype=$row['bigtype'];
            $stype=$row['smalltype'];
            $subject=$row['subject'];
            if(isset($_SESSION[$tag])){
                
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    if(isset($_GET[$tag.$i])&&!empty($_GET[$tag.$i])){
                        $_SESSION[$tag]['answer'][$i]=$_GET[$tag.$i];
                        if(isset($_SESSION['id'])){
                            $year=$_SESSION[$tag]['year'][$i];
                            $month=$_SESSION[$tag]['month'][$i];
                            $grade=$_SESSION[$tag]['grade'][$i];
                            mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$_SESSION[$tag]['num'][$i]." and year=".$year." and month=".$month." and grade=".$grade." and subject='".$subject."' and bigtype='$btype' and smalltype='$stype'");
                            mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_SESSION[$tag]['num'][$i].",".$_GET[$tag.$i].','.$year.','.$month.','.$grade.",'".$subject."','$btype','$stype')");
                        }
                    }
                }
                
                if(isset($_GET['check_all'.$tag])){
                    for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                        $_SESSION[$tag]['check'][$i]=true;
                    }
                }
                
                if(isset($_GET['uncheck_all'.$tag])){
                    for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                        $_SESSION[$tag]['check'][$i]=false;
                    }
                }
                
                echo "<div>";
                echo "<a href=\"/solve.php/?subject=$subject&btype=$btype&stype=$stype&jump=",$_SESSION[$tag]['jump'],"\">";
                echo "<div class=\"side_element\" ><span>$subject $btype $stype</span><a class=\"omr_viewer\"><img src=\"/picture/linemenu/plusicon.png\" width=\"auto\" height=\"60px\" value=\"$tag\"></a></div>";
                echo "</a>";
                echo "<div class=\"omr\" style=\"display:none\">";
                for($i=1;$i<=$_SESSION[$tag]['max'];$i++){
                    if(isset($_SESSION[$tag]['check'][$i])&&$_SESSION[$tag]['check'][$i]==true){
                        if(isset($_SESSION[$tag]['answer'][$i])&&$_SESSION[$tag]['answer'][$i]==$_SESSION[$tag]['correct'][$i]){
                            echo "<div class=\"omr_row\" style=\"background-color:#CCFFCC;\">";
                            echo "<a href=\"/solve.php/?subject=$subject&btype=$btype&stype=$stype&jump=",$i,"\" style=\"color:#669966;\">";
                        }else{
                            echo "<div class=\"omr_row\" style=\"background-color:#FFCCCC;\">";
                            echo "<a href=\"/solve.php/?subject=$subject&btype=$btype&stype=$stype&jump=",$i,"\" style=\"color:#CC6666;\">";
                        }
                    }else{
                        echo "<div class=\"omr_row\">";
                        echo "<a href=\"/solve.php/?subject=$subject&btype=$btype&stype=$stype&jump=",$i,"\">";
                    }
                    
                    if($i<10){
                        echo "0",$i;
                    }else{
                        echo $i;
                    }
                    echo "</a>";
                    for($j=1;$j<=5;$j++){
                        if(isset($_SESSION[$tag]['answer'][$i])&&$_SESSION[$tag]['answer'][$i]==$j){
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" checked=\"checked\" id=\"$tag","$i","$j\"> <label for=\"$tag","$i","$j\">&nbsp;</label>";
                        }else if(isset($_SESSION[$tag]['check'][$i])&&$_SESSION[$tag]['check'][$i]==true&&$_SESSION[$tag]['correct'][$i]==$j){
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" id=\"$tag","$i","$j\" style=\"background-color:red;\"> <label for=\"$tag","$i","$j\">&nbsp;</label>";
                        }else{
                            echo "<input type=\"radio\" name=\"$tag","$i\" value=\"$j\" id=\"$tag","$i","$j\"><label for = \"$tag","$i","$j\">&nbsp;</label>";
                        }
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "<div class=\"side_omr_submit\" style=\"display:none\">";
                echo "<input type=\"submit\" name=\"check_all$tag\" value=\"전체 채점\" class=\"check_all\">";
                echo "<input type=\"submit\" name=\"uncheck_all$tag\" value=\"전체 채점 취소\" class=\"uncheck_all\">";
                echo "<input type=\"submit\" name=\"submit_all$tag\" value=\"확인\" class=\"submit_all\">";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
        </form>
    </div>
</div>
<img src="/picture/linemenu/delete.png" id="trashcan" width="auto" height="250px" style="left:-200px;">
<div id="background" style="display:none">
</div>

<?php
?>
