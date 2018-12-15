<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if(!isset($_GET['year'])||!isset($_GET['month'])||!isset($_GET['grade'])||!isset($_GET['subject'])||!isset($_GET['jump'])){
    echo"<script>alert('잘못된 접근입니다.');self.close();</script>";
    die();
}
?>
