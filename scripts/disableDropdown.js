document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener to each checkbox and its associated select element
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        const associatedOpeningSelect = document.querySelector('select[name="' + checkbox.id.replace('closed', '') + '"]');
        const associatedClosingSelect = document.querySelector('select[name="' + checkbox.id.replace('closed', '').replace('Opening', 'Closing') + '"]');
        
        // Add an event listener to the checkbox
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                associatedOpeningSelect.disabled = true;
                associatedClosingSelect.disabled = true;
            } else {
                associatedOpeningSelect.disabled = false;
                associatedClosingSelect.disabled = false;
            }
        });
    });
});

// Get all elements whose IDs match the pattern "closedsundayOpening"
const elementsToChange = document.querySelectorAll('[id^="closedsundayOpening"]');

// Loop through the matched elements and change their IDs
elementsToChange.forEach(element => {
const newId = element.id.replace('closed', 'Closing').replace('Opening', ''); // Replace 'closed' with 'Closing' and 'Opening' with an empty string
element.id = newId; // Set the new ID
});