document.addEventListener('DOMContentLoaded', () => {
    const phanhoiButtons = document.querySelectorAll('.phanhoi-btn');
    const commentInput = document.getElementById('commentInput');
    const dang = document.getElementById('dang');
    // Sử dụng trực tiếp sự kiện input để bật/tắt nút Đăng
    commentInput.addEventListener('input', function () {
        dang.disabled = commentInput.value.trim() === '';
    });

    // Kiểm tra trạng thái nút ban đầu
    dang.disabled = commentInput.value.trim() === '';
    phanhoiButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const replyInput = button.closest('.hdt216').querySelector('.reply-input');
            replyInput.classList.toggle('hidden');
        });
    });

});
const form = document.getElementById('formcmt');
const commentInput = document.getElementById('commentInput');
const errorMessagesDiv = document.getElementById('error');
const dang = document.getElementById('dang');

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
            console.log("Server response:", xhr.responseText); // Kiểm tra phản hồi từ server

            try {
                const response = JSON.parse(xhr.responseText.trim()); // Parse JSON sau khi loại bỏ khoảng trắng
                
                // Kiểm tra nếu có lỗi trong phản hồi JSON
                if (response.error) {
                    // Hiển thị thông báo lỗi (tùy theo thông báo từ server)
                    errorMessagesDiv.innerHTML = response.error;
                    dang.disabled = false; // Bật lại nút Đăng nếu có lỗi
                } else if (response.success) {
                    // Nếu thành công, xử lý như hiển thị thông báo thành công
                    dang.disabled = true; // Vô hiệu hóa nút Đăng sau khi gửi
                    window.location.reload();
                }
            } catch (e) {
                console.error("Không thể parse JSON:", e);
                errorMessagesDiv.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
            }
        } else {
            errorMessagesDiv.innerHTML = "Yêu cầu không thành công, vui lòng thử lại.";
        }
    };

    // Khi có lỗi trong quá trình gửi yêu cầu AJAX
    xhr.onerror = function () {
        errorMessagesDiv.innerHTML = "Có lỗi xảy ra khi gửi yêu cầu, vui lòng thử lại.";
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});
document.querySelectorAll('.like-button').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();  // Ngừng hành động mặc định của thẻ <a>

        const commentId = this.getAttribute('data-comment-id');
        const userId = this.getAttribute('data-user-id');
        const isLiked = this.getAttribute('data-liked') === 'true';
        const soluotthichElement = document.getElementById(`soluotthich${commentId}`);
        let soluotthich = parseInt(soluotthichElement.textContent, 10);
        // Gửi yêu cầu AJAX để like/unlike
        const xhr = new XMLHttpRequest();
        xhr.open('POST', button.href, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("Server response:", xhr.responseText); // Kiểm tra phản hồi từ server
        
                try {
                    // Kiểm tra xem phản hồi có phải là JSON hợp lệ không
                    const response = JSON.parse(xhr.responseText.trim());
                    
                    if (response.status === 'success') {
                        // Thực hiện các hành động khi thành công (like/unlike)
                        if (isLiked) {
                            button.classList.remove('liked');
                            button.classList.add('unliked');
                            button.setAttribute('data-liked', 'false');
                            button.style.color = 'gray';
                            soluotthich -= 1;
                        } else {
                            button.classList.remove('unliked');
                            button.classList.add('liked');
                            button.setAttribute('data-liked', 'true');
                            button.style.color = 'blue';
                            soluotthich += 1;
                        }
                        soluotthichElement.textContent = soluotthich;
                    }

                } catch (e) {
                    console.error("Không thể parse JSON:", e);
                    console.log("Lỗi phản hồi: ", xhr.responseText); // In ra phản hồi để kiểm tra
                }
            } else {
                console.error('Error with the request, status:', xhr.status);
            }
        };
        

        

        // Gửi dữ liệu qua FormData (bao gồm cả commentId và userId)
        const formData = new FormData();
        formData.append('id', commentId);
        formData.append('user_id', userId);  
        xhr.send(formData);

        // Ngừng hành động mặc định của thẻ <a>
        return false;  // Đảm bảo không chuyển trang
    });
});

document.querySelectorAll('[id^="formreply-"]').forEach(function(formreply) {
    const commentId = formreply.getAttribute('id').split('-')[1];  // Lấy comment_id từ id của form
    const repbutton = document.getElementById(`repbutton-${commentId}`);
    const replyContent = document.getElementById(`replycontent-${commentId}`);
    const errorMessagesDiv2 = document.getElementById(`errorrl-${commentId}`);

    // Thêm sự kiện input để bật/tắt nút Đăng
    replyContent.addEventListener('input', function () {
        repbutton.disabled = replyContent.value.trim() === '';
    });

    // Kiểm tra trạng thái nút ban đầu
    repbutton.disabled = replyContent.value.trim() === '';

    // Sự kiện submit form phản hồi
    formreply.addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn chặn form gửi theo cách thông thường

        // Tạo đối tượng FormData từ form để gửi qua AJAX
        const formData = new FormData(formreply);

        // Gửi yêu cầu AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', formreply.action, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText.trim());
                    if (response.error) {
                        errorMessagesDiv2.innerHTML = response.error;
                        repbutton.disabled = false;
                    } else if (response.success) {
                        window.location.reload();
                    }
                } catch (e) {
                    errorMessagesDiv2.innerHTML = "Có lỗi xảy ra trong quá trình xử lý.";
                }
            } else {
                errorMessagesDiv2.innerHTML = "Yêu cầu không thành công, vui lòng thử lại.";
            }
        };

        xhr.onerror = function () {
            errorMessagesDiv2.innerHTML = "Có lỗi xảy ra khi gửi yêu cầu, vui lòng thử lại.";
        };

        xhr.send(formData);
    });
});
