<?php
session_start();
// Importamos las funciones que creamos en el paso anterior
require_once 'includes/functions.php';

// Definimos los títulos y cargamos el header
$pageTitle = "Sailkapena";
include 'includes/header.php';

// Rutas de los archivos
$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/sailkapena.xsl';

echo '<main class="w3-container">';

// 1. VALIDACIÓN XSD (5% de la nota)
if (validarXML($xmlRuta, $xsdRuta)) {
    
    // Cargamos el XML original para poder leer los partidos
    $xmlFederazioa = simplexml_load_file($xmlRuta);
    
    // 2. CÁLCULO DINÁMICO (15% de la nota)
    // Obtenemos la temporada de la sesión o una por defecto
    $temporadaActual = $_SESSION['temporada_id'] ?? '2023-24';
    
    // Esta función (que está en functions.php) nos devuelve un objeto XML 
    // con los puntos ya calculados, listo para ser procesado por XSLT.
    $xmlConPuntos = generarXMLSailkapena($xmlFederazioa, $temporadaActual);
    
    // 3. TRANSFORMACIÓN XSLT (20% de la nota)
    // Aplicamos tu archivo .xsl al XML que acabamos de generar
    $tablaHTML = transformar($xmlConPuntos, $xslRuta);
    
    // Imprimimos el resultado
    echo $tablaHTML;

} else {
    // Si la validación falla, mostramos un aviso profesional
    echo '<div class="w3-panel w3-red w3-padding-16">';
    echo '<h3>Errorea!</h3>';
    echo '<p>Datuen fitxategia (XML) ez da baliozkoa. Jarri harremanetan administratzailearekin.</p>';
    echo '</div>';
}

echo '</main>';

include 'includes/footer.php';
?>