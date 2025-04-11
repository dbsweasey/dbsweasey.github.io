<?php

// Not currently functional. If this website ever gets hosted, I'll switch to this for captcha

// Check request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secret = "";
    $response = $_POST["g-recaptcha-response"];

    // Verify captcha 
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response")
    $captcha_success = json_decode($verify);

    if ($captcha_success->success) {
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        $to = "davidbsweasey@gmail.com"
        $subject = ""
        $headers = "From: $email" . "\r\n" .
                    "Reply-To: $email" . "\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";
        $body = "Message from $name ($email)\n\n$message";

        if (mail($to, $subject, $body, $headers)) {
            echo "Thanks for reaching out!"
        } else {
            echo "Message failed to send."
        }
    } else {
        echo "Captcha verification failed. Please try again.";
    }
}
?>