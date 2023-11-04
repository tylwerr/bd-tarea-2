<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
$mensaje = ""; 
$comentario = "";
$alerta = false;
$alerta_buena = false;
$alerta_mala = false;

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    // uso de JOIN ahorra dos consultas
    $sql = "SELECT user.id AS id_usuario, r.nombre_receta 
            FROM usuarios user
            JOIN recetas r ON r.id_receta = ?
            WHERE user.email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_receta, $email]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $id_usuario = $row['id_usuario'];
        $nombre_receta = $row['nombre_receta'];
    }

} else {
    header("location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $calificacion = $_POST['calificacion'];

    // verifica si ya se hizo una reseña
    $sql_resena = "SELECT COUNT(*) AS num_resenas FROM resenas WHERE id_user = ? AND id_receta = ?";
    $stmt_resena = $conn->prepare($sql_resena);
    $stmt_resena->execute([$id_usuario, $id_receta]);
    $existe_resena = ($stmt_resena->fetchColumn() > 0);
    
    if ($existe_resena) {
        $alerta = true;
        $mensaje = "¡Ya has calificado esta receta!";
    
    } else {
        // agrega reseña
        if ($calificacion >= 1 && $calificacion <= 5) {
            $sql_insert = "INSERT INTO resenas (id_user, id_receta, comentario, calificacion, fecha_resena) VALUES (?, ?, ?, ?, NOW())";
            $stmt_insert = $conn->prepare($sql_insert);
        }

        if ($stmt_insert->execute([$id_usuario, $id_receta, $comentario, $calificacion])) {
            $alerta_buena = true;
            $mensaje = "Ingreso de reseña exitosa.";
        } else {
            $alerta_mala = true;
            $mensaje = "Error al agregar la reseña.";
        }
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
            background-image: linear-gradient(rgba(243, 243, 243, 0.5), rgba(243, 243, 243, 0.5));
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #f3f3f3;
        }

        .top-bar {
            background-color: #074469;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .right-image {
            width: 300px;
            height: 60px;
            margin-right : 10px;
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

        .custom-alert {
            width: 50%;
            margin: auto;
        }

        .bi {
        width: 1.5em;
        height: 1.5em;
        }

    </style>
</head>

<body>
    <div class="top-bar">
        <img class="right-image" src="//aula.usm.cl/pluginfile.php/1/theme_moove/logo/1697696553/marca-color.png" alt="USM04">
    </div>
    <div style="margin: 10px;">
        <a href="ver_receta.php?id_receta=<?php echo $id_receta?>&mensaje=" class="btn btn-primary">Atrás</a>
    </div>
    <h2 class="text-center my-5"><?php echo "Reseña de ". $nombre_receta?></h2>

    <p class="text-center my-5">Recuerda opinar seriamente, ¡sus comentarios nos importan!</p>

    <?php if ($alerta_buena): ?>
        <div class="alert alert-success custom-alert d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Success:">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>
                <?php echo $mensaje ?>
            </div>
        </div>
    <?php elseif ($alerta): ?>
        <div class="alert alert-primary custom-alert d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                <?php echo $mensaje ?>
            </div>
        </div>
    <?php elseif ($alerta_mala): ?>
        <div class="alert alert-danger custom-alert d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Danger:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                <?php echo $mensaje ?>
            </div>
        </div>
    <?php endif; ?>

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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>