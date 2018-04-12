<?php
session_start();
if (!$_SESSION["logged"]) {
	header("location:index.php?admin=login");
	exit();
}
?>

<?php
    if ($_GET["admin"] == "dashboard" || $_GET["admin"] == "") {
            include "views/admin/posts.php";
    }
?>