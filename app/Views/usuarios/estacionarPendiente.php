<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">



</head>

<body>

    <div class="container" style="margin-top: 20px">
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('/estacionarNuevoPendiente') ?>" method="post">

            <div class="mb-3">
                <label for="usuario" class="form-label">Patente </label>
                <input type="text" value="<?= $vehiculo->patente?>" class="form-control" name="patente" pattern="^([A-Z]{3}-[0-9]{3})?([A-HJ-NP-TV-Z]{2}-[0-9]{3}-[A-HJ-NP-TV-Z]{2})?$" />
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Hora Inicio </label>
                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Hora Fin </label>
                <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
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
            <br>
            <button type="button" onclick="calcularPrecio()" class="btn btn-primary">Consultar Precio</button>
            <div id="div-precio">
                <p id="totalToPay"></p>
            </div>
            <br>
            <a href=""><button type="submit" class="btn btn-primary">Vender</button></a>
            
        </form>
        <br>
        <a href="../homeCliente"><button class="btn btn-secondary">Cancelar</button></a>
    </div>
</div>

<script>
    function calcularPrecio(zonaId, horaIni, horaFin) {
        zonaId = document.getElementById("zona").value;
        horaIni = document.getElementById("hora_inicio").value;
        horaFin = document.getElementById("hora_fin").value;
        url = "<?= base_url('api/estadiacontroller/precio/') ?>" +
            "/" + zonaId + "/" + horaIni + "/" + horaFin;
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'GET'
        }).then(function(data) {
            console.log(data);
            document.getElementById("totalToPay").innerHTML = '$ ' + data;
        });
    }
</script>
</div>
</body>
</html>
