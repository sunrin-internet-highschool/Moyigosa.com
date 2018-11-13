<?php
require_once ('checkError.php');
session_start();
$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];
$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";
if(!isset($_SESSION['num'.$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject']][1])){
    require_once ('setup.php');
}
if(isset($_POST['submit'])){
    if(isset($_POST['answer'])){
            $_SESSION['answer'.$def][$_SESSION['questNum'.$def]]=$_POST['answer'];
            $_POST["".$_SESSION['questNum'.$def].""]=$_POST['answer'];
        }
    if(isset($_SESSION['id'])){
        $say="";
        for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
        $temp="".$i."";
        if(isset($_POST[$temp])&&!empty($_POST[$temp])){
            if(!empty($say))
                $say.=",";
            $say.="(".$temp.",".$_POST[$temp].",".$_GET['year'].",".$_GET['month'].",'".$_GET['subject']."',".$_GET['grade'].",'".$def."')";
            $_SESSION['answer'.$def][$i]=$_POST[$temp];
        }
    }
        if(isset($say)){
            $conn = mysqli_connect(
        'localhost',
        'root',
        '1234',
        'test');
            mysqli_query($conn, "delete from ".$_SESSION['id'].$select);
            mysqli_query($conn,  "insert into ".$_SESSION['id']." values".$say);
        }
    }else{
        for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
        $temp="".$i."";
        if(isset($_POST[$temp])&&!empty($_POST[$temp])){
            $_SESSION['answer'.$def][$i]=$_POST[$temp];
        }
    }
    }
    if($_POST['submit']=="이전 문제"&&$_SESSION['questNum'.$def]>1){
        $_SESSION['questNum'.$def]--;
    }else if($_POST['submit']=="다음 문제"){
        $_SESSION['questNum'.$def]++;
    }
}else if(isset($_GET['jump'])&&!empty($_GET['jump'])){
        $_SESSION['questNum'.$def]=$_GET['jump'];
    }
?>
<html>

<head>
    <title>문제페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <style>
        
        * {
            margin: 0;
            padding: 0;
        }
        a{text-decoration: none; color:slategray;}

        #title {
            width: 100%;
            background-color: slategray;
            font-size: 4em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            text-align: center;
        }
        
        
        #All{
            width: 100%;
        }
        
        #All_left{
            width: 70%;
            height: 1500px;
            background-color: green;
            float: left;
        }
        
        #All_right{
            width: 30%;
            height: 1500px;
            background-color: orange;
            float: right;
        }
        
        #quest{
            width:710px;
            height:auto;
            border:1px solid black;
            overflow:hidden;
            word-wrap: break-word;
        }
        
        .wrap{
            width: 710px;
            margin: 0;           
        }
        
        .text_wrap{
            width: 550px;
            padding: 80px;
            position:relative;
        }
        
        .wrap .btn{
            width:710px;
            position: absolute;
        }
                
        .prev{
            float:left;
        }
        .next{
            float:right;
        }

    </style>
    
    
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script language="javascript">
            $(document).ready(function(){
                var minute=0;
                var second=0;
                var cnt_sec=0;
                $(".countTimeMinute").html(minute);
                $(".countTimeSecond").html(second);
                
                var timer = setInterval(countTime,1000);
                
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
            });
                                    
        </script>
</head>

<body>
    <form action="" method="post">
        <div id="title">
            <?php
            echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['subject']," 모의고사";
        ?>
        </div>
        <div id="body">
            <?php
        
        ?>
            <div id ="All">
            <div id="All_left">
            <div id="quest">
                <?php
                echo "<div class=\"wrap\">";                           
                echo "<div class=\"text_wrap\">";
                echo $_SESSION['questNum'.$def],"번 문제","<br>";
                echo $_SESSION['question'.$def][$_SESSION['questNum'.$def]],"<br>";
            $picture=$_SESSION['picture'.$def][$_SESSION['questNum'.$def]];
            $example=$_SESSION['example'.$def][$_SESSION['questNum'.$def]];
            $sound=$_SESSION['sound'.$def][$_SESSION['questNum'.$def]];
                if(!empty($picture)&&$picture!=""&&$picture!=" "){
                    echo "<img src=\"",$picture,"\">";
                }
                if(!empty($example)&&$example!=""&&$example!=" "){
                    echo $example;
                }
                if(!empty($sound)&&$sound!=""&&$sound!=" "){
                    echo "<audio src=\"$sound\" controls=\"controls\"></audio>";
                }
            for($i=1;$i<=5;$i++){
                if(isset($_SESSION['answer'.$def][$_SESSION['questNum'.$def]])&&$_SESSION['answer'.$def][$_SESSION['questNum'.$def]]==$i){
                    echo "<input type=\"radio\" name=\"answer\" value=\"$i\" checked=\"checked\" id=\"$i\"> <label for=\"$i\">",$_SESSION['select'.$i.$def][$_SESSION['questNum'.$def]],"</label><br>";
                }else{
                    echo "<input type=\"radio\" name=\"answer\" value=\"$i\" id=\"$i\"> <label for=\"$i\">",$_SESSION['select'.$i.$def][$_SESSION['questNum'.$def]],"</label><br>";
                }
                
            }
                echo "</div>";
                echo "<div class=\"btn\"><div class=\"prev\"><input type=\"submit\" value=\"이전 문제\" name=\"submit\"></div>";
                echo "<div class=\"next\"><input type=\"submit\" value=\"다음 문제\" name=\"submit\"></div></div>";
                    
                
                
                echo "</div>";
                
            ?>
            </div>
            </div>
            
            <div id="All_right">
                <div class="omr">
                   <div class="timer">
                       <span class="countTimeMinute">00</span> :
                       <span class="countTimeSecond">00</span> 
                   </div>
                   
                   <div class="alltimer">
                       <span class="allTimeMinute">00</span> :
                       <span class="allTimeSecond">00</span> 
                   </div>
                    <?php
                    for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
                        echo "<a href=\"/solve.php/?grade=".$_GET['grade']."&year=".$_GET['year']."&month=".$_GET['month']."&subject=".$_GET['subject']."&jump=",$_SESSION['num'.$def][$i],"\" target=\"_self\">";
                        if($_SESSION['num'.$def][$i]<10)
                                echo "0".$_SESSION['num'.$def][$i].".";
                            else
                                echo $_SESSION['num'.$def][$i].".";
                            echo "</a>";
                            for($j=1;$j<6;$j++){
                                if(isset($_SESSION['answer'.$def][$i])){
                                    $defualt=$_SESSION['answer'.$def][$i];
                                }else{
                                    $defualt=0;
                                }
                                if($j==$defualt){
                                    echo "<input type=\"radio\" name=\"".$_SESSION['num'.$def][$i]."\" value=\"$j\" checked=\"checked\">";
                                }else{
                                    echo "<input type=\"radio\" name=\"".$_SESSION['num'.$def][$i]."\" value=\"$j\">";
                                }
                                
                            }
                        echo "정답 :".$_SESSION['correct'.$def][$i];
                        echo "<br>";
                        }
                    ?>
                    
                    <input type="submit" value="제출" name="submit" class="submit">
                </div>
            </div>
        </div>
        </div>
    </form>
</body>

</html>
