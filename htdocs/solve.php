<?php
require_once ('checkError.php');//get방식으로 불러오는 변수 존재 여부 확인


require_once ('cnn.php');//mysql 연결 설정


$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";


$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];


$result = mysqli_query($conn, "SELECT count(num) FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $maxNum=$row['count(num)'];
}//$maxNum = 문제집 문제 갯수


if(!isset($_COOKIE['1'.$def])){
    for($i=1;$i<=$maxNum;$i++){
        setcookie($i.$def,0,time()+60*60*24*30);
        $_COOKIE[$i.$def]=0;
    }
    $restart=true;
}//setcookie('answer'.$def); = 계정 정답 저장용 변수 생성


$i=1;
$result = mysqli_query($conn, "SELECT correct FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $correct[$i.$def]=$row['correct'];
    $i++;
}//$COOKIE['correct'.$def][$i] = 문제집 정답 불러오기


if(isset($_COOKIE['id'])){
    $result = mysqli_query($conn, "SELECT answer,num FROM ".$_COOKIE['id'].$select);
    while($row = $result->fetch_assoc()) {
        setcookie($row['num'].$def,$row['answer']);
        $_COOKIE[$row['num'].$def]=$row['answer'];
    }
}//$COOKIE['answer'.$def][$i] = 계정 정답 불러오기


//초기 설정


if(isset($_GET['submit'])){
    for($i=1;$i<=$maxNum;$i++){
       if(isset($_GET[$i])&&!empty($_GET[$i])){
           if(isset($_COOKIE['id'])){
               mysqli_query($conn, "delete from ".$_COOKIE['id']." where num=".$i." and year=".$_GET['year']." and month=".$_GET['month']." and grade=".$_GET['grade']." and subject='".$_GET['subject']."'");
               mysqli_query($conn, "insert into ".$_COOKIE['id']." values(".$i.",".$_GET[$i].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."')");
           }
           setcookie($i.$def,$_GET[$i]);
           $_COOKIE[$i.$def]=$_GET[$i];
       }
    }
        if(isset($_GET['answer'])&&!empty($_GET['answer'])){
            if(isset($_COOKIE['id'])){
                mysqli_query($conn, "delete from ".$_COOKIE['id']." where num=".$_GET['jump']);
                mysqli_query($conn, "insert into ".$_COOKIE['id']." values(".$_GET['jump'].",".$_GET['answer'].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."')");
            }
            setcookie($_GET['jump'].$def,$_GET['answer']);
            $_COOKIE[$_GET['jump'].$def]=$_GET['answer'];
        }
        if($_GET['submit']=="다음 문제"&&$_GET['jump']<=$maxNum){
            $_GET['jump']++;
        }else if($_GET['submit']=="이전 문제"&&$_GET['jump']>1){
            $_GET['jump']--;
        }//문제간 이동 설정
}//버튼 이벤트 확인


$result = mysqli_query($conn, "SELECT * FROM list".$select." AND num=".$_GET['jump']);
while($row = $result->fetch_assoc()) {
    $question=$row['question'];
    $example=$row['example'];
    $select1=$row['select1'];
    $select2=$row['select2'];
    $select3=$row['select3'];
    $select4=$row['select4'];
    $select5=$row['select5'];
    $sound=$row['sound'];
    $picture=$row['picture'];
}//해당 문제 정보 불러오기
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/solve.css">
    <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/solve.js"></script>
    <title>문제페이지</title>
    <meta charset="UTF-8">
</head>

