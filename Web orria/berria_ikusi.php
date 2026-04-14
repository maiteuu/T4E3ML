<?php
session_start();
$pageTitle = "Berria";
include 'includes/header.php';

// Titulua ez badago, errorea erakutsi
if (!isset($_GET['titulua'])) {
    echo "<main class='w3-container'><h3 class='w3-center w3-text-red'>Errorea: Berria ez da aurkitu.</h3></main>";
    include 'includes/footer.php';
    exit;
}

$titulua_bilatu = $_GET['titulua'];
$berriakXML = simplexml_load_file('xml/berriak.xml');
$berria = null;

foreach ($berriakXML->berria as $b) {
    if ((string)$b->tituloa === $titulua_bilatu) {
        $berria = $b;
        break;
    }
}
?>

<main class="w3-container w3-content" style="max-width:800px; padding: 40px 16px;">
    <?php if ($berria): ?>
        <div class="w3-card-4 w3-white w3-round-large" style="overflow:hidden;">
            <img src="media/irudiak/berriak/<?php echo htmlspecialchars($berria->irudia); ?>"
                 alt="<?php echo htmlspecialchars($berria->tituloa); ?>"
                 style="width:100%; max-height: 400px; object-fit: cover;">

            <div class="w3-container w3-padding-32">
                <h1 style="font-weight: bold; margin-bottom: 20px; color: #871521;">
                    <?php echo htmlspecialchars($berria->tituloa); ?>
                </h1>

                <p style="font-size: 1.1em; line-height: 1.6; text-align: justify;">
                    <?php echo nl2br(htmlspecialchars($berria->deskribapena)); ?>
                </p>

                <div class="w3-margin-top w3-center">
                    <br>
                    <a href="berriak.php" class="w3-button w3-round-large w3-hover-dark-grey" style="background-color: #871521; color:white;">
                        ← Berrietara itzuli
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <h3 class="w3-center w3-text-red">Barkatu, ez dugu albiste hori aurkitu.</h3>
        <div class="w3-center">
            <a href="berriak.php" class="w3-button w3-blue w3-round-large">← Berrietara itzuli</a>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
