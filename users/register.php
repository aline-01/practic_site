
<?php include("../includes/db_config/db_connection.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php 
session_start();

if (isset($_POST["submit"]) == 1) {
    $errors = array();
    
    $name = $_POST["name"];
    if (empty($name) == 1) {
        array_push($errors,"اسمت را وارد کن");
    }else if (strlen($name) > 60) {
        array_Push($errors,"نام طولانی است");
    }

    $username = $_POST["username"];
    if (empty($username) == 1) {
        array_push($errors,"نام کاربری خود را وارد کنید");
    }else if (strlen($username) < 3) {
        array_push($errors,"نام کاربری کوتاه است");
    }else if (strlen($username) > 60) {
        array_push($errors,"نام کاربری بسیار طولانی است");
    }else {
        //check the uniq username
        $is_uniq = $functions->uniq_user($username);
        if ($is_uniq == true) {
            //do nothing
        }else if ($is_uniq == false) {
            array_push($errors,"این نام کاربری ثبت شده است. یک نام کاربری جدید وارد کنید");
        }
    }

    $password = $_POST["password"];
    if (empty($password) == 1) {
        array_push($errors,"رمز عبور را وارد کنید");
    }else if (strlen($password) < 8) {
        array_push($errors,"رمز عبور بسیار کوتاه است");
    }else if (strlen($password) > 200) {
        array_push($errors,"رمز عبور طولانی است");
    }else {
        $hash_password = $functions->hash_password($password);
    }

    $email = $_POST["email"];
    if (empty($email) == 1) {
        array_push($errors,"آدرس ایمیل را وارد کنید");
    }else if (preg_match("/@/",$email) == 0) {
        array_push($errors,"آدرس ایمیل معتبر را وارد کنید");
    }
    
    $time_register = date("y/m/d");
    
    if (empty($errors) ==  1) {
        $sql_insert = "insert into users (name,username,password,email,time_reg)
                        value (?,?,?,?,?)";
        $query_insert = $connection->prepare($sql_insert);
        $safe_name = $functions->safe_input($name);
        $safe_username = $functions->safe_input($username);
        $safe_password = $functions->safe_input($hash_password);
        $safe_email = $functions->safe_input($email);
        $query_insert->bindValue(1,$safe_name);
        $query_insert->bindValue(2,$safe_username);
        $query_insert->bindValue(3,$safe_password);
        $query_insert->bindValue(4,$safe_email);
        $query_insert->bindValue(5,$time_register);
        $query_insert->execute();
        $selected = $query_insert->rowCount();
        if ($selected > 0) {
            $_SESSION["user_registerd"] = array($username,$password);
            $functions->header_to("login.php");
        }else if ($selected == 0) {
            array_push($errors,"مشکلی وجود دارد، دوباره امتحان کنید");
        }
    }
    
}


?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, maximum-scale=1">
      <title>قالب سایت شرکتی</title>
      <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="/css/font-awesome.css" rel="stylesheet" type="text/css">
      <link href='https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css' rel='stylesheet' type='text/css'>
      <link href="/css/style.css" rel="stylesheet" type="text/css">
      <link href="/css/loginUser.css" rel="stylesheet" type="text/css">
      <!--[if IE]>
      <style type="text/css">.pie {behavior:url(PIE.htc);}</style>
      <![endif]-->
      <!--[if lt IE 9]>
      <script src="js/respond-1.1.0.min.js"></script>
      <script src="js/html5shiv.js"></script>
      <script src="js/html5element.js"></script>
      <![endif]-->
   </head>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    REGISTER
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label class="form-control-label">NAME</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">EMAIL</label>
                                <input type="text" class="form-control" name="email">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                <?php 
                                    if (isset($_POST["submit"]) == 1 && empty($errors) == 0) {
                                        foreach($errors as $err) {
                                            echo "<li>{$err}</li>";
                                        }
                                        echo "</br>";
                                    }
                                
                                ?>
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" name="submit" class="btn btn-outline-primary" style="float:right;">REGISTER</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
