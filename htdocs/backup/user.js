function id_check(obj){
            var getCheck= RegExp(/^[a-zA-Z0-9]{6,12}$/);
            
            if(obj.value.length>0 && obj.value.length<=5){
                $("#id_check").html("(일치하지 않습니다.)");
                $("#id_check").css({'color':'red'});
            }
            if(obj.value.length>=6){
                if(!getCheck.test($("#id").val())){
                    $("#id_check").html("(일치하지 않습니다.)");
                    $("#id_check").css({'color':'red'});
                }
            }
            if(getCheck.test($("#id").val())){
                $("#id_check").html("");
                $("#id_check").css({'color':'green'});
            }

        }
        
        function password_check(obj){
            var pw=$("#pw").val();
            var pwc=$("#npw").val();
            
            var getCheck= RegExp(/^[a-zA-Z0-9]{8,12}$/);
            if(obj.value.length>0 && obj.value.length<=7){
                $("#pw_check").html("(일치하지 않습니다.)");
                $("#pw_check").css({'color':'red'});
            }
            if(obj.value.length>=8){
                if(!getCheck.test($("#pw").val())){
                    $("#pw_check").html("(일치하지 않습니다.)");
                    $("#pw_check").css({'color':'red'});
                }
            }
            
            if(pw == "" && pwc != ""){
                $("#npw_check").html("비밀번호를 먼저 입력해 주십시오.");
                $("#npw_check").css({'color':'red'});
            }
            
            if(pw != "" && pwc != ""){
                if(pw==pwc){
                    $("#npw_check").html("");
                    $("#npw_check").css({'color':'green'});
                }
                else{
                    $("#npw_check").html("다시 한번 확인해주세요.");
                    $("#npw_check").css({'color':'red'});
                }
            }
            
            if(getCheck.test($("#pw").val())){
                $("#pw_check").html("");
                $("#pw_check").css({'color':'green'});
            }
            

        }
        
        function mail_check(obj){
            var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            if(obj.value.length>0){
                if(!getMail.test($("#email").val())){
                    $("#mail_check").css({'color':'red'});
                }
            }
            
            if(getMail.test($("#email").val())){
                $("#mail_check").css({'color':'green'});
            }

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

      
      if($("#pw").val() == ""){
        alert("패스워드를 입력해 주십시오");
        $("#pw").focus();
        return false;
      }

      if(!getCheck.test($("#pw").val())){
        alert("패스워드를 형식에 맞게 입력해 주십시오");
        $("#pw").val("");
        $("#pw").focus();
        return false;
      }
      
      if($("#npw").val() == ""){
        alert("패스워드 확인을 입력해 주십시오");
        $("#pw").focus();
        return false;
      }
        
      if($("#pw").val() != $("#npw").val()){
        alert("패스워드와 다릅니다.");
        $("#npw").val("");
        $("#npw").focus();
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
