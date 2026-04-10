<?php
session_start();
require_once 'includes/functions.php';

$pageTitle = "Emaitzak eta Jardunaldiak";
include 'includes/header.php';
?>

<main class="w3-container w3-padding-32">
    <?php
    $xml = new DOMDocument;
    $xml->load('xml/federazioa.xml'); 

    $xsl = new DOMDocument;
    $xsl->load('xml/jardunaldiak.xsl'); 

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
    
    echo $proc->transformToXML($xml);
    ?>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const hautatzailea = document.getElementById('temporada-selector');
    
    function denboraldiaAldatu(id) {
        document.querySelectorAll('.tabla-temporada').forEach(div => div.style.display = 'none');
        const aukeratua = document.getElementById(id);
        if (aukeratua) {
            aukeratua.style.display = 'block';
            aukeratua.style.animation = 'fadeEffect 0.4s';
        }
    }

    if (hautatzailea) {
        denboraldiaAldatu(hautatzailea.value);

        hautatzailea.addEventListener('change', function() {
            denboraldiaAldatu(this.value);
        });
    }
});
</script>

<style>
@keyframes fadeEffect {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<?php include 'includes/footer.php'; ?>