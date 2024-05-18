// Mobile navigation
document.getElementById('menu-button').addEventListener('click', function () {
    var menuLinks = document.getElementById('menu-links');
    if (menuLinks.style.opacity === '0') {
        menuLinks.style.opacity = '1';
        menuLinks.style.maxHeight = '600px'; // Adjust this value as needed
    } else {
        menuLinks.style.opacity = '0';
        menuLinks.style.maxHeight = '0';
    }
});


// Dropdown menu
document.querySelector('.dropdown').addEventListener('click', function (event) {
    event.stopPropagation();
    this.querySelector('ul').classList.toggle('show');
});

// Close the dropdown menu if the user clicks outside of it
window.addEventListener('click', function (event) {
    if (!event.target.matches('.dropdown')) {
        var dropdowns = document.querySelectorAll('.dropdown ul');
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
});

var urlRoot = 'http://localhost:8000';
document.getElementById('logout').addEventListener('click', function (event) {
    event.preventDefault();
    console.log("teste")

    var xhr = new XMLHttpRequest();
    xhr.open('POST', urlRoot + '/auth/logout', true);

    console.log('Sending request to ' + urlRoot + '/auth/logout')
    xhr.onload = function () {
        if (this.status == 200) {
            // Redirect to the login page (or wherever you want to redirect after logout)
            window.location.href = urlRoot;
        }
    };
    xhr.send();
});