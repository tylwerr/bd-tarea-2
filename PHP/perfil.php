<?php
session_start();
include("boton_volver.php");

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
include("config.php");
$conn = Cconexion::ConexionBD();
$email = $_SESSION['email'];
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $sql = "UPDATE usuarios SET nombre_usuario = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nuevo_nombre, $email]);
    header("location: perfil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Nombre de Usuario: <?php echo $user['nombre_usuario']; ?></p>
    <p>Última Sesión: <?php echo $user['ultima_sesion']; ?></p>

    <button id="editButton" onclick="toggleEditForm()">Editar</button>

    <div id="editForm" style="display: none;">
        <h3>Editar Nombre de Usuario</h3>
        <form method="POST" action="perfil.php">
            <label for="nuevo_nombre">Nuevo nombre:</label>
            <input type="text" id="nuevo_nombre" name="nuevo_nombre" required>
            <br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <script>
        function toggleEditForm() {
            const editForm = document.getElementById("editForm");
            const editButton = document.getElementById("editButton");
            if (editForm.style.display === "none") {
                editForm.style.display = "block";
                editButton.textContent = "Cancelar";
            } else {
                editForm.style.display = "none";
                editButton.textContent = "Editar";
            }
        }
    </script>
</body>
</html>