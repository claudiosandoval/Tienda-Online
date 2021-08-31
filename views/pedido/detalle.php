<h1>Detalle del pedido: <?=$_GET['id']?></h1>

<table class="detail-carrito">
    <tr>
        <th><strong>Imagen</strong></th>
        <th><strong>Producto</strong></th>
        <th><strong>Precio</strong></th>
        <th><strong>Cantidad</strong></th>
    </tr>
    <?php while($pro = $pedido_productos->fetch_object()): ?> 
    <tr>
        <?php if($pro->imagen != null): ?>
            <td><img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="Producto" width="100"></td>
        <?php else: ?>
            <td><img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto" width="100"></td>
        <?php endif; ?>
        <td><a href="<?=base_url?>producto/ver&id=<?=$pro->id?>"><?=$pro->nombre?></a></td>
        <td>$<?=$pro->precio?></td>
        <td><?=$pro->unidades?></td>
    </tr>
    <?php endwhile; ?>
</table>   