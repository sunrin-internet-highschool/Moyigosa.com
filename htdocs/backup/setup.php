<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport">
        
        <link rel= "stylesheet" type="text/css" href="/signUp.css">
        <title>
            회원가입
        </title>
        
        <script src="/signUp.js"></script>
        
        <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
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
           
            <form name="data" method="post" onsubmit="return Login()">
                <div class="login_wrap">
                    <div class="login">
                       <span id="login_title">회원가입</span>
                        <div class="frame">
                            <div class="id_wrap">
                                <span class="id">아이디 </span>
                                <span id="id_check">(영문 조합 6자 이상)</span>
                                
                                <input type="text" name="id" id="id" maxlength="12" onKeyup=id_check(this)>
                                
                                
                            </div>
                            
                            
                            
                            <div class="password_wrap">
                                <span class="password">비밀번호 </span>
                                <span id="password_check">(영문 숫자 조합 8자 이상)</span>
                                
                                <input type="password" name="password" id="password" maxlength="12" onKeyup=password_check(this) >
                                
                                
                            </div>
                            
                            
                            
                            <div class="password_confirm_wrap">
                                <span class="password_confirm">비밀번호 확인 </span>
                                <span id="password_confirm_check"></span>
                                
                                <input type="password" name="password_confirm" id="password_confirm" maxlength="12" onKeyup=password_check(this)>
                                
                            </div>
                            
                            
                            
                            <div class="mail_wrap">
                                <span class="mail">이메일</span>
                                <span id="mail_check">(형식을 지켜주세요. 예:ho@naver.com)</span>
                                
                                <input type="text" name="mail" id="mail" onKeyup=mail_check(this)>
                                
                                
                            </div>
                            
                            
                            <!--
                            <div class="name_wrap">
                                <span class="name">이름 </span>
                                <span id="name_check"></span>
                                
                                <input type="text" name="name" id="name" maxlength="12" onKeyup=name_check(this)>
                                
                            </div>
                            -->
                            
                            
                            
                            <div class="nick_wrap">
                                <span class="nick">닉네임 </span>
                                <span id="nick_check"></span>                            
                                <input type="text" name="nick" id="nick" maxlength="12">
                                
                            
                            </div>
                            
                            
                            
                            <div class="submit_wrap">
                                <input type="submit" value="회원가입">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <?php
        
if(isset($_POST['id'])&&isset($_POST['password'])&&isset($_POST['mail'])&&isset($_POST['name'])&&isset($_POST['nick'])){
        require_once ('cnn.php');
    $result = mysqli_query($conn, "SELECT id FROM users where id='".$_POST['id']."'");
    while($row = $result->fetch_assoc()) {
        $id=$row['id'];
    }
    if(empty($id)){
        mysqli_query($conn, "insert into users values('".$_POST['id']."','".$_POST['password']."','".$_POST['name']."','".$_POST['mail']."','".$_POST['nick']."')");
        mysqli_query($conn, "create table ".$_POST['id']."(num int not null, answer int,year int not null, month int not null, grade int not null,subject varchar(11) not null)");
        echo"<script>alert('회원가입이 성공적으로 끝났습니다!');self.close();</script>";
    }   
}
?>
    </body>
</html>
