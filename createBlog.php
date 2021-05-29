<!DOCTYPE html>


 <?php 

  session_start();
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
<html lang="">

<head>
<title>Blogist</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">



<div class="bgded overlay" style="background-image:url('images/demo/index.jpg');"> 

  <div class="wrapper row0">
    <header id="header" class="hoc clear center"> 
      <h1 id="logo"><i class="fas fa-truck-loading"></i> <a href="index.php">Blogist</a></h1>
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
    <div class="content"> 
     
      </div>
      <div id="comments">
        <h2>Write A Blog</h2>
        <form action="dbFunctions/functions.php" method="post" enctype="multipart/form-data">
          <div class="one_third first">
            <label for="name">Title <span>*</span></label>
            <input type="text" name="blog_title" id="name" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="email">Category <span>*</span></label>
           <select style="width: 350px;height: 40px;border: 1px solid #D7D7D7" name="blog_category">
            <option>Sport</option>
            <option>Art</option>
            <option>Book</option>
            <option>Country</option>
           </select>
          </div>
          <div class="one_third">
            <label for="url">Image</label>
            <input type="file" name="blog_image">
          </div>
          <div class="block clear">
            <label for="comment">Your Text</label>
            <textarea name="blog_text" id="comment" cols="25" rows="10"></textarea>
          </div>
          <div style="display: flex;">
            <input type="submit" name="addBlog" style="z-index: 9999999999999" value="Submit Form">
             <div  style="display: flex;margin-top: 25px"><input type="checkbox"  name="comment" value="true"><div >Is blog commentable</div></div>
            
            &nbsp;
          </div>
        </form>
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
      <p class="nospace">Contact details</p>
    </div>
    <hr class="btmspace-50">
    <div class="group"> 
      <div class="one_quarter first">
        <h6 class="heading">Contact Informations</h6>
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
        <div style="color: #3F4A5C">asd</div>
      </div>
      <div class="one_quarter">
        <div style="color: #3F4A5C">asd</div>
      </div>
      <div class="one_quarter">
        <h6 class="heading">Social Media</h6>
        <ul class="nospace clear latestimg">
          <li><a class="imgover" href="#"><img src="images/demo/insta.png" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
          <li><a class="imgover" href="#"><img src="images/demo/insta.png"" alt=""></a></li>
        </ul> <li><a class="faicon-dribble" href="#"></a></li>
      </div>
    </div>
  </footer>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Blogist</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>