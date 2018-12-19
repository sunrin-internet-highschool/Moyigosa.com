<?php
session_start();
require_once ('cnn.php');
$i=0;
$sql = "SELECT distinct year FROM list";
$result = mysqli_query($conn, $sql);
while($row = $result->fetch_assoc()) {
    $s_year[$i]=$row["year"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct grade FROM list");
while($row = $result->fetch_assoc()) {
    $s_grade[$i]=$row["grade"];
    $i++;
}
$i=0;
$result = mysqli_query($conn, "SELECT distinct month FROM list");
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
        $s_btype[$s_subject[$i]][$i1]=$row1["bigtype"];\
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
    <link rel="stylesheet" type="text/css" href="/index.css">
    <script src="/index.js"></script>
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
        <div class="search_option">
                <div class="collection">문제집별</div>
                <div class="type">분류별</div>
                <div class="search_bar"></div>
        </div>
        <div class="search_collection">
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
        <div class="search_type">
            <form action="" method="get">
                <select name="subject">
                    <option>과목</option>
                    <?php
                    for($i=0;!empty($s_subject[$i]);$i++){
                        echo "<option value=\"",$s_subject[$i],"\">",$s_subject[$i],"</option>";
                    }
                    ?>
                </select><br>
                <?php
                for($i=0;!empty($s_subject[$i]);$i++){
                    echo "<select name=\"s_btype\">";
                    echo "<option>대분류</option>";
                    for($i1=0;!empty($s_btype[$s_subject[$i]][$i1]);$i1++){
                        echo "<option value=\"",$s_btype[$s_subject[$i]][$i1],"\">",$s_btype[$s_subject[$i]][$i1],"</option>";
                    }
                    echo "</select><br>";
                }
                for($i=0;!empty($s_subject[$i]);$i++){
                    for($i1=0;!empty($s_btype[$s_subject[$i]][$i1]);$i1++){
                    echo "<select name=\"s_stype\">";
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
        while($row = $result->fetch_assoc()) {
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
        ?>
    </div>
</body>

</html>
