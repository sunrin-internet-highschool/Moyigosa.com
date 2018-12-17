<?php
if(isset($_POST['id'])&&isset($_POST['pw'])&&isset($_POST['email'])&&isset($_POST['name'])&&isset($_POST['nick'])){
    $_POST['id']=htmlspecialchars($_POST['id']);
    $_POST['pw']=htmlspecialchars($_POST['pw']);
    $_POST['email']=htmlspecialchars($_POST['email']);
    $_POST['name']=htmlspecialchars($_POST['name']);
    $_POST['nick']=htmlspecialchars($_POST['nick']);
    require_once ('cnn.php');
    $result = mysqli_query($conn, "SELECT id FROM users where id='".$_POST['id']."'");
    while($row = $result->fetch_assoc()) {
        $id=$row['id'];
    }
    if(empty($id)){
        mysqli_query($conn, "insert into users values('".$_POST['id']."','".$_POST['pw']."','".$_POST['name']."','".$_POST['email']."','".$_POST['nick']."')");
        mysqli_query($conn, "create table ".$_POST['id']."(num int not null, answer int,year int not null, month int not null, grade int not null,subject varchar(11) not null)");
        echo"<script>location.href=\"/\";</script>";
        exit();
    }   
}  
?>
<html>

<head>
    <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/signUp.js"></script>
    <title>회원가입 페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/signUp.css">
</head>

<body>
    <?php
    require_once('top.php');
    require_once('side.php');
    ?>
    <div id="middle">
        <div id="signup_wrap">
            <div class="signup">Registration</div>

            <form method="post" action="" onsubmit="return Login()">
                <span class="id_text">아이디</span>&nbsp;<span class="id_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="id" class="id" onKeyup=id_check(this) maxlength="20"><br>
                <span class="pw_text">비밀번호</span>&nbsp;<span class="pw_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="password" name="pw" class="pw" onKeyup=password_check(this) maxlength="20"><br>
                <span class="pw_r_text">비밀번호 확인</span>&nbsp;<span class="pw_r_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="password" name="pw_r" class="pw_r" onKeyup=password_check(this) maxlength="20"><br>
                <span class="email_text">이메일</span>&nbsp;<span class="email_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="email" name="email" class="email" onKeyup=email_check(this) maxlength="20"><br>
                <span class="nick_text">닉네임</span>&nbsp;<span class="nick_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="nick" class="nick" onKeyup=nick_check(this) maxlength="20"><br>
                <span class="name_text">이름</span>&nbsp;<span class="name_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="name" class="name" onKeyup=name_check(this) maxlength="20"><br>
                <input type="submit" id="submit" value="회원가입">
            </form>
        </div>
        
    </div>
</body>

</html>
