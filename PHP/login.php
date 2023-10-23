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
        header("location: principal.php"); 
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-49%, -49%);
        }
    </style>

</head>
<body>
<form class="col-4 p-5" method="POST" action="login.php">
    <h3 class="text-center text-secondary">Iniciar Sesión</h3>
    <div class="mb-3">
        <label for="nombre_usuario" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
    </div>
    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
    </div>
    <button type="submit" class="btn btn-primary" name="login" value="ok">Entrar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>