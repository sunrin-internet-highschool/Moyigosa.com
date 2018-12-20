<?php
session_start();
if(isset($_POST['logout'])){
        session_unset();
        echo "<script>location.href=\"/\";</script>";
        exit();
}
if((!isset($_GET['year'])||!isset($_GET['month'])||!isset($_GET['grade'])||!isset($_GET['subject'])||!isset($_GET['jump']))&&(!isset($_GET['btype'])||!isset($_GET['stype'])||!isset($_GET['subject']))){
    include("error.php");
    die();
}
if(isset($_GET['year'])&&isset($_GET['month'])&&isset($_GET['grade'])&&isset($_GET['subject'])){
    $select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";
    $def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];
}

if(isset($_GET['subject'])&&isset($_GET['btype'])&&isset($_GET['stype'])){
    $select=" WHERE subject='".$_GET['subject']."' and bigtype='".$_GET['btype']."' and smalltype='".$_GET['stype']."'";
    $def=$_GET['subject'].$_GET['btype'].$_GET['stype'];
}

if(isset($_GET['delete'])&&$def==$_GET['delete']){
    unset($_SESSION[$_GET['delete']]);
    echo "<script>location.href=\"/\"</script>";
    exit();
}

$_SESSION[$def]['jump']=$_GET['jump'];
require_once('cnn.php');

$i=1;
$result = mysqli_query($conn, "SELECT year,month,grade,subject,bigtype,smalltype,num,correct FROM list".$select);
while($row = $result->fetch_assoc()) {
    $_SESSION[$def]['year'][$i]=$row['year'];
    $_SESSION[$def]['month'][$i]=$row['month'];
    $_SESSION[$def]['grade'][$i]=$row['grade'];
    $_SESSION[$def]['subject'][$i]=$row['subject'];
    $_SESSION[$def]['btype'][$i]=$row['bigtype'];
    $_SESSION[$def]['stype'][$i]=$row['smalltype'];
    $_SESSION[$def]['num'][$i]=$row['num'];
    $_SESSION[$def]['correct'][$i]=$row['correct'];
    /*
    echo $_SESSION[$def]['year'][$i],"=year<br>";
    echo $_SESSION[$def]['month'][$i],"=month<br>";
    echo $_SESSION[$def]['grade'][$i],"=grade<br>";
    echo $_SESSION[$def]['subject'][$i],"=subject<br>";
    echo $_SESSION[$def]['btype'][$i],"=btype<br>";
    echo $_SESSION[$def]['stype'][$i],"=stype<br>";
    echo $_SESSION[$def]['num'][$i],"=num<br>";
    echo $_SESSION[$def]['correct'][$i],"=correct<br>";
    echo "-------------------------------<br>";
    */
    $i++;
}

$result = mysqli_query($conn, "SELECT count(num) FROM list".$select);
while($row = $result->fetch_assoc()) {
    $_SESSION[$def]['max']=$row['count(num)'];
}//$maxNum = 문제집 문제 갯수

if(isset($_SESSION['id'])){
    for($i=1;$i<=$_SESSION[$def]['max'];$i++){
    $result = mysqli_query($conn, "SELECT answer FROM ".$_SESSION['id']." where year=".$_SESSION[$def]['year'][$i]." and month=".$_SESSION[$def]['month'][$i]." and grade=".$_SESSION[$def]['grade'][$i]." and subject='".$_SESSION[$def]['subject'][$i]."' and smalltype='".$_SESSION[$def]['stype'][$i]."' and bigtype='".$_SESSION[$def]['btype'][$i]."' and num=".$_SESSION[$def]['num'][$i]);
    while($row = $result->fetch_assoc()) {
        $_SESSION[$def]['answer'][$i]=$row['answer'];
    }
    }
}//$COOKIE['answer'.$def][$i] = 계정 정답 불러오기

