$(document).ready(function(){
    $(function(){
        $(".admit").click(function(){
            $("#error").css("display","none");
        })
        
    })

})

/*var id = document.getElementsByClassName('id');
var pw = document.getElementsByClassName('pw');

window.onload = function () {
    //id[1].addEventListener('keyup', keyup);
    //pw[1].addEventListener('keyup', keyup);
    id[1].addEventListener('click', click);
    pw[1].addEventListener('click', click);
};

function click(){
    event.target.value=null;
}

/*

var exception = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890.";

function keyup(event) {
    var temp = [true, false];
    for (var i = 0; i < event.target.value.length; i++) {
        for (var j = 0; j < exception.length; j++) {
            if (exception.substr(j, 1) == event.target.value.substr(i, 1)) {
                temp[0] = false;
                break;
            }
        }
        if (temp[0]) {
            temp[1] = true;
            break;
        }else{
            temp[0]=true;
        }
    }
    if (temp[1]) {
        var say="죄송합니다. 글자(a-z), 숫자(0-9) 및 마침표(.)만 입력할 수 있습니다.";
    }else{
        var say="정상입니다";
    }
    if (event.target == id[1]) {
            id[0].innerHTML = say;
        } else if (event.target == pw[1]) {
            pw[0].innerHTML = say;
        }
}
*/