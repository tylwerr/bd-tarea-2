<?php
include_once("config.php");
session_start();


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql = "SELECT user.id AS id_usuario, r.id_receta, r.calificacion, r.comentario, r.fecha_resena
            FROM usuarios user
            JOIN resenas r ON r.id_user = user.id
            WHERE user.email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

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
    <title>Tus reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
         .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .col-md-4 {
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
        }       
    
    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="perfil.php" class="btn btn-back">Atrás</a>
    </div>


    <div class="container">
        <div class="row">

            <?php if ($stmt->rowCount() > 0) {?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_usuario = $row['id_usuario'];
                    $id_receta = $row['id_receta'];
                    $calificacion = $row['calificacion'];
                    $comentario = $row['comentario'];
                    $fecha_resena = $row['fecha_resena']; ?>

                    <div class="col-md-4">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Calificación</label>
                                    <div class="col-sm-10">
                                    <p class="form-control" readonly><?php echo htmlspecialchars($calificacion); ?></p>  
                                    </div>
                                </div>
                                            
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Comentario</label>
                                    <div class="col-sm-10">
                                    <p class="form-control" readonly><?php echo htmlspecialchars($comentario); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <p class="form-control" readonly><?php echo htmlspecialchars($fecha_resena); ?></p>
                                    </div>
                                </div>
                            </form>            
                        </div>
                    </div>
            <?php } }?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>