<h1>Revisa nuestros productos uwu</h1>
<?php while($pro = $productos->fetch_object()): ?>
<div class="product">
    <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>">
        <?php if($pro->imagen != null): ?>
        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="Producto">
        <?php else: ?>
        <img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto">
        <?php endif; ?>
    </a>
    <h2><?=$pro->nombre?></h2>
    <p>$<?=$pro->precio?></p>
    <a class="button" href="<?=base_url?>carrito/add&id=<?=$pro->id?>">Comprar</a>
</div>
<?php endwhile; ?>