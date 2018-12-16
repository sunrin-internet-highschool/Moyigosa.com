<?php
if(!isset($_GET['year'])||!isset($_GET['month'])||!isset($_GET['grade'])||!isset($_GET['subject'])||!isset($_GET['jump'])){
    include("error.php");
    die();
}
session_start();
$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";
$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];
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

for($i=1;$i<=$_SESSION[$def]['max'];$i++){
    if(isset($_GET[$i])&&!empty($_GET[$i])){
        $_SESSION[$def]['answer'][$i]=$_GET[$i];
    }
}

if(isset($_GET['answer'])&&!empty($_GET['answer'])){
    $_SESSION[$def]['answer'][$_GET['jump']]=$_GET['answer'];
}
if(isset($_SESSION['id'])){
    for($i=1;$i<=$_SESSION[$def]['max'];$i++){
        if(isset($_GET[$i])&&!empty($_GET[$i])){
            mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$i." and year=".$_GET['year']." and month=".$_GET['month']." and grade=".$_GET['grade']." and subject='".$_GET['subject']."'");
            mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$i.",".$_GET[$i].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."')");
        }
    }
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/solve.css">
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
                echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['subject']," ",$_GET['grade'],"학년 모의고사";
                ?>
            </div>
        </div>

        <div id="view">
            <div class="view_selection">
                <div class="question">문제</div>
                <div class="solve">해설</div>
            </div>
        </div>

        <div id="question">
            <div>
                <?php
            require_once('cnn.php');
            $result = mysqli_query($conn, "SELECT * FROM list".$select);
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
            if(!empty($question)){
                echo "<div class=\"question\">",$_GET['jump'],". ","$question</div>";
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

        <div id="solve">

        </div>

        <div id="selection">
            <div class="selection_title">
                &nbsp;&nbsp;정답&nbsp;선택
            </div>
            <div class="selection">
                <?php
                for($i=1;$i<=5;$i++){
                    if(isset($_SESSION[$def]['answer'][$_GET['jump']])&&$_SESSION[$def]['answer'][$_GET['jump']]==$i){
                        echo "<input type=\"radio\" name=\"answer\" value=\"$i\" checked=\"checked\" id=\"b$i\"> <label for=\"b$i\">&nbsp;",${"select".$i},"</label><br>";
                    }else{
                        echo "<input type=\"radio\" name=\"answer\" value=\"$i\" id=\"b$i\"><label for = \"b$i\">&nbsp;",${"select".$i},"</label><br>";
                    }
                }
                ?>
            </div>
        </div>

        <div id="buttons">
            <?php
            if(isset($_SESSION[$def]['check'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true){
                echo "<input type=\"submit\" name=\"mark\" value=\"채점 취소\">";
            }else{
                echo "<input type=\"submit\" name=\"mark\" value=\"채점\">";
            }
            ?>
            <input type="submit" name="pre" value="이전 문제">
            <input type="submit" name="next" value="다음 문제">
        </div>
    </form>
</body>

</html>
