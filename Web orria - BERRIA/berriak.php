<?php 
session_start();
$pageTitle = "Berriak";
include 'includes/header.php'; 
include_once 'includes/functions.php';
?>

<main class="w3-container">
    <div class="w3-container w3-center w3-padding-32">
        <h2 style="color: #871521; font-weight:bold;">BERRIAK</h2>
    </div>

    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'kazetari'): ?>
        <div class="w3-container w3-margin-bottom w3-center">
            <div class="w3-panel w3-light-grey w3-leftbar w3-border-blue w3-padding-16">
                <p><i>Kazetari gisa konektatuta zaude. Albiste berriak argitaratu ditzakezu.</i></p>
                <a href="gehitu_berria.php" class="w3-button w3-blue w3-round-large">
                    <b>+</b> Albiste Berria Idatzi
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php echo transformar('xml/berriak.xml', 'xml/berriak.xsl'); ?>
</main>

<?php include 'includes/footer.php'; ?>