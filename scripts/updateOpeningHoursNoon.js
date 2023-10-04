// Function to update opening hours
function updateOpeningHoursNoon() {
    // Loop through each day to gather the data
    const days_opening = ['mondayOpening', 'tuesdayOpening', 'wednesdayOpening', 'thursdayOpening', 'fridayOpening', 'saturdayOpening', 'sundayOpening'];
    const closing = ['mondayClosing', 'tuesdayClosing', 'wednesdayClosing', 'thursdayClosing', 'fridayClosing', 'saturdayClosing', 'sundayClosing'];
    const requestData = {};

    days_opening.forEach(function (day) {
        const selectElement = document.getElementById(day);
        const checkboxElement = document.getElementById('closed' + day.charAt(0).toUpperCase() + day.slice(1)); // Construct checkbox ID based on the day

        const isClosed = checkboxElement.checked;
        const openingHours = isClosed ? 'Closed' : selectElement.value;

        requestData[day] = openingHours;
    });

    days_closing.forEach(function (day) {
        const selectElement = document.getElementById(day);
        const checkboxElement = document.getElementById('closed' + day.charAt(0).toUpperCase() + day.slice(1)); // Construct checkbox ID based on the day

        const isClosed = checkboxElement.checked;
        const closingHours = isClosed ? 'Closed' : selectElement.value;

        requestData[day] = closingHours;
    });

    // Update opening hours in the JSON file
    fetch('update_hours.php', {
        method: 'POST',
        body: JSON.stringify(requestData),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Log the response from the server

        // Fetch and display updated opening hours
        fetchAndDisplayOpeningHours();
    })
    .catch(error => {
        console.error('Error updating opening hours:', error);
    });
}