<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.html'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openingHoursFile = 'opening_hours.json';
    
    $newHours = array(
    'MondayOpening' => isset($_POST['mondayOpening']) ? $_POST['mondayOpening'] : 'Closed',
    'TuesdayOpening' => isset($_POST['tuesdayOpening']) ? $_POST['tuesdayOpening'] : 'Closed',
    'WednesdayOpening' => isset($_POST['wednesdayOpening']) ? $_POST['wednesdayOpening'] : 'Closed',
    'ThursdayOpening' => isset($_POST['thursdayOpening']) ? $_POST['thursdayOpening'] : 'Closed',
    'FridayOpening' => isset($_POST['fridayOpening']) ? $_POST['fridayOpening'] : 'Closed',
    'SaturdayOpening' => isset($_POST['saturdayOpening']) ? $_POST['saturdayOpening'] : 'Closed',
    'SundayOpening' => isset($_POST['sundayOpening']) ? $_POST['sundayOpening'] : 'Closed',
    'MondayClosing' => isset($_POST['mondayClosing']) ? $_POST['mondayClosing'] : 'Closed',
    'TuesdayClosing' => isset($_POST['tuesdayClosing']) ? $_POST['tuesdayClosing'] : 'Closed',
    'WednesdayClosing' => isset($_POST['wednesdayClosing']) ? $_POST['wednesdayClosing'] : 'Closed',
    'ThursdayClosing' => isset($_POST['thursdayClosing']) ? $_POST['thursdayClosing'] : 'Closed',
    'FridayClosing' => isset($_POST['fridayClosing']) ? $_POST['fridayClosing'] : 'Closed',
    'SaturdayClosing' => isset($_POST['saturdayClosing']) ? $_POST['saturdayClosing'] : 'Closed',
    'SundayClosing' => isset($_POST['sundayClosing']) ? $_POST['sundayClosing'] : 'Closed'
);
    $updatedOpeningHours = json_encode($newHours, JSON_PRETTY_PRINT);
    file_put_contents($openingHoursFile, $updatedOpeningHours);

    $response = ['message' => 'Opening hours updated successfully'];
    echo json_encode($response);

    header('Location: index.html'); // Redirect to the opening hours editing page
    
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}

?>

