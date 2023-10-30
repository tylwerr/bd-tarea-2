<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
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


        $sql_receta = "SELECT nombre_receta FROM recetas WHERE id_receta = ?";
        $stmt_receta = $conn->prepare($sql_receta);
        $stmt_receta->execute([$id_receta]);

        if ($stmt_receta->rowCount() == 1) {
            $row_receta = $stmt_receta->fetch();
            $nombre_receta = $row_receta['nombre_receta'];

        }
    }
} else {
    header("location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $calificacion = $_POST['calificacion'];
    if ($calificacion >= 1 && $calificacion <= 5) {
        $sql_insert = "INSERT INTO resenas (id_user, id_receta, comentario, calificacion, fecha_resena) VALUES (?, ?, ?, ?, NOW())";
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
        body {
            background-image: linear-gradient(rgba(243, 243, 243, 0.5), rgba(243, 243, 243, 0.5)), url('../IMG/resenas.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #f3f3f3;
        } 

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .send {
            background-color: #388E3C; 
            color: #fff; 
            border: 1px #388E3C; 
            padding: 5px 14px; 
            border-radius: 4px; 
            margin: 10px;
        }
        
        .text-center {
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 1);
            color: black;
        }

        .form-label{
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 1);
            color: black;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="ver_receta.php?id_receta=<?php echo $id_receta?>" class="btn btn-primary">Atrás</a>
    </div>
    <h2 class="text-center my-5"><?php echo "Reseña de ". $nombre_receta?></h2>

    <p class="text-center my-5">Recuerda opinar seriamente, ¡sus comentarios nos importan!</p>

    <form method="POST" style="margin: 100px;">
        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificar la receta (1-5):</label>
            <input type="number" class="form-control" name="calificacion" id="calificacion" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Añadir un comentario:</label>
            <textarea class="form-control" name="comentario" id="comentario" rows="4" cols="50"><?php echo $comentario; ?></textarea>
        </div>
        <input class="btn btn-primary send" type="submit" value="Enviar reseña">
    </form>
    
    <p><?php echo $mensaje; ?></p>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</html>