<body>
    <form action="" method="get">
        <?php
        echo "<input type=\"hidden\" name=\"year\" value=\"".$_GET['year']."\">";
        echo "<input type=\"hidden\" name=\"month\" value=\"".$_GET['month']."\">";
        echo "<input type=\"hidden\" name=\"grade\" value=\"".$_GET['grade']."\">";
        echo "<input type=\"hidden\" name=\"subject\" value=\"".$_GET['subject']."\">";
        echo "<input type=\"hidden\" name=\"jump\" value=\"".$_GET['jump']."\">";
        //필요 get 정보 자동 기입
        ?>
        <div id="title">
            <?php
            echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['subject']," 모의고사";
        ?>
        </div>
        <div id="body">
            <?php
        
        ?>
            <div id="All">
                <div id="All_left">
                    <div id="quest">
                        <?php
                        echo "<div class=\"wrap\">"; 
                        echo "<div class=\"text_wrap\">";
                        echo "<div class=\"btn\"><div class=\"prev\"><input type=\"submit\" value=\"이전 문제\" name=\"submit\"></div>";
                        echo "<div class=\"next\"><input type=\"submit\" value=\"다음 문제\" name=\"submit\"></div></div>";
                        echo "<div class=\"text\">";
                        echo "<span>",$_GET['jump'],"번 문제</span>";
                        if($correct[$_GET['jump'].$def]==$_COOKIE[$_GET['jump'].$def]){
                            echo "<div class=\"correct\">맞았습니다!</div>";
                        }else{
                            echo "<div class=\"uncorrect\">틀렸습니다!</div>";
                        }//정답 일치 판별 후 출력
                        echo $question,"<br>";
                        if(!empty($picture)&&$picture!=""&&$picture!=" "){
                            echo "<img src=\"",$picture,"\">";
                        }
                        if(!empty($example)&&$example!=""&&$example!=" "){
                            echo $example;
                        }
                        if(!empty($sound)&&$sound!=""&&$sound!=" "){
                            echo "<audio src=\"$sound\" controls=\"controls\"></audio>";
                        }
                        echo "<div class=\"mark\">";
                        for($i=1;$i<=5;$i++){
                            if($_COOKIE[$_GET['jump'].$def]==$i){
                                echo "<div class=\"radio".$i."\"><input type=\"radio\" name=\"answer\" value=\"$i\" checked=\"checked\" id=\"$i\"> <label for=\"$i\">",${"select".$i},"</label></div><br>";
                            }else if($correct[$_GET['jump'].$def]==$i){
                                echo "<div class=\"radio".$i."c\"><input type=\"radio\" name=\"answer\" value=\"$i\" id=\"$i\"> <label for=\"$i\">",${"select".$i},"</label></div><br>";
                            }else{
                                echo "<div class=\"radio".$i."\"><input type=\"radio\" name=\"answer\" value=\"$i\" id=\"$i\"> <label for = \"$i\">",${"select".$i},"</label></div><br>";
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                    </div>
                </div>

                <div id="All_right">

                    <div class="omr_form">
                        <div class="timer">

                            <span class="countTimeMinute">00</span> :
                            <span class="countTimeSecond">00</span>
                        </div>

                        <div class="alltimer">
                            <span class="allTimeMinute">00</span> :
                            <span class="allTimeSecond">00</span>
                        </div>
                        <div class="omr">
                            <?php
                               for($i=1;$i<=$maxNum;$i++){
                                   echo "<div class=\"omr_float\">";
                                   echo "<div class=\"number\"><a href=\"/solve.php/?grade=".$_GET['grade']."&year=".$_GET['year']."&month=".$_GET['month']."&subject=".$_GET['subject']."&jump=",$i,"\" target=\"_self\">";
                                   if($i<10)
                                       echo "0".$i.".";
                                   else
                                       echo $i.".";
                                   echo "</a></div>";
                                   for($j=1;$j<6;$j++){
                                       if($_COOKIE[$i.$def]==$j){
                                           echo "<div class=\"omr".$j."\"><input type=\"radio\" name=\"".$i."\" value=\"$j\" id=\"omr".$i."_".$j."\" checked=\"checked\"><label for=\"omr".$i."_".$j."\"></label></div>";
                                       }else{
                                           echo "<div class=\"omr".$j."\"><input type=\"radio\" name=\"".$i."\" value=\"$j\" id=\"omr".$i."_".$j."\"><label for=\"omr".$i."_".$j."\"></label></div>";
                                       }
                                   }
                                   echo "</div>";
                                   echo "<br>";
                               }
                            ?>
                        </div>
                        <div class="submit">
                            <input type="submit" value="제출" name="submit" class="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>
