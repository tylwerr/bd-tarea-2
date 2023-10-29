<?php
include_once("config.php");
session_start();
$conn = Cconexion::ConexionBD();
$nombre_receta = $_GET['nombre_receta'];

$sql_info_receta = "
    SELECT id_receta, tipo_platillo, tiempo_preparacion, etiquetas, instrucciones, ingredientes, url_imagen
    FROM recetas
    WHERE nombre_receta = ?
";

$stmt_info_receta = $conn->prepare($sql_info_receta);
$stmt_info_receta->execute([$nombre_receta]);

if ($stmt_info_receta->rowCount() == 1) {
    $row_info_receta = $stmt_info_receta->fetch();
    $id_receta = $row_info_receta['id_receta'];
    $tipo_platillo = $row_info_receta['tipo_platillo'];
    $tiempo_preparacion = $row_info_receta['tiempo_preparacion'];
    $etiquetas = $row_info_receta['etiquetas'];
    $instrucciones = $row_info_receta['instrucciones'];
    $ingredientes = $row_info_receta['ingredientes'];
    $url_imagen = $row_info_receta['url_imagen'];
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
        .col-sm-6 {
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
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

    <div class="row justify-content-center">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card mb-3">
                <img src="<?php echo $url_imagen; ?>" class="card-img-top" alt="<?php echo $nombre_receta; ?>">
                <div class="card-body">
                    <p class="card-text"><?php echo "Tipo de platillo: " . $tipo_platillo . "<br>" .
                    "Tiempo de preparación: " . $tiempo_preparacion . "<br>" .
                    "Etiquetas: " . $etiquetas . "<br>" .
                    "Ingredientes: " . $ingredientes . "<br>" .
                    "Instrucciones: " . $instrucciones; ?></p>
                    <p class="card-text"><small class="text-body-secondary"><?php echo "Promedio de calificaciones: " . number_format($promedio, 2); ?></small></p>
                </div>
                <div style="margin: 10px;">
                    <a href="valorar.php?nombre_receta=<?php echo $nombre_receta?>" class="btn btn-primary">Valorar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</html>