<?php
include("config.php");
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();
    $sql = "SELECT nombre_usuario FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $nombre_usuario = $row['nombre_usuario'];
        $mensaje = "¡Hola, $nombre_usuario!";
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
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            background-color: #074469;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            
        }

        .user-name {
            font-size: 24px;
            cursor: pointer; 
        }

        .content {
            padding: 20px;
        }

        .logout-button {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .profile-menu {
            display: none;
            position: absolute;
            background-color: #0E76A8;
            border-radius: 5px;
            z-index: 1;
            width: 120px;
            text-align: center;
            top: 7%; 
            right: 2%; 
        }

        .profile-item {
            padding: 10px;
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .profile-item:hover {
            background-color: #0056b3;
        }

        .right-image {
            width: 300px;
            height: 60px;
            margin-right : 10px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
         <img class="right-image" src="//aula.usm.cl/pluginfile.php/1/theme_moove/logo/1697696553/marca-color.png" alt="USM04">
        <div class="user-info">
            <img class="user-image" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Foto de perfil">
            <h2 class="user-name" id="user-name"><?php echo $mensaje; ?></h2>
            <div class="profile-menu" id="profile-menu">
                <a class="profile-item" href="perfil.php">Perfil</a>
                <a class="profile-item" href="#">Favoritos</a>
                <a class="profile-item" href="cerrar_sesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row gy-3">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                    <img src="https://www.fmdos.cl/wp-content/uploads/2020/02/Comida-chilena-1024x680.jpg" class="card-img-top" alt="Foto recetas">
                    <div class="card-body">
                        <h5 class="card-title">Recetas</h5>
                        <p class="card-text">Charlitos rajate con los completos</p>
                        <a href="recetas.php" class="btn btn-primary">Ver todas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userName = document.getElementById("user-name");
        const profileMenu = document.getElementById("profile-menu");
        
        userName.addEventListener("click", () => {
            profileMenu.style.display = (profileMenu.style.display === "block") ? "none" : "block";
        });

       
        document.addEventListener("click", (event) => {
            if (!userName.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.style.display = "none";
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>