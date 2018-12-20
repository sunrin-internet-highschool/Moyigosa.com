$(document).ready(function(){
    $(function(){
        var bk = $("#background");
        var trs = $("#trashcan");
        var sho = $(".search_option");
        var shc = $(".search_collection");
        var sht = $(".search_type");
        var sd = $("#side");
        var trv = 1;
        $("#trashcan").click(function(){
            if(trv==1){
                $(".omr").slideUp();
                $(".side_omr_submit").slideUp();
                $(".side_omr_submit").css("display","none");
                $(".omr_viewer img").attr("src","/picture/linemenu/plusicon.png");
                $(".omr_viewer img").css({"transform":"rotate(45deg)"});
                trv = 0;
            }
            else if(trv ==0){
                $(".omr_viewer img").css({"transform":"rotate(0deg)"});
                trv = 1;
            }
        })
        
        $(bk).click(function(){
            $(sd).animate({'right':'-30em'},500);
            $(trs).animate({'left':'-200px'},500);
            bk.fadeOut();/*css("display","none");*/
        })
           
        $(".close").click(function(){
            $(sd).animate({'right':'-30em'},500);
            $(trs).animate({'left':'-200px'},500);
            bk.fadeOut();
        })
           
        $(".line").click(function(){
            $(sd).animate({'right':'0'},500);
            $(trs).animate({'left':'20px'},500);
            bk.fadeIn();
        })
        
        
        
        
        var cnt = 0;
        $(".omr_viewer").click(function(event){
           if(trv == 1){
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
           }
            else{
                $(".delete").val(jQuery(this).children("img").attr('value'));
                $('#side_submit').submit();
               /* alert(jQuery(this).parent("div").children("a").children("span").text());
                var sub1 = jQuery(this).parent("div").children("span").text();
                sub1=sub1.split(" ");
                alert(sub1);
                alert(toString(sub1[1]));
                
                var sub2 = sub1[1].split("월 ");
                alert(sub2[1]);
                var sub3 = sub2[1].split("학년 ");
                alert(sub1[0] + sub2[0] + sub3[0]);*/
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