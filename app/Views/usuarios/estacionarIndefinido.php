<?= $this->extend('/template/intern-template'); ?>
<?= $this->section('content'); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashData('ventaFail')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'No pueden existir dos estadias indefidas',
            text: 'Por favor, finaliza la anterior para generar una nueva.',
        })
    <?php } ?>
</script>
<script>
    <?php if (session()->getFlashData('ventaOk')) { ?>
        Swal.fire({
            // icon: 'error',
            title: 'Estadia generada',
            // text: 'Por favor, finaliza la anterior para generar una nueva.',
        })
    <?php } ?>
</script>
<script>
    <?php if (session()->getFlashData('ventaFailHoras')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Pruebe con otra hora de inicio',
            text: 'Ya tiene una estadia que choca con esa hora ingresada.',
        })
    <?php } ?>
</script>

<div class="container" style="margin-top: 20px">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form class="was-validated" action="<?= site_url('/venderEstadiaIndefinido') ?>" method="post">

                <div class="mb-3">
                    <label for="usuario" class="form-label">Patente </label>
                    <input type="text" value="<?= $vehiculo->patente ?>" class="form-control" name="patente" pattern="^([A-Z]{3}-[0-9]{3})?([A-HJ-NP-TV-Z]{2}-[0-9]{3}-[A-HJ-NP-TV-Z]{2})?$" />
                </div>
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Hora Inicio </label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Zona </label>
                    <select class="form-select" id="zona" name="zona">
                        <?php foreach ($zonas as $zona) : ?>
                            <option value="<?php echo $zona['id']; ?>"> <?php echo $zona['descripcion'];
                                                                        echo " - Precio Hora : $ ";
                                                                        echo $zona['costo_horario']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <a href=""><button type="submit" class="btn btn-primary">Vender</button></a>

            </form>
            <br>

        </div>
    </div>
</div>
<?= $this->endsection('content'); ?>