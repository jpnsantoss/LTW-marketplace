var promoteButtons = document.querySelectorAll('.promote-button');

promoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Get the user ID from the data-user-id attribute
        var userId = this.getAttribute('data-user-id');
        console.log(userId);

        // Make a POST request to the `admin/promoteUserToSeller/{id}` route
        fetch('http://localhost:8000/admin/promote-user-to-seller' + userId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({userId: userId})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the response data
            console.log(data);
            localStorage.reload();
        })
        .catch(error => {
            // Handle the error
            console.error('Error:', error);
        });
    });
});