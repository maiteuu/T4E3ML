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
</head>
<body>

<header>    
    <a id="hasieraLogo" href="index.php">
        <img src="irudiak/FNFS Logo granate transparente.png" alt="Logo" class="logoa">
    </a>
    
    <nav>
        <div class="menuBotoia"><a href="index.php">Hasiera</a></div>
        <div class="menuBotoia"><a href="taldeak.php">Taldeak</a></div>
        <div class="menuBotoia"><a href="sailkapena.php">Sailkapena</a></div>
        <div class="menuBotoia"><a href="berriak.php">Berriak</a></div>
        
        <?php if(!isset($_SESSION['usuario'])): ?>
            <div class="menuBotoia"><a href="login.php">Login</a></div>
        <?php else: ?>
            <div class="menuBotoia"><a href="logout.php">Logout</a></div>
        <?php endif; ?>
    </nav>
</header>