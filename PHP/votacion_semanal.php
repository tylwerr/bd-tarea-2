<?php 
include("top_bar.php");

$sql = "SELECT * FROM recetas WHERE tipo_platillo = 'Plato de fondo' ORDER BY RAND() LIMIT 3 ";
$resultado = $conn->query($sql);
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
                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['nombre_receta']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                                <button type="button" class="btn btn-primary seleccionar-btn" data-id="<?php echo $row['id_receta']; ?>">Seleccionar</button>
                                <a href="ver_receta.php?id_receta=<?php echo urlencode($row['id_receta']);?>&mensaje=&ocultar_calificacion=true &ocultar_botones=true" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="mt-3 text-center">
                <button type="submit" class="btn votar btn-primary">Votar</button>
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