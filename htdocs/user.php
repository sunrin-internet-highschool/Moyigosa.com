<?php
session_start();
if(!isset($_SESSION['id'])||!isset($_SESSION['pw'])||!isset($_SESSION['nick'])){
    echo"<script>alert('잘못된 접근입니다.');self.close();</script>";   
    die();
}
if(isset($_POST['change'])){
    if($_POST['pw']!=$_SESSION['pw']){
        echo"<script>alert('입력하신 비밀번호가 알맞지 않습니다.');</script>"; 
    }else{
        require_once('cnn.php');
        mysqli_query($conn, "update users set id='".$_POST['id']."',password='".$_POST['npw']."',email='".$_POST['email']."',name='".$_POST['name']."',nick='".$_POST['nick']."' where id='".$_SESSION['id']."'");
        mysqli_query($conn,"rename table ".$_SESSION['id']." to ".$_POST['id']);
        $_SESSION['id']=$_POST['id'];
        $_SESSION['pw']=$_POST['npw'];
        $_SESSION['name']=$_POST['name'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['nick']=$_POST['nick'];
    }
}
?>
<html>

<head>
    <link rel= "stylesheet" type="text/css" href="/user.css">
    <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/user.js"></script>
    
    <title>
        <?php
                echo $_SESSION['nick']."님의 회원정보";
            ?>
    </title>
    
</head>
<body>
          
           <div class="wrap">
               <header><img src="/picture/signUp_img/logo.png" alt="로고"></header>
                <table class="bar">
                   <tr>
                       <td><span>문제 풀이</span></td>
                       <td><span>문제 풀이</span></td>
                       <td><span>문제 풀이</span></td>
                       <td><span id="last">문제 풀이</span></td>
                   </tr>
               </table>
                   <form method="post" target="_self" onsubmit="return Login()">
                   <?php
                       echo "<div class=\"login_wrap\">";
                       echo "<div class=\"login\">";
                       echo "<span id=\"login_title\">".$_SESSION['nick']."님의 회원정보</span>";
                       echo "<div class=\"frame\">";
                       //echo "<br>";
                       echo "<div class=\"id_wrap\">";
                       echo "<span class=\"id\">아이디</span> <span id=\"id_check\"></span> <input type=\"text\" id=\"id\" name=\"id\" value=\"".$_SESSION['id']."\" maxlength=\"12\" onKeyup=id_check(this)>";
                       echo "</div>";
                       
                       
                       //echo "<br>";
                       echo "<div class=\"password_wrap\">";
                       echo "<span class=\"pw\">비밀번호</span> <span id=\"pw_check\"></span> <input type=\"password\" id=\"pw\" name=\"pw\" maxlength=\"12\" onKeyup=password_check(this)>";
                       echo "</div>";
               
                       //echo "<br>";
                       echo "<div class=\"password_confirm_wrap\">";
                       echo "<span class=\"npw\">새로운 비밀번호</span> <span id=\"npw_check\">(영문 숫자 조합 8자 이상)</span> <input type=\"password\" id=\"npw\" 
                       name=\"npw\" maxlength=\"12\" onKeyup=password_check(this)>";
                       echo "</div>";
                       
                       //echo "<br>";
                       /*
                       echo "<span class=\"password_confirm\">비밀번호 확인</span>: <input type=\"password\" id=\"npw_re\" name=\"npw_re\" maxlength=\"12\" onKeyup=password_check(this)> ";
                       echo "<span id=\"password_confirm_check\"></span>";
                       
                       //echo "<br>";
                       echo "<span class=\"name\">이름</span>: <input type=\"text\" id=\"name\" name=\"name\" 
                       value=\"".$_SESSION['name']."\" maxlength=\"12\" onKeyup=name_check(this)>";
                       echo "<span id=\"name_check\"></span>";
                       */
                       //echo "<br>";
                       echo "<div class=\"mail_wrap\">";
                       echo "<span class=\"mail\">이메일</span> <span id=\"mail_check\">(형식을 지켜주세요. 예:ho@naver.com)</span> <input type=\"text\" id=\"email\" name=\"email\" value=\"".$_SESSION['email']."\" onKeyup=mail_check(this)>";
                       echo "</div>";
                       
                       //echo "<br>";
                       echo "<div class=\"nick_wrap\">";
                       echo "<span class=\"nick\">닉네임</span> <span id=\"nick_check\"></span> <input type=\"text\" id=\"nick\" name=\"nick\" value=\"".$_SESSION['nick']."\">";
                       echo "</div>";
                       
                       //echo "<br>";
                       echo "<div class=\"submit_wrap\">";
                       echo "<input type=\"submit\" name=\"change\" value=\"수정\">";
                       echo "</div>";
                       echo "</div>";
                       echo "</div>";
                       echo "</div>";
                   ?>
                   </form>
           </div>
</body>
</html>
