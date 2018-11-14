<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>
            회원가입
        </title>
        <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
        function id_check(obj){
            var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
            
            if(obj.value.length>0 && obj.value.length<=3){
                $("#id_check").html("id를 4자리 이상으로 입력해 주십시오.");
                $(".id").css({'color':'red'});
            }
            if(obj.value.length>=4){
                $("#id_check").html("");
                if(!getCheck.test($("#id").val())){
                    $("#id_check").html("id는 영어 대소문자 혹은 숫자로만 이루어져야 합니다.");
                    $(".id").css({'color':'red'});
                }
            }
            if(getCheck.test($("#id").val())){
                $("#id_check").html("");
                $(".id").css({'color':'green'});
            }
            
            $("#id").blur(function(){
                $("#id_check").html("");
            })
        }
        
        function password_check(obj){
            var pw=$("#password").val();
            var pwc=$("#password_confirm").val();
            
            var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
            if(obj.value.length>0 && obj.value.length<=3){
                $("#password_check").html("비밀번호를 4자리 이상으로 입력해 주십시오.");
                $(".password").css({'color':'red'});
            }
            if(obj.value.length>=4){
                if(!getCheck.test($("#password").val())){
                    $("#password_check").html("비밀번호는 영어 대소문자 혹은 숫자로만 이루어져야 합니다.");
                    $(".password").css({'color':'red'});
                }
            }
            
            if(pw != "" && pwc != ""){
                if(pw==pwc){
                    $("#password_confirm_check").html("");
                    $(".password_confirm").css({'color':'green'});
                }
                else{
                    $("#password_confirm_check").html("비밀번호가 다릅니다.");
                    $(".password_confirm").css({'color':'red'});
                }
            }
            
            if(getCheck.test($("#password").val())){
                $("#password_check").html("");
                $(".password").css({'color':'green'});
            }
            
            $("#password").blur(function(){
                $("#password_check").html("");
            })
        }
        
        function mail_check(obj){
            var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            if(obj.value.length>0){
                if(!getMail.test($("#mail").val())){
                    $("#mail_check").html("mail형식에 맞게 입력해주십시오.");
                    $(".mail").css({'color':'red'});
                }
            }
            
            if(getMail.test($("#mail").val())){
                $("#mail_check").html("");
                $(".mail").css({'color':'green'});
            }
            
            $("#mail").blur(function(){
                $("#mail_check").html("");
            })
        }
        
        function name_check(obj){
            var getName= RegExp(/^[가-힣]+$/);
            
            if(obj.value.length>0){
                if(!getName.test($("#name").val())){
                    $("#name_check").html("올바른 한글로만 입력해주십시오.");
                    $(".name").css({'color':'red'});
                }
            }
            
            if(getName.test($("#name").val())){
                $("#name_check").html("");
                $(".name").css({'color':'green'});
            }
            
            $("#name").blur(function(){
                $("#name_check").html("");
            })
        }
        
        function nick_check(obj){
            var getCheck= RegExp(/^[a-zA-Z0-9]{1,12}$/);
            
            if(obj.value.length>0){
                if(!getCheck.test($("#nick").val())){
                    $("#nick_check").html("영어 대소문자와 숫자로만 입력해주십시오.");
                    $(".nick").css({'color':'red'});
                }
            }
            
            if(getCheck.test($("#nick").val())){
                $("#nick_check").html("");
                $(".nick").css({'color':'green'});
            }
            
            $("#nick").blur(function(){
                $("#nick_check").html("");
            })
        }
        
    function Login(){
      var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
      var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
      var getName= RegExp(/^[가-힣]+$/);
        
      $("#id").on('keydown', function(){
          $('h1').html(" good");
      })
        
      if($("#id").val() == ""){
        alert("아이디를 입력해 주십시오");
        $("#id").focus();
        return false;
      }

      if(!getCheck.test($("#id").val())){
        alert("아이디를 형식에 맞게 입력해 주십시오");
        $("#id").val("");
        $("#id").focus();
        return false;
      }

      
      if($("#password").val() == ""){
        alert("패스워드를 입력해 주십시오");
        $("#password").focus();
        return false;
      }

      if(!getCheck.test($("#password").val())){
        alert("패스워드를 형식에 맞게 입력해 주십시오");
        $("#password").val("");
        $("#password").focus();
        return false;
      }
      
      if($("#password_confirm").val() == ""){
        alert("패스워드 확인을 입력해 주십시오");
        $("#password").focus();
        return false;
      }
        
      if($("#password").val() != $("#password_confirm").val()){
        alert("패스워드와 다릅니다.");
        $("#password_confirm").val("");
        $("#password_confirm").focus();
        return false;
      }

      if($("#mail").val() == ""){
        alert("이메일을 입력해 주십시오");
        $("#mail").focus();
        return false;
      }

      if(!getMail.test($("#mail").val())){
        alert("이메일을 형식에 맞게 입력해 주십시오")
        $("#mail").val("");
        $("#mail").focus();
        return false;
      }

      if($("#name").val() == ""){
        alert("이름을 입력해 주십시오");
        $("#name").focus();
        return false;
      }
        
      if(!getName.test($("#name").val())){
        alert("이름을 형식에 맞게 입력해 주십시오")
        $("#name").val("");
        $("#name").focus();
        return false;
      }
      
      if($("#nick").val() == ""){
        alert("닉네임을 입력해 주십시오");
        $("#nick").focus();
        return false;
      }
       
      if(!getCheck.test($("#nick").val())){
        alert("닉네임을 형식에 맞게 입력해 주십시오")
        $("#nick").val("");
        $("#nick").focus();
        return false;
      }

  }
  
    </script>
    </head>
    
    <body>
        <form name="data" method="post" onsubmit="return Login()">
            <span class="id">아이디</span>: <input type="text" name="id" id="id" maxlength="12" onKeyup=id_check(this)>
            <br>
            <span id="id_check"></span>
            <br>
            <span class="password">비밀번호</span>: <input type="password" name="password" id="password" maxlength="12" onKeyup=password_check(this) >
            <br>
            <span id="password_check"></span>
            <br>
            <span class="password_confirm">비밀번호 확인</span>: <input type="password" name="password_confirm" id="password_confirm" maxlength="12" onKeyup=password_check(this)>
            <br>
            <span id="password_confirm_check"></span>
            <br>
            <span class="mail">이메일</span>: <input type="email" name="mail" id="mail" onKeyup=mail_check(this)>
            <br>
            <span id="mail_check"></span>
            <br>
            <span class="name">이름</span>: <input type="text" name="name" id="name" maxlength="12" onKeyup=name_check(this)>
            <br>
            <span id="name_check"></span>
            <br>
            <span class="nick">닉네임</span>: <input type="text" name="nick" id="nick" maxlength="12" onKeyup=nick_check(this)>
            <br>
            <span id="nick_check"></span>
            <p>
                <input type="submit" value="확인">
            </p>
            
        </form>
        <?php
        
if(isset($_POST['id'])&&isset($_POST['password'])&&isset($_POST['mail'])&&isset($_POST['name'])&&isset($_POST['nick'])){
        require_once ('cnn.php');
    $result = mysqli_query($conn, "SELECT id FROM users where id='".$_POST['id']."'");
    while($row = $result->fetch_assoc()) {
        $id=$row['id'];
    }
    if(empty($id)){
        mysqli_query($conn, "insert into users values('".$_POST['id']."','".$_POST['password']."','".$_POST['name']."','".$_POST['mail']."','".$_POST['nick']."')");
        mysqli_query($conn, "create table ".$_POST['id']."(num int not null, answer int,year int not null, month int not null, subject varchar(11) not null, grade int not null)");
        echo"<script>alert('회원가입이 성공적으로 끝났습니다!');self.close();</script>";
    }   
}
?>
    </body>
</html>
