<?php
/**
 * ARCHIVO DE FUNCIONES PRINCIPALES - PROYECTO FNFS
 * Este archivo gestiona la lógica de XML, validación y transformaciones XSLT.
 */

// 1. FUNCIÓN PARA VALIDAR EL XML CONTRA EL XSD (5% de la nota)
function validarXML($xmlPath, $xsdPath) {
    $dom = new DOMDocument();
    if (!@$dom->load($xmlPath)) return false;

    libxml_use_internal_errors(true); // Captura errores internamente
    
    if ($dom->schemaValidate($xsdPath)) {
        return true;
    } else {
        // Esto imprimirá en pantalla el error exacto de validación
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            echo "<p style='color:red;'>Error XSD: " . $error->message . "</p>";
        }
        libxml_clear_errors();
        return false;
    }
}

// 2. FUNCIÓN PARA TRANSFORMAR XML USANDO XSLT (50% de la nota)
function transformar($xmlObj, $xslPath, $parametros = []) {
    // Si $xmlObj es una ruta de archivo (string), lo cargamos. Si es un objeto DOM, lo usamos.
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

    // Si queremos pasar variables de PHP al XSLT (ej: la temporada elegida)
    foreach ($parametros as $nombre => $valor) {
        $proc->setParameter('', $nombre, $valor);
    }

    return $proc->transformToXML($xml);
}

// 3. FUNCIÓN "MÁGICA": CALCULAR CLASIFICACIÓN (15% de la nota)
// Como la clasificación NO está en el XML, esta función la calcula y genera un XML temporal.
function generarXMLSailkapena($xmlFederazioa, $idTemporada) {
    $equipos = [];

    // A. Inicializar datos de todos los equipos
    foreach ($xmlFederazioa->TaldeGuztiak->Talde as $t) {
        $nombre = (string)$t->Izena;
        $equipos[$nombre] = [
            'izena' => $nombre,
            'ezkutua' => (string)$t->Ezkutua,
            'pj' => 0, 'pg' => 0, 'pe' => 0, 'pp' => 0,
            'gf' => 0, 'gc' => 0, 'puntos' => 0
        ];
    }

    // B. Procesar los partidos de la temporada seleccionada
    foreach ($xmlFederazioa->Denboraldiak->Denboraldia as $d) {
        if ((string)$d['id'] == $idTemporada) {
            foreach ($d->Jardunaldiak->Jardunaldi as $j) {
                foreach ($j->Partidua as $p) {
                    $e = (string)$p->EtxekoTaldea;
                    $k = (string)$p->KanpokoTaldea;
                    $ge = (int)$p->Emaitza['etxekoGolak'];
                    $gk = (int)$p->Emaitza['kanpokoGolak'];

                    // Sumar partidos y goles
                    $equipos[$e]['pj']++; $equipos[$e]['gf'] += $ge; $equipos[$e]['gc'] += $gk;
                    $equipos[$k]['pj']++; $equipos[$k]['gf'] += $gk; $equipos[$k]['gc'] += $ge;

                    // Lógica de puntos
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

    // C. Ordenar por puntos (y diferencia de goles en caso de empate)
    uasort($equipos, function($a, $b) {
        if ($a['puntos'] == $b['puntos']) {
            return ($b['gf'] - $b['gc']) - ($a['gf'] - $a['gc']);
        }
        return $b['puntos'] - $a['puntos'];
    });

    // D. CREAR UN NUEVO DOCUMENTO XML CON LOS RESULTADOS
    // Esto es lo que leerá tu sailkapena.xsl
    $xmlSalida = new SimpleXMLElement('<Sailkapena></Sailkapena>');
    $xmlSalida->addAttribute('temporada', $idTemporada);
    
    foreach ($equipos as $datos) {
        $linea = $xmlSalida->addChild('Lerroa');
        $linea->addChild('Taldea', $datos['izena']);
        $linea->addChild('Ezkutua', $datos['ezkutua']);
        $linea->addChild('PJ', $datos['pj']);
        $linea->addChild('Puntuak', $datos['puntos']);
        $linea->addChild('Irabaziak', $datos['pg']);
        $linea->addChild('Berdinduak', $datos['pe']);
        $linea->addChild('Galduak', $datos['pp']);
        $linea->addChild('AldekoGolak', $datos['gf']);
        $linea->addChild('AurkakoGolak', $datos['gc']);
    }

    // Convertimos SimpleXML a DOMDocument para que sea compatible con la función transformar
    $dom = dom_import_simplexml($xmlSalida)->ownerDocument;
    return $dom;
}

// 4. FUNCIÓN PARA CARGAR EL XML PRINCIPAL
function cargarXML() {
    $ruta = 'xml/federazioa.xml'; // <--- RUTA CORRECTA
    if (file_exists($ruta)) {
        return simplexml_load_file($ruta);
    } else {
        die("Error: No se encuentra el archivo xml/federazioa.xml. Revisa la carpeta.");
    }
}
?>