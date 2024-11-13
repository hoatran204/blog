<?php
class M_user {
    public function connect() {
        require_once 'BackEnd/Model/connect.php';
        $conn = new Connect();
        return $conn;
    }
    public function CheckDangNhap($email,$password) {
        $conn = $this->connect()->connect();
        if (!$conn) {
            echo "Không thể thực hiện truy vấn. Kết nối chưa được thiết lập.";
            return false;
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }
    }
    public function selectuser($column,$value) {
        return $this->connect()->Select($column, 'users', 'email', $value);
    }
    public function updateuser($column, $value) {
        return $this->connect()->Update("users", $column, $value, "user_id", $_SESSION['userid']);
    }
    public function checkemail($email) {
        return $this->connect()->Check('users', 'email', $email);
    }
    public function Insert($value) {
        return $this->connect()->Insert($value, 'users(username, email, password, profile_picture)');
    }
    public function orther() {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id=$id";
        return $this->connect()->SelectTable($sql);
    }
    public function follow($id) {
        $sql = "SELECT COUNT(*) as total FROM follow Where user_id = $id";
        return $this->connect()->count($sql);
    }
    public function follower($id) {
        $sql = "SELECT COUNT(*) as total FROM follow Where follower_id = $id";
        return $this->connect()->count($sql);
    }
    public function following($id1, $id2) {
        $sql = "SELECT COUNT(*) as total FROM follow Where follower_id = $id1
         and user_id = $id2";
         return $this->connect()->count($sql) == 1;
    }
    public function InsertFollow($id1, $id2) {
        $table = "follow(follower_id, user_id)";
        $value = "'$id1', '$id2'";
        return $this->connect()->Insert($value, $table);
    }
    public function DeleteFollow($id1, $id2) {
        return $this->connect()->Delete("follow", "follower_id = $id1 and user_id=$id2");
    }
    public function SaveCode($code, $email) {
        return $this->connect()->Update("users", "code", $code, "email", $email);
    }
    public function XacMinh() {
        return $this->connect()->Select('code', 'users', 'email', $_SESSION['tempEmail']);
    }
    public function NewPass($pass) {
        return $this->connect()->Update("users", "password", $pass, "email", $_SESSION['tempEmail']);
    }
    public function friend($id) {
        $sql = "SELECT 
        u.user_id AS user_id,
        u.username AS username 
    FROM 
        follow f
    JOIN 
        users u ON f.user_id = u.user_id 
    WHERE 
        f.follower_id = $id;


                ";
            return $this->connect()->SelectTable2($sql);
        }
        
        public function getfriend($id) {
            $sql = "SELECT 
                u.username AS user_name
            FROM 
                users u
            WHERE 
                u.user_id = $id;
    
    
                    ";
                return $this->connect()->SelectTable2($sql);
            }
    public function getMessages($currentUserId, $friendId) {
        $sql = "
        SELECT m.msg, m.sender_type
        from messages m
        WHERE (m.user_id = $currentUserId AND m.follower_id = $friendId)
           OR (m.user_id = $friendId AND m.follower_id = $currentUserId)
        ";
        return $this->connect()->SelectTable2($sql);
    }
}
?>