<?php
session_start();
$pageTitle = "Taldeak";
include 'includes/header.php';
require_once 'includes/functions.php';

$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/taldeak.xsl'; 

echo '<main>';

// 1. VALIDAMOS EL XML ANTES DE HACER NADA
if (validarXML($xmlRuta, $xsdRuta)) {
    
    // 2. Recogemos el equipo y el origen de la URL
    $equipoSeleccionado = isset($_GET['izena']) ? $_GET['izena'] : '';
    $origen = isset($_GET['origen']) ? $_GET['origen'] : 'taldeak';

    // 3. Preparamos los parámetros para el XSLT
    $parametros = [
        'taldeParam'  => $equipoSeleccionado,
        'origenParam' => $origen
    ];

    // 4. Transformamos pasándole la ruta del XML, la ruta del XSLT y los parámetros
    // (Tu función 'transformar' ya es capaz de leer la ruta directamente)
    $tablaHTML = transformar($xmlRuta, $xslRuta, $parametros);
    
    // 5. Imprimimos el resultado en la pantalla
    echo $tablaHTML;

} else {
    echo '<div class="w3-panel w3-red">Errorea: federazioa.xml ez da baliozkoa XSDaren arabera.</div>';
}

echo '</main>';
include 'includes/footer.php';
?>

