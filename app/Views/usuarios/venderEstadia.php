<?= $this->extend('template/admin-template'); ?>
<?= $this->section('content'); ?>



<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('/venderNuevaEstadiaAdmin') ?>" method="post">

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
                <label for="contraseña" class="form-label">Hora Inicio </label>
                <input type="time" class="form-control" name="hora_inicio" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Hora Fin </label>
                <input type="time" class="form-control" name="hora_fin" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Zona </label>
                <select class="form-select" id="inputGroupSelect01" name="zona">
                    <?php foreach ($zonas as $zona) : ?>
                        <option value="<?php echo $zona['id']; ?>"> <?php echo $zona['descripcion'];
                                                                    echo " - Precio Hora : $ ";
                                                                    echo $zona['costo_horario']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni">
            </div> -->
            <br>
            <button type="button" onclick="check_price()" class="btn btn-primary">Consultar Precio</button>
            <!-- <input readonly type="text" id="totalToPay"> -->
            <p id="totalToPay"></p>
            <br>
            <a href=""><button type="submit" class="btn btn-primary">Vender</button></a>

        </form>
    </div>
</div>
<script>
    function check_price() {
        document.getElementById("totalToPay").innerHTML = '$' + getPrice();
    }

    function getPrice() {
        // var $total = '<?php site_url('/consultarPrecio') ?>';
        // return $total;
        return 10;
    }
</script>
<?= $this->endsection('content');
