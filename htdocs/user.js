        function id_check(obj) {
            var getCheck = new RegExp(/^[a-zA-Z0-9]{4,12}$/);
            
            if(obj.value.length > 0 && obj.value.length <= 3){
                $("#id_check").html("아이디를 4자리 이상으로 입력해 주십시오.");
                $(".id").css({'color' : 'red'});
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

        }
        
        function password_check(obj){
            var pw = $("#npw").val();
            var pwc = $("#npw_re").val();
            var ori_pw = $("#pw").val();
            
            var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
            
            if(ori_pw.length>0 && ori_pw.length<=3){
                $("#pw_check").html("비밀번호를 4자리 이상으로 입력해 주십시오.");
                $(".pw").css({'color':'red'});
            }
            if(ori_pw.length>=4){
                if(!getCheck.test($("#pw").val())){
                    $("#pw_check").html("비밀번호는 영어 대소문자 혹은 숫자로만 이루어져야 합니다.");
                    $(".pw").css({'color':'red'});
                }
            }
            
            if(pw.length>0 && pw.length<=3){
                $("#npw_check").html("비밀번호를 4자리 이상으로 입력해 주십시오.");
                $(".npw").css({'color':'red'});
            }
            if(pw.length>=4){
                if(!getCheck.test($("#npw").val())){
                    $("#npw_check").html("비밀번호는 영어 대소문자 혹은 숫자로만 이루어져야 합니다.");
                    $(".npw").css({'color':'red'});
                }
            }
            
            if(pw == "" && pwc != ""){
                $("#password_confirm_check").html("비밀번호를 먼저 입력해 주십시오.");
                $(".password_confirm").css({'color':'red'});
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
            
            if(getCheck.test($("#npw").val())){
                $("#npw_check").html("");
                $(".npw").css({'color':'green'});
            }
            
            if(getCheck.test($("#pw").val())){
                $("#pw_check").html("");
                $(".pw").css({'color':'green'});
            }
            

        }
        
        function mail_check(obj){
            var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            if(obj.value.length>0){
                if(!getMail.test($("#email").val())){
                    $("#mail_check").html("mail형식에 맞게 입력해주십시오.");
                    $(".mail").css({'color':'red'});
                }
            }
            
            if(getMail.test($("#email").val())){
                $("#mail_check").html("");
                $(".mail").css({'color':'green'});
            }

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
            

        }
        
        function Login(){
            var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
            var getName= RegExp(/^[가-힣]+$/);
        
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

      
      if($("#npw").val() == ""){
        alert("새로운 패스워드를 입력해 주십시오");
        $("#npw").focus();
        return false;
      }

      if(!getCheck.test($("#npw").val())){
        alert("새로운 패스워드를 형식에 맞게 입력해 주십시오");
        $("#npw").val("");
        $("#npw").focus();
        return false;
      }
      
      if($("#npw_re").val() == ""){
        alert("패스워드 확인을 입력해 주십시오");
        $("#npw_re").focus();
        return false;
      }
        
      if($("#npw").val() != $("#npw_re").val()){
        alert("새로운 패스워드와 일치하지 않습니다");
        $("#npw_re").val("");
        $("#npw_re").focus();
        return false;
      }

      if($("#email").val() == ""){
        alert("이메일을 입력해 주십시오");
        $("#email").focus();
        return false;
      }

      if(!getMail.test($("#email").val())){
        alert("이메일을 형식에 맞게 입력해 주십시오")
        $("#email").val("");
        $("#email").focus();
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