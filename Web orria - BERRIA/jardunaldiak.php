<?php
session_start();
require_once 'includes/functions.php';

$xmlRuta = 'xml/federazioa.xml';
$xsdRuta = 'xml/federazioa.xsd';
$xslRuta = 'xml/jardunaldiak.xsl';

if (file_exists($xmlRuta)) {
    $xmlFederazioa = simplexml_load_file($xmlRuta);
    
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
}

$pageTitle = "Emaitzak eta Jardunaldiak";
include 'includes/header.php'; 
?>

<main class="w3-container w3-padding-32" style="display: flex; flex-direction: column; align-items: center;">
    
    <div class="orri-titulua-container">
        <h2 class="orri-titulua">JARDUNALDIAK</h2>
        <span class="orri-marra"></span>
    </div>

    <div class="w3-center w3-margin-bottom" style="margin-top: 10px;">
        <form method="GET" action="jardunaldiak.php" style="display: inline-flex; align-items: center; gap: 10px;">
            <label for="denboraldia" style="color: #871521; font-weight: bold;">Denboraldia:</label>
            <select name="denboraldia" id="denboraldia" onchange="this.form.submit()" class="w3-select w3-round" style="width: 140px; border: 2px solid #871521;">
                <?php foreach ($denboraldiak as $d): ?>
                    <option value="<?= $d ?>" <?= ($d === $oraingoDenboraldia) ? 'selected' : '' ?>><?= $d ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <?php
    $xmlDoc = new DOMDocument;
    $xmlDoc->load($xmlRuta); 

    $xslDoc = new DOMDocument;
    $xslDoc->load($xslRuta); 

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xslDoc);
    $proc->setParameter('', 'p_denboraldia', $oraingoDenboraldia);
    
    echo $proc->transformToXML($xmlDoc);
    ?>
</main>

<?php include 'includes/footer.php'; ?>