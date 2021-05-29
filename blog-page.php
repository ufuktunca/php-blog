<!DOCTYPE html>

<html lang="">
<head>
<title>Blogist</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
  <?php 
  error_reporting(0);
  session_start();
  include "dbFunctions/blog.php";
  include "dbFunctions/dbConnect.php";

$commentData = $db->prepare("SELECT * FROM comment WHERE blog_id=:id");
$commentData->execute(array("id"=>$_GET["id"]));

   $blog = $db->prepare("SELECT * FROM blog WHERE blog_id=:id");
$blog->execute(array("id"=>$_GET["id"]));
$blogData = $blog->fetch(PDO::FETCH_ASSOC);



   $writer = $db->prepare("SELECT * FROM user WHERE user_email=:email");
$writer->execute(array("email"=>$blogData["writer_email"]));
$writerData = $writer->fetch(PDO::FETCH_ASSOC);

if ($blogData["commentable"] == "true") {
    $blogClass = new blogWithComment($blogData["blog_title"],$blogData["blog_text"]);
} else {
  $blogClass = new blogWithoutComment($blogData["blog_title"],$blogData["blog_text"]);
}

error_reporting(0);


   ?>


     <?php 
include "dbFunctions/user.php";

if(isset($_SESSION["user_email"])){
  $user = $db->prepare("SELECT * FROM user WHERE user_email=:email");
$user->execute(array("email"=>$_SESSION["user_email"]));
$userData = $user->fetch(PDO::FETCH_ASSOC);


if($userData["user_role"] == "blogger"){
$user = new Blogger($userData["user_name"],$userData["user_email"],$userData["user_role"]);  
} else {
  $user = new Reader($userData["user_name"],$userData["user_email"],$userData["user_role"]);
}

}


  include "dbFunctions/blogList.php";
  include "dbFunctions/dbConnect.php";
  $blogs = $db->prepare("SELECT * FROM blog");
$blogs->execute();
error_reporting(0); ?>

<div class="bgded overlay" style="background-image:url('data:image/jpg;charset=utf8;base64,<?php echo base64_encode($blogData["blog_image"]); ?>");'> 
  <div class="wrapper row0">
    <header id="header" class="hoc clear center"> 
      <h1 id="logo"><i class="fas fa-truck-loading"></i> <a href="index.html">Blogist</a></h1>
    </header>
  </div>
  <div class="wrapper row1">
    <nav id="mainav" class="hoc clear"> 
      <ul class="clear">
         <li class="active"><a href="index.php">Home</a></li>
         <li ><a href="gallery.php">Blogs</a></li>       
              <?php  if(isset($_SESSION["user_email"])){ 
        $user->blogButton();
      } ?>
        <?php if(!isset($_SESSION["user_email"])){
          echo '<li><a class="drop" href="#">Login / Register</a>
          <ul>
            <li><a href="#" data-toggle="modal" data-target=".login-register-form">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target=".login-register-form">Register</a></li>
          </ul>
        </li>';
        } else{
          echo '<li><a href="dbFunctions/functions.php?logout=true">Logout</a></li>';
        } ?>
      </ul>
    </nav>
  </div>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content three_quarter first"> 
      <h1><?php $blogClass->getTitle(); ?></h1>
      <img class="imgr borderedbox inspace-5" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($blogData["blog_image"]); ?>" style="width: 125px;" alt="">
      <p><?php $blogClass->getText(); ?></p>

      <div id="comments">
        <h2>Comments</h2>
        <ul>
          <?php 
             while ($comment=$commentData->fetch(PDO::FETCH_ASSOC)) {  
                $blogClass->comments($comment["comment_name"],$comment["comment_text"]);
              }

              ?>
          
        </ul>
        <h2>Write A Comment</h2>
        <form action="dbFunctions/functions.php" method="post">
         <?php $blogClass->commentForm($_GET["id"]); ?>
        </form>
      </div>
    </div>
    <div class="sidebar one_quarter"> 
      <div class="sdb_holder">
        <h6>Writer</h6>
        <address>
        Name: <?php echo $writerData["user_name"]; ?><br>
        Email: <?php echo $writerData["user_email"]; ?>
        </address>
      </div>
    </div>
    <div class="clear"></div>
  </main>
</div>
<div class="wrapper bgded" style="background-image:url('images/demo/backgrounds/03.png');">
</div>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear">
    <div class="center btmspace-50"> 
      <h6 class="heading">Blogist</h6>
      <ul class="faico clear">
        <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
        <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
      </ul>
      <p class="nospace">Nisl quis leo scelerisque dapibus sed a arcu quisque et neque id mauris</p>
    </div>
    <hr class="btmspace-50">
    <div class="group"> 
      <div class="one_quarter first">
        <h6 class="heading">Tristique tincidunt</h6>
        <ul class="nospace btmspace-30 linklist contact">
          <li><i class="fas fa-map-marker-alt"></i>
            <address>
            Street Name &amp; Number, Town, Postcode/Zip
            </address>
          </li>
          <li><i class="fas fa-phone"></i> +00 (123) 456 7890</li>
          <li><i class="far fa-envelope"></i> info@domain.com</li>
          <li><i class="fas fa-clock"></i> Mon. - Sat.:<br>
            08.00am - 18.00pm</li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="heading">Praesent lorem nulla</h6>
        <ul class="nospace linklist">
          <li><a href="#">Ligula risus porttitor</a></li>
          <li><a href="#">Ac rutrum id euismod in diam</a></li>
          <li><a href="#">Nunc ultricies faucibus</a></li>
          <li><a href="#">Nullam risus lectus</a></li>
          <li><a href="#">Venenatis eu vulputate</a></li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="heading">Feugiat porta sed ipsum</h6>
        <ul class="nospace linklist">
          <li>
            <article>
              <p class="nospace btmspace-10"><a href="#">Proin rutrum turpis non accumsan aliquet odio magna luctus neque in adipiscing.</a></p>
              <time class="block font-xs" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
            </article>
          </li>
          <li>
            <article>
              <p class="nospace btmspace-10"><a href="#">Mi odio ac felis nunc vitae lacus sit amet sem consequat ullamcorper quisque.</a></p>
              <time class="block font-xs" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
            </article>
          </li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="heading">Posuere suscipit massa</h6>
        <ul class="nospace clear latestimg">
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/100x100.png" alt=""></a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>