<!DOCTYPE html>
<html>
<head>
  <title>Test d'envoi d'e-mail</title>
</head>
<body>
  <h1>Test d'envoi d'e-mail</h1>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $headers = "From: expediteur@example.com";

    if (mail($to, $subject, $message, $headers)) {
      echo 'L\'e-mail a été envoyé avec succès.';
    } else {
      echo 'Erreur lors de l\'envoi de l\'e-mail.';
    }
  }
  ?>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="to">Destinataire:</label>
    <input type="email" id="to" name="to" required><br><br>

    <label for="subject">Sujet:</label>
    <input type="text" id="subject" name="subject" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="5" required></textarea><br><br>

    <input type="submit" value="Envoyer">
  </form>
</body>
</html>
