<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
    // Sanitización de datos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validaciones básicas
    if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mensaje)) {
        // Datos del correo
        $destinatario = "alejandromartinezok09@gmail.com"; // Cambiar por tu correo real
        $asunto = "Nuevo mensaje de tu portfolio";
        $contenido = "Nombre: $nombre\n";
        $contenido .= "Email: $email\n\n";
        $contenido .= "Mensaje:\n$mensaje\n";

        $cabeceras = "From: $email";

        // Enviar correo
        if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
            echo "<script>alert('Mensaje enviado con éxito.'); window.location.href='portfolio.html';</script>";
        } else {
            echo "<script>alert('Error al enviar el mensaje.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa todos los campos correctamente.'); window.history.back();</script>";
    }
} else {
    // Si alguien intenta entrar directamente al PHP
    header("Location: portfolio.html");
    exit();
}
?>
