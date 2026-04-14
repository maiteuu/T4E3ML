<?php
session_start();
require_once 'includes/functions.php';

$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/sailkapena.xsl';

if (validarXML($xmlRuta, $xsdRuta)) {
    $xmlFederazioa = simplexml_load_file($xmlRuta);

    // Denboraldi guztiak biltzen ditugu hautatzailerako
    $denboraldiak = [];
    foreach ($xmlFederazioa->Denboraldiak->Denboraldia as $denb) {
        $denboraldiak[] = (string)$denb['urtea'];
    }

    if (isset($_GET['denboraldia'])) {
        $_SESSION['denboraldia_id'] = $_GET['denboraldia'];
    }

    if (!isset($_SESSION['denboraldia_id'])) {
        $_SESSION['denboraldia_id'] = end($denboraldiak);
    }

    $oraingoDenboraldia = $_SESSION['denboraldia_id'];

    $pageTitle = "Sailkapena";
    include 'includes/header.php';

    echo '<main class="w3-container" style="display: flex; flex-direction: column; align-items: center;">';
    echo '<div class="orri-titulua-container"><h2 class="orri-titulua">SAILKAPENA</h2><span class="orri-marra"></span></div>';
    ?>

    <div class="w3-center w3-margin-bottom" style="margin-top: 10px;">
        <form method="GET" action="sailkapena.php" style="display: inline-flex; align-items: center; gap: 10px;">
            <label for="denboraldia" style="color: #871521; font-weight: bold;">Denboraldia:</label>
            <select name="denboraldia" id="denboraldia" onchange="this.form.submit()" class="w3-select w3-round" style="width: 140px; border: 2px solid #871521;">
                <?php foreach ($denboraldiak as $d): ?>
                    <option value="<?= $d ?>" <?= ($d === $oraingoDenboraldia) ? 'selected' : '' ?>><?= $d ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <?php
    // Puntuak kalkulatu eta XSLT eraldaketa egin
    $xmlConPuntos = generarXMLSailkapena($xmlFederazioa, $oraingoDenboraldia);
    echo transformar($xmlConPuntos, $xslRuta);

} else {
    include 'includes/header.php';
    echo '<div class="w3-panel w3-red"><h3>Errorea!</h3><p>XML ez da baliozkoa.</p></div>';
}

echo '</main>';
include 'includes/footer.php';
?>
