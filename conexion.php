<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/conexion.css">
    <title>conexion mysql</title>
</head>

<body>
    <center>
        <?php
        $enlace = mysqli_connect("localhost", "root", "", "registro_asistencia");
        if (!$enlace) {
            die("no puede conectarce ala base de datos " . mysqli_connect_error());
        }
        echo "conexion exitosa";
        mysqli_close($enlace);
        ?>
    </center>
    <div>
        <center><a href="index.php" class="regresar-boton">Regresar</a></center>

    </div>

</body>

</html>