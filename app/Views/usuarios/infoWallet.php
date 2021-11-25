<?= $this->extend('template/client-template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <br>
        <div class="mb-3">
            <label for="marca" class="form-label">Saldo $ </label>
            <input readonly type="number" value="<?= $cliente['saldo'] ?>" name="misaldo">
        </div>
        <br>
        <a href="./tarjetaCredito"><button type=" submit" class="btn btn-primary">Tarjeta de Credito</button></a>
        <br>
        <br>
        <a href="./ingresarSaldo"><button type="submit" class="btn btn-primary">Cargar saldo</button></a>
    </div>
</div>

<?= $this->endsection('content');
