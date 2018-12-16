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
        mysqli_query($conn, "insert into users values('".$_POST['id']."','".$_POST['password']."','".$_POST['name']."','".$_POST['mail']."','".$_POST['nick']."')");
        mysqli_query($conn, "create table ".$_POST['id']."(num int not null, answer int,year int not null, month int not null, grade int not null,subject varchar(11) not null)");
        echo"<script>location.href=\"/index.php\";</script>";
        exit();
    }   
}  
?>
<html>

<head>
    <script src="/login.js"></script>
    <title>회원가입 페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/signUp.css">
</head>

<body>
    <?php
    require_once('top.php');
    ?>
    <div id="middle">
        <div id="signup_wrap">
            <div class="signup">Registration</div>

            <form method="post" action="">
                <span class="id_text">아이디</span>&nbsp;<span class="id_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="id" class="id"><br>
                <span class="pw_text">비밀번호</span>&nbsp;<span class="pw_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="password" name="pw" class="pw"><br>
                <span class="pw_r_text">비밀번호 확인</span>&nbsp;<span class="pw_r_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="password" name="pw_r" class="pw_r"><br>
                <span class="email_text">이메일</span>&nbsp;<span class="email_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="email" name="email" class="email"><br>
                <span class="nick_text">닉네임</span>&nbsp;<span class="nick_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="nick" class="nick"><br>
                <span class="name_text">이름</span>&nbsp;<span class="name_check">(영문 숫자 조합 20자 이하)</span><br>
                <input type="text" name="name" class="name"><br>
                <input type="submit" value="회원가입">
            </form>
        </div>
        
    </div>

    <?php
    //require_once('side.php');
    ?>
</body>

</html>
