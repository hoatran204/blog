const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const passwordButton = document.getElementById('qmk');
const nextStepBackButton = document.getElementById('nextStep');
const nextStep2Button = document.getElementById('nextStep2');
const signUpContainer = document.getElementById('sign-up');
const signInContainer = document.getElementById('sign-in');
const passwordContainer = document.getElementById('password');
const password2Container = document.getElementById('password2');
const password3Container = document.getElementById('password3');

signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
    signUpContainer.classList.remove('hidden');
    passwordContainer.classList.add('hidden');
    password2Container.classList.add('hidden');
    password3Container.classList.add('hidden'); 
});

signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
    password2Container.classList.add('hidden');
    password3Container.classList.add('hidden'); 
    signInContainer.classList.remove('hidden');
});
passwordButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
    signUpContainer.classList.add('hidden');
    passwordContainer.classList.remove('hidden');
    password2Container.classList.add('hidden');
    password3Container.classList.add('hidden'); 
});



const form = document.getElementById('loginForm');
const errorMessagesDiv = document.getElementById('errorMessages');

form.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    // Tạo đối tượng FormData từ form để gửi qua AJAX
    const formData = new FormData(form);

    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);

    // Khi yêu cầu thành công
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText); // Parse phản hồi JSON từ server
                
                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    errorMessagesDiv.innerHTML = response.error.join('<br>'); // Hiển thị lỗi
                } else if (response.success) {
                    // Kiểm tra vai trò và chuyển hướng theo từng trường hợp
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        }       
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});
const form2 = document.getElementById('signupForm');
const errorMessagesDiv2 = document.getElementById('errorMessagesDK');

form2.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    // Tạo đối tượng FormData từ form để gửi qua AJAX
    const formData = new FormData(form2);

    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form2.action, true);

    // Khi yêu cầu thành công
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText); // Parse phản hồi JSON từ server
                
                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    errorMessagesDiv2.innerHTML = response.error.join('<br>'); // Hiển thị lỗi
                } else if (response.success) {
                    window.location.href = response.redirect; // Chuyển hướng (nếu có)
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv2.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        }
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});
const form3 = document.getElementById('emailForm');
const errorMessagesDiv3 = document.getElementById('errorMessagesEmail');

form3.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    // Tạo đối tượng FormData từ form để gửi qua AJAX
    const formData = new FormData(form3);

    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form3.action, true);

    // Khi yêu cầu thành công
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Server response:", xhr.responseText); // Kiểm tra phản hồi từ server

            try {
                const response = JSON.parse(xhr.responseText.trim()); // Parse JSON sau khi loại bỏ khoảng trắng

                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    errorMessagesDiv3.innerHTML = response.error.join('<br>'); // Hiển thị lỗi
                } else if (response.success) {
                    passwordContainer.classList.add('hidden');
                    signInContainer.classList.add('hidden');
                    password2Container.classList.remove('hidden');
                    container.classList.add('right-panel-active');
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv3.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        } else {
            errorMessagesDiv3.innerHTML = "Yêu cầu không thành công, vui lòng thử lại.";
        }
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});


const form4 = document.getElementById('verForm');
const errorMessagesDiv4 = document.getElementById('errorCode');

form4.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    // Tạo đối tượng FormData từ form để gửi qua AJAX
    const formData = new FormData(form4);

    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form4.action, true);

    // Khi yêu cầu thành công
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Server response:", xhr.responseText); // Kiểm tra phản hồi từ server

            try {
                const response = JSON.parse(xhr.responseText.trim()); // Parse JSON sau khi loại bỏ khoảng trắng

                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    errorMessagesDiv4.innerHTML = response.error.join('<br>'); // Hiển thị lỗi
                } else if (response.success) {
                    password2Container.classList.add('hidden');
                    signInContainer.classList.add('hidden');
                    password2Container.classList.add('hidden');
                    password3Container.classList.remove('hidden');
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv4.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        } else {
            errorMessagesDiv4.innerHTML = "Yêu cầu không thành công, vui lòng thử lại.";
        }
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});
const form5 = document.getElementById('newpass');
const errorMessagesDiv5 = document.getElementById('errorpass');

form5.addEventListener('submit', function (e) {
    e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

    // Tạo đối tượng FormData từ form để gửi qua AJAX
    const formData = new FormData(form5);

    // Gửi yêu cầu AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form5.action, true);

    // Khi yêu cầu thành công
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Server response:", xhr.responseText); // Kiểm tra phản hồi từ server

            try {
                const response = JSON.parse(xhr.responseText.trim()); // Parse JSON sau khi loại bỏ khoảng trắng

                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    errorMessagesDiv5.innerHTML = response.error.join('<br>'); // Hiển thị lỗi
                } else if (response.success) {
                    container.classList.remove('right-panel-active');
                    password2Container.classList.add('hidden');
                    password3Container.classList.add('hidden'); 
                    signInContainer.classList.remove('hidden');
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv5.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        } else {
            errorMessagesDiv5.innerHTML = "Yêu cầu không thành công, vui lòng thử lại.";
        }
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});

