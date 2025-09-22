<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $name = $_POST['cli_name'];
    $email = $_POST['cli_email'];
    $service = $_POST['services'];
    $date = $_POST['date'];

    // Debugging: Check if form data is received correctly
    error_log("Form data received: Name=$name, Email=$email, Service=$service, Date=$date");

    // Email configuration
    $to = "priyankatiwari.hbsoftweb@gmail.com";  // Replace with your email address
    $subject = "New Appointment Request from $name";
    
    // Email message body
    $message = "
    <html>
    <head>
    <title>New Appointment Request</title>
    </head>
    <body>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Service Requested:</strong> $service</p>
    <p><strong>Preferred Date:</strong> $date</p>
    </body>
    </html>
    ";

    // Headers to send HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Debugging: Check headers and message before sending email
    error_log("Headers: " . $headers);
    error_log("Message: " . $message);

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect to thank-you page after email is sent
        header("Location: thank-you.html");  // Replace with your thank-you page URL
        exit;  // Make sure to stop the script after the redirect
    } else {
        // If mail fails, output error
        echo "There was an error sending your appointment request. Please try again.";
        error_log("Mail failed to send. Please check the configuration.");
    }
}
?>
