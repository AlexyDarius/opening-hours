<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Add your CSS and fonts here -->
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
                    $options = ['Fermé', '18:00-22:00', '18:00-21:30'];
                    
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
                        echo '</div>';
                    }
                ?>


                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>

        <div id="currentHours">
            <!-- Current opening hours will be displayed here -->
        </div>

        <script>
    // Function to update opening hours
    function updateOpeningHours() {
        const selectedOption = document.getElementById('newHours');
        const newHours = selectedOption.value;

        // Update opening hours in the JSON file
        fetch('update_hours.php', {
            method: 'POST',
            body: JSON.stringify({ newHours }),
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

    // Function to fetch and display opening hours from JSON
    function fetchAndDisplayOpeningHours() {
        fetch('opening_hours.json')
            .then(response => response.json())
            .then(data => {
                const today = new Date().toLocaleDateString('en-US', { weekday: 'long' });
                const openingHours = data[today];

                if (openingHours) {
                    document.getElementById('currentHours').innerHTML = `<p>${today}: ${openingHours}</p>`;
                } else {
                    document.getElementById('currentHours').innerHTML = `<p>Opening hours not available for ${today}</p>`;
                }
            })
            .catch(error => {
                console.error('Error fetching opening hours:', error);
                document.getElementById('currentHours').innerHTML = '<p>Error fetching opening hours</p>';
            });
    }

    // Fetch and display current opening hours when the page loads
    fetchAndDisplayOpeningHours();
</script>

    </div>
</body>

</html>
