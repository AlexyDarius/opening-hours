<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>opening-hours</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/Login-Form-Basic-icons.css">

    <script>
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
    </script>

</head>

<?php
    session_start();
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header('Location: login.html'); // Redirect to the login page if not authenticated
        exit;
    }
?>

<body>
    <h1 class="text-center" style="margin-top: 12px;font-weight: bold;text-decoration:  underline;">Éditer vos horaires d'ouverture</h1>
    <section class="position-relative py-4 py-xl-5">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">Éditez vos horaires ici</h2>
                            <form method="post" action="update_hours.php" onsubmit="updateOpeningHours(); return false;">

                                <?php
                                    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                    $days_id = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $options_opening = ['18:00', '19:00'];
                                    $options_closing = ['21:00', '22:00'];
                                    
                                    for ($i = 0; $i < count($days); $i++) {
                                        $day = $days[$i];
                                        $day_id = $days_id[$i];
                                    
                                        echo '<div class="form-group mb-3">';
                                        echo '<label style="margin-right: 2px;" for="' . strtolower($day_id) . '">' . $day . ':</label>';
                                        echo '<select class="form-label" style="margin-right: 4px;" id="' . strtolower($day_id) . 'Opening" name="' . strtolower($day_id) . 'Opening">';
                                        foreach ($options_opening as $option) {
                                            echo '<option value="' . $option . '">' . $option . '</option>';
                                        }
                                        echo '</select>';
                                        echo '<select class="form-label" style="margin-right: 4px;" id="' . strtolower($day_id) . 'Closing" name="' . strtolower($day_id) . 'Closing">';
                                        foreach ($options_closing as $option) {
                                            echo '<option value="' . $option . '">' . $option . '</option>';
                                        }
                                        echo '</select>';
                                        echo '<input type="checkbox" style="margin-right: 2px;margin-left: 8px;" id="closed' .strtolower($day_id) . 'Opening" name="closed' .strtolower($day_id) . 'Opening" unchecked> Fermé';
                                        echo '</div>';
                                    }
                                ?>
                                <div><button type="submit" class="btn btn-primary d-block w-100">Mettre à jour</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="styles/js/bootstrap.min.js"></script>
    <script src="styles/js/bs-init.js"></script>

    <script>
    // Function to update opening hours
    function updateOpeningHours() {
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


</script>

    </div>
</body>

</html>
