<?php include("includes/db_config/db_connection.php"); ?>
<?php include("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php 

if (!isset($_GET["search"]) || empty($_GET["search"])) {
   $functions->header_to("index.php");
}else {
   $search_value = $functions->safe_input($_GET["search"]);
   $search_result = $functions->search($search_value);
}


?> 
   <br>
      <center>
         <p style="font-size: 16px;color: #444;">دسته بندی ها</p>
      </center>
      <hr>
      <div class="container">
         <div class="row">
            <!-- <div class="col-md-3">
               <a href="#">
                  <div class="post-content">
                     <figure>
                        <img src="img/blog/blog7.jpg">
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
         <?php foreach($search_result as $res) { ?>
            <div class="col-md-3">
               <a href="single.php?id=<?php echo $res["id"] ?>">
                  <div class="post-content">
                     <figure>
                        <img src="<?php echo $res["image_addr"]; ?>">
                        <figcaption class="hover-fig">
                           <i class="fa fa-plus"></i>
                        </figcaption>
                        <figcaption class="date-fig">
                           <span><?php echo $res["date"]; ?></span>
                           <i class="fa fa-date"></i>
                        </figcaption>
                     </figure>
                     <p><?php echo $res["title"]; ?></p>
                  </div>
               </a>
            </div>
         <?php } ?>
         </div>
         <br>
         <div class="pagin text-center">
            <ul class="pagination">
               <li><a href="#">1</a></li>
               <li><a href="#">2</a></li>
               <li><a href="#">3</a></li>
               <li><a href="#">4</a></li>
               <li><a href="#">5</a></li>
            </ul>
         </div>
      </div>
      <br><br>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="footer-contact">
                     <span class="footer-title">چگونه با ما در تماس باشید</span>
                     <ul>
                        <li><a href="#" title="041311111111" data-toggle="tooltip"><i class="fa fa-phone"></i></a></li>
                        <li><a href="#" title="تبریز " data-toggle="tooltip"><i class="fa fa-map-marker"></i></a></li>
                        <li><a href="#" title="info@seo90.ir" data-toggle="tooltip"><i class="fa fa-envelope-o"></i></a></li>
                        <li><a href="#" title="09352604271" data-toggle="tooltip"><i class="fa fa-mobile"></i></a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="footer-random-posts">
                     <span class="footer-title">شاید این مطالب را بپسندید</span>
                     <div class="col-md-6">
                        <a href="#">
                           <div class="footer-random-posts-body">
                              <figure>
                                 <img src="img/blog/blog7.jpg" alt="">
                              </figure>
                              <h4>دوچرخه سواری و استقامت</h4>
                              <span><i class="fa fa-calendar-o"></i>98/8/7</span>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-6">
                        <a href="#">
                           <div class="footer-random-posts-body">
                              <figure>
                                 <img src="img/blog/blog4.jpg" alt="">
                              </figure>
                              <h4>ورزش و سلامتی </h4>
                              <span><i class="fa fa-calendar-o"></i>98/8/7</span>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-6">
                        <a href="#">
                           <div class="footer-random-posts-body">
                              <figure>
                                 <img src="img/blog/blog7.jpg" alt="">
                              </figure>
                              <h4>آیا تنیس قدرت بدنی بالایی نیاز دارد؟</h4>
                              <span><i class="fa fa-calendar-o"></i>98/8/7</span>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-6">
                        <a href="#">
                           <div class="footer-random-posts-body">
                              <figure>
                                 <img src="img/blog/blog4.jpg" alt="">
                              </figure>
                              <h4>طبیعت گردی در روح انسان چه تاثیری دارد ؟</h4>
                              <span><i class="fa fa-calendar-o"></i>98/8/7</span>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <br><br><br>      
            <center>
               <p>حقوق انتشار برای وب سایت محفوظ است - قالب seo90.ir</p>
            </center>
         </div>
      </div>
      <script type="text/javascript" src="js/jquery.1.8.3.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/wow.js"></script>
      <script type="text/javascript" src="js/jquery.particleground.js"></script>
      <script>
         jQuery("[data-toggle='tooltip']").tooltip();
         jQuery('.footer').particleground({
         dotColor: '#515151',
         lineColor: '#515151'
         });   
      </script>
   </body>
</html>