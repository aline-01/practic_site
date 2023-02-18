<?php include("includes/db_config/db_connection.php"); ?>
<?php include("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php 
$all_blogs = $functions->get_all_posts();


?>


      <br>
      <center>
         <p style="font-size: 16px;color: #444;">آخرین مطالب وبلاگ</p>
      </center>
      <hr>
      <div class="container">
         <div class="row">
            <div class="col-md-3">
               <div class="sidebar">
                  <div class="sidebar-text">
                     <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. </p>
                  </div>
                     <?php include("includes/social_bar.php") ?>
                  <div class="category-sidebar ads-sidebar">
                     <span><i class="fa fa-slack"></i>تبلیغات</span>
                     <ul>
                        <li>
                           <a href="#">
                              <figure>
                                 <img src="img/ads/ads1.jpg" alt="">                             
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
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     <!-- Indicators -->
                     <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                     </ol>
                     <!-- Wrapper for slides -->
                     <div class="carousel-inner">
                        <div class="item active">
                           <figure>
                              <img src="img/slide/Slide1.jpg" alt="">                             
                              <figcaption></figcaption>
                           </figure>
                           <div class="carousel-caption">
                              <h3>طراحی وب</h3>
                              <p>طراحی وب رو از همین امروز شروع کن</p>
                           </div>
                        </div>
                        <div class="item">
                           <figure>
                              <img src="img/slide/Slide1.jpg" alt="">                             
                              <figcaption></figcaption>
                           </figure>
                           <div class="carousel-caption">
                              <a href="">
                                 <h3>چرا شاد نباشیم</h3>
                                 <p>مجموعه مقالات روانشناسی سارتر</p>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <div class="col-md-4">
                  <a href="single.html">
                     <div class="post-content">
                        <figure>
                           <img src="../../img/blog/294181.jpg">
                           <figcaption class="hover-fig">
                              <i class="fa fa-plus"></i>
                           </figcaption>
                           <figcaption class="date-fig">
                              <span>98/06/08</span>
                              <i class="fa fa-date"></i>
                           </figcaption>
                        </figure>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                     </div>
                  </a>
               </div> -->
            <?php foreach($all_blogs as $alb) { ?>
               <div class="col-md-4">
                  <a href="single.php?id=<?php echo $alb['id']; ?>">
                     <div class="post-content">
                        <figure>
                           <img src="<?php echo $alb["image_addr"] ?>">
                           <figcaption class="hover-fig">
                              <i class="fa fa-plus"></i>
                           </figcaption>
                           <figcaption class="date-fig">
                              <span><?php echo $alb["date"]; ?></span>
                              <i class="fa fa-date"></i>
                           </figcaption>
                        </figure>
                        <p><?php echo $alb["title"]; ?></p>
                        <!-- <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p> -->
                     </div>
                  </a>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>
   <br><br>
   
<?php include("includes/footer.php"); ?>