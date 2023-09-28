<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.html'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openingHoursFile = 'opening_hours.json';
    
    $newHours = array(
        'Monday' => isset($_POST['monday']) ? sanitizeAndValidateOpeningHours($_POST['monday']) : 'Closed',
        'Tuesday' => isset($_POST['tuesday']) ? sanitizeAndValidateOpeningHours($_POST['tuesday']) : 'Closed',
        'Wednesday' => isset($_POST['wednesday']) ? sanitizeAndValidateOpeningHours($_POST['wednesday']) : 'Closed',
        'Thursday' => isset($_POST['thursday']) ? sanitizeAndValidateOpeningHours($_POST['thursday']) : 'Closed',
        'Friday' => isset($_POST['friday']) ? sanitizeAndValidateOpeningHours($_POST['friday']) : 'Closed',
        'Saturday' => isset($_POST['saturday']) ? sanitizeAndValidateOpeningHours($_POST['saturday']) : 'Closed',
        'Sunday' => isset($_POST['sunday']) ? sanitizeAndValidateOpeningHours($_POST['sunday']) : 'Closed'
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

