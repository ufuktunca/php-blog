<?php 
session_start();
include "./dbConnect.php";


if (isset($_POST["register"])) {
	$name= $_POST["name"];
	$email= $_POST["email"];
	$password= $_POST["password"];
	$role = $_POST["role"];
	$encodedPassword = md5($password);
	$addUser = $db -> prepare("INSERT INTO user SET user_email=:email,user_password=:password,user_name=:name,user_role=:role");
	$isRegistered=$addUser->execute(array(
		"email" => $email,
		"password" => $encodedPassword,
		"name" => $name,
		"role" => $role
	));

	if ($isRegistered) {
		header("Location:../index.php?status=ok");
		exit;
	} else {
		echo $isRegistered;
		header("Location:../index.php?status=wrong");
		exit;
	}
	# code...
}


if (isset($_POST["login"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$encodedPassword = md5($password);

	$getUser = $db->prepare("SELECT * FROM user WHERE user_email=:email and user_password=:password");
	$isLogin = $getUser->execute(array(
		"email" => $email,
		"password" => $encodedPassword
	));
	
	if ($getUser->rowCount() == 1) {
		$_SESSION["user_email"]=$email;
		header("Location:../index.php?status=login");
		exit;
	} else {
		header("Location:../index.php?status=notLogin");
		exit;
	}
}

if(isset($_GET["logout"])){
			session_start();
		session_destroy();
		header("Location:../index.php?status=logout");
		exit;
}

if (isset($_POST["addBlog"])) {
	$imageName = ($_FILES["blog_image"]["name"]);
    $imageData = (file_get_contents($_FILES["blog_image"]["tmp_name"]));
    $imageType = ($_FILES["blog_image"]["type"]);
	$blogTitle = $_POST["blog_title"];
	$blogCategory= $_POST["blog_category"];
	$blogText = $_POST["blog_text"];
	$comment = "false";

	if (isset($_POST["comment"])) {
	$comment = "true";
	}

	$addBlog = $db->prepare("INSERT INTO blog SET blog_title=:blogTitle,blog_category=:blogCategory,blog_text=:blogText,blog_image=:blog_image,commentable=:comment,writer_email=:email");

	$isAdded = $addBlog->execute(array(
		"blog_image" => $imageData,
		"blogTitle" => $blogTitle,
		"blogCategory" => $blogCategory,
		"blogText" => $blogText,
		"comment" => $comment,
		"email" => $_SESSION["user_email"]
	));

	if($isAdded){
		header("Location:../createBlog.php?status=ok");
		exit;
	} else {
		header("Location:../createBlog.php?status=wrong");
		exit;
	}

}


if (isset($_POST["comment"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$comment = $_POST["commentText"];
	$blog_id = $_POST["blog_id"];

	$addComment = $db->prepare("INSERT INTO comment SET comment_name=:name,comment_email=:email,comment_text=:commentText,blog_id=:id");

	$isAdded = $addComment->execute(array(
		"name" => $name,
		"email" => $email,
		"commentText" => $comment,
		"id" => $blog_id,
	));

	if($isAdded){
		header("Location:../blog-page.php?id=$blog_id&status=ok");
		exit;
	} else {
		header("Location:../blog-page.php?id=$blog_id&status=wrong");
		exit;
	}
}


 ?>