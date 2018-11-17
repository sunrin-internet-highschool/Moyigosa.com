$(document).ready(function(){
                var minute=0;
                var second=0;
                var cnt_sec=0;
                var all_minute=0;
                var all_second=0;
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
                
                $(".prev").click(function(){
                    minute=0;
                    second=0;
                    cnt_sec=0;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".next").click(function(){
                    minute=0;
                    second=0;
                    cnt_sec=0;
                    $('.timer span').css({'color':'black'});
                })
                
                $(".submit").click(function(){
                    all_sec=0;
                    all_minute=0;
                })
            });