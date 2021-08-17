<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Tienda Online</title>
</head>
<body>
    <div id="container">
        <!-- Head -->
        <header id="header">
            <div id="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda Online      
                </a>
            </div>
        </header>
        <!-- Menu -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a href="">Inicio</a>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div id="main-content">
            <!-- Aside -->
            <aside id="aside">
                <div id="login" class="block_aside">
                    <h3>Entrar a la web</h3>
                    <form action="#" method="POST">
                        <label for="email">Email:</label>
                        <input type="email" name="email">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <ul>
                        <li><a href="">Mis pedidos</a></li>
                        <li><a href="">Gestionar pedidos</a></li>
                        <li><a href="">Gestionar categorias</a></li>
                    </ul>  
                </div>
            </aside>
            <div id="central">
                <h1>Productos Destacados</h1>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul ancha</h2>
                    <p>$7000</p>
                    <a class="button" href="">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul ancha</h2>
                    <p>$7000</p>
                    <a class="button" href="">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul ancha</h2>
                    <p>$7000</p>
                    <a class="button" href="">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="Camiseta">
                    <h2>Camiseta azul ancha</h2>
                    <p>$7000</p>
                    <a class="button" href="">Comprar</a>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer id="footer">
            <p>Desarrollador por Claudio Sandoval &copy <?=date('Y')?></p>
        </footer>
    </div>
</body>
</html>