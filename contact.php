<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting and sanitizing form inputs
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Validating inputs
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        echo "Invalid phone number. Please enter a valid phone number with 10 to 15 digits.";
        exit;
    }

    // Preparing the email
    $to = "your-email@example.com"; // Replace with your email
    $headers = "From: $name <$email>\r\n";
    $email_subject = "Contact Form Message";
    $email_body = "You have received a new message from the contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Phone: $phone\n".
                  "Message:\n$message";

    // Sending the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully.";
    } else {
        echo "Message could not be sent.";
    }
} else {
    echo "Invalid request method.";
}
?>
