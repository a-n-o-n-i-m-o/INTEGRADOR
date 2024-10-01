<?php
require_once __DIR__ . '/../src/CalculoVehicular.php';

// Simulated data for demonstration purposes (replace with actual data processing logic)
$nombre = "Juan Pérez";
$montoVehiculo = 20000; // USD
$cuotaInicial = 0.2; // 20%
$tea = 0.15; // 15%
$plazoAnios = 3; // 3 years

$calculo = new CalculoVehicular($nombre, $montoVehiculo, $cuotaInicial, $tea, $plazoAnios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Resultados del Cálculo Vehicular</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .resultado-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
            font-size: 1.2em;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="resultado-container">
        <h1>Resultados del Cálculo Vehicular</h1>

        <?php
        // Generando el cronograma y mostrando resultados
        echo "<h2>* {$calculo->nombre} *</h2>";
        echo "<table>";
        echo "<tr><th>Mes</th><th>Monto Capital</th><th>Interes</th><th>Cuota Mensual</th><th>Saldo Capital</th></tr>";

        $saldoCapital = $calculo->getMontoCapital();
        $tem = $calculo->getTEM();
        $cuotaMensual = $calculo->getCuotaMensual();
        $interesTotalPagado = 0;

        for ($mes = 1; $mes <= 36; $mes++) {
            $interesPago = $saldoCapital * $tem;
            $capitalPago = $cuotaMensual - $interesPago;
            $saldoCapital -= $capitalPago;
            $interesTotalPagado += $interesPago;

            echo "<tr>
                    <td>$mes</td>
                    <td>" . number_format($capitalPago, 2) . "</td>
                    <td>" . number_format($interesPago, 2) . "</td>
                    <td>" . number_format($cuotaMensual, 2) . "</td>
                    <td>" . number_format($saldoCapital, 2) . "</td>
                  </tr>";
        }

        $montoTotalPagado = $calculo->getMontoCapital() + $interesTotalPagado + $calculo->getCuotaInicial();

        echo "</table>";

        echo "<div class='summary'>";
        echo "<p>Monto Total del Vehículo: " . number_format($montoVehiculo, 2) . " USD</p>";
        echo "<p>Monto Total a Financiar: " . number_format($calculo->getMontoCapital(), 2) . " USD</p>";
        echo "<p>Monto Total de Intereses: " . number_format($interesTotalPagado, 2) . " USD</p>";
        echo "<p>Monto Total a Pagar después de 3 años: " . number_format($montoTotalPagado, 2) . " USD</p>";
        echo "</div>";
        ?>
    </div>

    <div class="footer">
        &copy; 2024 CalculoVehicular. Todos los derechos reservados.
    </div>
</body>
</html>
