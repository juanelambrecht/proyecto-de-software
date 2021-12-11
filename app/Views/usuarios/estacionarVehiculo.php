<?= $this->extend('template/client-template'); ?>
<?= $this->section('content'); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
  <?php if (session()->getFlashData('estacionarFail')) { ?>
    Swal.fire({
      icon: 'exito',
      title: 'Fallo el estacionar',
      text: 'verifique los horarios.',
      //   footer: '<a href="#registro">Todavia no se encuentra registrado?</a>'
    })

  <?php } ?>
</script>

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form class="was-validated" action="<?= site_url('/comprarNuevaEstadia') ?>" method="post">

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
            <div style="display: flex;">
                <button type="button" onclick="calcularPrecio()" class="btn btn-primary">Consultar Precio</button>
                <button id="totalToPay" style="margin-left: 5px;font-weight: bold;visibility: hidden;" type="button" class="btn btn-outline-info" disabled></button>
            </div>
            <br>
            <a href=""><button type="submit" class="btn btn-primary">Vender</button></a>
            
        </form>
    </div>
</div>

<script>
    function calcularPrecio(zonaId, horaIni, horaFin) {
        document.getElementById("totalToPay").style.visibility = 'visible';
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
<?= $this->endsection('content');
