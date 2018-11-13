<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
    require_once ('cnn.php');
    $_SESSION['questNum'.$def]=1;
    $result = mysqli_query($conn, "SELECT count(num) FROM list".$select);
    while($row = $result->fetch_assoc()) {
        $_SESSION['questFinal'.$def]=$row['count(num)'];
    }
if(!isset($_SESSION['questFinal'.$def])||empty($_SESSION['questFinal'.$def])){
    echo"<script>alert('잘못된 접근입니다.');self.close();</script>";
    return 0;
}
    $i=1;
    $result = mysqli_query($conn, "SELECT * FROM list".$select);
    while($row = $result->fetch_assoc()) {
        $_SESSION['num'.$def][$i]=$row['num'];
        $_SESSION['question'.$def][$i]=$row['question'];
        $_SESSION['example'.$def][$i]=$row['example'];
        for($j=1;$j<=5;$j++)
            $_SESSION['select'.$j.$def][$i]=$row['select'.$j];
        $_SESSION['sound'.$def][$i]=$row['sound'];
        $_SESSION['picture'.$def][$i]=$row['picture'];
        $_SESSION['correct'.$def][$i]=$row['correct'];
        $i++;
    }
    if(isset($_SESSION['id'])){
        $result = mysqli_query($conn, "SELECT * FROM ".$_SESSION['id'].$select);
    while($row = $result->fetch_assoc()) {
        $_SESSION['answer'.$def][$row['num']]=$row['answer'];
    }
    }
?>
