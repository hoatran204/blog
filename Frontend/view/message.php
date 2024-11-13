<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/assets/css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php' ?>
  <div class="hdt">
      <div class="hdt1">
          <div class="hdt11">
              <div class="hdt111">Đoạn chat</div>
              <div class="hdt112">
                  <i class="fa fa-search"></i>
                  <input type="text" id="hdt113" placeholder="Tìm kiếm.....">
              </div>
          </div>
          <div class="hdt12">
              <h3>Tin nhắn</h3><?php
                    require_once "BackEnd/Controller/C_user.php";
                    $user = new C_user();
                    $id = $_SESSION['userid'];
                    $friend = $user->friend($id);

                    if (is_array($friend) || is_object($friend)) {
                        if (count((array)$friend) > 0) {
                            foreach ($friend as $fr): ?>
              <div class="hdt121">
                        <div class="hdt122">
                            <img src="assets/images/1.png" alt="User Avatar">
                        </div>
                        <a class="hdt123" href="?action=message&friend_id=<?php echo $fr['user_id']; ?>">
                                        <div class="name"><?php echo isset($fr['username']) ? $fr['username'] : 'Không có tên'; ?></div>


                            <div class="status">Đang hoạt động</div>
                        </a>
              </div>
                            <?php
                            endforeach;
                        } else {
                            echo "Không có bạn bè nào!";
                        }
                    } else {
                        echo "Dữ liệu không hợp lệ!";
                    }
                    ?>
          </div>
      </div>
      
      <div class="hdt2">
          <div class="hdt21">
              <div class="hdt211">
                  <img src="assets/images/1.png" alt="Chat Avatar">
              </div>
              <div class="hdt212">
    <div class="hdt2121">
        <?php
        require_once "BackEnd/Controller/C_user.php";
        $user = new C_user();
        $user_id = $_GET['friend_id'] ?? null;
        $mess = $user->getfriend($user_id);

        if (is_array($mess) || is_object($mess)) {
            if (count((array)$mess) > 0) {
                foreach ($mess as $m): 
        ?>
                    <div class="name">
                        <?php echo isset($m['username']) ? $m['username'] : ''; ?>
                    </div>
                    <div class="hdt2122">
                        Đang hoạt động
                    </div>
        <?php
                endforeach;
            } else {
                echo "Không có bạn bè nào!";
            }
        } else {
            echo "Dữ liệu không hợp lệ!";
        }
        ?>
    </div>
</div>

              <div class="hdt213">
                  <button><i class="fa-solid fa-phone"></i></button>
                  <button><i class="fa-solid fa-video"></i></button>
                  <button><i class="fa-solid fa-circle-info"></i></button>
              </div>
          </div>
          <div class="message-box">
    <?php
    require_once "BackEnd/Controller/C_user.php";
    $user = new C_user();
    $id = $_SESSION['userid'];
    $user_id = $_GET['friend_id'] ?? null;
    $mess = $user->getMessagesByUserId($id, $user_id);

    if (is_array($mess) || is_object($mess)) {
        if (count((array)$mess) > 0) {
            foreach ($mess as $m):
                $isUserSender = ($m['sender_type'] == $id);
    ?>
                <div class="message-container <?php echo $isUserSender ? 'right' : 'left'; ?>">
                    <div class="name">
                        <?php echo isset($m['msg']) ? $m['msg'] : 'Không có tin nhắn'; ?>
                    </div>
                </div>
    <?php
            endforeach;
        } else {
            echo "Không có tin nhắn nào!";
        }
    } else {
        echo "Dữ liệu không hợp lệ!";
    }
    ?>
</div>


          <form class="hdt23" id="formnhantin" action="?action=nhantin" method="post">
              <input type="text" placeholder="Nhắn tin..." name="message">
              <button type="submit">Gửi</button>
              <div id="errorMessages"></div>
          </form>
      </div>
  </div>
  <script>
    const form = document.getElementById('formnhantin');
const errorMessagesDiv = document.getElementById('errorMessages');

form.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);

    xhr.onload = function () {
        console.log("Mã phản hồi: " + xhr.status); // Kiểm tra mã HTTP phản hồi

        if (xhr.status === 200) {
            console.log("Phản hồi từ server: ", xhr.responseText); // Xem nội dung phản hồi
            try {
                const response = JSON.parse(xhr.responseText);
                
                if (response.error) {
                    errorMessagesDiv.innerHTML = response.error.join('<br>'); // Hiển thị lỗi từ server
                } else if (response.success) {
                    window.location.href = response.redirect; // Chuyển hướng (nếu có)
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        } else {
            console.error("Có lỗi trong yêu cầu AJAX. Mã lỗi: ", xhr.status);
            errorMessagesDiv.innerHTML = "Không thể gửi yêu cầu, vui lòng thử lại.";
        }
    };

    xhr.send(formData);
});

  </script>
</body>
</html>
