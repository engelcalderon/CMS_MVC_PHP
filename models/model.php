<?php

require_once "DBConnection.php";

class Model {

    public function showArticlesModel() {
        $stmp = DBConnection::connect()->prepare("SELECT articles.id, title, SUBSTRING(`content`, 1, 94) as content, username as author 
        from articles left join users on articles.author=users.id");
        
        $stmp->execute();

        return $stmp->fetchAll();
    }

    public function showArticleModel($articleid) {
        $stmp = DBConnection::connect()->prepare("SELECT articles.id, title, content, username as author 
        from articles right join users on articles.author=users.id where articles.id = :articleid");
        
        $stmp->bindParam(":articleid", $articleid, PDO::PARAM_STR);

        $stmp->execute();

        return $stmp->fetch();
    }

    public function signupUserModel($data, $table) {
        $stmp = DBConnection::connect()->prepare("INSERT INTO $table (username, email, password) 
                                                VALUES(:username, :email, :password)");

        $stmp->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmp->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmp->bindParam(":password", $data["password"], PDO::PARAM_STR);

        if ($stmp->execute()) {
            return "success";
        } else {
            return "error";
        }

    }

    public function loginUserModel($data, $table) {
        $stmp = DBConnection::connect()->prepare("SELECT id, username, password FROM $table WHERE username = :username");

        $stmp->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmp->execute();

        return $stmp->fetch();
    }

    public function createPostModel($data, $table) {
        $stmp = DBConnection::connect()->prepare("INSERT INTO articles (title,content,author) VALUES
                                                (:title, :content, :author)");

        $stmp->bindParam(":title", $data["title"], PDO::PARAM_STR);
        $stmp->bindParam(":content", $data["content"], PDO::PARAM_STR);
        $stmp->bindParam(":author", $data["author"], PDO::PARAM_STR);
        
        if ($stmp->execute()) {
            return "success";
        } else {
            return "error";
        }
    }

    public function showPostsModel($author){
        $stmp = DBConnection::connect()->prepare("SELECT articles.id, SUBSTRING(`title`, 1, 30) as title, SUBSTRING(`content`, 1, 75) as content, username as author 
        from articles left join users on articles.author=users.id where users.id = :author");
        
        $stmp->bindParam(":author", $author, PDO::PARAM_STR);
        $stmp->execute();

        return $stmp->fetchAll();
    }

    public function editPostModel($id, $table){
        $stmp = DBConnection::connect()->prepare("SELECT id, title, content 
                                                    from $table where id=:id");
        
        $stmp->bindParam(":id", $id, PDO::PARAM_STR);
        $stmp->execute();

        return $stmp->fetch();
    }

    public function updatePostModel($data, $table) {
        $stmp = DBConnection::connect()->prepare("UPDATE $table SET title=:title,content=:content WHERE id=:id");

        $stmp->bindParam(":title", $data["title"], PDO::PARAM_STR);
        $stmp->bindParam(":content", $data["content"], PDO::PARAM_STR);
        $stmp->bindParam(":id", $data["id"], PDO::PARAM_STR);
        
        if ($stmp->execute()) {
            return "success";
        } else {
            return "error";
        }
    }

    public function deletePostModel($id, $table) {
        $stmp = DBConnection::connect()->prepare("DELETE FROM $table WHERE id=:id");

        $stmp->bindParam(":id", $id, PDO::PARAM_STR);

        if ($stmp->execute()) {
            return "success";
        } else {
            return "error";
        }
    }

    public function usersSettingsModel($id) {
        $stmp = DBConnection::connect()->prepare("SELECT * FROM users WHERE id=:id");
        $stmp->bindParam(":id", $id, PDO::PARAM_STR);
        $stmp->execute();
        return $stmp->fetch();
    }

    public function updateUserSettingsController($data) {
        $stmp = DBConnection::connect()->prepare("UPDATE users SET username=:username, email=:email, password=:password WHERE id=:id");

        $stmp->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmp->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmp->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmp->bindParam(":id", $data["id"], PDO::PARAM_STR);

        if ($stmp->execute()) {
            return "success";
        } else {
            return "error";
        }
    }
}

?>