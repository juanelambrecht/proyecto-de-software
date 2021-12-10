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
                                Descripcion</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Ubicacion</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Hora AM</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Hora PM</th>
                              
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Costo</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                Editar</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($zonas as $zona) : ?>
                              <tr class="odd">
                                <td><?= $zona['id'];?></td>
                                <td><?= $zona['descripcion'] ?></td>
                                <td><?= $zona['ubicacion_id'] ?></td>
                                <td><?php foreach ($horarios as $horario ):  
                                              if($zona['horarios_id'] == $horario['id']){
                                                  echo "hora inicio: ". $horario['hora_inicio_am'] ."<br>";
                                                  echo "hora fin: ". $horario['hora_fin_am'];
                                              }
                                  
                                        endforeach; ?>
                                
                                </td>
                                <td><?php foreach ($horarios as $horario ): 
                                              if($zona['horarios_id'] == $horario['id']){
                                                echo "hora inicio: ". $horario['hora_inicio_pm'] ."<br>";
                                                echo "hora fin: ". $horario['hora_fin_pm'];
                                              }
                                  
                                        endforeach; ?>
                                
                                </td>

                                <td><?= $zona['costo_horario']; ?></td>            
                                <td>
                                  <a href="<?= base_url('editarZona/' . $zona['id']); ?>" class="btn btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                </td>

                              </tr>
                            <?php endforeach; ?>
                          </tbody>

                        </table>
                      </div>
                    </div>
<?= $this->endsection('content');?>
