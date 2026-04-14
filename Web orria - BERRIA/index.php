<?php
session_start();
$pageTitle = "Hasiera";
include 'includes/header.php';
include_once 'includes/functions.php';
?>

<main>
    <section class="w3-container hasiera" style="padding-top: 32px;">
        
        <div class="orri-titulua-container">
            <h2 class="orri-titulua">EGUNEKO PARTIDARIK ONENA</h2>
            <span class="orri-marra"></span>
        </div>
        
        <article class="hasieraArtikulo">
            <div class="partidarikOnena">
                <div>
                    <p style="font-weight:bold; color:#666;">2026/04/10<br>19:00</p>
                </div>
                <div class="partidarikOnenaEmaitza">
                    <img src="media/irudiak/eskutua/barcelona.png" alt="Barça" class="partidarikOnenaEskutuak" onerror="this.src='media/irudiak/eskutua/defecto.png'">
                    <p>5 - 3</p>
                    <img src="media/irudiak/eskutua/ribera.png" alt="Ribera" class="partidarikOnenaEskutuak" onerror="this.src='media/irudiak/eskutua/defecto.png'">
                </div>
                <div>
                    <a class="partidarikOnenaUbi" href="#" target="_blank">Palau Blaugrana</a>
                </div>
            </div>

            <div>
                <video class="partidarikOnenaBideoa" controls autoplay muted loop>
                    <source src="media/bideoak/videoindex.mp4" type="video/mp4">
                    Zure nabigatzaileak ez du bideo mota baimentzen.
                </video>
            </div>
        </article>
    </section>

    <section class="w3-container w3-padding-32">
        <div class="orri-titulua-container">
            <h2 class="orri-titulua">NOR GARA?</h2>
            <span class="orri-marra"></span>
        </div>

        <div class="w3-container w3-center" style="max-width: 900px; margin: 0 auto; margin-bottom: 40px;">
            <p class="w3-large"><b>FNFS</b> areto-futbola modernizatzeko lanean ari den erakundea da. Gure helburua kirolaren bikaintasuna teknologiarekin eta ingurumenarekiko errespetuarekin uztartzea da.</p>
        </div>

        <div class="taldeFlex">
            
            <article class="articleTaldeak">
                <div class="w3-card-4 w3-round-large w3-padding-24 cardBisuala w3-center">
                    <div class="w3-margin-bottom">
                        <i class="fa fa-microchip" style="font-size:48px; color:#871521;"></i>
                    </div>
                    <h3 style="font-weight: bold;">Eraldaketa Digitala</h3>
                    <p class="w3-padding">IA, Big Data eta Cloud Computing sistemak integratzen ditugu ligaren kudeaketa optimizatzeko eta zaleen esperientzia hobetzeko.</p>
                </div>
            </article>

            <article class="articleTaldeak">
                <div class="w3-card-4 w3-round-large w3-padding-24 cardBisuala w3-center">
                    <div class="w3-margin-bottom">
                        <i class="fa fa-leaf" style="font-size:48px; color:#871521;"></i>
                    </div>
                    <h3 style="font-weight: bold;">Jasangarritasuna</h3>
                    <p class="w3-padding">Ekonomia zirkularra bultzatzen dugu: paperaren %80a murriztuz eta materialen bizi-zikloa luzatuz karbono-aztarna gutxitzeko.</p>
                </div>
            </article>

            <article class="articleTaldeak">
                <div class="w3-card-4 w3-round-large w3-padding-24 cardBisuala w3-center">
                    <div class="w3-margin-bottom">
                        <i class="fa fa-heartbeat" style="font-size:48px; color:#871521;"></i>
                    </div>
                    <h3 style="font-weight: bold;">Osasun Sarea</h3>
                    <p class="w3-padding">Teknologia jokalarien zerbitzura jartzen dugu, lesioen prebentzioa hobetuz eta kirol-segurtasuna bermatzeko datu analitika erabiliz.</p>
                </div>
            </article>

        </div>
    </section>

    <div class="w3-container w3-center w3-padding-32">
        <a href="federazioa.php" class="w3-button w3-round-large" style="background-color: #871521; color:white; padding: 12px 24px;">
            Gure Proiektua Ezagutu
        </a>
    </div>

</main>

<?php include 'includes/footer.php'; ?>