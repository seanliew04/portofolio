<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "yourname@gmail.com"; // 🔁 Replace with your actual email
    $subject = "New Contact Message from Portfolio Website";

    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "fail";
    }
}
?>
