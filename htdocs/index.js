var bar=document.getElementsByClassName('bar');

window.onload=function(){
    for(var i=0;bar[i];i++){
        if(bar[i].offsetWidth!=0&&bar[i].offsetWidth<bar[i].offsetHeight){
            bar[i].style.width=bar[i].offsetHeight;
            console.log(bar[i].style.width+"");
        }
        console.log("checking");
    }
}
/*
var chk = true;

function resetIndex(obj){
    if(chk){
        obj.selectedIndex = -1;
    }
    chk = true;
}*/

var sub;
var big;
var small;

function SelectCh(obj){
    //chk = false;
    var selected = $("#sub option:selected").val();
    var val = $("#sub option:selected").attr('value');
    if(val != "undefined"){
        if(val == $("select[name=btype]").attr('value')){
            $("select[value="+val+"]").css("display","inline-block");
            sub = selected;
        }
    }
    
    
    
    if(selected == "과목"){
        $("select[name=btype]").css("display","none");
        $("select[name=stype]").css("display","none");
    }
}

function SelectBig(obj){
    //chk = false;
    var val = $("#bsub option:selected").attr('value');
    var selected = $("#bsub option:selected").val();
    $("select[value="+val+"]").css("display","inline-block");
    if(val != "undefined"){
        if(val == $("select[name=stype]").attr('value')){
            $("select[value="+val+"]").css("display","inline-block");
            big = selected;
        }
    }
    
    if(selected == "대분류"){
        $("select[name=stype]").css("display","none");
    }
    /*
    if(selected == "듣기"){
        $("."+$(".영어 option:selected").val()).css("display","inline-block");
        $(".읽기와 쓰기").css("display","none");
    }
    
    if(selected == "읽기와 쓰기"){
        $(".읽기와 쓰기").css("display","inline-block");
        $(".듣기").css("display","none");
    }
    
    if(selected == "대분류"){
        $(".읽기와 쓰기").css("display","none");
        $(".듣기").css("display","none");
    }*/
}

function SelectSmall(obj){
    small = $("#ssub option:selected").val();

}
/*
function a(){
    Event.preventDefault();
    alert();
    $("#btype").attr('value') = big;
    $("#stype").attr('value') = small;
    $("#subject").attr('value') = sub;
    //$("#stype").val(small);
    //$("#subject").val(sub);
    //$("#hidden").submit();
}
*/
/*$(".search_type").submit(function(event){
    event.preventDefault();
    alert("asdfas");
    
});*/

$(document).ready(function(){
    $(".type").click(function(){
        $(".search_type").css("display","block");
        $(".search_collection").css("display","none");
        $(".search_bar").animate({'left':'50%'},600);
    })
    
    $(".collection").click(function(){
        $(".search_collection").css("display","block");
        $(".search_type").css("display","none");
        $(".search_bar").animate({'left':'0'},600);
    })
    
    $(".search_type").submit(function(event){
        event.preventDefault();
        if(big!=null)
            $("#btype").val(big);
        if(small!=null)
            $("#stype").val(small);
        if(sub!=null)
            $("#subject").val(sub);
    $("#hidden").submit();
    });
    
})


