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

var temp = true;
var sort;
function resetIndex(obj){
    if(temp){
        sort = obj.value;
    }
    temp = true;
}

var sub;
var big;
var small;

function SelectCh(obj){
    temp = false;
    
    var selected = $("#sub option:selected").val();
    var val = $("#sub option:selected").attr('value');
    if(val != "undefined"){
        $("select[value="+val+"]").css("display","inline-block");
        //alert($("#bsub").attr('value'));
        //alert(val);
        sub = obj.value;
        big="대분류";
        small="소분류";
    }
    
    if(sort != val){
        $("select[value="+sort+"]").css("display","none");
        $("select[name=stype]").css("display","none");
        $("select[name=stype]").css("display","none");
    }
    
    if(selected == "과목"){
        $("select[name=btype]").css("display","none");
        $("select[name=stype]").css("display","none");
    }
}

function SelectBig(obj){
    temp = false;
    
    var selected = $("#bsub option:selected").val();
    var val = $("#bsub option:selected").attr('value');
    
    if(sort != obj.value){
        $("select[value="+obj.value+"]").css("display","inline-block");
        $("select[value="+sort+"]").css("display","none");
        big = obj.value;  
        small="소분류";
    }
}

function SelectSmall(obj){
    //small = $("#ssub option:selected").val();
    small = obj.value;
}

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
    
    var chk = 0;
    var temp=0;
    var sho = $(".search_option");
    var shc = $(".search_collection");
    var sht = $(".search_type");
    
    $(".search_button").click(function(){
        if(temp==0){
            $(".search_button img").attr("src", "/picture/search/up.png");
            shc.slideDown();
            sho.slideDown();
            sht.slideUp();
            sht.css("display","none");
            $(".search_bar").animate({'left':'0'},600);
            temp++;
        }
        
        else if(chk == 0){
            $(".search_button img").attr("src", "/picture/main/down.png");
            sho.slideUp();
            shc.slideUp();
            sht.slideUp();
            chk++;
        }
        
        else if(chk == 1){
            $(".search_button img").attr("src", "/picture/search/up.png");
            shc.slideDown();
            sho.slideDown();
            sht.slideUp();
            sht.css("display","none");
            $(".search_bar").animate({'left':'0'},600);
            chk=0;
        }          
        
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