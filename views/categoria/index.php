<h1>Gestionar Categorias</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=="complete"): ?>
    <strong class="alert_green">Registro completado correctamente</strong>  
<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="failed"  ): ?>
    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<a href="<?=base_url?>categoria/crear" class="button button-small">Crear categorias</a>

<table>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>NOMBRE</strong></th>
    </tr>
    <!-- categorias es una variable heredada de la funcion index de Cetegoria Controller -->
    <?php while($cat = $categorias->fetch_object()): ?> 
    <tr>
        <td><?=$cat->id?></td>
        <td><?=$cat->nombre?></td>
    </tr>
    <?php endwhile; ?>
</table>