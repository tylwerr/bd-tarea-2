<?php 
include("top_bar.php");


if (!isset($_SESSION['recetas'])) {
    $sql = "SELECT * 
            FROM recetas
            WHERE tipo_platillo = 'Plato de fondo' 
            ORDER BY RAND() LIMIT 3 ";
    $resultado = $conn->query($sql);
    $_SESSION['recetas'] = $resultado->fetchAll(PDO::FETCH_ASSOC);
}

$recetas = $_SESSION['recetas'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_receta'])) {
    $id_receta = $_POST['id_receta'];

    $sql_voto = "SELECT COUNT(*) AS num_votos
                 FROM votos 
                 WHERE id_user = ?";
    $stmt_voto = $conn->prepare($sql_voto);
    $stmt_voto->execute([$id_usuario]);
    $row_voto = $stmt_voto->fetch();
    $existe_voto = $row_voto['num_votos'];
    
    if ($existe_voto == 0){
        $sql_insert = "INSERT INTO votos (id_user,id_receta) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->execute([$id_usuario,$id_receta]);

    } elseif ($existe_voto == 1){
        $sql_update = "UPDATE votos
                       SET id_receta = ?
                       WHERE id_user = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([$id_receta,$id_usuario]);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votación Semanal</title>

    <style>
        .col-md-4 {
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .votar {
            margin-bottom: 15px;
        }
        
        .seleccionar-btn {
            padding: 8px 16px;
            font-size: 14px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .seleccionar-btn.selected {
            background-color: #e74c3c;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="principal.php" class="btn btn-back">Atrás</a>
    </div>

    <h2 class="text-center my-5">Votación Semanal</h2>

    <div class="container">
        <form action="votacion_semanal.php" method="POST">
            <div class="row">
                <?php foreach ($recetas as $row) {

                    $sql_cantidad = "SELECT COUNT(id_voto) as cantidad_votos
                                    FROM votos
                                    WHERE id_receta = ?";
                    $stmt_cantidad = $conn->prepare($sql_cantidad);
                    $stmt_cantidad->execute([$row['id_receta']]);
                    $row_cantidad = $stmt_cantidad->fetch();

                    if (isset($row_cantidad['cantidad_votos'])) {
                        $cantidad_votos = $row_cantidad['cantidad_votos'];
                    } else {
                        $cantidad_votos = 0;
                    } ?>

                    <div class="col-md-4">
                        <div class="card">

                            <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['nombre_receta']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                                <p class='card-text'><small class='text-body-secondary'>Cantidad de votos: <?php echo $cantidad_votos; ?></small></p>
                                <input type="hidden" name="id_receta" value="<?php echo $row['id_receta']; ?>">
                                <button type="submit" class="btn btn-primary seleccionar-btn" id="<?php echo $row['id_receta']; ?>" name="votar">Seleccionar</button>
                                <a href="ver_receta.php?id_receta=<?php echo urlencode($row['id_receta']);?>&mensaje=&ocultar_calificacion=true &ocultar_botones=true" class="btn btn-primary">Ver</a>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.seleccionar-btn');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    buttons.forEach(function(btn) {
                        btn.classList.remove('selected');
                    });
                    this.classList.add('selected');
                });
            });
        });
    </script>
</body>
</html>