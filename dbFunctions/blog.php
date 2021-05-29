<?php 

abstract class abstractBlog{
	public $title;
	public $blogText;

	 public function __construct($title,$blogText) {
    $this->title = $title;
    $this->blogText = $blogText;
  }

  abstract public function comments($sender,$text);
  abstract public function commentForm($id);

  public function getTitle(){
  echo $this->title;
  }

  public function getText(){
  	echo $this->blogText;
  }
}


class blogWithComment extends abstractBlog{
public function comments($sender,$text){
		echo ' <li>
            <article>
              <header>
                <figure class="avatar"><img src="./images/demo/avatar.png" alt=""></figure>
                <address>
                By <a href="#">'.$sender.'</a>
                </address>
              </header>
              <div class="comcont">
                <p>'.$text.'</p>
              </div>
            </article>
          </li>';
	}

  public function commentForm($id){
    echo ' <div class="one_third first">
            <label for="name">Name <span>*</span></label>
            <input type="text" name="name" id="name" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="email">Mail <span>*</span></label>
            <input type="email" name="email" id="email" value="" size="22" required>
          </div>
         <input type="hidden" value='.$id.' name="blog_id">
          <div class="block clear">
            <label for="comment">Your Comment</label>
            <textarea name="commentText" id="comment" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input type="submit" name="comment" value="Submit Form">
            &nbsp;
          </div>';
  }
}

class blogWithoutComment extends abstractBlog{
public function comments($sender,$text){
    echo ' <li>
            <article>
              <header>
                <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure>
                <address>
                By <a href="#">'.$sender.'</a>
                </address>
              </header>
              <div class="comcont">
                <p>'.$text.'</p>
              </div>
            </article>
          </li>';
  }

  public function commentForm($id){
    echo ' <div class="one_third first">
            <label for="name">Name <span>*</span></label>
            <input type="text" name="name" disabled="true" id="name" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="email">Mail <span>*</span></label>
            <input type="email"  disabled="true" name="email" id="email" value="" size="22" required>
          </div>
         <input type="hidden"  disabled="true" value='.$id.' name="blog_id">
          <div class="block clear">
            <label for="comment">Your Comment</label>
            <textarea name="commentText"  disabled="true" id="comment" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input type="submit"  disabled="true" name="comment" value="Submit Form">
            &nbsp;
          </div>';
  }
}

 ?>