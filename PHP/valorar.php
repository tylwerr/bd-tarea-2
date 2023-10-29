<?php
include("config.php");
session_start();
$nombre_receta = $_GET['nombre_receta'];
$mensaje = ""; 
$comentarioPredefinido = "";
$comentario = "";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql_usuario = "SELECT id, nombre_usuario FROM usuarios WHERE email = ?";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->execute([$email]);

    if ($stmt_usuario->rowCount() == 1) {
        $row_usuario = $stmt_usuario->fetch();
        $id_usuario = $row_usuario['id'];
        $nombre_usuario = $row_usuario['nombre_usuario'];


        $sql_receta = "SELECT id_receta FROM recetas WHERE nombre_receta = ?";
        $stmt_receta = $conn->prepare($sql_receta);
        $stmt_receta->execute([$nombre_receta]);

        if ($stmt_receta->rowCount() == 1) {
            $row_receta = $stmt_receta->fetch();
            $id_receta = $row_receta['id_receta'];

        }
    }
} else {
    header("location: login.php");
    exit();
}

$sql_imagen = "SELECT url_imagen FROM recetas WHERE nombre_receta = ?";
$stmt_imagen = $conn->prepare($sql_imagen);
$stmt_imagen->execute([$nombre_receta]);
if ($stmt_imagen->rowCount() == 1) {
    $row_imagen = $stmt_imagen->fetch();
    $url_imagen = $row_imagen['url_imagen'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $calificacion = $_POST['calificacion'];
    if ($calificacion >= 1 && $calificacion <= 5) {
        $sql_insert = "INSERT INTO resenas (id_user, id_receta, comentario, calificacion) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
    }
    
    if ($stmt_insert->execute([$id_usuario, $id_receta, $comentario, $calificacion])) {
        $mensaje = "Ingreso de reseña exitosa.";
    } else {
        $mensaje = "Error al agregar la reseña.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        img {
            height: 400px;
            object-fit: cover; 
        }

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="recetas.php" class="btn btn-primary">Atrás</a>
    </div>
    <h2 class="text-center my-5">Reseña</h2>

    <img src="<?php echo $url_imagen; ?>"  alt="<?php echo $nombre_receta; ?>">
    <h2><?php echo $nombre_receta; ?></h2>
    <form method="POST">
        <label for="calificacion">Calificar la receta (1-5):</label>
        <input type="number" name="calificacion" id="calificacion" min="1" max="5" required>
        <br>
        <label for="comentario">Añadir un comentario:</label>
        <textarea name="comentario" id="comentario" rows="4" cols="50" required><?php echo $comentario; ?></textarea>
        <br>
        <input type="submit" value="Enviar reseña">
    </form>
    
    <p><?php echo $mensaje; ?></p>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</html>