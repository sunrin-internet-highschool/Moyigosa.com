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
    <link rel="stylesheet" type="text/css" href="/index.css">
    <script src="/index.js"></script>
    <title>모의고사풀이사이트</title>
</head>

<body>
    <div id="title">
        <div class="logo">
            <a href="" class="title"><img src="/picture/index_img/logo.png" alt="모의고사"></a>
        </div>
        <div class="text">
            <img src="/picture/index_img/pencil.png" alt="연필">&nbsp;문제 풀이&nbsp;<span>Problem Solving</span>
        </div>
        <div id="user">
            <?php
            if(isset($_POST['logout'])){
                session_unset();
                echo"<script>alert('로그아웃되었습니다');</script>";
            }
            
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "hello ",$_SESSION['nick'],".";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"submit\" value=\"로그아웃\" name=\"logout\">";
                echo "</form>";
                echo "<a href=\"user.php\" target=\"_blank\">회원정보수정</a>";
            }else{//로그인 안된 상태
                $_SESSION['temp']=true;
                echo "<a href=\"login.php\" target=\"_self\">로그인</a>";
                echo" | ";
                echo "<a href=\"signUp.php\" target=\"_blank\">회원가입</a>";
            }
            ?>
        </div>

    </div>
    <div id="main">
        <p id="sebu">세부 검색</p>

        <div id="menu">
            <form action="" method="get">
                <select name="grade">
                    <option>학년</option>
                    <?php 
            for($i=0;!empty($grade[$i]);$i++){
                        echo "<option value=\"",$grade[$i],"\">",$grade[$i],"학년</option>";
                    }
                ?>
                </select>
                <select name="year">
                    <option>년도</option>
                    <?php for($i=0;!empty($year[$i]);$i++){
                        echo "<option value=\"",$year[$i],"\">",$year[$i],"년</option>";
                    }
                ?>

                </select>
                <select name="month">
                    <option>월</option>
                    <?php for($i=0;!empty($month[$i]);$i++){
                        echo "<option value=\"",$month[$i],"\">",$month[$i],"월</option>";
                    }
                ?>
                </select>
                <select name="subject">
                    <option>과목</option>
                    <?php for($i=0;!empty($subject[$i]);$i++){
                        echo "<option value=\"",$subject[$i],"\">",$subject[$i],"</option>";
                    }
                ?>
                </select>
                <input type="image" src="/picture/index_img/search.png" value="검색" class="search">;

            </form>
        </div>

        <div id="list">
            <?php
            $say=null;
        if(isset($_GET['year'])&&"년도"!=$_GET['year']){
            $say="&&year=".$_GET['year'];
        }
        if(isset($_GET['month'])&&"월"!=$_GET['month']){
            $say.="&&month=".$_GET['month'];
        }
        if(isset($_GET['grade'])&&"학년"!=$_GET['grade']){
            $say.="&&grade=".$_GET['grade'];
        }
        if(isset($_GET['subject'])&&"과목"!=$_GET['subject']){
            $say.="&&subject=\"".$_GET['subject']."\"";
        }
        $result = mysqli_query($conn, ("select distinct year,month,grade,subject from list where year is not null ".$say));
        ?>

            <table class="list">
                <tr>
                    <td class="td">학년</td>
                    <td class="td">년도</td>
                    <td class="td">월</td>
                    <td class="td">과목</td>
                    <td  class="td" colspan="2">현황</td>
                </tr>
                <?php
                while($row = $result->fetch_assoc()) {
                    $count=0;
                    $per=0;
                    $year=$row['year'];
                    $month=$row['month'];
                    $grade=$row['grade'];
                    $subject=$row['subject'];
                    $def=$year.$month.$grade.$subject;
                    
                    $result2 = mysqli_query($conn,"select count(num) from list where year=$year and month=$month and grade=$grade and subject='$subject'");
                    while($row2 = $result2->fetch_assoc()) {
                        $maxNum=$row2['count(num)'];
                    }
                    
                    for($i=1;$i<=$maxNum;$i++){
                        if(isset($_SESSION[$def][1][$i])&&$_SESSION[$def][1][$i]>=1&&$_SESSION[$def][1][$i]<=5){
                            $count++;
                        }
                    }
                    
                    if(isset($_SESSION['id'])){
                        $result3 = mysqli_query($conn,"select count(answer) from ".$_SESSION['id']." where year=$year and month=$month and grade=$grade and subject='$subject'");
                        while($row3 = $result3->fetch_assoc()) {
                            $count=$row3['count(answer)'];
                        }
                    }
                    
                   if($count){
                       $per=$count/$maxNum*100;
                    }
                    
                    echo "<tr>";
                    echo "<td class=\"td\">";
                    echo "<a href=\"solve.php/?grade=$grade&year=$year&month=$month&subject=$subject&jump=1\" target=\"_blank\" class=\"href\"><img src=\"/picture/index_img/index.png\"></a>";
                    echo $grade,"학년</td>";
                    echo "<td class=\"td\">",$year,"</td>";
                    echo "<td class=\"td\">",$month,"</td>";
                    echo "<td class=\"td\">",$subject,"</td>";
                    echo "<td class=\"td\">$count/$maxNum<br><div class=\"background\"><div class=\"bar\" style=\"width:",$per,"%;\"></div></div></td>";
                    echo "</tr>";
                }
        ?>
            </table>
        </div>
    </div>
</body>

</html>