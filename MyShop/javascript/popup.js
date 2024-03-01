function displayPopup(event) {
    event.preventDefault(); // Prevent the default behavior of the link
    document.getElementById('popup').style.display = 'block';
}

// Function to close the popup
function closePopupDa(link) {
 //   event.preventDefault(); // Prevent the default behavior of the link
    window.location.href = link;
    document.getElementById('popup').style.display = 'none';
}

function closePopupNu(event) {
    event.preventDefault(); // Prevent the default behavior of the link
    document.getElementById('popup').style.display = 'none';
}


