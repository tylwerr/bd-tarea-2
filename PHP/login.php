<?php
include_once("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    
    $conn = Cconexion::ConexionBD();
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre_usuario, $contrasena]);

    if ($stmt->rowCount() == 1) {
        session_start();
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        header("location: bienvenido.php"); 
    } else {
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="login.php">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
