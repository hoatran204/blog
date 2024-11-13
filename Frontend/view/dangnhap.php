
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/dangnhap.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container" id="sign-up">
            <form id="signupForm" action="?action=dangky" method="POST">
                <h1>Đăng ký</h1>
                <input name="name" type="text" placeholder="Name" />
                <input name="email" type="text" placeholder="Email" />
                <input name="pass" type="password" placeholder="Password" />
                <div id="errorMessagesDK"></div>   
                <button type="submit">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container" id="sign-in">
        <form id="loginForm" action="?action=login" method="POST">
            <h1>Đăng nhập</h1>
            <input name="loginemail" type="text" placeholder="Email" id="loginemail"/>
            <input name="password" type="password" placeholder="Password" id="loginpassword"/>
            <div id="errorMessages"></div>            
            <a id="qmk">Quên mật khẩu?</a>
            <button type="submit" id="submitButton">Đăng nhập</button>
        </form>

        </div>
        <div class="form-container sign-up-container" id="password">
            <form action="?action=email" method="post" id="emailForm">
                <h1>Nhập email của bạn</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input name="email" type="email" placeholder="Email" />
                <p id="errorMessagesEmail"></p>
                <button type="submit" id="nextStep">Tiếp</button>
            </form>
        </div>
        <div class="form-container sign-up-container" id="password2">
            <form action="?action=Vcode" method="post" id="verForm">
                <h1>Enter the verification code</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input name="vercode" type="text" placeholder="Mã xác minh" />
                <p id="errorCode"></p>
                <button type="submit" id="nextStep2">Tiếp</button>
            </form>
        </div>
        <div class="form-container sign-up-container" id="password3">
            <form action="?action=newpass" method="post" id="newpass">
                <h1>Enter a new password</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input name = "pass" type="text" placeholder="mật khẩu mới" />
                <p id="errorpass"></p>
                <button>xác nhận</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Đã có tài khoản, hãy đăng nhập</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Nếu chưa có tài khoản, hãy đăng ký</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
     
</body>
<script src="Frontend/assets/js/dangnhap.js"></script>
</html>