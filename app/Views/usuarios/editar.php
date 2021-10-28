<?= $this->extend('template/intern-template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('/actualizar') ?>" method="post">

            <input type="hidden" name="id" value="<?= $usuario->id ?>">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" value="<?= $usuario->username ?>" class="form-control" name="usuario" required>
            </div>
            <!--
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" value="<?= $usuario->contraseña ?>" class="form-control" name="contraseña" required>
            </div> -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?= $usuario->nombre ?>" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" value="<?= $usuario->apellido ?>" class="form-control" name="apellido">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="<?= $usuario->email ?>" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">Documento Nacional de Identidad (DNI)</label>
                <input type="text" value="<?= $usuario->dni ?>" class="form-control" name="dni">
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" value="<?= $usuario->fecha_nacimiento ?>" class="form-control" name="fecha_nacimiento">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Rol de Usuario</label>
                <select class="form-select" id="inputGroupSelect01" name="rol">
                    <option selected value="<?= $usuario->id_rol ?>"><?php
                                                                        foreach ($roles as $rol) :
                                                                            if ($usuario->id_rol == $rol['id']) {
                                                                                echo $rol['nombre'];
                                                                            }
                                                                        endforeach; ?>
                    </option>
                    <?php foreach ($roles as $rol) :  ?>
                        <?php if ($usuario->id_rol != $rol['id']) { ?>
                            <option value=" <?php echo $rol['id']; ?>"> <?php echo $rol['nombre']; ?>
                            </option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <a href="listar.php"><button type="submit" class="btn btn-primary">Enviar</button></a>
        </form>
    </div>
</div>


<?= $this->endsection('content'); ?>