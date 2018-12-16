<?php
if(!isset($_GET['year'])||!isset($_GET['month'])||!isset($_GET['grade'])||!isset($_GET['subject'])||!isset($_GET['jump'])){
    include("error.php");
    die();
}
?>
<html>

<head>
    <title>
        문제페이지
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/solve.css">
</head>

<body>
    <?php
    require_once('top.php');
    //require_once('side.php');
    ?>
    <div id="title">
        <div>
            <?php
        echo $_GET['year'],"년 ",$_GET['month'],"월 ",$_GET['subject']," ",$_GET['grade'],"학년 모의고사";
        ?>
        </div>
    </div>
    <div id="view">
        
    </div>
    <div id="selection">
        <div>
            
        </div>
        <div>
            
        </div>
    </div>
    <div id="buttons">

    </div>
</body>

</html>
