<?php
session_start();
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $mensaje = "¡Hola, $nombre_usuario!";
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
        }

        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 800px;
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
            <img class="user-image" src="https://img.favpng.com/23/0/3/computer-icons-user-profile-clip-art-portable-network-graphics-png-favpng-YEj6NsJygkt6nFTNgiXg9fg9w.jpg" alt="Foto de perfil">
            <h2 class="user-name" id="user-name"><?php echo $mensaje; ?></h2>
            <div class="profile-menu" id="profile-menu">
                <a class="profile-item" href="#">Perfil</a>
                <a class="profile-item" href="#">Favoritos</a>
                <a class="profile-item" href="cerrar_sesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <div class="content">
        <!-- página principal -->
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
</body>
</html>
