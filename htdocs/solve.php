<?php
if(!isset($_GET['year'])||!isset($_GET['month'])||!isset($_GET['grade'])||!isset($_GET['subject'])||!isset($_GET['jump'])){
    include("error.php");
    die();
}
session_start();
$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";
$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];
$_SESSION[$def]['jump']=$_GET['jump'];
require_once('cnn.php');
if(isset($_SESSION['id'])){
    $result = mysqli_query($conn, "SELECT answer,num FROM ".$_SESSION['id'].$select);
    while($row = $result->fetch_assoc()) {
        $_SESSION[$def]['answer'][$row['num']]=$row['answer'];
    }
}//$COOKIE['answer'.$def][$i] = 계정 정답 불러오기
$i=1;
$result = mysqli_query($conn, "SELECT correct FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $_SESSION[$def]['correct'][$i]=$row['correct'];
    $i++;
}//$COOKIE['correct'.$def][$i] = 문제집 정답 불러오기
$result = mysqli_query($conn, "SELECT count(num) FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $_SESSION[$def]['max']=$row['count(num)'];
}//$maxNum = 문제집 문제 갯수
if(isset($_GET['answer'])&&!empty($_GET['answer'])){
        $_SESSION[$def]['answer'][$_GET['jump']]=$_GET[$def.$_GET['jump']];
    if(isset($_SESSION['id'])){
        mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$_GET['jump']);
        mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_GET['jump'].",".$_GET['answer'].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."')");
    }
    }  

if(isset($_GET['check'])){
    $_SESSION[$def]['check'][$_GET['jump']]=true;
}

if(isset($_GET['uncheck'])){
    $_SESSION[$def]['check'][$_GET['jump']]=false;
}
    
    if(isset($_GET['pre'])&&$_GET['jump']>1){
        $_GET['jump']--;
    }

    if(isset($_GET['next'])&&$_GET['jump']<$_SESSION[$def]['max']){
    $_GET['jump']++;
    }
    $_SESSION[$def]['jump']=$_GET['jump'];
?>
<html>

<head>
    <title>
        문제페이지
    </title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/solve.css">
    <script src="/solve.js"></script>
</head>

<body>
    <?php
    require_once('top.php');
    require_once('side.php');
    ?>
    <form method="get" action="">
        <?php
        echo "<input type=\"hidden\" name=\"year\" value=\"",$_GET['year'],"\">";
        echo "<input type=\"hidden\" name=\"month\" value=\"",$_GET['month'],"\">";
        echo "<input type=\"hidden\" name=\"grade\" value=\"",$_GET['grade'],"\">";
        echo "<input type=\"hidden\" name=\"subject\" value=\"",$_GET['subject'],"\">";
        echo "<input type=\"hidden\" name=\"jump\" value=\"",$_GET['jump'],"\">";
        ?>
        <div id="title">
            <div>
                <?php
                echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['grade'],"학년 ",$_GET['subject'];
                ?>
            </div>
        </div>

        <div id="view">
            <div class="view_selection">
                <div class="question">문제</div>
                <div class="solve">해설</div>
                <div class="view_bar"></div>
            </div>
        </div>

        <div id="question">
            <div>
                <?php
            require_once('cnn.php');
            $result = mysqli_query($conn, "SELECT * FROM list".$select." and num=".$_GET['jump']);
            while($row = $result->fetch_assoc()) {
                $question=$row["question"];
                $example=$row["example"];
                $select1=$row["select1"];
                $select2=$row["select2"];
                $select3=$row["select3"];
                $select4=$row["select4"];
                $select5=$row["select5"];
                $picture=$row["picture"];
                $sound=$row["sound"];
            }
            if(!empty($sound)){
                echo "<audio src=\"$sound\" controls=\"controls\" class=\"sound\">";
            }
            if(!empty($picture)){
                echo "<img src=\"",$picture,"\" class=\"picture\" width=\"100%\" height=\"auto\">";
            }
            if(!empty($example)){
                echo "<div class=\"example\">$example</div>";
            }
            ?>
            </div>
        </div>

        <div id="solve" style="display:none">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>

        <div id="selection">
            <div class="selection_title">
                &nbsp;&nbsp;정답&nbsp;선택
            </div>
            
                <?php
            echo "<div class=\"selection\">";
            
            if(!empty($question)){
                echo "<div class=\"question\">",$_GET['jump'],". ","$question</div>";
            }
                for($i=1;$i<=5;$i++){
                    if(isset($_SESSION[$def]['check'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true&&$_SESSION[$def]['correct'][$_GET['jump']]==$i&&$_SESSION[$def]['answer'][$_GET['jump']]==$_SESSION[$def]['correct'][$_GET['jump']]){
                        echo "<input type=\"radio\" name=\"$def",$_GET['jump'],"\" value=\"$i\" checked=\"checked\" id=\"$i\" class=\"check\"><label for = \"$i\">&nbsp;",${"select".$i},"</label>&nbsp;&nbsp;<br>";
                    }else if(isset($_SESSION[$def]['check'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true&&$_SESSION[$def]['correct'][$_GET['jump']]==$i){
                        echo "<input type=\"radio\" name=\"$def",$_GET['jump'],"\" value=\"$i\" id=\"$i\" class=\"check\"><label for = \"$i\">&nbsp;",${"select".$i},"</label>&nbsp;&nbsp;<br>";
                    }else if(isset($_SESSION[$def]['check'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true&&isset($_SESSION[$def]['answer'][$_GET['jump']])&&$_SESSION[$def]['answer'][$_GET['jump']]==$i&&$_SESSION[$def]['answer'][$_GET['jump']]!=$_SESSION[$def]['correct'][$_GET['jump']]){
                        echo "<input type=\"radio\" name=\"$def",$_GET['jump'],"\" value=\"$i\" checked=\"checked\" id=\"$i\" class=\"wrong\"> <label for=\"$i\">&nbsp;",${"select".$i},"</label><br>";
                    }else if(isset($_SESSION[$def]['answer'][$_GET['jump']])&&$_SESSION[$def]['answer'][$_GET['jump']]==$i){
                        echo "<input type=\"radio\" name=\"$def",$_GET['jump'],"\" value=\"$i\" checked=\"checked\" id=\"$i\" class=\"uncheck\"> <label for=\"$i\">&nbsp;",${"select".$i},"</label><br>";
                    }else{
                        echo "<input type=\"radio\" name=\"$def",$_GET['jump'],"\" value=\"$i\" id=\"$i\" class=\"uncheck\"><label for = \"$i\">&nbsp;",${"select".$i},"</label><br>";
                    }
                }
               
            echo "</div>";
                 ?>
        </div>

        <div id="buttons">
            <input type="submit" name="pre" value="이전 문제">
            <?php
            if(isset($_SESSION[$def]['check'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true){
                echo "<input type=\"submit\" name=\"uncheck\" value=\"채점 취소\">";
            }else{
                echo "<input type=\"submit\" name=\"check\" value=\"채점\">";
            }
            ?>
            
            <input type="submit" name="next" value="다음 문제">
        </div>
    </form>
</body>

</html>
<?php
?>
