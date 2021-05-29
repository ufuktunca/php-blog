<!DOCTYPE html>
<?php 
session_start();
include "./dbFunctions/user.php";
include "./dbFunctions/dbConnect.php";

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


?>
<html lang="">
<head>
<title>Blogist</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body id="top">

                        <div class="modal fade login-register-form" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#login-form"> Login <span class="glyphicon glyphicon-user"></span></a></li>
                                            <li><a data-toggle="tab" href="#registration-form"> Register <span class="glyphicon glyphicon-pencil"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div id="login-form" class="tab-pane fade in active">
                                                <form action="./dbFunctions/functions.php" method="post">
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd">Password:</label>
                                                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="remember"> Remember me</label>
                                                    </div>
                                                    <button type="submit" name="login" class="btn btn-default">Login</button>
                                                </form>
                                            </div>
                                            <div id="registration-form" class="tab-pane fade">
                                                <form action="./dbFunctions/functions.php" method="post">
                                                    <div class="form-group">
                                                        <label for="name">Your Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="newemail">Email:</label>
                                                        <input type="email" class="form-control" id="newemail" placeholder="Enter new email" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="newpwd">Password:</label>
                                                        <input type="password" class="form-control" id="newpwd" placeholder="New password" name="password">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="newpwd">User Type:</label>
                                                    <select name="role" style="width: 100%">
                                                      <option value="reader">Reader</option>
                                                      <option value="blogger">Blogger</option>
                                                    </select>
                                                  </div>
                                                    <button type="submit" name="register" class="btn btn-default">Register</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                        
  </div>
</div>
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
  <div id="pageintro" class="hoc clear"> 
    <article>
      <h3 class="heading">Best Blogs!</h3>
      <p>You are right place if you are looking for blogs.</p>
      <footer><a class="btn" href="#">See Blogs</a></footer>
    </article>
  </div>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading font-x3">Check some of our blogs</h6>
      <p>Try to find interesting blogs.</p>
    </div>
    <div class="posts">
      <figure class="group">
        <div><a class="imgover" href="#"><img src="images/demo/index.jpg" alt=""></a></div>
        <figcaption>
          <h6 class="heading">Praesent auctor justo</h6>
          <p>Et pulvinar pellentesque lectus urna luctus lorem a laoreet enim ligula vitae turpis curabitur ullamcorper arcu lobortis tempus ornare arcu elit dapibus ante at.</p>
          <footer><a class="btn" href="#">View Details</a></footer>
        </figcaption>
      </figure>
      <figure class="group">
        <div><a class="imgover" href="#"><img src="images/demo/index.jpg<<" alt=""></a></div>
        <figcaption>
          <h6 class="heading">Pharetra libero nisi</h6>
          <p>Vel diam maecenas mattis massa nec rutrum mattis leo felis posuere eros eget elementum tortor leo non enim praesent id metus in auctor enim a tortor nunc laoreet.</p>
          <footer><a class="btn" href="#">View Details</a></footer>
        </figcaption>
      </figure>
    </div>
    <div class="clear"></div>
  </main>
</div>
<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/02.png');">
</div>
<div class="wrapper row2">
</div>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    
    <ul class="nospace group latest">
     
    </ul>
  </section>
</div>
<div class="wrapper bgded" style="background-image:url('images/demo/contact.jpg');">
  <section id="callback" class="hoc clear"> 
    <div>
      <h6 class="heading">Contact With Us!</h6>
      <p class="btmspace-30">If you would like to now news subsrice to our website.</p>
      <form method="post" action="#">
        <fieldset>
          <input type="text" value="" placeholder="Name">
          <input type="text" value="" placeholder="Email">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
    </div>
  </section>
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
    <p class="fl_right">Template by <a target="_blank" href="#" title="Free Website Templates">Ufuk Barış Tunca</a></p>
  </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>