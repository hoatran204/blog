document.querySelectorAll('.delete-button').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const postId = button.getAttribute('data-id');
        const deleteUrl = button.getAttribute('data-href');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', deleteUrl, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("Server response:", xhr.responseText);

                try {
                    const response = JSON.parse(xhr.responseText.trim());

                    if (response.status === 'success') {
                        document.getElementById('dong' + postId).remove();
                        alert("Bài viết đã được xoá thành công!");
                    }

                } catch (e) {
                    console.error("Không thể parse JSON:", e);
                    console.log("Lỗi phản hồi: ", xhr.responseText);
                }
            } else {
                console.error('Error with the request, status:', xhr.status);
            }
        };

        const formData = new FormData();
        formData.append('id', postId);
        xhr.send(formData);

        return false;
    });
});
