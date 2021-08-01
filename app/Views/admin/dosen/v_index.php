<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <br>
</section>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data <?= $title ?></h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('dosen/add') ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"> Add</i>
                    </a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php 
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                } ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Kode Dosen</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Password</th>
                            <th class="text-center">Foto</th>
                            <th width="150px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dosen as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td> 
                                <td><?= $value['kode_dosen'] ?></td>
                                <td><?= $value['nidn'] ?></td>
                                <td><?= $value['nama_dosen'] ?></td>
                                <td><?= $value['password'] ?></td>
                                <td class="text-center"><img src="<?= base_url('fotodosen/' . $value['foto_dosen']) ?>" class="img-circle" width="70px" height="70px"></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-warning btn-sm btn-flat">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_dosen'] ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    <!-- /.box -->

    </div>
</div>