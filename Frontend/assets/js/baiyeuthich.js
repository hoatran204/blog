
const searchInput = document.getElementById('hdt13'); 
const postItems = document.querySelectorAll('.hdt21');

searchInput.addEventListener('input', function () {
    const searchTerm = searchInput.value.toLowerCase(); 

    postItems.forEach(function (post) {
        const title = post.querySelector('h3').innerText.toLowerCase(); 
        const description = post.querySelector('p').innerText.toLowerCase(); 

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            post.style.display = 'block'; 
        } else {
            post.style.display = 'none'; 
        }
    });
});
