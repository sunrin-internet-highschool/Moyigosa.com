<link rel="stylesheet" type="text/css" href="/side.css">
<head>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="/side.js"></script>
</head>
<div id="side" style="right:-30em">
    <div id="side_top">
        <div id="login">
            <?php
            if(isset($_POST['logout'])){
                session_unset();
            }
            if(isset($_SESSION['id'])&&isset($_SESSION['pw'])){//로그인 된 상태
                echo "<a href=\"user.php\" target=\"_self\"><img src=\"/picture/linemenu/user.png\" width=\"55px\" height=\"55px\"></a>";
                echo "<form action=\"\" method=\"post\">";
                echo "<input type=\"image\" src=\"/picture/linemenu/logout.png\">";
                echo "<input type=\"hidden\" name=\"logout\" name=\"logout\">";
                echo "</form>";
            }else{//로그인 안된 상태
                $_SESSION['temp']=true;
                echo "<a href=\"login.php\" target=\"_self\" clsss=\"side_login\"><img src=\"/picture/linemenu/login.png\" width=\"146px\" height=\"55px\"></a>";
                echo "<a href=\"signUp.php\" target=\"_self\" class=\"side_signup\"><img src=\"/picture/linemenu/signup.png\" width=\"146px\" height=\"55px\"></a>";
            }
                ?>
        </div>
        <img src="/picture/linemenu/xicon.png" width="47px" height="47px" class="close">
    </div>
    <div id="side_middle">
        <a href="/index.php">
            <div class="side_element">
                <span>메인페이지</span>
            </div>
        </a>
        <?php
        require_once('cnn.php');
        $result = mysqli_query($conn, "select distinct year,month,grade,subject,concat(year,month,grade,subject) as 'tag' from list");
        while($row = $result->fetch_assoc()) {
            $tag=$row['tag'];
            $year=$row['year'];
            $month=$row['month'];
            $grade=$row['grade'];
            $subject=$row['subject'];
            if(isset($_SESSION[$tag])){
                echo "<a href=\"/solve.php/?year=","$year","&month=","$month","&grade=","$grade","&subject=","$subject","&jump=",$_SESSION[$tag]['jump'],"\">";
                echo "<div class=\"side_element\"><span>$year","년 ","$month","월 ","$grade","학년"," $subject 모의고사</span><img src=\"/picture/linemenu/plusicon.png\" width=\"33\" height=\"31\"></div>";
                echo "</a>";
            }
        }
        ?>
    </div>
</div>
<div id="background" style="display:none">
</div>