<?php if(!isset($_SESSION['identity'])): ?>
    <h1>Identificate</h1>
    <p class="text-center">Necesitas estar logeado para realizar pedidos dentro de la web</p>
<?php else: ?>
    <h1>Realizar pedido</h1>
    <a href="<?=base_url?>carrito/index">Carrito</a><span> > Pedido</span>  
    <div class="form-container">
        <form action="<?=base_url?>pedido/add" method="POST">
            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia" required>
            <label for="localidad">Comuna o localidad:</label>
            <input type="text" name="localidad" required>
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" required>
            <input type="submit" value="Confirmar pedido">
        </form>
    </div>
<?php endif; ?>