<h1>Mis Pedidos</h1>
<table class="detail-carrito">
    <tr>
        <th><strong>N° Pedido</strong></th>
        <th><strong>Total</strong></th>
        <th><strong>Fecha</strong></th>
        <th><strong>Hora</strong></th>
        <th><strong>Estado</strong></th>
    </tr>
    <!-- productos es una variable heredada de la funcion index de Producto Controller -->
    <?php while($ped = $pedidos->fetch_object()): ?> 
    
    <tr>
        <td><a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalPedido<?=$ped->id?>"><?=$ped->id?></a></td>
        <td>$<?=$ped->coste?></td>
        <td><?=$ped->fecha?></td>
        <td><?=$ped->hora?></td>
        <td><?=$ped->estado?></td>
    </tr>

    <!-- Modal -->
    <div class="modal fade" id="modalPedido<?=$ped->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle pedido: <?=$ped->id?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                    $pedido_producto = $pedido->getProductosByPedidos($ped->id);
                    while($producto = $pedido_producto->fetch_object()): 
                ?>
                <ul class="lista-pedidos">
                    <li style="list-style-image: url('<?=base_url?>assets/img/list-icon.png')"><img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Producto" width="100"> - <?=$producto->nombre?> - X<?=$producto->unidades?> - $<?=$producto->precio?></li>
                    <hr>
                </ul>
                <?php endwhile;?>
                <div class="text-center">
                    <p>DIRECCIÓN DE ENVÍO</p>
                    <p><?=$ped->direccion?></p>
                    <p><?=$ped->localidad?></p>
                    <p><?=$ped->provincia?></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</table>  