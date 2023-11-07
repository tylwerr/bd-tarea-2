<?php
include("top_bar.php");
$id_receta = $_GET['id_receta'];
$mensaje = '';

if (isset($_SESSION['email'])) {

    $sql = "SELECT vr.id_user, vr.calificacion, vr.comentario, vr.fecha_resena, u.nombre_usuario
            FROM vista_resenas vr
            JOIN usuarios u ON u.id = vr.id_user
            WHERE vr.id_receta = ?
            ORDER BY vr.fecha_resena DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_receta]);

    if ($stmt->rowCount() == 0) {
        $mensaje = "¡Todavía no hay reseñas!";
    }
    
} else {
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>

    <style>
        .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .col-md-5 {
            background: #f3f3f3; 
            padding: 20px;
            border-radius: 10px;
            margin: auto;
        }

        label.col.control-label {
            margin-left: 10px;
        }
        
        .form-horizontal {
            margin: 30px;
        }

        .alert {
            width: 25%;
            margin: auto;
        }

        .container {
            margin: auto;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="ver_receta.php?id_receta=<?php echo urlencode($id_receta);?>&mensaje=" class="btn btn-back">Atrás</a>
    </div>

    <h2 class="text-center my-5">Reseñas de usuarios</h2>

    <?php if ($mensaje === "¡Todavía no hay reseñas!"): ?> 
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <?php if ($stmt->rowCount() > 0) {?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nombre_usuario = $row['nombre_usuario'];
                $calificacion = $row['calificacion'];
                $comentario = $row['comentario'];
                $fecha_resena = $row['fecha_resena']; ?>

                <div class="col-md-5">
                    <div class="card">
                        <h3 class="text-center my-3"><?php echo $nombre_usuario?></h3>
                        <form class="form-horizontal">

                            <div class="form-group">
                                <label class="col control-label">Calificación</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($calificacion); ?></p>
                            </div>
                                            
                            <div class="form-group">
                                <label class="col control-label">Comentario</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($comentario); ?></p>
                            </div>

                            <div class="form-group">
                                <label class="col control-label">Fecha</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($fecha_resena); ?></p>
                            </div>
                                
                        </form>            
                    </div>
                </div>
        <?php } }?>
    </div>

</body>
</html>