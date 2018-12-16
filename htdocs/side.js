$(document).ready(function(){
    $(function(){
        var bk = $("#background");
        var sh = $(".search");
        var sd = $("#side");
        $(bk).click(function(){
            $(sd).animate({'right':'-30em'},800);
            bk.fadeOut();/*css("display","none");*/
        })
           
        $(".close").click(function(){
            $(sd).animate({'right':'-30em'},800);
            bk.fadeOut();
        })
           
        $(".line").click(function(){
            $(sd).animate({'right':'0'},800);
            bk.fadeIn();
        })
        
        var cnt = 0;
        $(".search_button").click(function(){
            if($(".search_button img").attr("src", "/picture/main/down.png") && cnt == 0){
                $(".search_button img").attr("src", "/picture/search/up.png");
                sh.slideUp();
                cnt++;
            }
            else if($(".search_button img").attr("src", "/picture/search/up.png")&&cnt == 1){
                $(".search_button img").attr("src", "/picture/main/down.png");
                sh.slideDown();
                cnt=0;
            }            
        })
        
        
    })
})