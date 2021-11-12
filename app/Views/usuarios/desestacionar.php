<?= $this->extend('template/client-template'); ?>
<?= $this->section('content'); ?>
<section class="content">
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mis vehiculos estacionados</h3>
                    </div>
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
                                                                Hora inicio</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">
                                                                Zona</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($estadias as $estadia) : ?>
                                                            <tr class="odd">
                                                                <td><?= $estadia->id; ?></td>
                                                                <td><?= $estadia->patente; ?></td>
                                                                <td><?= $estadia->hora_inicio; ?></td>
                                                                <td><?= $estadia->zona_id; ?></td>
                                                                <td>
                                                                    <a href="<?= base_url('desestacionarVehiculo/' . $estadia->id); ?>" class="btn btn-outline-success" type="button"><i class="fa fa-minus-circle"></i></a>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <?= $this->endsection('content');
