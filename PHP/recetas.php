<?php

include_once("config.php");
$conn = Cconexion::ConexionBD();

if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
} else {
    $orden = 'ascendente';
}
if (isset($_GET['q'])) {
    $consulta = $_GET['q'];
    $filtro = $_GET['filtro'];
    
    if (!empty($filtro)) {
        $sql = "SELECT * FROM recetas WHERE (nombre_receta LIKE :consulta OR ingredientes_filtro LIKE :consulta) AND (etiquetas LIKE :filtro OR tipo_platillo LIKE :filtro) ORDER BY promedio_calificaciones " . ($orden === 'ascendente' ? 'ASC' : 'DESC');
        $stmt = $conn->prepare($sql);
        $stmt->execute([':consulta' => '%' . $consulta . '%', ':filtro' => '%' . $filtro . '%']);
    } else {
        $sql = "SELECT * FROM recetas WHERE nombre_receta LIKE :consulta OR ingredientes_filtro LIKE :consulta ORDER BY promedio_calificaciones " . ($orden === 'ascendente' ? 'ASC' : 'DESC');
        $stmt = $conn->prepare($sql);
        $stmt->execute([':consulta' => '%' . $consulta . '%']);
    }
} else {
    $sql = "SELECT * FROM recetas ORDER BY promedio_calificaciones " . ($orden === 'ascendente' ? 'ASC' : 'DESC');
    $stmt = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .col-md-4 {
            background: rgba(255, 255, 255, 0.8); 
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
        
    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="principal.php" class="btn btn-back">Atrás</a>
    </div>
    <h2 class="text-center my-5">Recetas</h2>
    <div class="container">
        <form action="recetas.php" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Buscar recetas/ingrediente">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            <div class="mt-2">
                <label for="orden" class="form-label">Ordenar por:</label>
                <select name="orden" class="form-select" id="orden" style="max-width: 200px">
                    <option selected disabled>Seleccione una opcion:</option>
                    <option value="ascendente">Calificacion (De menor a mayor)</option>
                    <option value="descendente">Calificacion (De mayor a menor)</option>
                </select>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-secondary" id="mostrarFiltro">Filtro de alimentos</button>
                <div id="filtroDropdown" style="display: none;">
                    <select name="filtro" class="form-select">
                        <option value="">Todas las recetas </option>
                        <optgroup label="Tipos de menu">
                            <option value="Tiene gluten">Con gluten</option>
                            <option value="Sin gluten" >Sin gluten</option>
                            <option value="Tiene lactosa">Con lactosa</option>
                            <option value="Sin lactosa">Sin lactosa</option>
                            <option value="Apto para diabéticos"> Para diabeticos</option>
                            <option value="Apto para veganos"> Para veganos</option>
                        </optgroup>
                        <optgroup label = "Tipo de platos">
                            <option value="Entrada">Plato de entrada</option>
                            <option value="Plato de fondo">Plato de fondo</option>
                            <option value="Postre">Postre</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </form>
        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['nombre_receta']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                        <a href="ver_receta.php?id_receta=<?php echo urlencode($row['id_receta']);?>&mensaje=" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script>   
        const mostrarFiltrosButton = document.getElementById('mostrarFiltro');
        const filtroDropdown = document.getElementById('filtroDropdown');
        const ordenSelect = document.getElementById('orden');


        mostrarFiltrosButton.addEventListener('click', function() {
            if (filtroDropdown.style.display === 'none') {
                filtroDropdown.style.display = 'block';
            } else {
                filtroDropdown.style.display = 'none';
            }
        });

        ordenSelect.addEventListener('change', function() {
            document.forms[0].submit();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"> </script>
</body>
</html>