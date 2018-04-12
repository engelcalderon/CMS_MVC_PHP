<h4>Posts</h4>

<div class="container col-md-12">

<a href="index.php?admin=newpost" class="newpost-btn btn cur-p btn-primary">New Post</a>

<table class="table">

<thead class="thead-dark">

    <tr>
        <th>id</th>
        <th>title</th>
        <th>content</th>
        <th>author</th>
        <th>edit</th>
        <th>delete</th>
    </tr>

</thead>

<tbody>
    <?php
        $mvc = new MvcController();
        $mvc->showPostsController();
    ?>
</tbody>

</table>
</div>

<?php
        $mvc->deletePostController();
?>