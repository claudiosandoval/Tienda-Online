<!-- Reutilizamos la vista crear para el editar, en el cual el metodo cambia en base a la variable edit creada en producto controller, si es true = se muestra el formulario editar y la accion correspondiente, al igual que los valores rellenados por defecto-->
<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Edicion para el producto: <?=$pro->nombre?></h1>
    <?php $url_action = base_url.'producto/save&id='.$pro->id; ?>
<?php else: ?>
    <h1>Crear nuevos productos</h1>
    <?php $url_action = base_url.'producto/save'; ?>
<?php endif; ?>
<div class="form-container">
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : '';?>" required>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="" cols="50" rows="10"><?=isset($pro) && is_object($pro) ? $pro->descripcion : '';?></textarea>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : '';?>">
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : '';?>">
        <label for="categoria">Categoria:</label>
        <?php $categorias = Utils::showCategorias() ?>  
        <select name="categoria" id="">
            <?php while($cat = $categorias->fetch_object()): ?>
            <!-- Comparamos con una ternaria si el id de la categoria que estamos recorriendo es igual al id de la categoria del producto a editar, marcamelo con un selected -->
            <option value="<?=$cat->id?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>><?=$cat  ->nombre?></option>
            <?php endwhile; ?>
        </select>    
        <label for="imagen">Imagen:</label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="<?=$pro->imagen?>" class="thumb">
        <?php endif; ?>
        <input type="file" name="imagen">
        <input type="submit" value="Guardar">
    </form>
</div>