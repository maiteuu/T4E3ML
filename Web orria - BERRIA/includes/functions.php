<?php
function validarXML($xmlPath, $xsdPath) {
    $dom = new DOMDocument();
    if (!@$dom->load($xmlPath)) return false;

    libxml_use_internal_errors(true); 
    
    if ($dom->schemaValidate($xsdPath)) {
        return true;
    } else {
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            echo "<p style='color:red;'>Error XSD: " . $error->message . "</p>";
        }
        libxml_clear_errors();
        return false;
    }
}
function transformar($xmlObj, $xslPath, $parametros = []) {
    if (is_string($xmlObj)) {
        $xml = new DOMDocument();
        $xml->load($xmlObj);
    } else {
        $xml = $xmlObj;
    }

    $xsl = new DOMDocument();
    $xsl->load($xslPath);

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);
    foreach ($parametros as $nombre => $valor) {
        $proc->setParameter('', $nombre, $valor);
    }

    return $proc->transformToXML($xml);
}

function generarXMLSailkapena($xmlFederazioa, $idTemporada) {
    $equipos = [];
    $denboraldiaSeleccionada = null;
    foreach ($xmlFederazioa->Denboraldiak->Denboraldia as $d) {
        if ((string)$d['urtea'] === $idTemporada) {
            $denboraldiaSeleccionada = $d;
            break;
        }
    }
    if ($denboraldiaSeleccionada === null) {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadXML('<Sailkapena></Sailkapena>');
        return $dom;
    }
    if (isset($denboraldiaSeleccionada->DenboraldikoTaldeak->Talde)) {
        foreach ($denboraldiaSeleccionada->DenboraldikoTaldeak->Talde as $t) {
            $nombre = (string)$t->Izena;
            $equipos[$nombre] = [
                'izena' => $nombre,
                'ezkutua' => (string)$t->Ezkutua,
                'pj' => 0, 'pg' => 0, 'pe' => 0, 'pp' => 0,
                'gf' => 0, 'gc' => 0, 'puntos' => 0
            ];
        }
    }

    if (isset($denboraldiaSeleccionada->Jardunaldiak->Jardunaldi)) {
        foreach ($denboraldiaSeleccionada->Jardunaldiak->Jardunaldi as $j) {
            if (isset($j->Partidua)) {
                foreach ($j->Partidua as $p) {
                    if (isset($p['egoera']) && (string)$p['egoera'] === 'JokatuGabe') {
                        continue; 
                    }
                    if (!isset($p->Emaitza)) {
                        continue;
                    }

                    $e = (string)$p->EtxekoTaldea;
                    $k = (string)$p->KanpokoTaldea;
                    $ge = (int)$p->Emaitza['etxekoGolak'];
                    $gk = (int)$p->Emaitza['kanpokoGolak'];
                    if (isset($equipos[$e]) && isset($equipos[$k])) {
                        $equipos[$e]['pj']++; $equipos[$e]['gf'] += $ge; $equipos[$e]['gc'] += $gk;
                        $equipos[$k]['pj']++; $equipos[$k]['gf'] += $gk; $equipos[$k]['gc'] += $ge;
                        if ($ge > $gk) {
                            $equipos[$e]['puntos'] += 3; $equipos[$e]['pg']++; $equipos[$k]['pp']++;
                        } elseif ($ge < $gk) {
                            $equipos[$k]['puntos'] += 3; $equipos[$k]['pg']++; $equipos[$e]['pp']++;
                        } else {
                            $equipos[$e]['puntos'] += 1; $equipos[$k]['puntos'] += 1;
                            $equipos[$e]['pe']++; $equipos[$k]['pe']++;
                        }
                    }
                }
            }
        }
    }

    uasort($equipos, function($a, $b) {
        if ($a['puntos'] == $b['puntos']) {
            return ($b['gf'] - $b['gc']) - ($a['gf'] - $a['gc']);
        }
        return $b['puntos'] - $a['puntos'];
    });

    $xmlSalida = new SimpleXMLElement('<Sailkapena></Sailkapena>');
    $xmlSalida->addAttribute('temporada', $idTemporada);
    
    foreach ($equipos as $datos) {
        $linea = $xmlSalida->addChild('Lerroa');
        $linea->addChild('Taldea', htmlspecialchars($datos['izena']));
        $linea->addChild('Ezkutua', htmlspecialchars($datos['ezkutua']));
        $linea->addChild('PJ', $datos['pj']);
        $linea->addChild('Puntuak', $datos['puntos']);
        $linea->addChild('Irabaziak', $datos['pg']);
        $linea->addChild('Berdinduak', $datos['pe']);
        $linea->addChild('Galduak', $datos['pp']);
        $linea->addChild('AldekoGolak', $datos['gf']);
        $linea->addChild('AurkakoGolak', $datos['gc']);
    }

    $dom = dom_import_simplexml($xmlSalida)->ownerDocument;
    return $dom;
}
function cargarXML() {
    $ruta = 'xml/federazioa.xml';
    if (file_exists($ruta)) {
        return simplexml_load_file($ruta);
    } else {
        die("Error: No se encuentra el archivo xml/federazioa.xml. Revisa la carpeta.");
    }
}

function lortuAzkenDenboraldia() {
    $xml = cargarXML();
    $azkena = "";
    if (isset($xml->Denboraldiak->Denboraldia)) {
        foreach ($xml->Denboraldiak->Denboraldia as $denb) {
            $azkena = (string)$denb['urtea'];
        }
    }
    return $azkena;
}
?>