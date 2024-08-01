<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize input
    $cardNumber = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_STRING);
    $expiry = filter_input(INPUT_POST, "expiry", FILTER_SANITIZE_STRING);
    $cvv = filter_input(INPUT_POST, "cvv", FILTER_SANITIZE_STRING);

    // Perform further validation as needed

    // Simulate payment processing
    $paymentSuccess = true;  // For demonstration purposes

    if ($paymentSuccess) {
        $response = array("success" => true, "message" => "Payment successful!");
    } else {
        $response = array("success" => false, "message" => "Payment failed. Please try again.");
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
?>