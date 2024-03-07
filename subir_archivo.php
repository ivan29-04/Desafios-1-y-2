<?php

require_once("conexion.php");

$ruta = "Upload/";

foreach ($_FILES as $key) {
    $nombre = $key["name"];
    $ruta_temporal = $key["tmp_name"];

    $fecha = getdate();
    $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "-" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . "-";

    $destino = $ruta . $nombre_v;
    $explo = explode(".", $nombre);

    if ($explo[1] != "csv") {
        $alert = 1;
    } else {
        if (move_uploaded_file($ruta_temporal, $destino)) {
            $alert = 2;
        }
    }
}

$x = 0;
$data = array();
$fichero = fopen($destino, "r");

while (($datos = fgetcsv($fichero, 1000, ";")) !== false) {
    $x++;


    $datos = array_map(function ($dato) {
        return trim($dato, '"');
    }, $datos);


    if (empty(array_filter($datos))) {
        continue;
    }

    $data[] = '(' . $datos[0] . ',"' . $datos[1] . '",' . $datos[2] . ',"' . $datos[3] . '","' . $datos[4] . '","' . $datos[5] . '","' . $datos[6] . '","' . $datos[7] . '")';
}


$conexion = new mysqli("localhost", "root", "", "registro_asistencia");


if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}


$inserta = "INSERT INTO empleado VALUES " . implode(",", $data);


if ($conexion->query($inserta) === TRUE) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error en la inserción: " . $conexion->error;
}

$conexion->close();
fclose($fichero);
?>,
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="registros-container">
    <h2>Registros en la Base de Datos</h2>
    <?php
    $conexion = new mysqli("localhost", "root", "", "registro_asistencia");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $consulta = "SELECT * FROM empleado";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>id_empleado</th><th>nombre</th><th>DNI</th><th>turno</th><th>fecha</th><th>hora-ingreso</th><th>hora_salida</th><th>total_horas</th></tr>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id_empleado'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['DNI'] . "</td>";
            echo "<td>" . $fila['turno'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['hora_ingreso'] . "</td>";
            echo "<td>" . $fila['hora_salida'] . "</td>";
            echo "<td>" . $fila['total_horas'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No hay registros en la base de datos.";
    }

    $conexion->close();
    ?>
</div>