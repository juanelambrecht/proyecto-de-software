<?= $this->extend('template/admin-template'); ?>
<?= $this->section('content'); ?>

<section class="content">
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          </div>

  <nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Listado de Infracciones</a>
 <!-- <form class="" action="" method="post">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" id="buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search-dollar"></i></button> -->
</form>
    </nav>
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
                          <thead>
                            <tr role="row">
                              <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                #</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Dia</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Hora</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Calle</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Altura</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Patente</th>
                            </tr>
                          </thead>
                          <tbody>   

                          <?php foreach ($infracciones as $infraccion) : ?>
                              <tr class="odd">

                                <td><?= $infraccion['infraccion_id']; ?></td>
                                <td><?= $infraccion['dia']; ?></td>
                                <td><?= $infraccion['hora']; ?></td>
                                <td><?= $infraccion['calle']; ?></td>
                                <td><?= $infraccion['calle_altura']; ?></td>
                                <td><?= $infraccion['patente']; ?></td>
                              </tr>
                            <?php endforeach; ?>


                          </tbody>

                        </table>
                      </div>
                    </div>
                    

<?= $this->endsection('content'); ?>