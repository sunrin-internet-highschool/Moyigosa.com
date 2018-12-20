<?php
session_start();
require_once ('cnn.php');
$i=0;
$sql = "SELECT distinct year FROM list order by year";
$result = mysqli_query($conn, $sql);
while($row = $result->fetch_assoc()) {
    $s_year[$i]=$row["year"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct grade FROM list order by grade");
while($row = $result->fetch_assoc()) {
    $s_grade[$i]=$row["grade"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct month FROM list order by month");
while($row = $result->fetch_assoc()) {
    $s_month[$i]=$row["month"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct num FROM list");
while($row = $result->fetch_assoc()) {
    $s_num[$i]=$row["num"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct subject FROM list");
while($row = $result->fetch_assoc()){
    $s_subject[$i]=$row["subject"];
    $i1=0;
    $result1 = mysqli_query($conn, "SELECT distinct bigtype FROM list where subject='".$s_subject[$i]."'");
    while($row1 = $result1->fetch_assoc()){
        $s_btype[$s_subject[$i]][$i1]=$row1["bigtype"];
        $i11=0;
        $result11 = mysqli_query($conn, "SELECT distinct smalltype FROM list where bigtype='".$s_btype[$s_subject[$i]][$i1]."'");
        while($row11 = $result11->fetch_assoc()){
            $s_stype[$s_subject[$i]][$s_btype[$s_subject[$i]][$i1]][$i11]=$row11["smalltype"];
            $i11++;
        }
        $i1++;
    }
    $i++;
}
?>
<html>

<head>
    <title>
        모의고사
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <meta name="viewport" content="width=350px, initial-scale=0.5">
    <link rel="stylesheet" type="text/css" href="/index.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/index.js"></script>
    
<link rel="shortcut icon" href="/picture/ico/icon_5_fsa_icon.ico">
</head>

<body>
    <?php
    require_once('top.php');
    require_once('side.php');
    ?>
    <div id="middle">
        <div class="search_button">
            <span>검색조건</span>
            <img src="/picture/main/down.png" width="49px" height="28px">
        </div>
        <div class="search_option" style="display:none">
                <div class="collection">문제집별</div>
                <div class="type">분류별</div>
                <div class="search_bar"></div>
        </div>
        <div class="search_collection" style="display:none">
            <form action="" method="get">
                <select name="grade">
                    <option>학년</option>
                    <?php
                    for($i=0;!empty($s_grade[$i]);$i++){
                        echo "<option value=\"",$s_grade[$i],"\">",$s_grade[$i],"학년</option>";
                    }
                    ?>
                </select>
                <select name="year">
                    <option>년도</option>
                    <?php for($i=0;!empty($s_year[$i]);$i++){
                        echo "<option value=\"",$s_year[$i],"\">",$s_year[$i],"년</option>";
                    }
                ?>

                </select>
                <select name="month">
                    <option>월</option>
                    <?php for($i=0;!empty($s_month[$i]);$i++){
                        echo "<option value=\"",$s_month[$i],"\">",$s_month[$i],"월</option>";
                    }
                ?>
                </select>
                <select name="subject">
                    <option>과목</option>
                    <?php for($i=0;!empty($s_subject[$i]);$i++){
                        echo "<option value=\"",$s_subject[$i],"\">",$s_subject[$i],"</option>";
                    }
                ?>
                </select><br>
                <input type="submit" value="검색" class="submit">
            </form>
        </div>
        <div class="search_type" style="display:none;">
            <form action="" method="get">
                <select name="subject" id="sub" onchange="SelectCh(this)" onclick="resetIndex(this)" class="type_subject">
                    <option>과목</option>
                    <?php
                    for($i=0;!empty($s_subject[$i]);$i++){
                        echo "<option value=\"",$s_subject[$i],"\">",$s_subject[$i],"</option>";
                    }
                    ?>
                </select><br>
                <?php
                for($i=0;!empty($s_subject[$i]);$i++){
                    echo "<select name=\"btype\" id=\"bsub\" value=\"".$s_subject[$i]."\" style=\"display:none\" onchange=\"SelectBig(this)\" onclick=\"resetIndex(this)\" class=\"type_btype\">";
                    echo "<option>대분류</option>";
                    for($i1=0;!empty($s_btype[$s_subject[$i]][$i1]);$i1++){
                        echo "<option value=\"",$s_btype[$s_subject[$i]][$i1],"\" >",$s_btype[$s_subject[$i]][$i1],"</option>";
                    }
                    echo "</select><br>";
                }
                for($i=0;!empty($s_subject[$i]);$i++){
                    for($i1=0;!empty($s_btype[$s_subject[$i]][$i1]);$i1++){
                    echo "<select name=\"stype\" id=\"ssub\" style=\"display: none\" value=\"".$s_btype[$s_subject[$i]][$i1]."\" onchange=\"SelectSmall(this)\" onclick=\"resetIndex(this)\" class=\"type_stype\">";
                    echo "<option>소분류</option>";
                        for($i11=0;!empty($s_stype[$s_subject[$i]][$s_btype[$s_subject[$i]][$i1]][$i11]);$i11++){
                            echo "<option value=\"",$s_stype[$s_subject[$i]][$s_btype[$s_subject[$i]][$i1]][$i11],"\">",$s_stype[$s_subject[$i]][$s_btype[$s_subject[$i]][$i1]][$i11],"</option>";
                        }
                    echo "</select><br>";
                    }
                }
                ?>
                <input type="submit" value="검색" class="submit">
            </form>
        </div>
    </div>
    <div id="bottom">
        <?php
        if(!isset($_GET['stype'])&&!isset($_GET['btype'])){
            
        require_once('cnn.php');
            $say=null;
        if(isset($_GET['year'])&&"년도"!=$_GET['year']){
            $say="&&year=".$_GET['year'];
        }
        if(isset($_GET['month'])&&"월"!=$_GET['month']){
            $say.="&&month=".$_GET['month'];
        }
        if(isset($_GET['grade'])&&"학년"!=$_GET['grade']){
            $say.="&&grade=".$_GET['grade'];
        }
        if(isset($_GET['subject'])&&"과목"!=$_GET['subject']){
            $say.="&&subject=\"".$_GET['subject']."\"";
        }
        $result = mysqli_query($conn, ("select distinct year,month,grade,subject from list where year is not null ".$say));
            $temp=true;
        while($row = $result->fetch_assoc()) {
            $temp=false;
            $count=0;
            $per=0;
            $year=$row['year'];
            $month=$row['month'];
            $grade=$row['grade'];
            $subject=$row['subject'];
            $def=$year.$month.$grade.$subject;
                    
            $result2 = mysqli_query($conn,"select count(num) from list where year=$year and month=$month and grade=$grade and subject='$subject'");
            while($row2 = $result2->fetch_assoc()) {
                $maxNum=$row2['count(num)'];
            }
                    
            for($i=1;$i<=$maxNum;$i++){
                if(isset($_SESSION[$def]['answer'][$i])&&$_SESSION[$def]['answer'][$i]>=1&&$_SESSION[$def]['answer'][$i]<=5){
                    $count++;
                }
            }
                    
            if(isset($_SESSION['id'])){
                $result3 = mysqli_query($conn,"select count(answer) from ".$_SESSION['id']." where year=$year and month=$month and grade=$grade and subject='$subject'");
                while($row3 = $result3->fetch_assoc()) {
                    $count=$row3['count(answer)'];
                }
            }
            
            if($count){
                $per=$count/$maxNum*100;
            }
            echo "<a href=\"/solve.php/?grade=$grade&year=$year&month=$month&subject=$subject&jump=1\" target=\"_self\" class=\"href\">";
            echo "<div class=\"element\">";
            echo "<span>";
            echo $year,"년 ",$month,"월 ",$grade,"학년 ",$subject;
            echo "</span>";
            echo "<div id=\"bar\">";
            echo "$count/$maxNum","&nbsp;<div class=\"background\"><div class=\"bar\" style=\"width:",$per,"%;\"></div></div>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }
            
        }else{
            
        require_once('cnn.php');
        $say=null;
        if(isset($_GET['btype'])&&"대분류"!=$_GET['btype']){
            $say.="&&bigtype=\"".$_GET['btype']."\"";
        }
        if(isset($_GET['stype'])&&"소분류"!=$_GET['stype']){
            $say.="&&smalltype=\"".$_GET['stype']."\"";
        }
        if(isset($_GET['subject'])&&"과목"!=$_GET['subject']){
            $say.="&&subject=\"".$_GET['subject']."\"";
        }
        $result = mysqli_query($conn, ("select distinct subject, bigtype, smalltype from list where year is not null ".$say));
        $temp=true;
        while($row = $result->fetch_assoc()) {
            $temp=false;
            $count=0;
            $per=0;
            $stype=$row['smalltype'];
            $btype=$row['bigtype'];
            $subject=$row['subject'];
            $def=$subject.$btype.$stype;
                    
            $result2 = mysqli_query($conn,"select count(num) from list where subject='$subject' and bigtype='$btype' and smalltype='$stype'");
            while($row2 = $result2->fetch_assoc()) {
                $maxNum=$row2['count(num)'];
            }
                    
            for($i=1;$i<=$maxNum;$i++){
                if(isset($_SESSION[$def]['answer'][$i])&&$_SESSION[$def]['answer'][$i]>=1&&$_SESSION[$def]['answer'][$i]<=5){
                    $count++;
                }
            }
                    
            if(isset($_SESSION['id'])){
                $result3 = mysqli_query($conn,"select count(answer) from ".$_SESSION['id']." where subject='$subject' and bigtype='$btype' and smalltype='$stype'");
                while($row3 = $result3->fetch_assoc()) {
                    $count=$row3['count(answer)'];
                }
            }
            
            if($count){
                $per=$count/$maxNum*100;
            }
            echo "<a href=\"/solve.php/?btype=$btype&stype=$stype&subject=$subject&jump=1\" target=\"_self\" class=\"href\">";
            echo "<div class=\"element\">";
            echo "<span>";
            echo $subject," ",$btype," ",$stype;
            echo "</span>";
            echo "<div id=\"bar\">";
            echo "$count/$maxNum","&nbsp;<div class=\"background\"><div class=\"bar\" style=\"width:",$per,"%;\"></div></div>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }
            
        }
        if($temp){
                echo "<div class=\"element_none\">";
                echo "아무것도 없습니다!";
                echo "</div>";
            }
        ?>
    </div>
    <form method="get" action="" id="hidden">
        <input type="hidden" id="btype" value="대분류" name="btype">
        <input type="hidden" id="stype" value="소분류" name="stype">
        <input type="hidden" id="subject" value="과목" name="subject">
    </form>
</body>

</html>
