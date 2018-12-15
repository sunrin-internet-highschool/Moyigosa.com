        function id_check(obj){
            var getCheck= RegExp(/^[a-zA-Z0-9]{6,12}$/);
            
            if(obj.value.length>0 && obj.value.length<=5){
                $("#id_check").css({'color':'red'});
            }
            if(obj.value.length>=6){
                if(!getCheck.test($("#id").val())){
                    $("#id_check").css({'color':'red'});
                }
            }
            if(getCheck.test($("#id").val())){
                $("#id_check").css({'color':'green'});
            }

        }
        
        function password_check(obj){
            var pw=$("#password").val();
            var pwc=$("#password_confirm").val();
            
            var getCheck= RegExp(/^[a-zA-Z0-9]{8,12}$/);
            if(obj.value.length>0 && obj.value.length<=7){
                $("#password_check").css({'color':'red'});
            }
            if(obj.value.length>=8){
                if(!getCheck.test($("#password").val())){
                    $("#password_check").css({'color':'red'});
                }
            }
            
            if(pw == "" && pwc != ""){
                $("#password_confirm_check").html("비밀번호를 먼저 입력해 주십시오.");
                $("#password_confirm_check").css({'color':'red'});
            }
            
            if(pw != "" && pwc != ""){
                if(pw==pwc){
                    $("#password_confirm_check").html("");
                    $("#password_confirm_check").css({'color':'green'});
                }
                else{
                    $("#password_confirm_check").html("다시 한번 확인해주세요.");
                    $("#password_confirm_check").css({'color':'red'});
                }
            }
            
            if(getCheck.test($("#password").val())){
                $("#password_check").css({'color':'green'});
            }
            

        }
        
        function mail_check(obj){
            var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            if(obj.value.length>0){
                if(!getMail.test($("#mail").val())){
                    $("#mail_check").css({'color':'red'});
                }
            }
            
            if(getMail.test($("#mail").val())){
                $("#mail_check").css({'color':'green'});
            }

        }
        /*
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
        }*/
        /*
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
        */
        
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
    /*
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
    */  
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
