<?php
include_once("config.php");

session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $updateSql = "UPDATE usuarios SET ultima_sesion = NOW() WHERE email = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([$email]);

    session_destroy();
    header("location: index.php");
}
?>
