<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.html'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openingHoursFile = 'opening_hours.json';
    
    // Read existing JSON content from the file
    $existingContent = file_get_contents($openingHoursFile);
    $existingData = json_decode($existingContent, true);

    // Update only the fields you want
    $existingData['MondayOpening'] = isset($_POST['mondayOpening']) ? $_POST['mondayOpening'] : 'Closed';
    $existingData['TuesdayOpening'] = isset($_POST['tuesdayOpening']) ? $_POST['tuesdayOpening'] : 'Closed';
    $existingData['WednesdayOpening'] = isset($_POST['wednesdayOpening']) ? $_POST['wednesdayOpening'] : 'Closed';
    $existingData['ThursdayOpening'] = isset($_POST['thursdayOpening']) ? $_POST['thursdayOpening'] : 'Closed';
    $existingData['FridayOpening'] = isset($_POST['fridayOpening']) ? $_POST['fridayOpening'] : 'Closed';
    $existingData['SaturdayOpening'] = isset($_POST['saturdayOpening']) ? $_POST['saturdayOpening'] : 'Closed';
    $existingData['SundayOpening'] = isset($_POST['sundayOpening']) ? $_POST['sundayOpening'] : 'Closed';

    $existingData['MondayClosing'] = isset($_POST['mondayClosing']) ? $_POST['mondayClosing'] : 'Closed';
    $existingData['TuesdayClosing'] = isset($_POST['tuesdayClosing']) ? $_POST['tuesdayClosing'] : 'Closed';
    $existingData['WednesdayClosing'] = isset($_POST['wednesdayClosing']) ? $_POST['wednesdayClosing'] : 'Closed';
    $existingData['ThursdayClosing'] = isset($_POST['thursdayClosing']) ? $_POST['thursdayClosing'] : 'Closed';
    $existingData['FridayClosing'] = isset($_POST['fridayClosing']) ? $_POST['fridayClosing'] : 'Closed';
    $existingData['SaturdayClosing'] = isset($_POST['saturdayClosing']) ? $_POST['saturdayClosing'] : 'Closed';
    $existingData['SundayClosing'] = isset($_POST['sundayClosing']) ? $_POST['sundayClosing'] : 'Closed';

    // Encode the updated data back to JSON
    $updatedOpeningHours = json_encode($existingData, JSON_PRETTY_PRINT);

    // Write the updated content back to the file
    file_put_contents($openingHoursFile, $updatedOpeningHours);

    $response = ['message' => 'Opening hours updated successfully'];
    echo json_encode($response);

    header('Location: index.html'); // Redirect to the opening hours editing page
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}


?>

