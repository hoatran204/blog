<?php 
class C_user {
    public function modelUser() {
        require_once "BackEnd/Model/M_user.php";
        $modeluser = new M_user();
        return $modeluser;
    }
    public function login() {
        $error = [];
        $success = [];
    
        // Kiểm tra xem có gửi email và password không
        if (isset($_POST['loginemail']) && isset($_POST['password'])) {
            $email = $_POST['loginemail'];
            $password = $_POST['password'];
    
            // Kiểm tra nếu là admin
            if ($email == 'admin@gmail.com' && $password == '123456') {  // Sửa dấu "=" thành "=="
                $success[] = 'Vào trang admin';
                $_SESSION['role'] = 'admin'; // Lưu vai trò admin vào session
            } else {
                // Kiểm tra đăng nhập
                if (!$this->modelUser()->CheckDangNhap($email, $password)) {
                    $error[] = 'Email hoặc mật khẩu không chính xác';
                } else {
                    // Nếu đăng nhập thành công, lấy thông tin người dùng
                    $id = $this->modelUser()->selectuser("user_id", $email);
                    $name = $this->modelUser()->selectuser("username", $email);
                    $img = $this->modelUser()->selectuser("profile_picture", $email);
                    $bio = $this->modelUser()->selectuser("bio", $email);
    
                    // Lưu thông tin vào session
                    $_SESSION['userid'] = $id;
                    $_SESSION['username'] = $name;
                    $_SESSION['img'] = $img;
                    $_SESSION['bio'] = $bio;
                    $_SESSION['role'] = 'user'; // Lưu vai trò user vào session
                    // Gửi phản hồi thành công
                    $success[] = 'Đăng nhập thành công';
                }
            }
        } else {
            $error[] = 'Vui lòng nhập thông tin đăng nhập.';
        }
    
        // Trả về JSON cho AJAX
        header('Content-Type: application/json'); // Đảm bảo trả về JSON
        if (!empty($error)) {
            echo json_encode(['error' => $error]);
        } elseif (!empty($success)) {
            // Kiểm tra nếu là admin hay user để trả về redirect tương ứng
            if ($_SESSION['role'] == 'admin') {
                echo json_encode(['success' => $success, 'redirect' => '?action=admin']);
            } else {
                echo json_encode(['success' => $success, 'redirect' => '?action=trangchu']);
            }
        }
        exit(); // Dừng lại sau khi gửi phản hồi
    }
    
    
    public function Logout() {
        // Xóa tất cả các biến session
        session_unset();

        // Hủy session
        session_destroy();
        header("Location: ?");
        exit();
    }
    public function update() {
        $error = [];
        $success = [];
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $bio = $_POST['bio'] ?? null;
        $file = $_FILES['profile_picture'] ?? null;

        if (trim($username) == null && trim($email) == null && trim($bio) == null && empty($file['name'])) {
            $error[] = "Vui lòng điền thông tin cập nhật.";
        }
         else {
            // Cập nhật từng trường nếu có giá trị
            if (!empty($username)) {
                    $this->modelUser()->updateuser('username', $username);
                    $_SESSION['username'] = $username;
                    $success[] = "Thành công";
            } 
            if (!empty($email)) {
                // Kiểm tra xem email có hợp lệ không
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->modelUser()->updateuser('email', $email);
                    $success[] = "Thành công";
                } else {
                    // Email không hợp lệ
                    $error[] = "Email không hợp lệ.";
                }
            } 
            if (!empty($bio)) {
                if (strlen($bio) <= 50) {
                    $this->modelUser()->updateuser('bio', $bio);
                    $_SESSION['bio'] = $bio;
                    $success[] = "Thành công";
                } else {
                    $error[] = "Bio không được dài quá 50 ký tự.";
                }
            }
            

            // Kiểm tra và xử lý tệp ảnh
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                // Kiểm tra xem tệp có phải là hình ảnh không
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($file['tmp_name']);

                if (in_array($fileType, $allowedTypes)) {
                    $uploadDir = "Frontend/assets/imgavt/";
                    $fileName = pathinfo($file['name'], PATHINFO_FILENAME);  // Lấy tên file mà không có phần mở rộng
                    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $uniqueFileName = $fileName . '_' . time() . '.' . $fileExt;  // Kết hợp tên file với timestamp
                    $uploadFilePath = $uploadDir . $uniqueFileName;

                    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
                        // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                        $this->modelUser()->updateuser('profile_picture', $uploadFilePath);
                        $_SESSION['img'] = $uploadFilePath;
                        $success[] = "Thành công";
                    } else {
                        $error[] = "Không thể tải ảnh lên.";
                    }
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
    public function signin() {
        $error = [];
        $success = [];
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $pass = $_POST['pass'] ?? null;
        $img = "Frontend/assets/imgavt/default.jpg";

        if (trim($name) == null or trim($email) == null or trim($pass) == null) {
            $error[] = "Vui lòng nhập đầy đủ thông tin.";
        } else {
            if ($this->modelUser()->checkemail($email)) {
                $error[] = "Email đã tồn tại";
            } elseif (strlen($pass) < 8 || preg_match('/\s/', $pass)) {
                $error[] = 'Mật khẩu phải có tối thiểu 8 ký tự và không có dấu cách';
            } else {
                $value = "'$name', '$email', '$pass', '$img'";
                $this->modelUser()->Insert($value);
                $id = $this->modelUser()->selectuser("user_id", $email);
                $bio = $this->modelUser()->selectuser("bio", $email);
    
                // Lưu thông tin vào session
                $_SESSION['userid'] = $id;
                $_SESSION['username'] = $name;
                $_SESSION['img'] = $img;
                $_SESSION['bio'] = $bio;
                $success[] = "Đăng ký thành công";
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
    public function ortherUser(){
        return $this->modelUser()->orther();
    }
    public function num_follow($id) {
        return $this->modelUser()->follow($id);
    }
    public function num_follower($id) {
        return $this->modelUser()->follower($id);
    }
    public function following($id1, $id2) {
        return $this->modelUser()->following($id1, $id2);
    }
    public function TheoDoi() {
        $id1= $_SESSION['userid'];
        $id2 = $_GET['id'];
        if (!$this->following($id1, $id2)) {
            $this->modelUser()->InsertFollow($id1, $id2);
        } else {
            $this->modelUser()->DeleteFollow($id1, $id2);
        }
        header("Location: ?action=taikhoankhac&id=" . $id2);
        exit;
    }
    public function Email() {
        if (isset($_POST['email'])) {
            $error = [];
            $success = [];
            $_SESSION['tempEmail'] = $_POST['email'];
            $tempEmail = $_POST['email'];
            
            // Kiểm tra email và gửi mã xác thực nếu hợp lệ
            if ($this->modelUser()->checkemail($tempEmail)) {
                require "bACKeND/PHPMailer-master/src/PHPMailer.php";
                require "bACKeND/PHPMailer-master/src/SMTP.php";
                require 'bACKeND/PHPMailer-master/src/Exception.php';
                
                $mail = new PHPMailer\PHPMailer\PHPMailer(true); // true: enables exceptions
                try {
                    $mail->SMTPDebug = 0; // Tắt chế độ debug
                    $mail->isSMTP();
                    $mail->CharSet = "utf-8";
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ttnh13102004@gmail.com';
                    $mail->Password = 'vjpm tsqu hjtz brus';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('ttnh13102004@gmail.com', 'FasrFood');
                    $mail->addAddress($tempEmail, 'User');
                    $mail->isHTML(true);
                    $mail->Subject = 'Mã xác thực';
                    $noidungthu = rand(1000, 9999);
                    $mail->Body = $noidungthu;
                    
                    $mail->smtpConnect([
                        "ssl" => [
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        ]
                    ]);
                    
                    $mail->send();
                    $this->modelUser()->SaveCode($noidungthu, $tempEmail);
                    $success[] = "Thành công";
                } catch (Exception $e) {
                    $error[] = "Gửi email thất bại: " . $e->getMessage();
                }
            } else {
                $error[] = "Email không tồn tại trong hệ thống.";
            }
            
            // Cài đặt header JSON và tạo phản hồi
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
    public function XacMinh() {
        $vercode = trim($_POST['vercode']);
        $error = [];
        $success = [];
        if ($vercode === $this->modelUser()->XacMinh()) {
            $success[] = "Mã xác minh chính xác.";
        } else {
            $error[] = "Mã xác minh sai. Vui lòng nhập lại.";
        }
        // Cài đặt header JSON và tạo phản hồi
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
    public function Matkhaumoi() {
        $pass = $_POST['pass'];
        $error = [];
        $success = [];
        if (strlen($pass) < 8 || preg_match('/\s/', $pass)) {
            $error[] = 'Mật khẩu phải có tối thiểu 8 ký tự và không có dấu cách';
        } else {
            $this->modelUser()->NewPass($pass);
            $success[] = "Thành công.";
        }
        // Cài đặt header JSON và tạo phản hồi
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
    
    public function friend($id) {
        return $this->modelUser()->friend($id);
    }
    public function getfriend($id) {
        return $this->modelUser()->getfriend($id);
    }

    public function getMessagesByUserId($currentUserId, $friendId) {
        return $this->modelUser()->getMessages($currentUserId, $friendId);
    }
}
?>