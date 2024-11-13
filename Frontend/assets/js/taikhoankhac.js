
    const followButtons = document.querySelectorAll('.following');

    followButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Kiểm tra nếu hiện tại là 'following', chuyển thành 'unfollow'
            if (button.textContent.toLowerCase() === 'following') {
                button.textContent = 'Unfollow';
                button.classList.add('unfollow'); // Thêm class nếu muốn đổi style
            } else {
                button.textContent = 'Following';
                button.classList.remove('unfollow'); // Xóa class nếu cần
            }
        });
    });

