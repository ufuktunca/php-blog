<?php 
include "dbConnect.php";

	class User{
	public $name;
	public $userName;

	public function __construct($name,$userName){
		$this->name = $name;
		$this->userName = $userName;
	}

	public function getName(){
		echo $this->name;
	}

	public function getUserName(){
		echo $this->userName;
	}

}

	class Blogger extends User{
		public $role;

		public function __construct($name,$userName,$role){
			$this->name = $name;
			$this->userName = $userName;
			$this->role = $role;
		}

		public function getRole(){
			echo $this->role;
		}

		public function blogButton(){
			echo '<li><a href="./createBlog.php">Write a blog</a></li>';
		}
	}

		class Reader extends User{
		public $role;

		public function __construct($name,$userName,$role){
			$this->name = $name;
			$this->userName = $userName;
			$this->role = $role;
		}

		public function getRole(){
			echo $this->role;
		}

		public function blogButton(){
			echo '<li><a href="#"><strike>Write a blog</strike></a></li>';
		}
	}



 ?>