<?php

class Routes {

    public function userRoutes($route) {
        switch($route) {
            case "home":
            $module = "views/pages/articles.php";
            break;
            case "about":
            $module = "views/pages/about.php";
            break;
            case "article":
            $module = "views/pages/article.php";
            break;
            default:
            $module = "views/pages/articles.php";
            break;
        }
        return $module;
    }

    public function adminRoutes($route) {
        switch($route) {
            case "dashboard":
            $module = "views/admin/dashboard.php";
            break;
            case "login":
            $module = "views/admin/login.php";
            break;
            case "signup":
            $module = "views/admin/signup.php";
            break;
            case "newpost":
            $module = "views/admin/newpost.php";
            break;
            case "editpost":
            $module = "views/admin/editpost.php";
            break;
            case "settings":
            $module = "views/admin/settings.php";
            break;
            default:
            $module = "views/admin/dashboard.php";
            break;
        }
        return $module;
    }

}

?>