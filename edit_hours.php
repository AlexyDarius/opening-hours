<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>opening-hours</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/Login-Form-Basic-icons.css">
    <script src= "scripts/disableDropdown.js"></script>
</head>

<?php
    session_start();
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header('Location: login.php'); // Redirect to the login page if not authenticated
        exit;
    }
?>

<body>
    <h1 class="text-center" style="margin-top: 12px;font-weight: bold;text-decoration:  underline;">Éditer vos horaires d'ouverture</h1>
    <section style="margin-top: 32px;margin-bottom: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-6 d-flex justify-content-center"><button class="btn btn-primary" type="button" id="edit-midi-button">Éditer horaires du midi</button>
                </div>
                <div class="col-6 col-md-6 d-flex justify-content-center"><button class="btn btn-primary" type="button" id="edit-soir-button">Éditer horaires du soir</button>
                </div>
            </div>
        </div>
    </section>
    <section class="position-relative py-4 py-xl-5" id="midi-section">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                        <h2 class="text-center mb-4">Éditer vos horaires du midi ici</h2>
                            <form method="post" action="update_hours_mid.php" onsubmit="updateOpeningHoursMid(); return false;">

                                <?php
                                    $daysM = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                    $days_idM = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $options_openingM = ['11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00'];
                                    $options_closingM = ['12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30'];
                                    
                                    for ($i = 0; $i < count($daysM); $i++) {
                                        $dayM = $daysM[$i];
                                        $day_idM = $days_idM[$i];
                                    
                                        echo '<div class="form-group mb-3">';
                                        echo '<label style="margin-right: 2px;" for="' . strtolower($day_idM) . '">' . $dayM . ':</label>';
                                        echo '<select class="form-label" style="margin-right: 4px;" id="' . strtolower($day_idM) . 'OpeningM" name="' . strtolower($day_idM) . 'OpeningM">';
                                        foreach ($options_openingM as $optionM) {
                                            echo '<option value="' . $optionM . '">' . $optionM . '</option>';
                                        }
                                        echo '</select>';
                                        echo '<select class="form-label" style="margin-right: 4px;" id="' . strtolower($day_idM) . 'ClosingM" name="' . strtolower($day_idM) . 'ClosingM">';
                                        foreach ($options_closingM as $optionM) {
                                            echo '<option value="' . $optionM . '">' . $optionM . '</option>';
                                        }
                                        echo '</select>';
                                        echo '<input type="checkbox" style="margin-right: 2px;margin-left: 8px;" id="closed' .strtolower($day_idM) . 'OpeningM" name="closed' .strtolower($day_idM) . 'OpeningM" unchecked> Fermé';
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
    <section class="position-relative py-4 py-xl-5" id="soir-section">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">Éditez vos du soir horaires ici</h2>
                            <form method="post" action="update_hours_noon.php" onsubmit="updateOpeningHoursNoon(); return false;">

                                <?php
                                    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                    $days_id = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $options_opening = ['18:00', '18:15', '18:30', '18:45', '19:00', '19:15', '19:30', '18:45', '20:00'];
                                    $options_closing = ['20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00'];
                                    
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

    <script>
        // Get references to the buttons and sections
        const editMidiButton = document.querySelector('#edit-midi-button');
        const editSoirButton = document.querySelector('#edit-soir-button');
        const midiSection = document.querySelector('#midi-section');
        const soirSection = document.querySelector('#soir-section');

        // Hide both sections by default
        midiSection.style.display = 'none';
        soirSection.style.display = 'none';

        // Add click event listeners to the buttons
        editMidiButton.addEventListener('click', () => {
            midiSection.style.display = 'block';
            soirSection.style.display = 'none';
        });

        editSoirButton.addEventListener('click', () => {
            midiSection.style.display = 'none';
            soirSection.style.display = 'block';
        });
    </script>

    <script src="styles/js/bootstrap.min.js"></script>
    <script src="styles/js/bs-init.js"></script>
    <script src="https://alexyroman.online/opening-hours/scripts/udpateOpeningHoursNoon.js"></script>
    <script src="https://alexyroman.online/opening-hours/scripts/udpateOpeningHoursMid.js"></script>

</body>
</html>