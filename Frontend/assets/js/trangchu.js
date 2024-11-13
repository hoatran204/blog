document.querySelectorAll('.hdt21').forEach(tag => {
    tag.addEventListener('click', function() {
        const selectedTag = this.getAttribute('data-tag');
        
        document.querySelectorAll('.hdt311').forEach(post => {
            post.style.display = 'none';
        });

        document.querySelectorAll('.hdt311[data-tag="' + selectedTag + '"]').forEach(post => {
            post.style.display = 'block';
        });
    });
});