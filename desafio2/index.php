<?php
function findDuplicates($arr) {
    $result = [];
    $count = array_count_values($arr);

    $duplicates = array_filter($count, function($occurrences) {
        return $occurrences > 1;
    });

    $result = array_keys($duplicates);

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió el formulario
    if (isset($_POST["numbers"])) {
        // Obtener los números ingresados por el usuario
        $inputNumbers = $_POST["numbers"];

        // Convertir la cadena de números a un array
        $numbers = explode(',', $inputNumbers);

        // Eliminar espacios en blanco alrededor de cada número
        $numbers = array_map('trim', $numbers);

        // Eliminar elementos vacíos del array
        $numbers = array_filter($numbers);

        // Encontrar duplicados
        $duplicates = findDuplicates($numbers);

        // Mostrar el resultado
        $enteredNumbers = implode(', ', $numbers);
        $duplicateNumbers = implode(', ', $duplicates);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Duplicates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Encuentra Números Duplicados</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="numbers">Ingresa los números separados por comas:</label>
            <input type="text" id="numbers" name="numbers" required>
            <button type="submit">Buscar Duplicados</button>
        </form>

        <?php if (isset($enteredNumbers) && isset($duplicateNumbers)) : ?>
            <div class="result-container">
                <p>Números ingresados: <?php echo $enteredNumbers; ?></p>
                <p>Duplicados: <?php echo $duplicateNumbers; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
