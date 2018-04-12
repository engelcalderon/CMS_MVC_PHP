<h4>Edit Post</h4>

<div class="container col-md-12">
<form class="post" method="post" id="editPost">
    <?php
        $mvc = new MvcController();
        $mvc->editPostController();
    ?>
</form>
</div>

<?php

$mvc = new MvcController();
$mvc->updatePostController();

?>