$(document).ready(function(){
    $(function(){
        var bk = $("#background");
        var sh = $(".search");
        var sd = $("#side");
        $(bk).click(function(){
            $(sd).animate({'right':'-30em'},800);
            bk.css("display","none");
        })
           
        $(".close").click(function(){
            $(sd).animate({'right':'-30em'},800);
            bk.css("display","none");
        })
           
        $(".line").click(function(){
            
            $(sd).animate({'right':'0'},800);
            bk.css("display","inline-block");
        })
        
        $(".search_button").click(function(){
            sh.stop().slideToggle();
        })
    })
})