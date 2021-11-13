<div class="showback mt-3">
	<div class="card-body">
		<?php if ($this->session->flashdata('pesan_error')) : ?>
			<div class="row mt-3">
				<div class="col-7 mx-auto">
					<?= $this->session->flashdata('pesan_error') ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="row mt-3 ">
			<div class="col-md-10">
				<h3> Data Penduduk</h3>
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
										<!-- <input type="text" name="l_penduduk" class=" form-control" required> -->
										<br>
										<input type="radio" name="l_penduduk" value="L" checked> Laki-laki<br>
										<input type="radio" name="l_penduduk" value="P"> Perempuan
										<br><br>
										<label> Alamat *</label>
										<!-- <input type="text" name="o_penduduk" class=" form-control" required> -->
										<br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 01 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 01 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 01 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 01 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 02 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 02 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 02 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 03 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 03 <br>
										<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 03 <br>
										<br>
										<label> Status Pekerjaan *</label>
										<select name="p_penduduk" class="form-control" id="bekerja">
											<!-- <option value="1">Belum Bekerja</option>
											<option value="5">Sudah Bekerja</option> -->
											<?php foreach ($kriteria_kerja->result() as $key => $data) : ?>
												<option value="<?= $data->bobot ?>"><?= $data->subkriteria ?></option>
											<?php endforeach; ?>
										</select>
										<!-- <input type="text" name="p_penduduk" class=" form-control" required> -->
										<label> Riwayat Penyakit *</label>
										<select name="q_penduduk" id="q_penduduk" class="form-control">
											<?php foreach ($kriteria_penyakit->result() as $key => $data) : ?>
												<option value="<?= $data->bobot ?>"><?= $data->subkriteria ?></option>
											<?php endforeach; ?>
										</select>
										<!-- <input type="text" name="q_penduduk" class=" form-control" required> -->
										<label> Bansos yang Penah/Sedang diterima *</label>
										<select name="r_penduduk" id="q_penduduk" class="form-control">
											<?php foreach ($kriteria_bansos->result() as $key => $data) : ?>
												<option value="<?= $data->bobot ?>"><?= $data->subkriteria ?></option>
											<?php endforeach; ?>
										</select>
										<!-- <input type="text" name="r_penduduk" class=" form-control" required> -->

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
						<th class="text-center">Bekerja</th>
						<th class="text-center">Riwayat Penyakit</th>
						<th class="text-center">Riwayat Bansos</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($row->result() as $key => $data) : ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $data->no_kk ?></td>
							<td><?= $data->nik ?></td>
							<td><?= $data->nama ?></td>
							<td><?= $data->jenis_kelamin ?></td>
							<td><?= $data->alamat ?></td>
							<td class="text-center"><?= $data->bekerja ?></td>
							<td class="text-center"><?= $data->riwayat_penyakit ?></td>
							<td class="text-center"><?= $data->bansos_diterima ?></td>
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
															<!-- <input type="text" name="d_penduduk" value="<?= $data->jenis_kelamin ?>" class="form-control" required> -->
															<br>
															<input type="radio" name="d_penduduk" value="L" checked> Laki-laki <br>
															<input type="radio" name="d_penduduk" value="P"> Perempuan
															<br><br>
															<label> Alamat *</label>
															<!-- <input type="text" name="g_penduduk" value="<?= $data->alamat ?>" class="form-control" required> -->
															<br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 01 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 01 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 01 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 01 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 02 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 02 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 02 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 01 RW 03 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 02 RW 03 <br>
															<input type="radio" name="o_penduduk" value="RT 01 RW 01" checked> RT 03 RW 03 <br>
															<br>
															<label> Status Pekerjaan *</label>
															<select name="h_penduduk" class="form-control" id="bekerja">
																<!-- <option value="1">Belum Bekerja</option>
											<option value="5">Sudah Bekerja</option> -->
																<?php foreach ($kriteria_kerja->result() as $key => $d) : ?>
																	<option value="<?= $d->bobot ?>" <?= ($data->bekerja == $d->bobot) ? 'selected' : '' ?>><?= $d->subkriteria ?></option>
																<?php endforeach; ?>
															</select>
															<!-- <input type="text" name="p_penduduk" class=" form-control" required> -->
															<label> Riwayat Penyakit *</label>
															<select name="x_penduduk" id="x_penduduk" class="form-control">
																<?php foreach ($kriteria_penyakit->result() as $key => $d) : ?>
																	<option value="<?= $d->bobot ?>" <?= ($data->riwayat_penyakit == $d->bobot) ? 'selected' : '' ?>><?= $d->subkriteria ?></option>
																<?php endforeach; ?>
															</select>
															<!-- <input type="text" name="q_penduduk" class=" form-control" required> -->
															<label> Bansos yang Penah/Sedang diterima *</label>
															<select name="y_penduduk" id="y_penduduk" class="form-control">
																<?php foreach ($kriteria_bansos->result() as $key => $d) : ?>
																	<option value="<?= $d->bobot ?>" <?= ($data->bansos_diterima == $d->bobot) ? 'selected' : '' ?>><?= $d->subkriteria ?></option>
																<?php endforeach; ?>
															</select>
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
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>