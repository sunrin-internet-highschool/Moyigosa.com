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
   <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/user.js"></script>
    <title>회원정보수정 페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/user.css">
    
<link rel="shortcut icon" href="/picture/ico/icon_5_fsa_icon.ico">
</head>

<body>
    <?php
    require_once('top.php');
    require_once('side.php');
    ?>
    <div id="middle">
        <div id="signup_wrap">
            <div class="signup">Edit</div>

            <form method="post" action="" onsubmit="return Login()">
                <span class="id_text">아이디</span>&nbsp;<span class="id_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"text\" name=\"id\" value=\"",$_SESSION['id'],"\" class=\"id\" onKeyup=\"id_check(this)\"><br>";
                ?>
                <span class="id_text">현재 비밀번호</span>&nbsp;<span class="id_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="password" name="pw" class="pw"><br>
                <span class="pw_text">새로운 비밀번호</span>&nbsp;<span class="pw_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"password\" name=\"npw\" class=\"npw\" onKeyup=\"password_check(this)\"><br>";
                ?>
                <span class="pw_r_text">새로운 비밀번호 확인</span>&nbsp;<span class="pw_r_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"password\" name=\"npw_r\" class=\"npw_r\" onKeyup=\"password_check(this)\"><br>";
                ?>
                <span class="email_text">이메일</span>&nbsp;<span class="email_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"text\" name=\"email\" value=\"",$_SESSION['email'],"\" class=\"email\" onKeyup=\"email_check(this)\"><br>";
                ?>
                <span class="nick_text">닉네임</span>&nbsp;<span class="nick_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"text\" name=\"nick\" value=\"",$_SESSION['nick'],"\" class=\"nick\" onKeyup=\"nick_check(this)\"><br>";
                ?>
                <span class="name_text">이름</span>&nbsp;<span class="name_check">(영문 숫자 조합 20자 이하)</span><br>
                <?php
                echo "<input type=\"text\" name=\"name\" value=\"",$_SESSION['name'],"\" class=\"name\" onKeyup=\"name_check(this)\"><br>";
                ?>
                <input type="submit" value="회원정보수정" name="change">
            </form>
            
        </div>
        
    </div>
</body>

</html>
