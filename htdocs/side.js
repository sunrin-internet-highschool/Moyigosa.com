$(document).ready(function(){
    $(function(){
        var bk = $("#background");
        var sh = $(".search");
        var sd = $("#side");
        $(bk).click(function(){
            $(sd).animate({'right':'-30em'},500);
            bk.fadeOut();/*css("display","none");*/
        })
           
        $(".close").click(function(){
            $(sd).animate({'right':'-30em'},500);
            bk.fadeOut();
        })
           
        $(".line").click(function(){
            $(sd).animate({'right':'0'},500);
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
        
        var chk = 0;
        $(".omr_viewer").click(function(event){
            //console.log(jQuery(this).parents('div').children('.side_omr_submit').attr('class'));
            if(jQuery(this).children('img').attr("src", "/picture/linemenu/plusicon.png") && cnt==0){
                jQuery(this).children('img').attr("src", "/picture/linemenu/minusicon.png");
                jQuery(this).parents('div').children('.side_omr_submit').slideUp(500);
                jQuery(this).parents('div').children('.omr').slideUp(500);
                jQuery(this).parents('div').children('.omr').css("display","block");
                jQuery(this).parents('div').children('.side_omr_submit').css("display","block");
                cnt++;
            }
            else if(jQuery(this).children('img').attr("src", "/picture/linemenu/minusicon.png") && cnt==1){
                jQuery(this).children('img').attr("src", "/picture/linemenu/plusicon.png");
                jQuery(this).parents('div').children('.side_omr_submit').slideDown(500);
                jQuery(this).parents('div').children('.omr').slideDown(500);
                jQuery(this).parents('div').children('.omr').css("display","none");
                jQuery(this).parents('div').children('.side_omr_submit').css("display","none");
                cnt=0;
            }
        })
        
    })
})