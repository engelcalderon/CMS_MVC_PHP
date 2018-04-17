<div class="home-navigation">

    <div class="top-menu">
        <ul>
            <li><a href="index.php?admin=dashboard"><i class="fas fa-sign-in-alt"></i>Login</a></li>
            <li><a href="index.php?admin=signup"><i class="fas fa-user-plus"></i>Sign up</a></li>
        <ul>
    </div>

    <div class="menu-logo">
        <img src="resources/images/logo.png"/>
    </div>
<div class="main-menu">
<ul>
<li class="menu-item"><a href="index.php?action=home">Home</a></li>
<li class="menu-item"><a href="index.php?action=about">About</a></li>
<li class="menu-item"><a href="#">Services</a></li>
<li class="menu-item"><a href="#">Portfolio</a></li>
<li class="menu-item"><a href="#">Contact</a></li>
</ul>
</div>

<?php
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "home") {
            include "slider.php";
        }
    } else {
        include "slider.php";
    }
?>

</div>