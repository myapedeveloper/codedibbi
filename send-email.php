<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // Initialize an array to hold error messages
    $errors = [];

    // Validate Name
    if (empty($name)) {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 100) {
        $errors[] = 'Name must not exceed 100 characters.';
    }

    // Validate Email
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    // Validate Phone Number
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^\d+$/', $phone)) {
        $errors[] = 'Phone number must contain only digits.';
    } elseif (strlen($phone) > 15) {
        $errors[] = 'Phone number must not exceed 15 digits.';
    }

    // Validate Subject (Message)
    if (empty($subject)) {
        $errors[] = 'Message is required.';
    } elseif (strlen($subject) > 500) {
        $errors[] = 'Message must not exceed 500 characters.';
    }

    // If there are errors, display them
    if (!empty($errors)) {
        echo '<script>alert("' . implode('\\n', $errors) . '"); window.history.back();</script>';
        exit;
    }

    // Prepare email
    $to = 'geetanshisingh28@gmail.com';
    $subject_email = 'New Contact Form Submission';
    $message = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $subject";
    $headers = "From: geetanshisingh28@gmail.com\r\n";

    // Send email
    if (mail($to, $subject_email, $message, $headers)) {
        echo '<script>alert("Your message has been sent successfully!"); window.location.href = "thank_you.html";</script>';
    } else {
        echo '<script>alert("Failed to send email. Please try again later."); window.history.back();</script>';
    }
} else {
    echo '<script>alert("Invalid request."); window.history.back();</script>';
}
?>
