<?php if(isset($producto)): ?>
    <div id="detail-product">
        <?php if($producto->imagen != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Producto">
        <?php else: ?>
            <img src="<?=base_url?>assets/img/no-disponible.jpg" alt="Producto">
        <?php endif; ?>
        <div class="descripcion">
            <h1><?=$producto->nombre?></h1>
            <p>$<?=$producto->precio?></p>
            <p><?=$producto->descripcion?></p>
            <p class="stock"><?=$producto->stock?> Disponibles</p>
            <div class="add-carrito">
                <form action="<?=base_url?>carrito/add&id=<?=$producto->id?>" method="POST">
                    <?php if($producto->stock == 0): ?>
                        <input type="number" name="unidades" value="0" min="0" max="<?=$producto->stock?>"> 
                        <p class="alert-danger text-center" style="width: 50% !important; float: left; margin: 15px 0px 0px 15px">No disponible</p>
                    <?php else: ?>
                        <input type="number" name="unidades" value="1" min="1" max="<?=$producto->stock?>"> 
                        <button class="button" type="submit">Añadir al carrito</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>