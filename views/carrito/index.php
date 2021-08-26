<h1>Carrito de la compra</h1>

<table class="detail-carrito">
    <tr>
        <th><strong>Pedido</strong></th>
        <th><strong>Imagen</strong></th>
        <th><strong>Producto</strong></th>
        <th><strong>Precio</strong></th>
        <th><strong>Cantidad</strong></th>
        <th><strong>Sub total</strong></th>
        <th><strong></strong></th>
    </tr>
    <!-- productos es una variable heredada de la funcion index de Producto Controller -->
    <?php foreach($carrito as $elemento): ?> 
    <tr>
        <!-- <td><?=$carrito[$indice]['producto']->nombre?></td> -->
        <td><?=$elemento['id_producto']?></td>
        <?php if($elemento['producto']->imagen != null): ?>
            <td><img src="<?=base_url?>uploads/images/<?=$elemento['producto']->imagen?>" alt="Producto" width="100"></td>
        <?php else: ?>
            <td><img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto" width="100"></td>
        <?php endif; ?>
        <td><a href="<?=base_url?>producto/ver&id=<?=$elemento['id_producto']?>"><?=$elemento['producto']->nombre?></a></td>
        <td>$<?=$elemento['producto']->precio?></td>
        <td><?=$elemento['unidades']?></td>
        <td>$<?=$elemento['precio'] * $elemento['unidades']?></td>
        <td>
            <!-- Button trigger modal Delete-->
            <a class="btn btn-outline-danger button-gestion" data-bs-toggle="modal" data-bs-target="#modalEliminarProducto<?=$elemento['id_producto']?>" style="margin-top:0;"><i class="bi bi-trash"></i></a>
        </td>
    </tr>
    <!-- Modal Delete -->
    <div class="modal fade" id="modalEliminarProducto<?=$elemento['id_producto']?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Relamente desea eliminar el producto <?=$elemento['producto']->nombre?> del carrito?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Eliminando producto del carrito...   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="btn btn-danger">Eliminar producto</a>
            </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</table>    
<?php $stats =  utils::statsCarrito();?>
<div class="total-carrito">
    <p class="title">Total del carrito</p>
    <table>
        <tbody>
            <tr>
                <th>Total productos</th>
                <td><?=$stats['count']?></td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td>$<?=$stats['total']?></td>
            </tr>
        </tbody>
    </table>
    <button class="button btn-carrito">Finalizar compra -></button>
</div>
    
