<?= $this->extend('template/client-template');?>
<?= $this->section('content'); ?>

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('/altaNuevoVehiculo') ?>" method="post">

            <div class="mb-3">
                <label for="usuario" class="form-label">Patente </label>
                <input type="text" class="form-control" name="patente" placeholder="ex : AA-123-AA" pattern="^([A-HJ-NP-TV-Z]{3}-[0-9]{3})?([A-HJ-NP-TV-Z]{2}-[0-9]{3}-[A-HJ-NP-TV-Z]{2})?$" required />
            </div>
            <div>
                <h4>Patrones permitidos</h4>
                <ul>
                    <li>AAA-123</li>
                    <li>AA-123-AA</li>
                </ul>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca </label>
                <input type="text" class="form-control" name="modelo" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" required>
            </div>
      
         
            <!-- <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni">
            </div> -->
            <br>
            <a href=""><button type="submit" class="btn btn-primary">Dar de Alta</button></a>

        </form>
    </div>
</div>

<?= $this->endsection('content');