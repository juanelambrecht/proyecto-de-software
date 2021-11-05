<?= $this->extend('template/admin-template'); ?>
<?= $this->section('content'); ?>

<section class="content">
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Estadias cargadas en el sistema</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">

                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                          <thead>
                            <tr role="row">
                              <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                #</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Patente</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Dia</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Hora Inicio</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Hora Fin</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Dinero</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Zona</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Venta</th>
                            </tr>
                          </thead>
                          <tbody>   

                          <?php foreach ($estadias as $estadia) : ?>
                              <tr class="odd">

                                <td><?= $estadia->id; ?></td>
                                <td><?= $estadia->patente; ?></td>
                                <td><?= $estadia->fecha; ?></td>
                                <td><?= $estadia->hora_inicio; ?></td>
                                <td><?= $estadia->hora_fin; ?></td>
                                <td><?= $estadia->pesosTotal; ?></td>
                                <td><?= $estadia->zona_id; ?></td>
                                <td><?php foreach ($usuarios as $usuario) :
                                      if ($estadia->user_id == $usuario->id) {
                                        echo $usuario->username;
                                      }
                                    endforeach; ?>
                                </td>

                              </tr>
                            <?php endforeach; ?>


                          </tbody>

                        </table>
                      </div>
                    </div>
                    


<?= $this->endsection('content'); ?>