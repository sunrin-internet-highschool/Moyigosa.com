function id_check(obj){
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    var getNumCheck= RegExp(/^[0-9]+$/);
    
    
    if(obj.value.length==0 && $(".id").focus()){
        $(".id_text").css({'color':'red'});
    }
    
    if(obj.value.length>20){
        $(".id_text").css({'color':'red'})
    }
    
    if(getNumCheck.test(obj.value[0])){
        $(".id_text").css({'color':'red'});
    }
    
    else{    
        if(!getCheck.test($(".id").val())){
            $(".id_text").css({'color':'red'});
        }
        
        else if(obj.value.length>0 && obj.value.length<=20){
            if(!getCheck.test($(".id").val())){
                $(".id_text").css({'color':'red'});
            }
            else if(getCheck.test($(".id").val())){
                $(".id_text").css({'color':'green'});  
            }
        }   
    }
}

function password_check(obj){
    var pw=$(".npw").val();
    var pw_r=$(".npw_r").val();
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    
    if(obj.value.length>20){
        $(".pw_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".npw").val())){
            $(".pw_text").css({'color':'red'});
        }
        else if(getCheck.test($(".npw").val())){
            $(".pw_text").css({'color':'green'});
        }
    }
    else if(pw.length == 0 && obj.value.length==0){
        $(".pw_text").css({'color':'red'});
    }
    
    if(pw.length == 0 && obj.value.length == 0){
        $(".pw_r_text").css({'color':'red'});
    }
    
    if(pw == "" && pw_r != ""){
        $(".pw_r_text").css({'color':'red'});   
    }
    
    if(pw != "" && pw_r != ""){
        if(pw==pw_r){
            $(".pw_r_check").html("(영문 숫자 조합 20자 이하)");
            $(".pw_r_text").css({'color':'green'});
        }
        else{
            $(".pw_r_check").html("(비밀번호와 일치하지 않습니다.)");
            $(".pw_r_text").css({'color':'red'});
        }
    }           
    
    if(pw_r == "" && pw_r != ""){
        $(".pw_r_text").css({'color':'red'});
    }

}
        
function email_check(obj){
    var getMail = RegExp(/^([\w-\.]+)@((\[[0-9]{1,20}\.[0-9]{1,20}\.[0-9]{1,20}\.)|(([\w-]+\.)+))([a-zA-Z]{1,20}|[0-9]{1,20})(\]?)$/);
    var getNumCheck= RegExp(/^[0-9]+$/);
    if(obj.value.length>20){
        $(".email_text").css({'color':'red'});
    }
    
    if(getNumCheck.test(obj.value[0])){
        $(".email_text").css({'color':'red'});
    }
    else{
        if(obj.value.length>0 && obj.value.length<=20){
            if(!getMail.test($(".email").val())){
                $(".email_text").css({'color':'red'});
            }
            else if(getMail.test($(".email").val())){
                $(".email_text").css({'color':'green'});
            }
        }
    }
    if(obj.value.length==0 && $(".email").focus()){
        $(".email_text").css({'color':'red'});
    }
}
        
 function nick_check(obj){
     var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
     
     if(obj.value.length>20){
         $(".nick_text").css({'color':'red'});
     }
            
     if(obj.value.length>0 && obj.value.length<=20){
         if(!getCheck.test($(".nick").val())){
             $(".nick_text").css({'color':'red'});
         }
         else if(getCheck.test($(".nick").val())){
             $(".nick_text").css({'color':'green'});
         }       
     }
     else if(obj.value.length==0 && $(".nick").focus()){
        $(".nick_text").css({'color':'red'});
     }
}
        
function name_check(obj){
    var getCheck= RegExp(/^[a-zA-Z]{1,20}$/);
    var getName = RegExp(/[가-힣]+$/);
    if(obj.value.length>20){
        $(".name_text").css({'color':'red'});
    }
    
    if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".name").val()) && !getName.test($(".name").val())){
            $(".name_text").css({'color':'red'});
        }
        else if(getCheck.test($(".name").val()) || getName.test($(".name").val())){
            $(".name_text").css({'color':'green'});
        }
    }
    else if(obj.value.length==0 && $(".name").focus()){
        $(".name_text").css({'color':'red'});
    }
}

function Login(){
    var getMail = RegExp(/^([\w-\.]+)@((\[[0-9]{1,20}\.[0-9]{1,20}\.[0-9]{1,20}\.)|(([\w-]+\.)+))([a-zA-Z]{1,20}|[0-9]{1,20})(\]?)$/);
    var getNumCheck = RegExp(/^[0-9]+$/);
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    var getNameCheck= RegExp(/^[a-zA-Z]{1,20}$/);
    var getName= RegExp(/^[가-힣]+$/);
    if(!getNameCheck.test($(".id").val())){
        $(".id").val("");
        $(".id").focus();
        return false;
    }
    
    if(getNumCheck.test($(".id").val())){
        $(".id").val("");
        $(".id").focus();
        return false;
    }    
    
    if(getNumCheck.test($(".id").val()[0])){
        $(".id").val("");
        $(".id").focus();
        return false;
    }
    
    if(getNumCheck.test($(".email").val()[0])){
        $(".email").val("");
        $(".email").focus();
        return false;
    }
    
    if($(".id").val() == ""){
        $(".id").focus();
        return false;
    }

    if(!getCheck.test($(".id").val())){
        $(".id").val("");
        $(".id").focus();
        return false;
    }
      
    if($(".npw").val() == ""){
        $(".npw").focus();
        return false;
    }

    if(!getCheck.test($(".npw").val())){
        $(".npw").val("");
        $(".npw").focus();
        return false;
    }
      
    if($(".npw_r").val() == ""){
        $(".npw_r").focus();
        return false;
    }
        
    if($(".npw").val() != $(".npw_r").val()){
        $(".npw_r").val("");
        $(".npw_r").focus();
        return false;
    }

    if($(".email").val() == ""){
        $(".email").focus();
        return false;
    }

    if(!getMail.test($(".email").val())){
        $(".email").val("");
        $(".email").focus();
        return false;
    }
    
    if($(".nick").val() == ""){
        $(".nick").focus();
        return false;
    }
       
    if(!getCheck.test($(".nick").val())){
        $(".nick").val("");
        $(".nick").focus();
        return false;
    }
    
    if($(".name").val() == ""){
        $(".name").focus();
        return false;
    }
      
    if(!getName.test($(".name").val()) && !getNameCheck.test($(".name").val())){
        $(".name").val("");
        $(".name").focus();
        return false;
    }
}






/*function id_check(obj){
            var getCheck= RegExp(/^[a-zA-Z0-9]{6,12}$/);
            
            if(obj.value.length>0 && obj.value.length<=20){
                $(".id_text").css({'color':'red'});
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
*/