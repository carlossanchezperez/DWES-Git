<?php
session_start();
if (isset($_POST['reiniciar'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
    header('Location: colores.php'); exit;
}
$paleta = $_SESSION['paleta'] ?? [];
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Paleta creada</title><link rel="stylesheet" href="estilos.css"></head><body><header class="hero compact"><p class="eyebrow">EJERCICIO 01</p><h1>Paleta creada</h1><p>Pulsa un color para usarlo como fondo en la página principal.</p></header><main class="container">
<?php if (!$paleta): ?><section class="panel"><p>Aún no has añadido colores.</p><a class="button" href="colores.php">Volver y añadir colores</a></section>
<?php else: ?><div class="palette"><?php foreach (array_chunk($paleta, 5) as $fila): ?><div class="palette-row"><?php foreach ($fila as $color): ?><form method="post" action="colores.php" class="swatch-form"><button class="swatch" style="background:<?= h($color) ?>" name="fondo" value="<?= h($color) ?>" title="Usar <?= h($color) ?>"><span><?= h($color) ?></span></button></form><?php endforeach; ?></div><?php endforeach; ?></div><?php endif; ?>
<div class="actions"><a class="button" href="colores.php">Volver a la página principal</a><form method="post"><button class="button danger" name="reiniciar" value="1">Destruir sesión y empezar de nuevo</button></form></div>
</main></body></html>
