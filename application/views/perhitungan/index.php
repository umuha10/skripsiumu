<div class="showback mt-3">
	<div class="card-body">
		<div class="row mt-3 ">
			<div class="col-md-10">
				<h3> Data Alternatif</h3>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No KK</th>
						<th>NIK</th>
						<th>Nama</th>
						<th onclick="urutkan()" style="cursor: pointer;">
							Peringkat
							<span class="material-icons" id="icon">swap_vert</span>
						</th>
					</tr>
				</thead>
				<tbody id="tabel_peringkat"></tbody>
			</table>
		</div>
	</div>
</div>

<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script src="<?= base_url('assets/js/') ?>axios.min.js"></script>

<script>
	const getData = async () => {
		return await axios.get(`<?= base_url('perhitungan/ajax') ?>`).then(res => res.data);
	}

	const getResult = async (data) => {
		return await axios.post(`http://localhost:5000/calculate`,
			data, {
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(res => res.data);
	}

	const drawTable = (target, data) => {
		let temp = ``;
		let peringkat = 1;

		let hasil = [];

		data.forEach(dt => {
			target.forEach(res => {
				if (dt.KK == res.no_kk) {
					temp += `<tr>
						<td>${res.no_kk}</td>
						<td>${res.nik}</td>
						<td>${res.nama}</td>
						<td>${dt.ranking}</td>
					</tr>`;
				}
			});
		});

		document.getElementById('tabel_peringkat').innerHTML = temp;
	}

	let orderBy = 'ASC';

	const urutkan = async () => {
		let finalResult = [];

		const result = await getData().then(res => res);
		let hasil = await getResult(result).then(res => res.data);

		let icon = document.getElementById('icon');

		if (hasil) {
			hasil = hasil.replace(/'/g, `"`);
			hasil = JSON.parse(hasil);
		}

		let tempHasil = [];

		for (let h in hasil) {
			tempHasil.push({
				id: h,
				KK: hasil[h].KK,
				ranking: hasil[h].ranking
			});
		}

		if (orderBy == 'ASC') {
			let sortable = [];

			for (h in hasil) {
				sortable.push([h, hasil[h].ranking]);
			}

			sortable.sort((a, b) => {
				return a[1] - b[1];
			});

			sortable.forEach(s => {
				tempHasil.forEach(t => {
					if (s[0] == t.id) {
						finalResult.push({
							id: t.id,
							KK: t.KK,
							ranking: t.ranking
						});
					}
				});
			});

			icon.innerText = "arrow_downward";

			orderBy = 'DESC';
		} else {
			let sortable = [];

			for (h in hasil) {
				sortable.push([h, hasil[h].ranking]);
			}

			sortable.sort((a, b) => {
				return b[1] - a[1];
			});

			sortable.forEach(s => {
				tempHasil.forEach(t => {
					if (s[0] == t.id) {
						finalResult.push({
							id: t.id,
							KK: t.KK,
							ranking: t.ranking
						});
					}
				});
			});

			icon.innerText = "arrow_upward";

			orderBy = 'ASC';
		}

		drawTable(result, finalResult);

		console.log(orderBy);
	}

	const showData = async () => {
		const result = await getData().then(res => res);

		let hasil = await getResult(result).then(res => res.data);

		if (hasil) {
			hasil = hasil.replace(/'/g, `"`);
			hasil = JSON.parse(hasil);
		}

		let data = [];

		for (let h in hasil) {
			data.push({
				id: hasil[h].id,
				KK: hasil[h].KK,
				ranking: hasil[h].ranking
			});
		}

		drawTable(result, data);
	}

	window.addEventListener('load', async () => {
		await showData();
	})
</script>