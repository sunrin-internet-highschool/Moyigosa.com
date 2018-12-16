<link rel="stylesheet" type="text/css" href="/side.css">
<div id="side">
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
        <img src="picture/linemenu/xicon.png" width="47px" height="47px" class="close">
    </div>
    <div id="side_middle">
        <a href="/index.php">
            <div class="side_element">
                <span>메인페이지</span>
            </div>
        </a>
        <?php
            for($i=0;$i<20;$i++){
                echo "<div class=\"side_element\"><span>$i</span><img src=\"/picture/linemenu/plusicon.png\" width=\"33\" height=\"31\"></div>";
            }
            ?>
    </div>
</div>
<div id="background">
</div>
