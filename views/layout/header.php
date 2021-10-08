<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"><!--  bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"><!--  bootstrap icon css -->
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css"><!--  mi css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet"><!--  poppins font family -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Tienda Link-to </title>
</head>
<body>
<div id="container">
    <!-- Head -->
    <header id="header">
        <div id="logo">
            <h1>
                <a href="index.php">
                    <img src="<?=base_url?>assets/img/link-to.png" alt="Link Logo">
                    Tienda Link-to <span style="font-size:16px; text-shadow:none; color:#b99658;">Impresiones 3d</span>
                </a>
            </h1>
        </div>
    </header>
    <!-- Menu -->
    <?php $categorias = Utils::showCategorias() ?><!--  Devuelve un mysqlresult del objeto categorias -->
    <nav id="menu">
        <ul>
            <li>
                <a href="<?=base_url?>">Inicio</a>
            </li>
            <?php while($cat = $categorias->fetch_object()): ?>
            <li>
                <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </nav>
    <div class="divider"></div>
    <!-- Main Content -->
    <div id="main-content">