<h1>Revisa nuestros productos uwu</h1>
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