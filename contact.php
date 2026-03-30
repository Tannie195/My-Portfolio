<?php
  
  $receiving_email_address = "muzanitanatswa@gmail.com";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo "Please complete the form and try again.";
      exit;
    }

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($receiving_email_address, $subject, $email_content, $email_headers)) {
      http_response_code(200);
      echo "OK"; // The JS script looks for "OK" to show the success message
    } else {
      http_response_code(500);
      echo "Oops! Something went wrong and we couldn't send your message.";
    }
  } else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
  }
?>