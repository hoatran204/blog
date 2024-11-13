<?php
class C_admin {
    public function model() {
        require_once "BackEnd/Model/M_admin.php";
        $model = new M_admin();
        return $model;
    }
    public function Logout() {
        // Xóa tất cả các biến session
        session_unset();

        // Hủy session
        session_destroy();
        header("Location: ?");
        exit();
    }
    public function allpost() {
        return $this->model()->AllPost();
    }
    public function deletepost() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
    
            $result = $this->model()->deletepost($id);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Bài viết đã được xóa thành công.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể xóa bài viết.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID bài viết không hợp lệ.']);
        }
    }
    public function showbl() {
        return $this->model()->showbl();
    }
    public function deletecmt() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
    
            $result = $this->model()->deletepost($id);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Bài viết đã được xóa thành công.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể xóa bài viết.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID bài viết không hợp lệ.']);
        }
    }
    public function showusers() {
        return $this->model()->showuser();
    }
    public function deleteuser() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
    
            $result = $this->model()->deleteuser($id);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Bài viết đã được xóa thành công.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể xóa bài viết.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID bài viết không hợp lệ.']);
        }
    }
}
?>