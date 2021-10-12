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
						<th onclick="urutkan()">Peringkat</th>
					</tr>
				</thead>
				<tbody id="tabel_peringkat">
				</tbody>
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
		console.log(data)
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

		console.log('hasil', data);

		for (let h in data) {
			target.forEach(res => {
				if (data[h].KK == res.no_kk) {
					// console.log(res)
					temp += `<tr>
						<td>${res.no_kk}</td>
						<td>${res.nik}</td>
						<td>${res.nama}</td>
						<td>${data[h].ranking}</td>
					</tr>`;
				}
			})
		}

		document.getElementById('tabel_peringkat').innerHTML = temp;
	}

	let orderBy = 'ASC';

	const urutkan = async () => {
		const result = await getData().then(res => res);
		let hasil = await getResult(result).then(res => res.data);

		if (hasil) {
			hasil = hasil.replace(/'/g, `"`);
			hasil = JSON.parse(hasil);
		}

		if (orderBy == 'ASC') {
			let sortable = [];

			for (h in hasil) {
				sortable.push([h, hasil[h].ranking])
			}

			sortable.sort((a, b) => {
				return a[1] - b[1];
			})

			console.log(sortable);

			orderBy = 'DESC';
		} else {
			let sortable = [];

			for (h in hasil) {
				sortable.push([h, hasil[h].ranking])
			}

			sortable.sort((a, b) => {
				return b[1] - a[1];
			})

			console.log(sortable);

			orderBy = 'ASC';
		}

		console.log(orderBy)
	}

	const showData = async () => {
		const result = await getData().then(res => res);
		console.log(result);

		let hasil = await getResult(result).then(res => res.data);

		if (hasil) {
			hasil = hasil.replace(/'/g, `"`);
			hasil = JSON.parse(hasil)
			// console.log(hasil)
		}

		drawTable(result, hasil);
	}

	window.addEventListener('load', async () => {
		await showData()
	})
</script>