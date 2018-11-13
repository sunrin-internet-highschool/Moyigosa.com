<?php
session_start();
$conn = mysqli_connect(
    'localhost',
    'root',
    'apmsetup',
    'test');
if(isset($_GET['year'])&&isset($_GET['grade'])&&isset($_GET['month'])&&isset($_GET['subject'])){
    $_SESSION['year']=$_GET['year'];
    $_SESSION['grade']=$_GET['grade'];
    $_SESSION['month']=$_GET['month'];
    $_SESSION['subject']=$_GET['subject'];
    if(!isset($_SESSION['questNum'])){
        $_SESSION['questNum']=1;
    }
        $result = mysqli_query($conn, "SELECT count(num) FROM list WHERE grade=".$_SESSION['grade']." AND year=".$_SESSION['year']." AND month=".$_SESSION['month']." AND subject='".$_SESSION['subject']."'");
    while($row = $result->fetch_assoc()) {
        $_SESSION['questFinal']=$row['count(num)'];
    }
}
if(isset($_POST['submit'])){
    for($i=1;$i<=$_SESSION['questFinal'];$i++){
        $temp="".$i."";
        if(isset($_POST[$temp])&&!empty($_POST[$temp])){
            
        mysqli_query($conn, "delete from ".$_SESSION['id']." where year=".$_SESSION['year']." && month=".$_SESSION['month']." && grade=".$_SESSION['grade']." && subject='".$_SESSION['subject']."'"."&&num=".$temp);
        mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$temp.",".$_POST[$temp].",".$_SESSION['year'].",".$_SESSION['month'].",'".$_SESSION['subject']."',".$_SESSION['grade'].")");
        }
    }
}
if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    if(isset($_POST['answer'])){
        mysqli_query($conn, "delete from ".$_SESSION['id']." where year=".$_SESSION['year']." && month=".$_SESSION['month']." && grade=".$_SESSION['grade']." && subject='".$_SESSION['subject']."'"."&&num=".$_SESSION['questNum']);
        mysqli_query($conn, "insert into ".$_SESSION['id']." values(".$_SESSION['questNum'].",".$_POST['answer'].",".$_SESSION['year'].",".$_SESSION['month'].",'".$_SESSION['subject']."',".$_SESSION['grade'].")");
    }
    if($_POST['submit']=="이전 문제"&&$_SESSION['questNum']>1){
        $_SESSION['questNum']--;
    }else if($_POST['submit']=="다음 문제"){
        $_SESSION['questNum']++;
    }else{
    }
}
if(!isset($_POST['submit'])&&isset($_GET['jump'])&&!empty($_GET['jump'])){
    $_SESSION['questNum']=$_GET['jump'];
}
?>
<html>

<head>
    <title>문제페이지</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <form action="" method="post">
    <div id="title">
        <?php
            echo $_SESSION['year'],"년 ",$_SESSION['month'],"월 ",$_SESSION['subject']," 모의고사";
        ?>
    </div>
    <div id="body">
        <?php
        
        ?>
        <div id="quest">
            <?php
                echo $_SESSION['questNum'],"번 문제","<br>";
            $result = mysqli_query($conn, "SELECT question,example,picture,select1, select2, select3, select4, select5,sound FROM list WHERE grade=".$_SESSION['grade']." AND year=".$_SESSION['year']." AND month=".$_SESSION['month']." AND subject='".$_SESSION['subject']."' AND num=".$_SESSION['questNum']);
            while($row = $result->fetch_assoc()) {
                $sound=$row['sound'];
                $example=$row['example'];
                $picture=$row['picture'];
                echo $row['question'],"<br>";
                if(!empty($picture)&&$picture!=""&&$picture!=" "){
                    echo "<img src=\"",$picture,"\">";
                }
                if(!empty($example)&&$example!=""&&$example!=" "){
                    echo $example;
                }
                if(!empty($sound)&&$sound!=""&&$sound!=" "){
                    echo "<audio src=\"$sound\" controls=\"controls\"></audio>";
                }
                echo "<input type=\"radio\" name=\"answer\" value=\"1\" id=\"1\"> <label for=\"1\">",$row['select1'],"</label><br>";
                echo "<input type=\"radio\" name=\"answer\" value=\"2\" id=\"2\"> <label for=\"2\">",$row['select2'],"</label><br>";
                echo "<input type=\"radio\" name=\"answer\" value=\"3\" id=\"3\"> <label for=\"3\">",$row['select3'],"</label><br>";
                echo "<input type=\"radio\" name=\"answer\" value=\"4\" id=\"4\"> <label for=\"4\">",$row['select4'],"</label><br>";
                echo "<input type=\"radio\" name=\"answer\" value=\"5\" id=\"5\"> <label for=\"5\">",$row['select5'],"</label>";
                echo "<input type=\"submit\" value=\"이전 문제\" name=\"submit\">";
                echo "<input type=\"submit\" value=\"다음 문제\" name=\"submit\">";
            }
            ?>
        </div>
        <div class="omr">
                <?php
                    $result = mysqli_query($conn, "SELECT distinct num FROM list WHERE grade=".$_SESSION['grade']." AND year=".$_SESSION['year']." AND month=".$_SESSION['month']." AND subject='".$_SESSION['subject']."'");
                    while($row = $result->fetch_assoc()) {
                            $num=$row['num'];
                            $result1 = mysqli_query($conn, "select answer from ".$_SESSION['id']." where num=".$num."&& grade=".$_SESSION['grade']." AND year=".$_SESSION['year']." AND month=".$_SESSION['month']." AND subject='".$_SESSION['subject']."'");
                        $count=0;
                            while($row1 = $result1->fetch_assoc()) {
                                $temp = $row1['answer'];
                                $count=1;
                            }
                        if($count==1){
                            $defualt=$temp;
                        }else{
                            $defualt=0;
                        }
                        echo "<a href=\"/solve.php/?jump=",$num,"\" target=\"_self\">";
                        if($num<10)
                            echo "0$num.";
                        else
                            echo "$num.";
                        echo "</a>";
                        for($i=1;$i<6;$i++){
                            
                            if($i==$defualt){
                                echo "<input type=\"radio\" name=\"$num\" value=\"$i\" checked=\"checked\">";
                            }else{
                                echo "<input type=\"radio\" name=\"$num\" value=\"$i\">";
                            }
                            
                        }
                        echo "<br>";
                    }
                ?>
                <input type="submit" value="제출" name="submit">
            
        </div>
    </div>
</form>
</body>

</html>
