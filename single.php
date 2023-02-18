<?php include("includes/db_config/db_connection.php"); ?>
<?php include("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php 

if (isset($_GET["id"]) == 0 || empty($_GET["id"]) == 1) {
   $functions->header_to("index.php");
}else {
   $id = $functions->safe_input($_GET["id"]);
   $this_post = $functions->get_post_by_id($id);
   if (empty($this_post) == 1) {
      $functions->header_to("404.html");
   }
   //save View for post
   $sql_saveView = "insert into view(blog_id)
                     value(?)";
   $query_saveView = $connection->prepare($sql_saveView);
   $query_saveView->bindValue(1,$id);
   $query_saveView->execute();
   //show the view for this post
   $sql_showView = "select * from view where blog_id = ?";
   $query_showView = $connection->prepare($sql_showView);
   $query_showView->bindValue(1,$id);
   $query_showView->execute();
   $view_post = $query_showView->rowCount();
}

if (isset($_POST["submit_comment"]) == 1) {
   $errors = array();
   
   $name = $_POST["user_name"];
   if (empty($name) == 1) {
      array_push($errors,"اسمت را وارد کن");
   }else if (strlen($name) > 24) {
      array_push($errors,"نام طولانی است");
   } 
   
   $email = $_POST["user_email"];
   if (empty($email) == 1) {
      $email == "None";
   }

   $content = $_POST["user_comment"];
   if (empty($content) == 1) {
      array_push($errors,"محتوا را وارد کنید");
   }else if (strlen($content) > 200) {
      array_push($errors,"محتوا طولانی است");
   }
   
   if (empty($errors) == 1) {
      $sql_comment = "insert into comments(name,email,content,blog_id)
            value (?,?,?,?)";
      $query_comment = $connection->prepare($sql_comment);
      $query_comment->bindValue(1,$name);
      $query_comment->bindValue(2,$email);
      $query_comment->bindValue(3,$content);
      $query_comment->bindValue(4,$id);
      $query_comment->execute();
      $functions->header_to("single.php?id={$id}");
   }

   
}


?>

<br>
   <center>خانه / عنوان مطلب</center>
      <hr>
      <div class="container">
         <div class="row">
            <div class="col-md-3">
               <div class="sidebar">
                  <div class="sidebar-text">
                     <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
                  </div>
                  <?php include("includes/social_bar.php"); ?>
                  <div class="category-sidebar ads-sidebar">
                     <span><i class="fa fa-slack"></i>تبلیغات</span>
                     <ul>
                        <li>
                           <a href="#">
                              <figure>
                                 <img src="img/ads/ads1.png" alt="">                             
                                 <figcaption></figcaption>
                              </figure>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <figure>
                                 <img src="img/ads/ads2.jpg" alt="">                             
                                 <figcaption></figcaption>
                              </figure>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="col-md-12">
                  <div class="single-content">
                     <div class="single-img">
                        <img src="<?php echo $this_post[0]["image_addr"]; ?>">
                     </div>
                     <div class="single-meta" style="padding-right:290px;">
                        <ul>
                           <li><a href="#" title="<?php echo "20";echo $this_post[0]["date"]; ?>" data-toggle="tooltip"><i class="fa fa-calendar-o"></i></a></li>
                           <li><a href="#" title="98/8/8" data-toggle="tooltip"><i class="fa fa-reply"></i></a></li>
                           <li><a href="#" title="<?php echo $functions->get_admin_by_id($this_post[0]["writer"]); ?>" data-toggle="tooltip"><i class="fa fa-user-o"></i></a></li>
                           <li><a href="#" title="بازدید:<?php echo $view_post; ?>" data-toggle="tooltip"><i class="fa fa-eye"></i></a></li>
                           <li><a href="#" title="اشتراک در توئیتر" data-toggle="tooltip"><i class="fa fa-twitter"></i></a></li>
                           <li><a href="#" title="اشتراک در فیس بوک" data-toggle="tooltip"><i class="fa fa-facebook"></i></a></li>
                        </ul>
                     </div><br>
                     <div class="single-title">
                        <h1><?php echo $this_post[0]["title"]; ?></h1>
                     </div>
                     <p><?php echo $this_post[0]["content"]; ?></p>
                     <hr>
                     <div class="comment">
                        <span><i class="fa fa-comments"></i>نظری برای این مطلب بنویسید</span>
                        <form action="single.php?id=<?php echo $id ?>" method="POST">
                           <div class="form-group col-md-6">
                              <input class="form-control" type="text" name="user_name" placeholder="نام خود را وارد کنید" >
                           </div>
                           <div class="form-group col-md-6">
                              <input class="form-control" type="email" require name="user_email" placeholder="ایمیل را واردکنید" >
                           </div>
                           <div class="form-group col-md-12">
                              <textarea class="form-control" name="user_comment" placeholder="متن نظر" rows="7"></textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <button class="btn btn-default" name="submit_comment" type="submit">ارسال نظر</button>
                           </div>
                        </form>
                     </div>
                     <div class="comments-note">
                        نظرات این مطلب
                     </div><br><br><br><br>
                        <?php 
                        $all_comments = $functions->get_comment_for_post($id);
                        foreach($all_comments as $alm) {
                        ?>
                        <div class="comment-text" style="display:block;">
                           <a href="" class="btn btn-success" style="margin-right: 5px;">record answer</a>
                            <span style="margin-left:6px;" class="btn btn-info"><?php echo $alm["name"]; ?></span>
                            <a href="" class="btn btn-warning">report</a><br>
                            <p><?php echo $alm["content"] ?></p>
                        </div><br><br><br><br>
                        <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br><br>

<?php include("includes/footer.php"); ?>
