<?php

require_once 'includes/functions.php';

// Azken denboraldia ezartzen dugu saioan ez badago
if (!isset($_SESSION['denboraldia_id'])) {
    $_SESSION['denboraldia_id'] = lortuAzkenDenboraldia();
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estiloa/w3.css">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($pageTitle) ? $pageTitle . " - LNFS" : "LNFS"; ?>
    </title>
</head>

<body>

    <header>
        <div class="goiburuko-goikoa">
            <a id="hasieraLogo" href="index.php" class="logo-zentratua">
                <img src="media/irudiak/FNFS Logo granate transparente.png" alt="Logoa" class="logoa">
            </a>

            <?php if (isset($_SESSION['denboraldia_id'])): ?>
                <div class="denboraldia-eskuina">
                    <p style="margin: 0">
                        <strong>Denboraldia:</strong>
                        <?php echo htmlspecialchars($_SESSION['denboraldia_id']); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <nav>
            <a class="menuBotoia" href="index.php">Hasiera</a>
            <a class="menuBotoia" href="taldeak.php">Taldeak</a>
            <a class="menuBotoia" href="jardunaldiak.php">Jardunaldiak</a>
            <a class="menuBotoia" href="sailkapena.php">Sailkapena</a>
            <a class="menuBotoia" href="berriak.php">Berriak</a>

            <?php if (isset($_SESSION['rol'])): ?>
                <?php if ($_SESSION['rol'] == 'jokalari'): ?>
                    <a class="menuBotoia" href="nire_panela.php">Nire Panela</a>
                <?php elseif ($_SESSION['rol'] == 'admin'): ?>
                    <a class="menuBotoia" href="admin_erabiltzaileak.php">Kudeaketa</a>
                <?php endif; ?>
                <a class="menuBotoia" href="logout.php">Saioa itxi</a>
            <?php else: ?>
                <a class="menuBotoia" href="login.php">Saioa hasi</a>
            <?php endif; ?>
        </nav>
    </header>
