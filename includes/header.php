<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, maximum-scale=1">
      <title>قالب سایت شرکتی</title>
      <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
      <link href='https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css' rel='stylesheet' type='text/css'>
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/style2.css" rel="stylesheet" type="text/css">
      <!--[if IE]>
      <style type="text/css">.pie {behavior:url(PIE.htc);}</style>
      <![endif]-->
      <!--[if lt IE 9]>
      <script src="js/respond-1.1.0.min.js"></script>
      <script src="js/html5shiv.js"></script>
      <script src="js/html5element.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="main-menu">
         <div class="container">
            <ul>
               <li><a href="#">صفحه اصلی</a></li>
               <?php 
                  if (isset($_COOKIE["user_access"]) == 0) {
                     echo "<li><a href='/users/login.php'>ورود</a></li>";
                  }else if (isset($_COOKIE["user_access"]) == 1) {
                     echo "<li><a href='/users/logout.php'>خروج</a></li>";
                     $user_info = $functions->get_user_info();
                  }
               ?>
               <li><a href="#">تماس</a></li>
               <li><a href="#">درباره</a></li>
            </ul>
            <?php if ($user_info[0]["add_access"] == 1) { ?> 
            <ul style="float:left;font-size:15px;">
               <li><a href="admin/">پنل ادمین</a></li>
            </ul>
            <?php } ?>
         </div>
      </div>
      <br>
      <div class="top-section">
         <div class="container">
            <div class="row">
               <div class="col-md-2">
                  <img src="img/logo.png" alt="" class="logo">
               </div>
               <div class="col-md-5">
                  <form method="GET" action="category.php" class="search-form">
                     <input type="text" name="search" placeholder="جستجو کنید ...">
                     <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
               </div>
               <div class="col-md-5">
                  <div class="index-h1">
                     <h1>بهترین و متفاوت ترین مقالات آموزشی</h1>
                  </div>
               </div>
            </div>
         </div>
      </div>