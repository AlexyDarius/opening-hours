<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.html'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openingHoursFile = 'opening_hours.json';
    
    $newHours = array(
        'Monday' => sanitizeAndValidateOpeningHours($_POST['monday']),
        'Tuesday' => sanitizeAndValidateOpeningHours($_POST['tuesday']),
        'Wednesday' => sanitizeAndValidateOpeningHours($_POST['wednesday']),
        'Thursday' => sanitizeAndValidateOpeningHours($_POST['thursday']),
        'Friday' => sanitizeAndValidateOpeningHours($_POST['friday']),
        'Saturday' => sanitizeAndValidateOpeningHours($_POST['saturday']),
        'Sunday' => sanitizeAndValidateOpeningHours($_POST['sunday'])
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

