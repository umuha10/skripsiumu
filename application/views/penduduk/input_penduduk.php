<div class="showback mt-3">
    <div class="card-body">
        <div class="row mt-3 ">
            <div class="col-md-10">
                <h3> Data Pednduduk</h3>
            </div>
            <div class="col-md-2">
                <a href="" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#insert"> Tambah Data </a>
            </div>
            <div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= site_url('penduduk/proses') ?>" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penduduk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label> No KK *</label>
                                        <input type="number" name="i_penduduk" class="form-control" required>
                                        <label> NIK *</label>
                                        <input type="number" name="j_penduduk" class=" form-control" required>
                                        <label> Nama *</label>
                                        <input type="text" name="k_penduduk" class=" form-control" required>
                                        <label> Jenis Kelamin (P/L) *</label>
                                        <input type="text" name="l_penduduk" class=" form-control" required>
                                        <label> Alamat *</label>
                                        <input type="text" name="o_penduduk" class=" form-control" required>
                                        <label> Pekerjaan *</label>
                                        <input type="text" name="p_penduduk" class=" form-control" required>
                                        <label> Riwayat Penyakit *</label>
                                        <input type="text" name="q_penduduk" class=" form-control" required>
                                        <label> Bansos yang Penah/Sedang diterima *</label>
                                        <input type="text" name="r_penduduk" class=" form-control" required>


                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="insert" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No KK</th>
                        <th>NIK</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Riwayat Penyakit</th>
                        <th>Riwayat Bansos</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row->result() as $key => $data) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $data->no_kk ?></td>
                            <td><?= $data->nik ?></td>
                            <td><?= $data->nama ?></td>
                            <td><?= $data->jenis_kelamin ?></td>
                            <td><?= $data->alamat ?></td>
                            <td><?= $data->pekerjaan ?></td>
                            <td><?= $data->riwayat_penyakit ?></td>
                            <td><?= $data->bansos_diterima ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update<?= $data->no_kk ?>"><i class="fa fa-edit"></i></a>
                                <div class="modal fade" id="update<?= $data->no_kk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="<?= site_url('penduduk/proses') ?>" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Data Penduduk</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label> No KK *</label>
                                                            <input type="hidden" name="id" value="<?= $data->no_kk ?>">
                                                            <input type="number" name="a_penduduk" value="<?= $data->no_kk ?>" class="form-control" required>
                                                            <label> NIK *</label>
                                                            <input type="number" name="b_penduduk" value="<?= $data->nik ?>" class="form-control" required>
                                                            <label> Nama *</label>
                                                            <input type="text" name="c_penduduk" value="<?= $data->nama ?>" class="form-control" required>
                                                            <label> Jenis Kelamin *</label>
                                                            <input type="text" name="d_penduduk" value="<?= $data->jenis_kelamin ?>" class="form-control" required>
                                                            <label> Alamat *</label>
                                                            <input type="text" name="g_penduduk" value="<?= $data->alamat ?>" class="form-control" required>
                                                            <label> Pekerjaan *</label>
                                                            <input type="text" name="h_penduduk" value="<?= $data->pekerjaan ?>" class="form-control" required>
                                                            <label> Riwayat Penyakit *</label>
                                                            <input type="text" name="x_penduduk" value="<?= $data->riwayat_penyakit ?>" class="form-control" required>
                                                            <label> Riwayat Bansos *</label>
                                                            <input type="text" name="y_penduduk" value="<?= $data->bansos_diterima ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="<?= site_url('penduduk/delete/' . $data->no_kk) ?>" onclick="return confirm('Yakin Menghapus data?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>