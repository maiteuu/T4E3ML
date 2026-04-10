<?php
session_start();
$pageTitle = "Federazioa";
include 'includes/header.php';
include_once 'includes/functions.php';
?>

<main class="w3-container w3-padding-32">
    <div class="orri-titulua-container">
        <h2 class="orri-titulua">GURE FEDERAZIOA: ETORKIZUNA GARATZEN</h2>
        <span class="orri-marra"></span>
    </div>

    <section class="w3-container w3-center" style="max-width: 900px; margin: 0 auto 50px auto;">
        <p class="w3-large" style="line-height: 1.6;">
            <b>FNFS (Federación Nacional de Futbol Sala)</b> erakundeak aro berri bati ekin dio. 
            <i>Dualtech</i>-eko adituek (Markel Abascal eta Oier Marañón) garatutako Plan Estrategiko Integralari esker, 
            gure kirola modernizatu dugu. Kirolaren bikaintasuna, eraldaketa digitala eta ingurumenarekiko errespetua dira gure zutabeak.
        </p>
    </section>

    <section class="w3-container w3-margin-bottom" style="max-width: 1200px; margin: 0 auto;">
        <div class="w3-row-padding w3-margin-top">
            <div class="w3-half">
                <div class="w3-card-4 w3-round-large w3-padding-24 w3-center cardBisuala" style="height: 100%;">
                    <i class="fa fa-microchip w3-margin-bottom" style="font-size:64px; color:#871521;"></i>
                    <h3 style="font-weight: bold; color: #333;">Eraldaketa Digitala (IT/OT)</h3>
                    <p class="w3-padding" style="text-align: left;">
                        Prozesuen digitalizazio integrala martxan jarri dugu. Teknologia Gaitzaile Digitalak (THD) erabiliz, gure azpiegiturak konektatzen ditugu:
                    </p>
                    <ul style="text-align: left; padding-right: 20px;">
                        <li><b>Konektibitatea:</b> IoT sentsoreak eta 5G sarea pabiloietan, sarrera tornu adimendunekin eta Streaming kamerekin.</li>
                        <li><b>Adimen Artifiziala:</b> Epaileen esleipen automatikorako eta prozesu administratiboak arintzeko (Chatbot-ak).</li>
                        <li><b>Big Data:</b> Talentuaren scouting-a egiteko eta zaleei marketin pertsonalizatua eskaintzeko.</li>
                        <li><b>Segurtasuna:</b> Zibersegurtasun aurreratua eta MFA protokoloak datu guztiak babesteko.</li>
                    </ul>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-card-4 w3-round-large w3-padding-24 w3-center cardBisuala" style="height: 100%;">
                    <i class="fa fa-leaf w3-margin-bottom" style="font-size:64px; color:#871521;"></i>
                    <h3 style="font-weight: bold; color: #333;">Jasangarritasuna</h3>
                    <p class="w3-padding" style="text-align: left;">
                        Eredu linealetik zirkularrerako jauzia egin dugu hondakinen sorrera ia erabat desagerrarazteko:
                    </p>
                    <ul style="text-align: left; padding-right: 20px;">
                        <li><b>Ekonomia Zirkularra:</b> Ekipazioen ekidiseinua eta baloi-tailerrak erabiliz, materialen bizi-zikloa %100ean luzatzen dugu.</li>
                        <li><b>Hondakinen Murrizketa:</b> Plastikozko botilak %90ean murriztu ditugu.</li>
                        <li><b>Digitalizazio Ekologikoa:</b> Papera %70-80 murriztu da prozesu digitalekin.</li>
                        <li><b>Karbono-aztarna:</b> Egutegi adimendunen bidez joan-etorriak optimizatzeak isurien %15-25eko murrizketa dakar.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="w3-container w3-margin-top w3-padding-32" style="max-width: 1200px; margin: 0 auto;">
        <div class="w3-panel w3-round-large w3-padding-32 w3-center" style="background: linear-gradient(135deg, #871521 0%, #4a0b12 100%); color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            <i class="fa fa-heartbeat" style="font-size:50px; margin-bottom: 15px;"></i>
            <h2 style="font-weight: bold; text-transform: uppercase;">Osasun Sarea</h2>
            <p class="w3-large w3-padding" style="max-width: 800px; margin: 0 auto;">
                Jasangarritasunak eta digitalizazioak ekartzen duten %25eko aurrezki ekonomikoa <b>Osasun Sarea</b> finantzatzeko bideratzen da zuzenean. Hodeiko konputazioari (Cloud Computing) eta datu medikoen analitikari esker, jokalarien lesioak %10-15 artean murriztea dugu helburu, gure kirolarien ongizatea lehenetsiz.
            </p>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>