<?php
include_once("config.php");
session_start();
$conn = Cconexion::ConexionBD();
$nombre_receta = $_GET['nombre_receta'];

$sql_receta = "SELECT id_receta FROM recetas WHERE nombre_receta = ?";
$stmt_receta = $conn->prepare($sql_receta);
$stmt_receta->execute([$nombre_receta]);

if ($stmt_receta->rowCount() == 1) {
    $row_receta = $stmt_receta->fetch();
    $id_receta = $row_receta['id_receta'];

}

$sql_imagen = "SELECT url_imagen FROM recetas WHERE nombre_receta = ?";
$stmt_imagen = $conn->prepare($sql_imagen);
$stmt_imagen->execute([$nombre_receta]);
if ($stmt_imagen->rowCount() == 1) {
    $row_imagen = $stmt_imagen->fetch();
    $url_imagen = $row_imagen['url_imagen'];
}


$sql_promedio = "SELECT AVG(calificacion) AS promedio FROM resenas WHERE id_receta = ?";
$stmt_promedio = $conn->prepare($sql_promedio);
$stmt_promedio->execute([$id_receta]);

if ($stmt_promedio->rowCount() > 0) {
    // Mostrar el promedio de las calificaciones
    $row_promedio = $stmt_promedio->fetch();
    $promedio = $row_promedio["promedio"];
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
    <h2 class="text-center my-5"><?php echo $nombre_receta; ?></h2>

    <img src="<?php echo $url_imagen; ?>"  alt="<?php echo $nombre_receta; ?>">
    <p><?php echo "Promedio de calificaciones: " . number_format($promedio, 2); ?></p>
    <a href="valorar.php?nombre_receta=<?php echo $nombre_receta?>" class="btn btn-primary">Valorar</a>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</html>