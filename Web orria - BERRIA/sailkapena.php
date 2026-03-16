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

echo '<main class="w3-container">';
echo '<h2 class="w3-margin-bottom">Sailkapena</h2>';

// 1. VALIDACIÓN XSD
if (validarXML($xmlRuta, $xsdRuta)) {
    
    // Cargamos el XML original
    $xmlFederazioa = simplexml_load_file($xmlRuta);
    
    // --- NUEVO: OBTENER TEMPORADAS DISPONIBLES ---
    $temporadas = [];
    if (isset($xmlFederazioa->Denboraldiak->Denboraldia)) {
        foreach ($xmlFederazioa->Denboraldiak->Denboraldia as $denb) {
            $temporadas[] = (string)$denb['urtea'];
        }
    }
    
    // Si el usuario ha elegido una temporada en el desplegable, la guardamos
    if (isset($_GET['temporada'])) {
        $_SESSION['temporada_id'] = $_GET['temporada'];
    }
    // Si no hay temporada guardada, cogemos la última del XML por defecto
    $temporadaActual = $_SESSION['temporada_id'] ?? (end($temporadas) ?: '2023-2024');

    // --- NUEVO: DIBUJAR EL DESPLEGABLE ---
    echo '<form method="GET" action="sailkapena.php" class="w3-margin-bottom w3-padding">';
    echo '<label for="temporada"><strong>Aukeratu denboraldia: </strong></label>';
    // El onchange hace que el formulario se envíe automáticamente al cambiar de opción
    echo '<select name="temporada" id="temporada" onchange="this.form.submit()" class="w3-select w3-border" style="width: 200px; display: inline-block; margin-left: 10px;">';
    foreach ($temporadas as $t) {
        $selected = ($t === $temporadaActual) ? 'selected' : '';
        echo "<option value='$t' $selected>$t</option>";
    }
    echo '</select>';
    echo '</form>';
    
    // 2. CÁLCULO DINÁMICO
    // Pasamos la temporada elegida a la función
    $xmlConPuntos = generarXMLSailkapena($xmlFederazioa, $temporadaActual);
    
    // 3. TRANSFORMACIÓN XSLT
    $tablaHTML = transformar($xmlConPuntos, $xslRuta);
    
    // Imprimimos el resultado
    echo $tablaHTML;

} else {
    // Si la validación falla
    echo '<div class="w3-panel w3-red w3-padding-16">';
    echo '<h3>Errorea!</h3>';
    echo '<p>Datuen fitxategia (XML) ez da baliozkoa. Jarri harremanetan administratzailearekin.</p>';
    echo '</div>';
}

echo '</main>';
include 'includes/footer.php';
?>