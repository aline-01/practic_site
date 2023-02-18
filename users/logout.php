<?php 
include("../includes/functions.php");
if (isset($_COOKIE["user_access"]) == 1) {
    $expire = time() - 366000;
    setcookie("user_access",$_COOKIE["user_access"],$expire,"/");
    $functions->header_to("../index.php");
}else {
    $functions->header_to("../index.php");
}


?>
