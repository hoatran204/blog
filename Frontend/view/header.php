<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/header.css">
</head>
<body>
    <header class="header0">
        <header class="header">
            <div class="logo">
                <img src="Frontend/assets/images/logo.png" alt="">
            </div>
            <nav class="navbar">
                <a href="?action=trangchu">Trang chủ</a>
                <a href="?action=baiyeuthich">Đã thích</a>
                <a href="#*">Liên hệ</a>
                <a href="?action=dangbai">Đăng bài</a>
            </nav>
            <div class="search-icon">
                <a href="?action=taikhoan"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username'] ?></a>
                <div class="thongbao-container">
                    <i class="fa-solid fa-bell bell-icon" id="bell-icon"></i>
                    
                    <div class="thongbaonoidung" id="thongbaonoidung">
                        <div class="thongbao-header">Thông báo</div>

                        <a href="baiviet.php" class="thongbao-item">
                            <div class="thongbao-avatar">
                                <img src="assets/images/1.png" >
                            </div>
                            <div class="thongbao-content">
                                <h4>User 1</h4>
                                <p>Đã like bài viết của bạn</p>
                                <div class="thongbao-time">3 giờ trước</div>
                            </div>
                        </a>
                        <a href="baiviet.php" class="thongbao-item">
                            <div class="thongbao-avatar">
                                <img src="assets/images/1.png" >
                            </div>
                            <div class="thongbao-content">
                                <h4>User 1</h4>
                                <p>Đã comment bài viết của bạn</p>
                                <div class="thongbao-time">3 giờ trước</div>
                            </div>
                        </a>
                        <a href="taikhoankhac.php" class="thongbao-item">
                            <div class="thongbao-avatar">
                                <img src="assets/images/1.png" >
                            </div>
                            <div class="thongbao-content">
                                <h4>User 1</h4>
                                <p>Đã bắt đầu follow bạn</p>
                                <div class="thongbao-time">3 giờ trước</div>
                            </div>
                        </a>

                    </div>
                </div>
                <a href="?action=dangxuat">Đăng xuất</a>
            </div>
        </header>
    </header>
    <script >
        const header0 = document.querySelector('.header0');


        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header0.classList.add('scrolled'); 
            } else {
                header0.classList.remove('scrolled');
            }
        });

        const bellIcon = document.getElementById('bell-icon');
        const thongbaoNoidung = document.getElementById('thongbaonoidung');

        bellIcon.addEventListener('click', () => {
            thongbaoNoidung.style.display = 
                thongbaoNoidung.style.display === 'none' || thongbaoNoidung.style.display === '' 
                ? 'block' 
                : 'none';
        });

        document.addEventListener('click', (event) => {
            if (!thongbaoNoidung.contains(event.target) && !bellIcon.contains(event.target)) {
                thongbaoNoidung.style.display = 'none';
            }
        });

    </script>
</body>
</html>