<?= $this->extend('template/client-template'); ?>
<?= $this->section('content'); ?>




<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form style="width: 50%;" class="was-validated" action="<?= site_url('/cargarSaldo') ?>" method="post">

            <div class="mb-3">
                <label for="marca" class="form-label">Monto </label>
                <input type="number" class="form-control" name="monto" required>
            </div>
            <h4>Tarjeta de credito</h4>
            <div class="mb-3">
                <label for="modelo" class="form-label">Numero de tarjeta</label>
                <input type="tel" value="<?= $tarjeta['numero'] ?>" pattern="^\d{16}$" class="form-control" name="num" required>

            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Fecha de vencimiento</label>
                <input type="text" value="<?= $tarjeta['fecha_ven'] ?>" class="form-control" name="f_ven" placeholder="MM/YY" pattern="^\d{2}\/\d{2}$" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Codidgo de seguridad</label>
                <input type="text" value="<?= $tarjeta['cod_seguridad'] ?>" pattern="^\d{3}$" class="form-control" name="cod_seg" required>
            </div>

            <br>
            <a href=""><button type="submit" class="btn btn-primary">Cargar saldo</button></a>

        </form>
    </div>
</div>

<?= $this->endsection('content');
