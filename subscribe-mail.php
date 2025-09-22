<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email field is filled
    if (isset($_POST['wdt_mc_emailid'])) {
        $email = filter_var($_POST['wdt_mc_emailid'], FILTER_SANITIZE_EMAIL);

        // Validate the email address
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set the email recipient
            $to = "priyankatiwari.hbsoftweb@gmail.com";  // Your email address
            $subject = "New Subscription Request";

            // Prepare the message body
            $message = "
            <html>
            <head>
            <title>New Subscription Request</title>
            </head>
            <body>
            <p><strong>Email:</strong> $email</p>
            </body>
            </html>
            ";

            // Set email headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: no-reply@yourdomain.com" . "\r\n";  // Replace with a valid "From" address
            $headers .= "Reply-To: $email" . "\r\n";

            // Send the email
            if (mail($to, $subject, $message, $headers)) {
                // Redirect to thank-you page after successful submission
                header("Location: thank-you.html");  // Replace with your actual thank-you page URL
                exit;  // Make sure to stop the script after the redirect
            } else {
                echo "There was an error sending your subscription request. Please try again.";
            }
        } else {
            echo "Invalid email address.";
        }
    } else {
        echo "Email field is missing.";
    }
}
?>
