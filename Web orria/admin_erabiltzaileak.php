<?php
session_start();
require_once 'includes/functions.php';

// Adminak bakarrik sar daitezke
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$xmlPath = 'xml/erabiltzaileak.xml';
$erabiltzaileakXML = simplexml_load_file($xmlPath);

// Erabiltzailea ezabatu
if (isset($_GET['delete'])) {
    $izenaBorrar = $_GET['delete'];
    if ($izenaBorrar !== $_SESSION['erabiltzailea']) {
        $index = 0;
        foreach ($erabiltzaileakXML->Erabiltzailea as $u) {
            if ((string)$u->izena === $izenaBorrar) {
                unset($erabiltzaileakXML->Erabiltzailea[$index]);
                break;
            }
            $index++;
        }
        $erabiltzaileakXML->asXML($xmlPath);
        header("Location: admin_erabiltzaileak.php?msg=deleted");
        exit();
    }
}

// Erabiltzaile berria edo editazioa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomNuevo   = $_POST['izena'];
    $pass       = $_POST['pass'];
    $rol        = isset($_POST['rol']) ? $_POST['rol'] : '';
    $mode       = $_POST['mode'];
    $nomAntiguo = $_POST['izena_antiguo'];

    if ($mode === 'new') {
        $nuevo = $erabiltzaileakXML->addChild('Erabiltzailea');
        $nuevo->addChild('izena',    $nomNuevo);
        $nuevo->addChild('password', $pass);
        $nuevo->addChild('rol',      $rol);
    } else {
        foreach ($erabiltzaileakXML->Erabiltzailea as $u) {
            if ((string)$u->izena === $nomAntiguo) {
                if ($nomAntiguo === $_SESSION['erabiltzailea']) {
                    $_SESSION['erabiltzailea'] = $nomNuevo;
                } else {
                    $u->rol = $rol;
                }
                $u->izena    = $nomNuevo;
                $u->password = $pass;
                break;
            }
        }
    }

    $erabiltzaileakXML->asXML($xmlPath);
    header("Location: admin_erabiltzaileak.php?msg=success");
    exit();
}

$pageTitle = "Erabiltzaileen Kudeaketa";
include 'includes/header.php';
?>

<main class="w3-container w3-padding-32">
    <div class="orri-titulua-container">
        <h2 class="orri-titulua">ADMINISTRAZIO PANELA</h2>
        <span class="orri-marra"></span>
    </div>

    <div class="w3-responsive w3-card-4 w3-white w3-round-large" style="max-width: 900px; margin: auto;">
        <table class="w3-table w3-striped w3-hoverable w3-table-centered">
            <tr style="background-color: #871521; color: white;">
                <th>Erabiltzailea</th>
                <th>Pasahitza</th>
                <th>Rola</th>
                <th class="w3-center">Ekintzak</th>
            </tr>
            <?php foreach ($erabiltzaileakXML->Erabiltzailea as $u):
                $esPropio = ((string)$u->izena === $_SESSION['erabiltzailea']);
            ?>
            <tr class="<?php echo $esPropio ? 'w3-pale-yellow' : ''; ?>">
                <td>
                    <strong><?php echo htmlspecialchars($u->izena); ?></strong>
                    <?php if ($esPropio) echo ' <span class="w3-tag w3-round w3-amber w3-small">NI</span>'; ?>
                </td>
                <td>••••••••</td>
                <td><span class="w3-tag w3-round w3-blue-grey w3-small"><?php echo strtoupper($u->rol); ?></span></td>
                <td class="w3-center">
                    <button onclick="editUser('<?php echo $u->izena; ?>', '<?php echo $u->password; ?>', '<?php echo $u->rol; ?>', <?php echo $esPropio ? 'true' : 'false'; ?>)"
                            class="w3-button w3-small w3-teal w3-round">Editatu</button>

                    <?php if (!$esPropio): ?>
                        <a href="?delete=<?php echo $u->izena; ?>"
                           class="w3-button w3-small w3-red w3-round"
                           onclick="return confirm('Ziur zaude erabiltzaile hau ezabatu nahi duzula?')">Ezabatu</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="w3-center w3-margin-top">
        <button onclick="newUser()" class="w3-button w3-green w3-round-large"><b>+</b> Erabiltzaile Berria</button>
    </div>

    <div id="modalUser" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-top w3-round-large" style="max-width: 450px;">
            <header class="w3-container" style="background-color: #871521; color: white; border-radius: 8px 8px 0 0;">
                <span onclick="document.getElementById('modalUser').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h3 id="modalTitle">Erabiltzailea</h3>
            </header>

            <form class="w3-container w3-padding-24" method="POST">
                <input type="hidden" name="mode" id="formMode" value="new">
                <input type="hidden" name="izena_antiguo" id="formizenaAntiguo">

                <label><b>Erabiltzaile Izena</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="izena" id="formizena" required>

                <label><b>Pasahitza</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="pass" id="formPass" required>

                <label><b>Rola</b></label>
                <p id="avisoRol" class="w3-tiny w3-text-red w3-margin-0" style="display:none;">Ezin duzu zure rola aldatu saioa hasita duzun bitartean.</p>
                <select class="w3-select w3-border w3-round" name="rol" id="formRol">
                    <option value="jokalari">Jokalari</option>
                    <option value="kazetari">Kazetari</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" class="w3-button w3-block w3-margin-top w3-round-large" style="background-color: #871521; color: white;">GORDE</button>
            </form>
        </div>
    </div>
</main>

<script>
function newUser() {
    document.getElementById('modalTitle').innerText = 'Erabiltzaile Berria';
    document.getElementById('formMode').value = 'new';
    document.getElementById('formizena').value = '';
    document.getElementById('formizenaAntiguo').value = '';
    document.getElementById('formizena').readOnly = false;
    document.getElementById('formRol').disabled = false;
    document.getElementById('avisoRol').style.display = 'none';
    document.getElementById('modalUser').style.display = 'block';
}

function editUser(nom, pass, rol, esPropio) {
    document.getElementById('modalTitle').innerText = 'Editatu Erabiltzailea';
    document.getElementById('formMode').value = 'edit';
    document.getElementById('formizenaAntiguo').value = nom;
    document.getElementById('formizena').value = nom;
    document.getElementById('formizena').readOnly = false;
    document.getElementById('formPass').value = pass;
    document.getElementById('formRol').value = rol;
    document.getElementById('formRol').disabled = esPropio;
    document.getElementById('avisoRol').style.display = esPropio ? 'block' : 'none';
    document.getElementById('modalUser').style.display = 'block';
}
</script>

<?php include 'includes/footer.php'; ?>
