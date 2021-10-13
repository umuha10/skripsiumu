<div class="showback mt-3">
    <div class="card-body">
        <div class="row mt-3 ">
            <div class="col-md-10">
                <h3> Data Kriteria</h3>
            </div>
            <div class="col-md-2">
                <a href="" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#insert"> Tambah Data </a>
            </div>
            <div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= site_url('kriteria/proses') ?>" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kriteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label> ID Kriteria *</label>
                                        <input type="text" name="id_kriteria" class="form-control" required>
                                        <label> Nama Kriteria *</label>
                                        <input type="text" name="i_kriteria" class="form-control" required>
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
                <th>ID Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($row->result() as $key => $data) { ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $data->id_kriteria ?></td>
                  <td><?= $data->kriteria ?></td>
                  <td>
                      <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update<?= $data->id_kriteria ?>"><i class="fa fa-edit"></i></a>
                      <div class="modal fade" id="update<?= $data->id_kriteria ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <form action="<?= site_url('kriteria/proses') ?>" method="post">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Kriteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <label> ID Kriteria *</label>
                                    <input type="hidden" name="id" value="<?= $data->id_kriteria ?>">
                                    <input type="text" name="up_kriteria" value="<?= $data->id_kriteria ?>" class="form-control" required>
                                    <label> Nama Kriteria *</label>
                                    <input type="text" name="u_kriteria" value="<?= $data->kriteria ?>" class="form-control" required>
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
                      <a href="<?= site_url('kriteria/delete/' . $data->id_kriteria) ?>" onclick="return confirm('Yakin Menghapus data?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
</div>