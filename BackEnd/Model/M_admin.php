<?php
class M_admin {
    public function Connect() {
        require_once "BackEnd/Model/connect.php";
        $conn = new Connect();
        return $conn;
    }
    public function AllPost() {
        $sql = "
            SELECT 
                posts.*, 
                users.username, 
                users.profile_picture, 
                COUNT(DISTINCT likes.like_id) AS total_likes, 
                COUNT(DISTINCT comments.comment_id) AS total_comments
            FROM posts
            JOIN users ON posts.user_id = users.user_id
            LEFT JOIN likes ON posts.post_id = likes.post_id
            LEFT JOIN comments ON posts.post_id = comments.post_id
            GROUP BY posts.post_id
            ORDER BY posts.post_id DESC
        ";
    
        return $this->Connect()->SelectTable($sql);
    }
    public function deletepost($id) {
        $value = "post_id=$id";
        return $this->Connect()->Delete('posts', $value);
    }
    public function deletecmt($id) {
        $value= "comment_id = $id";
        return $this->Connect()->Delete('comments', $value);
    }
    public function deleteuser($id) {
        $value= "user_id = $id";
        return $this->Connect()->Delete('users', $value);
    }
    public function showpost($id) {
        $sql = "select * from posts where posts.post_id= $id";
        return $this->Connect()->SelectTable($sql);
    }
    public function showbl() {
        $sql = "select * from comments
        order by comment_id DESC";
        return $this->Connect()->SelectTable($sql);
    }
    public function showuser() {
        $sql = "Select * from users
        order by user_id DESC";
        return $this->Connect()->SelectTable($sql);
    }
}
?>