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
    <form method="post" target="_self">
    <?php
        echo $_SESSION['nick']."님의 회원정보";
        echo "아이디: <input type=\"text\" name=\"id\" value=\"".$_SESSION['id']."\">";
        echo "현재 비밀번호: <input type=\"password\" name=\"pw\">";
        echo "새로운 비밀번호: <input type=\"password\" name=\"npw\">";
        echo "비밀번호 확인: <input type=\"password\" name=\"npw_re\">";
        echo "이름: <input type=\"text\" name=\"name\" value=\"".$_SESSION['name']."\">";
        echo "이메일: <input type=\"text\" name=\"email\" value=\"".$_SESSION['email']."\">";
        echo "닉네임: <input type=\"text\" name=\"nick\" value=\"".$_SESSION['nick']."\">";
        echo "<input type=\"submit\" name=\"change\" value=\"수정\">";
    ?>
    </form>
</body>
</html>
