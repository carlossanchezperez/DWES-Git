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
if (!isset($_SESSION['cesta'])) { $c = json_decode($_COOKIE['cesta'] ?? '', true); $_SESSION['cesta'] = is_array($c) ? $c : []; }
if (isset($_POST['quitar'], $_SESSION['cesta'][$_POST['quitar']])) { $n=$_POST['quitar']; $_SESSION['cesta'][$n]--; if ($_SESSION['cesta'][$n] <= 0) unset($_SESSION['cesta'][$n]); }
if (isset($_POST['vaciar'])) $_SESSION['cesta']=[];
setcookie('cesta', json_encode($_SESSION['cesta']), ['expires'=>time()+90*24*60*60,'path'=>'/','samesite'=>'Lax']);
if ($_SERVER['REQUEST_METHOD']==='POST') { header('Location: cesta.php'); exit; }
$productos=$_SESSION['productos']; $cesta=$_SESSION['cesta']; $total=0; $unidades=0;
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function euros($n){return number_format((float)$n,2,',','.').' €';}
foreach($cesta as $n=>$cantidad){ if(isset($productos[$n])){$total += $productos[$n]['precio']*(int)$cantidad; $unidades+=(int)$cantidad;} }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Mi cesta</title><link rel="stylesheet" href="estilos.css"></head><body><header class="hero compact"><p class="eyebrow">EJERCICIO 03</p><h1>Mi cesta</h1><p><?= $unidades ?> producto(s) en la cesta</p></header><main class="container"><section class="panel">
<?php if (!$cesta): ?><p>La cesta está vacía.</p><?php else: ?><div class="table-wrap"><table><thead><tr><th>Producto</th><th>Precio unidad</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th></tr></thead><tbody>
<?php foreach($cesta as $n=>$cantidad): if(!isset($productos[$n])) continue; $p=$productos[$n]; ?><tr><td><div class="cart-product"><img src="imagenes/<?= h($p['imagen']) ?>" alt=""><strong><?= h($n) ?></strong></div></td><td><?= euros($p['precio']) ?></td><td><?= (int)$cantidad ?></td><td><?= euros($p['precio']*(int)$cantidad) ?></td><td><form method="post"><button class="button small danger" name="quitar" value="<?= h($n) ?>">Quitar 1</button></form></td></tr><?php endforeach; ?>
</tbody></table></div><div class="total-line"><span>Total de la compra</span><strong><?= euros($total) ?></strong></div><form method="post"><button class="button secondary" name="vaciar" value="1">Vaciar cesta</button></form><?php endif; ?>
<div class="actions"><a class="button" href="tienda.php">Cerrar cesta y volver a la tienda</a><a class="text-link" href="index.php">Volver al índice</a></div></section></main></body></html>
