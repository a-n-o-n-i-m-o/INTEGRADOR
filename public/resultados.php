<?php
require_once '../src/CalculoVehicular.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $montoVehiculo = $_POST['montoVehiculo'];
    $cuotaInicial = $_POST['cuotaInicial'] / 100;
    $tea = $_POST['tea'];
    $plazoAnios = $_POST['plazoAnios'];

    $calculo = new CalculoVehicular($nombre, $montoVehiculo, $cuotaInicial, $tea, $plazoAnios);
    $resultado = $calculo->generarCronograma();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Calculo Vehicular</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <h2>Resultados del Calculo Vehicular</h2>
    <div><?php echo $resultado; ?></div>
</body>
</html>
