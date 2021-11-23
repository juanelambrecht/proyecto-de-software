<?= $this->extend('template/inspector-template'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('inspectores/nuevaInfraccion') ?>" method="post">

            <div class="mb-3">
                <label for="patente" class="form-label">Patente </label>
                <input type="text" class="form-control" name="patente" placeholder="ex : AA-123-AA" pattern="^([A-HJ-NP-TV-Z]{3}-[0-9]{3})?([A-HJ-NP-TV-Z]{2}-[0-9]{3}-[A-HJ-NP-TV-Z]{2})?$" required />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="Date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" class="form-control" id="calle" name="calle" required>
            </div>
            <div class="mb-3">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura" name="altura" required>
            </div>
            
            <a href=""><button type="submit" class="btn btn-primary">Aceptar</button></a>
        </form>
    </div>
</div>

<?= $this->endsection('content'); ?>