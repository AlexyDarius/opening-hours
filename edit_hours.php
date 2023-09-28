<!DOCTYPE html>
<html lang="fr">

<head>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener to each checkbox and its associated select element
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        const associatedSelect = document.querySelector('select[name="' + checkbox.id.replace('closed', '') + '"]');
        
        // Add an event listener to the checkbox
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                associatedSelect.disabled = true;
            } else {
                associatedSelect.disabled = false;
            }
        });
    });
});

</script>
</head>

<body style="background: rgb(255,255,255);">
    <div class="container">
        <?php
        session_start();
        if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
            header('Location: login.html'); // Redirect to the login page if not authenticated
            exit;
        }
        ?>

        <h2>Edit Opening Hours</h2>
        <div class="container mt-5">
            <h2 class="mb-4">Éditer les heures d'ouverture</h2>
            <form method="post" action="update_hours.php" onsubmit="updateOpeningHours(); return false;">

                <?php
                    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                    $days_id = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    $options = ['18:00-22:00', '18:00-21:30'];
                    
                    for ($i = 0; $i < count($days); $i++) {
                        $day = $days[$i];
                        $day_id = $days_id[$i];
                    
                        echo '<div class="form-group">';
                        echo '<label for="' . strtolower($day_id) . '">' . $day . ':</label>';
                        echo '<select class="form-control" id="' . strtolower($day_id) . '" name="' . strtolower($day_id) . '">';
                        foreach ($options as $option) {
                            echo '<option value="' . $option . '">' . $option . '</option>';
                        }
                        echo '</select>';
                        echo '<input type="checkbox" id="closed' .strtolower($day_id) . '" name="closed' .strtolower($day_id) . '"> Fermé';
                        echo '</div>';
                    }
                ?>


                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>

        <script>
    // Function to update opening hours
    function updateOpeningHours() {
    // Loop through each day to gather the data
    const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    const requestData = {};

    days.forEach(function (day) {
        const selectElement = document.getElementById(day);
        const checkboxElement = document.getElementById('closed' + day.charAt(0).toUpperCase() + day.slice(1)); // Construct checkbox ID based on the day

        const isClosed = checkboxElement.checked;
        const openingHours = isClosed ? 'Closed' : selectElement.value;

        requestData[day] = openingHours;
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
