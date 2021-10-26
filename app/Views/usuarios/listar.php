<?= $this->extend('template/admin-template'); ?>
<?= $this->section('content'); ?>
<section class="content">
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Datos Usuarios cargados en el Sistema</h3>
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
                                Nombre y Apellido</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Usuario</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Email</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                DNI</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Fecha Nac.</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Rol</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                              <tr class="odd">

                                <td><?= $usuario->id; ?></td>
                                <td><?= $usuario->nombre . " " . $usuario->apellido; ?></td>
                                <td><?= $usuario->username; ?></td>
                                <td><?= $usuario->email; ?></td>
                                <td><?= $usuario->dni; ?></td>
                                <td><?= $usuario->fecha_nacimiento; ?></td>
                                <td><?php foreach ($roles as $rol) :
                                      if ($usuario->id_rol == $rol['id']) {
                                        echo $rol['nombre'];
                                      }
                                    endforeach; ?>
                                </td>
                                <td>
                                  <a href="<?= base_url('editar/' . $usuario->id); ?>" class="btn btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                  <a href="<?= base_url('borrar/' . $usuario->id); ?>" class="btn btn-outline-danger" type="button"><i class="fa fa-trash"></i></a>
                                  <a href="<?= base_url('resetPass/' . $usuario->id); ?>" class="btn btn-outline-success" type="button"><i class="fa fa-key"></i></a>
                                </td>

                              </tr>
                            <?php endforeach; ?>
                          </tbody>

                        </table>
                      </div>
                    </div>
                    <?= $this->endsection('content');
