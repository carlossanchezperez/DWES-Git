<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios PHP 7.4</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="hero">
        <h1>Ejercicios PHP 7.4</h1>
        <p>Sesiones, cookies y carrito de la compra</p>
    </header>

    <main class="container">
        <h2>Selecciona un ejercicio</h2>

        <div class="cards">

            <div class="card">
                <h2>Ejercicio 1</h2>
                <p>Paleta de colores</p>
                <a class="button" href="colores.php">Abrir ejercicio 1</a>
            </div>

            <div class="card">
                <h2>Ejercicio 2</h2>
                <p>Encuesta de corrupción</p>
                <a class="button" href="encuesta.php">Abrir ejercicio 2</a>
            </div>

            <div class="card">
                <h2>Ejercicio 3</h2>
                <p>Tienda y cesta de la compra</p>
                <a class="button" href="tienda.php">Abrir ejercicio 3</a>
            </div>

        </div>
    </main>

    <footer>
        Ejercicios PHP - Apartado 7.4
    </footer>

</body>
</html>
