<h1>Gestión de productos</h1>

<!-- Mostrar errores al ingresar un producto -->
<?php if(isset($_SESSION['producto']) && $_SESSION['producto']=="complete"): ?>
    <strong class="alert_green">Registro completado correctamente</strong>  
    <?php elseif(isset($_SESSION['producto']) && $_SESSION['producto']=="failed"): ?>
    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
    <!-- Borramos la sesion anterior para que al actualizar deje de mostrar cuando registremos -->
<?php Utils::deleteSession('producto'); ?> 

<!-- Mostrar un producto al eliminar un producto -->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete']=="complete"): ?>
    <strong class="alert_green">Registro eliminado completamente</strong>  
    <?php elseif(isset($_SESSION['delete']) && $_SESSION['delete']=="failed"): ?>
    <strong class="alert_red">No se pudo eliminar el producto</strong>
<?php endif; ?>
    <!-- Borramos la sesion anterior para que al actualizar deje de mostrar cuando registremos -->
<?php Utils::deleteSession('delete'); ?> 
<a href="<?=base_url?>producto/crear" class="button button-small">Crear Productos</a>
<table>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>CATEGORIA</strong></th>
        <th><strong>NOMBRE</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PRECIO</strong></th>
        <th><strong>STOCK</strong></th>
        <th><strong>ACCIONES</strong></th>
    </tr>
    <!-- productos es una variable heredada de la funcion index de Producto Controller -->
    <?php while($prod = $productos->fetch_object()): ?> 
    <tr>
        <td><?=$prod->id?></td>
        <td><?=$prod->nombre_categoria?></td>
        <td><?=$prod->nombre?></td>
        <td><?=$prod->descripcion?></td>
        <td>$<?=$prod->precio?></td>
        <td><?=$prod->stock?></td>
        <td>
            <!-- Button trigger modal Delete-->
            <a class="btn btn-outline-danger button-gestion" data-bs-toggle="modal" data-bs-target="#modalEliminarProducto<?=$prod->id?>" style="margin-top:0;"><i class="bi bi-trash"></i></a>
            <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="btn btn-outline-secondary button-gestion" style="margin-top:0;"><i class="bi bi-pencil-square"></i></a>
        </td>
    </tr>
    <!-- Modal Delete -->
    <div class="modal fade" id="modalEliminarProducto<?=$prod->id?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Relamente desea eliminar el producto <?=$prod->nombre?> con Id= <?=$prod->id?>?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                El producto se eliminará permanentemente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="btn btn-danger">Eliminar producto</a>
            </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</table>