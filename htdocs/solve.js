
$(document).ready(function(){
    $(".solve").click(function(){
        $("#solve").css("display","block");
        $("#question").css("display","none");
        //$(".solve").css("border-bottom","10px solid #72635B").fadeIn();
        //$(".view_selection .question").css("border-bottom","none");
        $(".view_bar").animate({'left':'50%'},600);
        
    })

    $(".view_selection .question").click(function(){
        $("#question").css("display","block");
        $("#solve").css("display","none");
        //$(".view_selection .question").css("border-bottom","10px solid #72635B");
        //$(".solve").css("border-bottom","none");
        //$(".view_selection .question").fadeIn();
        $(".view_bar").animate({'left':'0'},600);
    })    
})




/*$(document).ready(function(){
        var all_minute = document.getElementById("all_minute").value;
        var all_second = document.getElementById("all_second").value;
        var minute=document.getElementById("minute").value;
        var second=document.getElementById("second").value;
        var cnt_sec=0;
                
            
                if(typeof(all_minute)==Number){
                    all_minute=0;
                }if(typeof(all_second)==Number){
                    all_second=0;
                }if(typeof(minute)!=Number){
                    minute=0;
                }if(typeof(second)!=Number){
                    second=0;
                }           
            
            

                $(".countTimeMinute").html(minute);
                $(".countTimeSecond").html(second);
                $(".allTimeMinute").html(all_minute);
                $(".allTimeSecond").html(all_second);
                
                var timer = setInterval(countTime,1000);
                var all_timer = setInterval(alltimer, 1000);
                
                function countTime(){
                    $(".countTimeMinute").html(minute);
                    $(".countTimeSecond").html(second);
                    
                    cnt_sec++;
                    second++;
                    if(second==60){
                        minute++;
                        second=0;
                    }
                    if(cnt_sec>=90){
                        $('.timer span').css({'color':'red'});
                    }
                    
                }   
                function alltimer(){
                    $(".allTimeMinute").html(all_minute);
                    $(".allTimeSecond").html(all_second);
                    all_second++;
                    if(all_second==60){
                        all_minute++;
                        all_second=0;
                    } 
                }
                
                $(".back").click(function(){
                    document.getElementById("minute").value=minute;
                    document.getElementById("all_minute").value=all_minute;
                    document.getElementById("second").value=second;
                    document.getElementById("all_second").value=all_second;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".front").click(function(){
                    document.getElementById("minute").value=minute;
                    document.getElementById("all_minute").value=all_minute;
                    document.getElementById("second").value=second;
                    document.getElementById("all_second").value=all_second;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".submit").click(function(){
                    document.getElementById("minute").value=minute;
                    document.getElementById("all_minute").value=all_minute;
                    document.getElementById("second").value=second;
                    document.getElementById("all_second").value=all_second;
                })
            
            
            
            var cnt=0;
                $("#slide_img").click(function(){
                    if(cnt==0){
                        $("#omr").animate({'right':'-17em'},1000);
                        cnt++;
                    }
                    else{
                        $("#omr").animate({'right':'0'},1000);
                        cnt=0;
                    }
                })
            
    $(".back").mouseover(function(){
        document.getElementById("move").value = '이전 문제';
    })
    $(".back").mouseout(function(){
        document.getElementById("move").value = '0';
    })
    $(".front").mouseover(function(){
        document.getElementById("move").value = '다음 문제';
    })
    $(".front").mouseout(function(){
        document.getElementById("move").value = '0';
    })

            
            });
*/