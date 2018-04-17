<h4>New Post</h4>
<div class="container col-md-12">
<form class="post" method="post" id="newPost">
<h5>Title</h5>
<input type="text" class="inputValue" placeholder="title" name="title"><br><br>
<h5>Content</h5>
<textarea name="content" class="inputValue" form="newPost" cols="30" rows="10" placeholder="content"></textarea><br><br>
<input type="submit" class="btn cur-p btn-success" value="Publish">
</form>
</div>

<?php

$mvc = new MvcController();
$mvc->createPostController();

?>