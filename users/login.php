<?php include("../includes/functions.php"); ?>
<?php include("../includes/db_config/db_connection.php"); ?>
<?php 
session_start();
if (isset($_POST["submit"]) == 1) {
    $errors = array();
    $username = $_POST["username"];
    if (empty($username) == 1) {
        array_push($errors,"نام کاربری خود را وارد کنید");
    }

    $password = $_POST["password"];
    if (empty($password) == 1) {
        array_push($errors,"رمز عبور خود را وارد کنید");
    }else {
        $hash_password = $functions->hash_password($password);
    }

    if (empty($errors) == 1) {
        $sql_select = "select * from users where username = ? && password = ?";
        $query_select = $connection->prepare($sql_select);
        $safe_username = $functions->safe_input($username);
        $query_select->bindValue(1,$safe_username);
        $query_select->bindValue(2,$hash_password);
        $query_select->execute();
        $result = $query_select->fetchAll(PDO::FETCH_ASSOC);
        $selected = $query_select->rowCount();
        if ($selected > 0) {
            $name = "user_access";
            $value = $result[0]["id"];
            $expire = time() + (30000 * 2);
            setcookie($name,$value,$expire,"/");
            $functions->header_to("../index.php");
        }

    }   


}

?>
<html lang="fa">
    <head>
      <meta charset="UTF-8">
      <title>weblog</title>
      <link rel="stylesheet" href="/css/bootstrap.css">
      <link rel="stylesheet" href="/css/loginUser.css">
      <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    </head>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Login
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="username" class="form-control" value="<?php if (isset($_SESSION["user_registerd"]) == 1) { echo $_SESSION["user_registerd"][0]; } ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" class="form-control" value="<?php if (isset($_SESSION["user_registerd"]) == 1) { echo $_SESSION["user_registerd"][1]; } ?>">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                    <?php 
                                        if (isset($_POST["submit"]) == 1 && empty($errors) == 0) {
                                            foreach($err as $errors) {
                                                echo "<li>{$err}</li>";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <a href="register.php" class="register-btn btn btn-outline-primary">REGISTER</a>
                                    <button type="submit" name="submit" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>



