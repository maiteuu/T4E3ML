<?php
session_start();

// SEGURTASUN KONTROLA: Bakarrik kazetariak
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'kazetari') {
    header("Location: index.php");
    exit();
}

require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deskribapena = $_POST['deskribapena'];
    $esteka = $_POST['esteka'];
    $irudiaNom = $_FILES['irudia']['name'];

    // Irudia kargatzen dugu
    $target_dir = "media/irudiak/berriak/";
    $target_file = $target_dir . basename($_FILES["irudia"]["name"]);
    
    if (move_uploaded_file($_FILES["irudia"]["tmp_name"], $target_file)) {
        
        $xmlPath = 'xml/berriak.xml';
        $xml = simplexml_load_file($xmlPath);


        $berriBerria = $xml->addChild('berria');
        $berriBerria->addChild('irudia', htmlspecialchars($irudiaNom));
        $berriBerria->addChild('esteka', htmlspecialchars($esteka));
        $berriBerria->addChild('deskribapena', htmlspecialchars($deskribapena));
        $berriBerria->addChild('tituloa', htmlspecialchars($tituloa));

        $xml->asXML($xmlPath);
        $mezua = "Albistea ondo gorde da!";
    } else {
        $errorea = "Ezin izan da irudia kargatu.";
    }
}

$pageTitle = "Albiste Berria";
include 'includes/header.php';
?>

<main class="w3-container w3-padding-64" style="max-width: 700px; margin: auto;">
    <div class="w3-card-4 w3-white w3-round-large">
        <header class="w3-container" style="background-color: #871521; color: white; border-radius: 8px 8px 0 0;">
            <h3><i class="fa fa-pencil"></i> Albiste Berria (Kazetari Panela)</h3>
        </header>

        <form class="w3-container w3-padding-24" method="POST" enctype="multipart/form-data">
            <?php if(isset($mezua)): ?>
                <div class="w3-panel w3-green w3-round w3-padding">
                    <p><?php echo $mezua; ?> <a href="berriak.php"><b>Ikusi hemen</b></a></p>
                </div>
            <?php endif; ?>

            <div class="w3-section">
                <label><b>Albistearen Tituloa</b> </label>
                <textarea class="w3-input w3-border w3-round" name="tituloa" rows="1" required></textarea>
            </div>

             <div class="w3-section">
                <label><b>Albistearen Deskribapena</b> (Hau da webgunean agertuko den testua)</label>
                <textarea class="w3-input w3-border w3-round" name="deskribapena" rows="3" required></textarea>
            </div>

            <div class="w3-section">
                <label><b>URL Esteka</b> (LNFS-ko albistera joateko)</label>
                <input class="w3-input w3-border w3-round" type="url" name="esteka" placeholder="https://www.lnfs.es/noticia/..." required>
            </div>

            <div class="w3-section">
                <label><b>Albistearen Irudia</b></label>
                <input class="w3-input w3-border w3-round" type="file" name="irudia" accept="image/*" required>
            </div>

            <div class="w3-padding-16">
                <button type="submit" class="w3-button w3-block w3-round-large" style="background-color: #871521; color: white;">
                    Gorde Albistea
                </button>
                <a href="berriak.php" class="w3-button w3-block w3-light-grey w3-margin-top w3-round-large">Utzi</a>
            </div>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>