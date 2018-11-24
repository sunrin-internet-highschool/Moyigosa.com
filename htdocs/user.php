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
    <form method="post" target="_self" onsubmit="return Login()">
    <?php
        echo $_SESSION['nick']."님의 회원정보";
        echo "<br>";
        echo "<span class=\"id\">아이디</span>: <input type=\"text\" id=\"id\" name=\"id\" value=\"".$_SESSION['id']."\" maxlength=\"12\" onKeyup=id_check(this)>";
        echo "<span id=\"id_check\"></span>";
        echo "<br>";
        echo "<span class=\"pw\">비밀번호</span>: <input type=\"password\" id=\"pw\" name=\"pw\" maxlength=\"12\" onKeyup=password_check(this)>";
        echo "<span id=\"pw_check\"></span>";
        echo "<br>";
        echo "<span class=\"npw\">새로운 비밀번호</span>: <input type=\"password\" id=\"npw\" 
        name=\"npw\" maxlength=\"12\" onKeyup=password_check(this)>";
        echo "<span id=\"npw_check\"></span>";
        echo "<br>";
        echo "<span class=\"password_confirm\">비밀번호 확인</span>: <input type=\"password\" id=\"npw_re\" name=\"npw_re\" maxlength=\"12\" onKeyup=password_check(this)> ";
        echo "<span id=\"password_confirm_check\"></span>";
        echo "<br>";
        echo "<span class=\"name\">이름</span>: <input type=\"text\" id=\"name\" name=\"name\" 
        value=\"".$_SESSION['name']."\" maxlength=\"12\" onKeyup=name_check(this)>";
        echo "<span id=\"name_check\"></span>";
        echo "<br>";
        echo "<span class=\"mail\">이메일</span>: <input type=\"text\" id=\"email\" name=\"email\" value=\"".$_SESSION['email']."\" onKeyup=mail_check(this)>";
        echo "<span id=\"mail_check\"></span>";
        echo "<br>";
        echo "<span class=\"nick\">닉네임</span>: <input type=\"text\" id=\"nick\" name=\"nick\" value=\"".$_SESSION['nick']."\" onKeyup=nick_check(this)>";
        echo "<span id=\"nick_check\"></span>";
        echo "<br>";
        echo "<input type=\"submit\" name=\"change\" value=\"수정\">";
    ?>
    </form>
</body>
</html>
