<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.html'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openingHoursFile = 'opening_hours.json';
    
    $newHours = array(
    'MondayOpening' => isset($_POST['mondayOpening']) ? sanitizeAndValidateOpeningHours($_POST['mondayOpening']) : 'Closed',
    'TuesdayOpening' => isset($_POST['tuesdayOpening']) ? sanitizeAndValidateOpeningHours($_POST['tuesdayOpening']) : 'Closed',
    'WednesdayOpening' => isset($_POST['wednesdayOpening']) ? sanitizeAndValidateOpeningHours($_POST['wednesdayOpening']) : 'Closed',
    'ThursdayOpening' => isset($_POST['thursdayOpening']) ? sanitizeAndValidateOpeningHours($_POST['thursdayOpening']) : 'Closed',
    'FridayOpening' => isset($_POST['fridayOpening']) ? sanitizeAndValidateOpeningHours($_POST['fridayOpening']) : 'Closed',
    'SaturdayOpening' => isset($_POST['saturdayOpening']) ? sanitizeAndValidateOpeningHours($_POST['saturdayOpening']) : 'Closed',
    'SundayOpening' => isset($_POST['sundayOpening']) ? sanitizeAndValidateOpeningHours($_POST['sundayOpening']) : 'Closed',
    'MondayClosing' => isset($_POST['mondayClosing']) ? sanitizeAndValidateOpeningHours($_POST['mondayClosing']) : 'Closed',
    'TuesdayClosing' => isset($_POST['tuesdayClosing']) ? sanitizeAndValidateOpeningHours($_POST['tuesdayClosing']) : 'Closed',
    'WednesdayClosing' => isset($_POST['wednesdayClosing']) ? sanitizeAndValidateOpeningHours($_POST['wednesdayClosing']) : 'Closed',
    'ThursdayClosing' => isset($_POST['thursdayClosing']) ? sanitizeAndValidateOpeningHours($_POST['thursdayClosing']) : 'Closed',
    'FridayClosing' => isset($_POST['fridayClosing']) ? sanitizeAndValidateOpeningHours($_POST['fridayClosing']) : 'Closed',
    'SaturdayClosing' => isset($_POST['saturdayClosing']) ? sanitizeAndValidateOpeningHours($_POST['saturdayClosing']) : 'Closed',
    'SundayClosing' => isset($_POST['sundayClosing']) ? sanitizeAndValidateOpeningHours($_POST['sundayClosing']) : 'Closed'
);
    
    $updatedOpeningHours = json_encode($newHours, JSON_PRETTY_PRINT);
    file_put_contents($openingHoursFile, $updatedOpeningHours);

    $response = ['message' => 'Opening hours updated successfully'];
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}

function sanitizeAndValidateOpeningHours($hours)
{
    // Add any specific validation rules here if needed
    // For now, we assume that any format is valid
    return $hours;
}
?>

