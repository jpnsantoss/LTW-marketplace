// Get all the promote buttons
let addtoListButtons = document.querySelectorAll('.add-to-wish-list');

// Attach a click event listener to each button
promoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Get the user ID from the data-user-id attribute
        var itemId = this.getAttribute('data-item-id');

        // Make a POST request to the `admin/promoteUserToSeller/{id}` route
        fetch('addToWishList/' + itemId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({itemId: itemId})
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