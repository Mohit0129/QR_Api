<?php

// Include the QR Code Generator library
require_once 'phpqrcode/qrlib.php';

header("Access-Control-Allow-Origin: *");


// Function to generate QR code and display it
function generateAndDisplayQRCode($data1, $data2 = null) {
    // Combine data1 and data2 if data2 is provided
    $data = $data1;
    if ($data2 !== null) {
        $data .= '_' . $data2;
    }

    // Generate unique filenames for the QR code images
    $filename1 = 'qrcode_' . time() . '_size1.png';
    $filename2 = 'qrcode_' . time() . '_size2.png';
    $filename3 = 'qrcode_' . time() . '_size3.png';

    // Generate QR code for the provided data with different sizes
    QRcode::png($data, $filename1, QR_ECLEVEL_L, 5, 1);
    QRcode::png($data, $filename2, QR_ECLEVEL_L, 10, 1);
    QRcode::png($data, $filename3, QR_ECLEVEL_L, 20, 1);

    // Display the QR code images
    echo '<img src="' . $filename1 . '" alt="QR Code 1">';
    echo '<img src="' . $filename2 . '" alt="QR Code 2">';
    echo '<img src="' . $filename3 . '" alt="QR Code 3">';
}

// Check if data1 is provided
if (isset($_GET['data1'])) {
    $data1 = $_GET['data1'];
    $data2 = isset($_GET['data2']) ? $_GET['data2'] : null;

    // Generate and display QR code for the provided data
    generateAndDisplayQRCode($data1, $data2);
} else {
    // Display an error if no data1 is provided
    echo 'Error: Data1 parameter is missing.';
}
?>
