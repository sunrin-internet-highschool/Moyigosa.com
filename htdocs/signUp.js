var id = false;
var pw_b = false;
var pw_r_b = false;
var email = false;
var name = false;
var nick = false;

function id_check(obj){
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    if(obj.value.length>20){
        id=false;
        $(".id_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".id").val())){
            id=false;
            $(".id_text").css({'color':'red'});
        }
        else if(getCheck.test($(".id").val())){
            $(".id_text").css({'color':'green'});
            id=true;  
        }
    }
    
    else if(obj.value.length==0 && $(".id").focus()){
        id=false;
        $(".id_text").css({'color':'red'});
    }
}

function password_check(obj){
    var pw=$(".pw").val();
    var pw_r=$(".pw_r").val();
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    
    if(obj.value.length>20){
        pw_b=false;
        $(".pw_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".pw").val())){
            pw_b=false;
            $(".pw_text").css({'color':'red'});
        }
        else if(getCheck.test($(".pw").val())){
            pw_b=true;
            $(".pw_text").css({'color':'green'});
        }
    }
    else if(pw == "" && $(".pw").focus()){
        pw_r_b=false;
        $(".pw_text").css({'color':'red'});
    }
    
    else if(pw_r == ""){
        pw_r_b=false;
        $(".pw_r_text").css({'color':'red'});
    }
    
    if(pw == "" && pw_r != ""){
        pw_r_b=false;
        $(".pw_r_text").css({'color':'red'});   
    }
    
    if(pw != "" && pw_r != ""){
        if(pw==pw_r){
            pw_r_b=true;
            $(".pw_r_text").css({'color':'green'});
        }
        else{
            pw_r_b=false;
            $(".pw_r_text").css({'color':'red'});
        }
    }           
    
    if(pw_r == "" && pw_r != ""){
        pw_r_b=false;
        $(".pw_r_text").css({'color':'red'});
    }

}
        
function email_check(obj){
    var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
    
    if(obj.value.length>20){
        email=false;
        $(".email_text").css({'color':'red'});
    }
    
    else if(obj.value.length>0 && obj.value.length<=20){
        if(!getMail.test($(".email").val())){
            email=false;
            $(".email_text").css({'color':'red'});
        }
        else if(getMail.test($(".email").val())){
            $(".email_text").css({'color':'green'});
            email=true;
        }
    }
    else if(obj.value.length==0 && $(".email").focus()){
        email=false;
        $(".email_text").css({'color':'red'});
    }
}
        
 function nick_check(obj){
     var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
     
     if(obj.value.length>20){
         nick=false;
         $(".nick_text").css({'color':'red'});
     }
            
     if(obj.value.length>0 && obj.value.length<=20){
         if(!getCheck.test($(".nick").val())){
             nick=false;
             $(".nick_text").css({'color':'red'});
         }
         else if(getCheck.test($(".nick").val())){
             nick=true;
             $(".nick_text").css({'color':'green'});
         }       
     }
     else if(obj.value.length==0 && $(".nick").focus()){
         nick=false;
        $(".nick_text").css({'color':'red'});
     }
}
        
function name_check(obj){
    var getCheck= RegExp(/^[a-zA-Z0-9]{1,20}$/);
    
    if(obj.value.length>20){
        name=false;
        $(".name_text").css({'color':'red'});
    }
    
    if(obj.value.length>0 && obj.value.length<=20){
        if(!getCheck.test($(".name").val())){
            $(".name_text").css({'color':'red'});
            name=false;
        }
        else if(getCheck.test($(".name").val())){
            $(".name_text").css({'color':'green'});
            name=true;
        }
    }
    else if(obj.value.length==0 && $(".name").focus()){
        $(".name_text").css({'color':'red'});
        name=false;
    }
}
//email(false) , pw_b(true), name(true), nick(false)
function confirm(){
    alert($(".email_text").attr("style"));
    if($(".email_text").attr("style")=="color: green;" && $(".id_text").attr("style")=="color: green;" && $(".pw_text").attr("style")=="color: green;" && $(".pw_r_text").attr("style")=="color: green;" && $(".nick_text").attr("style")=="color: green;" && $(".name_text").attr("style")=="color: green;"){
        alert("jo");
    }
    else{
        alert("f");
        var not = document.getElementById("submit");
        not.disabled = "disabled";
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