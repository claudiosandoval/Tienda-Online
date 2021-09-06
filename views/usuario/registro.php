<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=="complete"): ?>
    <strong class="alert_green">Registro completado correctamente</strong>  
<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="failed"  ): ?>
    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<!-- Borramos la sesion anterior para que al actualizar deje de mostrar cuando registremos -->
<?php Utils::deleteSession('register'); ?> 

<!-- <?php 
if(isset($_SESSION['register'])) {
    echo $_SESSION['register'];
}
?> -->

<!-- index.php?controller=usuario&action=save (esta action ya no funciona debido a que implementamos rutas amigables con htaccess)-->
<div class="form-container">
    <form action="<?=base_url?>usuario/save" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
    
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
    
        <label for="email">Email:</label>
        <input type="email" name="email" required>
    
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
    
        <!-- <label for="rol">Rol:</label>
        <select name="select" required>
            <option value="admin">Admin</option>
            <option value="user" selected>Usuario</option>
        </select> -->
        <input type="submit" value="Registrarse">
    </form>
</div>