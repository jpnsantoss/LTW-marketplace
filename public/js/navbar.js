document.getElementById('menu-button').addEventListener('click', function () {
    var menuLinks = document.getElementById('menu-links');
    if (menuLinks.style.opacity === '0') {
        menuLinks.style.opacity = '1';
        menuLinks.style.maxHeight = '500px'; // Adjust this value as needed
    } else {
        menuLinks.style.opacity = '0';
        menuLinks.style.maxHeight = '0';
    }
});