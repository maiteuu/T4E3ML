<?php
session_start();
$pageTitle = "Taldeak";
include 'includes/header.php';
require_once 'includes/functions.php';

$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/taldeak.xsl';

echo '<main>';

if (validarXML($xmlRuta, $xsdRuta)) {
    $equipoSeleccionado = isset($_GET['izena']) ? $_GET['izena'] : '';
    $origen             = isset($_GET['origen']) ? $_GET['origen'] : 'taldeak';

    $parametros = [
        'taldeParam'  => $equipoSeleccionado,
        'origenParam' => $origen
    ];

    echo transformar($xmlRuta, $xslRuta, $parametros);
} else {
    echo '<div class="w3-panel w3-red">Errorea: federazioa.xml ez da baliozkoa XSDaren arabera.</div>';
}

echo '</main>';
include 'includes/footer.php';
?>
