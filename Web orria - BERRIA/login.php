<?php
session_start();
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userIn = $_POST['user'];
    $passIn = $_POST['pass'];

    // Cargar usuarios desde el XML
    $usuariosXML = simplexml_load_file('datos/erabiltzaileak.xml');
    $encontrado = false;

    foreach ($usuariosXML->Erabiltzailea as $u) {
        if ($u->izena == $userIn && $u->password == $passIn) {
            $_SESSION['erabiltzailea'] = (string)$u->izena;
            $_SESSION['rol'] = (string)$u->rol;
            $encontrado = true;
            header("Location: index.php");
            exit();
        }
    }

    if (!$encontrado) {
        $error = "Erabiltzaile edo pasahitz okerra!";
    }
}

$pageTitle = "Login";
include 'includes/header.php';
?>

<main class="w3-container w3-display-container" style="min-height: 70vh;">
    <div class="w3-card-4 w3-display-middle w3-white w3-round-large" style="width: 350px;">
        <header class="w3-container" style="background-color: #871521; color: white; border-radius: 8px 8px 0 0;">
            <h3>Identifikatu</h3>
        </header>
        
        <form class="w3-container w3-padding-24" method="POST">
            <label>Erabiltzailea</label>
            <input class="w3-input w3-border w3-margin-bottom w3-round" type="text" name="user" required>
            
            <label>Pasahitza</label>
            <input class="w3-input w3-border w3-margin-bottom w3-round" type="password" name="pass" required>
            
            <button class="w3-button w3-block w3-round w3-margin-top" style="background-color: #871521; color: white;" type="submit">
                Sartu
            </button>
        </form>

        <?php if(isset($error)): ?>
            <div class="w3-panel w3-red w3-margin w3-padding-small w3-round w3-center">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>