<?php
session_start();
require_once ('checkError.php');//get방식으로 불러오는 변수 존재 여부 확인


require_once ('cnn.php');//mysql 연결 설정


$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";


$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];


$result = mysqli_query($conn, "SELECT count(num) FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $maxNum=$row['count(num)'];
}//$maxNum = 문제집 문제 갯수

$i=1;
$result = mysqli_query($conn, "SELECT correct FROM list".$select." order by num");
while($row = $result->fetch_assoc()) {
    $correct[$i.$def]=$row['correct'];
    $i++;
}//$COOKIE['correct'.$def][$i] = 문제집 정답 불러오기


if(isset($_SESSION['id'])){
    $result = mysqli_query($conn, "SELECT answer,num FROM ".$_SESSION['id'].$select);
    while($row = $result->fetch_assoc()) {
        $_SESSION[$def][1][$row['num']]=$row['answer'];
    }
}//$COOKIE['answer'.$def][$i] = 계정 정답 불러오기


//초기 설정


if(isset($_GET['submit'])||isset($_GET['jump_button'])){
    for($i=1;$i<=$maxNum;$i++){
       if(isset($_GET[$i])&&!empty($_GET[$i])){
           if(isset($_SESSION['id'])){
               mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$i." and year=".$_GET['year']." and month=".$_GET['month']." and grade=".$_GET['grade']." and subject='".$_GET['subject']."'");
               mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$i.",".$_GET[$i].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."',0)");
           }
           $_SESSION[$def][1][$i]=$_GET[$i];
       }
    }
        if(isset($_GET['answer'])&&!empty($_GET['answer'])){
            if(isset($_SESSION['id'])){
                mysqli_query($conn, "delete from ".$_SESSION['id']." where num=".$_GET['jump']);
                mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_GET['jump'].",".$_GET['answer'].','.$_GET['year'].','.$_GET['month'].','.$_GET['grade'].",'".$_GET['subject']."',0)");
            }
            $_SESSION[$def][1][$_GET['jump']]=$_GET['answer'];
        }
        if(isset($_GET['submit'])&&$_GET['submit']=="다음 문제"&&$_GET['jump']<$maxNum){
            $_GET['jump']++;
        }else if(isset($_GET['submit'])&&$_GET['submit']=="이전 문제"&&$_GET['jump']>1){
            $_GET['jump']--;
        }else if(isset($_GET['submit'])&&$_GET['submit']=="하나 채점"){
            $_SESSION[$def][0][$_GET['jump']]=1;
        }else if(isset($_GET['submit'])&&$_GET['submit']=="전부 채점"){
            for($i=1;$i<=$maxNum;$i++){
                $_SESSION[$def][0][$i]=1;
            }
        }else if(isset($_GET['submit'])&&$_GET['submit']=="하나 채점 취소"){
            $_SESSION[$def][0][$_GET['jump']]=0;
        }else if(isset($_GET['submit'])&&$_GET['submit']=="전부 채점 취소"){
            for($i=1;$i<=$maxNum;$i++){
                $_SESSION[$def][0][$i]=0;
            }
        }else if(isset($_GET['jump_button'])){
            for($i=1;$i<=$maxNum;$i++){
                if($_GET['jump_button']==$i){
                    $_GET['jump']=$i;
                    break;
                }else if($_GET['jump_button']=='0'.$i){
                    $_GET['jump']=substr($i,2,1);
                }
            }
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
    <!--<script src="/solve.js"></script>-->
    <script>
        var all_minute=0;
        var all_second=0;
        
        $(document).ready(function(){
            
                
                var minute=0;
                var second=0;
                var cnt_sec=0;

                $(".countTimeMinute").html(minute);
                $(".countTimeSecond").html(second);
                $(".allTimeMinute").html(all_minute);
                $(".allTimeSecond").html(all_second);
                
                var timer = setInterval(countTime,1000);
                var all_timer = setInterval(alltimer, 1000);
                
                function countTime(){
                    $(".countTimeMinute").html(minute);
                    $(".countTimeSecond").html(second);
                    
                    cnt_sec++;
                    second++;
                    if(second==60){
                        minute++;
                        second=0;
                    }
                    if(cnt_sec>=90){
                        $('.timer span').css({'color':'red'});
                    }
                    
                }   
                function alltimer(){
                    $(".allTimeMinute").html(all_minute);
                    $(".allTimeSecond").html(all_second);
                    all_second++;
                    if(all_second==60){
                        all_minute++;
                        all_second=0;
                    } 
                }
                
                $(".prev").click(function(){
                    minute=0;
                    second=0;
                    cnt_sec=0;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".next").click(function(){
                    minute=0;
                    second=0;
                    cnt_sec=0;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".submit").click(function(){
                    all_sec=0;
                    all_minute=0;
                })
            
            
            
            var cnt=0;
                $("#slide_img").click(function(){
                    if(cnt==0){
                        $("#omr").animate({'right':'-17em'},1000);
                        cnt++;
                    }
                    else{
                        $("#omr").animate({'right':'0'},1000);
                        cnt=0;
                    }
                })
            
    $(".back").mouseover(function(){
        document.getElementById("move").value = '이전 문제';
    })
    $(".back").mouseout(function(){
        document.getElementById("move").value = '0';
    })
    $(".front").mouseover(function(){
        document.getElementById("move").value = '다음 문제';
    })
    $(".front").mouseout(function(){
        document.getElementById("move").value = '0';
    })

            
            });

    </script>
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
        echo "<input type=\"hidden\" name=\"jump\" value=\"".$_GET['jump']."\">";
        echo "<input type=\"hidden\" name=\"all_minute\" value=\"".$_GET['all_minute']."\">";
        echo "<input type=\"hidden\" name=\"all_second\" value=\"".$_GET['all_second']."\">";
        echo "<input type=\"hidden\" name=\"minute\" value=\"".$_GET['minute']."\">";
        echo "<input type=\"hidden\" name=\"second\" value=\"".$_GET['second']."\">";
        echo "<input id=\"move\" type=\"hidden\" name=\"submit\" value=\"0\">";
        
        
        //필요 get 정보 자동 기입
        ?>
        <div id="title">
                <?php
            echo "전국연합모의평가 ",$_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['grade'],"학년 ",$_GET['subject'],"영역";
        ?>
        </div>
        <div id="body">
            <?php
            
        ?>
            <div id="quest">
                <?php
                        echo "<div class=\"quest\">";;
                        if(isset($_SESSION[$def][0][$_GET['jump']])&&$_SESSION[$def][0][$_GET['jump']]==1){
                            if(isset($_SESSION[$def][1][$_GET['jump']])&&$correct[$_GET['jump'].$def]==$_SESSION[$def][1][$_GET['jump']]){
                                echo "<img src=\"/picture/solve_img/ox/MarkO.png\">";
                            }else{
                                echo "<img src=\"/picture/solve_img/ox/MarkX.png\">";
                            }//정답 일치 판별 후 출력
                        }
                        echo $_GET['jump'],". $question</div>";
                        echo "<div class=\"text\">";
                        
                        if(!empty($picture)&&$picture!=""&&$picture!=" "){
                            echo "<img src=\"",$picture,"\">";
                        }
                        if(!empty($example)&&$example!=""&&$example!=" "){
                            echo "<div class=\"example\">$example</div>";
                        }
                        if(!empty($sound)&&$sound!=""&&$sound!=" "){
                            echo "<audio src=\"$sound\" controls=\"controls\"></audio>";
                        }
                        echo "</div>";
                        echo "<div class=\"mark\">";
                        for($i=1;$i<=5;$i++){
                            if(isset($_SESSION[$def][1][$_GET['jump']])&&$_SESSION[$def][1][$_GET['jump']]==$i){
                                echo "<input type=\"radio\" name=\"answer\" value=\"$i\" checked=\"checked\" id=\"b$i\"> <label for=\"b$i\">&nbsp;",${"select".$i},"</label><br>";
                            }else if(isset($_SESSION[$def][0][$_GET['jump']])&&$_SESSION[$def][0][$_GET['jump']]==1&&$correct[$_GET['jump'].$def]==$i){
                                echo "<input type=\"radio\" name=\"answer\" value=\"$i\" id=\"b$i"."c\"><label for=\"b$i"."c\">&nbsp;",${"select".$i},"</label><br>";
                            }else{
                                echo "<input type=\"radio\" name=\"answer\" value=\"$i\" id=\"b$i\"><label for = \"b$i\">&nbsp;",${"select".$i},"</label><br>";
                            }
                        }
                        echo "</div>";
                        echo "<div class=\"button\">";
                        echo "<input type=\"submit\" value=\"하나 채점\" name=\"submit\"><br>";
                        echo "<input type=\"submit\" value=\"하나 채점 취소\" name=\"submit\">";
                        echo "</div>";
                        ?>

                <input type="image" src="/picture/solve_img/arrow/beforeproblem.png" value="이전 문제" name="submit" class="back" >
                <input type="image" src="/picture/solve_img/arrow/nextproblem.png" value="다음 문제" name="submit" class="front" >
            </div>

        </div>
        <div id="omr">
            <div class="bar"><img id="slide_img" src="/picture/solve_img/arrow/left.png"></div>
            <div class="body">
                <div class="text"><img src="/picture/solve_img/timer/clock.png">&nbsp;경과시간</div>
                <div class="timer">
                    <span>
                    <span class="countTimeMinute">00</span> :
                    <span class="countTimeSecond">00</span>
                    </span>
                </div>
                
                <div class="text"><img src="/picture/solve_img/timer/clock.png">&nbsp;총 경과시간</div>
                <div class="alltimer">
                    <span>
                    <span class="allTimeMinute">00</span> :
                    <span class="allTimeSecond">00</span>
                    </span>
                </div>
                <div class="omr">
                    <?php
                               for($i=1;$i<=$maxNum;$i++){
                                   if(isset($_SESSION[$def][0][$i])&&$_SESSION[$def][0][$i]==1){
                                           if(isset($_SESSION[$def][1][$i])&&$_SESSION[$def][1][$i]==$correct[$i.$def]){
                                               echo "<div class=\"omr_float_correct\">";
                                           }else{
                                               echo "<div class=\"omr_float_uncorrect\">";
                                           }
                                       }else{
                                           echo "<div class=\"omr_float\">";
                                       }
                                   if($i<10){
                                       echo "<input type=\"submit\" class=\"num\" value=\"0$i\" name=\"jump_button\">";
                                   }else{
                                       echo "<input type=\"submit\" class=\"num\" value=\"$i\" name=\"jump_button\">";
                                   }
                                   for($j=1;$j<6;$j++){
                                       if(isset($_SESSION[$def][1][$i])&&$_SESSION[$def][1][$i]==$j){
                                           echo "<input type=\"radio\" name=\"".$i."\" value=\"$j\" id=\"$i-".$j."\" checked=\"checked\" class=\"omr$j\"><label for=\"$i-".$j."\"></label>";
                                       }else{
                                           echo "<input type=\"radio\" name=\"".$i."\" value=\"$j\" id=\"$i-".$j."\" class=\"omr$j\"><label for=\"$i-".$j."\"></label>";
                                       }
                                   }
                                    echo "</div>";
                               }
                            ?>
                </div>
                <div class="submit">
                    <input type="submit" value="전부 채점" name="submit" class="submit_button"><input type="submit" value="전부 채점 취소" name="submit" class="submit_button">
                </div>
            </div>
        </div>
    </form>

</body>

</html>