if(isset($_GET[$def.$_GET['jump']])&&!empty($_GET[$def.$_GET['jump']])){
        $_SESSION[$def]['answer'][$_GET['jump']]=$_GET[$def.$_GET['jump']];
    if(isset($_SESSION['id'])){
        mysqli_query($conn, "delete from ".$_SESSION['id']."where year=".$_SESSION[$def]['year'][$_GET['jump']]." and num=".$_SESSION[$def]['num'][$_GET['jump']]." and month=".$_SESSION[$def]['month'][$_GET['jump']]." and grade=".$_SESSION[$def]['grade'][$_GET['jump']]." and subject='".$_SESSION[$def]['subject'][$_GET['jump']]."' and btype='".$_SESSION[$def]['btype'][$_GET['jump']]."' and stype='".$_SESSION[$def]['stype'][$_GET['jump']]."'");
        mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_SESSION[$def]['num'][$_GET['jump']].",".$_GET[$def.$_GET['jump']].','.$_SESSION[$def]['year'][$_GET['jump']].','.$_SESSION[$def]['month'][$_GET['jump']].','.$_SESSION[$def]['grade'][$_GET['jump']].",'".$_SESSION[$def]['subject'][$_GET['jump']]."','".$_SESSION[$def]['btype'][$_GET['jump']]."','".$_SESSION[$def]['stype'][$_GET['jump']]."')");
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
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <meta name="viewport" content="width=350px, initial-scale=0.5">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/solve.css">
    <script src="/solve.js"></script>
    
<link rel="shortcut icon" href="/picture/ico/icon_5_fsa_icon.ico">
</head>

<body>
    <?php
    require_once('top.php');
    require_once('side.php');
    ?>
    <form method="get" action="">
        <?php
        if(isset($_GET['year'])){
            echo "<input type=\"hidden\" name=\"year\" value=\"",$_GET['year'],"\">";
        }
        if(isset($_GET['month'])){
            echo "<input type=\"hidden\" name=\"month\" value=\"",$_GET['month'],"\">";
        }
        if(isset($_GET['grade'])){
            echo "<input type=\"hidden\" name=\"grade\" value=\"",$_GET['grade'],"\">";
        }
        if(isset($_GET['subject'])){
            echo "<input type=\"hidden\" name=\"subject\" value=\"",$_GET['subject'],"\">";
        }
        if(isset($_GET['jump'])){
            echo "<input type=\"hidden\" name=\"jump\" value=\"",$_GET['jump'],"\">";
        }
        if(isset($_GET['btype'])){
            echo "<input type=\"hidden\" name=\"btype\" value=\"",$_GET['btype'],"\">";
        }
        if(isset($_GET['stype'])){
            echo "<input type=\"hidden\" name=\"stype\" value=\"",$_GET['stype'],"\">";
        }
        ?>
        <div id="title">
            <div>
                <?php
                if(isset($_GET['year'])&&isset($_GET['month'])&&isset($_GET['grade'])&&isset($_GET['subject'])){
                    echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['grade'],"학년 ",$_GET['subject'];
                }else if(isset($_GET['subject'])&&isset($_GET['btype'])&&isset($_GET['stype'])){
                    echo $_GET['subject']," ",$_GET['btype']," ",$_GET['stype'],"<br><a href=\"/solve.php/?year=".$_SESSION[$def]['year'][$_GET['jump']]."&month=".$_SESSION[$def]['month'][$_GET['jump']]."&grade=".$_SESSION[$def]['grade'][$_GET['jump']]."&subject=".$_SESSION[$def]['subject'][$_GET['jump']]."&jump=1\">(".$_SESSION[$def]['year'][$_GET['jump']],"년 ",$_SESSION[$def]['month'][$_GET['jump']],"월 ",$_SESSION[$def]['grade'][$_GET['jump']],"학년 ",$_SESSION[$def]['subject'][$_GET['jump']]," ",$_SESSION[$def]['num'][$_GET['jump']],"번문제)</a>";
                }
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
            $result = mysqli_query($conn, "SELECT * FROM list where year=".$_SESSION[$def]['year'][$_GET['jump']]." and month=".$_SESSION[$def]['month'][$_GET['jump']]." and grade=".$_SESSION[$def]['grade'][$_GET['jump']]." and subject='".$_SESSION[$def]['subject'][$_GET['jump']]."' and smalltype='".$_SESSION[$def]['stype'][$_GET['jump']]."' and bigtype='".$_SESSION[$def]['btype'][$_GET['jump']]."' and num=".$_SESSION[$def]['num'][$_GET['jump']]);
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
                $hsj=$row["hsj"];
            }
            if(!empty($sound)){
                echo "<audio src=\"$sound\" controls=\"controls\" class=\"sound\"></audio>";
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
            <?php
            if(!empty($hsj)){
                echo "<div class=\"example\">$hsj</div>";
            }
            ?>
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
                    if(isset($_SESSION[$def]['check'][$_GET['jump']])&&isset($_SESSION[$def]['answer'][$_GET['jump']])&&$_SESSION[$def]['check'][$_GET['jump']]==true&&$_SESSION[$def]['correct'][$_GET['jump']]==$i&&$_SESSION[$def]['answer'][$_GET['jump']]==$_SESSION[$def]['correct'][$_GET['jump']]){
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
