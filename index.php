<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Registros desde Archivo .CSV</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+Bhaina">


    <link rel="stylesheet" type="text/css" href="css/stilo.css">
</head>

<body>
    <center>

        <strong><label class="titulo">IMPORTAR REGISTROS DESDE ARCHIVO .CSV</label></strong>
    </center>
    <p></p>
    <form action="subir_archivo.php" method="POST" enctype="multipart/form-data">
        <center>
            <table>
                <tr>
                    <td class="letra" width="250"><strong>Subir Archivo CSV:</strong></td>
                    <td><input type="file" name="foto" id="foto"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="enviar" value="SUBIR" class="boton"></td>
                </tr>
            </table>
        </center>
    </form>
</body>

</html>