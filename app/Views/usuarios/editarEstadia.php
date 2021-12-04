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
        <form class="was-validated" action="<?=site_url('/actualizarEstadia')?>" method="post">
            
            <input type="hidden" name="id" value="<?=$estadias->id?>">
          
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora Inicio </label>
                <input type="time" class="form-control" id="horaInicio" name="horaInicio" required>
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora Fin </label>
                <input type="time" class="form-control" id="horaFin" name="horaFin" required>
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
            <a href="listadoEstadiaAdmin.php"><button type="submit" class="btn btn-primary">Actualizar</button></a>
        </form>
    </div>
</div>






    </div>
</body>
</html>