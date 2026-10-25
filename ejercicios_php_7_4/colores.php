<?php
session_start();
if (!isset($_SESSION['paleta'])) $_SESSION['paleta'] = [];
if (isset($_POST['anadir'])) {
    $color = sprintf('#%06X', random_int(0, 0xFFFFFF));
    $_SESSION['paleta'][] = $color;
    $_SESSION['color_fondo'] = $color;
    header('Location: colores.php'); exit;
}
if (isset($_POST['fondo']) && preg_match('/^#[0-9A-Fa-f]{6}$/', $_POST['fondo'])) {
    $_SESSION['color_fondo'] = $_POST['fondo'];
    header('Location: colores.php'); exit;
}
$fondo = $_SESSION['color_fondo'] ?? '#F3F4F6';
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ejercicio 1 · Colores</title><link rel="stylesheet" href="estilos.css"></head>
<body style="background: <?= h($fondo) ?>;"><header class="hero compact"><p class="eyebrow">EJERCICIO 01</p><h1>Generador de colores</h1><p>El color actual es <?= h($fondo) ?></p></header><main class="container narrow">
<section class="panel"><h2>Tu paleta</h2><p>Colores guardados en esta sesión: <strong><?= count($_SESSION['paleta']) ?></strong></p>
<form method="post" class="inline-form"><button class="button" name="anadir" value="1">Añadir color aleatorio</button><a class="button secondary" href="paleta.php">Mostrar paleta creada</a></form>
<?php if ($fondo !== '#F3F4F6'): ?><p class="muted">Pulsa «Añadir color aleatorio» para cambiar el fondo y guardar el nuevo color.</p><?php endif; ?>
<a class="text-link" href="index.php">← Volver al índice</a></section></main></body></html>
