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
    <script src="styles/js/bootstrap.min.js"></script>
    <script src="styles/js/bs-init.js"></script>
    <script src="scripts/udpateOpeningHours.js"></script>

</body>
</html>