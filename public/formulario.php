<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Calculo Vehicular</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <h2>Formulario de Calculo Vehicular</h2>
    <form action="resultados.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="montoVehiculo">Monto del Vehículo (USD):</label>
        <input type="number" name="montoVehiculo" required>

        <label for="cuotaInicial">% de Cuota Inicial:</label>
        <input type="number" name="cuotaInicial" step="0.01" required>

        <label for="tea">TEA (Tasa Efectiva Anual):</label>
        <input type="number" name="tea" step="0.01" required>

        <label for="plazoAnios">Plazo (años):</label>
        <input type="number" name="plazoAnios" required>

        <button type="submit">Calcular</button>
    </form>
</body>
</html>
