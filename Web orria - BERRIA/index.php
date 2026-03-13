<?php 
    $pageTitle = "Hasiera"; 
    include 'includes/header.php'; 
?>

<main>
    <section class="w3-container w3-round-large w3-card-4 hasiera" style="width: fit-content;">
        <h2 class="hasierakoTitulua">Eguneko partidarik onena ikuslearentzat</h2>
        <article class="hasieraArtikulo w3-row">
            <div class="partidarikOnena">
                <div><p>2025/9/15<br>19:00</p></div>
                <div class="partidarikOnenaEmaitza">
                    <img src="irudiak/eskutua/Barcelona.png" alt="FC Barcelona" class="partidarikOnenaEskutuak">
                    <p>5-3</p>
                    <img src="irudiak/eskutua/ribera.png" alt="Ribera Navarra" class="partidarikOnenaEskutuak">
                </div>
                <div><a class="partidarikOnenaUbi" href="#" target="_blank">Palau Blaugrana</a></div>
            </div>
            <div>
                <video class="partidarikOnenaBideoa" controls autoplay muted>
                    <source src="bideoak/videoindex.mp4" type="video/mp4">
                    Zure nabigatzailea ez du bideo mota baimentzen
                </video>
            </div>
        </article>
    </section>

    </main>

<?php include 'includes/footer.php'; ?>