<?php
require_once ('checkError.php');
session_start();
$def=$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject'];
$select=" WHERE grade=".$_GET['grade']." AND year=".$_GET['year']." AND month=".$_GET['month']." AND subject='".$_GET['subject']."'";
if(!isset($_SESSION['num'.$_GET['year'].$_GET['month'].$_GET['grade'].$_GET['subject']][1])){
    require_once ('setup.php');
}
if(isset($_GET['submit'])){
    if(isset($_GET['answer'])){
            $_SESSION['answer'.$def][$_GET['jump']]=$_GET['answer'];
            $_GET["".$_GET['jump'].""]=$_GET['answer'];
        }
    if(isset($_SESSION['id'])){
        $say="";
        for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
        $temp="".$i."";
        if(isset($_GET[$temp])&&!empty($_GET[$temp])){
            if(!empty($say))
                $say.=",";
            $say.="(".$temp.",".$_GET[$temp].",".$_GET['year'].",".$_GET['month'].",'".$_GET['subject']."',".$_GET['grade'].",'".$def."')";
            $_SESSION['answer'.$def][$i]=$_GET[$temp];
        }
    }
        if(isset($say)){
            require_once('cnn.php');
            mysqli_query($conn, "delete from ".$_SESSION['id'].$select);
            mysqli_query($conn,  "insert into ".$_SESSION['id']." values".$say);
        }
    }else{
        for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
        $temp="".$i."";
        if(isset($_GET[$temp])&&!empty($_GET[$temp])){
            $_SESSION['answer'.$def][$i]=$_GET[$temp];
        }
    }
    }
if(isset($_GET['jump'])&&!empty($_GET['jump'])){
    if($_GET['submit']=="이전 문제"&&$_GET['jump']>1){
        $_GET['jump']--;
    }else if($_GET['submit']=="다음 문제"&&$_GET['jump']<$_SESSION['questFinal'.$def]){
        $_GET['jump']++;
    }
}
}
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/solve.css">
    <script language="javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/solve.js"></script>
    <title>문제페이지</title>
    <meta charset="UTF-8">
</head>

<body>
    <form action="" method="get">
        <?php
        echo "<input type=\"hidden\" name=\"year\" value=\"".$_GET['year']."\">";
        echo "<input type=\"hidden\" name=\"month\" value=\"".$_GET['month']."\">";
        echo "<input type=\"hidden\" name=\"grade\" value=\"".$_GET['grade']."\">";
        echo "<input type=\"hidden\" name=\"subject\" value=\"".$_GET['subject']."\">";
        echo "<input type=\"hidden\" name=\"jump\" value=\"".$_GET['jump']."\">";
        ?>
        <div id="title">
            <?php
            echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['subject']," 모의고사";
        ?>
        </div>
        <div id="body">
            <?php
        
        ?>
            <div id="All">
                <div id="All_left">
                    <div id="quest">
                        <?php
                echo "<div class=\"wrap\">";                           
                echo "<div class=\"text_wrap\">";
                
                echo "<div class=\"btn\"><div class=\"prev\"><input type=\"submit\" value=\"이전 문제\" name=\"submit\"></div>";
                echo "<div class=\"next\"><input type=\"submit\" value=\"다음 문제\" name=\"submit\"></div></div>";
                
                echo "<div class=\"text\">";
                
                
                echo "<span>",$_GET['jump'],"번 문제</span>","<br>";
                echo $_SESSION['question'.$def][$_GET['jump']],"<br>";
            $picture=$_SESSION['picture'.$def][$_GET['jump']];
            $example=$_SESSION['example'.$def][$_GET['jump']];
            $sound=$_SESSION['sound'.$def][$_GET['jump']];
                if(!empty($picture)&&$picture!=""&&$picture!=" "){
                    echo "<img src=\"",$picture,"\">";
                }
                if(!empty($example)&&$example!=""&&$example!=" "){
                    echo $example;
                }
                if(!empty($sound)&&$sound!=""&&$sound!=" "){
                    echo "<audio src=\"$sound\" controls=\"controls\"></audio>";
                }
                
                
                
                echo "<div class=\"mark\">";
            for($i=1;$i<=5;$i++){
                if(isset($_SESSION['answer'.$def][$_GET['jump']])&&$_SESSION['answer'.$def][$_GET['jump']]==$i){
                    echo "<div class=\"radio".$i."\"><input type=\"radio\" name=\"answer\" value=\"$i\" checked=\"checked\" id=\"$i\"> <label for=\"$i\">",$_SESSION['select'.$i.$def][$_GET['jump']],"</label></div><br>";
                }else{
                    echo "<div class=\"radio".$i."\"><input type=\"radio\" name=\"answer\" value=\"$i\" id=\"$i\"> <label for = \"$i\">",$_SESSION['select'.$i.$def][$_GET['jump']],"</label></div><br>";
                }
                
            }
                echo "</div>";
                echo "</div>";
                echo "</div>";               
                echo "</div>";
                
            ?>
                    </div>
                </div>

                <div id="All_right">

                    <div class="omr_form">
                        <div class="timer">

                            <span class="countTimeMinute">00</span> :
                            <span class="countTimeSecond">00</span>
                        </div>

                        <div class="alltimer">
                            <span class="allTimeMinute">00</span> :
                            <span class="allTimeSecond">00</span>
                        </div>
                        <div class="omr">

                            <?php
                        for($i=1;$i<=$_SESSION['questFinal'.$def];$i++){
                            echo "<div class=\"omr_float\">";
                            echo "<div class=\"number\"><a href=\"/solve.php/?grade=".$_GET['grade']."&year=".$_GET['year']."&month=".$_GET['month']."&subject=".$_GET['subject']."&jump=",$_SESSION['num'.$def][$i],"\" target=\"_self\">";
                            if($_SESSION['num'.$def][$i]<10)
                                    echo "0".$_SESSION['num'.$def][$i].".";
                                else
                                    echo $_SESSION['num'.$def][$i].".";
                                echo "</a></div>";
                                for($j=1;$j<6;$j++){
                                    if(isset($_SESSION['answer'.$def][$i])){
                                        $defualt=$_SESSION['answer'.$def][$i];
                                    }else{
                                        $defualt=0;
                                    }
                                    if($j==$defualt){
                                        echo "<div class=\"omr".$j."\"><input type=\"radio\" name=\"".$_SESSION['num'.$def][$i]."\" value=\"$j\" id=\"omr".$i."_".$j."\" checked=\"checked\"><label for=\"omr".$i."_".$j."\"></label></div>";
                                    }else{
                                        echo "<div class=\"omr".$j."\"><input type=\"radio\" name=\"".$_SESSION['num'.$def][$i]."\" value=\"$j\" id=\"omr".$i."_".$j."\"><label for=\"omr".$i."_".$j."\"></label></div>";
                                    }
                                    
                                }
                            echo "</div>";
                            echo "정답 :".$_SESSION['correct'.$def][$i];
                            echo "<br>";
                            }
                       
                        ?>
                        </div>

                        <div class="submit">
                            <input type="submit" value="제출" name="submit" class="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>
