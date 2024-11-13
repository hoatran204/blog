<?php
class M_post {
    public function Connect() {
        require_once "BackEnd/Model/connect.php";
        $conn = new Connect();
        return $conn;
    }
    public function insert($value) {
        return $this->Connect()->Insert($value,'posts(user_id, tittle, content, tag, image)');
    }
    
    public function insertmess($value) {
        return $this->Connect()->Insert($value,'messages(user_id,follower_id, msg, sender_type)');
    }
    public function select($column,$value) {
        return $this->connect()->Select($column, 'posts', 'email', $value);
    }
    public function getPosts() {
        $sql = "SELECT posts.*, users.* FROM posts AS posts 
                LEFT JOIN users ON posts.user_id = users.user_id
                ORDER BY posts.post_id DESC";
        return $this->Connect()->SelectTable($sql);
    }
    public function getPostsUser($id) {
        $sql = "SELECT posts.*, users.* 
                FROM posts 
                LEFT JOIN users ON posts.user_id = users.user_id 
                WHERE posts.user_id = $id";
        return $this->connect()->SelectTable($sql);
    }
    public function PostDetail() {
        $id = $_GET['id'];
        $_SESSION['postid'] = $id;
        $sql = "SELECT posts.*, users.* 
        FROM posts AS posts 
        LEFT JOIN users ON posts.user_id = users.user_id 
        WHERE posts.post_id = $id";
        return $this->Connect()->SelectTable($sql);
    }
    public function count($id) {
        $sql = "SELECT COUNT(*) as total FROM posts Where user_id = $id";
        return $this->Connect()->count($sql);
    }
    public function Like($id) {
        $sql = "SELECT COUNT(*) as total FROM likes Where post_id = $id";
        return $this->Connect()->count($sql);
    }
    public function Liked($post_id, $user_id) {
        $sql = "SELECT COUNT(*) as total FROM likes Where post_id = $post_id and
        user_id = $user_id";
        return $this->Connect()->count($sql);
    }
    public function InsertLike($post_id, $user_id) {
        return $this->Connect()->Insert("$post_id, $user_id", "likes(post_id, user_id)");
    }
    public function DeleteLike($post_id, $user_id) {
        return $this->Connect()->Delete("likes", "post_id=$post_id and user_id=$user_id");
    }
    public function Share($id) {
        $sql = "SELECT COUNT(*) as total FROM share Where post_id = $id";
        return $this->Connect()->count($sql);
    }
    public function Shared($post_id, $user_id) {
        $sql = "SELECT COUNT(*) as total FROM share Where post_id = $post_id and
        user_id = $user_id";
        return $this->Connect()->count($sql);
    }
    public function InsertShare($post_id, $user_id) {
        return $this->Connect()->Insert("$post_id, $user_id", "share(post_id, user_id)");
    }
    public function DeleteShare($post_id, $user_id) {
        return $this->Connect()->Delete("share", "post_id=$post_id and user_id=$user_id");
    }
    public function InterestedPost($user_id) {
        $sql= "SELECT * FROM posts
            JOIN likes ON posts.post_id = likes.post_id
            JOIN users ON posts.user_id = users.user_id
            WHERE likes.user_id = $user_id";
        return $this->Connect()->SelectTable($sql);
    }
    public function sharing($id) {
        $sql = "Select * from posts
        join share on posts.post_id = share.post_id
        join users on posts.user_id = users.user_id
        where share.user_id = $id";
        return $this->Connect()->SelectTable($sql);
    }
    public function hotpost() {
        $sql = "
            SELECT posts.*, COUNT(likes.like_id) AS total_likes
            FROM posts
            LEFT JOIN likes ON posts.post_id = likes.post_id
            WHERE posts.created_at >= NOW() - INTERVAL 2 DAY
            GROUP BY posts.post_id
            ORDER BY total_likes DESC
            LIMIT 2;
        ";
    
        return $this->Connect()->SelectTable($sql);
    }
    public function cmt($value) {
        return $this->Connect()->Insert($value, "comments(post_id, user_id, content)");
    }
    public function Showcmt($id) {
        $sql = "Select * from comments 
        join users on users.user_id = comments.user_id
        where comments.post_id=$id
        ORDER BY comment_id DESC";
        return $this->Connect()->SelectTable($sql);
    }
    public function Sobl() {
        $id = $_GET['id'];
        $sql = "SELECT COUNT(*) as total FROM comments Where post_id = $id";
        return $this->Connect()->count($sql);
    }
    public function likeComment($value) {
        return $this->Connect()->Insert($value, "repandlikecmt(cmt_id, type, user_id)");
    }
    public function deletelikecmt($value) {
        return $this->Connect()->Delete('repandlikecmt', $value);
    }
    public function islikecmt($id) {
        $user_id = $_SESSION['userid'];
        $sql = "SELECT COUNT(*) as total FROM repandlikecmt Where cmt_id = $id and type = 'like'
        and user_id = $user_id ";
        return $this->Connect()->count($sql) ;
    }
    public function Countlike($id) {
        $sql = "SELECT COUNT(*) as total FROM repandlikecmt Where cmt_id = $id and type = 'like'";
        return $this->Connect()->count($sql) ;
    }
    public function phanhoi($value) {
        return $this->Connect()->Insert($value, "repandlikecmt(cmt_id, user_id, type, content)");
    }
    public function traloi($id) {
        $sql = "select * from repandlikecmt
        join users on repandlikecmt.user_id = users.user_id
        where repandlikecmt.cmt_id = $id and type='rep'";
        return $this->Connect()->SelectTable($sql);
    }
}
?>