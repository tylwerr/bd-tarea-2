<?php
include_once("config.php");
include_once("boton_volver.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $almuerzos = $_POST['cantidad_almuerzos'];
       
    $conn = Cconexion::ConexionBD();
    $sql = "INSERT INTO usuarios (nombre_usuario, email, contrasena, cantidad_almuerzos) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre_usuario, $email, $contrasena, $almuerzos]);

    header("location: registro_exitoso.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
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
    <form class="col-4 p-5" method="POST" action="registro.php">
        <h2 class="text-center text-secondary">Registro de Usuario</h2>
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>      
        <div class="mb-3">
            <label for="cantidad_almuerzos" class="form-label">Cantidad de Almuerzos</label>
            <input type="number" class="form-control" id="cantidad_almuerzos" name="cantidad_almuerzos" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary" name="registro" value="ok" >Registrarse</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>