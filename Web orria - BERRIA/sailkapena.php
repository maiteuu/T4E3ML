<?php
session_start();
// Importamos las funciones
require_once 'includes/functions.php';

// Definimos los títulos y cargamos el header
$pageTitle = "Sailkapena";
include 'includes/header.php';

// Rutas de los archivos
$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/sailkapena.xsl';

echo '<main class="w3-container" style="display: flex; flex-direction: column; align-items: center;">';

// Título y separador
echo '<div class="orri-titulua-container">';
echo '<h2 class="orri-titulua">SAILKAPENA</h2>';
echo '<span class="orri-marra"></span>';
echo '</div>';

// 1. VALIDACIÓN XSD
if (validarXML($xmlRuta, $xsdRuta)) {
    
    // Cargamos el XML original
    $xmlFederazioa = simplexml_load_file($xmlRuta);
    
    // OBTENER TEMPORADAS DISPONIBLES
    $denboraldiak = [];
    if (isset($xmlFederazioa->Denboraldiak->Denboraldia)) {
        foreach ($xmlFederazioa->Denboraldiak->Denboraldia as $denb) {
            $denboraldiak[] = (string)$denb['urtea'];
        }
    }
    
    // Si el usuario ha elegido una temporada en el desplegable, la guardamos
    if (isset($_GET['denboraldia'])) {
        $_SESSION['denboraldia_id'] = $_GET['denboraldia'];
    }
    // Si no hay temporada guardada, cogemos la última del XML por defecto
    $oraingoDenboraldia = $_SESSION['denboraldia_id'] ?? (end($denboraldiak) ?: '2023-2024');

    // DIBUJAR EL DESPLEGABLE (Diseño sobrio, elegante y sin emojis)
    echo '<div class="w3-center w3-margin-bottom" style="margin-top: 10px;">';
    echo '<form method="GET" action="sailkapena.php" style="display: inline-flex; align-items: center; gap: 10px;">';
    echo '<label for="denboraldia" style="color: #871521; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Denboraldia:</label>';
    echo '<select name="denboraldia" id="denboraldia" onchange="this.form.submit()" class="w3-select w3-round" style="width: 140px; padding: 5px 10px; font-weight: bold; color: #333; border: 2px solid #871521; outline: none; cursor: pointer; background-color: transparent;">';
    foreach ($denboraldiak as $d) {
        $selected = ($d === $oraingoDenboraldia) ? 'selected' : '';
        echo "<option value='$d' $selected>$d</option>";
    }
    echo '</select>';
    echo '</form>';
    echo '</div>';
    
    // 2. CÁLCULO DINÁMICO
    $xmlConPuntos = generarXMLSailkapena($xmlFederazioa, $oraingoDenboraldia);
    
    // 3. TRANSFORMACIÓN XSLT
    $tablaHTML = transformar($xmlConPuntos, $xslRuta);
    
    // Imprimimos el resultado
    echo $tablaHTML;

} else {
    // Si la validación falla
    echo '<div class="w3-panel w3-red w3-padding-16 w3-round-large" style="width: 80%; text-align: center;">';
    echo '<h3>Errorea!</h3>';
    echo '<p>Datuen fitxategia (XML) ez da baliozkoa. Jarri harremanetan administratzailearekin.</p>';
    echo '</div>';
}

echo '</main>';
include 'includes/footer.php';
?>