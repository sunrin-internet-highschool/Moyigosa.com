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

    <link rel= "stylesheet" type="text/css" href="/index.css">
    <title>모의고사풀이사이트</title>
</head>

<body>
    <div id="title">
       <div class="background_book">
              <a href="" class="title"><img id="logo" src="/picture/index_img/logo.png" alt="모의고사"></a>
              <div class="ps">
                 <div class="ps_left">
                  <img src="/picture/index_img/pencil.png" class="pencil" alt="연필">
                  </div>
                 <div class="ps_right">
                  <p>
                      문제 풀이 <span>problem Solving</span>
                  </p>
                 </div>
              </div>
       </div>
        <div id="user">
            <?php
            if(isset($_POST['logout'])){
                session_unset();
                echo"<script>alert('로그아웃되었습니다');</script>";
                exit();
            }
                            
            if(!empty($_POST['id'])&&!empty($_POST['pw'])){
                $result = mysqli_query($conn, "SELECT * FROM users where id='".$_POST['id']."' and password='".$_POST['pw']."'");
            while($row = $result->fetch_assoc()) {
                $id=$row['id'];                  
                $pw=$row['password'];
                $nick=$row['nick'];
                $name=$row['name'];
                $email=$row['email'];
                
            }
                if(!isset($id)||!isset($pw)){
                echo"<script>alert('입력하신 아이디나 비밀번호가 잘못되었습니다.');</script>";
                exit();
            } 
                unset($_POST['id']);
                unset($_POST['password']);
            }
            
            if(isset($id)&&isset($pw)&&!empty($id)&&!empty($pw)){
                $_SESSION['id']=$id;
                $_SESSION['pw']=$pw;
                $_SESSION['nick']=$nick;
                $_SESSION['name']=$name;
                $_SESSION['email']=$email;
            }       
            
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "hello ",$_SESSION['nick'],".";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"submit\" value=\"로그아웃\" name=\"logout\">";
                echo "</form>";
                echo "<a href=\"user.php\" target=\"_blank\">회원정보수정</a>";
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
    <div class="main_wrap">
        <div id="main">
            <p id="sebu">세부 검색</p>
        
            <div id="menu">
                <div class="form_wrap">
                    <form action="" method="get">
                        <!--학년 :-->
                        <select name="grade">
                            <option>선택안함</option>
                            <?php 
                    for($i=0;!empty($grade[$i]);$i++){
                                echo "<option value=\"",$grade[$i],"\">",$grade[$i],"학년</option>";
                            }
                        ?>
                        </select>
                        <!--년도 :-->
                        <select name="year">
                            <option>선택안함</option>
                            <?php for($i=0;!empty($year[$i]);$i++){
                                echo "<option value=\"",$year[$i],"\">",$year[$i],"년</option>";
                            }
                        ?>
                            
                        </select>
                        <!--월 :-->
                        <select name="month">
                            <option>선택안함</option>
                            <?php for($i=0;!empty($month[$i]);$i++){
                                echo "<option value=\"",$month[$i],"\">",$month[$i],"월</option>";
                            }
                        ?>
                        </select>
                        <!--과목 :-->
                        <select name="subject">
                            <option>선택안함</option>
                            <?php for($i=0;!empty($subject[$i]);$i++){
                                echo "<option value=\"",$subject[$i],"\">",$subject[$i],"</option>";
                            }
                        ?>
                        </select>
                        <div class="submit_wrap">
                            <input type="submit" id="submit" value="검색">
                            <label for="submit"></label>
                        </div>
                            
                    </form>
                </div>
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
            $result = mysqli_query($conn, ("select distinct year,month,grade,subject from list where year is not null ".$say));
            ?>
        
                <table class="list">
                        
                            <tr>
                                <td>학년</td><!--학년-->
                                <td>년도</td><!--년도-->
                                <td>월</td><!--월-->
                                <td>과목</td><!--과목-->
                                <td>현황</td><!--현황-->
                            </tr>

                    <?php
                    while($row = $result->fetch_assoc()) {
                        $count=0;
                        $year=$row['year'];
                        $month=$row['month'];
                        $grade=$row['grade'];
                        $subject=$row['subject'];
                        $def=$year.$month.$grade.$subject;
                        if(isset($_SESSION['id'])){
                            $result1 = mysqli_query($conn,"select count(num) from ".$_SESSION['id']." where year=$year and month=$month and grade=$grade and subject='$subject'");
                            while($row1 = $result1->fetch_assoc()) {
                                $count=$row1['count(num)'];
                            }
                        }else if(isset($_COOKIE['1'.$def])){
                            for($i=1;isset($_COOKIE[$i.$def]);$i++){
                                if($_COOKIE[$i.$def]>=1&&$_COOKIE[$i.$def]<=5)
                                    $count++;
                            }
                        }
                        
                       if($count){
                            $result2 = mysqli_query($conn,"select count(num) from list where year=$year and month=$month and grade=$grade and subject='$subject'");
                            while($row2 = $result2->fetch_assoc()) {
                                $maxNum=$row2['count(num)'];
                            }
                           $count=$count/$maxNum*100;
                        }
                        echo "<tr onClick=\"window.open('solve.php/?grade=$grade&year=$year&month=$month&subject=$subject&jump=1')\" style=\"cursor:hand\">";                
                        echo "<td><img src=\"/picture/index_img/index.png\"><span>",$grade,"학년</span></td>";
                        echo "<td>",$year,"</td>";
                        echo "<td>",$month,"</td>";
                        echo "<td>",$subject,"</td>";
                        echo "<td><div class=\"background\"><div class=\"bar\" style=\"width:",$count,"%;\"></div></div></td>";
                        echo "</tr>";
                    }
            ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
