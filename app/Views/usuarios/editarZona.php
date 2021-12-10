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
        <form class="was-validated" action="<?=site_url('/actualizarZona')?>" method="post">
            
            <input type="hidden" name="id" value="<?=$zonas['id']?>">
          
            <div class="mb-3">
                <label for="horaInicioAm" class="form-label">Hora Inicio AM</label>
                <input type="time" class="form-control" id="horaInicioAm" name="horaInicioAm" >
            </div>
            <div class="mb-3">
                <label for="horaFinAm" class="form-label">Hora Fin AM</label>
                <input type="time" class="form-control" id="horaFinAm" name="horaFinAm" >
            </div>
            <div class="mb-3">
                <label for="horaInicioPm" class="form-label">Hora Inicio PM</label>
                <input type="time" class="form-control" id="horaInicioPm" name="horaInicioPm" >
            </div>
            <div class="mb-3">
                <label for="horaFinPm" class="form-label">Hora Fin PM</label>
                <input type="time" class="form-control" id="horaFinPm" name="horaFinPm" >
            </div>
            <div class="mb-3">
                <label for="costo" class="form-label">Costo</label>
                <input type="text" class="form-control" name="costo" required>
            </div>
            
            
            <br>
            <a href="listadoZonaAdmin.php"><button type="submit" class="btn btn-primary">Actualizar</button></a>
        </form>
    </div>
</div>






    </div>
</body>
</html>