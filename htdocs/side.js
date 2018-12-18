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
        var trv = 1;
        $("#trashcan").click(function(){
            if(trv==1){
                $(".omr_viewer img").css({"transform":"rotate(45deg)"});
                trv = 0;
            }
            else if(trv ==0){
                $(".omr_viewer img").css({"transform":"rotate(90deg)"});
                trv = 1;
            }
        })
       /* 
        var sub1 = $(".side_element a span").split('년 ');
        var sub2 = sub1[1].split('월 ');
        var sub3 = sub2[1].split('학년 ');
        $(".delete").value=sub1[0]+sub2[0]+sub3[0];
        */
    })
})