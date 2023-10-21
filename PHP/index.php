

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor USM</title>
</head>
<body>
    <h2>Bienvenido</h2>
    <a href="login.php"><button type="button">Iniciar Sesión</button></a>
    <a href="registro.php"><button type="button">Registrarse</button></a>

</body>
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Sabor USM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            text-align: center;
        }

        h1 {
            font-size: 36px;
        }

        .animation-container {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            position: relative;
            animation: moveImage 2s infinite;
        }

        @keyframes moveImage {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        .animation-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin: 10px;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a Sabor USM</h1>
    <div class="animation-container">
        <img class="animation-image" src="https://upload.wikimedia.org/wikipedia/commons/4/47/Logo_UTFSM.png" alt="Logo USM">
    </div>
    <div class="button-container">
        <a href="login.php" class="button">Iniciar Sesión</a>
        <a href="registro.php" class="button">Registrarse</a>
    </div>
</body>
</html>
