<h1>Crear nuevos productos</h1>

<form action="<?=base_url?>usuario/crear" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    <label for="descripcion">Descripcion:</label>
    <textarea name="descripcion" id="" cols="50" rows="10"></textarea>
    <label for="precio">Precio:</label>
    <input type="text" name="precio">
    <label for="stock">Stock:</label>
    <input type="number" name="stock">
    <label for="categoria">Categoria:</label>
    <?php $categorias = Utils::showCategorias() ?>  
    <select name="categoria" id="">
        <?php while($cat = $categorias->fetch_object()): ?>
        <option value="<?=$cat->id?>"><?=$cat->nombre?></option>
        <?php endwhile; ?>
    </select>    
</form>