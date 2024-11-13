const form = document.getElementById('formdangbai');
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
                    window.location.href = response.redirect; // Chuyển hướng (nếu có)
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