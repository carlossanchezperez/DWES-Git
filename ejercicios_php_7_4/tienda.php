<?php
session_start();
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [
        'Camiseta' => ['precio' => 14.95, 'detalle' => 'Camiseta cómoda de algodón, disponible para uso diario.', 'imagen' => 'camiseta.svg'],
        'Mochila' => ['precio' => 29.90, 'detalle' => 'Mochila ligera con varios compartimentos y espacio para portátil.', 'imagen' => 'mochila.svg'],
        'Auriculares' => ['precio' => 19.50, 'detalle' => 'Auriculares estéreo para escuchar música y vídeos.', 'imagen' => 'auriculares.svg'],
        'Taza' => ['precio' => 7.25, 'detalle' => 'Taza de cerámica ideal para café, té o chocolate.', 'imagen' => 'taza.svg'],
    ];
}
if (!isset($_SESSION['cesta'])) {
    $guardada = json_decode($_COOKIE['cesta'] ?? '', true);
    $_SESSION['cesta'] = is_array($guardada) ? $guardada : [];
}
if (isset($_POST['comprar'], $_SESSION['productos'][$_POST['comprar']])) {
    $nombre = $_POST['comprar'];
    $_SESSION['cesta'][$nombre] = (int)($_SESSION['cesta'][$nombre] ?? 0) + 1;
}
if (isset($_POST['quitar'], $_SESSION['cesta'][$_POST['quitar']])) {
    $nombre = $_POST['quitar'];
    $_SESSION['cesta'][$nombre]--;
    if ($_SESSION['cesta'][$nombre] <= 0) unset($_SESSION['cesta'][$nombre]);
}
if (isset($_POST['vaciar'])) $_SESSION['cesta'] = [];
setcookie('cesta', json_encode($_SESSION['cesta']), ['expires'=>time()+90*24*60*60,'path'=>'/','samesite'=>'Lax']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') { header('Location: tienda.php'); exit; }
$productos = $_SESSION['productos']; $cesta = $_SESSION['cesta'];
$unidades = array_sum(array_map('intval', $cesta));
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function euros($n) { return number_format((float)$n, 2, ',', '.') . ' €'; }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ejercicio 3 · Tienda</title><link rel="stylesheet" href="estilos.css"></head><body><header class="hero compact"><p class="eyebrow">EJERCICIO 03</p><h1>Tienda de ejemplo</h1><p>Productos disponibles y carrito guardado en una cookie.</p></header><main class="container"><div class="shop-heading"><h2>Catálogo</h2><a class="button secondary" href="cesta.php">Ver cesta (<?= $unidades ?>)</a></div><div class="product-grid">
<?php foreach ($productos as $nombre => $p): ?><article class="product-card"><a href="detalle.php?producto=<?= rawurlencode($nombre) ?>"><img src="imagenes/<?= h($p['imagen']) ?>" alt="<?= h($nombre) ?>"></a><div class="product-info"><h3><?= h($nombre) ?></h3><p class="price"><?= euros($p['precio']) ?></p><p><?= h($p['detalle']) ?></p><form method="post"><button class="button" name="comprar" value="<?= h($nombre) ?>">Añadir a la cesta</button></form><a class="text-link" href="detalle.php?producto=<?= rawurlencode($nombre) ?>">Ver detalle e imagen grande</a></div></article><?php endforeach; ?>
</div><p class="note">Pulsa en una imagen o en «Ver detalle» para ver la ficha completa.</p><a class="text-link" href="index.php">← Volver al índice</a></main></body></html>
