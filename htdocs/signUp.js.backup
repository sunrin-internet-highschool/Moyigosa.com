function id_check(obj){
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    if(obj.value.length>20){
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
    
    else if(obj.value.length==0 && $(".id").focus()){
        $(".id_text").css({'color':'red'});
    }
}

function password_check(obj){
    var pw=$(".pw").val();
    var pw_r=$(".pw_r").val();
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    
    if(obj.value.length>20){
        $(".pw_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".pw").val())){
            $(".pw_text").css({'color':'red'});
        }
        else if(getCheck.test($(".pw").val())){
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
            $(".pw_r_text").css({'color':'green'});
        }
        else{
            $(".pw_r_text").css({'color':'red'});
        }
    }           
    
    if(pw_r == "" && pw_r != ""){
        $(".pw_r_text").css({'color':'red'});
    }

}
        
function email_check(obj){
    var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
    
    if(obj.value.length>20){
        $(".email_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getMail.test($(".email").val())){
            $(".email_text").css({'color':'red'});
        }
        else if(getMail.test($(".email").val())){
            $(".email_text").css({'color':'green'});
        }
    }
    else if(obj.value.length==0 && $(".email").focus()){
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
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    
    if(obj.value.length>20){
        $(".name_text").css({'color':'red'});
    }
    
    if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".name").val())){
            $(".name_text").css({'color':'red'});
        }
        else if(getCheck.test($(".name").val())){
            $(".name_text").css({'color':'green'});
        }
    }
    else if(obj.value.length==0 && $(".name").focus()){
        $(".name_text").css({'color':'red'});
    }
}

function Login(){
    var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    //var getName= RegExp(/^[가-힣]+$/);
        
    if($(".id").val() == ""){
        $(".id").focus();
        return false;
    }

    if(!getCheck.test($(".id").val())){
        $(".id").val("");
        $(".id").focus();
        return false;
    }
      
    if($(".pw").val() == ""){
        $(".pw").focus();
        return false;
    }

    if(!getCheck.test($(".pw").val())){
        $(".pw").val("");
        $(".pw").focus();
        return false;
    }
      
    if($(".pw_r").val() == ""){
        $(".pw_r").focus();
        return false;
    }
        
    if($(".pw").val() != $(".pw_r").val()){
        $(".pw_r").val("");
        $(".pw_r").focus();
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
      
    if(!getCheck.test($(".name").val())){
        $(".name").val("");
        $(".name").focus();
        return false;
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
}
 */