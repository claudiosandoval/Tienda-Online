<?php if(isset($categoria)): ?>
    <h1><?=$categoria->nombre?></h1>
    <?php if($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar</p>
    <?php else: ?>
        <?php while($pro = $productos->fetch_object()): ?>
        <div class="product">
            <?php if($pro->imagen != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="Producto">
            <?php else: ?>
            <img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto">
            <?php endif; ?>
            <h2><?=$pro->nombre?></h2>
            <p>$<?=$pro->precio?></p>
            <a class="button" href="">Comprar</a>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>

