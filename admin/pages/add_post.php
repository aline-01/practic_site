<?php include("../layouts/header.php"); ?>
<?php include("../../includes/db_config/db_connection.php"); ?>
<?php include("../../includes/functions.php"); ?>
<?php 

$functions->access_to_admin();

if (isset($_POST["submit"]) == 1) {
    $errors = array();
    
    $title = $_POST["title"];
    if (empty($title) == 1) {
      array_push($errors,"عنوان وبلاگ را وارد کنید");
    }else if (strlen($title) < 4) {
      array_push($errors,"عنوان کوتاه است");
    }else if(strlen($title) > 70) {
      array_push($errors,"عنوان طولانی است");
    }
  
    $blog_img = $_FILES["blog_img"];
    if ($blog_img["error"] > 0) {
      array_push($errors,"تصویر را برای وبلاگ آپلود کنید");
    }else {
      $path_upload = "../../img/blog/" . $blog_img["name"];
    }

    $content = $_POST["content"];
    if (empty($content) == 1) {
      array_push($errors,"تصویر را برای وبلاگ آپلود کنید");
    }

    $date = date("y/m/d");
    $writer = $_COOKIE["user_access"];
    
    if (empty($errors) == 1) {
      $move_file = move_uploaded_file($blog_img["tmp_name"],$path_upload);
      if ($move_file == false) {
        array_push($errors,"فایل شما آپلود نشد");
      }
      $sql_insert = "insert into blogs(image_addr,title,content,date,writer)
                      values(?,?,?,?,?)";
      $query_insert = $connection->prepare($sql_insert);
      $safe_img = $functions->safe_input($path_upload);
      $safe_title = $functions->safe_input($title);
      $query_insert->bindValue(1,$safe_img);
      $query_insert->bindValue(2,$safe_title);
      $query_insert->bindValue(3,$content);
      $query_insert->bindValue(4,$date);
      $query_insert->bindValue(5,$writer);
      $query_insert->execute();
      $selected = $query_insert->rowCount();
      if ($selected > 0) {
        $functions->header_to("add_post.php");
      }else {
        array_push($errors,"مشکلی دارد دوباره امتحان کنید");
      }
    }

}



?>

<div class="row">
        <form enctype="multipart/form-data" action="add_post.php" method="POST">
            <input type="text" name="title" class="form-control form-input" placeholder="title"><br>
            <input class="form-control form-input" type="file" id="formFile" name="blog_img"><br>
            <textarea placeholder="enter the content for blog" name="content" class="form-input" id="editor1"></textarea>
            <script>
                CKEDITOR.replace('editor1');
           </script><br>
          <!-- <input type="text" name="tag" class="form-control form-input" placeholder="tab"><br> -->
          <?php 
            if (isset($_POST["submit"]) == 1 && empty($errors) == 0) {
              echo "<div class='errors'>";
              echo "<ul>";
              foreach($errors as $err) {
                echo "<li style='font-size:20px;'>{$err}</li>";
              }
              echo "</ul>";
              echo "</div><br>";
            }
            ?>
            <input type="submit" value="submit" class="btn btn-success" class="form-input" name="submit">
        </form>
    </div>
<?php 
   $all_blogs = $functions->get_all_posts();

?>
<div class="row">
        <table class="table table-dark">
  <thead>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">title</th>
          <th scope="col">image</th>
          <th scope="col">writer</th>
          <th scope="col">date</th>
          <th scope="col">opreatin</th>
        </tr>
      </thead>
      <tbody>
        <?php $row_number = 1; ?>
        <?php foreach($all_blogs as $alb) { ?>
          <tr>
          <th scope="row"><?php echo $row_number;$row_number+=1; ?></th>
          <td><?php echo $alb["title"]; ?></td>
          <td><img src="<?php echo $alb['image_addr']; ?>" height="100px" alt=""></td>
          <td><?php echo $functions->get_admin_by_id($alb["id"]); ?></td>
          <td><?php echo $alb["date"]; ?></td>
          <td style="float:left;">
            <a href="oprations/Edit_post.php?id=<?php echo $alb["id"]; ?>" class="btn btn-warning">Edit</a>
            <a href="oprations/delete_post.php?id=<?php echo $alb["id"]; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
          <?php } ?>
      <table class="table table-dark">
      <thead>
      <table class="table table-striped">

  </thead>
<tbody>



</body>
    <script src="/js/jquery.1.8.3.min.js"></script>
    <script src="/js/bootstrap.js"></script>
</html>
