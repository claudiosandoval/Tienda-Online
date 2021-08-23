<h1>Crar nueva categoria</h1>

<div class="form-container">
    <form action="<?=base_url?>categoria/save" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
        <input type="submit" value="Guardar">
    </form>
</div>