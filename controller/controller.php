<?php

class MvcController {

    public function manageMainRoutes() {
        if (isset($_GET["admin"])) {
            include "views/admin/index.php";
        } else {
            include "views/pages/home.php";
        }
    }
    public function manageRoutes() {
        if (isset($_GET["action"])) {
            $route = $_GET["action"];
            $view = Routes::userRoutes($route);
            include $view;
        }
        elseif (isset($_GET["admin"])) {
            $route = $_GET["admin"];
            $view = Routes::adminRoutes($route);
            include $view;
            // call just one time that why I verify that is not in the login page or signup page
            // session was started in index
            if (!isset($_SESSION["logged"]) && $_GET["admin"] != "login" && $_GET["admin"] != "signup") {
                header("location:index.php?admin=login");
                exit();
            }
        } else {
            $view = Routes::userRoutes("index");
            include $view;
        }
    }

    public function showArticlesController() {
        $request = Model::showArticlesModel();

        foreach ($request as $row => $item) {
            /*echo "
                <h3><a href='index.php?action=article&id=".$item["id"]."'>".$item["title"]."</a></h3>
                <p>".$item["content"]."</p>
                <span>Posted by: ".$item["author"]."</span>
                <br><br>
            ";*/
            echo '
                <div class="col-lg-4"">
                <div class="card h-100">
                <img class="card-img-top" src="resources/images/article-card.svg">
                <div class="card-body">
                <h5 class="card-title">'.$item["title"].'</h5>
                <p class="card-text">'.$item["content"].'...</p>
                <ul class="article-footer">
                        <li><i class="fas fa-user"></i>'.$item["author"].'</li>
                        <li><a href="index.php?action=article&id='.$item["id"].'"><i class="fas fa-arrow-right"></i>Read more</a></li>
                    </ul>
                </div>
                    
                </div>
                </div>
            ';
        }
    }

    public function showArticleController() {
        if (isset($_GET["id"])) {

            $request = Model::showArticleModel($_GET["id"]);

            echo '
                <h3 class="title">'.$request["title"].'</h3>
                <img src="resources/images/article-card.svg"/>
                <p class="body">'.$request["content"].'</p>
                <span class="author">Author: '.$request["author"].'</span>
            ';

        }
    }
    
    public function signupUserController() {
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            
            $data = array(
                "username"=>$_POST["username"],
                "email"=>$_POST["email"],
                "password"=>$_POST["password"]
            );

            $request = Model::signupUserModel($data, "users");

            if ($request == "success") {
                $_SESSION["logged"]= true;
                header("location:index.php?admin=login");
            } else {
                echo '
                <br>
                <div class="alert alert-danger">
                    <strong>Error!</strong> Something is wrong.
                </div>
                ';
            }

        }
    }

    public function userLoginController() {
        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $data = array(
                "username"=>$_POST["username"],
                "password"=>$_POST["password"]
            );
            $request = Model::loginUserModel($data, "users");

            if ($_POST["password"] == $request["password"]) {
                $_SESSION["logged"]= true;
                $_SESSION["current-user"] = $request["id"];
                header("location:index.php?admin=dashboard");
            } else {
                $_SESSION["logged"]= false;
                $_SESSION["current-user"] = NULL;
                echo '
                <br>
                <div class="alert alert-danger">
                    <strong>Error!</strong> Username or password are wrong.
                </div>
                ';
            }
        }
    }

    public function userLogOutController() {
        if (isset($_GET["logout"])) {
            if ($_SESSION["logged"]) {
                $_SESSION["logged"] = false;
                $_SESSION["current-user"] = NULL;
                header("location:index.php?admin=login");
            } else {
                header("location:index.php?admin=login");
            }
        }
    }

    public function createPostController() {
        if(isset($_POST["title"]) && isset($_POST["content"])) {

            $currentUser = $_SESSION["current-user"];
            $data = array(
                "title"=>$_POST["title"],
                "content"=>$_POST["content"],
                "author"=>$_SESSION["current-user"]
            );
           
            $request = Model::createPostModel($data, "articles");

            if ($request == "success") {
                header("location:index.php?admin=dashboard");
            } else {
                echo "Something is wrong";
            }

        }
    }

    public function showPostsController() {
        $request = Model::showPostsModel($_SESSION["current-user"]);
        
        foreach ($request as $row => $item) {
            echo "<tr>
            <td>".$item["id"]."</td>
            <td>".$item["title"]."...</td>
            <td>".$item["content"]."...</td>
            <td>".$item["author"]."</td>
            <td><a href='index.php?admin=editpost&id=".$item["id"]."' class='btn cur-p btn-secondary'>Edit</a>
            <td><a href='index.php?admin=dashboard&deletepost=".$item["id"]."' class='btn cur-p btn-danger'>Delete</a>
            </tr>";
        }
       
    }

    public function editPostController() {
        if (isset($_GET["id"])) {
            
            $request = Model::editPostModel($_GET["id"], "articles");
            
            echo '
                <h5>Title</h5>
                <input type="text" class="inputValue" value="'.$request["title"].'" name="title"><br><br>
                <h5>Content</h5>
                <textarea name="content" class="inputValue" form="editPost" cols="30" rows="10">'.$request["content"].'</textarea><br><br>
                <input type="submit" class="btn cur-p btn-success" value="Publish">
            ';
        }
    }

    public function updatePostController() {
        if(isset($_POST["title"]) && isset($_POST["content"])) {
            
            $data = array(
                "title"=>$_POST["title"],
                "content"=>$_POST["content"],
                "id"=>$_GET["id"]
            );

            $request = Model::updatePostModel($data, "articles");
            
            if ($request == "success") {
                header("location:index.php?admin=dashboard");
            } else {
                echo "Something is wrong";
            }
        }
    }

    public function deletePostController() {
       if (isset($_GET["deletepost"])) {

        $request = Model::deletePostModel($_GET["deletepost"], "articles");

        if ($request == "success") {
            header("location:index.php?admin=dashboard");
        } else {
            echo "Something is wrong";
        }

       }
    }

    public function userSettingsController() {
        
        $request = Model::usersSettingsModel($_SESSION["current-user"]);
        
        echo '
            <h6>Username</h6>
            <input type="text" value="'.$request["username"].'" name="username"/><br><br>
            <h6>Email</h6>
            <input type="text" value="'.$request["email"].'" name="email"/><br><br>
            <h6>Password</h6>
            <input type="text" value="'.$request["password"].'" name="password"/><br><br>
            <input type="submit" class="btn cur-p btn-success" value="Save"/>
        ';
    }

    public function updateUserSettingsController() {
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            
            $data = array(
                "username"=>$_POST["username"],
                "email"=>$_POST["email"],
                "password"=>$_POST["password"],
                "id"=>$_SESSION["current-user"]
            );

            $request = Model::updateUserSettingsController($data);

            if ($request == "success") {
                header("location:index.php?admin=settings");
            } else {
                echo '
                    <br>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Something wrong happened.
                    </div>
                ';
            }
        }
    }

}

?>