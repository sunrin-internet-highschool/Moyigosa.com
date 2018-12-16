<?php
session_start();
$alert='';
    if(isset($_POST['id'])&&isset($_POST['pw'])){
        $_POST['id']=htmlspecialchars($_POST['id']);
        $_POST['pw']=htmlspecialchars($_POST['pw']);
        require_once('cnn.php');
        $result = mysqli_query($conn, "SELECT * from users where id='".$_POST['id']."' and password='".$_POST['id']."'");
        $temp=false;
        while($row = $result->fetch_assoc()) {
            $_SESSION['id']=$row['id'];
            $_SESSION['pw']=$row['password'];
            $_SESSION['email']=$row['email'];
            $_SESSION['name']=$row['name'];
            $_SESSION['nick']=$row['nick'];
            $temp=true;
        }
        if($temp){
            echo "<script>location.href=\"/index.php\";</script>";
        }
    }
?>
<html>

<head>
    <script src="/login.js"></script>
    <title>로그인 페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/login.css">
</head>

<body>
    <?php
    require_once('top.php');
    ?>
    <div id="middle">
        <div id="login_wrap">
            <div class="login">Log in</div>

            <form method="post" action="">
                <span class="id_text">아이디</span><br>
                <input type="text" name="id" class="id"><br>
                <span class="pw_text">비밀번호</span><br>
                <input type="password" name="pw" class="pw"><br>
                <input type="submit" value="로그인">
            </form>
            <a href="/signUp.php"><span class="signup">회원가입</span></a>
            <?php
            if(!$temp){
                //echo "<div id=\"error\"><img src=\"/picture/login/error.png\" width=\"450px\" height=\"237px\" class=\"error\"><img src=\"/picture/login/admit.png\" width=\"137px\" height=\"57px\" class=\"admit\"></div>";
            }
            ?>
        </div>
        
    </div>

    <?php
    //require_once('side.php');
    ?>
</body>

</html>
