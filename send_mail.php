<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Ops! Qualcosa è andato storto. Riprova.";
        exit;
    }

    $recipient = "ghostwriterscrews@gmail.com"; // CAMBIA QUI CON LA TUA EMAIL
    $subject = "Nuovo messaggio da Expiry Manager";
    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Messaggio:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Grazie! Il tuo messaggio è stato inviato con successo.";
    } else {
        http_response_code(500);
        echo "Ops! Qualcosa non ha funzionato. Riprova più tardi.";
    }

} else {
    http_response_code(403);
    echo "C'è stato un problema con la richiesta.";
}
?>
