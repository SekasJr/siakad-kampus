<section class="content-header">
    <h1>
        <?= $title ?>
        <small>Prodi <?= $prodi['prodi'] ?></small>
    </h1>
    
    <br>
</section>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-success box-solid">
            
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="150px">Program Studi</th>
                        <td width="20px">:</td>
                        <td><?= $prodi['prodi'] ?></td>
                    </tr>
                    <tr>
                        <th>Jenjang</th>
                        <td>:</td>
                        <td><?= $prodi['jenjang'] ?></td>
                    </tr>
                    <tr>
                        <th>Fakultas</th>
                        <td>:</td>
                        <td><?= $prodi['fakultas'] ?></td>
                    </tr>
                </table>

            </div>
            <!-- /.box-body -->
        </div>
    <!-- /.box -->
    </div>

    <div class="col-sm-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $title ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#add">
                        <i class="fa fa-plus"> Add</i>
                    </button>
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
                }
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th class="text-center">Kode</th>
                            <th>Mata Kuliah</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Semester</th>
                            <th width="50px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($matkul as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-center"><?= $value['kode_matkul'] ?></td>
                                <td><?= $value['matkul'] ?></td>
                                <td class="text-center"><?= $value['sks'] ?></td>
                                <td class="text-center"><?= $value['kategori'] ?></td>
                                <td class="text-center"><?= $value['smt'] ?> (<?= $value['semester'] ?>)</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_matkul'] ?>">
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