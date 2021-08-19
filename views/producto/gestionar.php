<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear Productos</a>

<table>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>CATEGORIA</strong></th>
        <th><strong>NOMBRE</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>PRECIO</strong></th>
        <th><strong>STOCK</strong></th>
    </tr>
    <!-- categorias es una variable heredada de la funcion index de Cetegoria Controller -->
    <?php while($prod = $productos->fetch_object()): ?> 
    <tr>
        <td><?=$prod->id?></td>
        <td><?=$prod->categoria_id?></td>
        <td><?=$prod->nombre?></td>
        <td><?=$prod->descripcion?></td>
        <td><?=$prod->precio?></td>
        <td><?=$prod->stock?></td>
    </tr>
    <?php endwhile; ?>
</table>