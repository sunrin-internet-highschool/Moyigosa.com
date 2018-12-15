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
        }else{
            $alert='아이디 또는 암호가 올바르지 않습니다.';
        }
    }
?>
<html>
    <head>
        <script src="/login.js"></script>
        <title>로그인 페이지</title>
        
    </head>
    <body>
        <?php
            echo $alert;
        ?>
        <form method="post" action="">
            <span class="id"></span>
            <input type="text" name="id" value="id" class="id" >
            <span class="pw"></span>
            <input type="password" name="pw" value="password" class="pw">
            <input type="submit" value="로그인">
        </form>
    </body>
</html>