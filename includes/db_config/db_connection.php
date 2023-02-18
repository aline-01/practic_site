<?php 
//connection to database with pdo path
$host = "localhost";
$username = "root";
$password = "";
$db_name = "weblog_corp";

try {
   $connection = new PDO("mysql:host={$host}",$username,$password);
   $sql_use = "use {$db_name}";
   $query_use = $connection->prepare($sql_use);
   $query_use->execute();
}catch(PDOException $e) {
   echo "connection is fild";
   echo "<br><br>" . $e;
}


?>
