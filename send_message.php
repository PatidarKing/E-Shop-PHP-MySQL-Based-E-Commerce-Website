<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = "your@email.com"; // Your email
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    $subject = "New Contact Form Submission from $name";
    $headers = "From: $email\r\n";
    $headers .= "Content-Type: text/html\r\n";

    $body = "<strong>Name:</strong> $name<br>
             <strong>Email:</strong> $email<br>
             <strong>Message:</strong><br>$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "<p style='text-align:center;color:green;'>✅ Message sent successfully!</p>";
    } else {
        echo "<p style='text-align:center;color:red;'>❌ Failed to send message.</p>";
    }
}
?>
