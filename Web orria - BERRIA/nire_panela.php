<?php
session_start();
require_once 'includes/functions.php';

// SEGURIDAD: Solo usuarios logueados con rol 'jokalari'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'jokalari') {
    header("Location: index.php");
    exit();
}

$pageTitle = "Nire Panela";
include 'includes/header.php';

// Cargar los datos de seguimiento
$seguimientoXML = simplexml_load_file('datos/seguimiento.xml');
$usuarioActual = $_SESSION['usuario'];

// Buscar el nodo del jugador actual usando XPath
$misDatos = $seguimientoXML->xpath("//jugador[@nombre='$usuarioActual']");
?>

<main class="w3-container w3-padding-32">
    <div class="orri-titulua-container">
        <h2 class="orri-titulua"><?php echo $usuarioActual ?>-(R)EN DIETA ETA ENTRENAMENDUA</h2>
        <span class="orri-marra"></span>
    </div>

    <?php if ($misDatos): 
        $datos = $misDatos[0]; ?>
        
        <div class="w3-row-padding">
            <div class="w3-col m6 w3-margin-bottom">
                <div class="w3-card-4 w3-white w3-round-large">
                    <header class="w3-container w3-teal w3-round-large" style="border-bottom-left-radius:0; border-bottom-right-radius:0;">
                        <h3><i class="fa fa-cutlery"></i> Asteko Dieta</h3>
                    </header>
                    <div class="w3-container w3-padding">
                        <ul class="w3-ul w3-border-0">
                            <?php foreach ($datos->dieta->comida as $comida): ?>
                                <li class="w3-padding-16">
                                    <span class="w3-tag w3-light-grey w3-text-teal w3-round"><b><?php echo $comida['tipo']; ?>:</b></span>
                                    <span class="w3-margin-left"><?php echo $comida; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="w3-panel w3-leftbar w3-sand w3-serif w3-margin-top">
                            <p><i>"<?php echo $datos->dieta->oharrak; ?>"</i></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3-col m6">
                <div class="w3-card-4 w3-white w3-round-large">
                    <header class="w3-container w3-blue-grey w3-round-large" style="border-bottom-left-radius:0; border-bottom-right-radius:0;">
                        <h3><i class="fa fa-bicycle"></i> Lan Plana</h3>
                    </header>
                    <div class="w3-container w3-padding">
                        <table class="w3-table w3-striped">
                            <?php foreach ($datos->entrenamendua->saioa as $saioa): ?>
                                <tr>
                                    <td style="width: 30%;"><b><?php echo $saioa['egun']; ?></b></td>
                                    <td><?php echo $saioa; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="w3-panel w3-pale-red w3-border w3-round w3-center">
            <p>Oraindik ez daukazu dieta edo entrenamendu planik esleituta. Jarri harremanetan administratzailearekin.</p>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>