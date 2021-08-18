<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
    <title>Tienda Link-to </title>
</head>
<body>
<div id="container">
    <!-- Head -->
    <header id="header">
        <div id="logo">
            <img src="<?=base_url?>assets/img/link-to.png" alt="Link Logo">
            <a href="index.php">
                Tienda Link-to <span style="font-size:16px; text-shadow:none; color:#b99658;">Impresiones 3d</span>
            </a>
        </div>
    </header>
    <!-- Menu -->
    <?php $categorias = Utils::showCategorias() ?><!--  Devuelve un mysqlresult del objeto categorias -->
    <nav id="menu">
        <ul>
            <li>
                <a href="">Inicio</a>
            </li>
            <?php while($cat = $categorias->fetch_object()): ?>
            <li>
                <a href=""><?=$cat->nombre?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </nav>
    <!-- Main Content -->
    <div id="main-content">