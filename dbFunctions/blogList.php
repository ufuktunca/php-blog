<?php 




interface categories{
	public function getTitle();
	public function getCategoryIcon();	
}


class Sport implements categories{

	public $title;

public function __construct($title){
		$this->title = $title;
	}

public function getTitle(){
	echo $this->title;
}

	public function getCategoryIcon(){
		echo '<i class="fa-basketball-ball fa-fw fas"></i>';
	}
}

class Art implements categories{

	public $title;

public function __construct($title){
		$this->title = $title;
	}

public function getTitle(){
	echo $this->title;
}

	public function getCategoryIcon(){
		echo '<i class="fa-paint-brush fa-fw fas"></i>';
	}
}

class Book implements categories{

	public $title;

public function __construct($title){
		$this->title = $title;
	}

public function getTitle(){
	echo $this->title;
}

	public function getCategoryIcon(){
		echo '<i class="fa-book fa-fw fas"></i>';
	}
}

class Country implements categories{

	public $title;

public function __construct($title){
		$this->title = $title;
	}

public function getTitle(){
	echo $this->title;
}

	public function getCategoryIcon(){
		echo '<i class="fa-flag fa-fw fas"></i>';
	}
}


 ?>