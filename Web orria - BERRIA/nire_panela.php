<?php
session_start();
require_once 'includes/functions.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'jokalari') {
    header("Location: index.php");
    exit();
}

$tipoSemana = isset($_GET['mota']) ? $_GET['mota'] : ($_COOKIE['preferencia_semana'] ?? 'partido');
if (isset($_GET['mota'])) {
    setcookie("preferencia_semana", $tipoSemana, time() + (86400 * 30), "/");
}

$xmlPath = 'xml/planificacion.xml';
if (!file_exists($xmlPath)) { die("Errorea: Ez da aurkitu '$xmlPath' fitxategia."); }

$xml = simplexml_load_file($xmlPath);
$resultado = $xml->xpath("//tipo[@id='$tipoSemana']");
$plana = $resultado[0];

$pageTitle = "Nire Panela";
include 'includes/header.php';
?>

<main class="w3-container w3-padding-32">
    <header class="orri-titulua-container w3-center w3-margin-bottom">
        <h2 class="orri-titulua">NIRE PLANA: <?php echo strtoupper($plana['izena']); ?></h2>
    </header>

    <section class="selector-semana-container">
        <form method="GET" action="nire_panela.php" class="w3-card selector-card w3-padding w3-round-large">
            <label class="w3-bold">Aukeratu aste mota: </label>
            <select name="mota" class="w3-select w3-border-0 w3-white" style="width:auto; font-weight:bold; cursor:pointer;" onchange="this.form.submit()">
                <option value="partido" <?= ($tipoSemana == 'partido') ? 'selected' : ''; ?>>Partidu Astea</option>
                <option value="atseden" <?= ($tipoSemana == 'atseden') ? 'selected' : ''; ?>>Atseden Astea</option>
            </select>
        </form>
    </section>

    <article class="w3-card-4 w3-white w3-round-large w3-margin-bottom" style="overflow:hidden">
        <header class="w3-container" style="background-color: #871521; color: white;">
            <h4><i class="fa fa-calendar"></i> ASTEKO ENTRENAMENDUAK</h4>
        </header>
        <div class="w3-responsive">
            <table class="w3-table tabla-plan">
                <thead>
                    <tr class="w3-dark-grey">
                        <th>EGUNA</th>
                        <th>GOIZA</th>
                        <th>ARRATSALDEA</th>
                        <th>INTENTSITATEA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plana->eguna as $eguna): 
                        // Lógica de detección: SÁBADO y semana de PARTIDO
                        $esPartidoReal = ($tipoSemana == 'partido' && (string)$eguna['izena'] == 'Larunbata');
                    ?>
                    <tr class="<?= $esPartidoReal ? 'fila-partidu-ofiziala' : ''; ?>">
                        <td class="col-eguna"><?= $eguna['izena']; ?></td>
                        
                        <td class="w3-small celda-info">
                            <?php if (mb_stripos($eguna->goizez, 'Atseden') !== false && mb_stripos($eguna->goizez, 'Gimnasioa') === false): ?>
                                <span class="txt-grande color-atseden">ATSEDENA</span>
                            <?php else: ?>
                                <span class="label-mota label-gym"><i class="fa fa-dumbbell"></i> Gimnasioa</span>
                                <?= $eguna->goizez; ?>
                            <?php endif; ?>
                        </td>

                        <td class="w3-small celda-info">
                            <?php if ($esPartidoReal): ?>
                                <span class="txt-grande color-partidu"><i class="fa fa-star"></i> PARTIDUA <i class="fa fa-star"></i></span>
                                <div class="w3-center"><?= $eguna->arratsaldez; ?></div>
                            <?php elseif (mb_stripos($eguna->arratsaldez, 'Atsedena') !== false && mb_stripos($eguna->arratsaldez, 'Pista') === false): ?>
                                <span class="txt-grande color-atseden">ATSEDENA</span>
                            <?php else: ?>
                                <span class="label-mota label-pista"><i class="fa fa-futbol-o"></i> Pista</span>
                                <?= $eguna->arratsaldez; ?>
                            <?php endif; ?>
                        </td>

                        <td class="w3-center w3-v-align" style="vertical-align: middle;">
                            <span class="w3-tag w3-round w3-orange w3-small w3-block"><?= $eguna->intentsitatea; ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </article>

    <article class="w3-card-4 w3-white w3-round-large" style="overflow:hidden">
        <header class="w3-container w3-teal">
            <h4><i class="fa fa-cutlery"></i> NUTRIZIO PLANA</h4>
        </header>
        <div class="w3-responsive">
            <table class="w3-table tabla-plan">
                <thead>
                    <tr style="background-color: #00796B; color: white;">
                        <th style="width: 110px;">EGUNA</th>
                        <th>GOSARIA</th>
                        <th>BAZKARIA</th>
                        <th>ASKARIA</th>
                        <th>AFARIA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plana->eguna as $eguna): 
                        $esPartidoReal = ($tipoSemana == 'partido' && (string)$eguna['izena'] == 'Larunbata');
                    ?>
                    <tr class="<?= $esPartidoReal ? 'fila-partidu-ofiziala' : ''; ?>">
                        <td class="col-eguna"><?= $eguna['izena']; ?></td>
                        <?php foreach (['gosaria', 'bazkaria', 'askaria', 'afaria'] as $comida): ?>
                            <td class="w3-small celda-info">
                                <span class="label-mota label-dieta"><?= ucfirst($comida); ?></span>
                                <?= $eguna->dieta->$comida; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </article>
</main>

<?php include 'includes/footer.php'; ?>