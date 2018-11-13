<?php

session_start();
require_once ('cnn.php');

$i=0;
$sql = "SELECT distinct year FROM list";
$result = mysqli_query($conn, $sql);
while($row = $result->fetch_assoc()) {
    $year[$i]=$row["year"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct grade FROM list");
while($row = $result->fetch_assoc()) {
    $grade[$i]=$row["grade"];
    $i++;
}
    $i=0;
$result = mysqli_query($conn, "SELECT distinct month FROM list");
while($row = $result->fetch_assoc()) {
    $month[$i]=$row["month"];
    $i++;
}
        $i=0;
$result = mysqli_query($conn, "SELECT distinct subject FROM list");
while($row = $result->fetch_assoc()) {
    $subject[$i]=$row["subject"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct num FROM list");
while($row = $result->fetch_assoc()){
    $num[$i]=$row["num"];
    $i++;
}

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/index.css">
    <title>모의고사풀이사이트</title>
    <style></style>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script language="javascript">
        $(function(){
            $(".show0").click(function(){
                $('.show_data0').stop().slideToggle('fast');
            })
            
            $(".show1").click(function(){
                $('.show_data1').stop().slideToggle('fast');
            })
            
            $(".show2").click(function(){
                $('.show_data2').stop().slideToggle('fast');
            })
        })
    </script>
</head>

<body>
   <p style='display:none'>asdf</p>
    <div id="title">
        <a href="" class="title">모의고사</a>
        <div id="user">
            <?php
            if(isset($_POST['logout'])){
                session_unset();
                echo"<script>alert('로그아웃되었습니다');</script>";
            }
                            
            if(!empty($_POST['id'])&&!empty($_POST['pw'])){
                $result = mysqli_query($conn, "SELECT id,password,nick FROM users where id='".$_POST['id']."' and password='".$_POST['pw']."'");
            while($row = $result->fetch_assoc()) {
                session_unset();
                $id=$row['id'];                  
                $pw=$row['password'];
                  
                $nick=$row['nick'];
            }
                if(!isset($id)||!isset($pw)){
                echo"<script>alert('입력하신 아이디나 비밀번호가 잘못되었습니다.');</script>";
            } 
            }
            
            if(!empty($id)&&!empty($pw)){
                $_SESSION['nick']=$nick;
                $_SESSION['id']=$id;
                $_SESSION['pw']=$pw;
            }       
            
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "hello ",$_SESSION['nick'],".";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"submit\" value=\"로그아웃\" name=\"logout\">";
                echo "</form>";
            }else{//로그인 안된 상태
                echo "<div id=\"login\">";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"text\" name=\"id\" class=\"input\"><br>";
                echo "<input type=\"password\" name=\"pw\" class=\"input\">";
                echo "<input type=\"submit\" value=\"로그인\" class=\"login\">";
                echo "</form>";
                echo "</div>";
                echo "<a href=\"signUp.php\" target=\"_blank\">회원가입</a>";
            }
            ?>
        </div>

    </div>
    <div id="main">

        <div id="menu">
            <form action="" method="get">
                학년 :
                <select name="grade">
                    <option>선택안함</option>
                    <?php 
            for($i=0;!empty($grade[$i]);$i++){
                        echo "<option value=\"",$grade[$i],"\">",$grade[$i],"학년</option>";
                    }
                ?>
                </select>
                년도 :
                <select name="year">
                    <option>선택안함</option>
                    <?php for($i=0;!empty($year[$i]);$i++){
                        echo "<option value=\"",$year[$i],"\">",$year[$i],"년</option>";
                    }
                ?>

                </select>
                월 :
                <select name="month">
                    <option>선택안함</option>
                    <?php for($i=0;!empty($month[$i]);$i++){
                        echo "<option value=\"",$month[$i],"\">",$month[$i],"월</option>";
                    }
                ?>
                </select>
                과목 :
                <select name="subject">
                    <option>선택안함</option>
                    <?php for($i=0;!empty($subject[$i]);$i++){
                        echo "<option value=\"",$subject[$i],"\">",$subject[$i],"</option>";
                    }
                ?>
                </select>
                <input type="submit" value="검색">

            </form>
        </div>

        <div id="list">
            <?php
            $say=null;
        if(isset($_GET['year'])&&"선택안함"!=$_GET['year']){
            $say="&&year=".$_GET['year'];
        }
        if(isset($_GET['month'])&&"선택안함"!=$_GET['month']){
            $say.="&&month=".$_GET['month'];
        }
        if(isset($_GET['grade'])&&"선택안함"!=$_GET['grade']){
            $say.="&&grade=".$_GET['grade'];
        }
        if(isset($_GET['subject'])&&"선택안함"!=$_GET['subject']){
            $say.="&&subject=\"".$_GET['subject']."\"";
        }
        $result2 = mysqli_query($conn, ("select distinct year,month,grade,subject from list where year is not null ".$say));
        ?>

            <table class="list">
                <tr>
                    <td>학년</td>
                    <td>년도</td>
                    <td>월</td>
                    <td>과목</td>
                    <td colspan="2">현황</td>
                </tr>
                <?php
                if(isset($_SESSION['id'])){
                    $result = mysqli_query($conn, "select * from ".$_SESSION['id']);
                    while($row = $result->fetch_assoc()) {
                        $year=$row['year'];
                        $month=$row['month'];
                        $subject=$row['subject'];
                        $grade=$row['grade'];
                        $num=$row['num'];
                        $answer=$row['answer'];
                        $def=$year.$month.$grade.$subject;
                        $_SESSION['answer'.$def][$num]=$answer;
                }
                }
                $i=0;
                while($row = $result2->fetch_assoc()) {
                $year=$row["year"];
                $month=$row["month"];
                $grade=$row["grade"];
                $subject=$row["subject"];
                if(isset($_SESSION['answer'.$year.$month.$grade.$subject])){
                    $count=0;
                    $select=" WHERE grade=".$grade." AND year=".$year." AND month=".$month." AND subject='".$subject."'";
                    $result1 = mysqli_query($conn, "SELECT count(num) FROM list".$select);
                    while($row1 = $result1->fetch_assoc()) {
                    $_SESSION['questFinal'.$year.$month.$grade.$subject]=$row1['count(num)'];
                    }
                    for($i=1;$i<=$_SESSION['questFinal'.$year.$month.$grade.$subject];$i++){
                        if(isset($_SESSION['answer'.$year.$month.$grade.$subject][$i])){
                            $count++;
                        }
                    }
                    $count=$count*10/$_SESSION['questFinal'.$year.$month.$grade.$subject];
                }else{
                    $count=0;
                }
                echo "<tr>";                
                echo "<td onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject')\" style=\"cursor:hand\">",$grade,"학년</td>";
                echo "<td onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject')\" style=\"cursor:hand\">",$year,"</td>";
                echo "<td onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject')\" style=\"cursor:hand\">",$month,"</td>";
                echo "<td onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject')\" style=\"cursor:hand\">",$subject,"</td>";
                echo "<td onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject')\" style=\"cursor:hand\"><div class=\"background\"><div class=\"bar\" style=\"width:",$count,"em;\"></div></div></td>";
                echo "<td><input type=\"button\" value=\"↓\" class=\"show$i\"></td>";
                echo "</tr>";
                    echo "<tr class=\"show_data$i\" style=\"display:none\"><td colspan=\"6\" id=\"show_data$i\"><div>1.맞은문제<br>2.틀린문제<br>3.안푼문제<br>4.마지막으로 푼문제이동</div></td></tr>";
                    $i+=1;
            }
        ?>
            </table>
        </div>
    </div>
</body>

</html>
