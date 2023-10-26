<?php
include_once("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $nombre_usuario = $_POST['nombre_usuario'];

    
    $conn = Cconexion::ConexionBD();
    $sql = "UPDATE usuarios SET ultima_sesion = NOW() WHERE email = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $contrasena]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $nombre_usuario = $row['nombre_usuario'];
        session_start();
        $_SESSION['email'] = $email; 
        $_SESSION['nombre_usuario'] = $nombre_usuario; 
        $updateSql = "UPDATE usuarios SET ultima_sesion = NOW() WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute([$email]);
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
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" required>
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