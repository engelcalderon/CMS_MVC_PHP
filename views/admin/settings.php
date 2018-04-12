<h4>Settings</h4>

<div class="container col-md-12">

<form method="post">
    <?php
        $mvc = new MvcController();
        $mvc->userSettingsController();
    ?>
</form>

    <?php
        $mvc->updateUserSettingsController();
    ?>

</div>