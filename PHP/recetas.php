<?php
include("boton_volver.php");
include_once("config.php");
$conn = Cconexion::ConexionBD();
$sql = "SELECT * FROM recetas";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
    <style>
        .receta {
        border: 1px solid #ccc;
        margin: 10px;
        padding: 10px;
        text-align: center;
        background-color: #f9f9f9;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        display: inline-block;
        }

        .receta h2 {
            font-size: 20px;
            margin: 10px 0;
        }

        .receta img {
            width: 200px; /* Ancho fijo */
            height: 150px; /* Alto fijo */
            object-fit: cover; /* Para asegurar que la imagen llena el tamaño fijo */
        }
    </style>
</head>
<body>
    <h1>Recetas</h1>
    <div class="recetas-container">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="receta">
                <h2><?php echo $row['nombre_receta']; ?></h2>
                <img src="<?php echo $row['url_imagen']; ?>" alt="<?php echo $row['nombre_receta']; ?>">
                <h3><a href="valorar.php?nombre_receta=<?php echo urlencode($row['nombre_receta']);?>"><button>Valorar</button></a></h3>

            </div>
        <?php } ?>
    </div>
</body>
</html>
