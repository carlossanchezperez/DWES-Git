<?php
session_start();
$cookieName = 'votos_encuesta_74';
$duracion = time() + 90 * 24 * 60 * 60; // aproximadamente 3 meses
if (!isset($_SESSION['votos'])) {
    $guardados = json_decode($_COOKIE[$cookieName] ?? '', true);
    $_SESSION['votos'] = is_array($guardados) && isset($guardados['si'], $guardados['no'])
        ? ['si' => max(0, (int)$guardados['si']), 'no' => max(0, (int)$guardados['no'])]
        : ['si' => 0, 'no' => 0];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['voto']) && in_array($_POST['voto'], ['si','no'], true)) {
    $_SESSION['votos'][$_POST['voto']]++;
    setcookie($cookieName, json_encode($_SESSION['votos']), [
        'expires' => $duracion, 'path' => '/', 'samesite' => 'Lax'
    ]);
    header('Location: encuesta.php'); exit;
}
$v = $_SESSION['votos']; $total = $v['si'] + $v['no'];
$siPct = $total ? round($v['si'] / $total * 100) : 0;
$noPct = $total ? 100 - $siPct : 0;
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ejercicio 2 · Encuesta</title><link rel="stylesheet" href="estilos.css"></head><body><header class="hero compact"><p class="eyebrow">EJERCICIO 02</p><h1>Encuesta</h1><p>Los votos se conservan en la sesión y en una cookie durante tres meses.</p></header><main class="container narrow"><section class="panel">
<h2>¿Crees que actualmente hay corrupción en el gobierno?</h2><form method="post" class="inline-form"><button class="button" name="voto" value="si">Sí</button><button class="button secondary" name="voto" value="no">No</button></form>
<div class="results"><h3>Resultados · <?= $total ?> voto(s)</h3><div class="result-label"><span>Sí</span><strong><?= $v['si'] ?> (<?= $siPct ?>%)</strong></div><div class="bar"><div class="bar-fill yes" style="width:<?= $siPct ?>%"></div></div>
<div class="result-label"><span>No</span><strong><?= $v['no'] ?> (<?= $noPct ?>%)</strong></div><div class="bar"><div class="bar-fill no" style="width:<?= $noPct ?>%"></div></div></div>
<p class="muted">Si se cierra el navegador, los resultados podrán recuperarse desde la cookie del mismo navegador.</p><a class="text-link" href="index.php">← Volver al índice</a></section></main></body></html>
