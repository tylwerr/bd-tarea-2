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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .card {
        border: 1px solid #ccc;
        margin: 10px;
        padding: 10px;
        text-align: center;
        background-color: #f9f9f9;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        display: inline-block;
        }

        .card div {
            font-size: 20px;
            margin: 10px 0;
        }

        .card img {
            width: 200px; /* Ancho fijo */
            height: 150px; /* Alto fijo */
            object-fit: cover; /* Para asegurar que la imagen llena el tamaño fijo */
        }
    </style>
</head>

<body>
    <h1>Recetas</h1>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top" alt="<?php echo $row['nombre_receta']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                            <a href="valorar.php?nombre_receta=<?php echo urlencode($row['nombre_receta']);?>" class="btn btn-primary">Valorar</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
