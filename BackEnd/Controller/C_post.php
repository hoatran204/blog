<?php 
class C_post {
    public function model() {
        require_once "BackEnd/Model/M_post.php";
        $model = new M_post();
        return $model;
    }
    public function posting() {
        $error = [];
        $success = [];
        $file = $_FILES['file-upload'] ?? null;
        $title = $_POST['title'] ?? null;
        $tag = $_POST['tags']?? null;
        $content = $_POST['content'] ?? null;
        $uploadFilePath = ''; // Khai báo biến để tránh lỗi khi không có ảnh
    
        if (empty($file['name']) or trim($title) == null or trim($tag) == null or trim($content) == null) {
            $error[] = "Vui lòng nhập thông tin.";
        } else {
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                // Kiểm tra xem tệp có phải là hình ảnh không
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($file['tmp_name']);
                $maxFileSize = 1 * 1024 * 1024; // 1MB
                if ($file['size'] > $maxFileSize) {
                    $error[] = "Dung lượng ảnh vượt quá giới hạn 1MB.";
                }
                elseif (in_array($fileType, $allowedTypes)) {
                    $uploadDir = "Frontend/assets/imgpost/";
                    $fileName = pathinfo($file['name'], PATHINFO_FILENAME);  // Lấy tên file mà không có phần mở rộng
                    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $uniqueFileName = $fileName . '_' . time() . '.' . $fileExt;  // Kết hợp tên file với timestamp
                    $uploadFilePath = $uploadDir . $uniqueFileName;
    
                    if (!move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
                        $error[] = "Không thể di chuyển tệp tải lên vào thư mục đích.";
                    }
                     $user_id = $_SESSION['userid'];
                    // Xử lý thêm bài viết vào cơ sở dữ liệu
                    $value = "'$user_id', '$title', '$content', '$tag', '$uploadFilePath'";
                    $this->model()->insert($value);
                    $success[] = "Đăng bài thành công.";
                } else {
                    $error[] = "Vui lòng chọn một tệp ảnh hợp lệ (JPEG, PNG hoặc GIF).";
                }
            } else if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $error[] = "Có lỗi xảy ra khi tải ảnh.";
            }
    
        }
    
        header('Content-Type: application/json'); // Đảm bảo trả về JSON

        if (!empty($error)) {
            echo json_encode(['error' => $error]);
        } elseif (!empty($success)) {
           
            echo json_encode(['success' => $success, 'redirect' => '?action=trangchu']);
        }
        exit();
    }
    public function nhantin() {
        // Mảng lỗi và thành công
        $error = [];
        $success = [];
    
        // Lấy dữ liệu từ POST
        $follower_id = $_SESSION['userid']?? null;
        $user_id = $_GET['friend_id'] ?? null;
        $message = $_POST['message'] ?? null;
        // Kiểm tra dữ liệu được gửi lên có hợp lệ không
        if (empty($message) || trim($message) == '') {
            $error[] = "Vui lòng nhập tin nhắn.";
        }
    
        // Nếu không có lỗi, thực hiện lưu tin nhắn
        if (empty($error)) {
            $message = htmlspecialchars(trim($message));
            // Giả sử $this->model()->insertmess() là phương thức lưu vào database
            $value = "'$user_id', '$follower_id', '$message', $user_id";
            $this->model()->insertmess($value);
    
            // Nếu lưu thành công, thông báo thành công
            $success[] = "Tin nhắn đã được gửi thành công!";
        }
    
        // Trả về kết quả dưới dạng JSON
        header('Content-Type: application/json');
        if (!empty($error)) {
            echo json_encode(['error' => $error]);
        } elseif (!empty($success)) {
            echo json_encode(['success' => $success]);
        }
        exit();
    }
    public function post() {
       return $this->model()->getPosts();
    }
    public function getpostUser($id) {
        return $this->model()->getPostsUser($id);
    }
    public function post_details() {

        return $this->model()->PostDetail();
    }
    public function count($id) {
        return $this->model()->count($id);
    }
    public function likes() {
        return $this->model()->Like($_GET['id']);
    }
    public function is_like() {
        return $this->model()->Liked($_GET['id'], $_SESSION['userid']) == 1;
    }
    public function liked() {
        if ($this->is_like()) {
            $this->model()->DeleteLike($_GET['id'], $_SESSION['userid']);
        } else {
            $this->model()->InsertLike($_GET['id'], $_SESSION['userid']);
        }
        header("Location: ?action=baiviet&id=".$_GET['id']);
    }
    public function shares() {
        return $this->model()->Share($_GET['id']);
    }
    public function is_share() {
        return $this->model()->Shared($_GET['id'], $_SESSION['userid']) == 1;
    }
    public function Shared() {
        if ($this->is_share()) {
            $this->model()->DeleteShare($_GET['id'], $_SESSION['userid']);
        } else {
            $this->model()->InsertShare($_GET['id'], $_SESSION['userid']);
        }
        header("Location: ?action=baiviet&id=".$_GET['id']);
    }
    public function InterestedPost($id) {
        return $this->model()->InterestedPost($id);
    }
    public function hotpost() {
        return $this->model()->hotpost();
    }
    public function LuotShare($id) {
        return $this->model()->sharing($id);
    }
    public function postcmt() {
        if (isset($_POST['cmt'])) {
            $cmt = $_POST['cmt'];
            $value = "{$_GET['id']}, {$_SESSION['userid']}, '$cmt'";
            $error = [];
            $success = [];
            if (!empty($cmt)) {
                $this->model()->cmt($value);
                $success[] = "Thành công";
            } else {
                $error[] = "Bạn chưa nhập gì";
            }
            header('Content-Type: application/json');
            $response = [];
            
            if (!empty($success)) {
                $response['success'] = true;
            } else {
                $response['error'] = $error;
            }
            
            echo json_encode($response);
            exit();
        }
    }
    public function showcmt() {
        $id = $_GET['id'];
        return $this->model()->Showcmt($id);
    }
    public function TongBL() {
        return $this->model()->Sobl();
    }
    public function islikecmt ($id) {
        return $this->model()->islikecmt($id) ==1;
    }
    public function likecmt() {
        header('Content-Type: application/json');  
        // Kiểm tra và lấy thông tin từ $_POST (vì đang sử dụng AJAX POST)
        $cmt_id = isset($_POST['id']) ? $_POST['id'] : null;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        
        // Kiểm tra giá trị đầu vào
        if (!$cmt_id || !$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            exit();
        }
    
        // Kiểm tra xem người dùng đã like comment chưa
        if (!$this->islikecmt($cmt_id)) {
            // Nếu chưa like, thực hiện like comment
            $value = "$cmt_id, 'like', $user_id";
            $this->model()->likeComment($value); // Thêm vào CSDL
            echo json_encode(['status' => 'success', 'action' => 'like']);
        } else {
            // Nếu đã like, thực hiện unlike comment
            $value = "cmt_id=$cmt_id and type='like' and user_id = $user_id";
            $this->model()->deletelikecmt($value); // Xóa khỏi CSDL
            echo json_encode(['status' => 'success', 'action' => 'unlike']);
        }
    
        // Kết thúc
        exit();
    }
    public function countlike($id) {
        return $this->model()->Countlike($id);
    }
    
    public function phanhoi() {
        $error = [];
        $success = [];
        $cmtid = $_GET['id'];
        $userid = $_SESSION['userid'];
        $content = $_POST['content'];
        $value= "$cmtid, $userid, 'rep', '$content'";
        if (empty($content)) {
            $error[] = "Phải điền thông tin";
        } else {
            $this->model()->phanhoi($value);
            $success[] = "Thành công";
        }
        header('Content-Type: application/json');
            $response = [];
            
            if (!empty($success)) {
                $response['success'] = true;
            } else {
                $response['error'] = $error;
            }
            
            echo json_encode($response);
            exit();
    }
    public function repcmt($id) {
        return $this->model()->traloi($id);
    }
    
}
?>