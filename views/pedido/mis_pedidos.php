<?php if(isset($gestion)): ?>
    <h1>Gestionar Pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>
<table class="detail-carrito">
    <tr> 
        <th><strong>N° Pedido</strong></th>
        <th><strong>Total</strong></th>
        <th><strong>Fecha</strong></th>
        <th><strong>Hora</strong></th>
        <th><strong>Estado</strong></th>
        <?php if(isset($gestion)): ?>
            <th><strong>Acción</strong></th>
        <?php endif; ?>
    </tr>
    <!-- productos es una variable heredada de la funcion index de Producto Controller -->
    <?php while($ped = $pedidos->fetch_object()): ?> 
    <tr>
        <td><a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalPedido<?=$ped->id?>"><?=$ped->id?></a></td>
        <td>$<?=$ped->coste?></td>
        <td><?=$ped->fecha?></td>
        <td><?=$ped->hora?></td>
        <td><?= Utils::showStatus($ped->estado)?></td>
        <?php if(isset($gestion)): ?>
        <td>
            <!-- Button trigger modal Edit-->
            <a id="botonEditPedido<?=$ped->id?>" class="btn btn-outline-dark button-gestion" data-bs-toggle="modal" data-bs-target="#modalEditarPedido<?=$ped->id?>" style="margin-top:0;"><i class="bi bi-pencil-square"></i></a>
        </td>
        <?php endif; ?> 
    </tr>

    <!-- Modal Pedido -->
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
                    <li style="list-style-image: url('<?=base_url?>assets/img/list-icon.png')">
                        <?php if($producto->imagen != null): ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Producto" width="100">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto" width="100">
                        <?php endif; ?>
                        - <?=$producto->nombre?> - X<?=$producto->unidades?> - $<?=$producto->precio?></li>
                    <hr>
                </ul>
                <?php endwhile;?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                                $datos_usuario = $pedido->getDatosUsuario($ped->id);
                             ?>
                            <p>DATOS DEL CLIENTE:</p>
                            <p><strong>Nombre: </strong><?=$datos_usuario->nombre?></p>
                            <p><strong>Email: </strong><?=$datos_usuario->email?></p>
                        </div>
                            <div class="col-lg-6">
                                <p>DIRECCIÓN DE ENVÍO:</p>
                                <p><strong>Dirección: </strong><?=$ped->direccion?></p>
                                <p><strong>Comuna: </strong><?=$ped->localidad?></p>
                                <p><strong>Provincia: </strong><?=$ped->provincia?></p>
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditarPedido<?=$ped->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar estado del pedido: <?=$ped->id?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditStatus<?=$ped->id?>" action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?=$ped->id?>" name="pedido_id">
                    <select name="estado" style="width:100%;">
                        <option value="confirm" <?= $ped->estado == 'confirm' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="preparation" <?= $ped->estado == 'preparation' ? 'selected' : '' ?>>En preparacion</option>
                        <option value="ready" <?= $ped->estado == 'ready' ? 'selected' : '' ?>>Preparado para enviar</option>
                        <option value="sended" <?= $ped->estado == 'sended' ? 'selected' : '' ?>>Enviado</option>
                    </select>
                </form> 
            </div>
            <div class="modal-footer">
                <button id="buttonSubmit<?=$ped->id?>" type="button" class="btn btn-warning btn-actualizar">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</table>  