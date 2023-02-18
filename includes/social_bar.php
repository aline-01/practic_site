<?php 

$social_information = $functions->get_socialAccount_information();



?>

           <div class="sidebar-social">
              <ul>
                 <li>
                   <a href="#" class="telegram"><i class="fa fa-send"></i>دنبال کردن در تلگرام</a>
                 </li>
                 <li>
                     <a href="#" class="twitter"><i class="fa fa-twitter"></i>صفحه توئیتر ما</a>
                  </li>
                  <li>
                     <a href="#" class="aparat"><i class="fa fa-video-camera"></i>دنبال کردن در آپارات</a>
                  </li>
                  <li>
                     <a href="https://www.youtube.com/c/<?php echo $social_information[0]['youtube']; ?>" class="youtube" target="_blank" ><i class="fa fa-youtube"></i>کانال یوتیوب</a>
                   </li>
                   <li>
                     <a href="https://www.instagram.com/<?php echo social_information[0]['instagram']; ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i>پیج اینستاگرام </a>
                  </li>
              </ul>
           </div>
           <div class="category-sidebar">
                 <span><i class="fa fa-bookmark"></i>دسته بندی مطالب</span>
               <ul>
                  <li><a href="#">دنبال کردن در تلگرام</a></li>
                  <li><a href="#">صفحه توئیتر ما</a></li> 
                  <li><a href="#">دنبال کردن در آپارات</a></li>
                  <li><a href="#">کانال یوتیوب</a></li>
                  <li><a href="https://instagram.com/unix_boy9" target="_blank">پیج اینستاگرام</a></li>
               </ul>
            </div>
