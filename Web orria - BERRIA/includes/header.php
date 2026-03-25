<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'functions.php'; 
$xml = cargarXML();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estiloa/w3.css">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header>    
    <a id="hasieraLogo" href="index.php">
        <img src="irudiak/FNFS Logo granate transparente.png" alt="Logo" class="logoa">
    </a>
    
   <nav>
    <a class="menuBotoia" href="index.php">Hasiera</a>
    <a class="menuBotoia" href="taldeak.php">Taldeak</a>
    <a class="menuBotoia" href="sailkapena.php">Sailkapena</a>
    <a class="menuBotoia" href="berriak.php">Berriak</a>

    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'jokalari'): ?>
        <a class="menuBotoia" href="nire_panela.php">Nire Panela</a>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
        <a class="menuBotoia" href="admin_usuarios.php">Erabiltzaileen Kudeaketa</a>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
        <a class="menuBotoia" href="login.php">Login</a>
    <?php else: ?>
        <a class="menuBotoia" href="logout.php">Logout</a>
    <?php endif; ?>
</nav>
</header>