
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Sabor USM</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(rgba(243, 243, 243, 0.5), rgba(243, 243, 243, 0.5)), url('../IMG/CDMU_Comedor.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #f3f3f3;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

        h1 {
            font-size: 36px;
        }
        .container {
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
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
    <div class="container">
        <h1>Bienvenido a Sabor USM</h1>
        <div class="animation-container">
            <img class="animation-image" src="https://upload.wikimedia.org/wikipedia/commons/4/47/Logo_UTFSM.png" alt="Logo USM">
        </div>
        <div class="button-container">
            <a href="login.php" class="button">Iniciar Sesión</a>
            <a href="registro.php" class="button">Registrarse</a>
        </div>
    </div>
</body>
</html>
