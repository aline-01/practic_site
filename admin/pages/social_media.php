<?php include("../layouts/header.php"); ?>
<?php include("../../includes/db_config/db_connection.php"); ?>
<?php include("../../includes/functions.php"); ?>
<?php 
$functions->access_to_admin();

if (isset($_POST["submit"]) == 1) {
    $youtube = $_POST["Youtube"];
    $twiiter = $_POST["Twitter"];
    $instagram = $_POST["Instagram"];
    $aparat = $_POST["Aparat"];
    $telegram = $_POST["Telegram"];
    $social_array = [$youtube,$twiiter,$instagram,$aparat,$telegram];
    // foreach ($social_array as $sa) {
    //     if (preg_match("https://",$sa) == 1 || preg_match("http://",$sa) == 1) {
    //         array_push($errors,"just enter your chanel name");
    //     }
    // }
    
    //deleting the  last information
    $sql = "delete from social_media";
    $query = $connection->prepare($sql);
    $query->execute();
    //insert the new information
    $sql = "insert into social_media(youtube,twitter,instgram,aparat,telegram)
            value(?,?,?,?,?)";
    $query = $connection->prepare($sql);
    $query->bindValue(1,$youtube);
    $query->bindValue(2,$twiiter);
    $query->bindValue(3,$instagram);
    $query->bindValue(4,$aparat);
    $query->bindValue(5,$telegram);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo "<script>alert('Your social media account is been successfuly set')</script>";
    } else if ($query->rowCount() == 0) {
        echo "<script>alert('have a problem try again')</script>";
    }
    $functions->header_to("social_media.php");

} 

?>
<br>
<div class="row">
    <form action="social_media.php" method="POST">
        <input type="text" name="Youtube" class="form-control form-input" placeholder="Youtube   exam:my_chanel" ><br>
        <input type="text" name="Twitter" class="form-control form-input" placeholder="Twitter   exam:my_chanel"><br>
        <input type="text" name="Instagram" class="form-control form-input" placeholder="Instagram  exam:irbsoft"><br>
        <input type="text" name="Aparat" class="form-control form-input" placeholder="Aparat   exam:my_chanel"><br>
        <input type="text" name="Telegram" class="form-control form-input" placeholder="Telegram    exam:my_chanel"><br>
        <input type="submit" name="submit" value="Set the social media for the site" class="form-control form-input">
    </form>
</div>

<?php include("../layouts/footer.php"); ?>