<?php
session_start();
$pageTitle = "Taldeak";
include 'includes/header.php';
require_once 'includes/functions.php';

// Rutas actualizadas
$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/taldeak.xsl';

echo '<main>';

if (validarXML($xmlRuta, $xsdRuta)) {
    // Si la validación es correcta, transformamos
    echo transformar($xmlRuta, $xslRuta);
} else {
    echo '<div class="w3-panel w3-red">Errorea: federazioa.xml ez da baliozkoa XSDaren arabera.</div>';
}

echo '</main>';
include 'includes/footer.php';
?>