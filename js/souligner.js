window.addEventListener('load', function() {
    let currentURL = window.location.href;
    document.querySelectorAll('.categorie > a:not(:nth-child(6)):not(:nth-child(7))').forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('active');
        }
    });
});
