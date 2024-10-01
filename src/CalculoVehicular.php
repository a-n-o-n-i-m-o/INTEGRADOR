<?php

class CalculoVehicular {
    private $nombre;
    private $montoVehiculo;
    private $cuotaInicial;
    private $tea;
    private $plazoAnios;

    // Constructor
    public function __construct($nombre, $montoVehiculo, $cuotaInicial, $tea, $plazoAnios) {
        $this->nombre = $nombre;
        $this->montoVehiculo = $montoVehiculo;
        $this->cuotaInicial = $cuotaInicial;
        $this->tea = $tea;
        $this->plazoAnios = $plazoAnios;
    }

    // Método para calcular el monto a financiar
    public function getMontoCapital() {
        return $this->montoVehiculo * (1 - $this->cuotaInicial);
    }

    // Método para calcular la cuota inicial
    public function getCuotaInicial() {
        return $this->montoVehiculo * $this->cuotaInicial;
    }

    // Método para calcular la tasa efectiva mensual (TEM)
    public function getTEM() {
        return pow(1 + $this->tea, 1.0 / 12) - 1;
    }

    // Método para calcular la cuota mensual
    public function getCuotaMensual() {
        $tem = $this->getTEM();
        $plazoMeses = $this->plazoAnios * 12;
        $montoCapital = $this->getMontoCapital();
        return $montoCapital * ($tem / (1 - pow(1 + $tem, -$plazoMeses)));
    }

    // Método para generar un cronograma de pagos
    public function generarCronograma() {
        $saldoCapital = $this->getMontoCapital();
        $tem = $this->getTEM();
        $cuotaMensual = $this->getCuotaMensual();
        $interesTotalPagado = 0;

        echo "* {$this->nombre} *<br>";

        // Armando cabecera del cronograma
        echo "Mes | Monto Capital | Interes | Cuota Mensual | Saldo Capital <br>";

        // Calculando e imprimiendo los 36 meses del cronograma
        for ($mes = 1; $mes <= 36; $mes++) {
            $interesPago = $saldoCapital * $tem;
            $capitalPago = $cuotaMensual - $interesPago;
            $saldoCapital -= $capitalPago;
            $interesTotalPagado += $interesPago;

            // Imprimiendo detalle del cronograma
            echo "$mes | " . number_format($capitalPago, 2) . " | " . number_format($interesPago, 2) . " | " . number_format($cuotaMensual, 2) . " | " . number_format($saldoCapital, 2) . "<br>";
        }

        $montoTotalPagado = $this->getMontoCapital() + $interesTotalPagado + $this->getCuotaInicial();
        echo "<br>Monto Total del Vehículo: " . number_format($this->montoVehiculo, 2) . " USD<br>";
        echo "Monto Total a Financiar: " . number_format($this->getMontoCapital(), 2) . " USD<br>";
        echo "Monto Total de Intereses: " . number_format($interesTotalPagado, 2) . " USD<br>";
        echo "Monto Total a Pagar después de 3 años: " . number_format($montoTotalPagado, 2) . " USD<br>";
    }
}
