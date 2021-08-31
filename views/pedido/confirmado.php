<?php if(isset($_SESSION['pedido']) ): ?>
    <!-- <?php var_dump($_SESSION['pedido']) ?> -->
    <h1>Tu pedido se ha confirmado</h1>
    <p style="text-align:center;">Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria con el total del pedido, será procesado y enviado.       </p>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != "complete"): ?>
    <h1>Pedido fallido</h1>
    <p>El pedido no se ha guardado con exito, intentelo de nuevo</p> 
<?php endif; ?>
<?php if(isset($pedido)): ?>
    <p class="title">Productos:</p>
    <table class="detail-carrito">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        <?php while($producto = $productos->fetch_object()): ?>
        <tr>
                <td><?=$producto->nombre?></td>
                <td>$<?=$producto->precio?></td>
                <td><?=$producto->unidades?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <div class="total-carrito">
        <p class="title">Datos del pedido</p>
        <table>
            <tbody>
                <tr>
                    <th>N° Pedido</th>
                    <td><?=$pedido->id?></td>
                </tr>
                <tr>
                    <th>Total a pagar</th>
                    <td>$<?=$pedido->coste?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>