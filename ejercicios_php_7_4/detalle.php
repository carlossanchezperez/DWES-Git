<?php
session_start();
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [
        'Camiseta'=>['precio'=>14.95,'detalle'=>'Camiseta cómoda de algodón, disponible para uso diario.','imagen'=>'camiseta.svg'],
        'Mochila'=>['precio'=>29.90,'detalle'=>'Mochila ligera con varios compartimentos y espacio para portátil.','imagen'=>'mochila.svg'],
        'Auriculares'=>['precio'=>19.50,'detalle'=>'Auriculares estéreo para escuchar música y vídeos.','imagen'=>'auriculares.svg'],
        'Taza'=>['precio'=>7.25,'detalle'=>'Taza de cerámica ideal para café, té o chocolate.','imagen'=>'taza.svg'],
    ];
}
$nombre=$_GET['producto'] ?? '';
if (!isset($_SESSION['productos'][$nombre])) { header('Location: tienda.php'); exit; }
$p=$_SESSION['productos'][$nombre];
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function euros($n){return number_format((float)$n,2,',','.').' €';}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Detalle de <?= h($nombre) ?></title><link rel="stylesheet" href="estilos.css"></head><body><header class="hero compact"><p class="eyebrow">EJERCICIO 03</p><h1>Detalle del producto</h1></header><main class="container narrow"><section class="detail-card"><img src="imagenes/<?= h($p['imagen']) ?>" alt="<?= h($nombre) ?>"><div><h2><?= h($nombre) ?></h2><p class="price"><?= euros($p['precio']) ?></p><p><?= h($p['detalle']) ?></p><form method="post" action="tienda.php"><button class="button" name="comprar" value="<?= h($nombre) ?>">Añadir a la cesta</button></form><a class="text-link" href="tienda.php">← Volver a la tienda</a></div></section></main></body></html>
