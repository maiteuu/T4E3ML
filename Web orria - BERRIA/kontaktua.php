<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Profila - PowerGYM</title>
    <meta name="description" content="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
    <link rel="shortcut icon" href="img/ikonoa.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="estiloa/styles.css">
</head>

<body>
   
    <nav>
        <ul>
            <a href="index.php">
                <li>Nortzuk gara</li>
            </a>
            <li>Zerbitzuak</li>

            <?php


            if (isset($_SESSION["sesionUsername"])) {
                // ERABILTZAILEA LOGEATUTA DAGOENEAN
            ?>
                <a href="kontaktua.php">
                    <li>Kontaktua</li>
                </a>
                <a href="profile.php">
                    <li>Zure Profila</li>
                </a>
                <a href="rutina.php">
                    <li>Zure rutina</li>
                </a>
                <a href="logout.php">
                    <li>Logout</li>
                </a>
            <?php
            } else {

            ?>
                <a href="kontaktua.php">
                    <li>Kontaktua</li>
                </a>
                <a href="login.php">
                    <li>Login</li>
                </a>
            <?php
            }
            ?>
        </ul>
    </nav>
    <main>
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <p style="color: red; text-align: center; font-weight: bold;">Erabiltzaile hori jada erregistratuta dago!</p>
        <?php endif; ?>

        <section id="kontaktu-wrapper">
            <h2>Kontaktatu gurekin</h2>

            <div class="kontaktu-box">
                <form action="gorde.php" method="post">
                    <label for="izena">Izena:</label>
                    <input name="izena" id="izena" type="text" required>

                    <label for="abizena">Abizenak:</label>
                    <input name="abizena" id="abizena" type="text" required>

                    <label for="telefonoa">Telefonoa:</label>
                    <input name="telefonoa" id="telefonoa" type="text" pattern="[0-9]{9}" placeholder="Ej: 612345678" required>

                    <label for="email">Helbide Elektronikoa:</label>
                    <input name="email" id="email" type="email" required>

                    <label for="mezua">Mezua:</label>
                    <textarea name="mezua" id="mezua" cols="40" rows="3" placeholder="Idatzi hemen..."></textarea>

                    <label for="ordutegia">Zurekin harremanetan jartzeko ordutegia:</label>
                    <select name="ordutegia" id="ordutegia">
                        <option value="goiz">Goizez</option>
                        <option value="eguerdi">Eguerdionez</option>
                        <option value="arratzalde">Arratsaldez</option>
                    </select>

                    <button type="submit">Bidali</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <h5>
            2026 - PowerGYM
        </h5>
    </footer>
</body>

</html>