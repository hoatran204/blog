// Lấy các phần tử DOM cần thiết
const editProfileButton = document.querySelector('.edit-profile');
const cancelButton = document.getElementById('cancelButton');
const editForm = document.getElementById('editForm');
const overlay = document.getElementById('overlay');

// Khi nhấn vào "Edit profile" thì hiển thị form
editProfileButton.addEventListener('click', () => {
    editForm.classList.remove('hidden');  // Hiển thị form
});

// Khi nhấn vào nút "Hủy" thì ẩn form
cancelButton.addEventListener('click', () => {
    editForm.classList.add('hidden');  // Ẩn form
});

// Khi nhấn vào "Edit profile" thì hiển thị form
editProfileButton.addEventListener('click', () => {
    overlay.classList.remove('hidden');  // Hiển thị form
});

// Khi nhấn vào nút "Hủy" thì ẩn form
cancelButton.addEventListener('click', () => {
    overlay.classList.add('hidden');  // Ẩn form
});
// Lấy các phần tử DOM cần thiết
const form = document.getElementById('updateForm');
const errorMessagesDiv = document.getElementById('errorMessages');

// Gửi dữ liệu form bằng AJAX khi nhấn nút submit
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
                const response = JSON.parse(xhr.responseText.trim()); // Chuyển JSON phản hồi thành đối tượng
                if (response.error) {
                    // Hiển thị lỗi nếu có
                    errorMessagesDiv.innerHTML = response.error;
                }else if (response.success) {
                    console.log("Cập nhật thành công, trang sẽ tải lại."); // Ghi log để kiểm tra
                    window.location.reload(true); // Tải lại không dùng bộ nhớ đệm
                } else {
                    console.error("Không có trường success trong phản hồi");
                }
            } catch (e) {
                // Nếu không phải JSON hợp lệ, hiển thị nội dung phản hồi
                errorMessagesDiv.innerHTML = "Có lỗi xảy ra: " + xhr.responseText;
            }
        } else {
            // Nếu lỗi mạng hoặc không phải trạng thái 200
            errorMessagesDiv.innerHTML = "Có lỗi xảy ra, vui lòng thử lại.";
        }
    };

    // Khi có lỗi trong quá trình gửi yêu cầu AJAX
    xhr.onerror = function () {
        errorMessagesDiv.innerHTML = "Không thể gửi yêu cầu, vui lòng kiểm tra kết nối.";
    };

    // Gửi dữ liệu tới server
    xhr.send(formData);
});

document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', () => {
        // Bỏ lớp "active" khỏi tất cả các tab và ẩn tất cả nội dung
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');

        // Thêm lớp "active" vào tab được nhấp
        tab.classList.add('active');
        
        // Hiển thị nội dung tương ứng với tab
        const tabContentId = tab.getAttribute('data-tab') + '-content';
        
        document.getElementById(tabContentId).style.display = 'block';
    });
});

