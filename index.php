<?php

require_once "controller/controller.php";
require_once "controller/routes.php";
require_once "models/model.php";

$mvc = new MvcController();
$mvc->manageMainRoutes();

?>