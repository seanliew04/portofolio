<?php
// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// 1. Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "portfolio-liew";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_messages_liew (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'supertayergt15@gmail.com';   // ✅ Your Gmail
            $mail->Password   = 'zhze oupm vhvk loop';        // ✅ Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('yourgmail@gmail.com', 'SEGI Portfolio');
            $mail->addAddress($email, $name); // Send to form email input

            $mail->isHTML(true);
            $mail->Subject = 'Liew Zhi Xian sent you a message';
            $mail->Body    = "
                <h2>Hello $name,</h2>
                <p>This message was sent to you from Liew Zhi Xian:</p>
                <blockquote>$message</blockquote>
                <p>Thanks for reading!</p>
                <br><p>Best regards,<br>Liew Zhi Xian</p>
            ";

            $mail->send();
            echo "<script>alert('Message saved and email sent to $email successfully!');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Saved to database, but email failed. Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Failed to save message.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Form - Liew Sze Min</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navigation -->
  <header>
    <div class="logo">SEGI</div>
    <nav>
      <ul>
        <li><a href="liew.html">HOME</a></li>
        <li><a href="about-liew.html">ABOUT ME</a></li>
        <li><a href="skills-liew.html">SKILLS AND PROJECT</a></li>
        <li><a href="contact-liew.php">CONTACT FORM</a></li>
      </ul>
    </nav>
  </header>

  <!-- Contact Form Section -->
  <section class="contact-page">
    <div class="container">
      <h2>Contact Form </h2>
      <form method="POST" class="contact-form">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
        <button type="submit" class="btn">Send Message</button>
      </form>
    </div>
  </section>

  <!-- Submission History Section -->
  <section class="contact-page" style="margin-top: 60px;">
    <div class="container">
      <h2>Message History</h2>
      <table style="width:100%; border-collapse: collapse; color: white;">
        <tr style="background-color: #ff2e63;">
          <th style="padding: 10px;">Name</th>
          <th style="padding: 10px;">Email</th>
          <th style="padding: 10px;">Message</th>
          <th style="padding: 10px;">Submitted At</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM contact_messages_liew ORDER BY submitted_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr style='border-bottom: 1px solid #444;'>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['message']) . "</td>";
            echo "<td style='padding: 10px;'>" . $row['submitted_at'] . "</td>";
            echo "</tr>";
        }
        ?>
      </table>
    </div>
  </section>

</body>
</html>
